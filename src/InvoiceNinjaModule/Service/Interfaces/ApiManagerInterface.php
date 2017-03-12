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
     * Sends the request to the server.
     * @param string $reqMethod Http-method
     * @param string $reqRoute Request route
     * @param array  $reqData Request data
     *
     * @return array
     * @throws ApiException
     * @throws EmptyResponseException
     */
    public function dispatchRequest($reqMethod, $reqRoute, array $reqData = []);

    /**
     * Set the request options object.
     * @param RequestOptionsInterface $options
     *
     * @return void
     */
    public function setRequestOptions(RequestOptionsInterface $options);
}
