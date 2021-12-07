<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Model;

use InvoiceNinjaModule\Model\Base;
use InvoiceNinjaModule\Model\Interfaces\BaseInterface;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public function testCreate() :void
    {
        $base = new Base();
        self::assertInstanceOf(BaseInterface::class, $base);

        self::assertFalse($base->isDeleted());
        self::assertEquals('', $base->getId());
        self::assertEquals(0, $base->getUpdatedAt());
        self::assertEquals(0, $base->getCreatedAt());
        self::assertEquals(0, $base->getArchivedAt());
    }
}
