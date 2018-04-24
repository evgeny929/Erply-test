<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8ef73f242e3ddcafe56b49f4cb78ce93
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-amqplib/php-amqplib/PhpAmqpLib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8ef73f242e3ddcafe56b49f4cb78ce93::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8ef73f242e3ddcafe56b49f4cb78ce93::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
