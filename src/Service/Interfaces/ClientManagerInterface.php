<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

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
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createClient(ClientInterface $client) :ClientInterface;
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function delete(ClientInterface $client) :ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function update(ClientInterface $client) :ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restore(ClientInterface $client) :ClientInterface;
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archive(ClientInterface $client) :ClientInterface;
    /**
     * @param $id
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getClientById($id) :ClientInterface;

    /**
     * @param $email
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function findClientsByEmail($email) :array;
    /**
     * @param $idNumber
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function findClientsByIdNumber($idNumber) :array;
    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getAllClients($page = 1, $pageSize = 0) :array;
}
