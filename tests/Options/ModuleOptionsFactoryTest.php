<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Module;
use InvoiceNinjaModule\Options\AuthOptions;
use InvoiceNinjaModule\Options\AuthOptionsFactory;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use InvoiceNinjaModule\Options\ModuleOptions;
use InvoiceNinjaModule\Options\ModuleOptionsFactory;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate() :void
    {
        $config = [
            Module::INVOICE_NINJA_CONFIG => [
                Module::API_TIMEOUT => 100,
                Module::TOKEN_TYPE  => 'X-Ninja-Token',
                Module::TOKEN       => 'YOURTOKEN',
                Module::HOST_URL    => 'http://ninja.dev/api/v1',
            ]
        ];

        $authMock = $this->createMock(AuthOptionsInterface::class);
        $containerMock = $this->createMock(ContainerInterface::class);

        $containerMock->expects(self::at(0))
            ->method('get')
            ->with(self::stringContains('Config'))
            ->willReturn($config);

        $containerMock->expects(self::at(1))
            ->method('get')
            ->with(self::stringContains(AuthOptions::class))
            ->willReturn($authMock);

        $factory = new ModuleOptionsFactory();
        self::assertInstanceOf(ModuleOptionsFactory::class, $factory);

        $options = $factory($containerMock, 'test');
        self::assertInstanceOf(ModuleOptions::class, $options);
    }
}
