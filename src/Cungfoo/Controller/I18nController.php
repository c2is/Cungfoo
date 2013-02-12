<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\Yaml\Yaml;
/**
 * 
 */
class I18nController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($app)
        {
            $translations = array();
            $keys = array();

            foreach ($app['config']->get('languages') as $locale => $language)
            {
                $yaml = sprintf('%s/app/config/VacancesDirectes/locales/%s.yml', $app['config']->get('root_dir'), $locale);
                $translationsLocale = Yaml::parse($yaml);
                $translations[] = $translationsLocale;
                $keys += $translationsLocale;
            }

            $keys = array_keys($keys);
var_dump($keys);die;
            return $app['twig']->render('I18n/list.twig', array(
                'translations' => $translations,
                'keys' => $keys,
            ));
        })
        ->bind('i18n_admin');

        return $controllers;
    }
}
