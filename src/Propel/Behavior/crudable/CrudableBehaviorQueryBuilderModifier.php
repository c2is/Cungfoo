<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

/**
 * Allows translation of text columns through transparent one-to-many relationship.
 * Modifier for the peer builder.
 *
 * @author     François Zaninotto
 * @version    $Revision$
 * @package    propel.generator.behavior.i18n
 */
class CrudableBehaviorQueryBuilderModifier
{
    protected $behavior;

    public function __construct($behavior)
    {
        $this->behavior = $behavior;
        $this->table    = $this->behavior->getTable();
    }

    public function queryMethods()
    {
        $output = '';

        if ($this->behavior->getParameter('crud_search'))
        {
            $output .= $this->addTermQuery();
        }

        return $output;
    }

    public function addTermQuery()
    {
        $fields = explode(',', $this->behavior->getParameter('crud_search'));

        $output = "
public function filterByTerm(\$term)
{
    \$term = '%' . \$term . '%';

    return \$this";

    $i18nColumns = '';
    if ($this->table->hasBehavior('i18n'))
    {
        $i18nColumns = $this->table->getBehavior('i18n')->getParameter('i18n_columns');
    }

    foreach ($fields as $field)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $fieldName = $utils->camelize(trim($field));

        $output .= "
        ->_or()";

        if (false !== strpos($i18nColumns, $field))
        {
            $output .= "
        ->useI18nQuery()";
        }

        $output .= "
        ->filterBy$fieldName(\$term, \Criteria::LIKE)";

        if (false !== strpos($i18nColumns, $field))
        {
            $output .= "
        ->endUse()";
        }
    }

    $output .="
    ;
}";

    return $output;
    }
}
