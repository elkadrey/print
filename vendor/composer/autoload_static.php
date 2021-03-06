<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5c91eb5b46c0e3f7d792043c6969bf1
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
            1 => __DIR__ . '/..' . '/mike42/gfx-php/src/Mike42',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5c91eb5b46c0e3f7d792043c6969bf1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5c91eb5b46c0e3f7d792043c6969bf1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
