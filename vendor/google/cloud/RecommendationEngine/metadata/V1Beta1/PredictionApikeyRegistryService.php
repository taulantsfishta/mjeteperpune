<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/recommendationengine/v1beta1/prediction_apikey_registry_service.proto

namespace GPBMetadata\Google\Cloud\Recommendationengine\V1Beta1;

class PredictionApikeyRegistryService
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        \GPBMetadata\Google\Api\Client::initOnce();
        \GPBMetadata\Google\Cloud\Recommendationengine\V1Beta1\RecommendationengineResources::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
Rgoogle/cloud/recommendationengine/v1beta1/prediction_apikey_registry_service.proto)google.cloud.recommendationengine.v1beta1google/api/field_behavior.protogoogle/api/resource.protogoogle/protobuf/empty.protogoogle/api/client.protoNgoogle/cloud/recommendationengine/v1beta1/recommendationengine_resources.proto"/
PredictionApiKeyRegistration
api_key (	"�
)CreatePredictionApiKeyRegistrationRequestF
parent (	B6�A�A0
.recommendationengine.googleapis.com/EventStoreu
prediction_api_key_registration (2G.google.cloud.recommendationengine.v1beta1.PredictionApiKeyRegistrationB�A"�
(ListPredictionApiKeyRegistrationsRequestF
parent (	B6�A�A0
.recommendationengine.googleapis.com/EventStore
	page_size (B�A

page_token (	B�A"�
)ListPredictionApiKeyRegistrationsResponseq
 prediction_api_key_registrations (2G.google.cloud.recommendationengine.v1beta1.PredictionApiKeyRegistration
next_page_token (	"�
)DeletePredictionApiKeyRegistrationRequestV
name (	BH�A�AB
@recommendationengine.googleapis.com/PredictionApiKeyRegistration2�
PredictionApiKeyRegistry�
"CreatePredictionApiKeyRegistrationT.google.cloud.recommendationengine.v1beta1.CreatePredictionApiKeyRegistrationRequestG.google.cloud.recommendationengine.v1beta1.PredictionApiKeyRegistration"����d"_/v1beta1/{parent=projects/*/locations/*/catalogs/*/eventStores/*}/predictionApiKeyRegistrations:*�A&parent,prediction_api_key_registration�
!ListPredictionApiKeyRegistrationsS.google.cloud.recommendationengine.v1beta1.ListPredictionApiKeyRegistrationsRequestT.google.cloud.recommendationengine.v1beta1.ListPredictionApiKeyRegistrationsResponse"p���a_/v1beta1/{parent=projects/*/locations/*/catalogs/*/eventStores/*}/predictionApiKeyRegistrations�Aparent�
"DeletePredictionApiKeyRegistrationT.google.cloud.recommendationengine.v1beta1.DeletePredictionApiKeyRegistrationRequest.google.protobuf.Empty"n���a*_/v1beta1/{name=projects/*/locations/*/catalogs/*/eventStores/*/predictionApiKeyRegistrations/*}�AnameW�A#recommendationengine.googleapis.com�A.https://www.googleapis.com/auth/cloud-platformB�
-com.google.cloud.recommendationengine.v1beta1PZacloud.google.com/go/recommendationengine/apiv1beta1/recommendationenginepb;recommendationenginepb�RECAI�)Google.Cloud.RecommendationEngine.V1Beta1�)Google\\Cloud\\RecommendationEngine\\V1beta1�,Google::Cloud::RecommendationEngine::V1beta1bproto3'
        , true);

        static::$is_initialized = true;
    }
}

