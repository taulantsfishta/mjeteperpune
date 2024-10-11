<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/gkebackup/v1/gkebackup.proto

namespace Google\Cloud\GkeBackup\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for UpdateRestorePlan.
 *
 * Generated from protobuf message <code>google.cloud.gkebackup.v1.UpdateRestorePlanRequest</code>
 */
class UpdateRestorePlanRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. A new version of the RestorePlan resource that contains updated
     * fields. This may be sparsely populated if an `update_mask` is provided.
     *
     * Generated from protobuf field <code>.google.cloud.gkebackup.v1.RestorePlan restore_plan = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $restore_plan = null;
    /**
     * This is used to specify the fields to be overwritten in the
     * RestorePlan targeted for update. The values for each of these
     * updated fields will be taken from the `restore_plan` provided
     * with this request. Field names are relative to the root of the resource.
     * If no `update_mask` is provided, all fields in `restore_plan` will be
     * written to the target RestorePlan resource.
     * Note that OUTPUT_ONLY and IMMUTABLE fields in `restore_plan` are ignored
     * and are not used to update the target RestorePlan.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2;</code>
     */
    private $update_mask = null;

    /**
     * @param \Google\Cloud\GkeBackup\V1\RestorePlan $restorePlan Required. A new version of the RestorePlan resource that contains updated
     *                                                            fields. This may be sparsely populated if an `update_mask` is provided.
     * @param \Google\Protobuf\FieldMask             $updateMask  This is used to specify the fields to be overwritten in the
     *                                                            RestorePlan targeted for update. The values for each of these
     *                                                            updated fields will be taken from the `restore_plan` provided
     *                                                            with this request. Field names are relative to the root of the resource.
     *                                                            If no `update_mask` is provided, all fields in `restore_plan` will be
     *                                                            written to the target RestorePlan resource.
     *                                                            Note that OUTPUT_ONLY and IMMUTABLE fields in `restore_plan` are ignored
     *                                                            and are not used to update the target RestorePlan.
     *
     * @return \Google\Cloud\GkeBackup\V1\UpdateRestorePlanRequest
     *
     * @experimental
     */
    public static function build(\Google\Cloud\GkeBackup\V1\RestorePlan $restorePlan, \Google\Protobuf\FieldMask $updateMask): self
    {
        return (new self())
            ->setRestorePlan($restorePlan)
            ->setUpdateMask($updateMask);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\GkeBackup\V1\RestorePlan $restore_plan
     *           Required. A new version of the RestorePlan resource that contains updated
     *           fields. This may be sparsely populated if an `update_mask` is provided.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           This is used to specify the fields to be overwritten in the
     *           RestorePlan targeted for update. The values for each of these
     *           updated fields will be taken from the `restore_plan` provided
     *           with this request. Field names are relative to the root of the resource.
     *           If no `update_mask` is provided, all fields in `restore_plan` will be
     *           written to the target RestorePlan resource.
     *           Note that OUTPUT_ONLY and IMMUTABLE fields in `restore_plan` are ignored
     *           and are not used to update the target RestorePlan.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Gkebackup\V1\Gkebackup::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. A new version of the RestorePlan resource that contains updated
     * fields. This may be sparsely populated if an `update_mask` is provided.
     *
     * Generated from protobuf field <code>.google.cloud.gkebackup.v1.RestorePlan restore_plan = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\GkeBackup\V1\RestorePlan|null
     */
    public function getRestorePlan()
    {
        return $this->restore_plan;
    }

    public function hasRestorePlan()
    {
        return isset($this->restore_plan);
    }

    public function clearRestorePlan()
    {
        unset($this->restore_plan);
    }

    /**
     * Required. A new version of the RestorePlan resource that contains updated
     * fields. This may be sparsely populated if an `update_mask` is provided.
     *
     * Generated from protobuf field <code>.google.cloud.gkebackup.v1.RestorePlan restore_plan = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\GkeBackup\V1\RestorePlan $var
     * @return $this
     */
    public function setRestorePlan($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeBackup\V1\RestorePlan::class);
        $this->restore_plan = $var;

        return $this;
    }

    /**
     * This is used to specify the fields to be overwritten in the
     * RestorePlan targeted for update. The values for each of these
     * updated fields will be taken from the `restore_plan` provided
     * with this request. Field names are relative to the root of the resource.
     * If no `update_mask` is provided, all fields in `restore_plan` will be
     * written to the target RestorePlan resource.
     * Note that OUTPUT_ONLY and IMMUTABLE fields in `restore_plan` are ignored
     * and are not used to update the target RestorePlan.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2;</code>
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
     * This is used to specify the fields to be overwritten in the
     * RestorePlan targeted for update. The values for each of these
     * updated fields will be taken from the `restore_plan` provided
     * with this request. Field names are relative to the root of the resource.
     * If no `update_mask` is provided, all fields in `restore_plan` will be
     * written to the target RestorePlan resource.
     * Note that OUTPUT_ONLY and IMMUTABLE fields in `restore_plan` are ignored
     * and are not used to update the target RestorePlan.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2;</code>
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

