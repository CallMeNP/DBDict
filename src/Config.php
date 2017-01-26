<?php
namespace DBDict;

class Config
{
    private static $_config;

    public static function load($ConfigFilePath=__dir__ . '/../config.ini')
    {
        self::$_config=parse_ini_file($ConfigFilePath, true);
    }

    public static function get($section=null, $var=null, $key=null)
    {
        if (!self::$_config) {
            self::load();
        }
        $config=self::$_config;
        if (null !== $section) {
            $config=$config[$section];
            if (null !== $var) {
                $config=$config[$var];
                if (null !== $key) {
                    $config=$config[$key];
                }
            }
        }
        return $config;
    }
}
