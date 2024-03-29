<?php

namespace Resalys\Lib\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class CatalogueClient extends AbstractClient
{
    const DEFAULT_LOADER_FILE   = '/app/config/Resalys/loader.yml';
    const LOADER_PATTERN        = '\\Cungfoo\\Lib\\Resalys\\Loader\\%sLoader';

    protected function getName()
    {
        return 'catalogue';
    }

    protected function getRequests()
    {
        return array(
            'getAllThemes',
            'getAllRoomTypeCategories',
            'getAllRoomTypes',
            'getAllEtabs',
        );
    }

    protected function getEnvelopeFormat()
    {
        return array(
            'base_id'       => $this->getOption('base_id', ''),
            'username'      => $this->getOption('username', ''),
            'password'      => $this->getOption('password', ''),
            'language_code' => $this->getOption('language', ''),
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
