<?php

namespace InvoiceNinjaModule;

use InvoiceNinjaModule\Hydrator\InvoiceNinjaHydratorFactory;
use InvoiceNinjaModule\Hydrator\ReflectionHydratorFactory;
use InvoiceNinjaModule\Model\Settings;
use InvoiceNinjaModule\Model\SettingsFactory;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\ClientManagerFactory;
use InvoiceNinjaModule\Service\InvoiceManager;
use InvoiceNinjaModule\Service\InvoiceManagerFactory;
use InvoiceNinjaModule\Service\ObjectService;
use InvoiceNinjaModule\Service\ObjectServiceFactory;
use InvoiceNinjaModule\Service\RequestService;
use InvoiceNinjaModule\Service\RequestServiceFactory;
use InvoiceNinjaModule\Strategy\ContactsStrategy;
use InvoiceNinjaModule\Strategy\ContactsStrategyFactory;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use InvoiceNinjaModule\Strategy\InvoiceItemStrategyFactory;

return [
    'invoiceninja' => [
        Module::API_TIMEOUT => 100,
        Module::TOKEN_TYPE  => 'X-Ninja-Token',
        Module::TOKEN       => 'YOURTOKEN',
        Module::HOST_URL    => 'http://ninja.dev/api/v1'
    ],
    'service_manager' => [
        'factories' => [
            RequestService::class       => RequestServiceFactory::class,
            ObjectService::class        => ObjectServiceFactory::class,
            ClientManager::class        => ClientManagerFactory::class,
            InvoiceManager::class       => InvoiceManagerFactory::class,
            Settings::class             => SettingsFactory::class,
            'ReflectionHydrator'        => ReflectionHydratorFactory::class,
            'InvoiceNinjaHydrator'      => InvoiceNinjaHydratorFactory::class,
            ContactsStrategy::class     => ContactsStrategyFactory::class,
            InvoiceItemsStrategy::class => InvoiceItemStrategyFactory::class
        ]
    ]
];
