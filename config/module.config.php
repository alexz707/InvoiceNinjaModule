<?php

declare(strict_types=1);

namespace InvoiceNinjaModule;

use InvoiceNinjaModule\Hydrator\InvoiceNinjaHydratorFactory;
use InvoiceNinjaModule\Hydrator\ReflectionHydratorFactory;
use InvoiceNinjaModule\Options\AuthOptions;
use InvoiceNinjaModule\Options\AuthOptionsFactory;
use InvoiceNinjaModule\Options\ModuleOptions;
use InvoiceNinjaModule\Options\ModuleOptionsFactory;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\InvoiceManager;
use InvoiceNinjaModule\Service\ObjectService;
use InvoiceNinjaModule\Service\ProductManager;
use InvoiceNinjaModule\Service\RequestService;
use InvoiceNinjaModule\Service\TaxRateManager;
use InvoiceNinjaModule\Strategy\ContactsStrategy;
use InvoiceNinjaModule\Strategy\InvitationsStrategy;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use Laminas\Http\Client;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
    Module::INVOICE_NINJA_CONFIG => [
        Module::API_TIMEOUT     => 100,
        Module::TOKEN_TYPE      => 'X-API-Token',
        Module::TOKEN           => 'YOURTOKEN',
        Module::HOST_URL        => 'https://ninja.dev/api/v1',
        Module::AUTHORIZATION   => []
    ],
    'service_manager' => [
        'factories' => [
            Client::class => ConfigAbstractFactory::class,
            RequestService::class => ConfigAbstractFactory::class,
            ObjectService::class => ConfigAbstractFactory::class,
            ClientManager::class => ConfigAbstractFactory::class,
            InvoiceManager::class => ConfigAbstractFactory::class,
            ProductManager::class => ConfigAbstractFactory::class,
            TaxRateManager::class => ConfigAbstractFactory::class,
            ModuleOptions::class => ModuleOptionsFactory::class,
            AuthOptions::class => AuthOptionsFactory::class,
            'ReflectionHydrator' => ReflectionHydratorFactory::class,
            'InvoiceNinjaHydrator' => InvoiceNinjaHydratorFactory::class,
            ContactsStrategy::class => ConfigAbstractFactory::class,
            InvoiceItemsStrategy::class => ConfigAbstractFactory::class,
            InvitationsStrategy::class  => ConfigAbstractFactory::class,
        ]
    ],
    ConfigAbstractFactory::class => [
        Client::class => [],
        RequestService::class => [ModuleOptions::class, Client::class,],
        ObjectService::class => [RequestService::class, 'InvoiceNinjaHydrator',],
        ClientManager::class => [ObjectService::class,],
        InvoiceManager::class => [ObjectService::class,],
        ProductManager::class => [ObjectService::class,],
        TaxRateManager::class => [ObjectService::class,],
        ContactsStrategy::class => ['ReflectionHydrator',],
        InvoiceItemsStrategy::class => ['ReflectionHydrator',],
        InvitationsStrategy::class => ['ReflectionHydrator',],
    ],
];
