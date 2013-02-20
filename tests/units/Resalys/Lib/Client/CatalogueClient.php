<?php
namespace tests\units\Resalys\Lib\Client;

require_once __DIR__ . '/../../../../bootstrap.php';

use mageekguy\atoum;
use Resalys\Lib\Client\CatalogueClient as Client;

class CatalogueClient extends atoum\test
{
    protected function getLoaderTestInstance($languagesFile = '/config/languages.yml', $clientFile = '/config/client.yml')
    {
        return new Client(__DIR__, null, array(
            'languages_file'   => $languagesFile,
            'client_file'      => $clientFile,
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
            ),
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
            ),
        );

        $client = $this->getLoaderTestInstance();
        $client->addOptions(array('lang_1' => 'lang_1', 'lang_3' => 'lang_3'));
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_1', 'lang_3' => 'lang_3'));

        $client->addOptions(array('lang_1' => 'lang_2', 'lang_3' => 'lang_3'));
        $this->array($client->getOptions())->isIdenticalTo($defaultOptions + array('lang_1' => 'lang_2', 'lang_3' => 'lang_3'));
    }

    public function test_loadLanguagesConfig_NoLanguagesKey()
    {
        $this->exception(function() {
            $this->getLoaderTestInstance('/config/languages-bad.yml');
        })->hasMessage("No 'languages' key in languages configuration file");
    }
}
