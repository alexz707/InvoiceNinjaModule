<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Hydrator;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Zend\Hydrator\Reflection;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ReflectionHydratorFactory
 */
final class ReflectionHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = new Reflection();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        return $hydrator;
    }
}
