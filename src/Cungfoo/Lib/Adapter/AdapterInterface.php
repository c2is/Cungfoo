<?php

namespace Cungfoo\Lib\Adapter;

interface AdapterInterface
{
    public function invoke($name, array $args = array());
}
