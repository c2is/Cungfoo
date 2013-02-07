<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

class WidgetController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{name}', function (Request $request, $name) use ($app)
        {
            $maxAge = (int) $request->query->get('maxage', 600);

            $className = '\\VacancesDirectes\\Widget\\' . join('', array_map('ucwords', explode('_', $name))) . 'Widget';
            if (!class_exists($className))
            {
                throw new \Exception('Ta classe n\'existe pas espèce de gros putain de stagiaire de mes couilles');
            }

            $widget = new $className($app);
            if (!$widget instanceof \VacancesDirectes\Widget\AbstractWidget)
            {
                throw new \Exception('Le widget doit implémenter l\'interface \\VacancesDirectes\\Widget\\WidgetInterface');
            }

            return new Response($widget->render(), 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));
        })
        ->bind('widget');

        return $controllers;
    }
}
