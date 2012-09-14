<?php
namespace tests\units\Cungfoo\Lib\Resalys\Client;

require_once __DIR__ . '/../../../../../bootstrap.php';

use mageekguy\atoum;
use Cungfoo\Lib\Resalys\Client\CatalogueClient as Client;

class CatalogueClient extends atoum\test
{
    protected function getLoaderTestInstance()
    {
        return new Client(__DIR__, array(
            'client_file'      => '/config/client.yml',
            'languages_file'   => '/config/languages.yml',
        ));
    }

    public function test_addOption()
    {
        $defaultOptions = array(
            'base_id'   => 'base_id_value',
            'languages' => array(
                'fr',
                'en',
                'de'
            )
        );

        $client = $this->getLoaderTestInstance();
        $client->addOption('lang_1', 'lang_1');
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_1'));

        $client->addOption('lang_1', 'lang_2');
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_2'));

        $client->addOption('lang_3', 'lang_3');
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_2', 'lang_3' => 'lang_3'));
    }

    public function test_addOptions()
    {
        $defaultOptions = array(
            'base_id'   => 'base_id_value',
            'languages' => array(
                'fr',
                'en',
                'de'
            )
        );

        $client = $this->getLoaderTestInstance();
        $client->addOptions(array('lang_1' => 'lang_1', 'lang_3' => 'lang_3'));
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_1', 'lang_3' => 'lang_3'));

        $client->addOptions(array('lang_1' => 'lang_2', 'lang_3' => 'lang_3'));
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_2', 'lang_3' => 'lang_3'));
    }

    public function test_loadLanguagesConfig_NoLanguagesKey()
    {
        $client = $this->getLoaderTestInstance();

        $this->exception(function() use ($client) {
            $client->loadLanguagesConfig(__DIR__.'/config/languages-bad.yml');
        })->hasMessage("No 'languages' key in languages configuration file : ".__DIR__.'/config/languages-bad.yml');
    }

    public function test_loadLanguagesConfig()
    {
        $client = $this->getLoaderTestInstance();
        $this->array($client->getOption('languages'))->isIdenticalTo(array('fr', 'en', 'de'));

        $client->loadLanguagesConfig(__DIR__.'/config/languages-other.yml');
        $this->array($client->getOption('languages'))->isIdenticalTo(array('foo', 'bar'));
    }
}