<?php

namespace Cungfoo\Listing\Crud\Base;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

/**
 * Generated listing class for 'site' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud.Base
 */
class BaseSiteListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Site';
    }

} // BaseSiteListing
