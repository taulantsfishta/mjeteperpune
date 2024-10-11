<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/identity/accesscontextmanager/v1/access_context_manager.proto

namespace Google\Identity\AccessContextManager\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A request to create an `AccessLevel`.
 *
 * Generated from protobuf message <code>google.identity.accesscontextmanager.v1.CreateAccessLevelRequest</code>
 */
class CreateAccessLevelRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. Resource name for the access policy which owns this [Access
     * Level] [google.identity.accesscontextmanager.v1.AccessLevel].
     * Format: `accessPolicies/{policy_id}`
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $parent = '';
    /**
     * Required. The [Access Level]
     * [google.identity.accesscontextmanager.v1.AccessLevel] to create.
     * Syntactic correctness of the [Access Level]
     * [google.identity.accesscontextmanager.v1.AccessLevel] is a
     * precondition for creation.
     *
     * Generated from protobuf field <code>.google.identity.accesscontextmanager.v1.AccessLevel access_level = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $access_level = null;

    /**
     * @param string                                               $parent      Required. Resource name for the access policy which owns this [Access
     *                                                                          Level] [google.identity.accesscontextmanager.v1.AccessLevel].
     *
     *                                                                          Format: `accessPolicies/{policy_id}`
     *                                                                          Please see {@see AccessContextManagerClient::accessPolicyName()} for help formatting this field.
     * @param \Google\Identity\AccessContextManager\V1\AccessLevel $accessLevel Required. The [Access Level]
     *                                                                          [google.identity.accesscontextmanager.v1.AccessLevel] to create.
     *                                                                          Syntactic correctness of the [Access Level]
     *                                                                          [google.identity.accesscontextmanager.v1.AccessLevel] is a
     *                                                                          precondition for creation.
     *
     * @return \Google\Identity\AccessContextManager\V1\CreateAccessLevelRequest
     *
     * @experimental
     */
    public static function build(string $parent, \Google\Identity\AccessContextManager\V1\AccessLevel $accessLevel): self
    {
        return (new self())
            ->setParent($parent)
            ->setAccessLevel($accessLevel);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. Resource name for the access policy which owns this [Access
     *           Level] [google.identity.accesscontextmanager.v1.AccessLevel].
     *           Format: `accessPolicies/{policy_id}`
     *     @type \Google\Identity\AccessContextManager\V1\AccessLevel $access_level
     *           Required. The [Access Level]
     *           [google.identity.accesscontextmanager.v1.AccessLevel] to create.
     *           Syntactic correctness of the [Access Level]
     *           [google.identity.accesscontextmanager.v1.AccessLevel] is a
     *           precondition for creation.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Identity\Accesscontextmanager\V1\AccessContextManager::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. Resource name for the access policy which owns this [Access
     * Level] [google.identity.accesscontextmanager.v1.AccessLevel].
     * Format: `accessPolicies/{policy_id}`
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. Resource name for the access policy which owns this [Access
     * Level] [google.identity.accesscontextmanager.v1.AccessLevel].
     * Format: `accessPolicies/{policy_id}`
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
     * Required. The [Access Level]
     * [google.identity.accesscontextmanager.v1.AccessLevel] to create.
     * Syntactic correctness of the [Access Level]
     * [google.identity.accesscontextmanager.v1.AccessLevel] is a
     * precondition for creation.
     *
     * Generated from protobuf field <code>.google.identity.accesscontextmanager.v1.AccessLevel access_level = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Identity\AccessContextManager\V1\AccessLevel|null
     */
    public function getAccessLevel()
    {
        return $this->access_level;
    }

    public function hasAccessLevel()
    {
        return isset($this->access_level);
    }

    public function clearAccessLevel()
    {
        unset($this->access_level);
    }

    /**
     * Required. The [Access Level]
     * [google.identity.accesscontextmanager.v1.AccessLevel] to create.
     * Syntactic correctness of the [Access Level]
     * [google.identity.accesscontextmanager.v1.AccessLevel] is a
     * precondition for creation.
     *
     * Generated from protobuf field <code>.google.identity.accesscontextmanager.v1.AccessLevel access_level = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Identity\AccessContextManager\V1\AccessLevel $var
     * @return $this
     */
    public function setAccessLevel($var)
    {
        GPBUtil::checkMessage($var, \Google\Identity\AccessContextManager\V1\AccessLevel::class);
        $this->access_level = $var;

        return $this;
    }

}

