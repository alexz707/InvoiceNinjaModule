<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use InvoiceNinjaModule\Exception\InvalidParameterException;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use InvoiceNinjaModule\Options\ModuleOptions;
use InvoiceNinjaModule\Module;
use PHPUnit\Framework\TestCase;

class ModuleOptionsTest extends TestCase
{
    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptySettings(): void
    {
        $this->expectException(InvalidParameterException::class);

        new ModuleOptions([], $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptyToken(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => '',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateMissingToken(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptyTokenType(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => '',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateMissingTokenType(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptyTimeout(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => null,
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateNegativeTimeout(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => -1,
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateMissingTimeout(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::HOST_URL => 'https://test.dev',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateEmptyHostUrl(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
            Module::HOST_URL => '',
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreateMissingHostUrl(): void
    {
        $this->expectException(InvalidParameterException::class);

        $settings = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 100,
        ];

        new ModuleOptions($settings, $this->createMock(AuthOptionsInterface::class));
    }

    /**
     * @throws InvalidParameterException
     */
    public function testCreate(): void
    {
        $authOptions = $this->createMock(AuthOptionsInterface::class);
        $settingsArr = [
            Module::TOKEN => 'testtoken',
            Module::TOKEN_TYPE => 'testtokentype',
            Module::API_TIMEOUT => 0,
            Module::HOST_URL => 'https://test.dev',
        ];
        $moduleOptions = new ModuleOptions($settingsArr, $authOptions);
        self::assertInstanceOf(ModuleOptions::class, $moduleOptions);
        self::assertSame($settingsArr[Module::TOKEN], $moduleOptions->getToken());
        self::assertSame($settingsArr[Module::TOKEN_TYPE], $moduleOptions->getTokenType());
        self::assertSame($settingsArr[Module::API_TIMEOUT], $moduleOptions->getTimeout());
        self::assertSame($settingsArr[Module::HOST_URL], $moduleOptions->getHostUrl());
        self::assertSame($authOptions, $moduleOptions->getAuthOptions());
    }
}
