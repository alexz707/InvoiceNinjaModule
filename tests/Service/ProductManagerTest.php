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
use InvoiceNinjaModule\Model\Interfaces\ProductInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\ProductManagerInterface;
use InvoiceNinjaModule\Service\ProductManager;
use JsonException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProductManagerTest extends TestCase
{
    private ProductManagerInterface $productManager;
    private MockObject $objectManagerMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManagerMock = $this->createMock(ObjectServiceInterface::class);
        $this->productManager    = new ProductManager($this->objectManagerMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(ProductManagerInterface::class, $this->productManager);
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('createObject')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products')
            )
            ->willReturn($productMock);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertInstanceOf(ProductInterface::class, $this->productManager->createProduct($productMock));
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('deleteObject')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products')
            )
            ->willReturn($productMock);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertInstanceOf(ProductInterface::class, $this->productManager->delete($productMock));
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::isType('string'),
                self::stringContains('/products')
            )
            ->willReturn($productMock);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertInstanceOf(ProductInterface::class, $this->productManager->getProductById('777'));
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
                self::isInstanceOf(ProductInterface::class),
                self::isType('string'),
                self::stringContains('/products')
            )
            ->willThrowException(new NotFoundException());

        self::assertInstanceOf(ProductInterface::class, $this->productManager->getProductById('777'));
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('updateObject')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products')
            )
            ->willReturn($productMock);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertInstanceOf(ProductInterface::class, $this->productManager->update($productMock));
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('restoreObject')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products')
            )
            ->willReturn($productMock);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertInstanceOf(ProductInterface::class, $this->productManager->restore($productMock));
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('archiveObject')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products')
            )
            ->willReturn($productMock);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertInstanceOf(ProductInterface::class, $this->productManager->archive($productMock));
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
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([]);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertIsArray($this->productManager->getAllProducts());
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
        $productMock = $this->createMock(ProductInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $productMock ]);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertIsArray($this->productManager->getAllProducts());
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
        $productMock = $this->createMock(BaseInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(ProductInterface::class),
                self::stringContains('/products'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $productMock ]);

        $this->productManager = new ProductManager($this->objectManagerMock);

        self::assertIsArray($this->productManager->getAllProducts());
    }
}
