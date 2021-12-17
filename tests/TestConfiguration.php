<?php

declare(strict_types=1);

return [
    'modules' => [
        'Laminas\Router',
        'InvoiceNinjaModule'
    ],
    'module_listener_options' => [
        'module_paths' => [
            '../../vendor',
        ],
        'config_glob_paths' => [
        ],
        'config_cache_enabled' => false,
        'module_map_cache_enabled' => false,
    ],
];
