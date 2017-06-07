<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;

interface TaxRateManagerInterface
{
    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createTaxRate(TaxRateInterface $taxRate) :TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function delete(TaxRateInterface $taxRate) :TaxRateInterface;
    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function update(TaxRateInterface $taxRate) :TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restore(TaxRateInterface $taxRate) :TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archive(TaxRateInterface $taxRate) :TaxRateInterface;
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
    public function getTaxRateById(int $id) :TaxRateInterface;

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
    public function getAllTaxRates(int $page = 1, int $pageSize = 0) :array;
}
