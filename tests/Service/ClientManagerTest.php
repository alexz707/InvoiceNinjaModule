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
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use JsonException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ClientManagerTest extends TestCase
{
    private ClientManagerInterface $clientManager;
    private MockObject $objectManagerMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManagerMock = $this->createMock(ObjectServiceInterface::class);
        $this->clientManager = new ClientManager($this->objectManagerMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(ClientManagerInterface::class, $this->clientManager);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testCreateClient(): void
    {
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('createObject')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients')
            )
            ->willReturn($clientMock);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->createClient($clientMock));
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
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('deleteObject')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients')
            )
            ->willReturn($clientMock);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->delete($clientMock));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetClientById(): void
    {
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::isType('string'),
                self::stringContains('/clients')
            )
            ->willReturn($clientMock);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->getClientById('777'));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws NotFoundException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testGetClientByIdException(): void
    {
        $this->expectException(NotFoundException::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getObjectById')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::isType('string'),
                self::stringContains('/clients')
            )
            ->willThrowException(new NotFoundException());

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->getClientById('777'));
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws InvalidParameterException
     */
    public function testFindClientsByEmail(): void
    {
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('findObjectBy')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::isType('array'),
                self::stringContains('/clients')
            )
            ->willReturn([$clientMock]);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        $result = $this->clientManager->findClientsByEmail('test@test.com');
        self::assertIsArray($result);
        self::assertNotEmpty($result);
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testFindClientsByIdNumber(): void
    {
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('findObjectBy')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::isType('array'),
                self::stringContains('/clients')
            )
            ->willReturn([$clientMock]);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        $result = $this->clientManager->findClientsByIdNumber('12343');

        self::assertIsArray($result);
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
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('updateObject')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients')
            )
            ->willReturn($clientMock);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->update($clientMock));
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
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('restoreObject')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients')
            )
            ->willReturn($clientMock);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->restore($clientMock));
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
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('archiveObject')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients')
            )
            ->willReturn($clientMock);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->archive($clientMock));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllClientsEmpty(): void
    {
        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([]);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertIsArray($this->clientManager->getAllClients());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllClients(): void
    {
        $clientMock = $this->createMock(ClientInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $clientMock ]);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertIsArray($this->clientManager->getAllClients());
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllClientsOtherResult(): void
    {
        $this->expectException(InvalidResultException::class);

        $clientMock = $this->createMock(BaseInterface::class);

        $this->objectManagerMock->expects(self::once())
            ->method('getAllObjects')
            ->with(
                self::isInstanceOf(ClientInterface::class),
                self::stringContains('/clients'),
                self::isType('integer'),
                self::isType('integer')
            )
            ->willReturn([ 'test' => $clientMock ]);

        $this->clientManager = new ClientManager($this->objectManagerMock);

        self::assertIsArray($this->clientManager->getAllClients());
    }
}
