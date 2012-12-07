<?php

namespace Cungfoo\Lib;

class Utils
{
    public function dummy()
    {
       return 'dummy';
    }

    public function camelize($string)
    {
        return preg_replace_callback(
            '/(^|_|\.)+(.)/',
            function ($match) {
                return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
            },
            $string
        );
    }

    public function underscore($string)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($string, '_', '.')));
    }

    public function getPropelConnexion($filename)
    {
        $propelConf = include($filename);
        $connection = reset($propelConf['datasources'])['connection'];

        list(,$connectionInfo) = explode(':', $connection['dsn']);

        $connectionResults = array();
        foreach (explode(';', $connectionInfo) as $info)
        {
            list($key, $value) = explode("=", $info);
            $connectionResults[$key] = $value;
        }

        $connectionResults['user']     = $connection['user'];
        $connectionResults['password'] = $connection['password'];

        return $connectionResults;
    }

    public function decimalToDms($latitude, $longitude)
    {
        $dms = array();

        if (!is_float($latitude) || !is_float($longitude))
        {
            throw new \Exception("float are required");
        }

        $arrayLat = explode(".", $latitude);
        $arrayLng = explode(".", $longitude);

        $minutesLat = abs(($latitude - $arrayLat[0])) * 60.0;
        $arrayMinutesLat = explode(".", $minutesLat);
        $secondsLat = ($minutesLat - $arrayMinutesLat[0]) * 60.0;

        $minutesLng = abs(($longitude - $arrayLng[0])) * 60.0;
        $arrayMinutesLng = explode(".", $minutesLng);
        $secondsLng = ($minutesLng - $arrayMinutesLng[0]) * 60.0;

        $dms = array(
            "latitude" => array(
                "d" => (int) $arrayLat[0],
                "m" => (int) $arrayMinutesLat[0],
                "s" => (float) round($secondsLat, 3)
            ),
            "longitude" => array(
                "d" => (int) $arrayLng[0],
                "m" => (int) $arrayMinutesLng[0],
                "s" => (float) round($secondsLng, 3)
            )
        );

        return $dms;
    }

    public function slugify($string)
    {
      $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
      $string = trim($string, '-');
      $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
      $string = strtolower($string);
      $string = preg_replace('~[^-\w]+~', '', $string);

      if (empty($string))
      {
        return 'n-a';
      }

      return $string;
    }
}
