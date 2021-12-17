<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Options;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Module;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ModuleOptionsFactory
 */
class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return ModuleOptions
     * @throws InvalidParameterException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): ModuleOptions {
        $config = $container->get('Config');
        $settingsArr = $config[Module::INVOICE_NINJA_CONFIG] ?? [];
        return new ModuleOptions($settingsArr, $container->get(AuthOptions::class));
    }
}
