<?php

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Model\Interfaces\SettingsInterface;
use InvoiceNinjaModule\Service\Interfaces\ApiManagerInterface;
use Zend\Http\Client;
use Zend\Http\Exception\InvalidArgumentException;
use Zend\Http\Exception\RuntimeException;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\Parameters;

/**
 * Class ApiManager
 *
 * @package InvoiceNinjaModule\Service
 */
class ApiManager implements ApiManagerInterface
{
    /** @var SettingsInterface */
    private $settings;
    /** @var Client  */
    private $httpClient;
    /** @var  RequestOptionsInterface */
    private $requestOptions;

    /**
     * ApiManager constructor.
     *
     * @param SettingsInterface $settings
     * @param Client            $client
     */
    public function __construct(SettingsInterface $settings, Client $client)
    {
        $this->settings = $settings;
        $this->httpClient = $client;
    }

    /**
     * @param RequestOptionsInterface $options
     * @return void
     */
    public function setRequestOptions(RequestOptionsInterface $options)
    {
        $this->requestOptions = $options;
    }

    /**
     * Sends the request to the server
     * @param string $reqMethod Http-method
     * @param string $reqRoute Request route
     * @param array  $reqData Request data
     *
     * @return array
     * @throws ApiException
     * @throws EmptyResponseException
     */
    public function dispatchRequest($reqMethod, $reqRoute, array $reqData = [])
    {
        try{
            $request = new Request();
            $request->setAllowCustomMethods(false);
            $request->setMethod($reqMethod);
            $request->setPost(new Parameters($reqData));
            $request->getHeaders()->addHeaders($this->getRequestHeaderArray());
            $request->setUri($this->settings->getHostUrl().$reqRoute);

            $this->httpClient->setOptions($this->getRequestOptions());
            $this->httpClient->setAdapter(Client\Adapter\Curl::class);
            $response = $this->httpClient->send($request);
        }
        catch (InvalidArgumentException $e)
        {
            throw new ApiException($e->getMessage());
        }
        catch (RuntimeException $e)
        {
            throw new ApiException($e->getMessage());
        }

        if($response->getStatusCode() !== Response::STATUS_CODE_200)
        {
            throw new ApiException($response->getStatusCode() .' '.$response->getReasonPhrase());
        }

        $result = json_decode($response->getBody(), true);

        if(is_array($result))
        {
            return $this->checkResponse($result);
        }

        return [];
    }

    /**
     * @param array $result
     *
     * @return array
     * @throws EmptyResponseException
     */
    private function checkResponse(array $result)
    {
        if(!array_key_exists('data', $result) || empty($result['data']))
        {
            throw new EmptyResponseException();
        }
        return $result['data'];
    }

    /**
     * @return array
     */
    private function getRequestHeaderArray()
    {
        return [
            'Accept' => 'application/json',
            'Content-type' => 'application/json; charset=UTF-8',
            $this->settings->getTokenType() => $this->settings->getToken()
        ];
    }

    /**
     * @return array
     */
    private function getRequestOptions()
    {
        $result = [];
        $result['timeout'] = $this->settings->getTimeout();
        return $result;
    }
}
