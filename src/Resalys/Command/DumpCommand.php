<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Resalys\Command;

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

class DumpCommand extends BaseCommand
{
    /**
     * Models to be dumped
     * @var array
     */
    protected $models = array(
        "\\Cungfoo\\Model\\Pays",
        "\\Cungfoo\\Model\\Region",
        "\\Cungfoo\\Model\\Ville",
        "\\Cungfoo\\Model\\Activite",
        "\\Cungfoo\\Model\\Destination",
        "\\Cungfoo\\Model\\Equipement",
        "\\Cungfoo\\Model\\ServiceComplementaire",
        "\\Cungfoo\\Model\\CategoryTypeHebergement",
        "\\Cungfoo\\Model\\TypeHebergement",
        "\\Cungfoo\\Model\\Camping",
        "\\Cungfoo\\Model\\CampingActivite",
        "\\Cungfoo\\Model\\CampingDestination",
        "\\Cungfoo\\Model\\CampingEquipement",
        "\\Cungfoo\\Model\\CampingServiceComplementaire",
        "\\Cungfoo\\Model\\CampingTypeHebergement",
    );

    protected function configure()
    {
        $this
            ->setName('resalys:dump')
            ->setDescription('Dump static resalys data to a yaml fixtures')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a output directory.', '/app/resources/data/fixtures/resalys')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Resalys:dump</info> <comment>started</comment>.');

        $utils = new \Cungfoo\Lib\Utils();
        $fixturesDirectory = sprintf('%s/%s', $this->getApplication()->getRootDir(), trim($input->getOption('directory'), DIRECTORY_SEPARATOR));
        if (!is_dir($fixturesDirectory))
        {
            $output->writeln(sprintf('<info>Resalys:dump</info> <error>error : directory %s does not exist</error>.', $fixturesDirectory));
            return false;
        }

        try
        {
            // fixtures order
            $order = 0;

            foreach ($this->models as $model)
            {
                $order++;

                // get all objects
                $modelQuery = sprintf('%sQuery', $model);
                $objectsArray = $modelQuery::create()
                    ->find()
                    ->toArray()
                ;

                // format for yaml
                $objectsArrayForYaml = array();
                array_walk($objectsArray, function($value, $key) use (&$objectsArrayForYaml) {
                    if (isset($value['Id']))
                    {
                        $objectsArrayForYaml[$value['Id']] = $value;
                    }
                    else
                    {
                        $objectsArrayForYaml[implode('_', $value)] = $value;
                    }
                });

                // generate yaml output
                $objectsYaml = Yaml::dump(array($model => $objectsArrayForYaml), 3);

                // compute utils informations
                $tableName   = $utils->underscore(end(explode('\\', $model)));
                $prefix      = str_pad($order, 2, '0', STR_PAD_LEFT);
                $fixtureName = sprintf('%s/%s-%s.yml', $fixturesDirectory, $prefix, $tableName);

                // dump fixtures files
                file_put_contents($fixtureName, $objectsYaml);
                $output->writeln(sprintf('<info>Resalys:dump</info> table <comment>%s</comment> is dump.', $tableName));
            }
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>Resalys:dump</info> <error>error %s:</error>.', $exception));
            return false;
        }


        $output->writeln(sprintf('<info>Resalys:dump</info> <info>success</info>.'));
        return true;
    }
}