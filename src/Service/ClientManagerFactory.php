<?php

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ClientManagerFactory
 *
 * @package InvoiceNinjaModule\Service
 */
class ClientManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $apiService = $container->get(ApiManager::class);
        $clientHydrator = $container->get('ClientHydrator');

        return new ClientManager($apiService, $clientHydrator);
    }
}
