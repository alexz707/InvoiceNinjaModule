InvoiceNinjaModule
=================
ZF3 Module to consume the InvoiceNinja API.

[![GitHub release](https://img.shields.io/github/release/alexz707/InvoiceNinjaModule.svg)](https://github.com/alexz707/InvoiceninjaModule/releases)
[![Build Status](https://travis-ci.org/alexz707/InvoiceNinjaModule.svg?branch=master)](https://travis-ci.org/alexz707/InvoiceninjaModule)
[![Code Coverage](https://scrutinizer-ci.com/g/alexz707/InvoiceNinjaModule/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alexz707/InvoiceninjaModule/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alexz707/InvoiceNinjaModule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alexz707/InvoiceninjaModule/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/59025f0a45de6b004ab703e8/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/59025f0a45de6b004ab703e8)
[![Total Downloads](https://poser.pugx.org/alexz707/invoiceninja-module/downloads)](https://packagist.org/packages/alexz707/invoiceninja-module)[![Latest Stable Version](https://poser.pugx.org/alexz707/invoiceninja-module/v/stable.png)](https://packagist.org/packages/alexz707/invoiceninja-module)
Description
==================

First release can handle the following api services:

* Clients
* Invoices
* Products


## Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```sh
php composer.phar require alexz707/invoiceninja-module
```
### Configure module
* Copy /vendor/alexz707/invoiceninja-module/config/invoiceninja.config.php.dist into your global autoload folder, remove the dist extension so that Zend Framework picks it up
* If you use your own instance of invoice ninja change the `host url`
* Replace the `token` with your generated invoice ninja token

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


