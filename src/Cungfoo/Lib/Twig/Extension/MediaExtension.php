<?php

namespace Cungfoo\Lib\Twig\Extension;

use Cungfoo\Model\PortfolioMediaQuery;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @date 02/08/12
 */
class MediaExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'media' => new \Twig_Filter_Method($this, 'doMediaFilter'),
        );
    }

    public function doMediaFilter($value = null)
    {
        return PortfolioMediaQuery::create()
            ->select('file')
            ->filterById($value)
            ->findOne()
        ;
    }

    public function getName()
    {
        return 'media';
    }
}
