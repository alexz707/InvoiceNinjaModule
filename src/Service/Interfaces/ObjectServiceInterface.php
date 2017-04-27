<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
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
     * @throws ApiException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     */
    public function createObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param int           $id
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws EmptyResponseException
     * @throws NotFoundException
     * @throws InvalidResultException
     */
    public function getObjectById(BaseInterface $object, int $id, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param array         $searchTerm
     * @param string        $reqRoute
     *
     * @return BaseInterface[]
     * @throws ApiException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     */
    public function findObjectBy(BaseInterface $object, array $searchTerm, string $reqRoute) :array;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws ApiException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     */
    public function restoreObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws ApiException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     */
    public function archiveObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws ApiException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     */
    public function updateObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws ApiException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     */
    public function deleteObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * Retrieves all objects.
     * Default page size on server side is 15!
     * @param BaseInterface $object
     * @param string        $reqRoute
     * @param int           $page
     * @param int           $pageSize
     *
     * @return BaseInterface[]
     * @throws ApiException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     */
    public function getAllObjects(BaseInterface $object, string $reqRoute, int $page = 1, int $pageSize = 0) :array;

    /**
     * @param int $id
     *
     * @return array
     * @throws ApiException
     * @throws EmptyResponseException
     */
    public function downloadFile(int $id) :array;
}
