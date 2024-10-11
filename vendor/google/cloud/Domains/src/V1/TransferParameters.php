<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/domains/v1/domains.proto

namespace Google\Cloud\Domains\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Parameters required to transfer a domain from another registrar.
 *
 * Generated from protobuf message <code>google.cloud.domains.v1.TransferParameters</code>
 */
class TransferParameters extends \Google\Protobuf\Internal\Message
{
    /**
     * The domain name. Unicode domain names are expressed in Punycode format.
     *
     * Generated from protobuf field <code>string domain_name = 1;</code>
     */
    private $domain_name = '';
    /**
     * The registrar that currently manages the domain.
     *
     * Generated from protobuf field <code>string current_registrar = 2;</code>
     */
    private $current_registrar = '';
    /**
     * The name servers that currently store the configuration of the domain.
     *
     * Generated from protobuf field <code>repeated string name_servers = 3;</code>
     */
    private $name_servers;
    /**
     * Indicates whether the domain is protected by a transfer lock. For a
     * transfer to succeed, this must show `UNLOCKED`. To unlock a domain,
     * go to its current registrar.
     *
     * Generated from protobuf field <code>.google.cloud.domains.v1.TransferLockState transfer_lock_state = 4;</code>
     */
    private $transfer_lock_state = 0;
    /**
     * Contact privacy options that the domain supports.
     *
     * Generated from protobuf field <code>repeated .google.cloud.domains.v1.ContactPrivacy supported_privacy = 5;</code>
     */
    private $supported_privacy;
    /**
     * Price to transfer or renew the domain for one year.
     *
     * Generated from protobuf field <code>.google.type.Money yearly_price = 6;</code>
     */
    private $yearly_price = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $domain_name
     *           The domain name. Unicode domain names are expressed in Punycode format.
     *     @type string $current_registrar
     *           The registrar that currently manages the domain.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $name_servers
     *           The name servers that currently store the configuration of the domain.
     *     @type int $transfer_lock_state
     *           Indicates whether the domain is protected by a transfer lock. For a
     *           transfer to succeed, this must show `UNLOCKED`. To unlock a domain,
     *           go to its current registrar.
     *     @type array<int>|\Google\Protobuf\Internal\RepeatedField $supported_privacy
     *           Contact privacy options that the domain supports.
     *     @type \Google\Type\Money $yearly_price
     *           Price to transfer or renew the domain for one year.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Domains\V1\Domains::initOnce();
        parent::__construct($data);
    }

    /**
     * The domain name. Unicode domain names are expressed in Punycode format.
     *
     * Generated from protobuf field <code>string domain_name = 1;</code>
     * @return string
     */
    public function getDomainName()
    {
        return $this->domain_name;
    }

    /**
     * The domain name. Unicode domain names are expressed in Punycode format.
     *
     * Generated from protobuf field <code>string domain_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setDomainName($var)
    {
        GPBUtil::checkString($var, True);
        $this->domain_name = $var;

        return $this;
    }

    /**
     * The registrar that currently manages the domain.
     *
     * Generated from protobuf field <code>string current_registrar = 2;</code>
     * @return string
     */
    public function getCurrentRegistrar()
    {
        return $this->current_registrar;
    }

    /**
     * The registrar that currently manages the domain.
     *
     * Generated from protobuf field <code>string current_registrar = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCurrentRegistrar($var)
    {
        GPBUtil::checkString($var, True);
        $this->current_registrar = $var;

        return $this;
    }

    /**
     * The name servers that currently store the configuration of the domain.
     *
     * Generated from protobuf field <code>repeated string name_servers = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getNameServers()
    {
        return $this->name_servers;
    }

    /**
     * The name servers that currently store the configuration of the domain.
     *
     * Generated from protobuf field <code>repeated string name_servers = 3;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setNameServers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->name_servers = $arr;

        return $this;
    }

    /**
     * Indicates whether the domain is protected by a transfer lock. For a
     * transfer to succeed, this must show `UNLOCKED`. To unlock a domain,
     * go to its current registrar.
     *
     * Generated from protobuf field <code>.google.cloud.domains.v1.TransferLockState transfer_lock_state = 4;</code>
     * @return int
     */
    public function getTransferLockState()
    {
        return $this->transfer_lock_state;
    }

    /**
     * Indicates whether the domain is protected by a transfer lock. For a
     * transfer to succeed, this must show `UNLOCKED`. To unlock a domain,
     * go to its current registrar.
     *
     * Generated from protobuf field <code>.google.cloud.domains.v1.TransferLockState transfer_lock_state = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setTransferLockState($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Domains\V1\TransferLockState::class);
        $this->transfer_lock_state = $var;

        return $this;
    }

    /**
     * Contact privacy options that the domain supports.
     *
     * Generated from protobuf field <code>repeated .google.cloud.domains.v1.ContactPrivacy supported_privacy = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSupportedPrivacy()
    {
        return $this->supported_privacy;
    }

    /**
     * Contact privacy options that the domain supports.
     *
     * Generated from protobuf field <code>repeated .google.cloud.domains.v1.ContactPrivacy supported_privacy = 5;</code>
     * @param array<int>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSupportedPrivacy($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::ENUM, \Google\Cloud\Domains\V1\ContactPrivacy::class);
        $this->supported_privacy = $arr;

        return $this;
    }

    /**
     * Price to transfer or renew the domain for one year.
     *
     * Generated from protobuf field <code>.google.type.Money yearly_price = 6;</code>
     * @return \Google\Type\Money|null
     */
    public function getYearlyPrice()
    {
        return $this->yearly_price;
    }

    public function hasYearlyPrice()
    {
        return isset($this->yearly_price);
    }

    public function clearYearlyPrice()
    {
        unset($this->yearly_price);
    }

    /**
     * Price to transfer or renew the domain for one year.
     *
     * Generated from protobuf field <code>.google.type.Money yearly_price = 6;</code>
     * @param \Google\Type\Money $var
     * @return $this
     */
    public function setYearlyPrice($var)
    {
        GPBUtil::checkMessage($var, \Google\Type\Money::class);
        $this->yearly_price = $var;

        return $this;
    }

}

