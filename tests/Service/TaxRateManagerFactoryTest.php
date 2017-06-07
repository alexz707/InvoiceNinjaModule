<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\TaxRateManagerInterface;
use InvoiceNinjaModule\Service\ObjectService;
use InvoiceNinjaModule\Service\TaxRateManagerFactory;
use PHPUnit\Framework\TestCase;

class TaxRateManagerFactoryTest extends TestCase
{
    public function testCreate() :void
    {
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects(self::once())
            ->method('get')
            ->with(self::stringContains(ObjectService::class))
            ->willReturn($this->createMock(ObjectServiceInterface::class));

        $factory = new TaxRateManagerFactory();
        $result = $factory($containerMock, 'test');
        self::assertInstanceOf(TaxRateManagerInterface::class, $result);
    }
}
