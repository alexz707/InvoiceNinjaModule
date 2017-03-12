<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Model\Interfaces\SettingsInterface;
use InvoiceNinjaModule\Module;

/**
 * Class Settings
 *
 * @package InvoiceNinjaModule\Model
 */
final class Settings implements SettingsInterface
{
    /** @var  string */
    private $token;
    /** @var  string */
    private $tokenType;
    /** @var  int */
    private $timeout;
    /** @var  string */
    private $hostUrl;

    /**
     * Config constructor.
     *
     * @param array $settings
     *
     * @throws InvalidParameterException
     */
    public function __construct(array $settings)
    {
        $this->setSettings($settings);
    }

    /**
     * @param array $settings
     *
     * @throws InvalidParameterException
     */
    private function setSettings(array $settings)
    {
        if( !array_key_exists(Module::TOKEN, $settings) || empty($settings[Module::TOKEN]))
        {
            throw new InvalidParameterException('No or empty token provided!');
        }
        if( !array_key_exists(Module::TOKEN_TYPE, $settings) || empty($settings[Module::TOKEN_TYPE]))
        {
            throw new InvalidParameterException('No or empty token type provided!');
        }
        if( !array_key_exists(Module::API_TIMEOUT, $settings) || $settings[Module::API_TIMEOUT] < 0)
        {
            throw new InvalidParameterException('No or negative timeout provided!');
        }
        if( !array_key_exists(Module::HOST_URL, $settings) || empty($settings[Module::HOST_URL]))
        {
            throw new InvalidParameterException('No or empty host url provided!');
        }
        $this->token = $settings[Module::TOKEN];
        $this->tokenType = $settings[Module::TOKEN_TYPE];
        $this->timeout = $settings[Module::API_TIMEOUT];
        $this->hostUrl = $settings[Module::HOST_URL];
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @return string
     */
    public function getHostUrl()
    {
        return $this->hostUrl;
    }
}
