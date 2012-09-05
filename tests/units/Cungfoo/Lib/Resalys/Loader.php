<?php
namespace tests\units\Cungfoo\Lib\Resalys;

require_once __DIR__.'/../../../../bootstrap.php';

use mageekguy\atoum;
use Cungfoo\Lib\Resalys;

class Loader extends atoum\test
{
    protected function getLoaderTestInstance()
    {
        return new Resalys\Loader(array(
            'client_configuration'      => __DIR__.'/config/client.yml',
            'loader_configuration'      => __DIR__.'/config/loader.yml',
            'languages_configuration'   => __DIR__.'/config/languages.yml',
        ));
    }

    public function test__construct_NoParameter()
    {
        $this->exception(function() {
            new Resalys\Loader();
        })->hasMessage('the client_configuration parameter does not exist');
    }

    public function test__construct_FileDoesNotExist()
    {
        $this->exception(function() {
            new Resalys\Loader(array('client_configuration' => '/file/path/false'));
        })->hasMessage('the client_configuration file `/file/path/false` does not exist');
    }

    public function test__construct_DefaultValues()
    {
        $loader = $this->getLoaderTestInstance();

        $this->string($loader->getLocation())->isEqualTo("wsdl_service_location");
        $this->string($loader->getBaseId())->isEqualTo("base_id_resalys");
        $this->variable($loader->getUsername())->isNull();
        $this->variable($loader->getPassword())->isNull();
        $this->array($loader->getRequests())->isIdenticalTo(array(
            'getAllThemes',
            'getAllRoomTypeCategories',
            'getAllRoomTypes',
            'getAllEtabs',
        ));
        $this->array($loader->getLanguageCodes())->isIdenticalTo(array('fr', 'en', 'de'));
    }

    public function test_locationAccessors()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->setLocation('my_location');
        $this->string($loader->getLocation())->isEqualTo('my_location');
    }

    public function test_baseIdAccessors()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->setBaseId('my_base_id');
        $this->string($loader->getBaseId())->isEqualTo('my_base_id');
    }

    public function test_usernameAccessors()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->setUsername('my_username');
        $this->string($loader->getUsername())->isEqualTo('my_username');
    }

    public function test_passwordAccessors()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->setPassword('my_password');
        $this->string($loader->getPassword())->isEqualTo('my_password');
    }

    public function test_addRequest()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addRequest('my_request');
        $this->array($loader->getRequests())->isIdenticalTo(array(
            'getAllThemes',
            'getAllRoomTypeCategories',
            'getAllRoomTypes',
            'getAllEtabs',
            'my_request',
        ));
    }

    public function test_addRequest_WithReset()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addRequest('request_1', true);
        $this->array($loader->getRequests())->isIdenticalTo(array('request_1'));
    }

    public function test_addRequests()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addRequests(array('my_request1', 'my_request2'));
        $this->array($loader->getRequests())->isIdenticalTo(array(
            'getAllThemes',
            'getAllRoomTypeCategories',
            'getAllRoomTypes',
            'getAllEtabs',
            'my_request1',
            'my_request2',
        ));
    }

    public function test_addRequests_WithReset()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addRequests(array('request_1', 'request_2'), true);
        $this->array($loader->getRequests())->isIdenticalTo(array('request_1', 'request_2'));
    }

    public function test_addLanguageCode()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addLanguageCode('lang_1');
        $this->array($loader->getLanguageCodes())->isIdenticalTo(array('fr', 'en', 'de', 'lang_1'));
    }

    public function test_addLanguageCode_WithReset()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addLanguageCode('lang_1', true);
        $this->array($loader->getLanguageCodes())->isIdenticalTo(array('lang_1'));
    }

    public function test_addLanguageCodes()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addLanguageCodes(array('lang_1', 'lang_2'));
        $this->array($loader->getLanguageCodes())->isIdenticalTo(array('fr', 'en', 'de', 'lang_1', 'lang_2'));
    }

    public function test_addLanguageCodes_WithReset()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->addLanguageCodes(array('lang_1', 'lang_2'), true);
        $this->array($loader->getLanguageCodes())->isIdenticalTo(array('lang_1', 'lang_2'));
    }

    public function test_loadClientConfig()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->loadClientConfig(__DIR__.'/config/client.yml');

        $this->string($loader->getLocation())->isEqualTo('wsdl_service_location');
        $this->string($loader->getBaseId())->isEqualTo('base_id_resalys');
     }

    public function test_loadClientConfig_NoClientKey()
    {
        $loader = $this->getLoaderTestInstance();

        $this->exception(function() use ($loader) {
            $loader->loadClientConfig(__DIR__.'/config/client-bad.yml');
        })->hasMessage("No 'client' key in client configuration file : ".__DIR__.'/config/client-bad.yml');
     }

    public function test_loadLanguagesConfig_NoLanguagesKey()
    {
        $loader = $this->getLoaderTestInstance();

        $this->exception(function() use ($loader) {
            $loader->loadLanguagesConfig(__DIR__.'/config/languages-bad.yml');
        })->hasMessage("No 'languages' key in languages configuration file : ".__DIR__.'/config/languages-bad.yml');
    }

    public function test_loadLanguagesConfig()
    {
        $loader = $this->getLoaderTestInstance();
        $loader->loadLanguagesConfig(__DIR__.'/config/languages.yml');

        $this->array($loader->getLanguageCodes())->isIdenticalTo(array('fr', 'en', 'de'));
     }
}