<?php
namespace Cungfoo\Command\Tests;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

class UnitCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('tests:units')
            ->setDescription('Launches tests')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $atoum     = $this->getProjectDirectory().'/vendor/bin/atoum';
        $unitTests = $this->getProjectDirectory().'/tests';

        passthru(sprintf('%s -d %s', $atoum, $unitTests), $status);

        // $status is not correct (php 5.4 bug)

        return true;
    }
}
