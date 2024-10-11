<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/datalabeling/v1beta1/annotation.proto

namespace Google\Cloud\DataLabeling\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Additional information associated with the annotation.
 *
 * Generated from protobuf message <code>google.cloud.datalabeling.v1beta1.AnnotationMetadata</code>
 */
class AnnotationMetadata extends \Google\Protobuf\Internal\Message
{
    /**
     * Metadata related to human labeling.
     *
     * Generated from protobuf field <code>.google.cloud.datalabeling.v1beta1.OperatorMetadata operator_metadata = 2;</code>
     */
    private $operator_metadata = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\DataLabeling\V1beta1\OperatorMetadata $operator_metadata
     *           Metadata related to human labeling.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Datalabeling\V1Beta1\Annotation::initOnce();
        parent::__construct($data);
    }

    /**
     * Metadata related to human labeling.
     *
     * Generated from protobuf field <code>.google.cloud.datalabeling.v1beta1.OperatorMetadata operator_metadata = 2;</code>
     * @return \Google\Cloud\DataLabeling\V1beta1\OperatorMetadata|null
     */
    public function getOperatorMetadata()
    {
        return $this->operator_metadata;
    }

    public function hasOperatorMetadata()
    {
        return isset($this->operator_metadata);
    }

    public function clearOperatorMetadata()
    {
        unset($this->operator_metadata);
    }

    /**
     * Metadata related to human labeling.
     *
     * Generated from protobuf field <code>.google.cloud.datalabeling.v1beta1.OperatorMetadata operator_metadata = 2;</code>
     * @param \Google\Cloud\DataLabeling\V1beta1\OperatorMetadata $var
     * @return $this
     */
    public function setOperatorMetadata($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\DataLabeling\V1beta1\OperatorMetadata::class);
        $this->operator_metadata = $var;

        return $this;
    }

}
