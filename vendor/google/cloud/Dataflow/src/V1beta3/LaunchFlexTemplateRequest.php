<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/dataflow/v1beta3/templates.proto

namespace Google\Cloud\Dataflow\V1beta3;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A request to launch a Cloud Dataflow job from a FlexTemplate.
 *
 * Generated from protobuf message <code>google.dataflow.v1beta3.LaunchFlexTemplateRequest</code>
 */
class LaunchFlexTemplateRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The ID of the Cloud Platform project that the job belongs to.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     */
    private $project_id = '';
    /**
     * Required. Parameter to launch a job form Flex Template.
     *
     * Generated from protobuf field <code>.google.dataflow.v1beta3.LaunchFlexTemplateParameter launch_parameter = 2;</code>
     */
    private $launch_parameter = null;
    /**
     * Required. The [regional endpoint]
     * (https://cloud.google.com/dataflow/docs/concepts/regional-endpoints) to
     * which to direct the request. E.g., us-central1, us-west1.
     *
     * Generated from protobuf field <code>string location = 3;</code>
     */
    private $location = '';
    /**
     * If true, the request is validated but not actually executed.
     * Defaults to false.
     *
     * Generated from protobuf field <code>bool validate_only = 4;</code>
     */
    private $validate_only = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $project_id
     *           Required. The ID of the Cloud Platform project that the job belongs to.
     *     @type \Google\Cloud\Dataflow\V1beta3\LaunchFlexTemplateParameter $launch_parameter
     *           Required. Parameter to launch a job form Flex Template.
     *     @type string $location
     *           Required. The [regional endpoint]
     *           (https://cloud.google.com/dataflow/docs/concepts/regional-endpoints) to
     *           which to direct the request. E.g., us-central1, us-west1.
     *     @type bool $validate_only
     *           If true, the request is validated but not actually executed.
     *           Defaults to false.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Dataflow\V1Beta3\Templates::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The ID of the Cloud Platform project that the job belongs to.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Required. The ID of the Cloud Platform project that the job belongs to.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setProjectId($var)
    {
        GPBUtil::checkString($var, True);
        $this->project_id = $var;

        return $this;
    }

    /**
     * Required. Parameter to launch a job form Flex Template.
     *
     * Generated from protobuf field <code>.google.dataflow.v1beta3.LaunchFlexTemplateParameter launch_parameter = 2;</code>
     * @return \Google\Cloud\Dataflow\V1beta3\LaunchFlexTemplateParameter|null
     */
    public function getLaunchParameter()
    {
        return $this->launch_parameter;
    }

    public function hasLaunchParameter()
    {
        return isset($this->launch_parameter);
    }

    public function clearLaunchParameter()
    {
        unset($this->launch_parameter);
    }

    /**
     * Required. Parameter to launch a job form Flex Template.
     *
     * Generated from protobuf field <code>.google.dataflow.v1beta3.LaunchFlexTemplateParameter launch_parameter = 2;</code>
     * @param \Google\Cloud\Dataflow\V1beta3\LaunchFlexTemplateParameter $var
     * @return $this
     */
    public function setLaunchParameter($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dataflow\V1beta3\LaunchFlexTemplateParameter::class);
        $this->launch_parameter = $var;

        return $this;
    }

    /**
     * Required. The [regional endpoint]
     * (https://cloud.google.com/dataflow/docs/concepts/regional-endpoints) to
     * which to direct the request. E.g., us-central1, us-west1.
     *
     * Generated from protobuf field <code>string location = 3;</code>
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Required. The [regional endpoint]
     * (https://cloud.google.com/dataflow/docs/concepts/regional-endpoints) to
     * which to direct the request. E.g., us-central1, us-west1.
     *
     * Generated from protobuf field <code>string location = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setLocation($var)
    {
        GPBUtil::checkString($var, True);
        $this->location = $var;

        return $this;
    }

    /**
     * If true, the request is validated but not actually executed.
     * Defaults to false.
     *
     * Generated from protobuf field <code>bool validate_only = 4;</code>
     * @return bool
     */
    public function getValidateOnly()
    {
        return $this->validate_only;
    }

    /**
     * If true, the request is validated but not actually executed.
     * Defaults to false.
     *
     * Generated from protobuf field <code>bool validate_only = 4;</code>
     * @param bool $var
     * @return $this
     */
    public function setValidateOnly($var)
    {
        GPBUtil::checkBool($var);
        $this->validate_only = $var;

        return $this;
    }

}

