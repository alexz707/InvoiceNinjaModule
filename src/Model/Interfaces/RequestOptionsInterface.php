<?php

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface RequestOptionsInterface
 *
 * @package InvoiceNinjaModule\Model\Interfaces
 */
interface RequestOptionsInterface
{
    /**
     * @param array $params
     */
    public function addQueryParameters(array $params);

    /**
     * @param array $params
     */
    public function addPostParameters(array $params);

    /**
     * @return array
     */
    public function getQueryArray();

    /**
     * @return array
     */
    public function getPostArray();
}
