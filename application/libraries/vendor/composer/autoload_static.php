<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitde3a789ae830dd958dca26d2184e3e75
{
    public static $files = array (
        '74ed299072414d276bb7568fe71d5b0c' => __DIR__ . '/..' . '/tinify/tinify/lib/Tinify.php',
        '9635627915aaea7a98d6d14d04ca5b56' => __DIR__ . '/..' . '/tinify/tinify/lib/Tinify/Exception.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tinify\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tinify\\' => 
        array (
            0 => __DIR__ . '/..' . '/tinify/tinify/lib/Tinify',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitde3a789ae830dd958dca26d2184e3e75::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitde3a789ae830dd958dca26d2184e3e75::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitde3a789ae830dd958dca26d2184e3e75::$classMap;

        }, null, ClassLoader::class);
    }
}
