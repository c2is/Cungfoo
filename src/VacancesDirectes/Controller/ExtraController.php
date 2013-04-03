<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\DemandeAnnulation,
    Cungfoo\Form\Type\DemandeAnnulationType;

use VacancesDirectes\Lib\SearchEngine;

use Gregwar\Captcha\CaptchaBuilder;

class ExtraController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $ctl = $app['controllers_factory'];

        $ctl->match('/captcha/{width}/{height}', array($this, 'captcha'))
            ->value('width', 150)
            ->value('height', 40)
            ->bind('extra_captcha')
        ;

        return $ctl;
    }

    function captcha(Application $app, Request $request, $width, $height) {
            $captcha = CaptchaBuilder::create()
                ->setMaxFrontLines(0)
                ->setMaxBehindLines(0)
                ->build($width, $height)
            ;

            ob_start();
            $captcha->output();
            $output = ob_get_contents();
            ob_end_clean();

            $app['session']->set('captcha', $captcha->getPhrase());

            return new Response($output, 200, array('Content-type' => 'image/jpeg'));
    }
}
