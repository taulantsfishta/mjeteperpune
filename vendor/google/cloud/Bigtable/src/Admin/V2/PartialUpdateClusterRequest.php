<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/bigtable/admin/v2/bigtable_instance_admin.proto

namespace Google\Cloud\Bigtable\Admin\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for BigtableInstanceAdmin.PartialUpdateCluster.
 *
 * Generated from protobuf message <code>google.bigtable.admin.v2.PartialUpdateClusterRequest</code>
 */
class PartialUpdateClusterRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The Cluster which contains the partial updates to be applied, subject to
     * the update_mask.
     *
     * Generated from protobuf field <code>.google.bigtable.admin.v2.Cluster cluster = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $cluster = null;
    /**
     * Required. The subset of Cluster fields which should be replaced.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $update_mask = null;

    /**
     * @param \Google\Cloud\Bigtable\Admin\V2\Cluster $cluster    Required. The Cluster which contains the partial updates to be applied, subject to
     *                                                            the update_mask.
     * @param \Google\Protobuf\FieldMask              $updateMask Required. The subset of Cluster fields which should be replaced.
     *
     * @return \Google\Cloud\Bigtable\Admin\V2\PartialUpdateClusterRequest
     *
     * @experimental
     */
    public static function build(\Google\Cloud\Bigtable\Admin\V2\Cluster $cluster, \Google\Protobuf\FieldMask $updateMask): self
    {
        return (new self())
            ->setCluster($cluster)
            ->setUpdateMask($updateMask);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Bigtable\Admin\V2\Cluster $cluster
     *           Required. The Cluster which contains the partial updates to be applied, subject to
     *           the update_mask.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           Required. The subset of Cluster fields which should be replaced.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Bigtable\Admin\V2\BigtableInstanceAdmin::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The Cluster which contains the partial updates to be applied, subject to
     * the update_mask.
     *
     * Generated from protobuf field <code>.google.bigtable.admin.v2.Cluster cluster = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Bigtable\Admin\V2\Cluster|null
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    public function hasCluster()
    {
        return isset($this->cluster);
    }

    public function clearCluster()
    {
        unset($this->cluster);
    }

    /**
     * Required. The Cluster which contains the partial updates to be applied, subject to
     * the update_mask.
     *
     * Generated from protobuf field <code>.google.bigtable.admin.v2.Cluster cluster = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Bigtable\Admin\V2\Cluster $var
     * @return $this
     */
    public function setCluster($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Bigtable\Admin\V2\Cluster::class);
        $this->cluster = $var;

        return $this;
    }

    /**
     * Required. The subset of Cluster fields which should be replaced.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Protobuf\FieldMask|null
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }

    public function hasUpdateMask()
    {
        return isset($this->update_mask);
    }

    public function clearUpdateMask()
    {
        unset($this->update_mask);
    }

    /**
     * Required. The subset of Cluster fields which should be replaced.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

}
