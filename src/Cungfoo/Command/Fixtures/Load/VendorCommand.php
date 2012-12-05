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

class VendorCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('fixtures:load:vendor')
            ->setDescription('Load vendor fixtures (check droussel for more informations :-)')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a input directory.', '/app/resources/data/vendor')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            $count = 0;
            $filesystem = new Filesystem();

            $filesToLoad = glob(sprintf('%s/%s/*.yml', $this->getProjectDirectory(), trim($input->getOption('directory'), DIRECTORY_SEPARATOR)));

            foreach ($filesToLoad as $fileToLoad)
            {
                $data = Yaml::parse($fileToLoad);

                try
                {
                    $className = key($data);
                    $keyField  = $data[$className]['keyField'];
                    $values    = $data[$className]['values'];

                    $count += $this->insert($className, $keyField, $values);
                }
                catch (\Exception $exception)
                {
                    $output->writeln(sprintf('<info>%s</info> <error>%s not loaded : %s</error>.', $this->getName(), $fileToLoad, $exception->getMessage()));
                }
            }
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>error %s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<comment>%s</comment> vendor data loaded.', $count));

        return true;
    }

    protected function insert($className, $keyField, $values)
    {
        $count  = 0;
        $model  = $className."Query";
        $filter = 'filterBy'.$keyField;
        $utils  = new \Cungfoo\Lib\Utils();

        foreach ($values as $keyValue => $fields)
        {
            $elmt = $model::create()->$filter($keyValue)->findOne();

            if (!$elmt)
            {
                continue;
            }

            foreach ($fields as $fieldName => $fieldValue)
            {
                $setter = 'set'.$utils->camelize($fieldName);
                $elmt->$setter($fieldValue)->save();
            }

            $count++;
        }

        return $count;
    }
}
