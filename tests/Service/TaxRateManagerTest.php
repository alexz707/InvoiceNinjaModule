<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\TaxRateManagerInterface;
use InvoiceNinjaModule\Service\TaxRateManager;
use PHPUnit\Framework\TestCase;

class TaxRateManagerTest extends TestCase
{
    /** @var  TaxRateManagerInterface */
    private $taxRateManager;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $objectManagerMock;

    protected function setUp() : void
    {
        parent::setUp();

        $this->objectManagerMock = $this->createMock(ObjectServiceInterface::class);
        $this->taxRateManager    = new TaxRateManager($this->objectManagerMock);
    }

    public function testCreate() : void
    {
        self::assertInstanceOf(TaxRateManagerInterface::class, $this->taxRateManager);
    }

    public function testCreateProduct() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('createObject')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->createTaxRate($taxRateMock));
    }

    public function testDelete() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('deleteObject')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->delete($taxRateMock));
    }


    public function testGetProductById() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::isType('integer'),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->getTaxRateById(777));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\NotFoundException
     */
    public function testGetProductByIdException() : void
    {
        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::isType('integer'),
                self::stringContains('/tax_rates')
            )
            ->willThrowException(new NotFoundException());

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->getTaxRateById(777));
    }

    public function testUpdate() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('updateObject')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->update($taxRateMock));
    }

    public function testRestore() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('restoreObject')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->restore($taxRateMock));
    }

    public function testArchive() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('archiveObject')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->archive($taxRateMock));
    }

    public function testGetAllProductsEmpty() : void
    {
        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([]);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInternalType('array', $this->taxRateManager->getAllTaxRates());
    }

    public function testGetAllProducts() : void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $taxRateMock ]);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInternalType('array', $this->taxRateManager->getAllTaxRates());
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidResultException
     */
    public function testGetAllProductsOtherResult() : void
    {
        $taxRateMock = $this->createMock(BaseInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::stringContains('/tax_rates'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $taxRateMock ]);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInternalType('array', $this->taxRateManager->getAllTaxRates());
    }
}
