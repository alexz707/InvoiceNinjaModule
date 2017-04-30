<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Options;

use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use InvoiceNinjaModule\Options\Interfaces\ModuleOptionsInterface;
use InvoiceNinjaModule\Module;

/**
 * Class ModuleOptions
 */
final class ModuleOptions implements ModuleOptionsInterface
{
    /** @var AuthOptionsInterface  */
    private $authOptions;
    /** @var  string */
    private $token;
    /** @var  string */
    private $tokenType;
    /** @var  int */
    private $timeout;
    /** @var  string */
    private $hostUrl;

    /**
     * ModuleOptions constructor.
     *
     * @param array                $config
     * @param AuthOptionsInterface $authOptions
     *
     * @throws InvalidParameterException
     */
    public function __construct(array $config, AuthOptionsInterface $authOptions)
    {
        if (empty($config)) {
            throw new InvalidParameterException('No config provided!');
        }
        $this->setToken($config);
        $this->setTokenType($config);
        $this->setTimeout($config);
        $this->setHostUrl($config);
        $this->authOptions = $authOptions;
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
     * @return AuthOptionsInterface
     */
    public function getAuthOptions() : AuthOptionsInterface
    {
        return $this->authOptions;
    }

    /**
     * @param array $config
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setToken(array $config) :void
    {
        if (!\array_key_exists(Module::TOKEN, $config) || empty($config[Module::TOKEN])) {
            throw new InvalidParameterException('No or empty token provided!');
        }
        $this->token = $config[Module::TOKEN];
    }

    /**
     * @param array $config
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setTokenType(array $config) :void
    {
        if (!\array_key_exists(Module::TOKEN_TYPE, $config) || empty($config[Module::TOKEN_TYPE])) {
            throw new InvalidParameterException('No or empty token type provided!');
        }
        $this->tokenType = $config[Module::TOKEN_TYPE];
    }

    /**
     * @param array $config
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setTimeout(array $config) :void
    {
        if (!\array_key_exists(Module::API_TIMEOUT, $config)
            || !\is_int($config[Module::API_TIMEOUT])
            || $config[Module::API_TIMEOUT] < 0) {
            throw new InvalidParameterException('No or negative timeout provided!');
        }
        $this->timeout = $config[Module::API_TIMEOUT];
    }

    /**
     * @param array $config
     *
     * @return void
     * @throws InvalidParameterException
     */
    private function setHostUrl(array $config) :void
    {
        if (!\array_key_exists(Module::HOST_URL, $config) || empty($config[Module::HOST_URL])) {
            throw new InvalidParameterException('No or empty host url provided!');
        }
        $this->hostUrl = $config[Module::HOST_URL];
    }
}
