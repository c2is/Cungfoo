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

    public function doMediaFilter($id, $value = null)
    {
        $id = explode(';', $id);

        return PortfolioMediaQuery::create()
            ->_if($value)
                ->select($value)
            ->_endif()
            ->filterById($id)
            ->usePortfolioUsageQuery()
                ->orderByRank()
            ->endUse()
            ->findOne()
        ;
    }

    public function getName()
    {
        return 'media';
    }
}
