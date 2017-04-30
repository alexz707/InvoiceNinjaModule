InvoiceNinjaModule
=================
ZF3 Module to consume the InvoiceNinja API (https://www.invoiceninja.com).

[![GitHub release](https://img.shields.io/github/release/alexz707/InvoiceNinjaModule.svg)](https://github.com/alexz707/InvoiceNinjaModule/releases)
[![Build Status](https://travis-ci.org/alexz707/InvoiceNinjaModule.svg?branch=master)](https://travis-ci.org/alexz707/InvoiceNinjaModule)
[![Code Coverage](https://scrutinizer-ci.com/g/alexz707/InvoiceNinjaModule/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alexz707/InvoiceNinjaModule/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alexz707/InvoiceNinjaModule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alexz707/InvoiceNinjaModule/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/59025f0a45de6b004ab703e8/badge.svg)](https://www.versioneye.com/user/projects/59025f0a45de6b004ab703e8)
[![Total Downloads](https://poser.pugx.org/alexz707/invoiceninja-module/downloads)](https://packagist.org/packages/alexz707/invoiceninja-module)
[![Latest Stable Version](https://poser.pugx.org/alexz707/invoiceninja-module/v/stable.png)](https://packagist.org/packages/alexz707/invoiceninja-module)

Description
==================

Latest release can handle the following api services:

* Clients
* Invoices
* Products

Can use `basic` or `digest` server authorization.


## Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```sh
php composer.phar require alexz707/invoiceninja-module
```
### Configure module
* Copy `/vendor/alexz707/invoiceninja-module/config/invoiceninja.global.php.dist` into your global autoload folder, remove the dist extension so that Zend Framework picks it up
* If you use your own instance of invoice ninja change the `host url`
* Replace the `token` with your generated invoice ninja token
* If you use `basic` or `digest` authorization uncomment the used method and fill in your credentials

```php
    Module::INVOICE_NINJA_CONFIG => [
        Module::API_TIMEOUT     => 100,
        Module::TOKEN           => 'YOURTOKEN',
        Module::HOST_URL        => 'http://ninja.dev/api/v1',

        /*
         * If the api is protected by htaccess uncomment
         * ONE of the following code blocks and use your credentials.
         */
        Module::AUTHORIZATION   => [
            /*
             * BASIC authorization
             * \Zend\Http\Client::AUTH_BASIC => [
             *    Module::AUTH_USER => 'YOURUSER',
             *    Module::AUTH_PASS => 'YOURPASSWORD'
             * ]
             */

            /*
             * DIGEST authorization
             * \Zend\Http\ClientClient::AUTH_DIGEST => [
             *    Module::AUTH_USER => 'YOURUSER',
             *    Module::AUTH_PASS => 'YOURPASSWORD'
             * ]
             */
        ]
    ]
```

### Enable module 
Register as Zend Framework module inside your ```config/application.config.php``` file:

```php
    'modules' => [
        'Zend\Router',
        'InvoiceNinjaModule',
        'YourApplicationModule',
    ],
```
### Use the service managers

```php
        /** @var ClientManager $clientManager */
        $clientManager = $sm->get(ClientManager::class);
        $client = $clientManager->getClientById(1);
```


