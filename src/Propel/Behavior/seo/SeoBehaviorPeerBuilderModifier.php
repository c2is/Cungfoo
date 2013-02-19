<?php

class SeoBehaviorPeerBuilderModifier
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
public static function getSeo(\$locale = 'fr', PropelPDO \$con = null)
{
    return \\".$namespace."\\SeoQuery::create()
        ->joinWithI18n(\$locale)
        ->filterByTableRef(".$peerClassname."::TABLE_NAME)
        ->findOne()
    ;
}";
    }
}
