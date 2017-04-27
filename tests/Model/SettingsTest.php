<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Model;

use InvoiceNinjaModule\Model\Settings;
use InvoiceNinjaModule\Module;
use PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptySettings() :void
    {
        new Settings([]);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyToken() :void
    {
        $settings = [
            Module::TOKEN => '',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateMissingToken() :void
    {
        $settings = [
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyTokenType() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => '',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateMissingTokenType() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyTimeout() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => null,
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateNegativeTimeout() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => -1,
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateMissingTimeout() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::HOST_URL => 'http://test.dev',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyHostUrl() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => '',
        ];

        new Settings($settings);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateMissingHostUrl() :void
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
        ];

        new Settings($settings);
    }

    public function testCreate() :void
    {
        $settingsArr = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 0,
            Module::HOST_URL => 'http://test.dev',
        ];
        $settings = new Settings($settingsArr);
        self::assertInstanceOf(Settings::class, $settings);
        self::assertSame($settingsArr[Module::TOKEN], $settings->getToken());
        self::assertSame($settingsArr[Module::TOKEN_TYPE], $settings->getTokenType());
        self::assertSame($settingsArr[Module::API_TIMEOUT], $settings->getTimeout());
        self::assertSame($settingsArr[Module::HOST_URL], $settings->getHostUrl());
    }
}
