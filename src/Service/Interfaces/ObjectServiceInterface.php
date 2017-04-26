<?php

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;

interface ObjectServiceInterface
{

    public function createObject(BaseInterface $object, string $reqRoute);

    public function getObjectById(BaseInterface $object, int $id, string $reqRoute);

    public function findObjectBy(BaseInterface $object, array $searchTerm, string $reqRoute);

    public function updateObject(BaseInterface $object, string $reqRoute);

    public function archiveObject(BaseInterface $object, string $reqRoute);

    public function restoreObject(BaseInterface $object, string $reqRoute);

    public function deleteObject(BaseInterface $object, string $reqRoute);

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
     */
    public function getAllObjects(BaseInterface $object, string $reqRoute, int $page = 1, int $pageSize = 0) :array;

    public function downloadFile(int $id);
}
