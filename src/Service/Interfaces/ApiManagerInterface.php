<?php

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;

/**
 * Interface ApiManagerInterface
 *
 * @package InvoiceNinjaModule\Service\Interfaces
 */
interface ApiManagerInterface
{
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
    public function dispatchRequest($reqMethod, $reqRoute, RequestOptionsInterface $requestOptions);
}
