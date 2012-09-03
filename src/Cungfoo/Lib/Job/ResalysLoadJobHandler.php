<?php

namespace Cungfoo\Lib\Job;

use Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\NullOutput,
    Symfony\Component\Yaml\Yaml;

use Cungfoo\Lib\Job\Interfaces,
    Cungfoo\Model\JobLogPeer;

class ResalysLoadJobHandler extends Interfaces\JobHandler
{
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
            $loader = new \Resalys\Lib\Loader(array(
                'client_configuration'      => $params['rootDir'].'/app/config/Resalys/client.yml',
                'loader_configuration'      => $params['rootDir'].'/app/config/Resalys/loader.yml',
                'languages_configuration'   => $params['rootDir'].'/app/config/languages.yml',
            ));

            $loader->run();
        }
        catch (\Exception $e)
        {
            $message = sprintf('une erreur est survenue lors de l\'import des données Resalys (%s)', $e->getMessage());
            $this->addLog($message);
            throw new \Exception(sprintf('{job interrompu} %s - code %s', $message, $e->getCode()));
        }

        $duration = time() - $startedAt;
        $this->addLog(sprintf('fin de l\'import (durée: %ss).', $duration), JobLogPeer::LEVEL_INFO);

        return true;
    }
}
