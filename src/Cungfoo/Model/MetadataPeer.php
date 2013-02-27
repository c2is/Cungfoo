<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseMetadataPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'metadata' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class MetadataPeer extends BaseMetadataPeer
{
    public static function get($name, $value = null)
    {
        global $app;

        return MetadataQuery::create()
            ->filterByTableRef($name)
            ->joinWithI18n($app['context']->get('language'))
            ->_if($value)
            ->withColumn($value)
            ->select($value)
            ->_endif()
            ->findOne()
        ;
    }
}
