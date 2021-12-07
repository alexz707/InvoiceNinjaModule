<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use InvoiceNinjaModule\Exception\ApiAuthException;
use InvoiceNinjaModule\Exception\EmptyResponseException;
use InvoiceNinjaModule\Exception\HttpClientAuthException;
use InvoiceNinjaModule\Exception\InvalidResultException;
use InvoiceNinjaModule\Exception\NotFoundException;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use InvoiceNinjaModule\Model\Interfaces\ProductInterface;
use InvoiceNinjaModule\Model\Product;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use InvoiceNinjaModule\Service\Interfaces\ProductManagerInterface;

/**
 * Class ProductManager
 */
final class ProductManager implements ProductManagerInterface
{
    private ObjectServiceInterface $objectManager;
    private string $reqRoute;
    private ProductInterface $objectType;

    /**
     * ProductManager constructor.
     *
     * @param ObjectServiceInterface $objectManager
     */
    public function __construct(ObjectServiceInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->reqRoute = '/products';
        $this->objectType  = new Product();
    }

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function createProduct(ProductInterface $product) :ProductInterface
    {
        return $this->checkResult($this->objectManager->createObject($product, $this->reqRoute));
    }

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function delete(ProductInterface $product) :ProductInterface
    {
        return $this->checkResult($this->objectManager->deleteObject($product, $this->reqRoute));
    }

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function update(ProductInterface $product) :ProductInterface
    {
        return $this->checkResult($this->objectManager->updateObject($product, $this->reqRoute));
    }

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function restore(ProductInterface $product) :ProductInterface
    {
        return $this->checkResult($this->objectManager->restoreObject($product, $this->reqRoute));
    }

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function archive(ProductInterface $product) :ProductInterface
    {
        return $this->checkResult($this->objectManager->archiveObject($product, $this->reqRoute));
    }

    /**
     * @param int string
     *
     * @return ProductInterface
     * @throws NotFoundException
     * @throws EmptyResponseException
     * @throws InvalidResultException
     * @throws HttpClientAuthException
     * @throws ApiAuthException
     */
    public function getProductById(string $id) :ProductInterface
    {
        return $this->checkResult($this->objectManager->getObjectById($this->objectType, $id, $this->reqRoute));
    }

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
    public function getAllProducts(int $page = 1, int $pageSize = 0) :array
    {
        $result = $this->objectManager->getAllObjects($this->objectType, $this->reqRoute, $page, $pageSize);
        foreach ($result as $product) {
            $this->checkResult($product);
        }
        return $result;
    }

    /**
     * @param BaseInterface $product
     *
     * @return ProductInterface
     * @throws InvalidResultException
     */
    private function checkResult(BaseInterface $product) :ProductInterface
    {
        if (!$product instanceof ProductInterface) {
            throw new InvalidResultException();
        }
        return $product;
    }
}
