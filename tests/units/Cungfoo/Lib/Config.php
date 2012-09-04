<?php
namespace tests\units\Cungfoo\Lib;

require_once __DIR__.'/../../../bootstrap.php';

use mageekguy\atoum;
use Cungfoo\Lib;

class Config extends atoum\test
{
    public function testAccessors()
    {
        $config = new Lib\Config('/root');
        
        $this->string($config->rootDir)->isEqualTo('/root');
        $this->string($config->getRootDir())->isEqualTo('/root');
        $this->string($config->get('root_dir'))->isEqualTo('/root');

        $this->exception(function() use ($config) {
            return $config->getRootDir;
        })->hasMessage('Config : unknown param get_root_dir');

        $this->exception(function() use ($config) {
            return $config->rootDir();
        })->hasMessage('Config : unknown function rootDir');
    }

    public function testAddParam()
    {
        $config = new Lib\Config('/root');
        $config->addParam('param_test', 'content with spaces');
        
        $this->string($config->paramTest)->isEqualTo('content with spaces');
        $this->string($config->getParamTest())->isEqualTo('content with spaces');
        $this->string($config->get('param_test'))->isEqualTo('content with spaces');

        $config->addParam('param_test', 'content that overrides the initial value');

        $this->string($config->paramTest)->isEqualTo('content that overrides the initial value');
        $this->string($config->getParamTest())->isEqualTo('content that overrides the initial value');
        $this->string($config->get('param_test'))->isEqualTo('content that overrides the initial value');

    }

    public function testAddParams()
    {
        $config = new Lib\Config('/root');
        $config->addParams(array(
            'param_test' => 'content with spaces',
            'second_param' => 23
        ));
        
        $this->string($config->paramTest)->isEqualTo('content with spaces');
        $this->string($config->getParamTest())->isEqualTo('content with spaces');
        $this->string($config->get('param_test'))->isEqualTo('content with spaces');

        $this->integer($config->secondParam)->isEqualTo(23);
        $this->integer($config->getSecondParam())->isEqualTo(23);
        $this->integer($config->get('second_param'))->isEqualTo(23);
    }
}