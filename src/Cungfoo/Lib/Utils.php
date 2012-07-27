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
    }
}