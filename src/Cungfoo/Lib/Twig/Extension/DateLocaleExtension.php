<?php

namespace Cungfoo\Lib\Twig\Extension;

class DateLocaleExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'datetime' => new \Twig_Filter_Method($this, 'datetime')
        );
    }

    public function datetime($d, $format = "%B %e, %Y %H:%M")
    {
        if ($d instanceof \DateTime) {
            $d = $d->getTimestamp();
        }

        return strftime($format, $d);
    }

    public function getName()
    {
        return 'Helper';
    }
}