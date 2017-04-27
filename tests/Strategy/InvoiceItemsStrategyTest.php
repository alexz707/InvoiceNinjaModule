<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Strategy;

use InvoiceNinjaModule\Model\Interfaces\InvoiceItemInterface;
use InvoiceNinjaModule\Strategy\InvoiceItemsStrategy;
use PHPUnit\Framework\TestCase;
use Zend\Hydrator\HydratorInterface;

class InvoiceItemsStrategyTest extends TestCase
{
    private $hydratorMock;
    /** @var  InvoiceItemsStrategy */
    private $strategy;


    protected function setUp() :void
    {
        parent::setUp();
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->strategy = new InvoiceItemsStrategy($this->hydratorMock);
    }

    public function testCreate() :void
    {
        self::assertInstanceOf(InvoiceItemsStrategy::class, $this->strategy);
    }

    public function testExtractEmpty() :void
    {
        $testValue = [];

        $result = $this->strategy->extract($testValue);
        self::assertEmpty($result);
        self::assertInternalType('array', $result);
    }

    public function testExtract() :void
    {
        $testValue = [
            $this->createMock(InvoiceItemInterface::class)
        ];

        $result = $this->strategy->extract($testValue);
        self::assertNotEmpty($result);
        self::assertInternalType('array', $result);
    }

    public function testHydrateEmpty() :void
    {
        $testValue = [
        ];

        $result = $this->strategy->hydrate($testValue);
        self::assertEmpty($result);
        self::assertInternalType('array', $result);
    }

    public function testHydrate() :void
    {
        $testValue = [
            [ 'id' => 1]
        ];

        $result = $this->strategy->hydrate($testValue);
        self::assertNotEmpty($result);
        self::assertInternalType('array', $result);
        self::assertInstanceOf(InvoiceItemInterface::class, $result[0]);
    }
}
