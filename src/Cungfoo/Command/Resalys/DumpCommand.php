<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Resalys;

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
        "\\Cungfoo\\Model\\PaysI18n",
        "\\Cungfoo\\Model\\Region",
        "\\Cungfoo\\Model\\RegionI18n",
        "\\Cungfoo\\Model\\Ville",
        "\\Cungfoo\\Model\\VilleI18n",
        "\\Cungfoo\\Model\\Activite",
        "\\Cungfoo\\Model\\ActiviteI18n",
        "\\Cungfoo\\Model\\Destination",
        "\\Cungfoo\\Model\\DestinationI18n",
        "\\Cungfoo\\Model\\Thematique",
        "\\Cungfoo\\Model\\ThematiqueI18n",
        "\\Cungfoo\\Model\\SituationGeographique",
        "\\Cungfoo\\Model\\SituationGeographiqueI18n",
        "\\Cungfoo\\Model\\Categorie",
        "\\Cungfoo\\Model\\CategorieI18n",
        "\\Cungfoo\\Model\\Baignade",
        "\\Cungfoo\\Model\\BaignadeI18n",
        "\\Cungfoo\\Model\\ServiceComplementaire",
        "\\Cungfoo\\Model\\ServiceComplementaireI18n",
        "\\Cungfoo\\Model\\CategoryTypeHebergement",
        "\\Cungfoo\\Model\\CategoryTypeHebergementI18n",
        "\\Cungfoo\\Model\\TypeHebergement",
        "\\Cungfoo\\Model\\TypeHebergementI18n",
        "\\Cungfoo\\Model\\Etablissement",
        "\\Cungfoo\\Model\\EtablissementActivite",
        "\\Cungfoo\\Model\\EtablissementDestination",
        "\\Cungfoo\\Model\\EtablissementSituationGeographique",
        "\\Cungfoo\\Model\\EtablissementBaignade",
        "\\Cungfoo\\Model\\EtablissementThematique",
        "\\Cungfoo\\Model\\EtablissementServiceComplementaire",
        "\\Cungfoo\\Model\\EtablissementTypeHebergement",
        "\\Cungfoo\\Model\\PointInteret",
        "\\Cungfoo\\Model\\PointInteretI18n",
        "\\Cungfoo\\Model\\EtablissementPointInteret",
    );

    protected function configure()
    {
        $this
            ->setName('resalys:dump')
            ->setDescription('Dump static resalys data to a yaml fixtures')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a output directory.', '/app/resources/data/fixtures')
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
                array_walk($objectsArray, function($value, $key) use (&$objectsArrayForYaml, $model) {
                    if (isset($value['CreatedAt']))
                    {
                        unset($value['CreatedAt']);
                    }
                    if (isset($value['UpdatedAt']))
                    {
                        unset($value['UpdatedAt']);
                    }


                    if (strpos($model, 'I18n'))
                    {
                        $objectsArrayForYaml[sprintf('%s_%s', $value['Id'], $value['Locale'])] = $value;
                    }
                    else if (isset($value['Id']))
                    {
                        $valueId        = $value['Id'];
                        unset($value['Id']);

                        $objectsArrayForYaml[$valueId] = $value;
                    }
                    else
                    {
                        $objectsArrayForYaml[implode('_', $value)] = $value;
                    }
                });

                // generate yaml output
                $objectsYaml = Yaml::dump(array($model => $objectsArrayForYaml), 3);

                // compute utils informations
                $modelPath   = explode('\\', $model);
                $tableName   = $utils->underscore(end($modelPath));
                $prefix      = str_pad($order, 2, '0', STR_PAD_LEFT);
                $fixtureName = sprintf('%s/%s-resalys-%s.yml', $fixturesDirectory, $prefix, $tableName);

                // dump fixtures files
                file_put_contents($fixtureName, $objectsYaml);
                $output->writeln(sprintf('<info>Resalys:dump</info> table <comment>%s</comment> is dumped.', $tableName));
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