<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Model\Interfaces\SettingsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use InvoiceNinjaModule\Service\RequestService;
use Zend\Http\Client;
use Zend\Http\Header\HeaderInterface;
use Zend\Http\Headers;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\RequestInterface;
use PHPUnit\Framework\TestCase;

class RequestServiceTest extends TestCase
{
    /** @var  RequestServiceInterface */
    private $manager;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $settingsMock;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $httpClientMock;
    /** @var  string */
    private $reqMethod;
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $requestOptions;

    protected function setUp() :void
    {
        parent::setUp();
        $this->settingsMock = $this->createMock(SettingsInterface::class);
        $this->httpClientMock = $this->createMock(Client::class);
        $this->reqMethod = Request::METHOD_GET;
        $this->requestOptions = $this->createMock(RequestOptionsInterface::class);


        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
    }

    public function testCreate() :void
    {
        self::assertInstanceOf(RequestServiceInterface::class, $this->manager);
    }

    public function testDispatchRequest() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn(false);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

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
                        /** @var Request $request */
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);


        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);

        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    public function testDispatchRequestFile() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $header = $this->createMock(HeaderInterface::class);
        $header->expects(self::once())
            ->method('getFieldValue')
            ->willReturn('attachment; filename="test.pdf"');

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn($header);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn('testfilecontent');

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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        $result = $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions);
        self::assertInternalType('array', $result);
        self::assertArrayHasKey('test.pdf', $result);
        self::assertEquals('testfilecontent', $result['test.pdf']);
    }

    public function testDispatchRequestFileInvalidHeader() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $header = $this->createMock(HeaderInterface::class);
        $header->expects(self::once())
            ->method('getFieldValue')
            ->willReturn('attachTESTment; filename="test.pdf"');

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn($header);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

        $response->expects(self::never())
            ->method('getBody')
            ->willReturn('testfilecontent');

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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        $result = $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions);
        self::assertInternalType('array', $result);
        self::assertEmpty($result);
    }

    public function testDispatchRequestWithOptions() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $this->requestOptions->expects(self::once())
            ->method('getQueryArray')
            ->willReturn([]);

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn(false);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

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


        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }


    /**
     * @expectedException  \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function testDispatchRequestEmptyExceptionEmptyData() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn(false);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function testDispatchRequestEmptyExceptionMissingData() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn(false);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ApiException
     */
    public function testDispatchRequestApiException() :void
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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ApiException
     */
    public function testDispatchRequestApiExceptionInvalidArgument() :void
    {
        $this->reqMethod = 'TESTPUT';
        $testReqRoute = 'testroute';

        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @expectedException  \InvoiceNinjaModule\Exception\ApiException
     */
    public function testDispatchRequestApiExceptionInvalidRuntime() :void
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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    public function testDispatchRequestEmpty() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn(false);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

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

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    public function testDispatchRequestPost() :void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';


        $this->requestOptions = $this->createMock(RequestOptionsInterface::class);
        $this->requestOptions->expects(self::once())
            ->method('getPostArray')
            ->willReturn(['test']);

        $headers = $this->createMock(Headers::class);
        $headers->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Content-disposition'))
            ->willReturn(false);

        $response = $this->createMock(Response::class);
        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_200);

        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

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
            ->with(
                self::logicalAnd(
                    self::isInstanceOf(RequestInterface::class),
                    self::callback(function ($request) {
                        $return = true;
                        /** @var Request $request */
                        if ($request->getContent() === '') {
                            $return = false;
                        }

                        if ($request->getAllowCustomMethods() === true) {
                            $return = false;
                        }

                        return $return;
                    })
                )
            )
            ->willReturn($response);

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertInternalType(
            'array',
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }
}
