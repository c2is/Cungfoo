<?php
namespace tests\units\Cungfoo\Lib;

require_once __DIR__.'/../../../bootstrap.php';

use mageekguy\atoum;
use Cungfoo\Lib;

class Utils extends atoum\test
{
    public function testDummy()
    {
        $utils = new Lib\Utils();
        $this->string($utils->dummy())->isEqualTo('dummy');
    }

    public function testUnderscore()
    {
        $utils = new Lib\Utils();

        $this
            ->string($utils->underscore('DummyString Word1-2'))->isEqualTo('dummy_string word1-2')
            ->string($utils->underscore('dummy_string Word1-2'))->isEqualTo('dummy.string word1-2')
            ->string($utils->underscore('Dummy String Word1-2'))->isEqualTo('dummy string word1-2')
        ;
    }

    public function testCamelize()
    {
        $utils = new Lib\Utils();

        $this
            ->string($utils->camelize('dummy_string word1-2'))->isEqualTo('DummyString word1-2')
            ->string($utils->camelize('dummy.string word1-2'))->isEqualTo('Dummy_String word1-2')
            ->string($utils->camelize('dummy string word1-2'))->isEqualTo('Dummy string word1-2')
        ;
    }
}