<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/container/v1/cluster_service.proto

namespace Google\Cloud\Container\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * WorkloadPolicyConfig is the configuration of workload policy for autopilot
 * clusters.
 *
 * Generated from protobuf message <code>google.container.v1.WorkloadPolicyConfig</code>
 */
class WorkloadPolicyConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * If true, workloads can use NET_ADMIN capability.
     *
     * Generated from protobuf field <code>optional bool allow_net_admin = 1;</code>
     */
    private $allow_net_admin = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $allow_net_admin
     *           If true, workloads can use NET_ADMIN capability.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Container\V1\ClusterService::initOnce();
        parent::__construct($data);
    }

    /**
     * If true, workloads can use NET_ADMIN capability.
     *
     * Generated from protobuf field <code>optional bool allow_net_admin = 1;</code>
     * @return bool
     */
    public function getAllowNetAdmin()
    {
        return isset($this->allow_net_admin) ? $this->allow_net_admin : false;
    }

    public function hasAllowNetAdmin()
    {
        return isset($this->allow_net_admin);
    }

    public function clearAllowNetAdmin()
    {
        unset($this->allow_net_admin);
    }

    /**
     * If true, workloads can use NET_ADMIN capability.
     *
     * Generated from protobuf field <code>optional bool allow_net_admin = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setAllowNetAdmin($var)
    {
        GPBUtil::checkBool($var);
        $this->allow_net_admin = $var;

        return $this;
    }

}
