<?php
use PHPUnit\Framework\TestCase;
final class ExcelTest extends TestCase
{
    public function testSetWrongFile()
    {
        $this->expectException(RuntimeException::class);
            Tools\Excel::getDatas('data-wrong.xlsx');
    }
    private static  $datas = [
                ['data 1' , 'data 1', 'data 3'],
                ['data 2' , 'data 2', 'data 3'],
                ['data 1' , 'data 1', 'data 3']
            ];
    public function testCheckCol()
    {
        $row = [
            'yesno' , 'no', 'yesn'
        ];
        Tools\Tool::add($row);
        $checked = Tools\Integrity::checkCol('A', 1, "#^(yes|no)$#i", "should be yes or no");
        //var_dump(Excel\Integrity::getErrors());
        $this->assertEquals(false, $checked);
    }
    public function testParse()
    {
        $config = [
            'A'  => ["col A", "#^(yes|no)$#i", "yes or no"],
            'B'  => ["col B", "#^(yes|no)$#i", "yes or no"],
        ];
        $uniqs = [
            ['A'],
            ['A', 'B'],
         ];

        $valid = function($name)
        {
            $valid = ['data 2'];
            $msg = 'not valid';
            return in_array($name, $valid) ? '' : $msg;
        };

        $valid2 = function($name)
        {
            $valid = ['data 3'];
            $msg = 'not valid2';
            return in_array($name, $valid) ? '' : $msg;
        };

        $funct ['A'][] = $valid;
        $funct ['A'][] = $valid2;
        $funct ['B'][] = $valid2;

        $begin = 0;
        $filechecked = Tools\Integrity::parse(self::$datas, $config, $begin, $uniqs, $funct);
        var_dump(Tools\Integrity::getErrors());
        $this->assertEquals(true, $filechecked);
    }
}
