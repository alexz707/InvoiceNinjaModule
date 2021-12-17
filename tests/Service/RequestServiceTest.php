<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Options\Interfaces\ModuleOptionsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use InvoiceNinjaModule\Service\RequestService;
use JsonException;
use Laminas\Http\Client;
use Laminas\Http\Header\HeaderInterface;
use Laminas\Http\Headers;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Laminas\Stdlib\RequestInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RequestServiceTest extends TestCase
{
    private RequestServiceInterface $manager;
    private MockObject $settingsMock;
    private MockObject $httpClientMock;
    private MockObject $requestOptions;
    private string $reqMethod;


    protected function setUp(): void
    {
        parent::setUp();
        $this->settingsMock = $this->createMock(ModuleOptionsInterface::class);
        $this->httpClientMock = $this->createMock(Client::class);
        $this->reqMethod = Request::METHOD_GET;
        $this->requestOptions = $this->createMock(RequestOptionsInterface::class);

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(RequestServiceInterface::class, $this->manager);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequest(): void
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
                    self::callback(static function ($request) {
                        /** @var Request $request */
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);


        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);

        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestAuth(): void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $authOptions = $this->createMock(AuthOptionsInterface::class);
        $authOptions->expects(self::once())
            ->method('isAuthorization')
            ->willReturn(true);

        $authOptions->expects(self::once())
            ->method('getUsername')
            ->willReturn('username');

        $authOptions->expects(self::once())
            ->method('getPassword')
            ->willReturn('password');

        $authOptions->expects(self::once())
            ->method('getAuthType')
            ->willReturn(Client::AUTH_BASIC);

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

        $this->settingsMock->expects(self::once())
            ->method('getAuthOptions')
            ->willReturn($authOptions);

        $this->httpClientMock->expects(self::once())
            ->method('send')
            ->with(
                self::logicalAnd(
                    self::isInstanceOf(RequestInterface::class),
                    self::callback(static function ($request) {
                        /** @var Request $request */
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);


        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);

        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestFile(): void
    {
        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $header = $this->createMock(HeaderInterface::class);
        $header->expects(self::once())
            ->method('getFieldValue')
            ->willReturn('attachment; filename=test.pdf');

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
                    self::callback(static function ($request) {
                        /** @var Request $request*/
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        $result = $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions);
        self::assertIsArray($result);
        self::assertArrayHasKey('test.pdf', $result);
        self::assertEquals('testfilecontent', $result['test.pdf']);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestFileInvalidHeader(): void
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
                    self::callback(static function ($request) {
                        /** @var Request $request*/
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);

        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        $result = $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions);
        self::assertIsArray($result);
        self::assertEmpty($result);
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestWithOptions(): void
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
                    self::callback(static function ($request) {
                        /** @var Request $request*/
                        return $request->getAllowCustomMethods() === false;
                    })
                )
            )
            ->willReturn($response);


        $this->manager = new RequestService($this->settingsMock, $this->httpClientMock);
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestEmptyExceptionEmptyData(): void
    {
        $this->expectException(EmptyResponseException::class);

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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestEmptyExceptionMissingData(): void
    {
        $this->expectException(EmptyResponseException::class);
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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestHttpClientException(): void
    {
        $this->expectException(HttpClientException::class);

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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestHttpAuthClientException(): void
    {
        $this->expectException(HttpClientException::class);

        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::exactly(2))
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_401);

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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestApiAuthClientException(): void
    {
        $this->expectException(ApiAuthException::class);

        $testTokenType = 'testtokentype';
        $testToken = 'testtoken';
        $testReqRoute = 'testroute';

        $response = $this->createMock(Response::class);
        $response->expects(self::exactly(2))
            ->method('getStatusCode')
            ->willReturn(Response::STATUS_CODE_403);

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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestHttpClientExceptionInvalidArgument(): void
    {
        $this->expectException(HttpClientException::class);
        $this->reqMethod = 'TESTPUT';
        $testReqRoute = 'testroute';

        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestHttpClientExceptionInvalidRuntime(): void
    {
        $this->expectException(HttpClientException::class);
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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestEmpty(): void
    {
        $this->expectException(EmptyResponseException::class);

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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }

    /**
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function testDispatchRequestPost(): void
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
                    self::callback(static function ($request) {
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
        self::assertIsArray(
            $this->manager->dispatchRequest($this->reqMethod, $testReqRoute, $this->requestOptions)
        );
    }
}
