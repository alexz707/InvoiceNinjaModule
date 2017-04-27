<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SettingsFactory
 */
class SettingsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $settingsArr = $config['invoiceninja'] ?? [];
        return new Settings($settingsArr);
    }
}
