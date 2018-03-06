Ë<?php
use PHPUnit\Framework\TestCase;

final class ExcelTest extends TestCase
{
    public function testSetWrongFile()
    {
        $this->expectException(RuntimeException::class);
            Excel\Excel::setFile('data-wrong.xlsx');
    }

    public function testSetFile()
    {
        $this->assertEquals(true, Excel\Excel::setFile('data.xlsx'));
    }

    public function testReadFile()
    {
        $datas = Excel\Excel::getDatas();
        $this->assertNotEquals([], $datas);
    }

}
