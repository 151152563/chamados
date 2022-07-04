<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2c28ce3c87fd942a7892518bb061033e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit2c28ce3c87fd942a7892518bb061033e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2c28ce3c87fd942a7892518bb061033e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit2c28ce3c87fd942a7892518bb061033e::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}