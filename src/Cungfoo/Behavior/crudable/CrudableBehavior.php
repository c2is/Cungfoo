<?php

require_once dirname(__FILE__) . '/CrudableBaseFormTypeBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableFormTypeBehaviorBuilder.php';

class CrudableBehavior extends Behavior
{
    protected $additionalBuilders = array(
        'CrudableBaseFormTypeBehaviorBuilder',
        'CrudableFormTypeBehaviorBuilder',
    );
}