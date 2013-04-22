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

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }

    public function getFunctions()
    {
        return array('asset' => new \Twig_Function_Method($this, 'asset'));
    }

    public function asset($url)
    {
        $basePath = $this->app['config']->settings['assets_base_url'];

        if (!$basePath) {
            $basePath = $this->app['request']->getBasePath();
        }

        return sprintf('%s/%s', rtrim($basePath, '/'), ltrim($url, '/'));
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
