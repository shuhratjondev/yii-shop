<?php

namespace common\entities;
/**
 * User: sh_abdurasulov
 */
trait InstantiateTrait
{
    private static $_prototype;

    public static function instantiate($row)
    {
        if (self::$_prototype === null) {
            $class = get_called_class();
            self::$_prototype = unserialize(sprintf('0:%d:"%s":0:{}', strlen($class), $class));
            //self::$_prototype = unserialize(sprintf('0:%d:"%s":0:{}', strlen($class), $class));
        }
        echo "<pre>";
        var_dump(self::$_prototype);
        echo "</pre>";
        die();

        $entity = clone self::$_prototype;
        $entity->init();
        return $entity;
    }

}