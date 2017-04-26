<?php

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Model\Interfaces\SettingsInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Exception\InvalidArgumentException;
use Zend\Http\Exception\RuntimeException;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\Parameters;

/**
 * Class RequestService
 *
 * @package InvoiceNinjaModule\Service
 */
final class RequestService implements RequestServiceInterface
{
    const RETURN_KEY = 'data';
    /** @var SettingsInterface */
    private $settings;
    /** @var Client  */
    private $httpClient;

    /**
     * RequestService constructor.
     *
     * @param SettingsInterface $settings
     * @param Client            $client
     * @throws InvalidArgumentException
     */
    public function __construct(SettingsInterface $settings, Client $client)
    {
        $this->settings = $settings;
        $this->httpClient = $client;
        $this->initHttpClient();
    }

    /**
     * Sends the request to the server
     * @param string                  $reqMethod
     * @param string                  $reqRoute
     * @param RequestOptionsInterface $requestOptions
     *
     * @return array
     * @throws ApiException
     * @throws EmptyResponseException
     */
    public function dispatchRequest($reqMethod, $reqRoute, RequestOptionsInterface $requestOptions) :array
    {
        try {
            $request = new Request();
            $request->setAllowCustomMethods(false);
            $request->setMethod($reqMethod);
            $request->setQuery(new Parameters($requestOptions->getQueryArray()));

            $postArray = $requestOptions->getPostArray();
            if (!empty($postArray)) {
                $request->setContent(json_encode($postArray));
            }

            $request->getHeaders()->addHeaders($this->getRequestHeaderArray());
            $request->setUri($this->settings->getHostUrl().$reqRoute);

            $response = $this->httpClient->send($request);
        } catch (InvalidArgumentException $e) {
            throw new ApiException($e->getMessage());
        } catch (RuntimeException $e) {
            throw new ApiException($e->getMessage());
        }

        if ($response->getStatusCode() !== Response::STATUS_CODE_200) {
            throw new ApiException($response->getStatusCode() .' '.$response->getReasonPhrase());
        }

        return $this->convertResponse($response);
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
            $needle = 'attachment; filename="';
            $fileName = substr(strstr($contentDisposition->getFieldValue(), $needle), strlen($needle), -1);
            if (\is_string($fileName)) {
                return [$fileName => $response->getBody()];
            }
            return [];
        }

        $result = json_decode($response->getBody(), true);
        if (is_array($result)) {
            return $this->checkResponseKey($result);
        }
        return [];
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
            'Accept' => 'application/json',
            'Content-type' => 'application/json; charset=UTF-8',
            $this->settings->getTokenType() => $this->settings->getToken()
        ];
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    private function initHttpClient() :void
    {
        $options = [
            'timeout' => $this->settings->getTimeout()
        ];
        $this->httpClient->setOptions($options);
        $this->httpClient->setAdapter(Curl::class);
    }
}
