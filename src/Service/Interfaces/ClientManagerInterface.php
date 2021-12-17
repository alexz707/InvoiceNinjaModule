<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use JsonException;

/**
 * Interface ClientManagerInterface
 */
interface ClientManagerInterface
{
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function createClient(ClientInterface $client): ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function delete(ClientInterface $client): ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function update(ClientInterface $client): ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function restore(ClientInterface $client): ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function archive(ClientInterface $client): ClientInterface;

    /**
     * @param string $id
     *
     * @return ClientInterface
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function getClientById(string $id): ClientInterface;

    /**
     * @param string $email
     *
     * @return ClientInterface[]
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function findClientsByEmail(string $email): array;

    /**
     * @param string $idNumber
     *
     * @return ClientInterface[]
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function findClientsByIdNumber(string $idNumber): array;

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return ClientInterface[]
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function getAllClients(int $page = 1, int $pageSize = 0): array;

    /**
     * @return ClientInterface[]
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function getActiveClients(): array;
}
