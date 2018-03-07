<?php
use PHPUnit\Framework\TestCase;

final class ObjectsListTest extends TestCase
{
    private $listPersons;

    public function testObjectsFindEmpty()
    {
        self::getPersons();
        $list = new  Tools\ObjectsList($this->listPersons);
        $predicate = ['name' => 'john'];
        $res = $list->find($predicate);
        $this->assertEquals(
            [],
            $res

        );
    }

   public function testObjectsFindElements()
   {
        self::getPersons();
        $list = new  Tools\ObjectsList($this->listPersons);
        $predicate = ['name' => 'bob'];
        $res = $list->find($predicate);
        $this->assertEquals(
            2,
            count($res)

        );
    }

   public function testObjectsFirst()
   {
       self::getPersons();
       $list = new  Tools\ObjectsList($this->listPersons);
       $predicate = ['name' => 'bob'];
       $res = $list->first($predicate);

       $this->assertEquals(
           'bob',
           $res->name

       );
   }

   public function testObjectsFindDoublePredicate()
   {
        self::getPersons();
        $list = new  Tools\ObjectsList($this->listPersons);
        $predicate = ['name' => 'bob', 'mail' => 'bob@yopmail.com'];
        $res = $list->find($predicate);
        $this->assertEquals(
            1,
            count($res)

        );
    }

   private function getPersons()
   {
       $this->listPersons [] = new Person('bob', 'bob@gmail.com');
       $this->listPersons [] = new Person('ted', 'ted@gmail.com');
       $this->listPersons [] = new Person('bob', 'bob@yopmail.com');
       $this->listPersons [] = new Person('ted', 'ted@yopmail.com');
       $this->listPersons [] = new Person('ted', 'ted@ted.com');
       $this->listPersons [] = new Person('ted', 'ted@ted.com');
   }

}

class Person {
    public $name;
    public $mail;
    public function __construct($name, $mail)
    {
        $this->name = $name;
        $this->mail = $mail;
    }
}
