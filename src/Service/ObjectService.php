<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Options\RequestOptions;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use Zend\Http\Request;
use Zend\Hydrator\HydratorInterface;

/**
 * Class ObjectService
 */
final class ObjectService implements ObjectServiceInterface
{
    const ACTION_RESTORE = 'restore';
    const ACTION_ARCHIVE = 'archive';
    const ROUTE_DOWNLOAD = '/download';

    /** @var  RequestServiceInterface */
    protected $requestService;
    /** @var  HydratorInterface */
    protected $hydrator;
    /** @var  BaseInterface */
    protected $objectType;

    /**
     * BaseManager constructor.
     *
     * @param RequestServiceInterface $requestService
     * @param HydratorInterface   $hydrator
     */
    public function __construct(RequestServiceInterface $requestService, HydratorInterface $hydrator)
    {
        $this->requestService = $requestService;
        $this->hydrator       = $hydrator;
    }

    /**
     * @param BaseInterface $object
     * @param               $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createObject(BaseInterface $object, string $reqRoute) :BaseInterface
    {
        $reqOptions = new RequestOptions();
        $reqOptions->addPostParameters($this->hydrator->extract($object));
        $responseArr = $this->requestService->dispatchRequest(Request::METHOD_POST, $reqRoute, $reqOptions);
        return $this->hydrateObject($responseArr, $object);
    }

    /**
     * @param BaseInterface $object
     * @param int           $id
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getObjectById(BaseInterface $object, int $id, string $reqRoute) :BaseInterface
    {
        $requestOptions = new RequestOptions();

        try {
            $responseArr = $this->requestService->dispatchRequest(
                Request::METHOD_GET,
                $reqRoute.'/'.$id,
                $requestOptions
            );
        } catch (EmptyResponseException $e) {
            throw new NotFoundException($id);
        }
        return $this->hydrateObject($responseArr, $object);
    }

    /**
     * @param BaseInterface $object
     * @param array         $searchTerm
     * @param string        $reqRoute
     *
     * @return BaseInterface[]
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function findObjectBy(BaseInterface $object, array $searchTerm, string $reqRoute) :array
    {
        $resultArr = [];
        $reqOptions = new RequestOptions();

        if (empty($searchTerm)) {
            throw new InvalidParameterException('searchTerm must not be empty');
        }
        $reqOptions->addQueryParameters($searchTerm);

        try {
            $responseArr = $this->requestService->dispatchRequest(Request::METHOD_GET, $reqRoute, $reqOptions);

            foreach ($responseArr as $objectArr) {
                $resultArr[] = $this->hydrateObject($objectArr, clone $object);
            }
        } catch (EmptyResponseException $e) {
            return $resultArr;
        }
        return $resultArr;
    }

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restoreObject(BaseInterface $object, string $reqRoute) :BaseInterface
    {
        return $this->update($object, $reqRoute, self::ACTION_RESTORE);
    }

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archiveObject(BaseInterface $object, string $reqRoute) :BaseInterface
    {
        return $this->update($object, $reqRoute, self::ACTION_ARCHIVE);
    }

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function updateObject(BaseInterface $object, string $reqRoute) :BaseInterface
    {
        return $this->update($object, $reqRoute);
    }

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     * @param string|null   $action
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    private function update(BaseInterface $object, $reqRoute, ?string $action = null) :BaseInterface
    {
        $reqOptions = new RequestOptions();

        if ($action !== null) {
            $reqOptions->addQueryParameters(['action' => $action]);
        } else {
            $reqOptions->addPostParameters($this->hydrator->extract($object));
        }

        $responseArr = $this->requestService->dispatchRequest(
            Request::METHOD_PUT,
            $reqRoute.'/'.$object->getId(),
            $reqOptions
        );
        return $this->hydrateObject($responseArr, $object);
    }

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function deleteObject(BaseInterface $object, string $reqRoute) :BaseInterface
    {
        $responseArr = $this->requestService->dispatchRequest(
            Request::METHOD_DELETE,
            $reqRoute.'/'.$object->getId(),
            new RequestOptions()
        );
        return $this->hydrateObject($responseArr, $object);
    }

    /**
     * Retrieves all objects.
     * Default page size on server side is 15!
     *
     * @param BaseInterface $object
     * @param string        $reqRoute
     * @param int           $page
     * @param int           $pageSize
     *
     * @return BaseInterface[]
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getAllObjects(BaseInterface $object, string $reqRoute, int $page = 1, int $pageSize = 0) :array
    {
        $reqOptions = new RequestOptions();
        $reqOptions->setPage($page);
        $reqOptions->setPageSize($pageSize);

        $responseArr = $this->requestService->dispatchRequest(Request::METHOD_GET, $reqRoute, $reqOptions);

        $result = [];
        foreach ($responseArr as $clientData) {
            $result[] = $this->hydrateObject($clientData, clone $object);
        }
        return $result;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function downloadFile(int $id) :array
    {
        return $this->requestService->dispatchRequest(
            Request::METHOD_GET,
            self::ROUTE_DOWNLOAD.'/'.$id,
            new RequestOptions()
        );
    }

    /**
     * @param string $command
     * @param array  $body
     *
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     */
    public function sendCommand(string $command, array $body) :void
    {
        $reqOptions = new RequestOptions();
        $reqOptions->addPostParameters($body);
        $this->requestService->dispatchRequest(
            Request::METHOD_POST,
            '/'.$command,
            $reqOptions
        );
    }

    /**
     * @param array         $data
     * @param BaseInterface $object
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     */
    private function hydrateObject(array $data, BaseInterface $object) :BaseInterface
    {
        $result = $this->hydrator->hydrate($data, $object);
        if ($result instanceof BaseInterface) {
            return $result;
        }
        throw new InvalidResultException();
    }
}
