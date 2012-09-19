<?php

namespace Cungfoo\Lib\Resalys\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class PrixClient extends BaseClient
{
    const DEFAULT_LOADER_FILE   = '/app/config/Resalys/loader.yml';
    const LOADER_PATTERN        = '\\Cungfoo\\Lib\\Resalys\\Loader\\%sLoader';

    protected function getName()
    {
        return 'prix';
    }

    protected function getRequests()
    {
        return array(
            'getFlowProposals',
        );
    }

    protected function getEnvelopeFormat()
    {
        return array(
            'base_id'       => $this->getOption('base_id', ''),
            'username'      => $this->getOption('username', ''),
            'password'      => $this->getOption('password', ''),
            'language_code' => $this->getOption('language_code', ''),
            'object_type'   => $this->getOption('object_type', ''),
            'flow_name'     => $this->getOption('flow_name', ''),
            'nb_products'   => $this->getOption('nb_products', ''),
        );
    }

    public function loadData($loaderFile = null)
    {
        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $this->parse();

            foreach ($this->data as $request => $languages)
            {
                foreach ($languages as $language => $data)
                {
                    $loaderClass = sprintf(self::LOADER_PATTERN, $request);
                    $loader = new $loaderClass();
                    $loader->parseConfigFile($this->rootdir . ($loaderFile ?: self::DEFAULT_LOADER_FILE));
                    $loader->load($data, $language, $con);
                }
            }

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw new \Exception($exception);
        }
    }
}
