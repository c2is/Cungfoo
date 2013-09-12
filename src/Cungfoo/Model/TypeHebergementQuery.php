<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseTypeHebergementQuery;


/**
 * Skeleton subclass for performing query and update operations on the 'type_hebergement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class TypeHebergementQuery extends BaseTypeHebergementQuery
{
	public function findWithoutOrderByName($con = null)
	{
		return parent::find($con);
	}
}
