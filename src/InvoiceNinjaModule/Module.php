<?php

namespace InvoiceNinjaModule;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 *
 * @package InvoiceNinjaModule
 */
class Module implements ConfigProviderInterface
{
    const TOKEN = 'token';
    const TOKEN_TYPE = 'tokenType';
    const API_TIMEOUT = 'apiTimeout';
    const HOST_URL = 'hostUrl';
    const URL = 'url';

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
