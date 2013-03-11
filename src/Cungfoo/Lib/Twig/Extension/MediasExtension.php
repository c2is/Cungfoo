<?php

namespace Cungfoo\Lib\Twig\Extension;

use Cungfoo\Model\PortfolioMediaQuery;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @date 02/08/12
 */
class MediasExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'medias' => new \Twig_Filter_Method($this, 'doMediasFilter'),
        );
    }

    public function doMediasFilter($value = null)
    {
        if ($value === null) {
            return array();
        }

        $value = explode(';', $value);

        return PortfolioMediaQuery::create()
            ->filterById($value)
            ->usePortfolioUsageQuery()
                ->orderByRank()
            ->endUse()
            ->find()
        ;
    }

    public function getName()
    {
        return 'medias';
    }
}
