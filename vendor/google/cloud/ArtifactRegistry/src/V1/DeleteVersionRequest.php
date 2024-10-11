<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/devtools/artifactregistry/v1/version.proto

namespace Google\Cloud\ArtifactRegistry\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The request to delete a version.
 *
 * Generated from protobuf message <code>google.devtools.artifactregistry.v1.DeleteVersionRequest</code>
 */
class DeleteVersionRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The name of the version to delete.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * By default, a version that is tagged may not be deleted. If force=true, the
     * version and any tags pointing to the version are deleted.
     *
     * Generated from protobuf field <code>bool force = 2;</code>
     */
    private $force = false;

    /**
     * @param string $name The name of the version to delete.
     *
     * @return \Google\Cloud\ArtifactRegistry\V1\DeleteVersionRequest
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
     *           The name of the version to delete.
     *     @type bool $force
     *           By default, a version that is tagged may not be deleted. If force=true, the
     *           version and any tags pointing to the version are deleted.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Devtools\Artifactregistry\V1\Version::initOnce();
        parent::__construct($data);
    }

    /**
     * The name of the version to delete.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The name of the version to delete.
     *
     * Generated from protobuf field <code>string name = 1;</code>
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
     * By default, a version that is tagged may not be deleted. If force=true, the
     * version and any tags pointing to the version are deleted.
     *
     * Generated from protobuf field <code>bool force = 2;</code>
     * @return bool
     */
    public function getForce()
    {
        return $this->force;
    }

    /**
     * By default, a version that is tagged may not be deleted. If force=true, the
     * version and any tags pointing to the version are deleted.
     *
     * Generated from protobuf field <code>bool force = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setForce($var)
    {
        GPBUtil::checkBool($var);
        $this->force = $var;

        return $this;
    }

}
