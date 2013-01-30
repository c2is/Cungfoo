<?php

namespace Resalys\Lib\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractClient
{
    const DEFAULT_CLIENT_FILE   = '/app/config/Resalys/client.yml';
    const DEFAULT_LANGUAGE_FILE = '/app/config/languages.yml';

    protected $type             = array();
    protected $data             = array();
    protected $locale           = null;
    protected $rootdir          = '';

    protected $location         = null;
    protected $options          = array();

    abstract protected function getName();

    abstract protected function getRequests();

    abstract protected function getEnvelopeFormat();

    public function __construct($rootdir, $locale = null, $configFiles = array())
    {
        $this->rootdir = $rootdir;
        $this->locale  = $locale;

        // load default configurations
        $this->loadLanguagesConfig($this->rootdir . (empty($configFiles['languages_file']) ? self::DEFAULT_LANGUAGE_FILE: $configFiles['languages_file']));
        $this->loadClientConfig($this->rootdir . (empty($configFiles['client_file']) ? self::DEFAULT_CLIENT_FILE : $configFiles['client_file']));
    }

    public function addOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    public function addOption($name, $value)
    {
        return $this->addOptions(array($name => $value));
    }

    public function getOption($name, $default = null)
    {
        return empty ($this->options[$name]) ? $default : $this->options[$name];
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getData()
    {
        return $this->data;
    }

    public function loadClientConfig($clientConfigFile)
    {
        $clientConfig = Yaml::parse($clientConfigFile);

        if (empty($clientConfig['services'][$this->getName()]))
        {
            throw new \Exception(sprintf("No configuration found for '%s' client", $this->getName()));
        }

        $this->location = $clientConfig['services'][$this->getName()]['location'];
        foreach ($clientConfig['services'][$this->getName()]['default_envelope'] as $optionName => $optionValue)
        {
            $this->addOption($optionName, $optionValue);
        }
    }

    public function loadLanguagesConfig($languagesConfigFile)
    {
        $languagesConfig = Yaml::parse($languagesConfigFile);
        if (!array_key_exists('languages', $languagesConfig))
        {
            throw new \Exception("No 'languages' key in languages configuration file : ".$languagesConfigFile);
        }

        $languagesKeys = array_keys($languagesConfig['languages']);
        if (!count($languagesKeys))
        {
            throw new \Exception("No language in languages configuration file : ".$languagesConfigFile);
        }

        $this->addOption('languages', array_values($languagesKeys));

        if (null !== $this->locale && isset($languagesConfig['languages'][$this->locale]) && isset($languagesConfig['languages'][$this->locale]['resalys_username']))
        {
            $this->addOption('username', $languagesConfig['languages'][$this->locale]['resalys_username']);
        }
    }

    public function parse()
    {
        foreach ($this->getOption('languages', array('FR')) as $language)
        {
            foreach ($this->getRequests() as $request)
            {
                try
                {
                    $soapContent = file_get_contents($this->location);
                }
                catch (Exception $e)
                {
                    $soapContent = false;
                }

                if ($soapContent)
                {
                    $client = new \SoapClient($this->location, array('cache_wsdl' => WSDL_CACHE_NONE));
                    $this->data[$request][$language] = call_user_func_array(array($client, $request), $this->getEnvelopeFormat());
                }
                else
                {
                    $this->data[$request][$language] = '';
                }
            }
        }
    }
}
