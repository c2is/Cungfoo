<?php

namespace Cungfoo\Lib\Job;

use Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\NullOutput,
    Symfony\Component\Yaml\Yaml;

use Cungfoo\Lib\Job\Interfaces\JobHandler,
    Cungfoo\Model\JobLogPeer;

use Cungfoo\Lib\ViaFrance\Client\PointOfInterestClient,
    Cungfoo\Lib\ViaFrance\Loader\PointOfInterestLoader,
    Cungfoo\Lib\RESTConnection;

class PointOfInterestJobHandler extends JobHandler
{
    public static function getName()
    {
        return 'POI';
    }

    /**
     * @throws \Exception
     * @param array $params
     * @return void
     */
    public function run(array $params)
    {
        $this->addLog(sprintf('Run %s', get_class($this)), JobLogPeer::LEVEL_INFO);
        $startedAt = time();

        $client = new PointOfInterestClient();
        $client->loadConfig($params['app']['config']->getRootDir().'/app/config/ViaFrance/client.yml');

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

                foreach ($params['app']['config']->getLanguages() as $language => $locale)
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

            $message = sprintf('une erreur est survenue lors de l\'import des POI ViaFrance (%s)', $exception->getMessage());
            $this->addLog($message);

            throw new \Exception(sprintf('{job interrompu} %s - code %s', $message, $exception->getCode()));
        }

        $duration = time() - $startedAt;
        $this->addLog(sprintf('fin de l\'import (durée: %ss).', $duration), JobLogPeer::LEVEL_INFO);

        return true;
    }
}
