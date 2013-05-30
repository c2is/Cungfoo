<?php

namespace Cungfoo\Lib\Twig\Extension;

use \Twig_Extension;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Guillaume Manen <guillaume.manen@gmail.com>
 * @date 07/02/13
 */
class EsiExtension extends Twig_Extension
{
    private $app;

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }

    public function getFunctions()
    {
        return array('esi' => new \Twig_Function_Method($this, 'esi', array('is_safe' => array('html'))));
    }

    public function esi($path)
    {
        $test = $this->app['twig']->getExtension('silex')->render($this->app['twig'], $path);

        if ($this->app['debug'])
        {
            return $this->app['twig']->getExtension('silex')->render($this->app['twig'], $path);
        }
        else
        {
            return sprintf('<esi:include src="%s" />', $path);
        }
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'esi';
    }
}
