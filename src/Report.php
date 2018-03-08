<?php
namespace Tools;

use Tools\Display;

/**
 * Class Report
 */
class Report
{
    private static $reportPath  = "../var/reports/";

    public static function getHeader($errors)
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

    public static function getbody($errors)
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

    public static function getHtml($header, $body)
    {
        if (!empty($header) || !empty($body))
        {
            $res = '<table>';
        }

        if (!empty($header))
        {
            $res .= '<tr>';
            foreach($header as $str)
            {
                $res .= "<th>$str</th>";
            }
            $res .= '</tr>';
        }

        if (!empty($body))
        {
            foreach($body as $row)
            {
                $res .= '<tr>';
                foreach($row as $col)
                {
                    $res .= "<td>$col</td>";
                }
                $res .= '</tr>';
            }
        }
        if (!empty($header) || !empty($body))
        {
            $res .= '</table>';
        }
        return $res;
    }

    public static function getCsv($header, $body, $name, $path)
    {
        self::checkDir($path);
        $name .= '.'.Date('Ymd');
        $filename = realpath($path) . '/' . strtolower($name) . '.csv';
        $fp = fopen($filename , 'w');
        chmod($filename, 0777);

        fputcsv($fp, $header,  ';', '"');

        foreach ($body as $row)
        {
            fputcsv($fp, (array)$row, ';', '"');
        }
        fclose($fp);

        return $filename;
    }



    public static function sendMail($header, $body)
    {
        return '';

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
