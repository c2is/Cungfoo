<?php

namespace Cungfoo\Lib\Job;

use Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\NullOutput,
    Symfony\Component\Yaml\Yaml;

use Cungfoo\Lib\Job\Interfaces\JobHandler,
    Cungfoo\Model\JobLogPeer;

use Cungfoo\Lib\ViaFrance\Client\EventClient,
    Cungfoo\Lib\ViaFrance\Loader\EventLoader,
    Cungfoo\Lib\RESTConnection;

class EventJobHandler extends JobHandler
{
    public static function getName()
    {
        return 'Event';
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

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $client = new EventClient();
            $client->loadConfig($params['app']['config']->getRootDir().'/app/config/ViaFrance/client.yml');

            $loader = new EventLoader();
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

            $message = sprintf('une erreur est survenue lors de l\'import des events ViaFrance (%s)', $exception->getMessage());
            $this->addLog($message);

            throw new \Exception(sprintf('{job interrompu} %s - code %s', $message, $exception->getCode()));
        }

        $duration = time() - $startedAt;
        $this->addLog(sprintf('fin de l\'import (durée: %ss).', $duration), JobLogPeer::LEVEL_INFO);

        return true;
    }
}
