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

        $mediaString = PortfolioMediaQuery::create()
            ->_if($value)
                ->select($value)
            ->_endif()
            ->filterById($id)
            ->usePortfolioUsageQuery()
                ->orderByRank()
            ->endUse()
            ->findOne()
        ;

        if (!is_null($value) && is_null($mediaString)) {
            $mediaString = 'images/vacancesdirectes/common/images/search-default.jpg';
        }

        return $mediaString;
    }

    public function getName()
    {
        return 'media';
    }
}
