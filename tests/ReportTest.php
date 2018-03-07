<?php
use PHPUnit\Framework\TestCase;

use Tools\Error;
use Tools\Errors;

final class ReportTest extends TestCase
{

    public function getErrors()
    {
            $error = new Error();
            $error->col = 'A';
            $error->msg = 'an error message!';
            $error->rowid = 1;
            $error->value = 'the value';
            Errors::add($error);

            $error = new Error();
            $error->col = 'B';
            $error->msg = 'an error message!';
            $error->rowid = 2;
            $error->value = 'the value';
            Errors::add($error);
            return Errors::getErrors();
    }

    public function testGetHeader()
    {
        $errors = self::getErrors();
        $res = Tools\Report::getHeader($errors);
        $this->assertEquals($res{0}, "col");
    }

    public function testGetHeaderEmptyErrors()
    {
        $errors = [];
        $res = Tools\Report::getHeader($errors);
        $this->assertEmpty([]);
    }

    public function testGetBody()
    {
        $errors = self::getErrors();
        $res = Tools\Report::getBody($errors);
    }


}
