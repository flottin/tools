<?php
use PHPUnit\Framework\TestCase;

final class IntegrityTest extends TestCase
{

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

        var_dump(Excel\Integrity::getErrors());

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
        $filechecked = Excel\Integrity::parse($datas, $config, $begin, $uniqs, $funct);
        var_dump(Excel\Integrity::getErrors());
        $this->assertEquals(true, $filechecked);
    }
}
