<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use InvoiceNinjaModule\Service\ObjectService;
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

    protected function setUp() :void
    {
        parent::setUp();

        $this->requestServiceMock = $this->createMock(RequestServiceInterface::class);
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->testRoute = '/tests';

        $this->objectManager = new ObjectService($this->requestServiceMock, $this->hydratorMock);
    }

    public function testCreate() :void
    {
        self::assertInstanceOf(ObjectService::class, $this->objectManager);
    }

    public function testCreateObject() :void
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

    public function testDeleteObject() :void
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


    public function testGetObjectById() :void
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

        self::assertInstanceOf(
            BaseInterface::class,
            $this->objectManager->getObjectById($baseMock, 777, $this->testRoute)
        );
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\NotFoundException
     */
    public function testGetObjectByIdException() :void
    {
        $baseMock = $this->createMock(BaseInterface::class);

        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains($this->testRoute),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willThrowException(new EmptyResponseException());

        self::assertInstanceOf(
            BaseInterface::class,
            $this->objectManager->getObjectById($baseMock, 777, $this->testRoute)
        );
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testFindObjectByException() :void
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = [];
        self::assertInstanceOf(
            BaseInterface::class,
            $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute)
        );
    }

    public function testFindObjectByEmpty() :void
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

    public function testFindObjectByEmptyException() :void
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

    public function testFindObjectBy() :void
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


    public function testFindObjectByApiException() :void
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

    public function testUpdate() :void
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

    public function testArchive() :void
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

    public function testRestore() :void
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

    public function testGetAllObjectsEmpty() :void
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

    public function testGetAllClients() :void
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

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\InvalidResultException
     */
    public function testGetAllClientsException() :void
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
            ->willReturn($this->createMock(\stdClass::class));

        self::assertInternalType('array', $this->objectManager->getAllObjects($baseMock, $this->testRoute));
    }

    public function testDownloadFile() :void
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

    public function testSendCommand() :void
    {
        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_POST),
                self::stringContains('/testcommand'),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn(['test' => 'test2' ]);
        $this->objectManager->sendCommand('testcommand', ['id'=>123]);
    }
}
