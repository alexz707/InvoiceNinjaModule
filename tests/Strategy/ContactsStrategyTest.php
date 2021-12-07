<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Strategy;

use InvoiceNinjaModule\Model\Interfaces\ContactInterface;
use InvoiceNinjaModule\Strategy\ContactsStrategy;
use PHPUnit\Framework\TestCase;
use Laminas\Hydrator\HydratorInterface;

class ContactsStrategyTest extends TestCase
{
    private $hydratorMock;
    /** @var  ContactsStrategy */
    private $strategy;


    protected function setUp() :void
    {
        parent::setUp();
        $this->hydratorMock = $this->createMock(HydratorInterface::class);
        $this->strategy = new ContactsStrategy($this->hydratorMock);
    }

    public function testCreate() :void
    {
        self::assertInstanceOf(ContactsStrategy::class, $this->strategy);
    }

    public function testExtractEmpty() :void
    {
        $testValue = [];

        $result = $this->strategy->extract($testValue);
        self::assertEmpty($result);
        self::assertIsArray($result);
    }

    public function testExtract() :void
    {
        $testValue = [
            $this->createMock(ContactInterface::class)
        ];

        $result = $this->strategy->extract($testValue);
        self::assertNotEmpty($result);
        self::assertIsArray($result);
    }

    public function testHydrateEmpty() :void
    {
        $testValue = [
        ];

        $result = $this->strategy->hydrate($testValue, null);
        self::assertEmpty($result);
        self::assertIsArray($result);
    }

    public function testHydrate() :void
    {
        $testValue = [
            [ 'id' => 1]
        ];

        $result = $this->strategy->hydrate($testValue, null);
        self::assertNotEmpty($result);
        self::assertIsArray($result);
        self::assertInstanceOf(ContactInterface::class, $result[0]);
    }
}
