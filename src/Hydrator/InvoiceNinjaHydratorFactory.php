<?php

namespace InvoiceNinjaModule\Hydrator;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Strategy\ContactsStrategy;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use Zend\ServiceManager\Factory\FactoryInterface;

class InvoiceNinjaHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = $container->get('ReflectionHydrator');

        $hydrator->addStrategy('invoiceItems', $container->get(InvoiceItemsStrategy::class));
        $hydrator->addStrategy('invoice_items', $container->get(InvoiceItemsStrategy::class));
        $hydrator->addStrategy('contacts', $container->get(ContactsStrategy::class));

        return $hydrator;
    }
}
