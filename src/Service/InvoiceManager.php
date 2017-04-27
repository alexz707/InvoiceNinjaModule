<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;
use InvoiceNinjaModule\Model\Invoice;
use InvoiceNinjaModule\Service\Interfaces\InvoiceManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;

/**
 * Class InvoiceManager
 */
class InvoiceManager implements InvoiceManagerInterface
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
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function createInvoice(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->checkResult($this->objectManager->createObject($invoice, $this->reqRoute));
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function delete(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->checkResult($this->objectManager->deleteObject($invoice, $this->reqRoute));
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function update(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->checkResult($this->objectManager->updateObject($invoice, $this->reqRoute));
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function restore(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->checkResult($this->objectManager->restoreObject($invoice, $this->reqRoute));
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function archive(InvoiceInterface $invoice) :InvoiceInterface
    {
        return $this->checkResult($this->objectManager->archiveObject($invoice, $this->reqRoute));
    }

    /**
     * @param int $id
     *
     * @return InvoiceInterface
     * @throws NotFoundException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws InvalidResultException
     */
    public function getInvoiceById(int $id) :InvoiceInterface
    {
        return $this->checkResult($this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute));
    }

    /**
     * @param string $invoiceNumber
     *
     * @return InvoiceInterface
     * @throws InvalidResultException
     * @throws NotFoundException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\InvalidParameterException
     */
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

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return array
     * @throws InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function getAllInvoices(int $page = 1, int $pageSize = 0) :array
    {
        $result = $this->objectManager->getAllObjects($this->objectType, $this->reqRoute, $page, $pageSize);
        foreach ($result as $invoice) {
            $this->checkResult($invoice);
        }
        return $result;
    }

    /**
     * @param int $invoiceId
     *
     * @return array
     * @throws \InvoiceNinjaModule\Exception\ApiException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     */
    public function downloadInvoice(int $invoiceId) :array
    {
        return $this->objectManager->downloadFile($invoiceId);
    }

    /**
     * @param BaseInterface $invoice
     *
     * @return InvoiceInterface
     * @throws InvalidResultException
     */
    private function checkResult(BaseInterface $invoice) :InvoiceInterface
    {
        if (!$invoice instanceof InvoiceInterface) {
            throw new InvalidResultException();
        }
        return $invoice;
    }
}
