<?php
declare(strict_types=1);

namespace InvoiceNinjaModuleTest\Options;

use Interop\Container\ContainerInterface;
use InvoiceNinjaModule\Options\AuthOptionsFactory;
use InvoiceNinjaModule\Options\Interfaces\AuthOptionsInterface;
use PHPUnit\Framework\TestCase;

class AuthOptionsFactoryTest extends TestCase
{
    public function testCreate() :void
    {
        $config = [
            'invoiceninja' => []
        ];
        $containerMock = $this->createMock(ContainerInterface::class);

        $containerMock->expects(self::once())
            ->method('get')
            ->with(self::stringContains('Config'))
            ->willReturn($config);

        $factory = new AuthOptionsFactory();
        self::assertInstanceOf(AuthOptionsFactory::class, $factory);

        $authOptions = $factory($containerMock, 'test');
        self::assertInstanceOf(AuthOptionsInterface::class, $authOptions);
    }
}
