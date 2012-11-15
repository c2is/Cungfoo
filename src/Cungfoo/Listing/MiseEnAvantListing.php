<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseMiseEnAvantListing;

/**
 * Listing class for 'mise_en_avant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class MiseEnAvantListing extends BaseMiseEnAvantListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('titre'));
        $this->addColumn(new Column\TextColumn('accroche'));
        $this->addColumn(new Column\TextColumn('prix'));
    }

} // MiseEnAvantListing
