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
        if (empty($settings)) {
            throw new InvalidParameterException('No settings provided!');
        }
        $this->setToken($settings);
        $this->setTokenType($settings);
        $this->setTimeout($settings);
        $this->setHostUrl($settings);
    }

    /**
     * @return string
     */
    public function getToken() :string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getTokenType() :string
    {
        return $this->tokenType;
    }

    /**
     * @return int
     */
    public function getTimeout() :int
    {
        return $this->timeout;
    }

    /**
     * @return string
     */
    public function getHostUrl() :string
    {
        return $this->hostUrl;
    }

    /**
     * @param array $settings
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setToken(array $settings) :void
    {
        if (!array_key_exists(Module::TOKEN, $settings) || empty($settings[Module::TOKEN])) {
            throw new InvalidParameterException('No or empty token provided!');
        }
        $this->token = $settings[Module::TOKEN];
    }

    /**
     * @param array $settings
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setTokenType(array $settings) :void
    {
        if (!array_key_exists(Module::TOKEN_TYPE, $settings) || empty($settings[Module::TOKEN_TYPE])) {
            throw new InvalidParameterException('No or empty token type provided!');
        }
        $this->tokenType = $settings[Module::TOKEN_TYPE];
    }

    /**
     * @param array $settings
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setTimeout(array $settings) :void
    {
        if (!array_key_exists(Module::API_TIMEOUT, $settings)
            || !is_int($settings[Module::API_TIMEOUT])
            || $settings[Module::API_TIMEOUT] < 0) {
            throw new InvalidParameterException('No or negative timeout provided!');
        }
        $this->timeout = $settings[Module::API_TIMEOUT];
    }

    /**
     * @param array $settings
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setHostUrl(array $settings) :void
    {
        if (!array_key_exists(Module::HOST_URL, $settings) || empty($settings[Module::HOST_URL])) {
            throw new InvalidParameterException('No or empty host url provided!');
        }
        $this->hostUrl = $settings[Module::HOST_URL];
    }
}
