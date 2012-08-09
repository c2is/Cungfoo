<?php
namespace Cungfoo\Command\Cache;

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
            ->setName('cache:clear')
            ->setDescription('Clears cache expect .gitkeep file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $finder->in($this->getApplication()->getRootDir().'/app/cache')->notName('.gitkeep');

        $fs = new Filesystem();
        $fs->remove($finder);

        $output->writeln('Cache <comment>cleared</comment>.');
        return true;
    }
}