<?php

namespace Cungfoo;

use Silex\Application as BaseApplication;

use Symfony\Component\HttpFoundation\Response;

class Application extends BaseApplication
{
    use \Silex\Application\TranslationTrait;
    use \Silex\Application\TwigTrait;
    use \Silex\Application\UrlGeneratorTrait;
    use \Silex\Application\MonologTrait;
    use \Silex\Application\SecurityTrait;
    use \Silex\Route\SecurityTrait;

    public function renderView($view, array $parameters = array())
    {
        $response = $this['twig']->render($view, $parameters);

        return new Response($response, 200, array('Surrogate-Control' => 'content="ESI/1.0"', 'Cache-Control' => 'max-age=600, s-maxage=600, public'));
    }
}
