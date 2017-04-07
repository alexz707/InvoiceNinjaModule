<?php

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Model\Settings;
use Zend\Http\Client;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ApiManagerFactory
 *
 * @package InvoiceNinjaModule\Service
 */
class ApiManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $settingsObj = $container->get(Settings::class);
        return new ApiManager($settingsObj, new Client());
    }
}
