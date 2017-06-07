<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;
use InvoiceNinjaModule\Model\TaxRate;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\TaxRateManagerInterface;

/**
 * Class TaxRateManager
 */
final class TaxRateManager implements TaxRateManagerInterface
{
    /** @var ObjectServiceInterface  */
    private $objectManager;
    /** @var  string */
    private $reqRoute;
    /** @var TaxRateInterface  */
    private $objectType;

    /**
     * ProductManager constructor.
     *
     * @param ObjectServiceInterface $objectManager
     */
    public function __construct(ObjectServiceInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->reqRoute = '/tax_rates';
        $this->objectType  = new TaxRate();
    }

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createTaxRate(TaxRateInterface $taxRate) :TaxRateInterface
    {
        return $this->checkResult($this->objectManager->createObject($taxRate, $this->reqRoute));
    }

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function delete(TaxRateInterface $taxRate) :TaxRateInterface
    {
        return $this->checkResult($this->objectManager->deleteObject($taxRate, $this->reqRoute));
    }

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function update(TaxRateInterface $taxRate) :TaxRateInterface
    {
        return $this->checkResult($this->objectManager->updateObject($taxRate, $this->reqRoute));
    }

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restore(TaxRateInterface $taxRate) :TaxRateInterface
    {
        return $this->checkResult($this->objectManager->restoreObject($taxRate, $this->reqRoute));
    }

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archive(TaxRateInterface $taxRate) :TaxRateInterface
    {
        return $this->checkResult($this->objectManager->archiveObject($taxRate, $this->reqRoute));
    }

    /**
     * @param int $id
     *
     * @return TaxRateInterface
     * @throws NotFoundException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getTaxRateById(int $id) :TaxRateInterface
    {
        return $this->checkResult($this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute));
    }

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
    public function getAllTaxRates(int $page = 1, int $pageSize = 0) :array
    {
        $result = $this->objectManager->getAllObjects($this->objectType, $this->reqRoute, $page, $pageSize);
        foreach ($result as $taxRate) {
            $this->checkResult($taxRate);
        }
        return $result;
    }

    /**
     * @param BaseInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     */
    private function checkResult(BaseInterface $taxRate) :TaxRateInterface
    {
        if (!$taxRate instanceof TaxRateInterface) {
            throw new InvalidResultException();
        }
        return $taxRate;
    }
}
