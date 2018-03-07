Ë<?php
use PHPUnit\Framework\TestCase;

final class ExcelTest extends TestCase
{
    public function testSetWrongFile()
    {

        $this->expectException(RuntimeException::class);
            Tools\Excel::getDatas('data-wrong.xlsx');
    }

    private static $row = [
            'Column A',
            'Column B',
            '',
            'Column D',
            'Column E',
            'Column F',
            ];

    public function testColumnRight()
    {
        Tools\Tool::add(self::$row);

        $this->assertEquals(
            'Column A',
            Tools\Tool::cell('A')
        );
    }



    public function testColumnWrong()
    {

        Tools\Tool::add(self::$row);

        $this->assertNotEquals(
            'Column A',
            Tools\Tool::cell('B')
        );
    }



    private static  $datas = [
                ['data 1' , 'data 2', 'data 3'],
                ['data 1' , 'data 2', 'data 3'],
                ['data 1' , 'data 2', 'data 3']
            ];

    public function testCheckCol()
    {
        $row = [
            'yesno' , 'no', 'yesn'
        ];
        Tools\Tool::add($row);
        $checked = Tools\Integrity::checkCol('A', 1, "#^(yes|no)$#i", "should be yes or no");

        //var_dump(Excel\Integrity::getErrors());

        $this->assertEquals(true, $checked);
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

        $greet = function($name)
        {
            printf("Bonjour %s\r\n", $name);
        };
        $funct [] = $greet;

        $begin = 0;
        $filechecked = Tools\Integrity::parse(self::$datas, $config, $begin, $uniqs, $funct);
        //var_dump(Tools\Integrity::getErrors());
        $this->assertEquals(true, $filechecked);
    }
}
