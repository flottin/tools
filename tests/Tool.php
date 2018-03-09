<?php
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
        Tools\Tool::add(self::$row);
        $this->assertEquals('Column A', Tools\Tool::cell('A'));
    }
    public function testColumnWrong()
    {
        Tools\Tool::add(self::$row);
        $this->assertNotEquals('Column A', Tools\Tool::cell('B'));
    }
}
