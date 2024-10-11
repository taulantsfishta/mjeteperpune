<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/billing/budgets/v1/budget_model.proto

namespace Google\Cloud\Billing\Budgets\V1\Filter;

use UnexpectedValueException;

/**
 * Specifies how credits are applied when determining the spend for
 * threshold calculations. Budgets track the total cost minus any applicable
 * selected credits.
 * [See the documentation for a list of credit
 * types](https://cloud.google.com/billing/docs/how-to/export-data-bigquery-tables#credits-type).
 *
 * Protobuf type <code>google.cloud.billing.budgets.v1.Filter.CreditTypesTreatment</code>
 */
class CreditTypesTreatment
{
    /**
     * Generated from protobuf enum <code>CREDIT_TYPES_TREATMENT_UNSPECIFIED = 0;</code>
     */
    const CREDIT_TYPES_TREATMENT_UNSPECIFIED = 0;
    /**
     * All types of credit are subtracted from the gross cost to determine the
     * spend for threshold calculations.
     *
     * Generated from protobuf enum <code>INCLUDE_ALL_CREDITS = 1;</code>
     */
    const INCLUDE_ALL_CREDITS = 1;
    /**
     * All types of credit are added to the net cost to determine the spend for
     * threshold calculations.
     *
     * Generated from protobuf enum <code>EXCLUDE_ALL_CREDITS = 2;</code>
     */
    const EXCLUDE_ALL_CREDITS = 2;
    /**
     * [Credit
     * types](https://cloud.google.com/billing/docs/how-to/export-data-bigquery-tables#credits-type)
     * specified in the credit_types field are subtracted from the
     * gross cost to determine the spend for threshold calculations.
     *
     * Generated from protobuf enum <code>INCLUDE_SPECIFIED_CREDITS = 3;</code>
     */
    const INCLUDE_SPECIFIED_CREDITS = 3;

    private static $valueToName = [
        self::CREDIT_TYPES_TREATMENT_UNSPECIFIED => 'CREDIT_TYPES_TREATMENT_UNSPECIFIED',
        self::INCLUDE_ALL_CREDITS => 'INCLUDE_ALL_CREDITS',
        self::EXCLUDE_ALL_CREDITS => 'EXCLUDE_ALL_CREDITS',
        self::INCLUDE_SPECIFIED_CREDITS => 'INCLUDE_SPECIFIED_CREDITS',
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


