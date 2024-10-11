<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/aiplatform/v1/metadata_store.proto

namespace Google\Cloud\AIPlatform\V1\MetadataStore;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents state information for a MetadataStore.
 *
 * Generated from protobuf message <code>google.cloud.aiplatform.v1.MetadataStore.MetadataStoreState</code>
 */
class MetadataStoreState extends \Google\Protobuf\Internal\Message
{
    /**
     * The disk utilization of the MetadataStore in bytes.
     *
     * Generated from protobuf field <code>int64 disk_utilization_bytes = 1;</code>
     */
    private $disk_utilization_bytes = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $disk_utilization_bytes
     *           The disk utilization of the MetadataStore in bytes.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Aiplatform\V1\MetadataStore::initOnce();
        parent::__construct($data);
    }

    /**
     * The disk utilization of the MetadataStore in bytes.
     *
     * Generated from protobuf field <code>int64 disk_utilization_bytes = 1;</code>
     * @return int|string
     */
    public function getDiskUtilizationBytes()
    {
        return $this->disk_utilization_bytes;
    }

    /**
     * The disk utilization of the MetadataStore in bytes.
     *
     * Generated from protobuf field <code>int64 disk_utilization_bytes = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setDiskUtilizationBytes($var)
    {
        GPBUtil::checkInt64($var);
        $this->disk_utilization_bytes = $var;

        return $this;
    }

}

