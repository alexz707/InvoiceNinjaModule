<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest;

use InvoiceNinjaModule\Model\Contact;
use InvoiceNinjaModule\Model\Invoice;
use InvoiceNinjaModule\Model\InvoiceItem;
use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\InvoiceManagerInterface;
use InvoiceNinjaModule\Service\InvoiceManager;
use InvoiceNinjaModule\Service\ProductManager;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 */
class ModuleTest extends TestCase
{
    /**
     * @group failed
     */
    public function testCreate() :void
    {
        $sm = Bootstrap::getServiceManager();
        self::assertInstanceOf(ClientManagerInterface::class, $sm->get(ClientManager::class));
        self::assertInstanceOf(InvoiceManagerInterface::class, $sm->get(InvoiceManager::class));
    }
}
