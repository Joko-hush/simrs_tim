<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5fcae06dd13af5931fc7ceefb17b9e9b
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

        spl_autoload_register(array('ComposerAutoloaderInit5fcae06dd13af5931fc7ceefb17b9e9b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5fcae06dd13af5931fc7ceefb17b9e9b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5fcae06dd13af5931fc7ceefb17b9e9b::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit5fcae06dd13af5931fc7ceefb17b9e9b::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire5fcae06dd13af5931fc7ceefb17b9e9b($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire5fcae06dd13af5931fc7ceefb17b9e9b($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}