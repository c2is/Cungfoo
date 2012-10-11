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

    public function testDecimalToDmsWithBadParams()
    {
        $this->exception(function() {
            $utils = new Lib\Utils();
            $utils->decimalToDms('toto', 'tata');
       });
    }

    public function testDecimalToDmsWithCorrectParams()
    {
        $utils = new Lib\Utils();

        $dms = $utils->decimalToDms(46.8080605, -2.10465431);

        $this
            ->array($dms)->hasSize(2)
            ->array($dms["latitude"])->hasSize(3)
            ->integer($dms["latitude"]["d"])->isEqualTo(46)
            ->integer($dms["latitude"]["m"])->isEqualTo(48)
            ->float($dms["latitude"]["s"])->isNearlyEqualTo(29.0196, 0.002)
            ->array($dms["longitude"])->hasSize(3)
            ->integer($dms["longitude"]["d"])->isEqualTo(-2)
            ->integer($dms["longitude"]["m"])->isEqualTo(6)
            ->float($dms["longitude"]["s"])->isNearlyEqualTo(16.7544, 0.002)
        ;

        $dms = $utils->decimalToDms(45.7750889, 6.226780415);

        $this
            ->array($dms)->hasSize(2)
            ->array($dms["latitude"])->hasSize(3)
            ->integer($dms["latitude"]["d"])->isEqualTo(45)
            ->integer($dms["latitude"]["m"])->isEqualTo(46)
            ->float($dms["latitude"]["s"])->isNearlyEqualTo(30.3204, 0.002)
            ->array($dms["longitude"])->hasSize(3)
            ->integer($dms["longitude"]["d"])->isEqualTo(6)
            ->integer($dms["longitude"]["m"])->isEqualTo(13)
            ->float($dms["longitude"]["s"])->isNearlyEqualTo(36.4074, 0.002)
        ;
    }
}