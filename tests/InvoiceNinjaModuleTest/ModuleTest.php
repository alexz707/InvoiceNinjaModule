<?php

namespace InvoiceNinjaModuleTest;

use InvoiceNinjaModule\Service\ClientManager;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $sm = Bootstrap::getServiceManager();
        self::assertInstanceOf(ClientManager::class, $sm->get(ClientManager::class));
    }
}
