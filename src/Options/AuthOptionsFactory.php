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
 * Class AuthOptionsFactory
 */
class AuthOptionsFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return AuthOptions
     * @throws InvalidParameterException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): AuthOptions {
        $config = $container->get('Config');
        $settingsArr = $config[Module::INVOICE_NINJA_CONFIG] ?? [];
        $authArr = $settingsArr[Module::AUTHORIZATION] ?? [];
        return new AuthOptions($authArr);
    }
}
