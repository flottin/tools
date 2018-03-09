<?php
namespace Tools;

class Errors
{
    private static $errors;
    public static function add(Error $error):void
    {
        self::$errors [] = $error;
    }
    public static function getErrors():array
    {
        return self::$errors;
    }
}
