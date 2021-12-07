<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Service;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class ClientManagerFactory
 */
class ClientManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ClientManagerInterface
    {
        return new ClientManager($container->get(ObjectService::class));
    }
}
