<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_image_search
{
    private $geminiApiKey;
    private $qdrantUrl;
    private $qdrantApiKey;
    private $collection = 'products_images';

    public function __construct()
    {
        $CI = &get_instance();

        $CI->config->load('image_search');

        $this->geminiApiKey =
            $CI->config->item('gemini_api_key');

        $this->qdrantUrl =
            $CI->config->item('qdrant_url');

        $this->qdrantApiKey =
            $CI->config->item('qdrant_api_key');

        $this->collection =
            $CI->config->item('qdrant_collection');
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE IMAGE EMBEDDING WITH GEMINI
    |--------------------------------------------------------------------------
    */
    public function createImageEmbedding($imagePath)
    {
        if (!file_exists($imagePath)) {

            return [
                'status' => false,
                'message' => 'Fotoja nuk ekziston: ' . $imagePath
            ];
        }


        $mimeType = mime_content_type($imagePath);


        $allowed = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        if (!in_array($mimeType, $allowed)) {

            return [
                'status' => false,
                'message' => 'Formati i fotos nuk perkrahet: ' . $mimeType
            ];
        }


        $imageData =
            base64_encode(
                file_get_contents($imagePath)
            );


        /*
    |--------------------------------------------------------------------------
    | VISUAL PRODUCT RETRIEVAL INSTRUCTION
    |--------------------------------------------------------------------------
    |
    | Ky instruction perdoret per:
    | - produkt individual
    | - pjese / komponent
    | - set / komplet
    | - multi-object images
    | - part-to-whole
    | - whole-to-part
    |
    | Qellimi kryesor:
    | reduktimi i FALSE NEGATIVES.
    |
    */

        $retrievalInstruction = <<<'PROMPT'
Represent this image for tolerant visual product retrieval.

The goal is to retrieve the same product, a strongly related physical product, a component of the product, or a set containing the product.

Analyze every visible physical product, tool, part, accessory, attachment and component in the image as potentially important.

Do not assume that the entire image represents one single product.

If several objects A, B and C are visible, preserve visual and semantic information about A, B and C individually so that a database product matching any one of them can still be retrieved.

Support all of these relationships:

- object to product
- product to object
- part to product
- product to part
- part to part
- set to set
- part to set
- set to part
- component to assembly
- assembly to component

A match can be highly relevant when:

- the query shows one component and the database image shows a complete set containing that component;
- the query shows a complete set and the database image shows only one of its components;
- the desired object is only one of several objects visible in either image.

Prioritize intrinsic physical and functional characteristics:

- overall shape
- geometry
- physical structure
- construction
- mechanical design
- functional purpose
- distinctive components
- openings and holes
- clamps and holders
- connectors
- joints
- handles
- blades
- shafts
- mounting points
- relative dimensions and proportions
- arrangement of functional parts
- characteristic physical features
- intended use

Give substantially less importance to:

- color
- background
- lighting
- orientation
- rotation
- camera angle
- scale in the photograph
- packaging
- box design
- position inside packaging
- arrangement of accessories
- presence of extra accessories
- absence of non-essential accessories

Do not require pixel-level or photographic similarity.

The same physical product must remain a strong retrieval candidate when photographed:

- from another angle;
- rotated;
- in another position;
- with another background;
- under different lighting;
- in another color;
- with different packaging;
- together with additional accessories;
- without some accessories;
- as one item inside a larger set;
- as one item among several products.

Use structural and functional similarity as the main signal.

If strong structural or functional similarity exists, do not reject the candidate merely because the overall photographs look different.

Favor recall over excessive strictness.

It is preferable to retrieve several plausible product candidates rather than miss the correct product because of differences in presentation, accessories, packaging, color, orientation or surrounding objects.

Treat visible objects as independently meaningful while also retaining their relationship to the whole set or assembly.
PROMPT;


        $url =
            'https://generativelanguage.googleapis.com/v1beta/models/' .
            'gemini-embedding-2:embedContent';


        $payload = [

            'content' => [

                'parts' => [

                    /*
                 * Instruction per retrieval.
                 */
                    [
                        'text' =>
                        $retrievalInstruction
                    ],

                    /*
                 * Fotografia reale.
                 */
                    [
                        'inline_data' => [

                            'mime_type' =>
                            $mimeType,

                            'data' =>
                            $imageData
                        ]
                    ]

                ]
            ],


            /*
         * Mbajme dimensionin ekzistues.
         * Qdrant collection eshte 768.
         */
            'output_dimensionality' => 768

        ];


        $response =
            $this->request(
                $url,
                'POST',
                $payload,
                [
                    'Content-Type: application/json',
                    'x-goog-api-key: ' .
                        $this->geminiApiKey
                ]
            );


        if (
            !isset($response['status']) ||
            !$response['status']
        ) {

            return $response;
        }


        /*
    |--------------------------------------------------------------------------
    | MERRE EMBEDDING
    |--------------------------------------------------------------------------
    */

        $embedding = null;


        if (
            isset(
                $response['data']['embedding']['values']
            ) &&
            is_array(
                $response['data']['embedding']['values']
            )
        ) {

            $embedding =
                $response['data']['embedding']['values'];
        }


        /*
     * Fallback nese API response
     * ndryshon pak ne strukture.
     */
        if (
            !$embedding &&
            isset(
                $response['data']['embeddings'][0]['values']
            ) &&
            is_array(
                $response['data']['embeddings'][0]['values']
            )
        ) {

            $embedding =
                $response['data']['embeddings'][0]['values'];
        }


        if (
            !$embedding ||
            !is_array($embedding)
        ) {

            return [
                'status' => false,
                'message' =>
                'Gemini nuk ktheu embedding valid.',
                'debug' => $response
            ];
        }


        return [
            'status' => true,
            'embedding' => $embedding,
            'vector_size' => count($embedding)
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE QDRANT COLLECTION
    |--------------------------------------------------------------------------
    |
    | Thirre vetem nje here.
    |
    */
    public function createCollection($vectorSize)
    {
        $url = rtrim($this->qdrantUrl, '/') .
            '/collections/' . $this->collection;

        $payload = [
            'vectors' => [
                'size' => (int)$vectorSize,
                'distance' => 'Cosine'
            ]
        ];

        return $this->qdrantRequest(
            $url,
            'PUT',
            $payload
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE PRODUCT VECTOR
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| CREATE DETERMINISTIC QDRANT POINT ID
|--------------------------------------------------------------------------
|
| Nje produkt mund te kete disa vectors:
| full
| object_1
| object_2
| ...
|
| Qdrant pranon UUID si point ID.
|
*/
    private function createVectorPointId(
        $productId,
        $vectorType = 'full',
        $objectIndex = 0
    ) {
        $seed =
            (int)$productId .
            '|' .
            $vectorType .
            '|' .
            (int)$objectIndex;

        $hash = md5($seed);

        return
            substr($hash, 0, 8) . '-' .
            substr($hash, 8, 4) . '-' .
            substr($hash, 12, 4) . '-' .
            substr($hash, 16, 4) . '-' .
            substr($hash, 20, 12);
    }

    public function saveProductVector(
        $productId,
        array $embedding,
        array $productData = [],
        $vectorType = 'full',
        $objectIndex = 0
    ) {
        $productId =
            (int)$productId;

        $objectIndex =
            (int)$objectIndex;

        $pointId =
            $this->createVectorPointId(
                $productId,
                $vectorType,
                $objectIndex
            );


        $url =
            rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/points?wait=true';


        $payload = [
            'points' => [
                [
                    /*
                 * Qdrant point ID unik per secilin vector.
                 */
                    'id' => $pointId,

                    'vector' =>
                    $embedding,

                    'payload' => [

                        /*
                     * Ky mbetet ID reale e produktit.
                     */
                        'product_id' =>
                        $productId,

                        'code' =>
                        isset($productData['code'])
                            ? $productData['code']
                            : null,

                        'name' =>
                        isset($productData['name'])
                            ? $productData['name']
                            : null,

                        'category_id' =>
                        isset($productData['category_id'])
                            ? (int)$productData['category_id']
                            : null,

                        'image' =>
                        isset($productData['image'])
                            ? $productData['image']
                            : null,

                        /*
                     * full / object
                     */
                        'vector_type' =>
                        $vectorType,

                        /*
                     * 0 per full image.
                     * 1,2,3... per objekte.
                     */
                        'object_index' =>
                        $objectIndex,

                        /*
                     * Optional label nga Gemini.
                     */
                        'object_label' =>
                        isset($productData['object_label'])
                            ? $productData['object_label']
                            : null
                    ]
                ]
            ]
        ];


        return $this->qdrantRequest(
            $url,
            'PUT',
            $payload
        );
    }

    /*
|--------------------------------------------------------------------------
| DELETE ALL VECTORS OF ONE PRODUCT
|--------------------------------------------------------------------------
|
| Perdoret para reindeximit.
| Fshin full + te gjitha object vectors e vjetra.
|
*/
    public function deleteProductVectors($productId)
    {
        $productId = (int)$productId;

        if ($productId <= 0) {
            return [
                'status' => false,
                'message' => 'Product ID nuk eshte valid.'
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | 1. FSHI VECTORAT E RINJ SIPAS PAYLOAD
    |--------------------------------------------------------------------------
    */

        $filterUrl =
            rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/points/delete?wait=true';


        $filterPayload = [
            'filter' => [
                'must' => [
                    [
                        'key' => 'product_id',
                        'match' => [
                            'value' => $productId
                        ]
                    ]
                ]
            ]
        ];


        $filterResult =
            $this->qdrantRequest(
                $filterUrl,
                'POST',
                $filterPayload
            );


        if (
            !isset($filterResult['status']) ||
            !$filterResult['status']
        ) {
            return [
                'status' => false,
                'message' =>
                'Gabim gjate fshirjes se vectors sipas product_id.',
                'debug' =>
                $filterResult
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | 2. FSHI POINT-IN E VJETER NUMERIK
    |--------------------------------------------------------------------------
    |
    | Sistemi i vjeter perdorte:
    |
    | Qdrant point ID = product_id
    |
    | Ky hap eshte vetem per migrim.
    |
    */

        $legacyPayload = [
            'points' => [
                $productId
            ]
        ];


        $legacyResult =
            $this->qdrantRequest(
                $filterUrl,
                'POST',
                $legacyPayload
            );


        /*
     * Nese point-i i vjeter nuk ekziston,
     * nuk eshte problem.
     *
     * Qellimi kryesor eshte qe filter delete
     * te kete funksionuar.
     */


        return [
            'status' => true,
            'product_id' => $productId,
            'filter_delete' => $filterResult,
            'legacy_delete' => $legacyResult
        ];
    }

    /*
|--------------------------------------------------------------------------
| INDEX PRODUCT IMAGE - MULTI OBJECT
|--------------------------------------------------------------------------
|
| Per nje produkt krijon:
|
| 1. FULL IMAGE vector
| 2. 0 ose disa OBJECT vectors
|
| Te gjitha kane te njejtin product_id ne payload,
| por Qdrant point ID te ndryshme.
|
| Kjo mundeson:
|
| object <-> product
| part   <-> whole
| whole  <-> part
| set    <-> part
| part   <-> set
|
*/
    public function indexProductImageMultiObject(
        $productId,
        $imagePath,
        array $productData = [],
        $maxObjects = 8
    ) {
        $productId = (int)$productId;
        $maxObjects = (int)$maxObjects;


        /*
    |--------------------------------------------------------------------------
    | VALIDIM
    |--------------------------------------------------------------------------
    */

        if ($productId <= 0) {

            return [
                'status' => false,
                'message' => 'Product ID nuk eshte valid.'
            ];
        }


        if (
            !file_exists($imagePath) ||
            !is_file($imagePath)
        ) {

            return [
                'status' => false,
                'message' =>
                'Fotoja e produktit nuk ekziston: ' .
                    $imagePath
            ];
        }


        if ($maxObjects <= 0) {
            $maxObjects = 8;
        }

        if ($maxObjects > 12) {
            $maxObjects = 12;
        }


        /*
    |--------------------------------------------------------------------------
    | VECTORAT QE DO TE RUAJME
    |--------------------------------------------------------------------------
    |
    | Fillimisht i krijojme ne memory.
    |
    | Vetem pasi FULL embedding te jete gati,
    | fshijme vectorat e vjeter.
    |
    */

        $vectorsToSave = [];

        $tempFiles = [];


        /*
    |--------------------------------------------------------------------------
    | 1. FULL IMAGE EMBEDDING
    |--------------------------------------------------------------------------
    */

        $fullEmbedding =
            $this->createImageEmbedding(
                $imagePath
            );


        if (
            !isset($fullEmbedding['status']) ||
            !$fullEmbedding['status'] ||
            empty($fullEmbedding['embedding'])
        ) {

            return [
                'status' => false,
                'message' =>
                isset($fullEmbedding['message'])
                    ? $fullEmbedding['message']
                    : 'Nuk u krijua embedding per fotografinë komplet.'
            ];
        }


        /*
     * FULL IMAGE gjithmone ruhet.
     */
        $vectorsToSave[] = [

            'type' =>
            'full',

            'object_index' =>
            0,

            'label' =>
            'full_image',

            'embedding' =>
            $fullEmbedding['embedding']
        ];


        /*
    |--------------------------------------------------------------------------
    | 2. DETECT OBJECTS
    |--------------------------------------------------------------------------
    */

        $detection =
            $this->detectImageObjects(
                $imagePath,
                $maxObjects
            );


        if (
            isset($detection['status']) &&
            $detection['status'] &&
            isset($detection['objects']) &&
            is_array($detection['objects'])
        ) {

            $objectIndex = 1;


            foreach (
                $detection['objects']
                as $object
            ) {

                if (
                    !isset($object['box_2d']) ||
                    !is_array($object['box_2d'])
                ) {
                    continue;
                }


                /*
            |--------------------------------------------------------------------------
            | CROP OBJECT
            |--------------------------------------------------------------------------
            */

                $cropFile =
                    $this->cropDetectedObject(
                        $imagePath,
                        $object['box_2d'],
                        0.06
                    );


                if (!$cropFile) {
                    continue;
                }


                $tempFiles[] =
                    $cropFile;


                /*
            |--------------------------------------------------------------------------
            | EMBEDDING PER OBJECT
            |--------------------------------------------------------------------------
            */

                $objectEmbedding =
                    $this->createImageEmbedding(
                        $cropFile
                    );


                if (
                    !isset(
                        $objectEmbedding['status']
                    ) ||
                    !$objectEmbedding['status'] ||
                    empty($objectEmbedding['embedding'])
                ) {

                    /*
                 * Nje objekt deshtoi.
                 *
                 * Nuk ndalojme krejt produktin.
                 * Vazhdojme me objektet tjera.
                 */
                    continue;
                }


                $label =
                    isset($object['label']) &&
                    !empty($object['label'])
                    ? $object['label']
                    : 'object_' . $objectIndex;


                $vectorsToSave[] = [

                    'type' =>
                    'object',

                    'object_index' =>
                    $objectIndex,

                    'label' =>
                    $label,

                    'box_2d' =>
                    $object['box_2d'],

                    'embedding' =>
                    $objectEmbedding['embedding']
                ];


                $objectIndex++;
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 3. CLEAN TEMP FILES
    |--------------------------------------------------------------------------
    */

        foreach ($tempFiles as $tempFile) {

            if (
                $tempFile &&
                file_exists($tempFile)
            ) {

                @unlink($tempFile);
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 4. FULL EMBEDDING ESHTE GATI
    |
    | TASH MUND T'I FSHIJME VECTORAT E VJETER
    |--------------------------------------------------------------------------
    */

        $deleteResult =
            $this->deleteProductVectors(
                $productId
            );


        /*
     * Nese Qdrant deshton gjate delete,
     * mos vazhdo me gjysme indeksimi.
     */
        if (
            !isset($deleteResult['status']) ||
            !$deleteResult['status']
        ) {

            return [
                'status' => false,
                'message' =>
                'Nuk u fshine vectorat e vjeter te produktit.',
                'qdrant_debug' =>
                $deleteResult
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | 5. SAVE ALL NEW VECTORS
    |--------------------------------------------------------------------------
    */

        $savedVectors = 0;

        $failedVectors = [];

        $savedDetails = [];


        foreach (
            $vectorsToSave
            as $vectorData
        ) {

            $saveData =
                $productData;


            /*
         * Shtojme label-in e objektit ne payload.
         */
            $saveData['object_label'] =
                $vectorData['label'];


            $saveResult =
                $this->saveProductVector(
                    $productId,
                    $vectorData['embedding'],
                    $saveData,
                    $vectorData['type'],
                    $vectorData['object_index']
                );


            if (
                isset($saveResult['status']) &&
                $saveResult['status']
            ) {

                $savedVectors++;


                $savedDetails[] = [

                    'type' =>
                    $vectorData['type'],

                    'object_index' =>
                    $vectorData['object_index'],

                    'label' =>
                    $vectorData['label']
                ];
            } else {

                $failedVectors[] = [

                    'type' =>
                    $vectorData['type'],

                    'object_index' =>
                    $vectorData['object_index'],

                    'label' =>
                    $vectorData['label'],

                    'error' =>
                    isset($saveResult['message'])
                        ? $saveResult['message']
                        : 'Qdrant save error'
                ];
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 6. SIGUROHU QE FULL IMAGE U RUAJT
    |--------------------------------------------------------------------------
    */

        $fullSaved = false;


        foreach ($savedDetails as $saved) {

            if (
                $saved['type'] === 'full' &&
                (int)$saved['object_index'] === 0
            ) {

                $fullSaved = true;
                break;
            }
        }


        if (!$fullSaved) {

            return [
                'status' => false,

                'message' =>
                'Vectori kryesor FULL i produktit nuk u ruajt.',

                'saved_vectors' =>
                $savedVectors,

                'failed_vectors' =>
                $failedVectors
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | 7. SUCCESS
    |--------------------------------------------------------------------------
    */

        return [

            'status' =>
            true,

            'product_id' =>
            $productId,

            /*
         * Numri total:
         * FULL + OBJECTS
         */
            'vectors_saved' =>
            $savedVectors,

            /*
         * Sa objekte reale u ruajten.
         * FULL nuk numerohen ketu.
         */
            'objects_saved' =>
            max(
                0,
                $savedVectors - 1
            ),

            /*
         * Sa objekte Gemini detektoi,
         * edhe nese ndonje crop deshtoi.
         */
            'objects_detected' => (
                isset($detection['objects']) &&
                is_array($detection['objects'])
            )
                ? count($detection['objects'])
                : 0,

            'vectors' =>
            $savedDetails,

            'failed_vectors' =>
            $failedVectors
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH SIMILAR PRODUCTS
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| DETECT OBJECTS IN QUERY IMAGE
|--------------------------------------------------------------------------
|
| Gjen 1 ose disa produkte / pjese / komponente ne foto.
| Nuk supozon qe fotografia eshte nje produkt i vetem.
|
*/
    public function detectImageObjects($imagePath, $maxObjects = 8)
    {
        if (!file_exists($imagePath)) {
            return [
                'status' => false,
                'objects' => [],
                'message' => 'Fotoja nuk ekziston.'
            ];
        }

        $mimeType = mime_content_type($imagePath);

        $allowed = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!in_array($mimeType, $allowed)) {
            return [
                'status' => false,
                'objects' => [],
                'message' => 'Formati i fotos nuk perkrahet.'
            ];
        }

        $maxObjects = (int)$maxObjects;

        if ($maxObjects <= 0) {
            $maxObjects = 8;
        }

        if ($maxObjects > 12) {
            $maxObjects = 12;
        }

        $imageData =
            base64_encode(
                file_get_contents($imagePath)
            );

        /*
     * Prompti eshte generic.
     * Nuk supozon sete dhe nuk supozon numer fiks objektesh.
     */
        $prompt = <<<'PROMPT'
Analyze this image for visual product search.

Detect the distinct commercially meaningful physical objects that could independently correspond to a product in a product catalog.

Objects may include:
- complete products;
- tools;
- machines;
- accessories;
- replacement parts;
- components;
- attachments;
- adapters;
- connectors;
- mechanical parts;
- electrical parts;
- individual items inside kits or sets.

Important rules:

1. The image may contain ONE object or MULTIPLE different objects.
2. Do not assume all visible objects belong to one set.
3. Detect each meaningful product, part or component separately.
4. If a box, kit or set contains clearly distinguishable useful items, detect the important individual items as well as the larger assembly/set when appropriate.
5. Ignore background objects, hands, tables, walls, packaging graphics and irrelevant scenery.
6. Do not split one normal product into meaningless tiny sub-parts.
7. Prefer objects that could realistically exist as a separate catalog item.
8. Detect objects even when they overlap, are rotated, have another color, or are viewed from unusual angles.
9. Focus on physical structure and functional objects, not color or packaging.
10. Return at most the most important objects.

Return bounding boxes as:
[ymin, xmin, ymax, xmax]

Coordinates must be normalized from 0 to 1000.

Return JSON only in this format:

{
    "objects": [
        {
            "label": "short descriptive label",
            "box_2d": [ymin, xmin, ymax, xmax]
        }
    ]
}
PROMPT;

        /*
     * Model per object detection.
     *
     * Nese me vone ndryshon modelin Gemini,
     * ndrysho vetem kete rresht.
     */
        $url =
            'https://generativelanguage.googleapis.com/v1beta/models/' .
            'gemini-3.8-flash:generateContent';

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ],
                        [
                            'inline_data' => [
                                'mime_type' => $mimeType,
                                'data' => $imageData
                            ]
                        ]
                    ]
                ]
            ],

            'generationConfig' => [
                'responseMimeType' => 'application/json',
                'temperature' => 0.1
            ]
        ];

        $response =
            $this->request(
                $url,
                'POST',
                $payload,
                [
                    'Content-Type: application/json',
                    'x-goog-api-key: ' . $this->geminiApiKey
                ]
            );

        if (
            !isset($response['status']) ||
            !$response['status']
        ) {
            return [
                'status' => false,
                'objects' => [],
                'message' =>
                isset($response['message'])
                    ? $response['message']
                    : 'Object detection deshtoi.'
            ];
        }

        $text = null;

        if (
            isset(
                $response['data']['candidates'][0]['content']['parts'][0]['text']
            )
        ) {
            $text =
                $response['data']['candidates'][0]['content']['parts'][0]['text'];
        }

        if (!$text) {
            return [
                'status' => false,
                'objects' => [],
                'message' =>
                'Gemini nuk ktheu object detection.'
            ];
        }

        $decoded =
            json_decode(
                $text,
                true
            );

        /*
     * Fallback nese modeli kthen direkt array.
     */
        if (
            is_array($decoded) &&
            isset($decoded['objects']) &&
            is_array($decoded['objects'])
        ) {
            $objects = $decoded['objects'];
        } elseif (is_array($decoded)) {
            $objects = $decoded;
        } else {
            $objects = [];
        }

        $validObjects = [];

        foreach ($objects as $object) {

            if (
                !isset($object['box_2d']) ||
                !is_array($object['box_2d']) ||
                count($object['box_2d']) != 4
            ) {
                continue;
            }

            $box = array_map(
                'intval',
                $object['box_2d']
            );

            $yMin = max(0, min(1000, $box[0]));
            $xMin = max(0, min(1000, $box[1]));
            $yMax = max(0, min(1000, $box[2]));
            $xMax = max(0, min(1000, $box[3]));

            if (
                $xMax <= $xMin ||
                $yMax <= $yMin
            ) {
                continue;
            }

            /*
         * Largo objekte ekstremisht te vogla.
         * 20 x 20 ne sistemin 0-1000.
         */
            if (
                ($xMax - $xMin) < 20 ||
                ($yMax - $yMin) < 20
            ) {
                continue;
            }

            $validObjects[] = [
                'label' =>
                isset($object['label'])
                    ? $object['label']
                    : 'object',

                'box_2d' => [
                    $yMin,
                    $xMin,
                    $yMax,
                    $xMax
                ]
            ];

            if (
                count($validObjects) >=
                $maxObjects
            ) {
                break;
            }
        }

        return [
            'status' => true,
            'objects' => $validObjects
        ];
    }


    /*
|--------------------------------------------------------------------------
| CROP DETECTED OBJECT
|--------------------------------------------------------------------------
|
| Kthen nje file temporary me objektin e detektuar.
| Ka pak margin rreth objektit qe te mos priten skajet.
|
*/
    private function cropDetectedObject(
        $imagePath,
        array $box,
        $paddingPercent = 0.06
    ) {
        if (!function_exists('imagecreatefromjpeg')) {
            return false;
        }

        $mimeType =
            mime_content_type($imagePath);

        switch ($mimeType) {

            case 'image/jpeg':
                $source =
                    @imagecreatefromjpeg(
                        $imagePath
                    );
                break;

            case 'image/png':
                $source =
                    @imagecreatefrompng(
                        $imagePath
                    );
                break;

            case 'image/webp':
                $source =
                    @imagecreatefromwebp(
                        $imagePath
                    );
                break;

            default:
                return false;
        }

        if (!$source) {
            return false;
        }

        $imageWidth =
            imagesx($source);

        $imageHeight =
            imagesy($source);

        /*
     * Gemini:
     * [ymin, xmin, ymax, xmax]
     * nga 0 deri 1000.
     */
        $yMin = $box[0] / 1000;
        $xMin = $box[1] / 1000;
        $yMax = $box[2] / 1000;
        $xMax = $box[3] / 1000;

        $x1 =
            (int)round(
                $xMin * $imageWidth
            );

        $y1 =
            (int)round(
                $yMin * $imageHeight
            );

        $x2 =
            (int)round(
                $xMax * $imageWidth
            );

        $y2 =
            (int)round(
                $yMax * $imageHeight
            );

        $width =
            $x2 - $x1;

        $height =
            $y2 - $y1;

        if (
            $width <= 0 ||
            $height <= 0
        ) {
            imagedestroy($source);
            return false;
        }

        /*
     * 6% margin rreth objektit.
     */
        $padX =
            (int)round(
                $width * $paddingPercent
            );

        $padY =
            (int)round(
                $height * $paddingPercent
            );

        $x1 =
            max(
                0,
                $x1 - $padX
            );

        $y1 =
            max(
                0,
                $y1 - $padY
            );

        $x2 =
            min(
                $imageWidth,
                $x2 + $padX
            );

        $y2 =
            min(
                $imageHeight,
                $y2 + $padY
            );

        $width =
            $x2 - $x1;

        $height =
            $y2 - $y1;

        if (
            $width < 40 ||
            $height < 40
        ) {
            imagedestroy($source);
            return false;
        }

        $crop =
            imagecrop(
                $source,
                [
                    'x' => $x1,
                    'y' => $y1,
                    'width' => $width,
                    'height' => $height
                ]
            );

        imagedestroy($source);

        if (!$crop) {
            return false;
        }

        $tempFile =
            tempnam(
                sys_get_temp_dir(),
                'visual_object_'
            );

        /*
     * tempnam krijon file pa extension,
     * prandaj krijojme JPG explicit.
     */
        $jpgFile =
            $tempFile . '.jpg';

        @unlink($tempFile);

        $saved =
            imagejpeg(
                $crop,
                $jpgFile,
                90
            );

        imagedestroy($crop);

        if (!$saved) {
            @unlink($jpgFile);
            return false;
        }

        return $jpgFile;
    }


    /*
|--------------------------------------------------------------------------
| MULTI OBJECT IMAGE SEARCH
|--------------------------------------------------------------------------
|
| Kerkon:
|
| 1. Fotografinë komplet
| 2. Cdo objekt te detektuar vecmas
|
| Pastaj:
| - bashkon rezultatet
| - heq duplicate product_id
| - mban score me te larte
|
*/
    public function searchImageMultiObject(
        $imagePath,
        $limit = 20,
        $categoryId = null,
        $maxObjects = 8
    ) {
        /*
    |--------------------------------------------------------------------------
    | BASIC VALIDATION
    |--------------------------------------------------------------------------
    */

        $limit = (int)$limit;

        if ($limit <= 0) {
            $limit = 20;
        }

        $maxObjects = (int)$maxObjects;

        if ($maxObjects <= 0) {
            $maxObjects = 8;
        }

        if ($maxObjects > 12) {
            $maxObjects = 12;
        }

        /*
     * Nga secili embedding marrim me shume kandidata.
     * Ne fund kthejme vetem top $limit.
     */
        $perSearchLimit = max(50, $limit);

        $allSearches = [];
        $tempFiles = [];


        /*
    |--------------------------------------------------------------------------
    | 1. FULL IMAGE EMBEDDING
    |--------------------------------------------------------------------------
    */

        $fullEmbedding =
            $this->createImageEmbedding(
                $imagePath
            );

        if (
            isset($fullEmbedding['status']) &&
            $fullEmbedding['status'] &&
            !empty($fullEmbedding['embedding'])
        ) {
            $allSearches[] = [
                'type' => 'full',
                'label' => 'full_image',
                'embedding' =>
                $fullEmbedding['embedding']
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | 2. DETECT OBJECTS
    |--------------------------------------------------------------------------
    */

        $detection =
            $this->detectImageObjects(
                $imagePath,
                $maxObjects
            );


        if (
            isset($detection['status']) &&
            $detection['status'] &&
            isset($detection['objects']) &&
            is_array($detection['objects']) &&
            !empty($detection['objects'])
        ) {

            foreach (
                $detection['objects']
                as $index => $object
            ) {

                /*
             * Pa box nuk kemi cfare crop-i te bejme.
             */
                if (
                    !isset($object['box_2d']) ||
                    !is_array($object['box_2d']) ||
                    count($object['box_2d']) !== 4
                ) {
                    continue;
                }


                /*
            |--------------------------------------------------------------------------
            | CROP OBJECT
            |--------------------------------------------------------------------------
            */

                $cropFile =
                    $this->cropDetectedObject(
                        $imagePath,
                        $object['box_2d'],
                        0.06
                    );


                if (!$cropFile) {
                    continue;
                }


                $tempFiles[] = $cropFile;


                /*
            |--------------------------------------------------------------------------
            | OBJECT EMBEDDING
            |--------------------------------------------------------------------------
            */

                $embeddingResult =
                    $this->createImageEmbedding(
                        $cropFile
                    );


                if (
                    !isset($embeddingResult['status']) ||
                    !$embeddingResult['status'] ||
                    empty($embeddingResult['embedding'])
                ) {
                    continue;
                }


                $allSearches[] = [
                    'type' => 'object',

                    'label' =>
                    isset($object['label']) &&
                        trim($object['label']) !== ''
                        ? $object['label']
                        : 'object_' . ($index + 1),

                    'box_2d' =>
                    $object['box_2d'],

                    'embedding' =>
                    $embeddingResult['embedding']
                ];
            }
        }


        /*
    |--------------------------------------------------------------------------
    | ASNJE EMBEDDING NUK U KRIJUA
    |--------------------------------------------------------------------------
    */

        if (empty($allSearches)) {

            foreach ($tempFiles as $file) {

                if (
                    $file &&
                    file_exists($file)
                ) {
                    @unlink($file);
                }
            }


            return [
                'status' => false,
                'message' =>
                'Nuk u krijua asnje embedding.'
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | 3. SEARCH QDRANT PER CDO EMBEDDING
    |--------------------------------------------------------------------------
    */

        $merged = [];


        foreach ($allSearches as $search) {

            /*
        |--------------------------------------------------------------------------
        | CATEGORY SEARCH / GLOBAL SEARCH
        |--------------------------------------------------------------------------
        */

            if ($categoryId !== null) {

                $result =
                    $this->searchSimilarByCategory(
                        $search['embedding'],
                        (int)$categoryId,
                        $perSearchLimit
                    );
            } else {

                $result =
                    $this->searchSimilar(
                        $search['embedding'],
                        $perSearchLimit
                    );
            }


            if (
                !isset($result['status']) ||
                !$result['status']
            ) {
                continue;
            }


            /*
        |--------------------------------------------------------------------------
        | QDRANT POINTS
        |--------------------------------------------------------------------------
        */

            $points = [];


            if (
                isset(
                    $result['data']['result']['points']
                ) &&
                is_array(
                    $result['data']['result']['points']
                )
            ) {

                $points =
                    $result['data']['result']['points'];
            }


            /*
        |--------------------------------------------------------------------------
        | MERGE BY PRODUCT ID
        |--------------------------------------------------------------------------
        */

            foreach ($points as $point) {

                $productId = null;


                /*
             * Per vectorat e rinj UUID:
             * product_id merret nga payload.
             */
                if (
                    isset(
                        $point['payload']['product_id']
                    )
                ) {

                    $productId =
                        (int)$point['payload']['product_id'];

                    /*
             * Vetem per legacy points numerike.
             * Mos tentojme UUID ta kthejme ne integer.
             */
                } elseif (
                    isset($point['id']) &&
                    is_numeric($point['id'])
                ) {

                    $productId =
                        (int)$point['id'];
                }


                if (!$productId) {
                    continue;
                }


                $score =
                    isset($point['score'])
                    ? (float)$point['score']
                    : 0;


                /*
             * I njejti produkt mund te gjendet:
             *
             * - nga full image
             * - nga object 1
             * - nga object 2
             * - etj.
             *
             * Mbajme vetem score-in me te mire.
             */
                if (
                    !isset($merged[$productId]) ||
                    $score >
                    (float)$merged[$productId]['score']
                ) {

                    $point['score'] = $score;


                    /*
                 * Debug info.
                 */
                    $point['matched_from'] =
                        $search['type'];

                    $point['matched_object'] =
                        $search['label'];


                    if (
                        isset($search['box_2d'])
                    ) {

                        $point['matched_box'] =
                            $search['box_2d'];
                    }


                    $merged[$productId] =
                        $point;
                }
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 4. CLEANUP TEMP CROPS
    |--------------------------------------------------------------------------
    */

        foreach ($tempFiles as $file) {

            if (
                $file &&
                file_exists($file)
            ) {

                @unlink($file);
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 5. SORT BY BEST SCORE
    |--------------------------------------------------------------------------
    */

        $points =
            array_values($merged);


        usort(
            $points,
            function ($a, $b) {

                $scoreA =
                    isset($a['score'])
                    ? (float)$a['score']
                    : 0;

                $scoreB =
                    isset($b['score'])
                    ? (float)$b['score']
                    : 0;


                if ($scoreA == $scoreB) {
                    return 0;
                }


                return (
                    $scoreA > $scoreB
                ) ? -1 : 1;
            }
        );


        /*
    |--------------------------------------------------------------------------
    | 6. FINAL TOP RESULTS
    |--------------------------------------------------------------------------
    */

        $points =
            array_slice(
                $points,
                0,
                $limit
            );


        /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    */

        return [
            'status' => true,

            /*
         * E ruajme strukturen qe Dashboard.php
         * vazhdon te punoje pa ndryshime.
         */
            'data' => [
                'result' => [
                    'points' => $points
                ]
            ],

            /*
         * Debug info.
         */
            'multi_object_debug' => [

                'detected_objects' =>
                isset($detection['objects']) &&
                    is_array($detection['objects'])
                    ? $detection['objects']
                    : [],

                'objects_detected' =>
                isset($detection['objects']) &&
                    is_array($detection['objects'])
                    ? count($detection['objects'])
                    : 0,

                'searches_count' =>
                count($allSearches),

                'per_search_limit' =>
                $perSearchLimit,

                'final_results_count' =>
                count($points)
            ]
        ];
    }


    public function searchSimilar(
        array $embedding,
        $limit = 20
    ) {

        $url = rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/points/query';

        $payload = [
            'query' => $embedding,
            'limit' => (int)$limit,
            'with_payload' => true,
            'with_vector' => false
        ];

        return $this->qdrantRequest(
            $url,
            'POST',
            $payload
        );
    }


    /*
    |--------------------------------------------------------------------------
    | QDRANT REQUEST
    |--------------------------------------------------------------------------
    */
    private function qdrantRequest(
        $url,
        $method,
        array $payload = []
    ) {

        $headers = [
            'Content-Type: application/json'
        ];

        if (!empty($this->qdrantApiKey)) {
            $headers[] =
                'api-key: ' .
                $this->qdrantApiKey;
        }

        return $this->request(
            $url,
            $method,
            $payload,
            $headers
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERIC CURL REQUEST
    |--------------------------------------------------------------------------
    */
    private function request(
        $url,
        $method,
        array $payload,
        array $headers
    ) {

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_CONNECTTIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        $response = curl_exec($ch);

        $curlError = curl_error($ch);
        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        curl_close($ch);

        if ($response === false) {
            return [
                'status' => false,
                'message' => $curlError
            ];
        }

        $decoded = json_decode(
            $response,
            true
        );

        if ($httpCode < 200 || $httpCode >= 300) {

            return [
                'status' => false,
                'http_code' => $httpCode,
                'message' => isset($decoded['error'])
                    ? $decoded['error']
                    : $response,
                'data' => $decoded
            ];
        }

        return [
            'status' => true,
            'http_code' => $httpCode,
            'data' => $decoded
        ];
    }

    public function searchSimilarByCategory(
        array $embedding,
        $categoryId,
        $limit = 20
    ) {
        $categoryId = (int)$categoryId;
        $limit = (int)$limit;

        $url = rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/points/query';

        $payload = [
            'query' => $embedding,

            'filter' => [
                'must' => [
                    [
                        'key' => 'category_id',
                        'match' => [
                            'value' => $categoryId
                        ]
                    ]
                ]
            ],

            'limit' => $limit,

            'with_payload' => true,

            'with_vector' => false
        ];

        return $this->qdrantRequest(
            $url,
            'POST',
            $payload
        );
    }

    public function createCategoryPayloadIndex()
    {
        $url = rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/index?wait=true';

        $payload = [
            'field_name' => 'category_id',
            'field_schema' => 'integer'
        ];

        return $this->qdrantRequest(
            $url,
            'PUT',
            $payload
        );
    }

    public function createProductIdPayloadIndex()
    {
        $url =
            rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/index?wait=true';

        $payload = [
            'field_name' => 'product_id',
            'field_schema' => 'integer'
        ];

        return $this->qdrantRequest(
            $url,
            'PUT',
            $payload
        );
    }
}
