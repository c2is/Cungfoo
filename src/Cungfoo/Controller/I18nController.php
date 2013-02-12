<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\Yaml\Yaml,
    Symfony\Component\HttpFoundation\Request;

/**
 * 
 */
class I18nController implements ControllerProviderInterface
{
    const LOCALES_PATTERN = '%s/app/config/VacancesDirectes/locales/%s.yml';

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app)
        {
            if ($request->getMethod() == 'POST')
            {
                foreach ($app['config']->get('languages') as $locale => $language)
                {
                    file_put_contents(sprintf(self::LOCALES_PATTERN, $app['config']->get('root_dir'), $locale), Yaml::dump($request->request->get($locale)));
                }

                return $app->redirect($app->path('i18n_admin'));
            }

            $translations = array();
            $keys = array();
            $tabbedKeys = array();
            $langues = array();

            foreach ($app['config']->get('languages') as $locale => $language)
            {
                $translationsLocale = Yaml::parse(sprintf(self::LOCALES_PATTERN, $app['config']->get('root_dir'), $locale));

                $translations[$locale] = $translationsLocale;
                $keys += $translationsLocale;

                $langues[] = $locale;
            }

            $keys = array_keys($keys);
            foreach ($keys as $key)
            {
                $explodedKey = explode('.', $key);
                $tabbedKeys[$explodedKey[0]][] = $key;
            }

            return $app['twig']->render('I18n/list.twig', array(
                'translations' => $translations,
                'tabbedKeys' => $tabbedKeys,
                'langues' => $langues,
            ));
        })
        ->bind('i18n_admin');

        return $controllers;
    }
}
