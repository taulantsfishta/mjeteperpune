<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/aiplatform/v1/migratable_resource.proto

namespace GPBMetadata\Google\Cloud\Aiplatform\V1;

class MigratableResource
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
4google/cloud/aiplatform/v1/migratable_resource.protogoogle.cloud.aiplatform.v1google/api/resource.protogoogle/protobuf/timestamp.proto"�	
MigratableResourcek
ml_engine_model_version (2C.google.cloud.aiplatform.v1.MigratableResource.MlEngineModelVersionB�AH W
automl_model (2:.google.cloud.aiplatform.v1.MigratableResource.AutomlModelB�AH [
automl_dataset (2<.google.cloud.aiplatform.v1.MigratableResource.AutomlDatasetB�AH h
data_labeling_dataset (2B.google.cloud.aiplatform.v1.MigratableResource.DataLabelingDatasetB�AH :
last_migrate_time (2.google.protobuf.TimestampB�A9
last_update_time (2.google.protobuf.TimestampB�AY
MlEngineModelVersion
endpoint (	/
version (	B�A
ml.googleapis.com/VersionZ
AutomlModel/
model (	B �A
automl.googleapis.com/Model
model_display_name (	b
AutomlDataset3
dataset (	B"�A
automl.googleapis.com/Dataset
dataset_display_name (	�
DataLabelingDataset9
dataset (	B(�A%
#datalabeling.googleapis.com/Dataset
dataset_display_name (	�
 data_labeling_annotated_datasets (2_.google.cloud.aiplatform.v1.MigratableResource.DataLabelingDataset.DataLabelingAnnotatedDataset�
DataLabelingAnnotatedDatasetL
annotated_dataset (	B1�A.
,datalabeling.googleapis.com/AnnotatedDataset&
annotated_dataset_display_name (	B

resourceB�
com.google.cloud.aiplatform.v1BMigratableResourceProtoPZ>cloud.google.com/go/aiplatform/apiv1/aiplatformpb;aiplatformpb�Google.Cloud.AIPlatform.V1�Google\\Cloud\\AIPlatform\\V1�Google::Cloud::AIPlatform::V1�AQ
ml.googleapis.com/Version4projects/{project}/models/{model}/versions/{version}�AU
automl.googleapis.com/Model6projects/{project}/locations/{location}/models/{model}�A[
automl.googleapis.com/Dataset:projects/{project}/locations/{location}/datasets/{dataset}�AL
#datalabeling.googleapis.com/Dataset%projects/{project}/datasets/{dataset}�A{
,datalabeling.googleapis.com/AnnotatedDatasetKprojects/{project}/datasets/{dataset}/annotatedDatasets/{annotated_dataset}bproto3'
        , true);

        static::$is_initialized = true;
    }
}

