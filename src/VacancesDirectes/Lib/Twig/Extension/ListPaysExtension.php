<?php

namespace VacancesDirectes\Lib\Twig\Extension;

use \Twig_Extension;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @date 02/08/12
 */
class ListPaysExtension extends Twig_Extension
{
    private $app;

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }

    public function getFunctions()
    {
        return array('list_pays' => new \Twig_Function_Method($this, 'listPays'));
    }

    public function listPays()
    {
        return \Cungfoo\Model\PaysQuery::create()->select('Code')->findActive()->toArray();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'list_pays';
    }
}