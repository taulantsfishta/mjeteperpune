<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/speech/v2/cloud_speech.proto

namespace Google\Cloud\Speech\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for the
 * [GetCustomClass][google.cloud.speech.v2.Speech.GetCustomClass] method.
 *
 * Generated from protobuf message <code>google.cloud.speech.v2.GetCustomClassRequest</code>
 */
class GetCustomClassRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The name of the CustomClass to retrieve. The expected format is
     * `projects/{project}/locations/{location}/customClasses/{custom_class}`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $name = '';

    /**
     * @param string $name Required. The name of the CustomClass to retrieve. The expected format is
     *                     `projects/{project}/locations/{location}/customClasses/{custom_class}`. Please see
     *                     {@see SpeechClient::customClassName()} for help formatting this field.
     *
     * @return \Google\Cloud\Speech\V2\GetCustomClassRequest
     *
     * @experimental
     */
    public static function build(string $name): self
    {
        return (new self())
            ->setName($name);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           Required. The name of the CustomClass to retrieve. The expected format is
     *           `projects/{project}/locations/{location}/customClasses/{custom_class}`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Speech\V2\CloudSpeech::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The name of the CustomClass to retrieve. The expected format is
     * `projects/{project}/locations/{location}/customClasses/{custom_class}`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. The name of the CustomClass to retrieve. The expected format is
     * `projects/{project}/locations/{location}/customClasses/{custom_class}`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

}

