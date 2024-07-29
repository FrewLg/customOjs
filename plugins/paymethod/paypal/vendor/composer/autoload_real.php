<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita3a2678dbe8f444d68c72ec4e1ba9fec
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

        spl_autoload_register(array('ComposerAutoloaderInita3a2678dbe8f444d68c72ec4e1ba9fec', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita3a2678dbe8f444d68c72ec4e1ba9fec', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita3a2678dbe8f444d68c72ec4e1ba9fec::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInita3a2678dbe8f444d68c72ec4e1ba9fec::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequirea3a2678dbe8f444d68c72ec4e1ba9fec($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequirea3a2678dbe8f444d68c72ec4e1ba9fec($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
