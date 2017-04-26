<?php

namespace InvoiceNinjaModuleTest\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\InvoiceManager;
use InvoiceNinjaModule\Service\InvoiceManagerFactory;
use InvoiceNinjaModule\Service\ObjectService;
use PHPUnit\Framework\TestCase;

class InvoiceManagerFactoryTest extends TestCase
{
    public function testCreate()
    {
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects(self::once())
            ->method('get')
            ->with(self::stringContains(ObjectService::class))
            ->willReturn($this->createMock(ObjectServiceInterface::class));

        $factory = new InvoiceManagerFactory();
        $result = $factory($containerMock, 'test');
        self::assertInstanceOf(InvoiceManager::class, $result);
    }
}
