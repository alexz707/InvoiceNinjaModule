<?php

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use InvoiceNinjaModule\Service\ObjectService;
use InvoiceNinjaModule\Service\RequestService;
use Zend\Http\Request;
use Zend\Hydrator\HydratorInterface;
use PHPUnit\Framework\TestCase;

class ObjectManagerTest extends TestCase
{
    /** @var  ObjectService */
    private $objectManager;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $requestServiceMock;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $hydratorMock;
    /** @var  string */
    private $testRoute;

    protected function setUp()
    {
        parent::setUp();

        $this->requestServiceMock = $this->createMock(RequestServiceInterface::class);
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->testRoute = '/tests';

        $this->objectManager = new ObjectService($this->requestServiceMock, $this->hydratorMock);
    }

    public function testCreate()
    {
        self::assertInstanceOf(ObjectService::class, $this->objectManager);
    }

    public function testCreateObject()
    {
        $baseMock = $this->createMock(BaseInterface::class);

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_POST),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('extract')
            ->with(self::isInstanceOf(BaseInterface::class))
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($baseMock);

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->createObject($baseMock, $this->testRoute));
    }

    public function testDeleteObject()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_DELETE),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->deleteObject($baseMock, $this->testRoute));
    }


    public function testGetObjectById()
    {
        $baseMock = $this->createMock(BaseInterface::class);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->getObjectById($baseMock, 777, $this->testRoute));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\NotFoundException
     */
    public function testGetObjectByIdException()
    {
        $baseMock = $this->createMock(BaseInterface::class);

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willThrowException(new ApiException());

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->getObjectById($baseMock, 777, $this->testRoute));
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testFindObjectByException()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = [];
        self::assertInstanceOf(BaseInterface::class, $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute));
    }

    public function testFindObjectByEmpty()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = ['test' => 'tester123'];


        $this->hydratorMock->expects(self::never())
            ->method('hydrate');

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        $result = $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute);

        self::assertEmpty($result);
        self::assertInternalType('array', $result);
    }

    public function testFindObjectByEmptyException()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = ['test' => 'tester123'];


        $this->hydratorMock->expects(self::never())
            ->method('hydrate');

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willThrowException(new EmptyResponseException());

        $result = $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute);

        self::assertEmpty($result);
        self::assertInternalType('array', $result);
    }

    public function testFindObjectBy()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = ['test' => 'tester123'];


        $this->hydratorMock->expects(self::exactly(2))
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn(['test1' => [], 'test2' => [],]);

        $result = $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute);

        self::assertNotEmpty($result);
        self::assertInternalType('array', $result);
    }


    /**
     * @expectedException \InvoiceNinjaModule\Exception\ApiException
     */
    public function testFindObjectByApiException()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = ['test' => 'tester123'];


        $this->hydratorMock->expects(self::never())
            ->method('hydrate');

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willThrowException(new ApiException());

        $result = $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute);

        self::assertEmpty($result);
        self::assertInternalType('array', $result);
    }




    public function testUpdate()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::once())
            ->method('extract')
            ->with(self::isInstanceOf(BaseInterface::class))
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_PUT),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->updateObject($baseMock, $this->testRoute));
    }

    public function testArchive()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::never())
            ->method('extract')
            ->with(self::isInstanceOf(BaseInterface::class))
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_PUT),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->archiveObject($baseMock, $this->testRoute));
    }

    public function testRestore()
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn(777);

        $this->hydratorMock->expects(self::never())
            ->method('extract')
            ->with(self::isInstanceOf(BaseInterface::class))
            ->willReturn([]);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_PUT),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        self::assertInstanceOf(BaseInterface::class, $this->objectManager->restoreObject($baseMock, $this->testRoute));
    }

    public function testGetAllObjectsEmpty()
    {
        $baseMock = $this->createMock(BaseInterface::class);

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn([]);

        self::assertInternalType('array', $this->objectManager->getAllObjects($baseMock, $this->testRoute));
    }

    public function testGetAllClients()
    {
        $baseMock = $this->createMock(BaseInterface::class);

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn(['test' => ['id' => 1] ]);

        $this->hydratorMock->expects(self::once())
            ->method('hydrate')
            ->with(
                self::isType('array'),
                self::isInstanceOf(BaseInterface::class)
            )
            ->willReturn($this->createMock(BaseInterface::class));

        self::assertInternalType('array', $this->objectManager->getAllObjects($baseMock, $this->testRoute));
    }

    public function testDownloadFile()
    {
        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains('/download'),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn(['test' => 'test2' ]);
        self::assertInternalType('array', $this->objectManager->downloadFile(1));
    }
}
