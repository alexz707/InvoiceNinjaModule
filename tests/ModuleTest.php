<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest;

use InvoiceNinjaModule\Model\Contact;
use InvoiceNinjaModule\Model\Invoice;
use InvoiceNinjaModule\Model\InvoiceItem;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\InvoiceManager;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 */
class ModuleTest extends TestCase
{
    public function testCreate() :void
    {
        $sm = Bootstrap::getServiceManager();
        self::assertInstanceOf(ClientManager::class, $sm->get(ClientManager::class));
    }
}
