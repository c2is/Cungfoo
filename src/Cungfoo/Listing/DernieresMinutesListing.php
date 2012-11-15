<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseDernieresMinutesListing;

/**
 * Listing class for 'dernieres_minutes' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class DernieresMinutesListing extends BaseDernieresMinutesListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('day_start'));
        $this->addColumn(new Column\TextColumn('day_range'));
        $this->addColumn(new Column\TextColumn('active'));
        $this->addColumn(new Column\TextColumn('day_range'));
    }

} // DernieresMinutesListing
