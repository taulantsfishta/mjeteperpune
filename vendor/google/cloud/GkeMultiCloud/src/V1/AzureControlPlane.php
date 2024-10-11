<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/gkemulticloud/v1/azure_resources.proto

namespace Google\Cloud\GkeMultiCloud\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * AzureControlPlane represents the control plane configurations.
 *
 * Generated from protobuf message <code>google.cloud.gkemulticloud.v1.AzureControlPlane</code>
 */
class AzureControlPlane extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The Kubernetes version to run on control plane replicas
     * (e.g. `1.19.10-gke.1000`).
     * You can list all supported versions on a given Google Cloud region by
     * calling
     * [GetAzureServerConfig][google.cloud.gkemulticloud.v1.AzureClusters.GetAzureServerConfig].
     *
     * Generated from protobuf field <code>string version = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $version = '';
    /**
     * Optional. The ARM ID of the default subnet for the control plane. The
     * control plane VMs are deployed in this subnet, unless
     * `AzureControlPlane.replica_placements` is specified. This subnet will also
     * be used as default for `AzureControlPlane.endpoint_subnet_id` if
     * `AzureControlPlane.endpoint_subnet_id` is not specified. Similarly it will
     * be used as default for
     * `AzureClusterNetworking.service_load_balancer_subnet_id`.
     * Example:
     * `/subscriptions/<subscription-id>/resourceGroups/<resource-group-id>/providers/Microsoft.Network/virtualNetworks/<vnet-id>/subnets/default`.
     *
     * Generated from protobuf field <code>string subnet_id = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $subnet_id = '';
    /**
     * Optional. The Azure VM size name. Example: `Standard_DS2_v2`.
     * For available VM sizes, see
     * https://docs.microsoft.com/en-us/azure/virtual-machines/vm-naming-conventions.
     * When unspecified, it defaults to `Standard_DS2_v2`.
     *
     * Generated from protobuf field <code>string vm_size = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $vm_size = '';
    /**
     * Required. SSH configuration for how to access the underlying control plane
     * machines.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureSshConfig ssh_config = 11 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $ssh_config = null;
    /**
     * Optional. Configuration related to the root volume provisioned for each
     * control plane replica.
     * When unspecified, it defaults to 32-GiB Azure Disk.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDiskTemplate root_volume = 4 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $root_volume = null;
    /**
     * Optional. Configuration related to the main volume provisioned for each
     * control plane replica.
     * The main volume is in charge of storing all of the cluster's etcd state.
     * When unspecified, it defaults to a 8-GiB Azure Disk.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDiskTemplate main_volume = 5 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $main_volume = null;
    /**
     * Optional. Configuration related to application-layer secrets encryption.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDatabaseEncryption database_encryption = 10 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $database_encryption = null;
    /**
     * Optional. Proxy configuration for outbound HTTP(S) traffic.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureProxyConfig proxy_config = 12 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $proxy_config = null;
    /**
     * Optional. Configuration related to vm config encryption.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureConfigEncryption config_encryption = 14 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $config_encryption = null;
    /**
     * Optional. A set of tags to apply to all underlying control plane Azure
     * resources.
     *
     * Generated from protobuf field <code>map<string, string> tags = 7 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $tags;
    /**
     * Optional. Configuration for where to place the control plane replicas.
     * Up to three replica placement instances can be specified. If
     * replica_placements is set, the replica placement instances will be applied
     * to the three control plane replicas as evenly as possible.
     *
     * Generated from protobuf field <code>repeated .google.cloud.gkemulticloud.v1.ReplicaPlacement replica_placements = 13 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $replica_placements;
    /**
     * Optional. The ARM ID of the subnet where the control plane load balancer is
     * deployed. When unspecified, it defaults to AzureControlPlane.subnet_id.
     * Example:
     * "/subscriptions/d00494d6-6f3c-4280-bbb2-899e163d1d30/resourceGroups/anthos_cluster_gkeust4/providers/Microsoft.Network/virtualNetworks/gke-vnet-gkeust4/subnets/subnetid123"
     *
     * Generated from protobuf field <code>string endpoint_subnet_id = 15 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $endpoint_subnet_id = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $version
     *           Required. The Kubernetes version to run on control plane replicas
     *           (e.g. `1.19.10-gke.1000`).
     *           You can list all supported versions on a given Google Cloud region by
     *           calling
     *           [GetAzureServerConfig][google.cloud.gkemulticloud.v1.AzureClusters.GetAzureServerConfig].
     *     @type string $subnet_id
     *           Optional. The ARM ID of the default subnet for the control plane. The
     *           control plane VMs are deployed in this subnet, unless
     *           `AzureControlPlane.replica_placements` is specified. This subnet will also
     *           be used as default for `AzureControlPlane.endpoint_subnet_id` if
     *           `AzureControlPlane.endpoint_subnet_id` is not specified. Similarly it will
     *           be used as default for
     *           `AzureClusterNetworking.service_load_balancer_subnet_id`.
     *           Example:
     *           `/subscriptions/<subscription-id>/resourceGroups/<resource-group-id>/providers/Microsoft.Network/virtualNetworks/<vnet-id>/subnets/default`.
     *     @type string $vm_size
     *           Optional. The Azure VM size name. Example: `Standard_DS2_v2`.
     *           For available VM sizes, see
     *           https://docs.microsoft.com/en-us/azure/virtual-machines/vm-naming-conventions.
     *           When unspecified, it defaults to `Standard_DS2_v2`.
     *     @type \Google\Cloud\GkeMultiCloud\V1\AzureSshConfig $ssh_config
     *           Required. SSH configuration for how to access the underlying control plane
     *           machines.
     *     @type \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate $root_volume
     *           Optional. Configuration related to the root volume provisioned for each
     *           control plane replica.
     *           When unspecified, it defaults to 32-GiB Azure Disk.
     *     @type \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate $main_volume
     *           Optional. Configuration related to the main volume provisioned for each
     *           control plane replica.
     *           The main volume is in charge of storing all of the cluster's etcd state.
     *           When unspecified, it defaults to a 8-GiB Azure Disk.
     *     @type \Google\Cloud\GkeMultiCloud\V1\AzureDatabaseEncryption $database_encryption
     *           Optional. Configuration related to application-layer secrets encryption.
     *     @type \Google\Cloud\GkeMultiCloud\V1\AzureProxyConfig $proxy_config
     *           Optional. Proxy configuration for outbound HTTP(S) traffic.
     *     @type \Google\Cloud\GkeMultiCloud\V1\AzureConfigEncryption $config_encryption
     *           Optional. Configuration related to vm config encryption.
     *     @type array|\Google\Protobuf\Internal\MapField $tags
     *           Optional. A set of tags to apply to all underlying control plane Azure
     *           resources.
     *     @type array<\Google\Cloud\GkeMultiCloud\V1\ReplicaPlacement>|\Google\Protobuf\Internal\RepeatedField $replica_placements
     *           Optional. Configuration for where to place the control plane replicas.
     *           Up to three replica placement instances can be specified. If
     *           replica_placements is set, the replica placement instances will be applied
     *           to the three control plane replicas as evenly as possible.
     *     @type string $endpoint_subnet_id
     *           Optional. The ARM ID of the subnet where the control plane load balancer is
     *           deployed. When unspecified, it defaults to AzureControlPlane.subnet_id.
     *           Example:
     *           "/subscriptions/d00494d6-6f3c-4280-bbb2-899e163d1d30/resourceGroups/anthos_cluster_gkeust4/providers/Microsoft.Network/virtualNetworks/gke-vnet-gkeust4/subnets/subnetid123"
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Gkemulticloud\V1\AzureResources::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The Kubernetes version to run on control plane replicas
     * (e.g. `1.19.10-gke.1000`).
     * You can list all supported versions on a given Google Cloud region by
     * calling
     * [GetAzureServerConfig][google.cloud.gkemulticloud.v1.AzureClusters.GetAzureServerConfig].
     *
     * Generated from protobuf field <code>string version = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Required. The Kubernetes version to run on control plane replicas
     * (e.g. `1.19.10-gke.1000`).
     * You can list all supported versions on a given Google Cloud region by
     * calling
     * [GetAzureServerConfig][google.cloud.gkemulticloud.v1.AzureClusters.GetAzureServerConfig].
     *
     * Generated from protobuf field <code>string version = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkString($var, True);
        $this->version = $var;

        return $this;
    }

    /**
     * Optional. The ARM ID of the default subnet for the control plane. The
     * control plane VMs are deployed in this subnet, unless
     * `AzureControlPlane.replica_placements` is specified. This subnet will also
     * be used as default for `AzureControlPlane.endpoint_subnet_id` if
     * `AzureControlPlane.endpoint_subnet_id` is not specified. Similarly it will
     * be used as default for
     * `AzureClusterNetworking.service_load_balancer_subnet_id`.
     * Example:
     * `/subscriptions/<subscription-id>/resourceGroups/<resource-group-id>/providers/Microsoft.Network/virtualNetworks/<vnet-id>/subnets/default`.
     *
     * Generated from protobuf field <code>string subnet_id = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getSubnetId()
    {
        return $this->subnet_id;
    }

    /**
     * Optional. The ARM ID of the default subnet for the control plane. The
     * control plane VMs are deployed in this subnet, unless
     * `AzureControlPlane.replica_placements` is specified. This subnet will also
     * be used as default for `AzureControlPlane.endpoint_subnet_id` if
     * `AzureControlPlane.endpoint_subnet_id` is not specified. Similarly it will
     * be used as default for
     * `AzureClusterNetworking.service_load_balancer_subnet_id`.
     * Example:
     * `/subscriptions/<subscription-id>/resourceGroups/<resource-group-id>/providers/Microsoft.Network/virtualNetworks/<vnet-id>/subnets/default`.
     *
     * Generated from protobuf field <code>string subnet_id = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setSubnetId($var)
    {
        GPBUtil::checkString($var, True);
        $this->subnet_id = $var;

        return $this;
    }

    /**
     * Optional. The Azure VM size name. Example: `Standard_DS2_v2`.
     * For available VM sizes, see
     * https://docs.microsoft.com/en-us/azure/virtual-machines/vm-naming-conventions.
     * When unspecified, it defaults to `Standard_DS2_v2`.
     *
     * Generated from protobuf field <code>string vm_size = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getVmSize()
    {
        return $this->vm_size;
    }

    /**
     * Optional. The Azure VM size name. Example: `Standard_DS2_v2`.
     * For available VM sizes, see
     * https://docs.microsoft.com/en-us/azure/virtual-machines/vm-naming-conventions.
     * When unspecified, it defaults to `Standard_DS2_v2`.
     *
     * Generated from protobuf field <code>string vm_size = 3 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setVmSize($var)
    {
        GPBUtil::checkString($var, True);
        $this->vm_size = $var;

        return $this;
    }

    /**
     * Required. SSH configuration for how to access the underlying control plane
     * machines.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureSshConfig ssh_config = 11 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\GkeMultiCloud\V1\AzureSshConfig|null
     */
    public function getSshConfig()
    {
        return $this->ssh_config;
    }

    public function hasSshConfig()
    {
        return isset($this->ssh_config);
    }

    public function clearSshConfig()
    {
        unset($this->ssh_config);
    }

    /**
     * Required. SSH configuration for how to access the underlying control plane
     * machines.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureSshConfig ssh_config = 11 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\GkeMultiCloud\V1\AzureSshConfig $var
     * @return $this
     */
    public function setSshConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeMultiCloud\V1\AzureSshConfig::class);
        $this->ssh_config = $var;

        return $this;
    }

    /**
     * Optional. Configuration related to the root volume provisioned for each
     * control plane replica.
     * When unspecified, it defaults to 32-GiB Azure Disk.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDiskTemplate root_volume = 4 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate|null
     */
    public function getRootVolume()
    {
        return $this->root_volume;
    }

    public function hasRootVolume()
    {
        return isset($this->root_volume);
    }

    public function clearRootVolume()
    {
        unset($this->root_volume);
    }

    /**
     * Optional. Configuration related to the root volume provisioned for each
     * control plane replica.
     * When unspecified, it defaults to 32-GiB Azure Disk.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDiskTemplate root_volume = 4 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate $var
     * @return $this
     */
    public function setRootVolume($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate::class);
        $this->root_volume = $var;

        return $this;
    }

    /**
     * Optional. Configuration related to the main volume provisioned for each
     * control plane replica.
     * The main volume is in charge of storing all of the cluster's etcd state.
     * When unspecified, it defaults to a 8-GiB Azure Disk.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDiskTemplate main_volume = 5 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate|null
     */
    public function getMainVolume()
    {
        return $this->main_volume;
    }

    public function hasMainVolume()
    {
        return isset($this->main_volume);
    }

    public function clearMainVolume()
    {
        unset($this->main_volume);
    }

    /**
     * Optional. Configuration related to the main volume provisioned for each
     * control plane replica.
     * The main volume is in charge of storing all of the cluster's etcd state.
     * When unspecified, it defaults to a 8-GiB Azure Disk.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDiskTemplate main_volume = 5 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate $var
     * @return $this
     */
    public function setMainVolume($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeMultiCloud\V1\AzureDiskTemplate::class);
        $this->main_volume = $var;

        return $this;
    }

    /**
     * Optional. Configuration related to application-layer secrets encryption.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDatabaseEncryption database_encryption = 10 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\GkeMultiCloud\V1\AzureDatabaseEncryption|null
     */
    public function getDatabaseEncryption()
    {
        return $this->database_encryption;
    }

    public function hasDatabaseEncryption()
    {
        return isset($this->database_encryption);
    }

    public function clearDatabaseEncryption()
    {
        unset($this->database_encryption);
    }

    /**
     * Optional. Configuration related to application-layer secrets encryption.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureDatabaseEncryption database_encryption = 10 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\GkeMultiCloud\V1\AzureDatabaseEncryption $var
     * @return $this
     */
    public function setDatabaseEncryption($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeMultiCloud\V1\AzureDatabaseEncryption::class);
        $this->database_encryption = $var;

        return $this;
    }

    /**
     * Optional. Proxy configuration for outbound HTTP(S) traffic.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureProxyConfig proxy_config = 12 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\GkeMultiCloud\V1\AzureProxyConfig|null
     */
    public function getProxyConfig()
    {
        return $this->proxy_config;
    }

    public function hasProxyConfig()
    {
        return isset($this->proxy_config);
    }

    public function clearProxyConfig()
    {
        unset($this->proxy_config);
    }

    /**
     * Optional. Proxy configuration for outbound HTTP(S) traffic.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureProxyConfig proxy_config = 12 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\GkeMultiCloud\V1\AzureProxyConfig $var
     * @return $this
     */
    public function setProxyConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeMultiCloud\V1\AzureProxyConfig::class);
        $this->proxy_config = $var;

        return $this;
    }

    /**
     * Optional. Configuration related to vm config encryption.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureConfigEncryption config_encryption = 14 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\GkeMultiCloud\V1\AzureConfigEncryption|null
     */
    public function getConfigEncryption()
    {
        return $this->config_encryption;
    }

    public function hasConfigEncryption()
    {
        return isset($this->config_encryption);
    }

    public function clearConfigEncryption()
    {
        unset($this->config_encryption);
    }

    /**
     * Optional. Configuration related to vm config encryption.
     *
     * Generated from protobuf field <code>.google.cloud.gkemulticloud.v1.AzureConfigEncryption config_encryption = 14 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\GkeMultiCloud\V1\AzureConfigEncryption $var
     * @return $this
     */
    public function setConfigEncryption($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\GkeMultiCloud\V1\AzureConfigEncryption::class);
        $this->config_encryption = $var;

        return $this;
    }

    /**
     * Optional. A set of tags to apply to all underlying control plane Azure
     * resources.
     *
     * Generated from protobuf field <code>map<string, string> tags = 7 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Optional. A set of tags to apply to all underlying control plane Azure
     * resources.
     *
     * Generated from protobuf field <code>map<string, string> tags = 7 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setTags($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->tags = $arr;

        return $this;
    }

    /**
     * Optional. Configuration for where to place the control plane replicas.
     * Up to three replica placement instances can be specified. If
     * replica_placements is set, the replica placement instances will be applied
     * to the three control plane replicas as evenly as possible.
     *
     * Generated from protobuf field <code>repeated .google.cloud.gkemulticloud.v1.ReplicaPlacement replica_placements = 13 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getReplicaPlacements()
    {
        return $this->replica_placements;
    }

    /**
     * Optional. Configuration for where to place the control plane replicas.
     * Up to three replica placement instances can be specified. If
     * replica_placements is set, the replica placement instances will be applied
     * to the three control plane replicas as evenly as possible.
     *
     * Generated from protobuf field <code>repeated .google.cloud.gkemulticloud.v1.ReplicaPlacement replica_placements = 13 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param array<\Google\Cloud\GkeMultiCloud\V1\ReplicaPlacement>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setReplicaPlacements($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\GkeMultiCloud\V1\ReplicaPlacement::class);
        $this->replica_placements = $arr;

        return $this;
    }

    /**
     * Optional. The ARM ID of the subnet where the control plane load balancer is
     * deployed. When unspecified, it defaults to AzureControlPlane.subnet_id.
     * Example:
     * "/subscriptions/d00494d6-6f3c-4280-bbb2-899e163d1d30/resourceGroups/anthos_cluster_gkeust4/providers/Microsoft.Network/virtualNetworks/gke-vnet-gkeust4/subnets/subnetid123"
     *
     * Generated from protobuf field <code>string endpoint_subnet_id = 15 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getEndpointSubnetId()
    {
        return $this->endpoint_subnet_id;
    }

    /**
     * Optional. The ARM ID of the subnet where the control plane load balancer is
     * deployed. When unspecified, it defaults to AzureControlPlane.subnet_id.
     * Example:
     * "/subscriptions/d00494d6-6f3c-4280-bbb2-899e163d1d30/resourceGroups/anthos_cluster_gkeust4/providers/Microsoft.Network/virtualNetworks/gke-vnet-gkeust4/subnets/subnetid123"
     *
     * Generated from protobuf field <code>string endpoint_subnet_id = 15 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setEndpointSubnetId($var)
    {
        GPBUtil::checkString($var, True);
        $this->endpoint_subnet_id = $var;

        return $this;
    }

}
