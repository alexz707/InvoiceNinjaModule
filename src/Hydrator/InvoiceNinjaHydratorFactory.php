<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Hydrator;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Strategy\ContactsStrategy;
use InvoiceNinjaModule\Strategy\InvitationsStrategy;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class InvoiceNinjaHydratorFactory
 */
final class InvoiceNinjaHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = $container->get('ReflectionHydrator');

        $hydrator->addStrategy('lineItems', $container->get(InvoiceItemsStrategy::class));
        $hydrator->addStrategy('line_items', $container->get(InvoiceItemsStrategy::class));
        $hydrator->addStrategy('contacts', $container->get(ContactsStrategy::class));
        $hydrator->addStrategy('invitations', $container->get(InvitationsStrategy::class));

        return $hydrator;
    }
}
