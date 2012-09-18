<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseSituationGeographiqueListing;

/**
 * Listing class for 'situation_geographique' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class SituationGeographiqueListing extends BaseSituationGeographiqueListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->addColumn(new Column\TextColumn('name'));
    }

} // SituationGeographiqueListing
