<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/beyondcorp/clientgateways/v1/client_gateways_service.proto

namespace Google\Cloud\BeyondCorp\ClientGateways\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Message for response to listing ClientGateways.
 *
 * Generated from protobuf message <code>google.cloud.beyondcorp.clientgateways.v1.ListClientGatewaysResponse</code>
 */
class ListClientGatewaysResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The list of ClientGateway.
     *
     * Generated from protobuf field <code>repeated .google.cloud.beyondcorp.clientgateways.v1.ClientGateway client_gateways = 1;</code>
     */
    private $client_gateways;
    /**
     * A token identifying a page of results the server should return.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     */
    private $next_page_token = '';
    /**
     * Locations that could not be reached.
     *
     * Generated from protobuf field <code>repeated string unreachable = 3;</code>
     */
    private $unreachable;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\BeyondCorp\ClientGateways\V1\ClientGateway>|\Google\Protobuf\Internal\RepeatedField $client_gateways
     *           The list of ClientGateway.
     *     @type string $next_page_token
     *           A token identifying a page of results the server should return.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $unreachable
     *           Locations that could not be reached.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Beyondcorp\Clientgateways\V1\ClientGatewaysService::initOnce();
        parent::__construct($data);
    }

    /**
     * The list of ClientGateway.
     *
     * Generated from protobuf field <code>repeated .google.cloud.beyondcorp.clientgateways.v1.ClientGateway client_gateways = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getClientGateways()
    {
        return $this->client_gateways;
    }

    /**
     * The list of ClientGateway.
     *
     * Generated from protobuf field <code>repeated .google.cloud.beyondcorp.clientgateways.v1.ClientGateway client_gateways = 1;</code>
     * @param array<\Google\Cloud\BeyondCorp\ClientGateways\V1\ClientGateway>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setClientGateways($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\BeyondCorp\ClientGateways\V1\ClientGateway::class);
        $this->client_gateways = $arr;

        return $this;
    }

    /**
     * A token identifying a page of results the server should return.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->next_page_token;
    }

    /**
     * A token identifying a page of results the server should return.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_page_token = $var;

        return $this;
    }

    /**
     * Locations that could not be reached.
     *
     * Generated from protobuf field <code>repeated string unreachable = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getUnreachable()
    {
        return $this->unreachable;
    }

    /**
     * Locations that could not be reached.
     *
     * Generated from protobuf field <code>repeated string unreachable = 3;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setUnreachable($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->unreachable = $arr;

        return $this;
    }

}

