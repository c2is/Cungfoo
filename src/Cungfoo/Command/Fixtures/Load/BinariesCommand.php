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
            $filesystem = new Filesystem();

            // remove binaries files
            $directoriesToRemove = glob($this->getSilexApplication()['config']->get('web_dir') . '/uploads/*');
            foreach ($directoriesToRemove as $directoryToRemove)
            {
                $filesystem->remove($directoryToRemove);
            }

            // load binaries fixtures
            $fixturesDirectory  = sprintf('%s/%s/uploads', $this->getApplication()->getRootDir(), trim($input->getOption('directory'), DIRECTORY_SEPARATOR));
            $uploadsDirectory   = $this->getSilexApplication()['config']->get('web_dir') . '/uploads';
            $command = sprintf('cp -rf %s/* %s', escapeshellarg($fixturesDirectory), escapeshellarg($uploadsDirectory));
            exec($command);

            $result = array();
            exec(sprintf('ls -lR %s | grep ^d | wc -l', $uploadsDirectory), $result);
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