<?php
namespace Tools;

use Tools\Display;

/**
 * Class Report
 */
class Report
{
    private static $reportPath  = "../var/reports/";

    public static function getHeader($errors):array
    {
        $header = [];
        foreach ($errors as $rowErrors)
        {
            foreach($rowErrors as $k => $err)
            {
                $header[] = $k;
            }
            return $header;
        }
        return $header;
    }

    public static function getbody($errors):array
    {
        $body = [];
        foreach ($errors as $rowErrors) {
            foreach ($rowErrors as $error)
            {
                $body [] = (array)$error;
            }
        }
        return $body;
    }

    public static function getHtml($header, $body):string
    {
        return '';
    }

    public static function getCsv($header, $body):string
    {

    }

    public static function sendMail($header, $body):string
    {

    }



    public static function csv($errors, $importName = 'report' )
    {
        if (empty($errors))
        {
            return false;
        }

        self::checkDir(self::$reportPath);
        $importName .= '.'.Date('Ymd');
        self::$filename = self::$reportPath . strtolower($importName) . '.csv';
        $fp = fopen(self::$filename , 'w');
        chmod(self::$filename, 0777);
        $header = [];
        foreach ($errors as $rowErrors) {
            foreach ($rowErrors as $error)
            {
                foreach($error as $k => $err)
                {
                    $header[] = $k;
                }
                Break 2;
            }
        }
        fputcsv($fp, $header,  ';', '"');

        foreach ($errors as $rowErrors) {
            foreach ($rowErrors as $error)
            {
                fputcsv($fp, (array)$error, ';', '"');
            }
        }
        fclose($fp);

        self::displayPath();
        return true;
    }

    public static function displayPath()
    {
        Display::sep(120);
        Display::println('Find Integrity report at : ' . realpath ( self::$filename ));
        Display::sep(120);
    }

    public static function bash($errors, $importName = 'report', $reportPath = 'reports' )
    {

    }

    public static function mail($errors, $importName = 'report', $reportPath = 'reports' )
    {

    }

    public static function clean($badstring)
    {
        $pattern = Array("é", "è", "ê", "ç", "à", "à", "î", "ï", "ù", "û");
        $rep_pat = Array("e", "e", "e", "c", "a", "a", "i", "i", "u", "o");
        $cleaned= str_replace($pattern, $rep_pat, $badstring);
        $file_bad = array("@-@", "@_@", "@[^A-Za-z0-9_ ]@", "@ +@");
        $file_good = array(" ", " ", "", " ");
        $cleaned= preg_replace($file_bad, $file_good, $cleaned);
        $cleaned= str_replace(" ", "_", trim($cleaned));

        return $cleaned;
    }

    public static function checkDir($dirname)
    {
        if (!is_dir($dirname)) {
            mkdir($dirname, 0777, true);
        }
    }


}
