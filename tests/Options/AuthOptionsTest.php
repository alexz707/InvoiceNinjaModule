<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Module;
use InvoiceNinjaModule\Options\AuthOptions;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use PHPUnit\Framework\TestCase;
use Laminas\Http\Client;

class AuthOptionsTest extends TestCase
{
    public function testCreateEmptySettings() :void
    {
        $auth = new AuthOptions([]);
        self::assertInstanceOf(AuthOptionsInterface::class, $auth);
        self::assertFalse($auth->isAuthorization());
        self::assertEquals('none', $auth->getAuthType());
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateMoreThanOneConfig() :void
    {
        $this->expectException(InvalidParameterException::class);

        $authSettings = [
            Client::AUTH_BASIC => [],
            Client::AUTH_DIGEST => []
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateNoAuthConfig() :void
    {
        $this->expectException(InvalidParameterException::class);

        $authSettings = [
            'test' => []
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateNoUser() :void
    {
        $this->expectException(InvalidParameterException::class);

        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_PASS => 'password'
            ],
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptyUser() :void
    {
        $this->expectException(InvalidParameterException::class);

        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_USER => '',
                Module::AUTH_PASS => 'password'
            ],
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateNoPassword() :void
    {
        $this->expectException(InvalidParameterException::class);

        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_USER => 'username'
            ],
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptyPassword() :void
    {
        $this->expectException(InvalidParameterException::class);

        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_USER => 'username',
                Module::AUTH_PASS => ''
            ],
        ];

        new AuthOptions($authSettings);
    }

    public function testCreateBasic() :void
    {
        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_USER => 'username',
                Module::AUTH_PASS => 'password'
            ],
        ];

        $auth = new AuthOptions($authSettings);
        self::assertInstanceOf(AuthOptionsInterface::class, $auth);

        self::assertTrue($auth->isAuthorization());
        self::assertEquals(Client::AUTH_BASIC, $auth->getAuthType());
        self::assertEquals('username', $auth->getUsername());
        self::assertEquals('password', $auth->getPassword());
    }

    public function testCreateDigest() :void
    {
        $authSettings = [
            Client::AUTH_DIGEST => [
                Module::AUTH_USER => 'username',
                Module::AUTH_PASS => 'password'
            ],
        ];

        $auth = new AuthOptions($authSettings);
        self::assertInstanceOf(AuthOptionsInterface::class, $auth);

        self::assertTrue($auth->isAuthorization());
        self::assertEquals(Client::AUTH_DIGEST, $auth->getAuthType());
        self::assertEquals('username', $auth->getUsername());
        self::assertEquals('password', $auth->getPassword());
    }
}
