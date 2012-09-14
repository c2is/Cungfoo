<?php

namespace Cungfoo\Lib\Job;

use Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\NullOutput,
    Symfony\Component\Yaml\Yaml;

use Cungfoo\Lib\Job\Interfaces\JobHandler,
    Cungfoo\Model\JobLogPeer,
    Cungfoo\Lib\Resalys\Client\CatalogueClient;

class CatalogueClientJobHandler extends JobHandler
{
    public static function getName()
    {
        return 'CatalogueClient';
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

        try
        {
            $client = new CatalogueClient($params['rootDir']);
            $client->loadData();
        }
        catch (\Exception $exception)
        {
            $message = sprintf('une erreur est survenue lors de l\'import des données Resalys (%s)', $exception->getMessage());
            $this->addLog($message);

            throw new \Exception(sprintf('{job interrompu} %s - code %s', $message, $exception->getCode()));
        }

        $duration = time() - $startedAt;
        $this->addLog(sprintf('fin de l\'import (durée: %ss).', $duration), JobLogPeer::LEVEL_INFO);

        return true;
    }
}
