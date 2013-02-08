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

class RelatedCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('vacancesdirectes:load:etablissement:related')
            ->setDescription('Load etablissement related')
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
            $etabArray = $etablissements->toArray();

            $nbEtab = count($etabArray);
            foreach ($etablissements as $etab)
            {
                $min1 = array('etab' => null, 'distance' => 500);
                $min2 = array('etab' => null, 'distance' => 500);

                for ($j = 0; $j < $nbEtab; $j++)
                {
                    $etabCompared = $etabArray[$j];

                    $distance = sqrt(pow($etabCompared['GeoCoordinateX'] - $etab->getGeoCoordinateX(), 2) + pow($etabCompared['GeoCoordinateY'] - $etab->getGeoCoordinateY(), 2));
                    if ($min1['distance'] > $distance)
                    {
                        $min1 = array('etab' => $etabCompared['Id'], 'distance' => $distance);
                    }
                    elseif ($min2['distance'] > $distance)
                    {
                        $min2 = array('etab' => $etabCompared['Id'], 'distance' => $distance);
                    }
                }

                if ($min1['etab'])
                {
                    $etab->setRelated1($min1['etab']);
                }
                if ($min2['etab'])
                {
                    $etab->setRelated2($min2['etab']);
                }

                $etab->save();
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