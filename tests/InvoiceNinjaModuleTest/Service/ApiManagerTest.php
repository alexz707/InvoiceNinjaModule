<?php

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Model\Interfaces\SettingsInterface;
use InvoiceNinjaModule\Model\RequestOptions;
use InvoiceNinjaModule\Service\ApiManager;
use InvoiceNinjaModule\Service\Interfaces\ApiManagerInterface;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\RequestInterface;

class ApiManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ApiManagerInterface */
    private $manager;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $settingsMock;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $httpClientMock;
    /** @var  string */
    private $reqMethod;

    protected function setUp()
    {
        parent::setUp();
        $this->settingsMock = $this->createMock(SettingsInterface::class);
        $this->httpClientMock = $this->createMock(Client::class);
        $this->reqMethod = Request::METHOD_GET;
        $this->manager = new ApiManager($this->settingsMock, $this->httpClientMock);
    }

    public function testCreate()
    {
        self::assertInstanceOf(ApiManagerInterface::class, $this->manager);
    }

    public function testDispatchRequest()
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn('{"data": [0]}');

        $this->settingsMock->expects(self::once())
            ->method('getTimeout')
            ->willReturn(10);

        $this->settingsMock->expects(self::once())
            ->method('getTokenType')
            ->willReturn($testTokenType);

        $this->settingsMock->expects(self::once())
            ->method('getToken')
            ->willReturn($testToken);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(
                self::logicalAnd(
                    self::isInstanceOf(RequestInterface::class),
                    self::callback(function ($request) {
                        /** @var Request $request*/
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function testDispatchRequestEmptyExceptionEmptyData()
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn('{"data": []}');

        $this->settingsMock->expects(self::once())
            ->method('getTimeout')
            ->willReturn(10);

        $this->settingsMock->expects(self::once())
            ->method('getTokenType')
            ->willReturn($testTokenType);

        $this->settingsMock->expects(self::once())
            ->method('getToken')
            ->willReturn($testToken);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(self::isInstanceOf(RequestInterface::class))
            ->willReturn($response);

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function testDispatchRequestEmptyExceptionMissingData()
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn('{}');

        $this->settingsMock->expects(self::once())
            ->method('getTimeout')
            ->willReturn(10);

        $this->settingsMock->expects(self::once())
            ->method('getTokenType')
            ->willReturn($testTokenType);

        $this->settingsMock->expects(self::once())
            ->method('getToken')
            ->willReturn($testToken);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(self::isInstanceOf(RequestInterface::class))
            ->willReturn($response);

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ApiException
     */
    public function testDispatchRequestApiException()
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::exactly(2))
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_500);

        $this->settingsMock->expects(self::once())
            ->method('getTimeout')
            ->willReturn(10);

        $this->settingsMock->expects(self::once())
            ->method('getTokenType')
            ->willReturn($testTokenType);

        $this->settingsMock->expects(self::once())
            ->method('getToken')
            ->willReturn($testToken);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(self::isInstanceOf(RequestInterface::class))
            ->willReturn($response);

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ApiException
     */
    public function testDispatchRequestApiExceptionInvalidArgument()
    {
        $this->reqMethod = 'TESTPUT';
        $testReqRoute = 'testroute';

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ApiException
     */
    public function testDispatchRequestApiExceptionInvalidRuntime()
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $this->settingsMock->expects(self::once())
            ->method('getTimeout')
            ->willReturn(10);

        $this->settingsMock->expects(self::once())
            ->method('getTokenType')
            ->willReturn($testTokenType);

        $this->settingsMock->expects(self::once())
            ->method('getToken')
            ->willReturn($testToken);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(self::isInstanceOf(RequestInterface::class))
            ->willThrowException(new Client\Exception\RuntimeException());

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }

    public function testDispatchRequestEmpty()
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn('');

        $this->settingsMock->expects(self::once())
            ->method('getTimeout')
            ->willReturn(10);

        $this->settingsMock->expects(self::once())
            ->method('getTokenType')
            ->willReturn($testTokenType);

        $this->settingsMock->expects(self::once())
            ->method('getToken')
            ->willReturn($testToken);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(self::isInstanceOf(RequestInterface::class))
            ->willReturn($response);

        self::assertInternalType('array', $this->manager->dispatchRequest($this->reqMethod, $testReqRoute));
    }
}
