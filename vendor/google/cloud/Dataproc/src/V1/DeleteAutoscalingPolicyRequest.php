<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/dataproc/v1/autoscaling_policies.proto

namespace Google\Cloud\Dataproc\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A request to delete an autoscaling policy.
 * Autoscaling policies in use by one or more clusters will not be deleted.
 *
 * Generated from protobuf message <code>google.cloud.dataproc.v1.DeleteAutoscalingPolicyRequest</code>
 */
class DeleteAutoscalingPolicyRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The "resource name" of the autoscaling policy, as described
     * in https://cloud.google.com/apis/design/resource_names.
     * * For `projects.regions.autoscalingPolicies.delete`, the resource name
     *   of the policy has the following format:
     *   `projects/{project_id}/regions/{region}/autoscalingPolicies/{policy_id}`
     * * For `projects.locations.autoscalingPolicies.delete`, the resource name
     *   of the policy has the following format:
     *   `projects/{project_id}/locations/{location}/autoscalingPolicies/{policy_id}`
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $name = '';

    /**
     * @param string $name Required. The "resource name" of the autoscaling policy, as described
     *                     in https://cloud.google.com/apis/design/resource_names.
     *
     *                     * For `projects.regions.autoscalingPolicies.delete`, the resource name
     *                     of the policy has the following format:
     *                     `projects/{project_id}/regions/{region}/autoscalingPolicies/{policy_id}`
     *
     *                     * For `projects.locations.autoscalingPolicies.delete`, the resource name
     *                     of the policy has the following format:
     *                     `projects/{project_id}/locations/{location}/autoscalingPolicies/{policy_id}`
     *                     Please see {@see AutoscalingPolicyServiceClient::autoscalingPolicyName()} for help formatting this field.
     *
     * @return \Google\Cloud\Dataproc\V1\DeleteAutoscalingPolicyRequest
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
     *           Required. The "resource name" of the autoscaling policy, as described
     *           in https://cloud.google.com/apis/design/resource_names.
     *           * For `projects.regions.autoscalingPolicies.delete`, the resource name
     *             of the policy has the following format:
     *             `projects/{project_id}/regions/{region}/autoscalingPolicies/{policy_id}`
     *           * For `projects.locations.autoscalingPolicies.delete`, the resource name
     *             of the policy has the following format:
     *             `projects/{project_id}/locations/{location}/autoscalingPolicies/{policy_id}`
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Dataproc\V1\AutoscalingPolicies::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The "resource name" of the autoscaling policy, as described
     * in https://cloud.google.com/apis/design/resource_names.
     * * For `projects.regions.autoscalingPolicies.delete`, the resource name
     *   of the policy has the following format:
     *   `projects/{project_id}/regions/{region}/autoscalingPolicies/{policy_id}`
     * * For `projects.locations.autoscalingPolicies.delete`, the resource name
     *   of the policy has the following format:
     *   `projects/{project_id}/locations/{location}/autoscalingPolicies/{policy_id}`
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. The "resource name" of the autoscaling policy, as described
     * in https://cloud.google.com/apis/design/resource_names.
     * * For `projects.regions.autoscalingPolicies.delete`, the resource name
     *   of the policy has the following format:
     *   `projects/{project_id}/regions/{region}/autoscalingPolicies/{policy_id}`
     * * For `projects.locations.autoscalingPolicies.delete`, the resource name
     *   of the policy has the following format:
     *   `projects/{project_id}/locations/{location}/autoscalingPolicies/{policy_id}`
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

}

