<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit90bbf95869b4e88bf0dc5022e708a458
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit90bbf95869b4e88bf0dc5022e708a458::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit90bbf95869b4e88bf0dc5022e708a458::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit90bbf95869b4e88bf0dc5022e708a458::$classMap;

        }, null, ClassLoader::class);
    }
}
