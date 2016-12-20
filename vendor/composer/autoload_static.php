<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc95f36efefda8a61b50d5016b4eb1db6
{
    public static $files = array (
        'c594688b3441835d5575f3085da4a242' => __DIR__ . '/..' . '/webonyx/graphql-php/src/deprecated.php',
    );

    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GraphQL\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GraphQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/webonyx/graphql-php/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc95f36efefda8a61b50d5016b4eb1db6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc95f36efefda8a61b50d5016b4eb1db6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}