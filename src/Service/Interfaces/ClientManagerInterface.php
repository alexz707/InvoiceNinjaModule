<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;

/**
 * Interface ClientManagerInterface
 */
interface ClientManagerInterface
{
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function createClient(ClientInterface $client) :ClientInterface;
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function delete(ClientInterface $client) :ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function update(ClientInterface $client) :ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function restore(ClientInterface $client) :ClientInterface;
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function archive(ClientInterface $client) :ClientInterface;
    /**
     * @param string $id
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws NotFoundException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getClientById(string $id) :ClientInterface;

    /**
     * @param string $email
     *
     * @return ClientInterface[]
     * @throws InvalidResultException
     * @throws InvalidParameterException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function findClientsByEmail(string $email) :array;
    /**
     * @param string $idNumber
     *
     * @return ClientInterface[]
     * @throws InvalidResultException
     * @throws InvalidParameterException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function findClientsByIdNumber(string $idNumber) :array;
    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return ClientInterface[]
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getAllClients(int $page = 1, int $pageSize = 0) :array;

    /**
     *
     * @return ClientInterface[]
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getActiveClients() :array;
}
