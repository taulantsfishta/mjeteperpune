<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/oslogin/v1beta/oslogin.proto

namespace Google\Cloud\OsLogin\V1beta;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A request message for importing an SSH public key.
 *
 * Generated from protobuf message <code>google.cloud.oslogin.v1beta.ImportSshPublicKeyRequest</code>
 */
class ImportSshPublicKeyRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The unique ID for the user in format `users/{user}`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.resource_reference) = {</code>
     */
    private $parent = '';
    /**
     * Required. The SSH public key and expiration time.
     *
     * Generated from protobuf field <code>.google.cloud.oslogin.common.SshPublicKey ssh_public_key = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $ssh_public_key = null;
    /**
     * The project ID of the Google Cloud Platform project.
     *
     * Generated from protobuf field <code>string project_id = 3;</code>
     */
    private $project_id = '';
    /**
     * The view configures whether to retrieve security keys information.
     *
     * Generated from protobuf field <code>.google.cloud.oslogin.v1beta.LoginProfileView view = 4;</code>
     */
    private $view = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           The unique ID for the user in format `users/{user}`.
     *     @type \Google\Cloud\OsLogin\Common\SshPublicKey $ssh_public_key
     *           Required. The SSH public key and expiration time.
     *     @type string $project_id
     *           The project ID of the Google Cloud Platform project.
     *     @type int $view
     *           The view configures whether to retrieve security keys information.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Oslogin\V1Beta\Oslogin::initOnce();
        parent::__construct($data);
    }

    /**
     * The unique ID for the user in format `users/{user}`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * The unique ID for the user in format `users/{user}`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.resource_reference) = {</code>
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
     * Required. The SSH public key and expiration time.
     *
     * Generated from protobuf field <code>.google.cloud.oslogin.common.SshPublicKey ssh_public_key = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\OsLogin\Common\SshPublicKey|null
     */
    public function getSshPublicKey()
    {
        return $this->ssh_public_key;
    }

    public function hasSshPublicKey()
    {
        return isset($this->ssh_public_key);
    }

    public function clearSshPublicKey()
    {
        unset($this->ssh_public_key);
    }

    /**
     * Required. The SSH public key and expiration time.
     *
     * Generated from protobuf field <code>.google.cloud.oslogin.common.SshPublicKey ssh_public_key = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\OsLogin\Common\SshPublicKey $var
     * @return $this
     */
    public function setSshPublicKey($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\OsLogin\Common\SshPublicKey::class);
        $this->ssh_public_key = $var;

        return $this;
    }

    /**
     * The project ID of the Google Cloud Platform project.
     *
     * Generated from protobuf field <code>string project_id = 3;</code>
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * The project ID of the Google Cloud Platform project.
     *
     * Generated from protobuf field <code>string project_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setProjectId($var)
    {
        GPBUtil::checkString($var, True);
        $this->project_id = $var;

        return $this;
    }

    /**
     * The view configures whether to retrieve security keys information.
     *
     * Generated from protobuf field <code>.google.cloud.oslogin.v1beta.LoginProfileView view = 4;</code>
     * @return int
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * The view configures whether to retrieve security keys information.
     *
     * Generated from protobuf field <code>.google.cloud.oslogin.v1beta.LoginProfileView view = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setView($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\OsLogin\V1beta\LoginProfileView::class);
        $this->view = $var;

        return $this;
    }

}

