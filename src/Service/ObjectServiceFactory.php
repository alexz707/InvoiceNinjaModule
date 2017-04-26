<?php

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ObjectServiceFactory
 *
 * @package InvoiceNinjaModule\Service
 */
class ObjectServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ObjectService($container->get(RequestService::class), $container->get('InvoiceNinjaHydrator'));
    }
}
