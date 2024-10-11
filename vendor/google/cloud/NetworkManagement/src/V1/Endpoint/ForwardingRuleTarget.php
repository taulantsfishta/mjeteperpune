<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/networkmanagement/v1/connectivity_test.proto

namespace Google\Cloud\NetworkManagement\V1\Endpoint;

use UnexpectedValueException;

/**
 * Type of the target of a forwarding rule.
 *
 * Protobuf type <code>google.cloud.networkmanagement.v1.Endpoint.ForwardingRuleTarget</code>
 */
class ForwardingRuleTarget
{
    /**
     * Forwarding rule target is unknown.
     *
     * Generated from protobuf enum <code>FORWARDING_RULE_TARGET_UNSPECIFIED = 0;</code>
     */
    const FORWARDING_RULE_TARGET_UNSPECIFIED = 0;
    /**
     * Compute Engine instance for protocol forwarding.
     *
     * Generated from protobuf enum <code>INSTANCE = 1;</code>
     */
    const INSTANCE = 1;
    /**
     * Load Balancer. The specific type can be found from [load_balancer_type]
     * [google.cloud.networkmanagement.v1.Endpoint.load_balancer_type].
     *
     * Generated from protobuf enum <code>LOAD_BALANCER = 2;</code>
     */
    const LOAD_BALANCER = 2;
    /**
     * Classic Cloud VPN Gateway.
     *
     * Generated from protobuf enum <code>VPN_GATEWAY = 3;</code>
     */
    const VPN_GATEWAY = 3;
    /**
     * Forwarding Rule is a Private Service Connect endpoint.
     *
     * Generated from protobuf enum <code>PSC = 4;</code>
     */
    const PSC = 4;

    private static $valueToName = [
        self::FORWARDING_RULE_TARGET_UNSPECIFIED => 'FORWARDING_RULE_TARGET_UNSPECIFIED',
        self::INSTANCE => 'INSTANCE',
        self::LOAD_BALANCER => 'LOAD_BALANCER',
        self::VPN_GATEWAY => 'VPN_GATEWAY',
        self::PSC => 'PSC',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

