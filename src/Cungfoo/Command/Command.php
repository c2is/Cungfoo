<?php
namespace Cungfoo\Command;

use Cungfoo\Console\Application;

use Symfony\Component\Console\Helper\FormatterHelper;

/**
 * Application aware command
 *
 * Provide a silex application in CLI context.
 */
abstract class Command extends \Symfony\Component\Console\Command\Command
{
    protected $formatterHelper = null;

    /**
     * Return the current silex application
     *
     * @return Silex\Application
     */
    public function getSilexApplication()
    {
        return $this->getApplication()->getSilexApplication();
    }

    /**
     * Return an instance of FormatterHelper
     *
     * @return Symfony\Component\Console\Helper\FormatterHelper
     */
    public function getFormatterHelper()
    {
        return is_null($this->formatterHelper) ? $this->formatterHelper = new FormatterHelper() : $this->formatterHelper;
    }
}