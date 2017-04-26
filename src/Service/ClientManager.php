<?php

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Model\Client;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;

/**
 * Class ClientManager
 *
 * @package InvoiceNinjaModule\Service
 */
class ClientManager implements ClientManagerInterface
{
    /** @var ObjectServiceInterface  */
    private $objectManager;
    /** @var  string */
    private $reqRoute;
    /** @var Client  */
    private $objectType;

    public function __construct(ObjectServiceInterface $objectManager)
    {
        $this->reqRoute = '/clients';
        $this->objectManager = $objectManager;
        $this->objectType  = new Client();
    }

    public function createClient(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->createObject($client, $this->reqRoute));
    }

    public function delete(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->deleteObject($client, $this->reqRoute));
    }

    public function update(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->updateObject($client, $this->reqRoute));
    }

    public function restore(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->restoreObject($client, $this->reqRoute));
    }

    public function archive(ClientInterface $client) :ClientInterface
    {
        return $this->checkResult($this->objectManager->archiveObject($client, $this->reqRoute));
    }

    public function getClientById($id) :ClientInterface
    {
        return $this->checkResult($this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute));
    }

    public function findClientsByEmail($email) :array
    {
        return $this->objectManager->findObjectBy($this->objectType, ['email' => $email], $this->reqRoute);
    }

    public function findClientsByIdNumber($idNumber) :array
    {
        return $this->objectManager->findObjectBy($this->objectType, ['id_number' => $idNumber], $this->reqRoute);
    }

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
     * @throws InvalidResultException
     */
    private function checkResult(BaseInterface $client) :ClientInterface
    {
        if (!$client instanceof ClientInterface) {
            throw new InvalidResultException();
        }
        return $client;
    }
}
