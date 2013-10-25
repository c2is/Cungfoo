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

    protected $clientConfig     = null;
    protected $languagesConfig  = null;

    protected $location         = null;
    protected $options          = array();

    abstract protected function getName();

    abstract protected function getRequests();

    abstract protected function getEnvelopeFormat();

    public function __construct($rootdir, $locale = null, $configFiles = array())
    {
        $this->rootdir = $rootdir;
        $this->locale  = $locale;

        // load default data
        $this->clientConfig    = Yaml::parse($this->rootdir . (empty($configFiles['client_file']) ? self::DEFAULT_CLIENT_FILE : $configFiles['client_file']));
        $this->languagesConfig = Yaml::parse($this->rootdir . (empty($configFiles['languages_file']) ? self::DEFAULT_LANGUAGE_FILE: $configFiles['languages_file']));

        // load default configurations
        $this->loadClientConfig();
        $this->loadLanguagesConfig();
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

    public function loadClientConfig()
    {
        if (empty($this->clientConfig['services'][$this->getName()]))
        {
            throw new \Exception(sprintf("No configuration found for '%s' client", $this->getName()));
        }

        $this->location = $this->clientConfig['services'][$this->getName()]['location'];
        foreach ($this->clientConfig['services'][$this->getName()]['default_envelope'] as $optionName => $optionValue)
        {
            $this->addOption($optionName, $optionValue);
        }
    }

    public function loadLanguagesConfig()
    {
        if (!array_key_exists('languages', $this->languagesConfig))
        {
            throw new \Exception("No 'languages' key in languages configuration file");
        }

        $languagesKeys = array_keys($this->languagesConfig['languages']);
        if (!count($languagesKeys))
        {
            throw new \Exception("No language in languages configuration file");
        }

        $this->addOption('languages', array_values($languagesKeys));
    }

    public function parse()
    {
        foreach ($this->getOption('languages', array('FR')) as $language)
        {
            $this->addOption('language', strtoupper($language));
            $this->addOption('language_code', strtoupper($language));

            if (!defined('DREIZEN'))
            {
                // @TOOD Fixer le bug site CE
                if (isset($this->languagesConfig['languages'][$language]) && $this->getName() !== 'auth')
                {
                    $languageConfig = $this->languagesConfig['languages'][$language];

                    if (isset($languageConfig['resalys_username'])) {
                        $this->addOption('username', $languageConfig['resalys_username']);
                        $this->addOption('webuser', $languageConfig['resalys_username']);
                    }

                    if (isset($languageConfig['resalys_flow_name'])) {
                        $this->addOption('flow_name', $languageConfig['resalys_flow_name']);
                    }
                }
            }

            global $timeResalys;

            foreach ($this->getRequests() as $request)
            {
                $time = microtime(true);

                try {
                    $client = new \SoapClient($this->location, array('cache_wsdl' => WSDL_CACHE_NONE));
                    $result = call_user_func_array(array($client, $request), $this->getEnvelopeFormat());
                    if (is_soap_fault($result)) {
                        throw new \SoapFault("Error Processing Request", 1);
                    }

                    $this->data[$request][$language] = $result;
                }
                catch (\SoapFault $fault) {
                    $this->data[$request][$language] = '';
                }

                $timeResalys[] = microtime(true) - $time;
            }
        }
    }
}
