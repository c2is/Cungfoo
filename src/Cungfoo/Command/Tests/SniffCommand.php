<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Tests;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

class SniffCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('tests:sniff')
            ->setDescription('Launches PHP_CodeSniffer tests')
            ->addOption('modified-files', null, InputOption::VALUE_NONE, 'Launches PHP_CodeSniffer only for recently changed files.')
            ->addArgument('file', InputArgument::OPTIONAL, 'Give a specific file to run PHP_CodeSniffer.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filesToSniff = array('app', 'src', 'tests');
        if ($specificFile = $input->getArgument('file'))
        {
            $filesToSniff = array($specificFile);
        }
        else if ($input->getOption('modified-files'))
        {
            ob_start();
            passthru(sprintf('git diff --name-only --cached'));
            $outputGitDiffStaged = trim(ob_get_contents(), "\n");
            ob_end_clean();

            $filesToSniff   = explode("\n", $outputGitDiffStaged);
        }

        passthru(sprintf('phpcs %s --warning-severity=0', implode(' ', $filesToSniff)), $status);

        return $status;
    }
}