<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Options\ModuleOptions;
use Zend\Http\Client;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class RequestServiceFactory
 */
class RequestServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $settingsObj = $container->get(ModuleOptions::class);
        return new RequestService($settingsObj, new Client());
    }
}
