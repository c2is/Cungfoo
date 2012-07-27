<?php
namespace Cungfoo\Command\Cache;

use Cungfoo\Command\ApplicationAwareCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Finder\Finder;

class ClearCacheCommand extends ApplicationAwareCommand
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
        $finder->in($this->getApplication()->getRootDir().DIRECTORY_SEPARATOR.'cache')->notName('.gitkeep');

        $fs = new Filesystem();
        $fs->remove($finder);

        $output->writeln('Cache <comment>cleared</comment>.');
        return true;
    }
}