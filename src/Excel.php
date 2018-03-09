<?php
namespace Tools;
use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
class Excel
{
    private static $workbook;
    private static $myWorksheetIndex;
    /**
     *
     * @param string $str
     * @return int
     */
    public static function getDatas($filename):array
    {
        $data                   = [];
         self::$workbook             = SpreadsheetParser::open($filename);
         self::$myWorksheetIndex     = self::$workbook->getWorksheetIndex('myworksheet');
        foreach (self::$workbook->createRowIterator(self::$myWorksheetIndex) as $rowIndex => $values)
        {
            $data[] = $values;
        }
        return $data;
    }
}
