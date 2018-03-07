<?php
namespace AppBundle\Tools;

use MRM\Peugeot\Core\Tools\Timer;
/**
 * Display short summary.
 *
 * Display description.

 */
class Display
{
    private static $msg;

    private static $method;

    private static $start = true;

    public static function add($msg)
    {
        self::$msg .= $msg . "\n";
    }

    /**
     * Summary of addPredicate
     * @param mixed $predicate 
     */
    public static function addPredicate($predicate)
    {
        $msg = '';
        foreach ($predicate as $label => $value)
        {
            $msg .= $label . " : " . $value . " ";
        }
        self::$msg = $msg . "\n";
    }

    /**
     * add a separator ok
     */
    public static function addsep($count = 120)
    {
        self::$msg .= str_repeat('-', $count) . "\n";
    }

    public static function display($display = true)
    {
        echo true === $display ? self::$msg : "";
        self::$msg = '';
    }

    /**
     *
     * @param string $str
     */
    public static function println($str)
    {
         echo $str;
         echo "\n";
    }
    /**
     *
     * @param string $str
     */
    public static function writeback($str)
    {
        echo $str . "\r";
    }
    /**
     *
     * @param string $str
     */
    public static function writeln($str)
    {
        self::println($str);
    }

    public static function sep($i = 80)
    {
        echo str_repeat('-', $i);
        echo "\n";
    }

    public static function start($msg = '')
    {
        //self::sep(120);
        Timer::start();
        echo  $msg. '';
        self::$method = $msg;
    }

    public static function end($end = false)
    {
    	$msg = '';
    	if ($end)
	{
		$msg .= ' => End';
		self::sep();
	}
	
        $msg .= '  - time elapsed : ' . Timer::end();

        self::println($msg);
        //self::sep(120);
    }

    public static function bip($msg = ' => ', $end = false)
    {
        $callers=debug_backtrace();
        $count =0;
        foreach($callers as $call) {
            if (1==$count)
            {
                $msg .=  $call['class'] . '->' . $call['function'];
            Break;
            }
            $count++;
        }

        if (true === self::$start)
        {
            self::$start = false;
            self::start($msg);
        }
        else {
            self::$start = true;
            self::end($end);
        }
    }

    public function errors($errors, $ex = null)
    {
        Display::sep();
        Display::println('Errors');
        Display::sep();

        foreach($this->Integrity->errors as $row => $errors)
        {
            self::error($row, $errors);
        }
        //Display::sep();
        if (!empty($ex))
        {
            self::error($ex->getMessage());
            Display::sep();
        }
    }

    public function error($row, $errors)
    {
        $out = " Row " . str_pad($row, 2) ;
        //Display::sep();
        self::error($out);

        foreach($errors as $error)
        {
            $out = "        ";
            $out .= str_pad($error->msg, 18);
            $out .= ' => column : ' . str_pad($error->col, 3);
            $out .= ' => value : ' . str_pad($error->val, 35);
            Display::println($out);
        }
    }
    public function errorln($str)
    {
        $this->output->writeln('<fg=black;bg=red>'.$str.'</>');
    }

}
