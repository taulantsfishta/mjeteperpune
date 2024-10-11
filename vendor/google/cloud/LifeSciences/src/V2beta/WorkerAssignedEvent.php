<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/lifesciences/v2beta/workflows.proto

namespace Google\Cloud\LifeSciences\V2beta;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * An event generated after a worker VM has been assigned to run the
 * pipeline.
 *
 * Generated from protobuf message <code>google.cloud.lifesciences.v2beta.WorkerAssignedEvent</code>
 */
class WorkerAssignedEvent extends \Google\Protobuf\Internal\Message
{
    /**
     * The zone the worker is running in.
     *
     * Generated from protobuf field <code>string zone = 1;</code>
     */
    private $zone = '';
    /**
     * The worker's instance name.
     *
     * Generated from protobuf field <code>string instance = 2;</code>
     */
    private $instance = '';
    /**
     * The machine type that was assigned for the worker.
     *
     * Generated from protobuf field <code>string machine_type = 3;</code>
     */
    private $machine_type = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $zone
     *           The zone the worker is running in.
     *     @type string $instance
     *           The worker's instance name.
     *     @type string $machine_type
     *           The machine type that was assigned for the worker.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Lifesciences\V2Beta\Workflows::initOnce();
        parent::__construct($data);
    }

    /**
     * The zone the worker is running in.
     *
     * Generated from protobuf field <code>string zone = 1;</code>
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * The zone the worker is running in.
     *
     * Generated from protobuf field <code>string zone = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setZone($var)
    {
        GPBUtil::checkString($var, True);
        $this->zone = $var;

        return $this;
    }

    /**
     * The worker's instance name.
     *
     * Generated from protobuf field <code>string instance = 2;</code>
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * The worker's instance name.
     *
     * Generated from protobuf field <code>string instance = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setInstance($var)
    {
        GPBUtil::checkString($var, True);
        $this->instance = $var;

        return $this;
    }

    /**
     * The machine type that was assigned for the worker.
     *
     * Generated from protobuf field <code>string machine_type = 3;</code>
     * @return string
     */
    public function getMachineType()
    {
        return $this->machine_type;
    }

    /**
     * The machine type that was assigned for the worker.
     *
     * Generated from protobuf field <code>string machine_type = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setMachineType($var)
    {
        GPBUtil::checkString($var, True);
        $this->machine_type = $var;

        return $this;
    }

}

