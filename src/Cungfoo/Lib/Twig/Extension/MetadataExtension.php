<?php

namespace Cungfoo\Lib\Twig\Extension;

use \Twig_Extension;

use Cungfoo\Model\MetadataPeer;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @date 02/08/12
 */
class MetadataExtension extends Twig_Extension
{
    private $app;

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }

    public function getFunctions()
    {
        return array('metadata' => new \Twig_Function_Method($this, 'metadata'));
    }

    public function metadata($name, $value = null)
    {
        return MetadataPeer::get($name, $value);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'metadata';
    }
}
