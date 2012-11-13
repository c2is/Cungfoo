<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Fixtures;

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
        "\\Cungfoo\\Model\\EtablissementI18n",
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
        "\\Cungfoo\\Model\\Event",
        "\\Cungfoo\\Model\\EventI18n",
        "\\Cungfoo\\Model\\EtablissementEvent",
        "\\Cungfoo\\Model\\Tag",
        "\\Cungfoo\\Model\\TagI18n",
        "\\Cungfoo\\Model\\MultimediaEtablissement",
        "\\Cungfoo\\Model\\MultimediaEtablissementI18n",
        "\\Cungfoo\\Model\\MultimediaEtablissementTag",
        "\\Cungfoo\\Model\\Personnage",
        "\\Cungfoo\\Model\\PersonnageI18n",
        "\\Cungfoo\\Model\\Avantage",
        "\\Cungfoo\\Model\\AvantageI18n",
        "\\Cungfoo\\Model\\Edito",
        "\\Cungfoo\\Model\\TopCamping",
    );

    protected function configure()
    {
        $this
            ->setName('fixtures:dump')
            ->setDescription('Dump fixtures from current database informations and binaries')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a output directory.', '/app/resources/data/fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>%s</info> <comment>started</comment>.', $this->getName()));

        $utils = new \Cungfoo\Lib\Utils();

        $fixturesDirectory = realpath(sprintf('%s/%s', $this->getApplication()->getRootDir(), trim($input->getOption('directory'), DIRECTORY_SEPARATOR)));

        if (!is_dir($fixturesDirectory))
        {
            $output->writeln(sprintf('<info>%s</info> <error>error : directory %s does not exist</error>.', $this->getName(), $fixturesDirectory));

            return false;
        }

        try
        {
            // fixtures order
            $order = 0;
            $filesystem = new \Symfony\Component\Filesystem\Filesystem();

            // remove all files before dump
            $filesystem->remove($fixturesDirectory.'/uploads/*');

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
                array_walk($objectsArray, function($value, $key) use (&$objectsArrayForYaml, $model, $fixturesDirectory, $filesystem) {
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
                        $valueId = $value['Id'];
                        unset($value['Id']);


                        foreach ($value as $field)
                        {
                            if ($field && is_string($field))
                            {
                                $file = $this->getApplication()->getRootDir().'/web/'.$field;
                                if ($field != '.' && file_exists($file))
                                {
                                    $filesystem->copy($file, $fixturesDirectory.'/'.$field);
                                }
                            }
                        }
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
                $fixtureName = sprintf('%s/%s-%s.yml', $fixturesDirectory, $prefix, $tableName);

                // dump fixtures files
                file_put_contents($fixtureName, $objectsYaml);
                $output->writeln(sprintf('<info>%s</info> table <comment>%s</comment> is dumped.', $this->getName(), $tableName));
            }
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>error %s:</error>.', $this->getName(), $exception));

            return false;
        }


        $output->writeln(sprintf('<info>%s</info> <info>success</info>.', $this->getName()));

        return true;
    }
}
