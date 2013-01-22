<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseIdeeWeekendListing;

/**
 * Listing class for 'idee_weekend' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class IdeeWeekendListing extends BaseIdeeWeekendListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('titre'));
        $this->removeColumn('highlight');
        $this->removeColumn('home');
        $this->removeColumn('prix');
        $this->removeColumn('image_path');
    }

} // IdeeWeekendListing
