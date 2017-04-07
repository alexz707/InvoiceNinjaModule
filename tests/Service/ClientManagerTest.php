<?php

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\Interfaces\ApiManagerInterface;
use Zend\Http\Request;
use Zend\Hydrator\HydratorInterface;

class ClientManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ClientManager */
    private $clientManager;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $apiServiceMock;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $hydratorMock;

    protected function setUp()
    {
        parent::setUp();

        $this->apiServiceMock = $this->createMock(ApiManagerInterface::class);
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->clientManager = new ClientManager($this->apiServiceMock, $this->hydratorMock);
    }

    public function testCreate()
    {
        self::assertInstanceOf(ClientManager::class, $this->clientManager);
    }

    public function testCreateClient()
    {
        $clientMock = $this->createMock(ClientInterface::class);

        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_POST),
                self::isType('string'),
                self::isType('array')
            )
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('extract')
            ->with(self::isInstanceOf(ClientInterface::class))
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(ClientInterface::class)
            );

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->createClient($clientMock));
    }



    public function testDelete()
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(ClientInterface::class)
            );

        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_DELETE),
                self::isType('string'),
                self::isType('array')
            )
            ->willReturn([]);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->delete($clientMock));
    }


    public function testGetClientById()
    {
        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::isType('string'),
                self::isType('array')
            )
            ->willReturn([]);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->getClientById(777));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ClientNotFoundException
     */
    public function testGetClientByIdException()
    {
        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::isType('string'),
                self::isType('array')
            )
            ->willThrowException(new ApiException());

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->getClientById(777));
    }

    public function testUpdate()
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::once())
            ->method('extract')
            ->with(self::isInstanceOf(ClientInterface::class))
            ->willReturn([]);

        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_PUT),
                self::isType('string'),
                self::logicalAnd(
                    self::isType('array'),
                    self::isEmpty()
                )
            )
            ->willReturn([]);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->update($clientMock));
    }

    public function testRestore()
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::once())
            ->method('extract')
            ->with(self::isInstanceOf(ClientInterface::class))
            ->willReturn(['notempty']);

        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_PUT),
                self::isType('string'),
                self::logicalAnd(
                    self::isType('array'),
                    self::isEmpty()
                )
            )
            ->willReturn([]);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->restore($clientMock));
    }

    public function testArchive()
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::once())
            ->method('extract')
            ->with(self::isInstanceOf(ClientInterface::class))
            ->willReturn([]);

        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_PUT),
                self::isType('string'),
                self::isType('array')
            )
            ->willReturn([]);

        self::assertInstanceOf(ClientInterface::class, $this->clientManager->archive($clientMock));
    }

    public function testGetAllClients()
    {
        $this->apiServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::isType('string'),
                self::isType('array')
            )
            ->willReturn([]);

        self::assertInternalType('array', $this->clientManager->getAllClients());
    }
}
