<?php
namespace tests\units\Resalys\Lib;

require_once __DIR__.'/../../../bootstrap.php';

use mageekguy\atoum;
use Resalys\Lib;

class Loader extends atoum\test
{
    protected function getLoaderInstance()
    {
        return new Lib\Loader(array(
            'client_configuration'      => __DIR__.'/client.yml',
            'loader_configuration'      => __DIR__.'/loader.yml',
            'languages_configuration'   => __DIR__.'/languages.yml',
        ));
    }

    public function test__construct()
    {
        { // test parameter does not exist
            try
            {
                $loader = new Lib\Loader();
            }
            catch (\Exception $exception)
            {
                $this->string($exception->getMessage())->isEqualTo('the client_configuration parameter does not exist');
            }
        }

        { // test file does not exist
            try
            {
                $loader = new Lib\Loader(array('client_configuration' => '/file/path/false'));
            }
            catch (\Exception $exception)
            {
                $this->string($exception->getMessage())->isEqualTo('the client_configuration file `/file/path/false` does not exist');
            }
        }

        { // test initial values
            $loader = $this->getLoaderInstance();

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
            $this->array($loader->getLanguageCodes())->isIdenticalTo(array(
                'fr',
                'en',
                'de',
            ));
        }
    }

    public function test_locationAccessors()
    {
        $loader = $this->getLoaderInstance();
        $loader->setLocation('my_location');
        $this->string($loader->getLocation())->isEqualTo('my_location');
    }

    public function test_baseIdAccessors()
    {
        $loader = $this->getLoaderInstance();
        $loader->setBaseId('my_base_id');
        $this->string($loader->getBaseId())->isEqualTo('my_base_id');
    }

    public function test_usernameAccessors()
    {
        $loader = $this->getLoaderInstance();
        $loader->setUsername('my_username');
        $this->string($loader->getUsername())->isEqualTo('my_username');
    }

    public function test_passwordAccessors()
    {
        $loader = $this->getLoaderInstance();
        $loader->setPassword('my_password');
        $this->string($loader->getPassword())->isEqualTo('my_password');
    }

    public function test_requestAccessors()
    {
        { // add one request
            $loader = $this->getLoaderInstance();
            $loader->addRequest('my_request');
            $this->array($loader->getRequests())->isIdenticalTo(array(
                'getAllThemes',
                'getAllRoomTypeCategories',
                'getAllRoomTypes',
                'getAllEtabs',
                'my_request',
            ));
        }

        { // add many requests
            $loader = $this->getLoaderInstance();
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

        { // add one request with reset
            $loader = $this->getLoaderInstance();
            $loader->addRequest('my_request', true);
            $this->array($loader->getRequests())->isIdenticalTo(array(
                'my_request',
            ));
        }

        { // add many requests with reset
            $loader = $this->getLoaderInstance();
            $loader->addRequests(array('my_request1', 'my_request2'), true);
            $this->array($loader->getRequests())->isIdenticalTo(array(
                'my_request1',
                'my_request2',
            ));
        }
    }

    public function test_languageCodeAccessors()
    {
        { // add one language code
            $loader = $this->getLoaderInstance();
            $loader->addLanguageCode('my_language_code');
            $this->array($loader->getLanguageCodes())->isIdenticalTo(array(
                'fr',
                'en',
                'de',
                'my_language_code',
            ));
        }

        { // add many language codes
            $loader = $this->getLoaderInstance();
            $loader->addLanguageCodes(array('my_language_code1', 'my_language_code2'));
            $this->array($loader->getLanguageCodes())->isIdenticalTo(array(
                'fr',
                'en',
                'de',
                'my_language_code1',
                'my_language_code2',
            ));
        }

        { // add one language code with reset
            $loader = $this->getLoaderInstance();
            $loader->addLanguageCode('my_language_code', true);
            $this->array($loader->getLanguageCodes())->isIdenticalTo(array(
                'my_language_code',
            ));
        }

        { // add many language codes with reset
            $loader = $this->getLoaderInstance();
            $loader->addLanguageCodes(array('my_language_code1', 'my_language_code2'), true);
            $this->array($loader->getLanguageCodes())->isIdenticalTo(array(
                'my_language_code1',
                'my_language_code2',
            ));
        }
    }
}