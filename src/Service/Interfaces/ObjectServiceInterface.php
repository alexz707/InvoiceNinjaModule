<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

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
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param int           $id
     * @param string        $reqRoute
     *
     * @return BaseInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getObjectById(BaseInterface $object, int $id, string $reqRoute) :BaseInterface;

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
    public function findObjectBy(BaseInterface $object, array $searchTerm, string $reqRoute) :array;

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
    public function restoreObject(BaseInterface $object, string $reqRoute) :BaseInterface;

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
    public function archiveObject(BaseInterface $object, string $reqRoute) :BaseInterface;

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
    public function updateObject(BaseInterface $object, string $reqRoute) :BaseInterface;

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
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getAllObjects(BaseInterface $object, string $reqRoute, int $page = 1, int $pageSize = 0) :array;

    /**
     * @param int $id
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function downloadFile(int $id) :array;

    /**
     * @param string $command
     * @param array  $body
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     */
    public function sendCommand(string $command, array $body) :void;
}
