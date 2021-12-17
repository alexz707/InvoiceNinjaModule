<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface BaseInterface
 */
interface BaseInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return int
     */
    public function getUpdatedAt(): int;

    /**
     * @return int
     */
    public function getArchivedAt(): int;

    /**
     * @return int
     */
    public function getCreatedAt(): int;

    /**
     * @return bool
     */
    public function isDeleted(): bool;
}
