<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace VacancesDirectes\Command\Load\Etablissement;

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

class CoordinatesCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('vacancesdirectes:load:etablissement:coordinates')
            ->setDescription('Load etablissement coordinates')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>%s</info> <comment>started</comment>.', $this->getName()));

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $etablissements = \Cungfoo\Model\EtablissementQuery::create()->find($con);

            foreach ($etablissements as $etablissement)
            {
                $json = json_decode(file_get_contents(sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false', urlencode($etablissement->getCity() . ',France'))), true);
                if (count($json['results']) > 0)
                {
                    $etablissement
                        ->setGeoCoordinateX($json['results'][0]['geometry']['location']['lat'])
                        ->setGeoCoordinateY($json['results'][0]['geometry']['location']['lng'])
                        ->save($con)
                    ;

                    $output->writeln(sprintf('<info>%s</info> coordinates added on <comment>%s</comment>.', $this->getName(), $etablissement->getName()));
                }
            }

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw $exception;
        }

        $output->writeln(sprintf('<info>%s</info> <comment>success</comment>.', $this->getName()));

        return true;
    }
}