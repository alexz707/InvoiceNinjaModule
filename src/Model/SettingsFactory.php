<?php

namespace InvoiceNinjaModule\Model;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SettingsFactory
 *
 * @package InvoiceNinjaModule\Model
 */
class SettingsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $settingsArr = isset($config['invoiceninja']) ? $config['invoiceninja'] : [];
        return new Settings($settingsArr);
    }
}
