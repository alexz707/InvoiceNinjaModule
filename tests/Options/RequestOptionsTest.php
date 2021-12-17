<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;
use InvoiceNinjaModule\Options\RequestOptions;
use PHPUnit\Framework\TestCase;

class RequestOptionsTest extends TestCase
{
    public function testCreate(): void
    {
        $options = new RequestOptions();
        self::assertInstanceOf(RequestOptionsInterface::class, $options);
        self::assertEmpty($options->getPostArray());
        self::assertEmpty($options->getQueryArray());
    }

    public function testAddParams(): void
    {
        $options = new RequestOptions();
        self::assertEmpty($options->getPostArray());
        self::assertEmpty($options->getQueryArray());
        $options->addQueryParameters(['test1' => 101]);
        $options->setPage(10);
        $options->setPageSize(99);
        $options->setClientId(222);
        $options->setUpdated(222222);
        $options->setInclude('sss,sss');
        $options->addPostParameters(['test2' => 102]);

        $expected =  [
            'test1' => 101,
            'page' => 10,
            'per_page' => 99,
            'client_id' => 222,
            'updated_at' => 222222,
            'include' => 'sss,sss'
        ];

        self::assertEquals($expected, $options->getQueryArray());
        self::assertEquals(['test2' => 102], $options->getPostArray());
    }
}
