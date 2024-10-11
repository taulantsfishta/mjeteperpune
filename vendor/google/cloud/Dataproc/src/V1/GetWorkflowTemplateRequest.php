<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/dataproc/v1/workflow_templates.proto

namespace Google\Cloud\Dataproc\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A request to fetch a workflow template.
 *
 * Generated from protobuf message <code>google.cloud.dataproc.v1.GetWorkflowTemplateRequest</code>
 */
class GetWorkflowTemplateRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The resource name of the workflow template, as described
     * in https://cloud.google.com/apis/design/resource_names.
     * * For `projects.regions.workflowTemplates.get`, the resource name of the
     *   template has the following format:
     *   `projects/{project_id}/regions/{region}/workflowTemplates/{template_id}`
     * * For `projects.locations.workflowTemplates.get`, the resource name of the
     *   template has the following format:
     *   `projects/{project_id}/locations/{location}/workflowTemplates/{template_id}`
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $name = '';
    /**
     * Optional. The version of workflow template to retrieve. Only previously
     * instantiated versions can be retrieved.
     * If unspecified, retrieves the current version.
     *
     * Generated from protobuf field <code>int32 version = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $version = 0;

    /**
     * @param string $name Required. The resource name of the workflow template, as described
     *                     in https://cloud.google.com/apis/design/resource_names.
     *
     *                     * For `projects.regions.workflowTemplates.get`, the resource name of the
     *                     template has the following format:
     *                     `projects/{project_id}/regions/{region}/workflowTemplates/{template_id}`
     *
     *                     * For `projects.locations.workflowTemplates.get`, the resource name of the
     *                     template has the following format:
     *                     `projects/{project_id}/locations/{location}/workflowTemplates/{template_id}`
     *                     Please see {@see WorkflowTemplateServiceClient::workflowTemplateName()} for help formatting this field.
     *
     * @return \Google\Cloud\Dataproc\V1\GetWorkflowTemplateRequest
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
     *           Required. The resource name of the workflow template, as described
     *           in https://cloud.google.com/apis/design/resource_names.
     *           * For `projects.regions.workflowTemplates.get`, the resource name of the
     *             template has the following format:
     *             `projects/{project_id}/regions/{region}/workflowTemplates/{template_id}`
     *           * For `projects.locations.workflowTemplates.get`, the resource name of the
     *             template has the following format:
     *             `projects/{project_id}/locations/{location}/workflowTemplates/{template_id}`
     *     @type int $version
     *           Optional. The version of workflow template to retrieve. Only previously
     *           instantiated versions can be retrieved.
     *           If unspecified, retrieves the current version.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Dataproc\V1\WorkflowTemplates::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The resource name of the workflow template, as described
     * in https://cloud.google.com/apis/design/resource_names.
     * * For `projects.regions.workflowTemplates.get`, the resource name of the
     *   template has the following format:
     *   `projects/{project_id}/regions/{region}/workflowTemplates/{template_id}`
     * * For `projects.locations.workflowTemplates.get`, the resource name of the
     *   template has the following format:
     *   `projects/{project_id}/locations/{location}/workflowTemplates/{template_id}`
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. The resource name of the workflow template, as described
     * in https://cloud.google.com/apis/design/resource_names.
     * * For `projects.regions.workflowTemplates.get`, the resource name of the
     *   template has the following format:
     *   `projects/{project_id}/regions/{region}/workflowTemplates/{template_id}`
     * * For `projects.locations.workflowTemplates.get`, the resource name of the
     *   template has the following format:
     *   `projects/{project_id}/locations/{location}/workflowTemplates/{template_id}`
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
     * Optional. The version of workflow template to retrieve. Only previously
     * instantiated versions can be retrieved.
     * If unspecified, retrieves the current version.
     *
     * Generated from protobuf field <code>int32 version = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Optional. The version of workflow template to retrieve. Only previously
     * instantiated versions can be retrieved.
     * If unspecified, retrieves the current version.
     *
     * Generated from protobuf field <code>int32 version = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param int $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkInt32($var);
        $this->version = $var;

        return $this;
    }

}

