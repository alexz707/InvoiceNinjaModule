<?php

namespace InvoiceNinjaModuleTest\Model;

use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Model\RequestOptions;

class RequestOptionsTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $options = new RequestOptions();
        self::assertInstanceOf(RequestOptionsInterface::class, $options);
        self::assertEquals(0, $options->getPage());
        self::assertEquals(0, $options->getPageSize());
        self::assertEquals('page=0&per_page=0', $options->getQueryString());
    }

    public function testAddQueryParam()
    {
        $options = new RequestOptions();
        self::assertEquals('page=0&per_page=0', $options->getQueryString());
        $options->addQueryParameter('test', 101);
        self::assertEquals('page=0&per_page=0&test=101', $options->getQueryString());
    }
}
