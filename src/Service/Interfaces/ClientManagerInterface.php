<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\InvalidResultException;
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
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function createClient(ClientInterface $client) :ClientInterface;
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function delete(ClientInterface $client) :ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function update(ClientInterface $client) :ClientInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function restore(ClientInterface $client) :ClientInterface;
    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function archive(ClientInterface $client) :ClientInterface;
    /**
     * @param $id
     *
     * @return ClientInterface
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     */
    public function getClientById($id) :ClientInterface;

    /**
     * @param $email
     *
     * @return array
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function findClientsByEmail($email) :array;
    /**
     * @param $idNumber
     *
     * @return array
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function findClientsByIdNumber($idNumber) :array;
    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return array
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function getAllClients($page = 1, $pageSize = 0) :array;
}
