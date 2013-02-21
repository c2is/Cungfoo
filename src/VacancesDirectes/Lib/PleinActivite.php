<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Lib\Utils;

class PleinActivite
{
    protected $app;
    protected $request;

    public function __construct(Application $app)
    {
        $this->app     = $app;
    }

    public function process()
    {

        $locale = $this->app['context']->get('language');

        $utils = new Utils();

        $pleinActivitesConfigFile = sprintf('%s/VacancesDirectes/plein_activites.yml', $this->app['config']->get('config_dir'));
        $pleinActivites = \Symfony\Component\Yaml\Yaml::parse($pleinActivitesConfigFile)['plein_activites'];

        foreach($pleinActivites as $activites)
        {
            foreach ($activites['items'] as $item)
            {
                $arrayActivites[$item['type']][] = $item;
            }
        }

        foreach($arrayActivites as $key => $type)
        {
            $classQuery = sprintf("\Cungfoo\Model\%sQuery", $utils->camelize($key));

            foreach($type as $activite)
            {
                $objectActivites[] = $classQuery::create()
                    ->joinWithI18n($locale)
                    ->filterByCode($activite['code'])
                    ->findOne()
                ;
            }
        }

        $pleinActiviteFinal = array();

        foreach($pleinActivites as $activites)
        {
            $nameCategorie = $activites['title'];
            foreach ($activites['items'] as $item)
            {
                foreach($objectActivites as $objet)
                {
                    if($objet && $item['code'] == $objet->getCode())
                    {
                        $pleinActiviteFinal[$nameCategorie][] = $objet;
                        break;
                    }
                }
            }
        }

        return $pleinActiviteFinal;

    }
}
