<?php

namespace Cungfoo\Listing\Crud\Base;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

/**
 * Generated listing class for 'camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud.Base
 */
class BaseCampingListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('address'));
        $this->addColumn(new Column\TextColumn('phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Camping';
    }

} // BaseCampingListing
