<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\ProductInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\ProductManagerInterface;
use InvoiceNinjaModule\Service\ProductManager;
use PHPUnit\Framework\TestCase;

class ProductManagerTest extends TestCase
{
    /** @var  ProductManagerInterface */
    private $productManager;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $objectManagerMock;

    protected function setUp() : void
    {
        parent::setUp();

        $this->objectManagerMock = $this->createMock(ObjectServiceInterface::class);
        $this->productManager    = new ProductManager($this->objectManagerMock);
    }

    public function testCreate() : void
    {
        self::assertInstanceOf(ProductManagerInterface::class, $this->productManager);
    }

    public function testCreateProduct() : void
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

    public function testDelete() : void
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


    public function testGetProductById() : void
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
     * @throws NotFoundException
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     */
    public function testGetProductByIdException() : void
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

    public function testUpdate() : void
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

    public function testRestore() : void
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

    public function testArchive() : void
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

    public function testGetAllProductsEmpty() : void
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

    public function testGetAllProducts() : void
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
     * @throws InvalidResultException
     */
    public function testGetAllProductsOtherResult() : void
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
