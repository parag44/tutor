<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7af379296cec29d2ddd4786ad967ae1f
{
    public static $files = array (
        'f38fc64d53a11ff2d75290ba3078b97a' => __DIR__ . '/../..' . '/src/Helpers/general-functions.php',
        '6d0d2077468df9576316f2a5fa1d8686' => __DIR__ . '/../..' . '/src/Helpers/template-functions.php',
        '410cb46b02b6af638ee5cbaae7654c04' => __DIR__ . '/../..' . '/src/Includes/tutor-template-hook.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tutor\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tutor\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7af379296cec29d2ddd4786ad967ae1f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7af379296cec29d2ddd4786ad967ae1f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7af379296cec29d2ddd4786ad967ae1f::$classMap;

        }, null, ClassLoader::class);
    }
}
