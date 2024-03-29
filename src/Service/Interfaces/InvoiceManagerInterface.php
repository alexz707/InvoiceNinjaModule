<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;
use JsonException;

/**
 * Interface InvoiceManagerInterface
 */
interface InvoiceManagerInterface
{
    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function createInvoice(InvoiceInterface $invoice): InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function delete(InvoiceInterface $invoice): InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function update(InvoiceInterface $invoice): InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function restore(InvoiceInterface $invoice): InvoiceInterface;

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function archive(InvoiceInterface $invoice): InvoiceInterface;

    /**
     * @param string $id
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function getInvoiceById(string $id): InvoiceInterface;

    /**
     * @param string $invoiceNumber
     *
     * @return InvoiceInterface
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidParameterException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function getInvoiceByNumber(string $invoiceNumber): InvoiceInterface;

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return InvoiceInterface[]
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function getAllInvoices(int $page = 1, int $pageSize = 0): array;

    /**
     * @param string $invitationKey
     *
     * @return array
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function downloadInvoice(string $invitationKey): array;

    /**
     * @param array $invoiceIds
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function sendInvoicesEmail(array $invoiceIds): void;

    /**
     * @param array $invoiceIds
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function markInvoicesSent(array $invoiceIds): void;

    /**
     * @param array $invoiceIds
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function markInvoicesPaid(array $invoiceIds): void;
}
