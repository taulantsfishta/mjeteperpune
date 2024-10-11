<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/migrationcenter/v1/migrationcenter.proto

namespace Google\Cloud\MigrationCenter\V1\ImportJob;

use UnexpectedValueException;

/**
 * Enumerates possible states of an import job.
 *
 * Protobuf type <code>google.cloud.migrationcenter.v1.ImportJob.ImportJobState</code>
 */
class ImportJobState
{
    /**
     * Default value.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_UNSPECIFIED = 0;</code>
     */
    const IMPORT_JOB_STATE_UNSPECIFIED = 0;
    /**
     * The import job is pending.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_PENDING = 1;</code>
     */
    const IMPORT_JOB_STATE_PENDING = 1;
    /**
     * The processing of the import job is ongoing.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_RUNNING = 2;</code>
     */
    const IMPORT_JOB_STATE_RUNNING = 2;
    /**
     * The import job processing has completed.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_COMPLETED = 3;</code>
     */
    const IMPORT_JOB_STATE_COMPLETED = 3;
    /**
     * The import job failed to be processed.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_FAILED = 4;</code>
     */
    const IMPORT_JOB_STATE_FAILED = 4;
    /**
     * The import job is being validated.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_VALIDATING = 5;</code>
     */
    const IMPORT_JOB_STATE_VALIDATING = 5;
    /**
     * The import job contains blocking errors.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_FAILED_VALIDATION = 6;</code>
     */
    const IMPORT_JOB_STATE_FAILED_VALIDATION = 6;
    /**
     * The validation of the job completed with no blocking errors.
     *
     * Generated from protobuf enum <code>IMPORT_JOB_STATE_READY = 7;</code>
     */
    const IMPORT_JOB_STATE_READY = 7;

    private static $valueToName = [
        self::IMPORT_JOB_STATE_UNSPECIFIED => 'IMPORT_JOB_STATE_UNSPECIFIED',
        self::IMPORT_JOB_STATE_PENDING => 'IMPORT_JOB_STATE_PENDING',
        self::IMPORT_JOB_STATE_RUNNING => 'IMPORT_JOB_STATE_RUNNING',
        self::IMPORT_JOB_STATE_COMPLETED => 'IMPORT_JOB_STATE_COMPLETED',
        self::IMPORT_JOB_STATE_FAILED => 'IMPORT_JOB_STATE_FAILED',
        self::IMPORT_JOB_STATE_VALIDATING => 'IMPORT_JOB_STATE_VALIDATING',
        self::IMPORT_JOB_STATE_FAILED_VALIDATION => 'IMPORT_JOB_STATE_FAILED_VALIDATION',
        self::IMPORT_JOB_STATE_READY => 'IMPORT_JOB_STATE_READY',
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


