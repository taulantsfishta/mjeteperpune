<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/networkconnectivity/v1/hub.proto

namespace Google\Cloud\NetworkConnectivity\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The request for
 * [HubService.DeleteSpoke][google.cloud.networkconnectivity.v1.HubService.DeleteSpoke].
 *
 * Generated from protobuf message <code>google.cloud.networkconnectivity.v1.DeleteSpokeRequest</code>
 */
class DeleteSpokeRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The name of the spoke to delete.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $name = '';
    /**
     * Optional. A unique request ID (optional). If you specify this ID, you can
     * use it in cases when you need to retry your request. When you need to
     * retry, this ID lets the server know that it can ignore the request if it
     * has already been completed. The server guarantees that for at least 60
     * minutes after the first request.
     * For example, consider a situation where you make an initial request and
     * the request times out. If you make the request again with the same request
     * ID, the server can check to see whether the original operation
     * was received. If it was, the server ignores the second request. This
     * behavior prevents clients from mistakenly creating duplicate commitments.
     * The request ID must be a valid UUID, with the exception that zero UUID is
     * not supported (00000000-0000-0000-0000-000000000000).
     *
     * Generated from protobuf field <code>string request_id = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $request_id = '';

    /**
     * @param string $name Required. The name of the spoke to delete. Please see
     *                     {@see HubServiceClient::spokeName()} for help formatting this field.
     *
     * @return \Google\Cloud\NetworkConnectivity\V1\DeleteSpokeRequest
     *
     * @experimental
     */
    public static function build(string $name): self
    {
        return (new self())
            ->setName($name);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           Required. The name of the spoke to delete.
     *     @type string $request_id
     *           Optional. A unique request ID (optional). If you specify this ID, you can
     *           use it in cases when you need to retry your request. When you need to
     *           retry, this ID lets the server know that it can ignore the request if it
     *           has already been completed. The server guarantees that for at least 60
     *           minutes after the first request.
     *           For example, consider a situation where you make an initial request and
     *           the request times out. If you make the request again with the same request
     *           ID, the server can check to see whether the original operation
     *           was received. If it was, the server ignores the second request. This
     *           behavior prevents clients from mistakenly creating duplicate commitments.
     *           The request ID must be a valid UUID, with the exception that zero UUID is
     *           not supported (00000000-0000-0000-0000-000000000000).
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Networkconnectivity\V1\Hub::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The name of the spoke to delete.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. The name of the spoke to delete.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Optional. A unique request ID (optional). If you specify this ID, you can
     * use it in cases when you need to retry your request. When you need to
     * retry, this ID lets the server know that it can ignore the request if it
     * has already been completed. The server guarantees that for at least 60
     * minutes after the first request.
     * For example, consider a situation where you make an initial request and
     * the request times out. If you make the request again with the same request
     * ID, the server can check to see whether the original operation
     * was received. If it was, the server ignores the second request. This
     * behavior prevents clients from mistakenly creating duplicate commitments.
     * The request ID must be a valid UUID, with the exception that zero UUID is
     * not supported (00000000-0000-0000-0000-000000000000).
     *
     * Generated from protobuf field <code>string request_id = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * Optional. A unique request ID (optional). If you specify this ID, you can
     * use it in cases when you need to retry your request. When you need to
     * retry, this ID lets the server know that it can ignore the request if it
     * has already been completed. The server guarantees that for at least 60
     * minutes after the first request.
     * For example, consider a situation where you make an initial request and
     * the request times out. If you make the request again with the same request
     * ID, the server can check to see whether the original operation
     * was received. If it was, the server ignores the second request. This
     * behavior prevents clients from mistakenly creating duplicate commitments.
     * The request ID must be a valid UUID, with the exception that zero UUID is
     * not supported (00000000-0000-0000-0000-000000000000).
     *
     * Generated from protobuf field <code>string request_id = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setRequestId($var)
    {
        GPBUtil::checkString($var, True);
        $this->request_id = $var;

        return $this;
    }

}

