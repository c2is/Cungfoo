<?php

namespace Cungfoo\Controller;

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
            $className = '\\VacancesDirectes\\Widget\\' . join('', array_map('ucwords', explode('_', $name))) . 'Widget';
            if (!class_exists($className))
            {
                throw new \Exception(sprintf('Failed to guess the class of widget \'%s\'', $name));
            }

            $widget = new $className($app);
            if (!$widget instanceof \Cungfoo\Widget\AbstractWidget)
            {
                throw new \Exception(sprintf('Widget %s must extend the \\Cungfoo\\Widget\\AbstractWidget class', $name));
            }

            $maxAge = (int) $request->query->get('maxage', $widget->getMaxAge());

            return new Response($widget->render(), 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $maxAge)));
        })
        ->bind('widget');

        return $controllers;
    }
}
