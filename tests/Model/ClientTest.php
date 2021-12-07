<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Model;

use InvoiceNinjaModule\Model\Client;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCreate() :void
    {
        $client = new Client();
        self::assertInstanceOf(ClientInterface::class, $client);

        self::assertEquals(0, $client->getLastLogin());
        self::assertEquals(0, $client->getBalance());
        self::assertEquals('', $client->getCountryId());
        self::assertEquals('', $client->getIndustryId());
        self::assertEquals('', $client->getUserId());
        self::assertEquals('', $client->getSizeId());
        self::assertEquals(0, $client->getPaidToDate());

        self::assertEmpty($client->getAddress1());
        self::assertEmpty($client->getAddress2());
        self::assertEmpty($client->getCity());
        self::assertEmpty($client->getState());
        self::assertEmpty($client->getPostalCode());
        self::assertEmpty($client->getPrivateNotes());
        self::assertEmpty($client->getWebsite());
        self::assertEmpty($client->getVatNumber());
        self::assertEmpty($client->getIdNumber());
        self::assertEmpty($client->getName());
        self::assertEmpty($client->getContacts());
        self::assertEmpty($client->getCustomValue1());
        self::assertEmpty($client->getCustomValue2());
        self::assertEmpty($client->getCustomValue3());
        self::assertEmpty($client->getCustomValue4());
    }


    public function testSetters() :void
    {
        $client = new Client();
        self::assertInstanceOf(ClientInterface::class, $client);

        $client->setCustomValue1('test1');
        $client->setCustomValue2('test2');
        $client->setBalance(123.45);
        $client->setCountryId('9');
        $client->setIndustryId('8');
        $client->setUserId('5');
        $client->setSizeId('4');
        $client->setPaidToDate(123.45);
        $client->setAddress1('ad1');
        $client->setAddress2('ad2');
        $client->setCity('city');
        $client->setState('state');
        $client->setPostalCode('postcode');
        $client->setPrivateNotes('note');
        $client->setWebsite('wwww');
        $client->setVatNumber('1234e');
        $client->setIdNumber('1234ee');
        $client->setName('name');
        $client->setContacts([1,2,3]);

        self::assertSame('test1', $client->getCustomValue1());
        self::assertSame('test2', $client->getCustomValue2());
        self::assertEquals(0, $client->getLastLogin());

        self::assertEquals(123.45, $client->getBalance());
        self::assertEquals('9', $client->getCountryId());
        self::assertEquals('8', $client->getIndustryId());
        self::assertEquals('5', $client->getUserId());
        self::assertEquals('4', $client->getSizeId());
        self::assertEquals(123.45, $client->getPaidToDate());

        self::assertSame('ad1', $client->getAddress1());
        self::assertSame('ad2', $client->getAddress2());
        self::assertSame('city', $client->getCity());
        self::assertSame('state', $client->getState());
        self::assertSame('postcode', $client->getPostalCode());
        self::assertSame('note', $client->getPrivateNotes());
        self::assertSame('wwww', $client->getWebsite());
        self::assertSame('1234e', $client->getVatNumber());
        self::assertSame('1234ee', $client->getIdNumber());
        self::assertSame('name', $client->getName());
        self::assertNotEmpty($client->getContacts());
    }
}
