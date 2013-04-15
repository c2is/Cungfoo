<?php

/*
 * This file is part of the c2is/Resalys_6.
 *
 * (c) Morgan Brunot <brunot.morgan@gmail.com>
 */
namespace Resalys_6\Lib\Client;

use SoapClient;
use Exception;

/**
 * AbstractClient.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
abstract class AbstractClient
{
    public $data = array();

    private $options = array();

    private $languages = array();

    abstract protected function getName();

    abstract protected function getRequests();

    abstract protected function getEnvelope();

    public function __construct(array $options = array(), $languages = array('fr'))
    {
        $this->languages = $languages;
        $this->options   = $this->configure($options);
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

    public function getOptions()
    {
        return $this->options;
    }

    public function getOption($name, $default = null)
    {
        return empty($this->options[$name]) ? $default : $this->options[$name];
    }

    public function resetOptions()
    {
        $this->options = array();

        return $this;
    }

    private function getEnvelopeFormatted($scope)
    {
        $envelope = array();
        foreach ($this->getEnvelope() as $name => $value) {
            $envelope[$name] = $this->getOption('')
        }
    }

    private function configure(array $options = array())
    {
        if (empty($options[$this->getName()])) {
            throw new Exception(sprintf("No configuration found for '%s' client", $this->getName()));
        }

        $this->addOption('wsdl_url', $options[$this->getName()]['location']);

        foreach ($options[$this->getName()]['default_envelope'] as $name => $value) {
            if (is_array($value)) {

            } else {
                foreach ($this->languages as $language) {

                }
            }

            $this->addOption($optionName, $optionValue);
        }
    }

    public function parse()
    {
        foreach ($this->languages as $language) {
            $this->addOptions(array(
                'language'      => strtoupper($language),
                'language_code' => strtoupper($language),
            ));

            foreach ($this->getRequests() as $request) {
                $wsdlIsUp = (bool) file_get_contents($this->getOption('wsdl_url'));

                if ($wsdlIsUp) {
                    $client = new SoapClient($this->getOption('wsdl_url'), array('cache_wsdl' => WSDL_CACHE_NONE));

                    $this->data[$request][$language] = call_user_func_array(array($client, $request), $this->getEnvelopeFormatted($language))
                }
                else {
                    $this->data[$request][$language] = '';
                }
            }
        }
    }
}
