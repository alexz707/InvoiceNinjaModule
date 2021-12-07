<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Options;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Module;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class AuthOptionsFactory
 */
class AuthOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $settingsArr = $config[Module::INVOICE_NINJA_CONFIG] ?? [];
        $authArr = $settingsArr[Module::AUTHORIZATION] ?? [];
        return new AuthOptions($authArr);
    }
}
