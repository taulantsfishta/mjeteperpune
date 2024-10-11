<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/networkmanagement/v1/trace.proto

namespace GPBMetadata\Google\Cloud\Networkmanagement\V1;

class Trace
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�S
-google/cloud/networkmanagement/v1/trace.proto!google.cloud.networkmanagement.v1"�
TraceF
endpoint_info (2/.google.cloud.networkmanagement.v1.EndpointInfo6
steps (2\'.google.cloud.networkmanagement.v1.Step"�
Step
description (	<
state (2-.google.cloud.networkmanagement.v1.Step.State
causes_drop (

project_id (	C
instance (2/.google.cloud.networkmanagement.v1.InstanceInfoH C
firewall (2/.google.cloud.networkmanagement.v1.FirewallInfoH =
route (2,.google.cloud.networkmanagement.v1.RouteInfoH C
endpoint (2/.google.cloud.networkmanagement.v1.EndpointInfoH N
google_service (24.google.cloud.networkmanagement.v1.GoogleServiceInfoH P
forwarding_rule	 (25.google.cloud.networkmanagement.v1.ForwardingRuleInfoH H
vpn_gateway
 (21.google.cloud.networkmanagement.v1.VpnGatewayInfoH F

vpn_tunnel (20.google.cloud.networkmanagement.v1.VpnTunnelInfoH L
vpc_connector (23.google.cloud.networkmanagement.v1.VpcConnectorInfoH A
deliver (2..google.cloud.networkmanagement.v1.DeliverInfoH A
forward (2..google.cloud.networkmanagement.v1.ForwardInfoH =
abort (2,.google.cloud.networkmanagement.v1.AbortInfoH ;
drop (2+.google.cloud.networkmanagement.v1.DropInfoH L
load_balancer (23.google.cloud.networkmanagement.v1.LoadBalancerInfoH A
network (2..google.cloud.networkmanagement.v1.NetworkInfoH F

gke_master (20.google.cloud.networkmanagement.v1.GKEMasterInfoH U
cloud_sql_instance (27.google.cloud.networkmanagement.v1.CloudSQLInstanceInfoH N
cloud_function (24.google.cloud.networkmanagement.v1.CloudFunctionInfoH U
app_engine_version (27.google.cloud.networkmanagement.v1.AppEngineVersionInfoH U
cloud_run_revision (27.google.cloud.networkmanagement.v1.CloudRunRevisionInfoH "�
State
STATE_UNSPECIFIED 
START_FROM_INSTANCE
START_FROM_INTERNET
START_FROM_GOOGLE_SERVICE
START_FROM_PRIVATE_NETWORK
START_FROM_GKE_MASTER!
START_FROM_CLOUD_SQL_INSTANCE
START_FROM_CLOUD_FUNCTION!
START_FROM_APP_ENGINE_VERSION!
START_FROM_CLOUD_RUN_REVISION
APPLY_INGRESS_FIREWALL_RULE
APPLY_EGRESS_FIREWALL_RULE
APPLY_ROUTE
APPLY_FORWARDING_RULE
SPOOFING_APPROVED
ARRIVE_AT_INSTANCE	$
 ARRIVE_AT_INTERNAL_LOAD_BALANCER
$
 ARRIVE_AT_EXTERNAL_LOAD_BALANCER
ARRIVE_AT_VPN_GATEWAY
ARRIVE_AT_VPN_TUNNEL
ARRIVE_AT_VPC_CONNECTOR
NAT
PROXY_CONNECTION
DELIVER
DROP
FORWARD	
ABORT
VIEWER_PERMISSION_MISSINGB
	step_info"�
InstanceInfo
display_name (	
uri (	
	interface (	
network_uri (	
internal_ip (	
external_ip (	
network_tags (	
service_account (	B"J
NetworkInfo
display_name (	
uri (	
matched_ip_range (	"�
FirewallInfo
display_name (	
uri (	
	direction (	
action (	
priority (
network_uri (	
target_tags (	
target_service_accounts (	
policy	 (	\\
firewall_rule_type
 (2@.google.cloud.networkmanagement.v1.FirewallInfo.FirewallRuleType"�
FirewallRuleType"
FIREWALL_RULE_TYPE_UNSPECIFIED %
!HIERARCHICAL_FIREWALL_POLICY_RULE
VPC_FIREWALL_RULE
IMPLIED_VPC_FIREWALL_RULE/
+SERVERLESS_VPC_ACCESS_MANAGED_FIREWALL_RULE 
NETWORK_FIREWALL_POLICY_RULE)
%NETWORK_REGIONAL_FIREWALL_POLICY_RULE"�
	RouteInfoJ

route_type (26.google.cloud.networkmanagement.v1.RouteInfo.RouteTypeO
next_hop_type	 (28.google.cloud.networkmanagement.v1.RouteInfo.NextHopTypeL
route_scope (27.google.cloud.networkmanagement.v1.RouteInfo.RouteScope
display_name (	
uri (	
dest_ip_range (	
next_hop (	
network_uri (	
priority (
instance_tags (	
src_ip_range
 (	
dest_port_ranges (	
src_port_ranges (	
	protocols (	
ncc_hub_uri (	H �
ncc_spoke_uri (	H�"�
	RouteType
ROUTE_TYPE_UNSPECIFIED 

SUBNET

STATIC
DYNAMIC
PEERING_SUBNET
PEERING_STATIC
PEERING_DYNAMIC
POLICY_BASED"�
NextHopType
NEXT_HOP_TYPE_UNSPECIFIED 
NEXT_HOP_IP
NEXT_HOP_INSTANCE
NEXT_HOP_NETWORK
NEXT_HOP_PEERING
NEXT_HOP_INTERCONNECT
NEXT_HOP_VPN_TUNNEL
NEXT_HOP_VPN_GATEWAY
NEXT_HOP_INTERNET_GATEWAY
NEXT_HOP_BLACKHOLE	
NEXT_HOP_ILB

NEXT_HOP_ROUTER_APPLIANCE
NEXT_HOP_NCC_HUB"C

RouteScope
ROUTE_SCOPE_UNSPECIFIED 
NETWORK
NCC_HUBB
_ncc_hub_uriB
_ncc_spoke_uri"�
GoogleServiceInfo
	source_ip (	c
google_service_type (2F.google.cloud.networkmanagement.v1.GoogleServiceInfo.GoogleServiceType"v
GoogleServiceType#
GOOGLE_SERVICE_TYPE_UNSPECIFIED 
IAP$
 GFE_PROXY_OR_HEALTH_CHECK_PROBER
	CLOUD_DNS"�
ForwardingRuleInfo
display_name (	
uri (	
matched_protocol (	
matched_port_range (	
vip (	
target (	
network_uri (	"�
LoadBalancerInfo`
load_balancer_type (2D.google.cloud.networkmanagement.v1.LoadBalancerInfo.LoadBalancerType
health_check_uri (	H
backends (26.google.cloud.networkmanagement.v1.LoadBalancerBackendU
backend_type (2?.google.cloud.networkmanagement.v1.LoadBalancerInfo.BackendType
backend_uri (	"�
LoadBalancerType"
LOAD_BALANCER_TYPE_UNSPECIFIED 
INTERNAL_TCP_UDP
NETWORK_TCP_UDP

HTTP_PROXY
	TCP_PROXY
	SSL_PROXY"f
BackendType
BACKEND_TYPE_UNSPECIFIED 
BACKEND_SERVICE
TARGET_POOL
TARGET_INSTANCE"�
LoadBalancerBackend
display_name (	
uri (	t
health_check_firewall_state (2O.google.cloud.networkmanagement.v1.LoadBalancerBackend.HealthCheckFirewallState,
$health_check_allowing_firewall_rules (	,
$health_check_blocking_firewall_rules (	"j
HealthCheckFirewallState+
\'HEALTH_CHECK_FIREWALL_STATE_UNSPECIFIED 

CONFIGURED
MISCONFIGURED"�
VpnGatewayInfo
display_name (	
uri (	
network_uri (	

ip_address (	
vpn_tunnel_uri (	
region (	"�
VpnTunnelInfo
display_name (	
uri (	
source_gateway (	
remote_gateway (	
remote_gateway_ip (	
source_gateway_ip (	
network_uri (	
region (	R
routing_type	 (2<.google.cloud.networkmanagement.v1.VpnTunnelInfo.RoutingType"[
RoutingType
ROUTING_TYPE_UNSPECIFIED 
ROUTE_BASED
POLICY_BASED
DYNAMIC"�
EndpointInfo
	source_ip (	
destination_ip (	
protocol (	
source_port (
destination_port (
source_network_uri (	
destination_network_uri (	
source_agent_uri (	"�
DeliverInfoE
target (25.google.cloud.networkmanagement.v1.DeliverInfo.Target
resource_uri (	"�
Target
TARGET_UNSPECIFIED 
INSTANCE
INTERNET

GOOGLE_API

GKE_MASTER
CLOUD_SQL_INSTANCE
PSC_PUBLISHED_SERVICE
PSC_GOOGLE_API

PSC_VPC_SC
SERVERLESS_NEG	"�
ForwardInfoE
target (25.google.cloud.networkmanagement.v1.ForwardInfo.Target
resource_uri (	"�
Target
TARGET_UNSPECIFIED 
PEERING_VPC
VPN_GATEWAY
INTERCONNECT

GKE_MASTER"
IMPORTED_CUSTOM_ROUTE_NEXT_HOP
CLOUD_SQL_INSTANCE
ANOTHER_PROJECT
NCC_HUB"�
	AbortInfoA
cause (22.google.cloud.networkmanagement.v1.AbortInfo.Cause
resource_uri (	#
projects_missing_permission (	"�
Cause
CAUSE_UNSPECIFIED 
UNKNOWN_NETWORK

UNKNOWN_IP
UNKNOWN_PROJECT
PERMISSION_DENIED
NO_SOURCE_LOCATION
INVALID_ARGUMENT
NO_EXTERNAL_IP
UNINTENDED_DESTINATION
TRACE_TOO_LONG	
INTERNAL_ERROR

SOURCE_ENDPOINT_NOT_FOUND
MISMATCHED_SOURCE_NETWORK"
DESTINATION_ENDPOINT_NOT_FOUND"
MISMATCHED_DESTINATION_NETWORK
UNSUPPORTED
MISMATCHED_IP_VERSION&
"GKE_KONNECTIVITY_PROXY_UNSUPPORTED
RESOURCE_CONFIG_NOT_FOUND1
-GOOGLE_MANAGED_SERVICE_AMBIGUOUS_PSC_ENDPOINT$
 SOURCE_PSC_CLOUD_SQL_UNSUPPORTED&
"SOURCE_FORWARDING_RULE_UNSUPPORTED"�
DropInfo@
cause (21.google.cloud.networkmanagement.v1.DropInfo.Cause
resource_uri (	"�

Cause
CAUSE_UNSPECIFIED 
UNKNOWN_EXTERNAL_ADDRESS
FOREIGN_IP_DISALLOWED
FIREWALL_RULE
NO_ROUTE
ROUTE_BLACKHOLE
ROUTE_WRONG_NETWORK
PRIVATE_TRAFFIC_TO_INTERNET$
 PRIVATE_GOOGLE_ACCESS_DISALLOWED
NO_EXTERNAL_ADDRESS	
UNKNOWN_INTERNAL_ADDRESS

FORWARDING_RULE_MISMATCH#
FORWARDING_RULE_REGION_MISMATCH 
FORWARDING_RULE_NO_INSTANCES8
4FIREWALL_BLOCKING_LOAD_BALANCER_BACKEND_HEALTH_CHECK
INSTANCE_NOT_RUNNING
GKE_CLUSTER_NOT_RUNNING"
CLOUD_SQL_INSTANCE_NOT_RUNNING
TRAFFIC_TYPE_BLOCKED"
GKE_MASTER_UNAUTHORIZED_ACCESS*
&CLOUD_SQL_INSTANCE_UNAUTHORIZED_ACCESS
DROPPED_INSIDE_GKE_SERVICE$
 DROPPED_INSIDE_CLOUD_SQL_SERVICE%
!GOOGLE_MANAGED_SERVICE_NO_PEERING*
&GOOGLE_MANAGED_SERVICE_NO_PSC_ENDPOINT&
GKE_PSC_ENDPOINT_MISSING$$
 CLOUD_SQL_INSTANCE_NO_IP_ADDRESS%
!GKE_CONTROL_PLANE_REGION_MISMATCH3
/PUBLIC_GKE_CONTROL_PLANE_TO_PRIVATE_DESTINATION
GKE_CONTROL_PLANE_NO_ROUTE :
6CLOUD_SQL_INSTANCE_NOT_CONFIGURED_FOR_EXTERNAL_TRAFFIC!4
0PUBLIC_CLOUD_SQL_INSTANCE_TO_PRIVATE_DESTINATION"
CLOUD_SQL_INSTANCE_NO_ROUTE#
CLOUD_FUNCTION_NOT_ACTIVE
VPC_CONNECTOR_NOT_SET
VPC_CONNECTOR_NOT_RUNNING
PSC_CONNECTION_NOT_ACCEPTED 
CLOUD_RUN_REVISION_NOT_READY\'
#DROPPED_INSIDE_PSC_SERVICE_PRODUCER%%
!LOAD_BALANCER_HAS_NO_PROXY_SUBNET\'"k
GKEMasterInfo
cluster_uri (	
cluster_network_uri (	
internal_ip (	
external_ip (	"�
CloudSQLInstanceInfo
display_name (	
uri (	
network_uri (	
internal_ip (	
external_ip (	
region (	"\\
CloudFunctionInfo
display_name (	
uri (	
location (	

version_id ("`
CloudRunRevisionInfo
display_name (	
uri (	
location (	
service_uri (	"_
AppEngineVersionInfo
display_name (	
uri (	
runtime (	
environment (	"G
VpcConnectorInfo
display_name (	
uri (	
location (	*�
LoadBalancerType"
LOAD_BALANCER_TYPE_UNSPECIFIED  
HTTPS_ADVANCED_LOAD_BALANCER
HTTPS_LOAD_BALANCER 
REGIONAL_HTTPS_LOAD_BALANCER 
INTERNAL_HTTPS_LOAD_BALANCER
SSL_PROXY_LOAD_BALANCER
TCP_PROXY_LOAD_BALANCER$
 INTERNAL_TCP_PROXY_LOAD_BALANCER
NETWORK_LOAD_BALANCER 
LEGACY_NETWORK_LOAD_BALANCER	"
TCP_UDP_INTERNAL_LOAD_BALANCER
B�
%com.google.cloud.networkmanagement.v1B
TraceProtoPZScloud.google.com/go/networkmanagement/apiv1/networkmanagementpb;networkmanagementpb�!Google.Cloud.NetworkManagement.V1�!Google\\Cloud\\NetworkManagement\\V1�$Google::Cloud::NetworkManagement::V1bproto3'
        , true);

        static::$is_initialized = true;
    }
}

