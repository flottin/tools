<?php
namespace Tools;
/**
 * Display short summary.
 *
 * Display description.
 */

class Timer
{
    private static $datetime1 = null;

    private static $datetime2;

    private static $start = true;
    /**
     * Calculate a precise time difference.
     * @param string $start result of microtime()
     * @param string $end result of microtime(); if NULL/FALSE/0/'' then it's now
     * @return flat difference in seconds, calculated with minimum precision loss
     */
    private static function microtime_diff($start, $end = null)
    {
        if (!$end) {
            $end = microtime();
        }
        list($start_usec, $start_sec) = explode(" ", $start);
        list($end_usec, $end_sec) = explode(" ", $end);
        $diff_sec = intval($end_sec) - intval($start_sec);
        $diff_usec = floatval($end_usec) - floatval($start_usec);
        return floatval($diff_sec) + $diff_usec;
    }

    public static function start()
    {
        self::$datetime1 = microtime ();
        return '';
    }
    public static function end()
    {
        if (!empty(self::$datetime1))
        {
            return self::microtime_diff(self::$datetime1);
           }
        else {
            return '';
        }

    }

    public static function bip($msg = '')
    {
        $callers=debug_backtrace();
        $count =0;
        foreach($callers as $call) {
            if (1==$count)
            {
                $msg =  $call['class'] . '->' . $call['function'];
                Break;
            }
            $count++;
        }

        if (true === self::$start)
        {
            self::$start = false;
            return self::start();
        }
        else {
            self::$start = true;
            return self::end();
        }
    }
}
