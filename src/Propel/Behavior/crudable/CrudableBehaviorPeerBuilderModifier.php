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
class CrudableBehaviorPeerBuilderModifier
{
    protected $behavior;

    public function __construct($behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * Static methods
     *
     * @return string
     */
    public function staticMethods($builder)
    {
        $peerClassname = $builder->getStubPeerBuilder()->getClassname();
        $namespace     = $builder->getStubObjectBuilder()->getNamespace();

        return "
/**
 * The default locale to use for translations
 * @var        string
 */
public static function getMetadata(PropelPDO \$con = null)
{
    return \\".$namespace."\\MetadataQuery::create()
        ->joinWithI18n()
        ->filterByTableRef(".$peerClassname."::TABLE_NAME)
        ->findOne()
    ;
}";
    }
}
