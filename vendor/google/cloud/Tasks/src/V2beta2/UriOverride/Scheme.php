<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/tasks/v2beta2/target.proto

namespace Google\Cloud\Tasks\V2beta2\UriOverride;

use UnexpectedValueException;

/**
 * The Scheme for an HTTP request. By default, it is HTTPS.
 *
 * Protobuf type <code>google.cloud.tasks.v2beta2.UriOverride.Scheme</code>
 */
class Scheme
{
    /**
     * Scheme unspecified. Defaults to HTTPS.
     *
     * Generated from protobuf enum <code>SCHEME_UNSPECIFIED = 0;</code>
     */
    const SCHEME_UNSPECIFIED = 0;
    /**
     * Convert the scheme to HTTP, e.g., https://www.google.ca will change to
     * http://www.google.ca.
     *
     * Generated from protobuf enum <code>HTTP = 1;</code>
     */
    const HTTP = 1;
    /**
     * Convert the scheme to HTTPS, e.g., http://www.google.ca will change to
     * https://www.google.ca.
     *
     * Generated from protobuf enum <code>HTTPS = 2;</code>
     */
    const HTTPS = 2;

    private static $valueToName = [
        self::SCHEME_UNSPECIFIED => 'SCHEME_UNSPECIFIED',
        self::HTTP => 'HTTP',
        self::HTTPS => 'HTTPS',
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

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Scheme::class, \Google\Cloud\Tasks\V2beta2\UriOverride_Scheme::class);
