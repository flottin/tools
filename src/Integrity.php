<?php
namespace Tools;


class Integrity
{
    private static $data;

    private static $config;

    private static $rowid;

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
            self::uniq($uniqs, $rowid);
            self::applyFunction($functions, $rowid);
            self::checkRow($config, $rowid);
        }

        var_dump(self::$uniqData);
        return true;
    }

    /**
    * set error column row not unique
    */
    public static function applyFunction($functions, $rowid):void
    {
        foreach ($functions as $col => $functs)
        {
            $value = Tool::cell($col);
            foreach ($functs as $funct)
            {
                $check = $funct($value);
                if (!empty($check))
                {
                    //set error
                    $error              = new Error();
                    $error->col         = $col;
                    $error->rowid       = $rowid;
                    $error->msg         = $check;
                    $error->value       = $value;
                    self::$errors[]     = $error;
                }
            }
        }
    }

    /**
    * set error column row not unique
    */
    public static function uniq($uniqs, $rowid):void
    {

        foreach($uniqs as $uniq)
        {
            $key = implode('_', $uniq);
            $val = '';
            foreach ($uniq as $col)
            {
                $val .= Tool::cell($col);

            }


            if (!isset(self::$uniqData[$key]))
            {
                self::$uniqData[$key][] = $val;
                continue;
            }
            if (in_array($val, self::$uniqData[$key]))
            {

                $error              = new Error();
                $error->col         = $key;
                $error->rowid       = $rowid;
                $error->msg         = 'not uniq';
                $error->value       = $key;
                self::$errors[]     = $error;
            }
            self::$uniqData[$key][] = $val;
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
