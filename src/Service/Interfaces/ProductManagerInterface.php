<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service\Interfaces;

use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\ProductInterface;

interface ProductManagerInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function createProduct(ProductInterface $product) :ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function delete(ProductInterface $product) :ProductInterface;
    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function update(ProductInterface $product) :ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function restore(ProductInterface $product) :ProductInterface;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function archive(ProductInterface $product) :ProductInterface;
    /**
     * @param int $id
     *
     * @return ProductInterface
     * @throws NotFoundException
     * @throws \InvoiceNinjaModule\Exception\EmptyResponseException
     * @throws \InvoiceNinjaModule\Exception\InvalidResultException
     * @throws \InvoiceNinjaModule\Exception\HttpClientAuthException
     * @throws \InvoiceNinjaModule\Exception\ApiAuthException
     */
    public function getProductById(int $id) :ProductInterface;

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
    public function getAllProducts(int $page = 1, int $pageSize = 0) :array;
}
