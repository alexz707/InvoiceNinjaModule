<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use InvoiceNinjaModule\Module;
use InvoiceNinjaModule\Options\AuthOptions;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use PHPUnit\Framework\TestCase;
use Zend\Http\Client;

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
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateMoreThanOneConfig() :void
    {
        $authSettings = [
            Client::AUTH_BASIC => [],
            Client::AUTH_DIGEST => []
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateNoAuthConfig() :void
    {
        $authSettings = [
            'test' => []
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateNoUser() :void
    {
        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_PASS => 'password'
            ],
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyUser() :void
    {
        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_USER => '',
                Module::AUTH_PASS => 'password'
            ],
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateNoPassword() :void
    {
        $authSettings = [
            Client::AUTH_BASIC => [
                Module::AUTH_USER => 'username'
            ],
        ];

        new AuthOptions($authSettings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyPassword() :void
    {
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
