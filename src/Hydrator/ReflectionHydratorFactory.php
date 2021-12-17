<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Hydrator;

use Interop\Container\ContainerInterface;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class ReflectionHydratorFactory
 */
final class ReflectionHydratorFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): ReflectionHydrator {
        $hydrator = new ReflectionHydrator();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        return $hydrator;
    }
}
