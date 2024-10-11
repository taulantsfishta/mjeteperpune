<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/assuredworkloads/v1/assuredworkloads.proto

namespace Google\Cloud\AssuredWorkloads\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request for creating a workload.
 *
 * Generated from protobuf message <code>google.cloud.assuredworkloads.v1.CreateWorkloadRequest</code>
 */
class CreateWorkloadRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The resource name of the new Workload's parent.
     * Must be of the form `organizations/{org_id}/locations/{location_id}`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $parent = '';
    /**
     * Required. Assured Workload to create
     *
     * Generated from protobuf field <code>.google.cloud.assuredworkloads.v1.Workload workload = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $workload = null;
    /**
     * Optional. A identifier associated with the workload and underlying projects which
     * allows for the break down of billing costs for a workload. The value
     * provided for the identifier will add a label to the workload and contained
     * projects with the identifier as the value.
     *
     * Generated from protobuf field <code>string external_id = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $external_id = '';

    /**
     * @param string                                     $parent   Required. The resource name of the new Workload's parent.
     *                                                             Must be of the form `organizations/{org_id}/locations/{location_id}`. Please see
     *                                                             {@see AssuredWorkloadsServiceClient::locationName()} for help formatting this field.
     * @param \Google\Cloud\AssuredWorkloads\V1\Workload $workload Required. Assured Workload to create
     *
     * @return \Google\Cloud\AssuredWorkloads\V1\CreateWorkloadRequest
     *
     * @experimental
     */
    public static function build(string $parent, \Google\Cloud\AssuredWorkloads\V1\Workload $workload): self
    {
        return (new self())
            ->setParent($parent)
            ->setWorkload($workload);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. The resource name of the new Workload's parent.
     *           Must be of the form `organizations/{org_id}/locations/{location_id}`.
     *     @type \Google\Cloud\AssuredWorkloads\V1\Workload $workload
     *           Required. Assured Workload to create
     *     @type string $external_id
     *           Optional. A identifier associated with the workload and underlying projects which
     *           allows for the break down of billing costs for a workload. The value
     *           provided for the identifier will add a label to the workload and contained
     *           projects with the identifier as the value.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Assuredworkloads\V1\Assuredworkloads::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The resource name of the new Workload's parent.
     * Must be of the form `organizations/{org_id}/locations/{location_id}`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. The resource name of the new Workload's parent.
     * Must be of the form `organizations/{org_id}/locations/{location_id}`.
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
     * Required. Assured Workload to create
     *
     * Generated from protobuf field <code>.google.cloud.assuredworkloads.v1.Workload workload = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\AssuredWorkloads\V1\Workload|null
     */
    public function getWorkload()
    {
        return $this->workload;
    }

    public function hasWorkload()
    {
        return isset($this->workload);
    }

    public function clearWorkload()
    {
        unset($this->workload);
    }

    /**
     * Required. Assured Workload to create
     *
     * Generated from protobuf field <code>.google.cloud.assuredworkloads.v1.Workload workload = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\AssuredWorkloads\V1\Workload $var
     * @return $this
     */
    public function setWorkload($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AssuredWorkloads\V1\Workload::class);
        $this->workload = $var;

        return $this;
    }

    /**
     * Optional. A identifier associated with the workload and underlying projects which
     * allows for the break down of billing costs for a workload. The value
     * provided for the identifier will add a label to the workload and contained
     * projects with the identifier as the value.
     *
     * Generated from protobuf field <code>string external_id = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Optional. A identifier associated with the workload and underlying projects which
     * allows for the break down of billing costs for a workload. The value
     * provided for the identifier will add a label to the workload and contained
     * projects with the identifier as the value.
     *
     * Generated from protobuf field <code>string external_id = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setExternalId($var)
    {
        GPBUtil::checkString($var, True);
        $this->external_id = $var;

        return $this;
    }

}

