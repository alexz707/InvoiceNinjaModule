<?php

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Model\Settings;
use Zend\Http\Client;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class RequestServiceFactory
 *
 * @package InvoiceNinjaModule\Service
 */
class RequestServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $settingsObj = $container->get(Settings::class);
        return new RequestService($settingsObj, new Client());
    }
}
