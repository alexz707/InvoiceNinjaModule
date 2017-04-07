<?php

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface SettingsInterface
 *
 * @package InvoiceNinjaModule\Model\Interfaces
 */
interface SettingsInterface
{
    /**
     * @return string
     */
    public function getToken();

    /**
     * @return string
     */
    public function getTokenType();

    /**
     * @return int
     */
    public function getTimeout();

    /**
     * @return string
     */
    public function getHostUrl();
}
