<?php

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\ClientNotFoundException;
use InvoiceNinjaModule\Model\Client;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Model\RequestOptions;
use InvoiceNinjaModule\Service\Interfaces\ApiManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use Zend\Http\Request;
use Zend\Hydrator\HydratorInterface;

/**
 * Class ClientManager
 *
 * @package InvoiceNinjaModule\Service
 */
class ClientManager implements ClientManagerInterface
{
    /** @var string  */
    private $apiRoute = '/clients';
    /** @var  ApiManagerInterface */
    private $apiService;
    /** @var  HydratorInterface */
    private $hydrator;

    /**
     * ClientManager constructor.
     *
     * @param ApiManagerInterface $apiService
     * @param HydratorInterface   $hydrator
     */
    public function __construct(ApiManagerInterface $apiService, HydratorInterface $hydrator)
    {
        $this->apiService = $apiService;
        $this->hydrator = $hydrator;
    }

    public function createClient(ClientInterface $client)
    {
        $reqRoute = $this->apiRoute;
        $reqMethod = Request::METHOD_POST;
        $reqOptions = new RequestOptions();
        $reqOptions->addPostParameters($this->hydrator->extract($client));

        $responseArr = $this->apiService->dispatchRequest($reqMethod, $reqRoute, $reqOptions);
        return $this->hydrateClient($responseArr, $client);
    }

    public function delete(ClientInterface $client)
    {
        $reqRoute = $this->apiRoute.'/'.$client->getId();
        $reqMethod = Request::METHOD_DELETE;
        $responseArr = $this->apiService->dispatchRequest($reqMethod, $reqRoute, new RequestOptions());
        return $this->hydrateClient($responseArr, $client);
    }

    public function update(ClientInterface $client)
    {
        return $this->apiUpdate($client);
    }

    public function restore(ClientInterface $client)
    {
        return $this->apiUpdate($client, 'restore');
    }

    public function archive(ClientInterface $client)
    {
        return $this->apiUpdate($client, 'archive');
    }

    private function apiUpdate(ClientInterface $client, $action = null)
    {
        $reqRoute = $this->apiRoute.'/'.$client->getId();
        $reqOptions = new RequestOptions();

        if ($action !== null) {
            $reqOptions->addQueryParameters(['action' => $action]);
        } else {
            $reqOptions->addPostParameters($this->hydrator->extract($client));
        }

        $reqMethod = Request::METHOD_PUT;
        $responseArr = $this->apiService->dispatchRequest($reqMethod, $reqRoute, $reqOptions);
        return $this->hydrateClient($responseArr, $client);
    }

    public function getClientById($id)
    {
        $reqRoute = $this->apiRoute.'/'.$id;
        $reqMethod = Request::METHOD_GET;

        try {
            $responseArr = $this->apiService->dispatchRequest($reqMethod, $reqRoute, new RequestOptions());
        } catch (ApiException $e) {
            throw new ClientNotFoundException($id);
        }

        return $this->hydrateClient($responseArr);
    }

    public function getAllClients($page = 1, $pageSize = 0)
    {
        $reqRoute = $this->apiRoute;
        $reqMethod = Request::METHOD_GET;
        $reqOptions = new RequestOptions();
        $reqOptions->setPage($page);
        $reqOptions->setPageSize($pageSize);

        $responseArr = $this->apiService->dispatchRequest($reqMethod, $reqRoute, $reqOptions);

        $result = [];
        foreach ($responseArr as $clientData) {
            $result[] = $this->hydrateClient($clientData);
        }
        return $result;
    }

    private function hydrateClient(array $data, ClientInterface $clientObject = null)
    {
        if ($clientObject === null) {
            $clientObject = new Client();
        }
        $this->hydrator->hydrate($data, $clientObject);
        return $clientObject;
    }
}
