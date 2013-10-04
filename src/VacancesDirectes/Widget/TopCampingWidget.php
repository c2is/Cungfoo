<?php

namespace VacancesDirectes\Widget;

use \Criteria;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\TopCampingQuery,
    Cungfoo\Widget\AbstractWidget;

class TopCampingWidget extends AbstractWidget
{
    public function getName()
    {
        return 'top_camping';
    }

    public function render()
    {
		$offset = (int) $this->app['request']->query->get('offset');
        $limit = (int) $this->app['request']->query->get('limit');
		$divId = (int) $this->app['request']->query->get('div_id');

        $locale = $this->app['context']->get('language');

        $topCampings = \Cungfoo\Model\TopCampingQuery::create()
            ->addAscendingOrderByColumn('sortable_rank')
            ->useEtablissementQuery()
                ->useI18nQuery($locale)
                    ->filterByActiveLocale(true)
                ->endUse()
                ->filterByActive(true)
            ->endUse()
			->limit($limit)
			->offset($offset)
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\top_camping.twig', array(
            'topCampings' => $topCampings,
			'div_id' => $divId
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }
}
