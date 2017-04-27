<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

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
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function createInvoice(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function delete(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function update(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function restore(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function archive(InvoiceInterface $invoice) :InvoiceInterface;

    /**
     * @param int $id
     *
     * @return InvoiceInterface
     * @throws NotFoundException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function getInvoiceById(int $id) :InvoiceInterface;

    /**
     * @param string $invoiceNumber
     *
     * @return InvoiceInterface
     * @throws InvalidResultException
     * @throws NotFoundException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function getInvoiceByNumber(string $invoiceNumber) :InvoiceInterface;

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return array
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function getAllInvoices(int $page = 1, int $pageSize = 0) :array;

    /**
     * @param int $invoiceId
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function downloadInvoice(int $invoiceId) :array;
}
