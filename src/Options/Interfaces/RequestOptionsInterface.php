<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Options\Interfaces;

/**
 * Interface RequestOptionsInterface
 */
interface RequestOptionsInterface
{
    /**
     * @param array $params
     */
    public function addQueryParameters(array $params): void;

    /**
     * @param array $params
     */
    public function addPostParameters(array $params): void;
    /**
     * @return array
     */
    public function getQueryArray(): array;

    /**
     * @return array
     */
    public function getPostArray(): array;

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize): void;

    /**
     * @param int $page
     */
    public function setPage(int $page): void;

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId): void;

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void;

    /**
     * @param string $include
     */
    public function setInclude(string $include): void;
}
