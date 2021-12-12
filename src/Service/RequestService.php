<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Options\Interfaces\ModuleOptionsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use Laminas\Http\Client;
use Laminas\Http\Client\Adapter\Curl;
use Laminas\Http\Exception\InvalidArgumentException;
use Laminas\Http\Exception\RuntimeException;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Laminas\Stdlib\Parameters;
use function array_key_exists;
use function is_array;
use function json_decode;
use function json_encode;
use function strlen;
use function strstr;
use function substr;

/**
 * Class RequestService
 */
final class RequestService implements RequestServiceInterface
{
    public const RETURN_KEY = 'data';
    private ModuleOptionsInterface $moduleOptions;
    private Client $httpClient;

    /**
     * RequestService constructor.
     *
     * @param ModuleOptionsInterface $moduleOptions
     * @param Client                 $client
     *
     * @throws InvalidArgumentException
     */
    public function __construct(ModuleOptionsInterface $moduleOptions, Client $client)
    {
        $this->moduleOptions = $moduleOptions;
        $this->httpClient    = $client;
        $this->initHttpClient();
    }

    /**
     * Sends the request to the server
     *
     * @param string                  $reqMethod
     * @param string                  $reqRoute
     * @param RequestOptionsInterface $requestOptions
     *
     * @return array
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientException
     * @throws HttpClientAuthException
     */
    public function dispatchRequest(string $reqMethod, string $reqRoute, RequestOptionsInterface $requestOptions) :array
    {
        $request = new Request();
        $request->setAllowCustomMethods(false);
        try {
            $request->setMethod($reqMethod);
        } catch (InvalidArgumentException $e) {
            throw new HttpClientException($e->getMessage());
        }

        $request->setQuery(new Parameters($requestOptions->getQueryArray()));

        $postArray = $requestOptions->getPostArray();
        if (!empty($postArray)) {
            $request->setContent(json_encode($postArray));
        }

        try {
            $request->getHeaders()->addHeaders($this->getRequestHeaderArray());
            $request->setUri($this->moduleOptions->getHostUrl().$reqRoute);
        } catch (InvalidArgumentException $e) {
            throw new HttpClientException($e->getMessage());
        }

        try {
            $response = $this->httpClient->send($request);
        } catch (RuntimeException $e) {
            throw new HttpClientException($e->getMessage());
        }

        $this->checkResponseCode($response);

        return $this->convertResponse($response);
    }

    /**
     * @param Response $response
     *
     * @throws ApiAuthException
     * @throws HttpClientException
     * @throws HttpClientAuthException
     */
    private function checkResponseCode(Response $response) :void
    {
        switch ($response->getStatusCode()) {
            case Response::STATUS_CODE_200:
                break;
            case Response::STATUS_CODE_403:
                throw new ApiAuthException($response->getStatusCode() .' '.$response->getReasonPhrase());
            case Response::STATUS_CODE_401:
                throw new HttpClientAuthException($response->getStatusCode() .' '.$response->getReasonPhrase());
            default:
                throw new HttpClientException($response->getStatusCode() .' '.$response->getReasonPhrase());
        }
    }

    /**
     * @param Response $response
     *
     * @return array
     * @throws EmptyResponseException
     */
    private function convertResponse(Response $response) :array
    {
        $headers = $response->getHeaders();
        //check if it is a file
        $contentDisposition = $headers->get('Content-disposition');
        if ($contentDisposition !== false) {
            $needle = 'attachment; filename=';
            $subString = strstr($contentDisposition->getFieldValue(), $needle);

            if ($subString === false) {
                return [];
            }

            $fileName = substr($subString, strlen($needle));
            return [$fileName => $response->getBody()];
        }

        $result = json_decode($response->getBody(), true);
        if (is_array($result)) {
            return $this->checkResponseKey($result);
        }
        throw new EmptyResponseException();
    }

    /**
     * @param array $result
     *
     * @return array
     * @throws EmptyResponseException
     */
    private function checkResponseKey(array $result) :array
    {
        if (!array_key_exists(self::RETURN_KEY, $result) || empty($result[self::RETURN_KEY])) {
            throw new EmptyResponseException();
        }
        return $result[self::RETURN_KEY];
    }

    /**
     * @return array
     */
    private function getRequestHeaderArray() :array
    {
        return [
            'Accept'                             => 'application/json',
            'Content-type'                       => 'application/json; charset=UTF-8',
            $this->moduleOptions->getTokenType() => $this->moduleOptions->getToken()
        ];
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    private function initHttpClient() :void
    {
        $options = [
            'timeout' => $this->moduleOptions->getTimeout()
        ];
        $this->httpClient->setOptions($options);
        $this->httpClient->setAdapter(Curl::class);

        $authOptions = $this->moduleOptions->getAuthOptions();

        if ($authOptions->isAuthorization()) {
            $this->httpClient->setAuth(
                $authOptions->getUsername(),
                $authOptions->getPassword(),
                $authOptions->getAuthType()
            );
        }
    }
}
