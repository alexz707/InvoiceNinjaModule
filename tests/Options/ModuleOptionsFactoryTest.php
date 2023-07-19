<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Module;
use InvoiceNinjaModule\Options\AuthOptions;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use InvoiceNinjaModule\Options\ModuleOptions;
use InvoiceNinjaModule\Options\ModuleOptionsFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ModuleOptionsFactoryTest extends TestCase
{
    /**
     * @throws InvalidParameterException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testCreate(): void
    {
        $config = [
            Module::INVOICE_NINJA_CONFIG => [
                Module::API_TIMEOUT => 100,
                Module::TOKEN_TYPE  => 'X-Ninja-Token',
                Module::TOKEN       => 'YOURTOKEN',
                Module::HOST_URL    => 'https://ninja.dev/api/v1',
            ]
        ];

        $authMock = $this->createMock(AuthOptionsInterface::class);
        $containerMock = $this->createMock(ContainerInterface::class);

        $containerMock->method('get')
            ->withConsecutive([self::stringContains('Config')], [self::stringContains(AuthOptions::class)])
            ->willReturnOnConsecutiveCalls($config, $authMock);

        $factory = new ModuleOptionsFactory();
        self::assertInstanceOf(ModuleOptionsFactory::class, $factory);

        $options = $factory($containerMock, 'test');
        self::assertInstanceOf(ModuleOptions::class, $options);
    }
}
