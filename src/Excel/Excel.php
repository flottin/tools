<?php
namespace Excel;

use Akeneo\Component\SpreadsheetParser;

class Excel
{
    private static $workbook;

    private static $myWorksheetIndex;
    /**
    *
    */
    public static function setFile($filename):bool
    {

        self::$workbook = SpreadsheetParser::open($filename);
        self::$myWorksheetIndex = self::$workbook->getWorksheetIndex('myworksheet');
        return true;
    }

    /**
     *
     * @param string $str
     * @return int
     */
    public static function getDatas():array
    {
        $data = [];
        foreach (self::$workbook->createRowIterator(self::$myWorksheetIndex) as $rowIndex => $values)
        {
            $data[] = $values;
            //var_dump($rowIndex, $values);
        //    var_dump($rowIndex);
        }
        return $data;
    }


}
