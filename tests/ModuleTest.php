<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest;

use InvoiceNinjaModule\Service\ClientManager;
use InvoiceNinjaModule\Service\Interfaces\ClientManagerInterface;
use InvoiceNinjaModule\Service\Interfaces\InvoiceManagerInterface;
use InvoiceNinjaModule\Service\InvoiceManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ModuleTest
 */
class ModuleTest extends TestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testCreate(): void
    {
        $sm = Bootstrap::getServiceManager();
        self::assertInstanceOf(ClientManagerInterface::class, $sm->get(ClientManager::class));
        self::assertInstanceOf(InvoiceManagerInterface::class, $sm->get(InvoiceManager::class));
    }
}
