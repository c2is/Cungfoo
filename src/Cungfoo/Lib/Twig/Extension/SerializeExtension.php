<?php

namespace Cungfoo\Lib\Twig\Extension;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @date 02/08/12
 */
class SerializeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'serialize' => new \Twig_Filter_Method($this, 'doSerializeFilter'),
        );
    }

    public function doSerializeFilter($value = array())
    {
        return serialize($value);
    }

    public function getName()
    {
        return 'serialize';
    }
}
