<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseThematiqueListing;

/**
 * Listing class for 'thematique' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class ThematiqueListing extends BaseThematiqueListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->addColumn(new Column\TextColumn('name'));
    }

} // ThematiqueListing
