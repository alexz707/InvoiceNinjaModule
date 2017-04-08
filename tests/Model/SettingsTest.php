<?php

namespace InvoiceNinjaModuleTest\Model;

use InvoiceNinjaModule\Model\Settings;
use InvoiceNinjaModule\Module;

class SettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptySettings()
    {
        new Settings([]);
    }

    /**
     * @expectedException \InvoiceNinjaModule\Exception\InvalidParameterException
     */
    public function testCreateEmptyToken()
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
    public function testCreateMissingToken()
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
    public function testCreateEmptyTokenType()
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
    public function testCreateMissingTokenType()
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
    public function testCreateEmptyTimeout()
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
    public function testCreateNegativeTimeout()
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
    public function testCreateMissingTimeout()
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
    public function testCreateEmptyHostUrl()
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
    public function testCreateMissingHostUrl()
    {
        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
        ];

        new Settings($settings);
    }

    public function testCreate()
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
