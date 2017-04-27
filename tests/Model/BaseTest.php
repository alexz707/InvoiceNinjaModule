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

        self::assertNull($base->getUpdatedAt());
        self::assertNull($base->getArchivedAt());
        self::assertFalse($base->isDeleted());
        self::assertFalse($base->isOwner());
        self::assertEquals(0, $base->getId());
        self::assertEmpty($base->getAccountKey());
    }
}
