<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Options\ModuleOptions;
use InvoiceNinjaModule\Service\Interfaces\RequestServiceInterface;
use Laminas\Http\Client;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class RequestServiceFactory
 */
class RequestServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : RequestServiceInterface
    {
        $settingsObj = $container->get(ModuleOptions::class);
        return new RequestService($settingsObj, new Client());
    }
}
