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
use InvoiceNinjaModule\Service\ClientManagerFactory;
use InvoiceNinjaModule\Service\InvoiceManager;
use InvoiceNinjaModule\Service\InvoiceManagerFactory;
use InvoiceNinjaModule\Service\ObjectService;
use InvoiceNinjaModule\Service\ObjectServiceFactory;
use InvoiceNinjaModule\Service\ProductManager;
use InvoiceNinjaModule\Service\ProductManagerFactory;
use InvoiceNinjaModule\Service\RequestService;
use InvoiceNinjaModule\Service\RequestServiceFactory;
use InvoiceNinjaModule\Service\TaxRateManager;
use InvoiceNinjaModule\Service\TaxRateManagerFactory;
use InvoiceNinjaModule\Strategy\ContactsStrategy;
use InvoiceNinjaModule\Strategy\ContactsStrategyFactory;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use InvoiceNinjaModule\Strategy\InvoiceItemStrategyFactory;

return [
    Module::INVOICE_NINJA_CONFIG => [
        Module::API_TIMEOUT     => 100,
        Module::TOKEN_TYPE      => 'X-Ninja-Token',
        Module::TOKEN           => 'YOURTOKEN',
        Module::HOST_URL        => 'http://ninja.dev/api/v1',
        Module::AUTHORIZATION   => []
    ],
    'service_manager' => [
        'factories' => [
            RequestService::class       => RequestServiceFactory::class,
            ObjectService::class        => ObjectServiceFactory::class,
            ClientManager::class        => ClientManagerFactory::class,
            InvoiceManager::class       => InvoiceManagerFactory::class,
            ProductManager::class       => ProductManagerFactory::class,
            TaxRateManager::class       => TaxRateManagerFactory::class,
            ModuleOptions::class        => ModuleOptionsFactory::class,
            AuthOptions::class          => AuthOptionsFactory::class,
            'ReflectionHydrator'        => ReflectionHydratorFactory::class,
            'InvoiceNinjaHydrator'      => InvoiceNinjaHydratorFactory::class,
            ContactsStrategy::class     => ContactsStrategyFactory::class,
            InvoiceItemsStrategy::class => InvoiceItemStrategyFactory::class
        ]
    ]
];
