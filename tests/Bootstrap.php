<?php

declare(strict_types=1);

namespace InvoiceNinjaModuleTest;

use Laminas\Mvc\Service\ServiceManagerConfig;
use Laminas\ServiceManager\ServiceManager;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function dirname;

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    protected static ServiceManager $serviceManager;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function init(): void
    {
        error_reporting(E_ALL);
        chdir(__DIR__);

        /*$zf2ModulePaths = array(dirname(dirname(__DIR__)));
        if ($path = static::findParentPath('vendor')) {
            $zf2ModulePaths[] = $path;
        }
        if (($path = static::findParentPath('module')) !== $zf2ModulePaths[0]) {
            $zf2ModulePaths[] = $path;
        }*/

        static::initAutoloader();

        // use ModuleManager to load this module and it's dependencies
        if (file_exists(__DIR__ . '/TestConfiguration.php')) {
            $configuration = require __DIR__ . '/TestConfiguration.php';
        } else {
            $configuration = require __DIR__ . '/TestConfiguration.php.dist';
        }

        // Prepare the service manager
        $smConfig = $configuration['service_manager'] ?? [];
        $smConfig = new ServiceManagerConfig($smConfig);

        $serviceManager = new ServiceManager();
        $smConfig->configureServiceManager($serviceManager);
        $serviceManager->setService('ApplicationConfig', $configuration);

        // Load modules
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
    }

    /**
     * @return ServiceManager
     */
    public static function getServiceManager(): ServiceManager
    {
        return static::$serviceManager;
    }

    protected static function initAutoloader(): void
    {
        $vendorPath = static::findParentPath('vendor');

        if (file_exists($vendorPath . '/autoload.php')) {
            include $vendorPath . '/autoload.php';
        }
    }

    protected static function findParentPath(string $path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }
}
