<?php

namespace InvoiceNinjaModule\Strategy;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ContactsStrategyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ContactsStrategy($container->get('ReflectionHydrator'));
    }
}
