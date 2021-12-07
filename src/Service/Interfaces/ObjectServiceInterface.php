<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;

/**
 * Interface ObjectServiceInterface
 */
interface ObjectServiceInterface
{

    /**
     * @param BaseInterface $object
     * @param               $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function createObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param int           $id
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getObjectById(BaseInterface $object, string $id, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param array         $searchTerm
     * @param string        $reqRoute
     *
     * @return BaseInterface[]
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function findObjectBy(BaseInterface $object, array $searchTerm, string $reqRoute) :array;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function restoreObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function archiveObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function updateObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function deleteObject(BaseInterface $object, string $reqRoute) :BaseInterface;

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
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getAllObjects(BaseInterface $object, string $reqRoute, int $page = 1, int $pageSize = 0) :array;

    /**
     * @param string $id
     *
     * @return array
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function downloadFile(string $id) :array;

    /**
     * @param string $command
     * @param array  $body
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     */
    public function sendCommand(string $command, array $body) :void;
}
