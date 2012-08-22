<?php

namespace Cungfoo\Listing\Crud\Base;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

/**
 * Generated listing class for 'camping_i18n' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud.Base
 */
class BaseCampingI18nListing extends Listing
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
        $this->addColumn(new Column\TextColumn('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CampingI18n';
    }

} // BaseCampingI18nListing
