<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;

/**
 * Interface ObjectServiceInterface
 */
interface ObjectServiceInterface
{
    public const ACTION_EMAIL = 'email_invoice';
    public const ACTION_MARK_SENT = 'mark_sent';
    public const ACTION_ARCHIVE = 'archive';
    public const ACTION_DELETE = 'delete';
    public const ACTION_RESTORE = 'restore';
    public const ACTION_MARK_PAID = 'mark_paid';

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
    public function createObject(BaseInterface $object, string $reqRoute) :BaseInterface;

    /**
     * @param BaseInterface $object
     * @param string        $id
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
     * @throws InvalidParameterException
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
     * @param string $invitationKey
     * @param string $topic
     *
     * @return array
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function downloadFile(string $invitationKey, string $topic) :array;

    /**
     * @param string $command
     * @param string $id
     * @param string $reqRoute
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     */
    public function sendCommand(string $command, string $id, string $reqRoute) :void;

    /**
     * @param string $command
     * @param array $ids
     * @param string $reqRoute
     *
     * @throws EmptyResponseException
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     */
    public function sendBulkCommand(string $command, array $ids, string $reqRoute) :void;
}
