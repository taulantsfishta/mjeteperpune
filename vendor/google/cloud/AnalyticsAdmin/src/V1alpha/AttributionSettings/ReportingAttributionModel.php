<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/analytics/admin/v1alpha/resources.proto

namespace Google\Analytics\Admin\V1alpha\AttributionSettings;

use UnexpectedValueException;

/**
 * The reporting attribution model used to calculate conversion credit in this
 * property's reports.
 *
 * Protobuf type <code>google.analytics.admin.v1alpha.AttributionSettings.ReportingAttributionModel</code>
 */
class ReportingAttributionModel
{
    /**
     * Reporting attribution model unspecified.
     *
     * Generated from protobuf enum <code>REPORTING_ATTRIBUTION_MODEL_UNSPECIFIED = 0;</code>
     */
    const REPORTING_ATTRIBUTION_MODEL_UNSPECIFIED = 0;
    /**
     * Data-driven attribution distributes credit for the conversion based on
     * data for each conversion event. Each Data-driven model is specific to
     * each advertiser and each conversion event.
     * Previously CROSS_CHANNEL_DATA_DRIVEN
     *
     * Generated from protobuf enum <code>PAID_AND_ORGANIC_CHANNELS_DATA_DRIVEN = 1;</code>
     */
    const PAID_AND_ORGANIC_CHANNELS_DATA_DRIVEN = 1;
    /**
     * Ignores direct traffic and attributes 100% of the conversion value to the
     * last channel that the customer clicked through (or engaged view through
     * for YouTube) before converting.
     * Previously CROSS_CHANNEL_LAST_CLICK
     *
     * Generated from protobuf enum <code>PAID_AND_ORGANIC_CHANNELS_LAST_CLICK = 2;</code>
     */
    const PAID_AND_ORGANIC_CHANNELS_LAST_CLICK = 2;
    /**
     * Starting in June 2023, new properties can no longer use this model.
     * See
     * [Analytics
     * Help](https://support.google.com/analytics/answer/9164320#040623)
     * for more details.
     * Starting in September 2023, we will sunset this model for all properties.
     * Gives all credit for the conversion to the first channel that a customer
     * clicked (or engaged view through for YouTube) before converting.
     * Previously CROSS_CHANNEL_FIRST_CLICK
     *
     * Generated from protobuf enum <code>PAID_AND_ORGANIC_CHANNELS_FIRST_CLICK = 3;</code>
     */
    const PAID_AND_ORGANIC_CHANNELS_FIRST_CLICK = 3;
    /**
     * Starting in June 2023, new properties can no longer use this model.
     * See
     * [Analytics
     * Help](https://support.google.com/analytics/answer/9164320#040623)
     * for more details.
     * Starting in September 2023, we will sunset this model for all properties.
     * Distributes the credit for the conversion equally across all the channels
     * a customer clicked (or engaged view through for YouTube) before
     * converting.
     * Previously CROSS_CHANNEL_LINEAR
     *
     * Generated from protobuf enum <code>PAID_AND_ORGANIC_CHANNELS_LINEAR = 4;</code>
     */
    const PAID_AND_ORGANIC_CHANNELS_LINEAR = 4;
    /**
     * Starting in June 2023, new properties can no longer use this model.
     * See
     * [Analytics
     * Help](https://support.google.com/analytics/answer/9164320#040623)
     * for more details.
     * Starting in September 2023, we will sunset this model for all properties.
     * Attributes 40% credit to the first and last interaction, and the
     * remaining 20% credit is distributed evenly to the middle interactions.
     * Previously CROSS_CHANNEL_POSITION_BASED
     *
     * Generated from protobuf enum <code>PAID_AND_ORGANIC_CHANNELS_POSITION_BASED = 5;</code>
     */
    const PAID_AND_ORGANIC_CHANNELS_POSITION_BASED = 5;
    /**
     * Starting in June 2023, new properties can no longer use this model.
     * See
     * [Analytics
     * Help](https://support.google.com/analytics/answer/9164320#040623)
     * for more details.
     * Starting in September 2023, we will sunset this model for all properties.
     * Gives more credit to the touchpoints that happened closer in time to
     * the conversion.
     * Previously CROSS_CHANNEL_TIME_DECAY
     *
     * Generated from protobuf enum <code>PAID_AND_ORGANIC_CHANNELS_TIME_DECAY = 6;</code>
     */
    const PAID_AND_ORGANIC_CHANNELS_TIME_DECAY = 6;
    /**
     * Attributes 100% of the conversion value to the last Google Paid channel
     * that the customer clicked through before converting.
     * Previously ADS_PREFERRED_LAST_CLICK
     *
     * Generated from protobuf enum <code>GOOGLE_PAID_CHANNELS_LAST_CLICK = 7;</code>
     */
    const GOOGLE_PAID_CHANNELS_LAST_CLICK = 7;

    private static $valueToName = [
        self::REPORTING_ATTRIBUTION_MODEL_UNSPECIFIED => 'REPORTING_ATTRIBUTION_MODEL_UNSPECIFIED',
        self::PAID_AND_ORGANIC_CHANNELS_DATA_DRIVEN => 'PAID_AND_ORGANIC_CHANNELS_DATA_DRIVEN',
        self::PAID_AND_ORGANIC_CHANNELS_LAST_CLICK => 'PAID_AND_ORGANIC_CHANNELS_LAST_CLICK',
        self::PAID_AND_ORGANIC_CHANNELS_FIRST_CLICK => 'PAID_AND_ORGANIC_CHANNELS_FIRST_CLICK',
        self::PAID_AND_ORGANIC_CHANNELS_LINEAR => 'PAID_AND_ORGANIC_CHANNELS_LINEAR',
        self::PAID_AND_ORGANIC_CHANNELS_POSITION_BASED => 'PAID_AND_ORGANIC_CHANNELS_POSITION_BASED',
        self::PAID_AND_ORGANIC_CHANNELS_TIME_DECAY => 'PAID_AND_ORGANIC_CHANNELS_TIME_DECAY',
        self::GOOGLE_PAID_CHANNELS_LAST_CLICK => 'GOOGLE_PAID_CHANNELS_LAST_CLICK',
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
class_alias(ReportingAttributionModel::class, \Google\Analytics\Admin\V1alpha\AttributionSettings_ReportingAttributionModel::class);
