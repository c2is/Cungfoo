<?php

namespace Cungfoo\Lib\Twig\Extension;

use \Twig_Extension;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @date 02/08/12
 */
class AssetExtension extends Twig_Extension
{
    private $app;

    function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }


    public function getFunctions()
    {
        return array('asset' => new \Twig_Function_Method($this, 'asset'));
    }

    public function asset($url) {
        return sprintf('%s/%s', $this->app['request']->getBasePath(), $url);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'asset';
    }
}