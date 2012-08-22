<?php

require_once dirname(__FILE__) . '/CrudableBaseFormTypeBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableFormTypeBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableListingBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableBaseListingBehaviorBuilder.php';

class CrudableBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'route_controller'  => null,
        'route_prefix'      => null,
        'routes_file'       => null,
        'languages_file'    => null,
        'crud_prefix'       => null,
        'crud_model'        => null,
        'crud_form'         => null,
    );

    protected $additionalBuilders = array(
        'CrudableBaseFormTypeBehaviorBuilder',
        'CrudableFormTypeBehaviorBuilder',
        'CrudableListingBehaviorBuilder',
        'CrudableBaseListingBehaviorBuilder',
    );
}