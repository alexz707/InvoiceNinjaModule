<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\ProductManagerInterface;
use InvoiceNinjaModule\Service\InvoiceManager;
use InvoiceNinjaModule\Service\InvoiceManagerFactory;
use InvoiceNinjaModule\Service\ObjectService;
use InvoiceNinjaModule\Service\ProductManagerFactory;
use PHPUnit\Framework\TestCase;

class ProductManagerFactoryTest extends TestCase
{
    public function testCreate() :void
    {
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects(self::once())
            ->method('get')
            ->with(self::stringContains(ObjectService::class))
            ->willReturn($this->createMock(ObjectServiceInterface::class));

        $factory = new ProductManagerFactory();
        $result = $factory($containerMock, 'test');
        self::assertInstanceOf(ProductManagerInterface::class, $result);
    }
}
