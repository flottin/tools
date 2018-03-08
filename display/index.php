<?php
require '../vendor/autoload.php';
//use
final class ReportTest
{

    private static $header = ['header 1', 'header 2', 'header 3'];

    private static $body = [
            ['row 1', 'ok2', 'ok3'],
            ['row 2', 'un texte avec " " et éèà ok2', 'ok3'],
            ['row 3', 'ok2', 'ok3']
          ];

    public function testGetHtml()
    {
        $res = \Tools\Report::getHtml(self::$header, self::$body);
        echo $res;
    }

    public function testGetCsv()
    {
        $res = \Tools\Report::getCsv(self::$header, self::$body, 'ok', '../var/report/');
        echo $res;
    }
}
$report = new ReportTest();


?>

<style>

    th {
        background-color : blue;
    }

</style>

<?php



$report->testGetHtml();

$report->testGetCsv();