Ë<?php
use PHPUnit\Framework\TestCase;

final class ExcelTest extends TestCase
{
    // public function testSetWrongFile()
    // {
    //     $this->expectException(RuntimeException::class);
    //         Excel\Excel::setFile('data-wrong.xlsx');
    // }
    //
    // public function testSetFile()
    // {
    //     $this->assertEquals(true, Excel\Excel::setFile('data.xlsx'));
    // }
    //
    // public function testReadFile()
    // {
    //     $datas = Excel\Excel::getDatas();
    //     $this->assertNotEquals([], $datas);
    // }


function testCodeInStyle(){
return true;

}


function testThis(){
    retutn 'this value';
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
        Excel\Tool::add(self::$row);

        $this->assertEquals(
            'Column A',
            Excel\Tool::cell('A')
        );
    }



    public function testColumnWrong()
    {

        Excel\Tool::add(self::$row);

        $this->assertNotEquals(
            'Column A',
            Excel\Tool::cell('B')
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
        Excel\Tool::add($row);
        $checked = Excel\Integrity::checkCol('A', 1, "#^(yes|no)$#i", "should be yes or no");

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
        $filechecked = Excel\Integrity::parse(self::$datas, $config, $begin, $uniqs, $funct);
        //var_dump(Excel\Integrity::getErrors());
        $this->assertEquals(true, $filechecked);
    }
}
