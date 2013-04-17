<?php
namespace Cungfoo\Command\Assets;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Finder\Finder;

class ImageCompileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('assets:image:compile')
            ->setDescription('Compile images files')
            ->addArgument('directory', InputArgument::REQUIRED, 'Give a specific directory')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $line = sprintf("smushit -R -- %s", $input->getArgument('directory'));

        passthru($line);

        $output->writeln(sprintf('%s <info>%s</info>', $this->getName(), $line));

        return true;
    }
}
