<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Strategy;

use InvoiceNinjaModule\Model\Interfaces\InvoiceItemInterface;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Laminas\Hydrator\HydratorInterface;

class InvoiceItemsStrategyTest extends TestCase
{
    private MockObject $hydratorMock;
    private InvoiceItemsStrategy $strategy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->strategy = new InvoiceItemsStrategy($this->hydratorMock);
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(InvoiceItemsStrategy::class, $this->strategy);
    }

    public function testExtractEmpty(): void
    {
        $testValue = [];

        $result = $this->strategy->extract($testValue);
        self::assertEmpty($result);
        self::assertIsArray($result);
    }

    public function testExtract(): void
    {
        $testValue = [
            $this->createMock(InvoiceItemInterface::class)
        ];

        $result = $this->strategy->extract($testValue);
        self::assertNotEmpty($result);
        self::assertIsArray($result);
    }

    public function testHydrateEmpty(): void
    {
        $testValue = [
        ];

        $result = $this->strategy->hydrate($testValue, null);
        self::assertEmpty($result);
        self::assertIsArray($result);
    }

    public function testHydrate(): void
    {
        $testValue = [
            [ 'id' => 1]
        ];

        $result = $this->strategy->hydrate($testValue, null);
        self::assertNotEmpty($result);
        self::assertIsArray($result);
        self::assertInstanceOf(InvoiceItemInterface::class, $result[0]);
    }
}
