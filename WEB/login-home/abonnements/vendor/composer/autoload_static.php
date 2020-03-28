<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit886cbcf7bc22aadaf40f6fd2c88ac130
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit886cbcf7bc22aadaf40f6fd2c88ac130::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit886cbcf7bc22aadaf40f6fd2c88ac130::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}