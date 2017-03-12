<?php

namespace InvoiceNinjaModule;

use InvoiceNinjaModule\Hydrator\ClientHydratorFactory;
use InvoiceNinjaModule\Model\Settings;
use InvoiceNinjaModule\Model\SettingsFactory;
use InvoiceNinjaModule\Service\ApiManager;
use InvoiceNinjaModule\Service\ApiManagerFactory;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\ClientManagerFactory;

return [
    'invoiceninja' => [
        Module::API_TIMEOUT => 100,
        Module::TOKEN_TYPE  => 'X-Ninja-Token',
        Module::TOKEN       => 'YOURTOKEN',
        Module::HOST_URL    => 'http://ninja.dev/api/v1'
    ],
    'service_manager' => [
        'factories' => [
            ApiManager::class => ApiManagerFactory::class,
            ClientManager::class => ClientManagerFactory::class,
            Settings::class => SettingsFactory::class,
            'ClientHydrator' => ClientHydratorFactory::class
        ]
    ]
];