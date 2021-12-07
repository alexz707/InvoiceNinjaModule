<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\ProductInterface;

interface ProductManagerInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function createProduct(ProductInterface $product) :ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function delete(ProductInterface $product) :ProductInterface;
    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function update(ProductInterface $product) :ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function restore(ProductInterface $product) :ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function archive(ProductInterface $product) :ProductInterface;

    /**
     * @param string $id
     *
     * @return ProductInterface
     * @throws NotFoundException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getProductById(string $id) :ProductInterface;

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
    public function getAllProducts(int $page = 1, int $pageSize = 0) :array;
}
