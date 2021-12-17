<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\HttpClientException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\ProductInterface;
use JsonException;

interface ProductManagerInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws InvalidResultException
     * @throws HttpClientException
     * @throws JsonException
     */
    public function createProduct(ProductInterface $product): ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function delete(ProductInterface $product): ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function update(ProductInterface $product): ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function restore(ProductInterface $product): ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function archive(ProductInterface $product): ProductInterface;

    /**
     * @param string $id
     *
     * @return ProductInterface
     * @throws ApiAuthException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     * @throws NotFoundException
     */
    public function getProductById(string $id): ProductInterface;

    /**
     * @param int $page
     * @param int $pageSize
     *
     * @return ProductInterface[]
     * @throws ApiAuthException
     * @throws EmptyResponseException
     * @throws HttpClientAuthException
     * @throws HttpClientException
     * @throws InvalidResultException
     * @throws JsonException
     */
    public function getAllProducts(int $page = 1, int $pageSize = 0): array;
}
