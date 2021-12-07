<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Options;

use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Module;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use Laminas\Http\Client;

final class AuthOptions implements AuthOptionsInterface
{
    private bool $isAuthorization = false;
    private string $authType = 'none';
    private string $username = '';
    private string $password = '';

    /**
     * Config constructor.
     *
     * @param array $config
     *
     * @throws InvalidParameterException
     */
    public function __construct(array $config)
    {
        if (!empty($config)) {
            $this->checkAuthorization($config);
            $this->setAuthType($config);
            $this->checkCredentials($config);
        }
    }

    /**
     * @return bool
     */
    public function isAuthorization() : bool
    {
        return $this->isAuthorization;
    }

    /**
     * @return string
     */
    public function getAuthType() : string
    {
        return $this->authType;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param array $config
     *
     * @throws InvalidParameterException
     */
    private function checkCredentials(array $config) :void
    {
        $this->checkUsername($config[$this->authType]);
        $this->checkPassword($config[$this->authType]);
    }

    /**
     * @param array $config
     *
     * @throws InvalidParameterException
     */
    private function checkUsername(array $config) :void
    {
        if (!\array_key_exists(Module::AUTH_USER, $config) || empty($config[Module::AUTH_USER])) {
            throw new InvalidParameterException('Username must not be empty!');
        }
        $this->username = $config[Module::AUTH_USER];
    }

    /**
     * @param array $config
     *
     * @throws InvalidParameterException
     */
    private function checkPassword(array $config) :void
    {
        if (!\array_key_exists(Module::AUTH_PASS, $config) || empty($config[Module::AUTH_PASS])) {
            throw new InvalidParameterException('Password must not be empty!');
        }
        $this->password = $config[Module::AUTH_PASS];
    }

    /**
     * @param array $config
     */
    private function setAuthType(array $config) :void
    {
        $this->authType = Client::AUTH_BASIC;
        if (\array_key_exists(Client::AUTH_DIGEST, $config)) {
            $this->authType = Client::AUTH_DIGEST;
        }
    }

    /**
     * @param array $config
     *
     * @throws InvalidParameterException
     */
    private function checkAuthorization(array $config) :void
    {
        if (count($config) > 1) {
            throw new InvalidParameterException('Only one authorization config allowed!');
        }
        if (!\array_key_exists(Client::AUTH_BASIC, $config) && !\array_key_exists(Client::AUTH_DIGEST, $config)) {
            throw new InvalidParameterException('Only BASIC or DIGEST authorization allowed!');
        }
        $this->isAuthorization = true;
    }
}
