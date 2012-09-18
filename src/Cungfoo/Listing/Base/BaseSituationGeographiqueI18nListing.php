<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'situation_geographique_i18n' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseSituationGeographiqueI18nListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('locale'));
        $this->addColumn(new Column\TextColumn('locale'));
        $this->addColumn(new Column\TextColumn('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SituationGeographiqueI18n';
    }

} // BaseSituationGeographiqueI18nListing
