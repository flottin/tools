<?php

namespace Tools;

class Text
{
    public static function clean($str)
    {
        return str_replace("'", "", str_replace(" ", "_", trim($str)));
    }

    public static function anchorize($text, $replacement='')
    {
        $text = strtolower($text);
        $text = htmlentities($text, ENT_NOQUOTES, 'utf-8');
        $text = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $text);
        $text = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $text);
        $text = preg_replace('#&[^;]+;#', '', $text);
        $text = str_replace(['\'', '"', ' '], $replacement, $text);

        return $text;
    }

    public static function getStringAsOneLine($string)
    {
        $string = str_replace("\r\n", " ", $string);
        $string = str_replace("\n", " ", $string);
        $string = str_replace("\r", " ", $string);
        $string = str_replace("\t", "", $string);
        $string = preg_replace('#[ ]+#', ' ', $string);

        return $string;
    }

    public static function cutStringRespectingWhitespace($string, $length, $suffix = "...")
    {
        if ($length < strlen($string)) {
            $text = substr($string, 0, $length);
            if (false !== ($length = strrpos($text, ' '))) {
                $text = substr($text, 0, $length);
            }
            $string = $text . $suffix;
        }

        return $string;
    }


    public static function toUrl($text)
    {
        $text = \Pimcore\Tool\Transliteration::toASCII($text);

        $search = ['?', '\'', '"', '/', '-', '+', '.', ',', ';', '(', ')', ' ', '&', 'ä', 'ö', 'ü', 'Ä', 'Ö', 'Ü', 'ß', 'É', 'é', 'È', 'è', 'Ê', 'ê', 'E', 'e', 'Ë', 'ë',
            'À', 'à', 'Á', 'á', 'Å', 'å', 'a', 'Â', 'â', 'Ã', 'ã', 'ª', 'Æ', 'æ', 'C', 'c', 'Ç', 'ç', 'C', 'c', 'Í', 'í', 'Ì', 'ì', 'Î', 'î', 'Ï', 'ï',
            'Ó', 'ó', 'Ò', 'ò', 'Ô', 'ô', 'º', 'Õ', 'õ', 'Œ', 'O', 'o', 'Ø', 'ø', 'Ú', 'ú', 'Ù', 'ù', 'Û', 'û', 'U', 'u', 'U', 'u', 'Š', 'š', 'S', 's',
            'Ž', 'ž', 'Z', 'z', 'Z', 'z', 'L', 'l', 'N', 'n', 'Ñ', 'ñ', '¡', '¿',  'Ÿ', 'ÿ', "_", ":" ];
        $replace = ['', '', '', '', '-', '', '', '-', '-', '', '', '-', '', 'ae', 'oe', 'ue', 'Ae', 'Oe', 'Ue', 'ss', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e',
            'A', 'a', 'A', 'a', 'A', 'a', 'a', 'A', 'a', 'A', 'a', 'a', 'AE', 'ae', 'C', 'c', 'C', 'c', 'C', 'c', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i',
            'O', 'o', 'O', 'o', 'O', 'o', 'o', 'O', 'o', 'OE', 'O', 'o', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'S', 's', 'S', 's',
            'Z', 'z', 'Z', 'z', 'Z', 'z', 'L', 'l', 'N', 'n', 'N', 'n', '', '', 'Y', 'y', "-", "-" ];

        $value = urlencode(str_replace($search, $replace, $text));

        return $value;
    }

    /**
     * Summary of getLastSegment
     * @param mixed $path
     * @return string
     */
    public static function getLastSegment ($path)
    {
        $path = explode('/', $path);
        foreach ($path as $segment)
        {
            if (!empty($segment) )
            {
                $path = $segment;
            }
        }
        return '/' . $path . '/';
    }

    /**
     * Summary of getLastSegments
     * @param mixed $path
     * @return string
     */
    public static function getLastSegments ($path, $max = 2)
    {
        $path = explode('/', $path);
        $lasts = array_reverse ($path);
        $out = "/";
        $count = 0;
        $res = array();
        foreach ($lasts as $last)
        {
            if ($count < $max)
            {
                $res[] = $last;
            }
            $count ++;
        }
        $final = array_reverse ($res);
        $out .= implode('/', $final);

        return $out;
    }


    /**
     * Summary of getLastSegments
     * @param mixed $path
     * @return string
     */
    public static function getFirstSegment ($path)
    {
        $path = explode('/', $path);
        foreach ($path as $segment)
        {
            if (!empty($segment) )
            {
                return '/' . $segment;
            }
        }
        return $path;
    }


    /**
     * Summary of getLastSegments
     * @param mixed $path
     * @return string
     */
    public static function getSegment ($path, $ind)
    {
        $path = explode('/', $path);
        return isset ($path[$ind]) ? $path[$ind] : null;
    }


}
