<?php
namespace Tools;

abstract class Mailer
{
    public $subject;

    public $from;

    public $nameFrom;

    public $to;

    public $nameTo;

    public $content;

    public $category;

    public $apikey = '';

    public $contentType = 'html'; // plain

    public $filename;

    abstract public function send();

}
