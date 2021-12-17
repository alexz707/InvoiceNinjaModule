<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Options\Interfaces;

/**
 * Interface ModuleOptionsInterface
 */
interface ModuleOptionsInterface
{
    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getTokenType(): string;
    /**
     * @return int
     */
    public function getTimeout(): int;
    /**
     * @return string
     */
    public function getHostUrl(): string;

    /**
     * @return AuthOptionsInterface
     */
    public function getAuthOptions(): AuthOptionsInterface;
}
