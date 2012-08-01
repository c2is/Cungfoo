<?php

/**
 * This file is part of the Boomstone PHP Silex boilerplate.
 *
 * https://github.com/Retentio/Boomstone
 *
 * (c) Ludovic Fleury <ludo.fleury@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cungfoo\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Silex\Application as SilexApplication;

/**
 * Application.
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Application extends BaseApplication
{
    private $silexApplication;

    /**
     * Constructor.
     *
     * @param Silex\Appplication $silexApplication
     * @param string             $name              The name of the application
     * @param string             $version           The version of the application
     */
    public function __construct(SilexApplication $silexApplication, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->silexApplication = $silexApplication;
    }

    /**
     * Return the current silex application
     *
     * @return Silex\Application
     */
    public function getSilexApplication()
    {
        return $this->silexApplication;
    }

    public function getRootDir()
    {
        return isset($this->silexApplication['config']) ? $this->silexApplication['config']->get('root_dir') : null;
    }
}