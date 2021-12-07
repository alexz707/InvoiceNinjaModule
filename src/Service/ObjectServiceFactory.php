<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Service\Interfaces\ObjectServiceInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class ObjectServiceFactory
 */
class ObjectServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ObjectServiceInterface
    {
        return new ObjectService($container->get(RequestService::class), $container->get('InvoiceNinjaHydrator'));
    }
}
