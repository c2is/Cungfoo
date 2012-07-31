<?php

namespace Cungfoo\Lib;

use Symfony\Component\Yaml\Yaml;

class Config
{
    protected $data;

    private $rootDir;

    /**
     * Return root dir
     * @param string $configDir
     * @return Config
     */
    public function setRootDir($configDir)
    {
        $this->rootDir = rtrim($configDir, DIRECTORY_SEPARATOR);
        return $this;
    }

    /**
     * Returns root dir
     * @return string
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Returns all configuration datas
     * @return array Config
     */
    public function collect()
    {
        $this->data = array(
            'languages' => isset($this->rootDir) ? Yaml::parse(sprintf('%s/config/languages.yml', $this->rootDir))['languages'] : 'n/a',
        );

        return $this;
    }

    /**
     * Returns languages     * @return array
     */
    public function getLanguages()
    {
        return $this->data['languages'];
    }
}
