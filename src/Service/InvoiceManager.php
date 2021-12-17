<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;
use InvoiceNinjaModule\Model\Invoice;
use InvoiceNinjaModule\Service\Interfaces\InvoiceManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use JetBrains\PhpStorm\Pure;
use JsonException;

use function count;

/**
 * Class InvoiceManager
 */
final class InvoiceManager implements InvoiceManagerInterface
{
    private ObjectServiceInterface $objectManager;
    private string $reqRoute;
    private InvoiceInterface $objectType;

    /**
     * InvoiceManager constructor.
     *
     * @param ObjectServiceInterface $objectManager
     */
    #[Pure] public function __construct(ObjectServiceInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->reqRoute = '/invoices';
        $this->objectType  = new Invoice();
    }

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
    public function createInvoice(InvoiceInterface $invoice): InvoiceInterface
    {
        //@TODO: Invoice needs at least a clientId, a date and status!
        return $this->checkResult($this->objectManager->createObject($invoice, $this->reqRoute));
    }

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
    public function delete(InvoiceInterface $invoice): InvoiceInterface
    {
        return $this->checkResult($this->objectManager->deleteObject($invoice, $this->reqRoute));
    }

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
    public function update(InvoiceInterface $invoice): InvoiceInterface
    {
        return $this->checkResult($this->objectManager->updateObject($invoice, $this->reqRoute));
    }

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
    public function restore(InvoiceInterface $invoice): InvoiceInterface
    {
        return $this->checkResult($this->objectManager->restoreObject($invoice, $this->reqRoute));
    }

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
    public function archive(InvoiceInterface $invoice): InvoiceInterface
    {
        return $this->checkResult($this->objectManager->archiveObject($invoice, $this->reqRoute));
    }

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
    public function getInvoiceById(string $id): InvoiceInterface
    {
        return $this->checkResult($this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute));
    }

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
    public function getInvoiceByNumber(string $invoiceNumber): InvoiceInterface
    {
        $result = $this->objectManager->findObjectBy(
            $this->objectType,
            [InvoiceInterface::INVOICE_NR => $invoiceNumber],
            $this->reqRoute
        );

        if (count($result) === 1 && $result[0] instanceof InvoiceInterface) {
            return $result[0];
        }

        if (empty($result)) {
            throw new NotFoundException(InvoiceInterface::INVOICE_NR . ' ' . $invoiceNumber);
        }
        throw new InvalidResultException();
    }

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
    public function getAllInvoices(int $page = 1, int $pageSize = 0): array
    {
        $result = $this->objectManager->getAllObjects($this->objectType, $this->reqRoute, $page, $pageSize);
        foreach ($result as $invoice) {
            $this->checkResult($invoice);
        }
        return $result;
    }

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
    public function downloadInvoice(string $invitationKey): array
    {
        return $this->objectManager->downloadFile($invitationKey, 'invoice');
    }

    /**
     * @param array $invoiceIds
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function sendInvoicesEmail(array $invoiceIds): void
    {
        $this->objectManager->sendBulkCommand(
            ObjectServiceInterface::ACTION_EMAIL,
            $invoiceIds,
            $this->reqRoute
        );
    }

    /**
     * @param array $invoiceIds
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function markInvoicesSent(array $invoiceIds): void
    {
        $this->objectManager->sendBulkCommand(
            ObjectServiceInterface::ACTION_MARK_SENT,
            $invoiceIds,
            $this->reqRoute
        );
    }

    /**
     * @param array $invoiceIds
     *
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function markInvoicesPaid(array $invoiceIds): void
    {
        $this->objectManager->sendBulkCommand(
            ObjectServiceInterface::ACTION_MARK_PAID,
            $invoiceIds,
            $this->reqRoute
        );
    }

    /**
     * @param BaseInterface $invoice
     *
     * @return InvoiceInterface
     * @throws InvalidResultException
     */
    private function checkResult(BaseInterface $invoice): InvoiceInterface
    {
        if (!$invoice instanceof InvoiceInterface) {
            throw new InvalidResultException();
        }
        return $invoice;
    }
}
