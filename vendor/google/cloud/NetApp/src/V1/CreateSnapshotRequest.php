<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/netapp/v1/snapshot.proto

namespace Google\Cloud\NetApp\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * CreateSnapshotRequest creates a snapshot.
 *
 * Generated from protobuf message <code>google.cloud.netapp.v1.CreateSnapshotRequest</code>
 */
class CreateSnapshotRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The NetApp volume to create the snapshots of, in the format
     * `projects/{project_id}/locations/{location}/volumes/{volume_id}`
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    protected $parent = '';
    /**
     * Required. A snapshot resource
     *
     * Generated from protobuf field <code>.google.cloud.netapp.v1.Snapshot snapshot = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $snapshot = null;
    /**
     * Required. ID of the snapshot to create.
     * This value must start with a lowercase letter followed by up to 62
     * lowercase letters, numbers, or hyphens, and cannot end with a hyphen.
     *
     * Generated from protobuf field <code>string snapshot_id = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $snapshot_id = '';

    /**
     * @param string                           $parent     Required. The NetApp volume to create the snapshots of, in the format
     *                                                     `projects/{project_id}/locations/{location}/volumes/{volume_id}`
     *                                                     Please see {@see NetAppClient::volumeName()} for help formatting this field.
     * @param \Google\Cloud\NetApp\V1\Snapshot $snapshot   Required. A snapshot resource
     * @param string                           $snapshotId Required. ID of the snapshot to create.
     *                                                     This value must start with a lowercase letter followed by up to 62
     *                                                     lowercase letters, numbers, or hyphens, and cannot end with a hyphen.
     *
     * @return \Google\Cloud\NetApp\V1\CreateSnapshotRequest
     *
     * @experimental
     */
    public static function build(string $parent, \Google\Cloud\NetApp\V1\Snapshot $snapshot, string $snapshotId): self
    {
        return (new self())
            ->setParent($parent)
            ->setSnapshot($snapshot)
            ->setSnapshotId($snapshotId);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. The NetApp volume to create the snapshots of, in the format
     *           `projects/{project_id}/locations/{location}/volumes/{volume_id}`
     *     @type \Google\Cloud\NetApp\V1\Snapshot $snapshot
     *           Required. A snapshot resource
     *     @type string $snapshot_id
     *           Required. ID of the snapshot to create.
     *           This value must start with a lowercase letter followed by up to 62
     *           lowercase letters, numbers, or hyphens, and cannot end with a hyphen.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Netapp\V1\Snapshot::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The NetApp volume to create the snapshots of, in the format
     * `projects/{project_id}/locations/{location}/volumes/{volume_id}`
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. The NetApp volume to create the snapshots of, in the format
     * `projects/{project_id}/locations/{location}/volumes/{volume_id}`
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
     * Required. A snapshot resource
     *
     * Generated from protobuf field <code>.google.cloud.netapp.v1.Snapshot snapshot = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\NetApp\V1\Snapshot|null
     */
    public function getSnapshot()
    {
        return $this->snapshot;
    }

    public function hasSnapshot()
    {
        return isset($this->snapshot);
    }

    public function clearSnapshot()
    {
        unset($this->snapshot);
    }

    /**
     * Required. A snapshot resource
     *
     * Generated from protobuf field <code>.google.cloud.netapp.v1.Snapshot snapshot = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\NetApp\V1\Snapshot $var
     * @return $this
     */
    public function setSnapshot($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\NetApp\V1\Snapshot::class);
        $this->snapshot = $var;

        return $this;
    }

    /**
     * Required. ID of the snapshot to create.
     * This value must start with a lowercase letter followed by up to 62
     * lowercase letters, numbers, or hyphens, and cannot end with a hyphen.
     *
     * Generated from protobuf field <code>string snapshot_id = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getSnapshotId()
    {
        return $this->snapshot_id;
    }

    /**
     * Required. ID of the snapshot to create.
     * This value must start with a lowercase letter followed by up to 62
     * lowercase letters, numbers, or hyphens, and cannot end with a hyphen.
     *
     * Generated from protobuf field <code>string snapshot_id = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setSnapshotId($var)
    {
        GPBUtil::checkString($var, True);
        $this->snapshot_id = $var;

        return $this;
    }

}
