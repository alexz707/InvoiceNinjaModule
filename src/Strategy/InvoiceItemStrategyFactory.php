<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class InvoiceItemStrategyFactory
 */
class InvoiceItemStrategyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new InvoiceItemsStrategy($container->get('ReflectionHydrator'));
    }
}
