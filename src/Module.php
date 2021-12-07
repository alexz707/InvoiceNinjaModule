<?php
declare(strict_types=1);

namespace InvoiceNinjaModule;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @codeCoverageIgnore
 */
class Module implements ConfigProviderInterface
{
    public const INVOICE_NINJA_CONFIG = 'invoiceNinjaConfig';
    public const TOKEN = 'token';
    public const TOKEN_TYPE = 'tokenType';
    public const API_TIMEOUT = 'apiTimeout';
    public const HOST_URL = 'hostUrl';
    public const URL = 'url';
    public const AUTHORIZATION = 'authorization';
    public const AUTH_USER = 'auth_user';
    public const AUTH_PASS = 'auth_pass';

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
