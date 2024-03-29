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
use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use InvoiceNinjaModule\Service\ObjectService;
use JsonException;
use Laminas\Http\Request;
use Laminas\Hydrator\HydratorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

class ObjectManagerTest extends TestCase
{
    private ObjectService $objectManager;
    private MockObject $requestServiceMock;
    private MockObject $hydratorMock;
    private string $testRoute = '/tests';

    protected function setUp(): void
    {
        parent::setUp();

        $this->requestServiceMock = $this->createMock(RequestServiceInterface::class);
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->objectManager = new ObjectService($this->requestServiceMock, $this->hydratorMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(ObjectService::class, $this->objectManager);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testCreateObject(): void
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

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testDeleteObject(): void
    {
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn('777');

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

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetObjectById(): void
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
            $this->objectManager->getObjectById($baseMock, '777', $this->testRoute)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function testGetObjectByIdException(): void
    {
        $this->expectException(NotFoundException::class);

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
            $this->objectManager->getObjectById($baseMock, '777', $this->testRoute)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testFindObjectByException(): void
    {
        $this->expectException(InvalidParameterException::class);

        $baseMock = $this->createMock(BaseInterface::class);
        $searchTerm = [];
        self::assertInstanceOf(
            BaseInterface::class,
            $this->objectManager->findObjectBy($baseMock, $searchTerm, $this->testRoute)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testFindObjectByEmpty(): void
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
        self::assertIsArray($result);
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testFindObjectByEmptyException(): void
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
        self::assertIsArray($result);
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testFindObjectBy(): void
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
        self::assertIsArray($result);
    }

    /**
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testFindObjectByApiException(): void
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
        self::assertIsArray($result);
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
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn('777');

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
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn('777');

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
        $baseMock = $this->createMock(BaseInterface::class);
        $baseMock->expects(self::once())
            ->method('getId')
            ->willReturn('777');

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

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllObjectsEmpty(): void
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

        self::assertIsArray($this->objectManager->getAllObjects($baseMock, $this->testRoute));
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

        self::assertIsArray($this->objectManager->getAllObjects($baseMock, $this->testRoute));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function testGetAllClientsException(): void
    {
        $this->expectException(InvalidResultException::class);
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
            ->willReturn($this->createMock(stdClass::class));

        self::assertIsArray($this->objectManager->getAllObjects($baseMock, $this->testRoute));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDownloadFile(): void
    {
        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains('/download'),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn(['test' => 'test2' ]);
        self::assertIsArray($this->objectManager->downloadFile('1', 'invoice'));
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testSendCommand(): void
    {
        $this->requestServiceMock->expects(self::once())
            ->method('dispatchRequest')
            ->with(
                self::stringContains(Request::METHOD_GET),
                self::stringContains('/testcommand'),
                self::isInstanceOf(RequestOptionsInterface::class)
            )
            ->willReturn(['test' => 'test2' ]);
        $this->objectManager->sendCommand('testcommand', '123', $this->testRoute);
    }
}
