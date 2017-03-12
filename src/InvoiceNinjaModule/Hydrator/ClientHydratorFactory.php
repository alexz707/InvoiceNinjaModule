<?php

namespace InvoiceNinjaModule\Hydrator;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ClientHydratorFactory
 *
 * @package InvoiceNinjaModule\Hydrator
 */
class ClientHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = new ClassMethods();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        return $hydrator;
    }
}
