<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/networksecurity/v1beta1/tls.proto

namespace Google\Cloud\NetworkSecurity\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Specification of certificate provider. Defines the mechanism to obtain the
 * certificate and private key for peer to peer authentication.
 *
 * Generated from protobuf message <code>google.cloud.networksecurity.v1beta1.CertificateProvider</code>
 */
class CertificateProvider extends \Google\Protobuf\Internal\Message
{
    protected $type;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\NetworkSecurity\V1beta1\GrpcEndpoint $grpc_endpoint
     *           gRPC specific configuration to access the gRPC server to
     *           obtain the cert and private key.
     *     @type \Google\Cloud\NetworkSecurity\V1beta1\CertificateProviderInstance $certificate_provider_instance
     *           The certificate provider instance specification that will be passed to
     *           the data plane, which will be used to load necessary credential
     *           information.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Networksecurity\V1Beta1\Tls::initOnce();
        parent::__construct($data);
    }

    /**
     * gRPC specific configuration to access the gRPC server to
     * obtain the cert and private key.
     *
     * Generated from protobuf field <code>.google.cloud.networksecurity.v1beta1.GrpcEndpoint grpc_endpoint = 2;</code>
     * @return \Google\Cloud\NetworkSecurity\V1beta1\GrpcEndpoint|null
     */
    public function getGrpcEndpoint()
    {
        return $this->readOneof(2);
    }

    public function hasGrpcEndpoint()
    {
        return $this->hasOneof(2);
    }

    /**
     * gRPC specific configuration to access the gRPC server to
     * obtain the cert and private key.
     *
     * Generated from protobuf field <code>.google.cloud.networksecurity.v1beta1.GrpcEndpoint grpc_endpoint = 2;</code>
     * @param \Google\Cloud\NetworkSecurity\V1beta1\GrpcEndpoint $var
     * @return $this
     */
    public function setGrpcEndpoint($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\NetworkSecurity\V1beta1\GrpcEndpoint::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * The certificate provider instance specification that will be passed to
     * the data plane, which will be used to load necessary credential
     * information.
     *
     * Generated from protobuf field <code>.google.cloud.networksecurity.v1beta1.CertificateProviderInstance certificate_provider_instance = 3;</code>
     * @return \Google\Cloud\NetworkSecurity\V1beta1\CertificateProviderInstance|null
     */
    public function getCertificateProviderInstance()
    {
        return $this->readOneof(3);
    }

    public function hasCertificateProviderInstance()
    {
        return $this->hasOneof(3);
    }

    /**
     * The certificate provider instance specification that will be passed to
     * the data plane, which will be used to load necessary credential
     * information.
     *
     * Generated from protobuf field <code>.google.cloud.networksecurity.v1beta1.CertificateProviderInstance certificate_provider_instance = 3;</code>
     * @param \Google\Cloud\NetworkSecurity\V1beta1\CertificateProviderInstance $var
     * @return $this
     */
    public function setCertificateProviderInstance($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\NetworkSecurity\V1beta1\CertificateProviderInstance::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->whichOneof("type");
    }

}

