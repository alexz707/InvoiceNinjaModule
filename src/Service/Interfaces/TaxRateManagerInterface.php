<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;

interface TaxRateManagerInterface
{
    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function createTaxRate(TaxRateInterface $taxRate) :TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function delete(TaxRateInterface $taxRate) :TaxRateInterface;
    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function update(TaxRateInterface $taxRate) :TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function restore(TaxRateInterface $taxRate) :TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function archive(TaxRateInterface $taxRate) :TaxRateInterface;
    /**
     * @param string $id
     *
     * @return TaxRateInterface
     * @throws NotFoundException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getTaxRateById(string $id) :TaxRateInterface;

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
    public function getAllTaxRates(int $page = 1, int $pageSize = 0) :array;
}
