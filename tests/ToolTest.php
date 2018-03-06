Ë<?php
use PHPUnit\Framework\TestCase;

final class ToolTest extends TestCase
{
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
}
