<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'mise_en_avant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseMiseEnAvantListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('prix'));
        $this->addColumn(new Column\DateColumn('date_fin_validite'));
        $this->addColumn(new Column\TextColumn('enabled'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'MiseEnAvant';
    }

} // BaseMiseEnAvantListing
