<?php
namespace Cungfoo\Command;

use Cungfoo\Console\Application;

use Symfony\Component\Console\Helper\FormatterHelper;

use Knp\Command\Command as BaseCommand;

/**
 * Application aware command
 *
 * Provide a silex application in CLI context.
 */
abstract class Command extends BaseCommand
{
    protected $formatterHelper = null;

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
