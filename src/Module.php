<?php
declare(strict_types=1);

namespace InvoiceNinjaModule;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @codeCoverageIgnore
 */
class Module implements ConfigProviderInterface
{
    const INVOICE_NINJA_CONFIG = 'invoiceNinjaConfig';
    const TOKEN = 'token';
    const TOKEN_TYPE = 'tokenType';
    const API_TIMEOUT = 'apiTimeout';
    const HOST_URL = 'hostUrl';
    const URL = 'url';
    const AUTHORIZATION = 'authorization';
    const AUTH_USER = 'auth_user';
    const AUTH_PASS = 'auth_pass';

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
