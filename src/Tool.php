<?php
namespace Tools;
class Tool
{
    public static $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private static $row = array();
    public static function add($row)
    {
        self::$row = $row ;
    }
    public static function cell($s)
    {
        $id = self::id($s);
        if (empty(self::$row))
        {
            //throw new \Exception('excel row is empty');
        }
        if(isset(self::$row{$id}))
        {
            return self::$row{$id};
        }
        else
        {
            return null;
        }
    }
    /**
     *
     * @param int $i
     * @return string
     */
    public static function columnName($i)
    {
        if ($i < 27)
        {
            return self::$letters{$i};
        }
        else
        {
            $k      = floor($i / 26);
            $j      = $i - $k * 26;
            $first  = $k - 1;
            $out    = self::$letters{(int)$first};
            $out    .= self::$letters{(int)$j};
            return $out;
        }
    }
    /**
     *
     * @param string $str
     * @return int
     */
    public static function id($columnName)
    {
        $fletter = $columnName{0};
        if (strlen($columnName)==1)
        {
            return strpos( self::$letters, $fletter);
        }
        else
        {
            $fpos =  strpos( self::$letters, $fletter);
            $first = ($fpos + 1) * 26;
            $sletter = $columnName{1};
            $spos =  strpos( self::$letters, $sletter);
            $second = $spos;
            return  $first + $second;
        }
    }
}
