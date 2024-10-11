<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/support/v2/case_service.proto

namespace Google\Cloud\Support\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The request message for the CreateCase endpoint.
 *
 * Generated from protobuf message <code>google.cloud.support.v2.CreateCaseRequest</code>
 */
class CreateCaseRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The name of the Google Cloud Resource under which the case should
     * be created.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    protected $parent = '';
    /**
     * Required. The case to be created.
     *
     * Generated from protobuf field <code>.google.cloud.support.v2.Case case = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $case = null;

    /**
     * @param string                          $parent Required. The name of the Google Cloud Resource under which the case should
     *                                                be created. Please see
     *                                                {@see CaseServiceClient::projectName()} for help formatting this field.
     * @param \Google\Cloud\Support\V2\PBCase $case   Required. The case to be created.
     *
     * @return \Google\Cloud\Support\V2\CreateCaseRequest
     *
     * @experimental
     */
    public static function build(string $parent, \Google\Cloud\Support\V2\PBCase $case): self
    {
        return (new self())
            ->setParent($parent)
            ->setCase($case);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. The name of the Google Cloud Resource under which the case should
     *           be created.
     *     @type \Google\Cloud\Support\V2\PBCase $case
     *           Required. The case to be created.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Support\V2\CaseService::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The name of the Google Cloud Resource under which the case should
     * be created.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. The name of the Google Cloud Resource under which the case should
     * be created.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * Required. The case to be created.
     *
     * Generated from protobuf field <code>.google.cloud.support.v2.Case case = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Support\V2\PBCase|null
     */
    public function getCase()
    {
        return $this->case;
    }

    public function hasCase()
    {
        return isset($this->case);
    }

    public function clearCase()
    {
        unset($this->case);
    }

    /**
     * Required. The case to be created.
     *
     * Generated from protobuf field <code>.google.cloud.support.v2.Case case = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Support\V2\PBCase $var
     * @return $this
     */
    public function setCase($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Support\V2\PBCase::class);
        $this->case = $var;

        return $this;
    }

}

