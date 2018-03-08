<?php
namespace Tools;
/**
* find objects in list of object
* @uses :
* $list = new Search($arr);
* $predicate = ['name' => 'bob', mail => 'test@test.test'];
* $list->find($predicate)
*/
class ObjectsList
{
    private $list = array();

    private $results = array();

    private $begin = true;

    private $count = 0;

    private $countSearch = 0;

    public function __construct($list = array())
    {
        $this->list = $list;
    }

    /**
     *
     * @param mixed $object
     */
    public function add($object)
    {
        $this->list [] = $object;
    }


    /**
     * recursively find objects in a list
     * @param array $search
     * @param mixed $list
     * @return mixed
     */
    public function find( $search = array() , $list = array(), $like = false)
    {
        $result = array();
        if ( !is_array($search) || !is_array($list) )
        {
            return $result;
        }
        $this->count++;
        if (empty($list) && true == $this->begin)
        {
            $this->countSearch=count($search);
            $list = $this->list;
            $this->begin = false;
        }


        if (!empty($search) && !empty($list))
        {
            foreach($search as $index => $value)
            {

                foreach($list as $arrayInf)
                {
                    if (isset($arrayInf->{$index}))
                    {

                        if (true === $like && (!empty($arrayInf->{$index})&& (!empty($value))))
                        {

                            if(false !== strpos(strtolower($arrayInf->{$index}), strtolower($value)) )
                            {
                                $result[] = $arrayInf;
                            }
                        }
                        else
                        {
                            if($arrayInf->{$index} == $value)
                            {
                                $result[] = $arrayInf;
                            }
                        }

                    }
                }
                Break;
            }
            array_shift($search);
            if($this->count === $this->countSearch)
            {
                $this->begin = true;
                $this->count = 0;

                return $result;
            }
            else
            {
                return self::find($search, $result, $like);
            }
        }
        $this->begin = true;
        $this->count = 0;
        return $result;
    }

    /**
     * Find the first element of the search
     * @param mixed $search
     * @return mixed
     */
    public function first( $search, $like = false )
    {
        $result = self::find($search, array(), $like );

        if (isset($result[0]))
        {
            return $result[0];
        }
        else
        {
            return  $result;
        }
    }

    /**
     * Find the first element of the search
     * @param mixed $search
     * @return mixed
     */
    public function firstLike( $search )
    {
        return self::first($search, true);
    }

    /**
     * Find the first element of the search
     * @param mixed $search
     * @return mixed
     */
    public function findLike( $search )
    {
        return self::find($search, array(), true);
    }

    /**
     * get the whole list
     * @return array
     */
    public function get()
    {
        return $this->list;
    }

    /**
     * get the whole list
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }
}
