<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;

/**
 * Interface RequestServiceInterface
 */
interface RequestServiceInterface
{
    /**
     * Sends the request to the server
     * @param string                  $reqMethod
     * @param string                  $reqRoute
     * @param RequestOptionsInterface $requestOptions
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     */
    public function dispatchRequest($reqMethod, $reqRoute, RequestOptionsInterface $requestOptions) :array;
}
