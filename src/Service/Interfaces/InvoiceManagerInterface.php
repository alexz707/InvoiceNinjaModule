<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;

/**
 * Interface InvoiceManagerInterface
 */
interface InvoiceManagerInterface
{
    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function createInvoice(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function delete(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function update(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function restore(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function archive(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param string $id
     *
     * @return InvoiceInterface
     * @throws NotFoundException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getInvoiceById(string $id) :InvoiceInterface;

    /**
     * @param string $invoiceNumber
     *
     * @return InvoiceInterface
     * @throws NotFoundException
     * @throws InvalidResultException
     * @throws InvalidParameterException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getInvoiceByNumber(string $invoiceNumber) :InvoiceInterface;

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return array
     * @throws InvalidResultException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getAllInvoices(int $page = 1, int $pageSize = 0) :array;

    /**
     * @param string $invoiceId
     *
     * @return array
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function downloadInvoice(string $invoiceId) :array;

    /**
     * @param string $invoiceId
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     */
    public function sendEmailInvoice(string $invoiceId) :void;
}
