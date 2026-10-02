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

        $imageData = base64_encode(file_get_contents($imagePath));

        $url =
            'https://generativelanguage.googleapis.com/v1beta/models/' .
            'gemini-embedding-2:embedContent';

        $payload = [
            'content' => [
                'parts' => [
                    [
                        'inline_data' => [
                            'mime_type' => $mimeType,
                            'data' => $imageData
                        ]
                    ]
                ]
            ],
            'output_dimensionality' => 768
        ];

        $response = $this->request(
            $url,
            'POST',
            $payload,
            [
                'Content-Type: application/json',
                'x-goog-api-key: ' . $this->geminiApiKey
            ]
        );

        if (!$response['status']) {
            return $response;
        }

        $body = $response['data'];

        /*
         * Gemini response normalisht kthen:
         *
         * embeddings[0].values
         *
         * por e kontrollojme edhe formen alternative embedding.values
         */

        if (
            isset($body['embeddings'][0]['values']) &&
            is_array($body['embeddings'][0]['values'])
        ) {
            return [
                'status' => true,
                'embedding' => $body['embeddings'][0]['values']
            ];
        }

        if (
            isset($body['embedding']['values']) &&
            is_array($body['embedding']['values'])
        ) {
            return [
                'status' => true,
                'embedding' => $body['embedding']['values']
            ];
        }

        return [
            'status' => false,
            'message' => 'Gemini nuk ktheu embedding.',
            'response' => $body
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
    public function saveProductVector(
        $productId,
        array $embedding,
        array $productData = []
    ) {

        $url = rtrim($this->qdrantUrl, '/') .
            '/collections/' .
            $this->collection .
            '/points?wait=true';

        $payload = [
            'points' => [
                [
                    'id' => (int)$productId,

                    'vector' => $embedding,

                    'payload' => [
                        'product_id' => (int)$productId,
                        'code' => isset($productData['code'])
                            ? $productData['code']
                            : null,
                        'name' => isset($productData['name'])
                            ? $productData['name']
                            : null,
                        'category_id' => isset($productData['category_id'])
                            ? (int)$productData['category_id']
                            : null,
                        'image' => isset($productData['image'])
                            ? $productData['image']
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
    | SEARCH SIMILAR PRODUCTS
    |--------------------------------------------------------------------------
    */
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
}
