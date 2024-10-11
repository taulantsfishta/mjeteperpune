<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/channel/v1/service.proto

namespace Google\Cloud\Channel\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for
 * [CloudChannelService.ListChannelPartnerRepricingConfigs][google.cloud.channel.v1.CloudChannelService.ListChannelPartnerRepricingConfigs].
 *
 * Generated from protobuf message <code>google.cloud.channel.v1.ListChannelPartnerRepricingConfigsRequest</code>
 */
class ListChannelPartnerRepricingConfigsRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The resource name of the account's
     * [ChannelPartnerLink][google.cloud.channel.v1.ChannelPartnerLink]. Parent
     * uses the format:
     * accounts/{account_id}/channelPartnerLinks/{channel_partner_id}.
     * Supports accounts/{account_id}/channelPartnerLinks/- to retrieve configs
     * for all channel partners.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $parent = '';
    /**
     * Optional. The maximum number of repricing configs to return. The service
     * may return fewer than this value. If unspecified, returns a maximum of 50
     * rules. The maximum value is 100; values above 100 will be coerced to 100.
     *
     * Generated from protobuf field <code>int32 page_size = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $page_size = 0;
    /**
     * Optional. A token identifying a page of results beyond the first page.
     * Obtained through
     * [ListChannelPartnerRepricingConfigsResponse.next_page_token][google.cloud.channel.v1.ListChannelPartnerRepricingConfigsResponse.next_page_token]
     * of the previous
     * [CloudChannelService.ListChannelPartnerRepricingConfigs][google.cloud.channel.v1.CloudChannelService.ListChannelPartnerRepricingConfigs]
     * call.
     *
     * Generated from protobuf field <code>string page_token = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $page_token = '';
    /**
     * Optional. A filter for
     * [CloudChannelService.ListChannelPartnerRepricingConfigs] results
     * (channel_partner_link only). You can use this filter when you support a
     * BatchGet-like query. To use the filter, you must set
     * `parent=accounts/{account_id}/channelPartnerLinks/-`.
     * Example: `channel_partner_link =
     * accounts/account_id/channelPartnerLinks/c1` OR `channel_partner_link =
     * accounts/account_id/channelPartnerLinks/c2`.
     *
     * Generated from protobuf field <code>string filter = 4 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $filter = '';

    /**
     * @param string $parent Required. The resource name of the account's
     *                       [ChannelPartnerLink][google.cloud.channel.v1.ChannelPartnerLink]. Parent
     *                       uses the format:
     *                       accounts/{account_id}/channelPartnerLinks/{channel_partner_id}.
     *                       Supports accounts/{account_id}/channelPartnerLinks/- to retrieve configs
     *                       for all channel partners. Please see
     *                       {@see CloudChannelServiceClient::channelPartnerLinkName()} for help formatting this field.
     *
     * @return \Google\Cloud\Channel\V1\ListChannelPartnerRepricingConfigsRequest
     *
     * @experimental
     */
    public static function build(string $parent): self
    {
        return (new self())
            ->setParent($parent);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. The resource name of the account's
     *           [ChannelPartnerLink][google.cloud.channel.v1.ChannelPartnerLink]. Parent
     *           uses the format:
     *           accounts/{account_id}/channelPartnerLinks/{channel_partner_id}.
     *           Supports accounts/{account_id}/channelPartnerLinks/- to retrieve configs
     *           for all channel partners.
     *     @type int $page_size
     *           Optional. The maximum number of repricing configs to return. The service
     *           may return fewer than this value. If unspecified, returns a maximum of 50
     *           rules. The maximum value is 100; values above 100 will be coerced to 100.
     *     @type string $page_token
     *           Optional. A token identifying a page of results beyond the first page.
     *           Obtained through
     *           [ListChannelPartnerRepricingConfigsResponse.next_page_token][google.cloud.channel.v1.ListChannelPartnerRepricingConfigsResponse.next_page_token]
     *           of the previous
     *           [CloudChannelService.ListChannelPartnerRepricingConfigs][google.cloud.channel.v1.CloudChannelService.ListChannelPartnerRepricingConfigs]
     *           call.
     *     @type string $filter
     *           Optional. A filter for
     *           [CloudChannelService.ListChannelPartnerRepricingConfigs] results
     *           (channel_partner_link only). You can use this filter when you support a
     *           BatchGet-like query. To use the filter, you must set
     *           `parent=accounts/{account_id}/channelPartnerLinks/-`.
     *           Example: `channel_partner_link =
     *           accounts/account_id/channelPartnerLinks/c1` OR `channel_partner_link =
     *           accounts/account_id/channelPartnerLinks/c2`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Channel\V1\Service::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The resource name of the account's
     * [ChannelPartnerLink][google.cloud.channel.v1.ChannelPartnerLink]. Parent
     * uses the format:
     * accounts/{account_id}/channelPartnerLinks/{channel_partner_id}.
     * Supports accounts/{account_id}/channelPartnerLinks/- to retrieve configs
     * for all channel partners.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. The resource name of the account's
     * [ChannelPartnerLink][google.cloud.channel.v1.ChannelPartnerLink]. Parent
     * uses the format:
     * accounts/{account_id}/channelPartnerLinks/{channel_partner_id}.
     * Supports accounts/{account_id}/channelPartnerLinks/- to retrieve configs
     * for all channel partners.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * Optional. The maximum number of repricing configs to return. The service
     * may return fewer than this value. If unspecified, returns a maximum of 50
     * rules. The maximum value is 100; values above 100 will be coerced to 100.
     *
     * Generated from protobuf field <code>int32 page_size = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return int
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * Optional. The maximum number of repricing configs to return. The service
     * may return fewer than this value. If unspecified, returns a maximum of 50
     * rules. The maximum value is 100; values above 100 will be coerced to 100.
     *
     * Generated from protobuf field <code>int32 page_size = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param int $var
     * @return $this
     */
    public function setPageSize($var)
    {
        GPBUtil::checkInt32($var);
        $this->page_size = $var;

        return $this;
    }

    /**
     * Optional. A token identifying a page of results beyond the first page.
     * Obtained through
     * [ListChannelPartnerRepricingConfigsResponse.next_page_token][google.cloud.channel.v1.ListChannelPartnerRepricingConfigsResponse.next_page_token]
     * of the previous
     * [CloudChannelService.ListChannelPartnerRepricingConfigs][google.cloud.channel.v1.CloudChannelService.ListChannelPartnerRepricingConfigs]
     * call.
     *
     * Generated from protobuf field <code>string page_token = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getPageToken()
    {
        return $this->page_token;
    }

    /**
     * Optional. A token identifying a page of results beyond the first page.
     * Obtained through
     * [ListChannelPartnerRepricingConfigsResponse.next_page_token][google.cloud.channel.v1.ListChannelPartnerRepricingConfigsResponse.next_page_token]
     * of the previous
     * [CloudChannelService.ListChannelPartnerRepricingConfigs][google.cloud.channel.v1.CloudChannelService.ListChannelPartnerRepricingConfigs]
     * call.
     *
     * Generated from protobuf field <code>string page_token = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->page_token = $var;

        return $this;
    }

    /**
     * Optional. A filter for
     * [CloudChannelService.ListChannelPartnerRepricingConfigs] results
     * (channel_partner_link only). You can use this filter when you support a
     * BatchGet-like query. To use the filter, you must set
     * `parent=accounts/{account_id}/channelPartnerLinks/-`.
     * Example: `channel_partner_link =
     * accounts/account_id/channelPartnerLinks/c1` OR `channel_partner_link =
     * accounts/account_id/channelPartnerLinks/c2`.
     *
     * Generated from protobuf field <code>string filter = 4 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Optional. A filter for
     * [CloudChannelService.ListChannelPartnerRepricingConfigs] results
     * (channel_partner_link only). You can use this filter when you support a
     * BatchGet-like query. To use the filter, you must set
     * `parent=accounts/{account_id}/channelPartnerLinks/-`.
     * Example: `channel_partner_link =
     * accounts/account_id/channelPartnerLinks/c1` OR `channel_partner_link =
     * accounts/account_id/channelPartnerLinks/c2`.
     *
     * Generated from protobuf field <code>string filter = 4 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setFilter($var)
    {
        GPBUtil::checkString($var, True);
        $this->filter = $var;

        return $this;
    }

}

