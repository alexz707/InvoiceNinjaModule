<?php

namespace InvoiceNinjaModuleTest\Model;

use InvoiceNinjaModule\Model\Client;
use InvoiceNinjaModule\Model\Interfaces\ClientInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate() :void
    {
        $client = new Client();
        self::assertInstanceOf(ClientInterface::class, $client);

        self::assertNull($client->getCustomValue1());
        self::assertNull($client->getCustomValue2());
        self::assertNull($client->getLastLogin());

        self::assertEquals(0, $client->getBalance());
        self::assertEquals(0, $client->getCountryId());
        self::assertEquals(0, $client->getIndustryId());
        self::assertEquals(0, $client->getLanguageId());
        self::assertEquals(0, $client->getPaymentTerms());
        self::assertEquals(0, $client->getUserId());
        self::assertEquals(0, $client->getSizeId());
        self::assertEquals(0, $client->getCurrencyId());
        self::assertEquals(0, $client->getPaidToDate());

        self::assertEmpty($client->getAddress1());
        self::assertEmpty($client->getAddress2());
        self::assertEmpty($client->getCity());
        self::assertEmpty($client->getState());
        self::assertEmpty($client->getPostalCode());
        self::assertEmpty($client->getWorkPhone());
        self::assertEmpty($client->getPrivateNotes());
        self::assertEmpty($client->getWebsite());
        self::assertEmpty($client->getVatNumber());
        self::assertEmpty($client->getIdNumber());
        self::assertEmpty($client->getName());
    }
}
