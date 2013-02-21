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
    Cungfoo\Lib\ViaFrance\Client\EventClient,
    Cungfoo\Lib\ViaFrance\Client\EventRegionClient,
    Cungfoo\Lib\ViaFrance\Loader\EventLoader;

class EventCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('viafrance:load:events')
            ->setDescription('Executes REST request to ViaFrance and retrieves events')
            ->addOption('language_code', 'l', InputOption::VALUE_OPTIONAL, 'Give a specific language_code or this task execute for all.', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        set_time_limit(0);
        $loader = new EventLoader();

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $loader->init($con);

            $etabs = \Cungfoo\Model\EtablissementQuery::create()
                ->find()
            ;

            $languageCode = $input->getOption('language_code');

            foreach ($this->getSilexApplication()['config']->getLanguages() as $language => $locale)
            {
                if ($language == 'de')
                {
                    $client = new EventRegionClient();
                    $client->loadConfig($this->getProjectDirectory().'/app/config/ViaFrance/client.yml');
                    $client->setParam('lang', $language);

                    $regions = \Cungfoo\Model\RegionQuery::create()
                        ->find()
                    ;

                    $correspondanceRegions = \Symfony\Component\Yaml\Yaml::parse($this->getProjectDirectory().'/app/config/ViaFrance/regions.yml')['regions'];

                    foreach ($regions as $region)
                    {
                        if (isset($correspondanceRegions[$region->getCode()]))
                        {
                            foreach ($correspondanceRegions[$region->getCode()] as $key => $value)
                            {
                                $client->setParam($key, $value);
                                $data = $client->getData(new RESTConnection());
                                $loader->load($region, $data, $language);
                            }
                        }
                    }
                }
                else
                {
                    $client = new EventClient();
                    $client->loadConfig($this->getProjectDirectory().'/app/config/ViaFrance/client.yml');
                    $client->setParam('lang', $language);

                    foreach ($etabs as $etab)
                    {
                        $client->setParam('x', $etab->getGeoCoordinateX());
                        $client->setParam('y', $etab->getGeoCoordinateY());

                        $data = $client->getData(new RESTConnection());
                        $loader->load($etab, $data, $language);
                    }
                }
            }

            $loader->close();

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $loader->close();
            $con->rollBack();
            $output->writeln(sprintf('<info>viafrance:load:events</info> <error>error %s:</error>.', $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<info>viafrance:load:events</info> <info>data is loaded</info>.'));

        return true;
    }
}
