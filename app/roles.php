<?php


namespace App;
class Roles
{
    private static $roles = [1 => "Klientas", 2 => 'Operatorius', 3 => 'Administratorius'];

    public static function getName($index)
    {
        if (array_key_exists($index, self::$roles)) {
            return self::$roles[$index];
        } else {
            return null;
        }
    }
}
