<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

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
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createInvoice(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function delete(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function update(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restore(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archive(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param int $id
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getInvoiceById(int $id) :InvoiceInterface;

    /**
     * @param string $invoiceNumber
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\NotFoundException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getInvoiceByNumber(string $invoiceNumber) :InvoiceInterface;

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
    public function getAllInvoices(int $page = 1, int $pageSize = 0) :array;

    /**
     * @param int $invoiceId
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function downloadInvoice(int $invoiceId) :array;

    /**
     * @param int $invoiceId
     *
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     */
    public function sendEmailInvoice(int $invoiceId) :void;
}
