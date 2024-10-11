<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/sql/v1beta4/cloud_sql_resources.proto

namespace Google\Cloud\Sql\V1beta4;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Instance rotate server CA context.
 *
 * Generated from protobuf message <code>google.cloud.sql.v1beta4.RotateServerCaContext</code>
 */
class RotateServerCaContext extends \Google\Protobuf\Internal\Message
{
    /**
     * This is always `sql#rotateServerCaContext`.
     *
     * Generated from protobuf field <code>string kind = 1;</code>
     */
    private $kind = '';
    /**
     * The fingerprint of the next version to be rotated to. If left unspecified,
     * will be rotated to the most recently added server CA version.
     *
     * Generated from protobuf field <code>string next_version = 2;</code>
     */
    private $next_version = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $kind
     *           This is always `sql#rotateServerCaContext`.
     *     @type string $next_version
     *           The fingerprint of the next version to be rotated to. If left unspecified,
     *           will be rotated to the most recently added server CA version.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Sql\V1Beta4\CloudSqlResources::initOnce();
        parent::__construct($data);
    }

    /**
     * This is always `sql#rotateServerCaContext`.
     *
     * Generated from protobuf field <code>string kind = 1;</code>
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * This is always `sql#rotateServerCaContext`.
     *
     * Generated from protobuf field <code>string kind = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setKind($var)
    {
        GPBUtil::checkString($var, True);
        $this->kind = $var;

        return $this;
    }

    /**
     * The fingerprint of the next version to be rotated to. If left unspecified,
     * will be rotated to the most recently added server CA version.
     *
     * Generated from protobuf field <code>string next_version = 2;</code>
     * @return string
     */
    public function getNextVersion()
    {
        return $this->next_version;
    }

    /**
     * The fingerprint of the next version to be rotated to. If left unspecified,
     * will be rotated to the most recently added server CA version.
     *
     * Generated from protobuf field <code>string next_version = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextVersion($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_version = $var;

        return $this;
    }

}

