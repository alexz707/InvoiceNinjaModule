<?php

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;
use InvoiceNinjaModule\Model\Invoice;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;

/**
 * Class InvoiceManager
 *
 * @package InvoiceNinjaModule\Service
 */
class InvoiceManager implements ClientManagerInterface
{
    /** @var ObjectServiceInterface  */
    private $objectManager;
    /** @var  string */
    private $reqRoute;
    /** @var Invoice  */
    private $objectType;

    /**
     * InvoiceManager constructor.
     *
     * @param ObjectServiceInterface $objectManager
     */
    public function __construct(ObjectServiceInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->reqRoute = '/invoices';
        $this->objectType  = new Invoice();
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     */
    public function createInvoice(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->objectManager->createObject($invoice, $this->reqRoute);
    }

    public function delete(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->objectManager->deleteObject($invoice, $this->reqRoute);
    }

    public function update(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->objectManager->updateObject($invoice, $this->reqRoute);
    }

    public function restore(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->objectManager->restoreObject($invoice, $this->reqRoute);
    }

    public function archive(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->objectManager->archiveObject($invoice, $this->reqRoute);
    }

    public function getInvoiceById(int $id) :InvoiceInterface
    {
        return $this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute);
    }

    public function getInvoiceByNumber(string $invoiceNumber) :InvoiceInterface
    {
        $result = $this->objectManager->findObjectBy(
            $this->objectType,
            [Invoice::INVOICE_NR => $invoiceNumber],
            $this->reqRoute
        );

        if (\count($result) === 1) {
            return $result[0];
        }

        if (empty($result)) {
            throw new NotFoundException(Invoice::INVOICE_NR.' '.$invoiceNumber);
        }
        throw new InvalidResultException();
    }

    public function getAllInvoices(int $page = 1, int $pageSize = 0) :array
    {
        return $this->objectManager->getAllObjects($this->objectType, $this->reqRoute, $page, $pageSize);
    }

    public function downloadInvoice(int $invoiceId) :array
    {
        return $this->objectManager->downloadFile($invoiceId);
    }
}
