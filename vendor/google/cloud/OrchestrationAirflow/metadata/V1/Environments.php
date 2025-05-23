<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/orchestration/airflow/service/v1/environments.proto

namespace GPBMetadata\Google\Cloud\Orchestration\Airflow\Service\V1;

class Environments
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\Client::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Cloud\Orchestration\Airflow\Service\V1\Operations::initOnce();
        \GPBMetadata\Google\Longrunning\Operations::initOnce();
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        \GPBMetadata\Google\Protobuf\FieldMask::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        $pool->internalAddGeneratedFile(
            '
�d
@google/cloud/orchestration/airflow/service/v1/environments.proto-google.cloud.orchestration.airflow.service.v1google/api/client.protogoogle/api/field_behavior.protogoogle/api/resource.proto>google/cloud/orchestration/airflow/service/v1/operations.proto#google/longrunning/operations.protogoogle/protobuf/empty.proto google/protobuf/field_mask.protogoogle/protobuf/timestamp.proto"{
CreateEnvironmentRequest
parent (	O
environment (2:.google.cloud.orchestration.airflow.service.v1.Environment"%
GetEnvironmentRequest
name (	"P
ListEnvironmentsRequest
parent (	
	page_size (

page_token (	"�
ListEnvironmentsResponseP
environments (2:.google.cloud.orchestration.airflow.service.v1.Environment
next_page_token (	"(
DeleteEnvironmentRequest
name (	"�
UpdateEnvironmentRequest
name (	O
environment (2:.google.cloud.orchestration.airflow.service.v1.Environment/
update_mask (2.google.protobuf.FieldMask"l
ExecuteAirflowCommandRequest
environment (	
command (	

subcommand (	

parameters (	"h
ExecuteAirflowCommandResponse
execution_id (	
pod (	
pod_namespace (	
error (	"y
StopAirflowCommandRequest
environment (	
execution_id (	
pod (	
pod_namespace (	
force ("=
StopAirflowCommandResponse
is_done (
output (	"�
PollAirflowCommandRequest
environment (	
execution_id (	
pod (	
pod_namespace (	
next_line_number ("�
PollAirflowCommandResponse^
output (2N.google.cloud.orchestration.airflow.service.v1.PollAirflowCommandResponse.Line

output_end (e
	exit_info (2R.google.cloud.orchestration.airflow.service.v1.PollAirflowCommandResponse.ExitInfo,
Line
line_number (
content (	,
ExitInfo
	exit_code (
error (	"E
SaveSnapshotRequest
environment (	
snapshot_location (	"-
SaveSnapshotResponse
snapshot_path (	"�
LoadSnapshotRequest
environment (	
snapshot_path (	\'
skip_pypi_packages_installation (*
"skip_environment_variables_setting (&
skip_airflow_overrides_setting (
skip_gcs_data_copying ("
LoadSnapshotResponse".
DatabaseFailoverRequest
environment (	"
DatabaseFailoverResponse"b
FetchDatabasePropertiesRequest@
environment (	B+�A�A%
#composer.googleapis.com/Environment"~
FetchDatabasePropertiesResponse
primary_gce_zone (	
secondary_gce_zone (	%
is_failover_replica_available ("�
EnvironmentConfig
gke_cluster (	
dag_gcs_prefix (	

node_count (V
software_config (2=.google.cloud.orchestration.airflow.service.v1.SoftwareConfigN
node_config (29.google.cloud.orchestration.airflow.service.v1.NodeConfigk
private_environment_config (2G.google.cloud.orchestration.airflow.service.v1.PrivateEnvironmentConfig|
!web_server_network_access_control (2L.google.cloud.orchestration.airflow.service.v1.WebServerNetworkAccessControlB�A[
database_config	 (2=.google.cloud.orchestration.airflow.service.v1.DatabaseConfigB�A^
web_server_config
 (2>.google.cloud.orchestration.airflow.service.v1.WebServerConfigB�A_
encryption_config (2?.google.cloud.orchestration.airflow.service.v1.EncryptionConfigB�Aa
maintenance_window (2@.google.cloud.orchestration.airflow.service.v1.MaintenanceWindowB�A]
workloads_config (2>.google.cloud.orchestration.airflow.service.v1.WorkloadsConfigB�Ao
environment_size (2P.google.cloud.orchestration.airflow.service.v1.EnvironmentConfig.EnvironmentSizeB�A
airflow_uri (	
airflow_byoid_uri (	B�A}
!master_authorized_networks_config (2M.google.cloud.orchestration.airflow.service.v1.MasterAuthorizedNetworksConfigB�A[
recovery_config (2=.google.cloud.orchestration.airflow.service.v1.RecoveryConfigB�Am
resilience_mode (2O.google.cloud.orchestration.airflow.service.v1.EnvironmentConfig.ResilienceModeB�A"�
EnvironmentSize 
ENVIRONMENT_SIZE_UNSPECIFIED 
ENVIRONMENT_SIZE_SMALL
ENVIRONMENT_SIZE_MEDIUM
ENVIRONMENT_SIZE_LARGE"F
ResilienceMode
RESILIENCE_MODE_UNSPECIFIED 
HIGH_RESILIENCE"�
WebServerNetworkAccessControlv
allowed_ip_ranges (2[.google.cloud.orchestration.airflow.service.v1.WebServerNetworkAccessControl.AllowedIpRange9
AllowedIpRange
value (	
description (	B�A"+
DatabaseConfig
machine_type (	B�A",
WebServerConfig
machine_type (	B�A"-
EncryptionConfig
kms_key_name (	B�A"�
MaintenanceWindow3

start_time (2.google.protobuf.TimestampB�A1
end_time (2.google.protobuf.TimestampB�A

recurrence (	B�A"�
SoftwareConfig
image_version (	{
airflow_config_overrides (2Y.google.cloud.orchestration.airflow.service.v1.SoftwareConfig.AirflowConfigOverridesEntryf
pypi_packages (2O.google.cloud.orchestration.airflow.service.v1.SoftwareConfig.PypiPackagesEntryf
env_variables (2O.google.cloud.orchestration.airflow.service.v1.SoftwareConfig.EnvVariablesEntry
python_version (	
scheduler_count (B�A=
AirflowConfigOverridesEntry
key (	
value (	:83
PypiPackagesEntry
key (	
value (	:83
EnvVariablesEntry
key (	
value (	:8"�
IPAllocationPolicy
use_ip_aliases (B�A+
cluster_secondary_range_name (	B�AH &
cluster_ipv4_cidr_block (	B�AH ,
services_secondary_range_name (	B�AH\'
services_ipv4_cidr_block (	B�AHB
cluster_ip_allocationB
services_ip_allocation"�

NodeConfig
location (	
machine_type (	
network (	

subnetwork (	
disk_size_gb (
oauth_scopes (	
service_account (	
tags (	d
ip_allocation_policy	 (2A.google.cloud.orchestration.airflow.service.v1.IPAllocationPolicyB�A!
enable_ip_masq_agent (B�A"�
PrivateClusterConfig$
enable_private_endpoint (B�A#
master_ipv4_cidr_block (	B�A\'
master_ipv4_reserved_range (	B�A"�
NetworkingConfigl
connection_type (2N.google.cloud.orchestration.airflow.service.v1.NetworkingConfig.ConnectionTypeB�A"_
ConnectionType
CONNECTION_TYPE_UNSPECIFIED 
VPC_PEERING
PRIVATE_SERVICE_CONNECT"�
PrivateEnvironmentConfig\'
enable_private_environment (B�Ah
private_cluster_config (2C.google.cloud.orchestration.airflow.service.v1.PrivateClusterConfigB�A\'
web_server_ipv4_cidr_block (	B�A&
cloud_sql_ipv4_cidr_block (	B�A+
web_server_ipv4_reserved_range (	B�A3
&cloud_composer_network_ipv4_cidr_block (	B�A7
*cloud_composer_network_ipv4_reserved_range (	B�A-
 enable_privately_used_public_ips (B�A1
$cloud_composer_connection_subnetwork	 (	B�A_
networking_config
 (2?.google.cloud.orchestration.airflow.service.v1.NetworkingConfigB�A"�
WorkloadsConfigh
	scheduler (2P.google.cloud.orchestration.airflow.service.v1.WorkloadsConfig.SchedulerResourceB�Ai

web_server (2P.google.cloud.orchestration.airflow.service.v1.WorkloadsConfig.WebServerResourceB�Ab
worker (2M.google.cloud.orchestration.airflow.service.v1.WorkloadsConfig.WorkerResourceB�Aj
SchedulerResource
cpu (B�A
	memory_gb (B�A

storage_gb (B�A
count (B�AV
WebServerResource
cpu (B�A
	memory_gb (B�A

storage_gb (B�A�
WorkerResource
cpu (B�A
	memory_gb (B�A

storage_gb (B�A
	min_count (B�A
	max_count (B�A"�
RecoveryConfigp
scheduled_snapshots_config (2G.google.cloud.orchestration.airflow.service.v1.ScheduledSnapshotsConfigB�A"�
ScheduledSnapshotsConfig
enabled (B�A
snapshot_location (	B�A\'
snapshot_creation_schedule (	B�A
	time_zone (	B�A"�
MasterAuthorizedNetworksConfig
enabled (l
cidr_blocks (2W.google.cloud.orchestration.airflow.service.v1.MasterAuthorizedNetworksConfig.CidrBlock5
	CidrBlock
display_name (	

cidr_block (	"�
Environment
name (	P
config (2@.google.cloud.orchestration.airflow.service.v1.EnvironmentConfig
uuid (	O
state (2@.google.cloud.orchestration.airflow.service.v1.Environment.State/
create_time (2.google.protobuf.Timestamp/
update_time (2.google.protobuf.TimestampV
labels (2F.google.cloud.orchestration.airflow.service.v1.Environment.LabelsEntry-
LabelsEntry
key (	
value (	:8"`
State
STATE_UNSPECIFIED 
CREATING
RUNNING
UPDATING
DELETING	
ERROR:l�Ai
#composer.googleapis.com/EnvironmentBprojects/{project}/locations/{location}/environments/{environment}"�
CheckUpgradeResponse
build_log_uri (	B�A
contains_pypi_modules_conflict (2R.google.cloud.orchestration.airflow.service.v1.CheckUpgradeResponse.ConflictResultB�A,
pypi_conflict_build_log_extract (	B�A
image_version (	t
pypi_dependencies (2Y.google.cloud.orchestration.airflow.service.v1.CheckUpgradeResponse.PypiDependenciesEntry7
PypiDependenciesEntry
key (	
value (	:8"P
ConflictResult
CONFLICT_RESULT_UNSPECIFIED 
CONFLICT
NO_CONFLICT2�
Environments�
CreateEnvironmentG.google.cloud.orchestration.airflow.service.v1.CreateEnvironmentRequest.google.longrunning.Operation"����?"0/v1/{parent=projects/*/locations/*}/environments:environment�Aparent,environment�AN
Environment?google.cloud.orchestration.airflow.service.v1.OperationMetadata�
GetEnvironmentD.google.cloud.orchestration.airflow.service.v1.GetEnvironmentRequest:.google.cloud.orchestration.airflow.service.v1.Environment"?���20/v1/{name=projects/*/locations/*/environments/*}�Aname�
ListEnvironmentsF.google.cloud.orchestration.airflow.service.v1.ListEnvironmentsRequestG.google.cloud.orchestration.airflow.service.v1.ListEnvironmentsResponse"A���20/v1/{parent=projects/*/locations/*}/environments�Aparent�
UpdateEnvironmentG.google.cloud.orchestration.airflow.service.v1.UpdateEnvironmentRequest.google.longrunning.Operation"����?20/v1/{name=projects/*/locations/*/environments/*}:environment�Aname,environment,update_mask�AN
Environment?google.cloud.orchestration.airflow.service.v1.OperationMetadata�
DeleteEnvironmentG.google.cloud.orchestration.airflow.service.v1.DeleteEnvironmentRequest.google.longrunning.Operation"����2*0/v1/{name=projects/*/locations/*/environments/*}�Aname�AX
google.protobuf.Empty?google.cloud.orchestration.airflow.service.v1.OperationMetadata�
ExecuteAirflowCommandK.google.cloud.orchestration.airflow.service.v1.ExecuteAirflowCommandRequestL.google.cloud.orchestration.airflow.service.v1.ExecuteAirflowCommandResponse"X���R"M/v1/{environment=projects/*/locations/*/environments/*}:executeAirflowCommand:*�
StopAirflowCommandH.google.cloud.orchestration.airflow.service.v1.StopAirflowCommandRequestI.google.cloud.orchestration.airflow.service.v1.StopAirflowCommandResponse"U���O"J/v1/{environment=projects/*/locations/*/environments/*}:stopAirflowCommand:*�
PollAirflowCommandH.google.cloud.orchestration.airflow.service.v1.PollAirflowCommandRequestI.google.cloud.orchestration.airflow.service.v1.PollAirflowCommandResponse"U���O"J/v1/{environment=projects/*/locations/*/environments/*}:pollAirflowCommand:*�
SaveSnapshotB.google.cloud.orchestration.airflow.service.v1.SaveSnapshotRequest.google.longrunning.Operation"����I"D/v1/{environment=projects/*/locations/*/environments/*}:saveSnapshot:*�A�
Bgoogle.cloud.orchestration.airflow.service.v1.SaveSnapshotResponse?google.cloud.orchestration.airflow.service.v1.OperationMetadata�
LoadSnapshotB.google.cloud.orchestration.airflow.service.v1.LoadSnapshotRequest.google.longrunning.Operation"����I"D/v1/{environment=projects/*/locations/*/environments/*}:loadSnapshot:*�A�
Bgoogle.cloud.orchestration.airflow.service.v1.LoadSnapshotResponse?google.cloud.orchestration.airflow.service.v1.OperationMetadata�
DatabaseFailoverF.google.cloud.orchestration.airflow.service.v1.DatabaseFailoverRequest.google.longrunning.Operation"����M"H/v1/{environment=projects/*/locations/*/environments/*}:databaseFailover:*�A�
Fgoogle.cloud.orchestration.airflow.service.v1.DatabaseFailoverResponse?google.cloud.orchestration.airflow.service.v1.OperationMetadata�
FetchDatabasePropertiesM.google.cloud.orchestration.airflow.service.v1.FetchDatabasePropertiesRequestN.google.cloud.orchestration.airflow.service.v1.FetchDatabasePropertiesResponse"W���QO/v1/{environment=projects/*/locations/*/environments/*}:fetchDatabasePropertiesK�Acomposer.googleapis.com�A.https://www.googleapis.com/auth/cloud-platformB�
1com.google.cloud.orchestration.airflow.service.v1PZKcloud.google.com/go/orchestration/airflow/service/apiv1/servicepb;servicepbbproto3'
        , true);

        static::$is_initialized = true;
    }
}

