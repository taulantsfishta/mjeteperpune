<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/networksecurity/v1/common.proto

namespace GPBMetadata\Google\Cloud\Networksecurity\V1;

class Common
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
,google/cloud/networksecurity/v1/common.protogoogle.cloud.networksecurity.v1google/protobuf/timestamp.proto"�
OperationMetadata4
create_time (2.google.protobuf.TimestampB�A1
end_time (2.google.protobuf.TimestampB�A
target (	B�A
verb (	B�A
status_message (	B�A#
requested_cancellation (B�A
api_version (	B�AB�
#com.google.cloud.networksecurity.v1BCommonProtoPZMcloud.google.com/go/networksecurity/apiv1/networksecuritypb;networksecuritypb�Google.Cloud.NetworkSecurity.V1�Google\\Cloud\\NetworkSecurity\\V1�"Google::Cloud::NetworkSecurity::V1bproto3'
        , true);

        static::$is_initialized = true;
    }
}

