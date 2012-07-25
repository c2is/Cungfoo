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
}