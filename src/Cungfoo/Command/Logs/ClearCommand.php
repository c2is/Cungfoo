<?php
namespace Cungfoo\Command\Logs;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Finder\Finder;

class ClearCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('logs:clear')
            ->setDescription('Clears logs expect .gitkeep file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $finder->in($this->getApplication()->getRootDir().DIRECTORY_SEPARATOR.'logs')->notName('.gitkeep');

        $fs = new Filesystem();
        $fs->remove($finder);

        $output->writeln('Logs <comment>cleared</comment>.');
        return true;
    }
}