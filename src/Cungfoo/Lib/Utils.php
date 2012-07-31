<?php

namespace Cungfoo\Lib;

class Utils
{
    public function dummy()
    {
       return 'dummy';
    }

    public static function camelize($word)
    {
        return lcfirst(str_replace(" ", "", ucwords(strtr($word, "_-", "  "))));
        //return preg_replace_callback('/(^|_|\.)+(.)/', function ($match) { return ('.' === $match[1] ? '_' : '').strtoupper($match[2]); }, $string);
    }

    public function underscore($string)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($string, '_', '.')));
    }
}