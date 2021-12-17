<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;
use JsonException;

/**
 * Interface RequestServiceInterface
 */
interface RequestServiceInterface
{
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
     * @throws JsonException
     */
    public function dispatchRequest(
        string $reqMethod,
        string $reqRoute,
        RequestOptionsInterface $requestOptions
    ): array;
}
