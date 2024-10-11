<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A request message for RegionSecurityPolicies.Get. See the method description for details.
 *
 * Generated from protobuf message <code>google.cloud.compute.v1.GetRegionSecurityPolicyRequest</code>
 */
class GetRegionSecurityPolicyRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Project ID for this request.
     *
     * Generated from protobuf field <code>string project = 227560217 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $project = '';
    /**
     * Name of the region scoping this request.
     *
     * Generated from protobuf field <code>string region = 138946292 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $region = '';
    /**
     * Name of the security policy to get.
     *
     * Generated from protobuf field <code>string security_policy = 171082513 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $security_policy = '';

    /**
     * @param string $project        Project ID for this request.
     * @param string $region         Name of the region scoping this request.
     * @param string $securityPolicy Name of the security policy to get.
     *
     * @return \Google\Cloud\Compute\V1\GetRegionSecurityPolicyRequest
     *
     * @experimental
     */
    public static function build(string $project, string $region, string $securityPolicy): self
    {
        return (new self())
            ->setProject($project)
            ->setRegion($region)
            ->setSecurityPolicy($securityPolicy);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $project
     *           Project ID for this request.
     *     @type string $region
     *           Name of the region scoping this request.
     *     @type string $security_policy
     *           Name of the security policy to get.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Compute\V1\Compute::initOnce();
        parent::__construct($data);
    }

    /**
     * Project ID for this request.
     *
     * Generated from protobuf field <code>string project = 227560217 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Project ID for this request.
     *
     * Generated from protobuf field <code>string project = 227560217 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setProject($var)
    {
        GPBUtil::checkString($var, True);
        $this->project = $var;

        return $this;
    }

    /**
     * Name of the region scoping this request.
     *
     * Generated from protobuf field <code>string region = 138946292 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Name of the region scoping this request.
     *
     * Generated from protobuf field <code>string region = 138946292 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setRegion($var)
    {
        GPBUtil::checkString($var, True);
        $this->region = $var;

        return $this;
    }

    /**
     * Name of the security policy to get.
     *
     * Generated from protobuf field <code>string security_policy = 171082513 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getSecurityPolicy()
    {
        return $this->security_policy;
    }

    /**
     * Name of the security policy to get.
     *
     * Generated from protobuf field <code>string security_policy = 171082513 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setSecurityPolicy($var)
    {
        GPBUtil::checkString($var, True);
        $this->security_policy = $var;

        return $this;
    }

}

