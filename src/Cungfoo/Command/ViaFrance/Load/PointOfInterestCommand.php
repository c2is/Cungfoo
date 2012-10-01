<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\ViaFrance\Load;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Cungfoo\Command\Command as BaseCommand,
    Cungfoo\Lib\RESTConnection,
    Cungfoo\Lib\ViaFrance\Client\PointOfInterestClient,
    Cungfoo\Lib\ViaFrance\Loader\PointOfInterestLoader;

class PointOfInterestCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('viafrance:load:poi')
            ->setDescription('Executes REST request to ViaFrance and retrieves POI')
            ->addOption('language_code', 'l', InputOption::VALUE_OPTIONAL, 'Give a specific language_code or this task execute for all.', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new PointOfInterestClient();
        $client->loadConfig($this->getApplication()->getRootDir().'/app/config/ViaFrance/client.yml');

        $loader = new PointOfInterestLoader();

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $loader->init($con);

            $etabs = \Cungfoo\Model\EtablissementQuery::create()
                ->find()
            ;

            foreach ($etabs as $etab)
            {
                $client->setParam('x', $etab->getGeoCoordinateX());
                $client->setParam('y', $etab->getGeoCoordinateY());

                foreach ($this->getSilexApplication()['config']->getLanguages() as $language => $locale)
                {
                    $client->setParam('lang', $language);
                    $data = $client->getData(new RESTConnection());
                    $loader->load($etab, $data, $language);
                }
            }

            $loader->close();

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $loader->close();
            $con->rollBack();
            $output->writeln(sprintf('<info>viafrance:load:poi</info> <error>error %s:</error>.', $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<info>viafrance:load:poi</info> <info>data is loaded</info>.'));

        return true;
    }
}