<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Fixtures\Load;

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Finder\Finder,
    Symfony\Component\Yaml\Yaml;

class BinariesCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('fixtures:load:binaries')
            ->setDescription('Load binaries fixtures')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a output directory.', '/app/resources/data/fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            $fs = new Filesystem();

            $fixturesDir = sprintf('%s/%s/uploads', $this->getProjectDirectory(), trim($input->getOption('directory')));
            $uploadsDir  = $this->getSilexApplication()['config']->get('web_dir') . '/uploads';

            $toDeleteFinder = new Finder();
            foreach ($toDeleteFinder->directories()->in($fixturesDir) as $toDeleteDir)
            {
                $fs->remove(sprintf('%s/%s', $uploadsDir, $toDeleteDir->getRelativePathname()));
            }

            $command = sprintf('cp -rf %s/* %s', escapeshellarg($fixturesDir), escapeshellarg($uploadsDir));
            exec($command);

            $result = array();
            exec(sprintf('ls -lR %s | grep ^d | wc -l', $uploadsDir), $result);
            $nbFiles = trim($result[0]);
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>error %s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<comment>%s</comment> binar%s file%s loaded.', $nbFiles, $nbFiles > 1 ? 'ies' : 'y', $nbFiles > 1 ? 's' : ''));

        return true;
    }
}
