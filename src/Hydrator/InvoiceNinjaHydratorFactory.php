<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Hydrator;

use InvoiceNinjaModule\Strategy\ContactsStrategy;
use InvoiceNinjaModule\Strategy\InvitationsStrategy;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class InvoiceNinjaHydratorFactory
 */
final class InvoiceNinjaHydratorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return ReflectionHydrator
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): ReflectionHydrator {
        /** @var ReflectionHydrator $hydrator */
        $hydrator = $container->get('ReflectionHydrator');

        $hydrator->addStrategy('lineItems', $container->get(InvoiceItemsStrategy::class));
        $hydrator->addStrategy('line_items', $container->get(InvoiceItemsStrategy::class));
        $hydrator->addStrategy('contacts', $container->get(ContactsStrategy::class));
        $hydrator->addStrategy('invitations', $container->get(InvitationsStrategy::class));
        $hydrator->addStrategy('status_id', ScalarTypeStrategy::createToInt());

        return $hydrator;
    }
}
