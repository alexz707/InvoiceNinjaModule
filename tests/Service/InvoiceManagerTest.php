<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;
use InvoiceNinjaModule\Service\Interfaces\InvoiceManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\InvoiceManager;
use JsonException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InvoiceManagerTest extends TestCase
{
    private InvoiceManagerInterface $invoiceManager;
    private MockObject $objectManagerMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManagerMock = $this->createMock(ObjectServiceInterface::class);
        $this->invoiceManager    = new InvoiceManager($this->objectManagerMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(InvoiceManagerInterface::class, $this->invoiceManager);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testCreateInvoice(): void
    {
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('createObject')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices')
            )
            ->willReturn($invoiceMock);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->createInvoice($invoiceMock));
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
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('deleteObject')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices')
            )
            ->willReturn($invoiceMock);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->delete($invoiceMock));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetInvoiceById(): void
    {
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::isType('string'),
                self::stringContains('/invoices')
            )
            ->willReturn($invoiceMock);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->getInvoiceById('777'));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws NotFoundException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testGetInvoiceByIdException(): void
    {
        $this->expectException(NotFoundException::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::isType('string'),
                self::stringContains('/invoices')
            )
            ->willThrowException(new NotFoundException());

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->getInvoiceById('777'));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetInvoiceByNumber(): void
    {
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('findObjectBy')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::isType('array'),
                self::stringContains('/invoices')
            )
            ->willReturn([$invoiceMock]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        $result = $this->invoiceManager->getInvoiceByNumber('12345');
        self::assertInstanceOf(InvoiceInterface::class, $result);
        self::assertNotEmpty($result);
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetInvoiceByNumberNotFound(): void
    {
        $this->expectException(NotFoundException::class);

        $this->objectManagerMock->expects(self::once())
            ->method('findObjectBy')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::isType('array'),
                self::stringContains('/invoices')
            )
            ->willReturn([]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        $result = $this->invoiceManager->getInvoiceByNumber('12345');
        self::assertInstanceOf(InvoiceInterface::class, $result);
        self::assertNotEmpty($result);
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetInvoiceByNumberInvalid(): void
    {
        $this->expectException(InvalidResultException::class);

        $this->objectManagerMock->expects(self::once())
            ->method('findObjectBy')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::isType('array'),
                self::stringContains('/invoices')
            )
            ->willReturn([1,2,3]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        $result = $this->invoiceManager->getInvoiceByNumber('12345');
        self::assertInstanceOf(InvoiceInterface::class, $result);
        self::assertNotEmpty($result);
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
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('updateObject')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices')
            )
            ->willReturn($invoiceMock);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->update($invoiceMock));
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
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('restoreObject')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices')
            )
            ->willReturn($invoiceMock);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->restore($invoiceMock));
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
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('archiveObject')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices')
            )
            ->willReturn($invoiceMock);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertInstanceOf(InvoiceInterface::class, $this->invoiceManager->archive($invoiceMock));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllInvoicesEmpty(): void
    {
        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertIsArray($this->invoiceManager->getAllInvoices());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllInvoices(): void
    {
        $invoiceMock = $this->createMock(InvoiceInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $invoiceMock ]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertIsArray($this->invoiceManager->getAllInvoices());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllInvoicesOtherResult(): void
    {
        $this->expectException(InvalidResultException::class);

        $invoiceMock = $this->createMock(BaseInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(InvoiceInterface::class),
                self::stringContains('/invoices'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $invoiceMock ]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertIsArray($this->invoiceManager->getAllInvoices());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDownloadInvoice(): void
    {
        $this->objectManagerMock->expects(self::once())
            ->method('downloadFile')
            ->with(self::isType('string'))
            ->willReturn([ 'test' => 'test' ]);

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        self::assertIsArray($this->invoiceManager->downloadInvoice('10'));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testSendEmailInvoice(): void
    {
        $this->objectManagerMock->expects(self::once())
            ->method('sendBulkCommand')
            ->with(
                self::stringContains(ObjectServiceInterface::ACTION_EMAIL),
                self::isType('array')
            );

        $this->invoiceManager = new InvoiceManager($this->objectManagerMock);

        $this->invoiceManager->sendInvoicesEmail(['10']);
    }
}
