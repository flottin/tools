<?php
namespace Tools;


class Integrity
{
    private static $data;

    private static $config;

    private static $rowid;

    private static $uniqs = [];

    private static $functions = [];

    private static $uniqData = [];

    private static $errors = [];

    /**
    *
    */
    public static function parse( $datas, $config, $begin = 0, $uniqs = [], $functions = []):bool
    {
        $rowid = $begin;
        foreach($datas as $row)
        {
            $rowid ++;
            Tool::add($row);
            self::uniq($rowid);
            self::applyFunction($functions, $rowid);
            self::checkRow($config, $rowid);
        }
        return true;
    }

    /**
    * set error column row not unique
    */
    public static function applyFunction($functions, $rowid):void
    {
        foreach ($functions as $col => $funct)
        {
            $value = Tool::cell($col);
            $check = $funct($value);
            if (true === $check)
            {
                //set error
                $error              = new Error();
                $error->col         = $col;
                $error->rowid       = $rowid;
                $error->msg         = 'not uniq';
                $error->value       = $value;
                self::$errors[]     = $error;
            }
        }
    }

    /**
    * set error column row not unique
    */
    public static function uniq($rowid):void
    {
        foreach(self::$uniqs as $uniq)
        {
            $key = implode('_', $uniq);
            if (in_array(self::$uniqData[$key], Tool::cell($col)))
            {

                $error              = new Error();
                $error->col         = $col;
                $error->rowid       = $rowid;
                $error->msg         = 'not uniq';
                $error->value       = $key;
                self::$errors[]     = $error;
            }
            self::$uniqData[$key] = Tool::cell($col);

        }
    }

    /**
    *
    */
    public static function checkRow($config, $rowid):void
    {
        foreach ($config as $col => $rule)
        {
            self::checkCol($col, $rowid, $rule{1}, $rule{2});
        }
    }


    /**
    *
    */
    public static function checkCol($col, $rowid, $reg, $msg )
    {
        $value  = Tool::cell($col);

        if ( 0 === preg_match( $reg, $value  ))
        {
            $error              = new Error();
            $error->col         = $col;
            $error->rowid       = $rowid;
            $error->msg         = $msg;
            $error->value       = $value;
            self::$errors[]     = $error;
        }

    }

    public static function getErrors()
    {
        return self::$errors;
    }
}

class Error
{
    public $col;

    public $rowid;

    public $value;

    public $msg;

}
