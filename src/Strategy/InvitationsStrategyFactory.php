<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class InvitationsStrategyFactory
 */
class InvitationsStrategyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : InvitationsStrategy
    {
        return new InvitationsStrategy($container->get('ReflectionHydrator'));
    }
}
