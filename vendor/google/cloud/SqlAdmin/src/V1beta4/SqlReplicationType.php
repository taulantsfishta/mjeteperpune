<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/sql/v1beta4/cloud_sql_resources.proto

namespace Google\Cloud\Sql\V1beta4;

use UnexpectedValueException;

/**
 * Protobuf type <code>google.cloud.sql.v1beta4.SqlReplicationType</code>
 */
class SqlReplicationType
{
    /**
     * This is an unknown replication type for a Cloud SQL instance.
     *
     * Generated from protobuf enum <code>SQL_REPLICATION_TYPE_UNSPECIFIED = 0;</code>
     */
    const SQL_REPLICATION_TYPE_UNSPECIFIED = 0;
    /**
     * The synchronous replication mode for First Generation instances. It is the
     * default value.
     *
     * Generated from protobuf enum <code>SYNCHRONOUS = 1;</code>
     */
    const SYNCHRONOUS = 1;
    /**
     * The asynchronous replication mode for First Generation instances. It
     * provides a slight performance gain, but if an outage occurs while this
     * option is set to asynchronous, you can lose up to a few seconds of updates
     * to your data.
     *
     * Generated from protobuf enum <code>ASYNCHRONOUS = 2;</code>
     */
    const ASYNCHRONOUS = 2;

    private static $valueToName = [
        self::SQL_REPLICATION_TYPE_UNSPECIFIED => 'SQL_REPLICATION_TYPE_UNSPECIFIED',
        self::SYNCHRONOUS => 'SYNCHRONOUS',
        self::ASYNCHRONOUS => 'ASYNCHRONOUS',
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
