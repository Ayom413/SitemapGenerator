<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit372eea8055b65a7a32fcbb66b46ec39c
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SitemapGenerator\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SitemapGenerator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit372eea8055b65a7a32fcbb66b46ec39c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit372eea8055b65a7a32fcbb66b46ec39c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit372eea8055b65a7a32fcbb66b46ec39c::$classMap;

        }, null, ClassLoader::class);
    }
}