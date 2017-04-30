<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Options;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Module;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ModuleOptionsFactory
 */
class ModuleOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $settingsArr = $config[Module::INVOICE_NINJA_CONFIG] ?? [];
        return new ModuleOptions($settingsArr, $container->get(AuthOptions::class));
    }
}
