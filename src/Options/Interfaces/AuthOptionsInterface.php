<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Options\Interfaces;

interface AuthOptionsInterface
{
    /**
     * @return bool
     */
    public function isAuthorization() : bool;

    /**
     * @return string
     */
    public function getAuthType() : string;
    /**
     * @return string
     */
    public function getUsername() : string;

    /**
     * @return string
     */
    public function getPassword() : string;
}
