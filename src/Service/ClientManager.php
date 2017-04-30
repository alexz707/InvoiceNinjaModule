<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Model\Client;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;

/**
 * Class ClientManager
 */
final class ClientManager implements ClientManagerInterface
{
    /** @var ObjectServiceInterface  */
    private $objectManager;
    /** @var  string */
    private $reqRoute;
    /** @var Client  */
    private $objectType;

    /**
     * ClientManager constructor.
     *
     * @param ObjectServiceInterface $objectManager
     */
    public function __construct(ObjectServiceInterface $objectManager)
    {
        $this->reqRoute = '/clients';
        $this->objectManager = $objectManager;
        $this->objectType  = new Client();
    }

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createClient(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->createObject($client, $this->reqRoute));
    }

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function delete(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->deleteObject($client, $this->reqRoute));
    }

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function update(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->updateObject($client, $this->reqRoute));
    }

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restore(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->restoreObject($client, $this->reqRoute));
    }

    /**
     * @param ClientInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archive(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->archiveObject($client, $this->reqRoute));
    }

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
    public function getClientById($id) :ClientInterface
    {
        return $this->checkResult($this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute));
    }

    /**
     * @param $email
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function findClientsByEmail($email) :array
    {
        return $this->objectManager->findObjectBy($this->objectType, ['email' => $email], $this->reqRoute);
    }

    /**
     * @param $idNumber
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function findClientsByIdNumber($idNumber) :array
    {
        return $this->objectManager->findObjectBy($this->objectType, ['id_number' => $idNumber], $this->reqRoute);
    }

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
    public function getAllClients($page = 1, $pageSize = 0) :array
    {
        $result = $this->objectManager->getAllObjects($this->objectType, $this->reqRoute, $page, $pageSize);
        foreach ($result as $client) {
            $this->checkResult($client);
        }
        return $result;
    }

    /**
     * @param BaseInterface $client
     *
     * @return ClientInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     */
    private function checkResult(BaseInterface $client) :ClientInterface
    {
        if (!$client instanceof ClientInterface) {
            throw new InvalidResultException();
        }
        return $client;
    }
}
