<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;
use JsonException;

interface TaxRateManagerInterface
{
    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function createTaxRate(TaxRateInterface $taxRate): TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function delete(TaxRateInterface $taxRate): TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function update(TaxRateInterface $taxRate): TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function restore(TaxRateInterface $taxRate): TaxRateInterface;

    /**
     * @param TaxRateInterface $taxRate
     *
     * @return TaxRateInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function archive(TaxRateInterface $taxRate): TaxRateInterface;

    /**
     * @param string $id
     *
     * @return TaxRateInterface
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function getTaxRateById(string $id): TaxRateInterface;

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return TaxRateInterface[]
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function getAllTaxRates(int $page = 1, int $pageSize = 0): array;
}
