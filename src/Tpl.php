<?php
namespace DBDict;

class Tpl
{
    public static $_tpl=null;
    public static function render()
    {
        if (!$_tpl) {
            self::init();
        }
        return call_user_func_array([self::$_tpl, 'render'], func_get_args());
    }
    public static function init()
    {
        $loader = new \Twig_Loader_Filesystem(__dir__.'/../template');
        $twig = new \Twig_Environment($loader, array(
            //'cache' => __dir__.'/../cache',
            'cache' => false,
            'auto_reload' => true,
            'debug' => true,
        ));
        self::$_tpl=$twig;
    }
}
