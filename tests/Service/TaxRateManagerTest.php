<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\TaxRateManagerInterface;
use InvoiceNinjaModule\Service\TaxRateManager;
use JsonException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TaxRateManagerTest extends TestCase
{
    private TaxRateManagerInterface $taxRateManager;
    private MockObject $objectManagerMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManagerMock = $this->createMock(ObjectServiceInterface::class);
        $this->taxRateManager    = new TaxRateManager($this->objectManagerMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(TaxRateManagerInterface::class, $this->taxRateManager);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testCreateProduct(): void
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

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testDelete(): void
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

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetProductById(): void
    {
        $taxRateMock = $this->createMock(TaxRateInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::isType('string'),
                self::stringContains('/tax_rates')
            )
            ->willReturn($taxRateMock);

        $this->taxRateManager = new TaxRateManager($this->objectManagerMock);

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->getTaxRateById('777'));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws NotFoundException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testGetProductByIdException(): void
    {
        $this->expectException(NotFoundException::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(TaxRateInterface::class),
                self::isType('string'),
                self::stringContains('/tax_rates')
            )
            ->willThrowException(new NotFoundException());

        self::assertInstanceOf(TaxRateInterface::class, $this->taxRateManager->getTaxRateById('777'));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testUpdate(): void
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

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testRestore(): void
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

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testArchive(): void
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

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllProductsEmpty(): void
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

        self::assertIsArray($this->taxRateManager->getAllTaxRates());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllProducts(): void
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

        self::assertIsArray($this->taxRateManager->getAllTaxRates());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllProductsOtherResult(): void
    {
        $this->expectException(InvalidResultException::class);

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

        self::assertIsArray($this->taxRateManager->getAllTaxRates());
    }
}
