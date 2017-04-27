<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface SettingsInterface
 */
interface SettingsInterface
{
    /**
     * @return string
     */
    public function getToken() :string;

    /**
     * @return string
     */
    public function getTokenType() :string;
    /**
     * @return int
     */
    public function getTimeout() :int;
    /**
     * @return string
     */
    public function getHostUrl() :string;
}
