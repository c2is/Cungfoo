<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'camping_activite' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseCampingActiviteListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('camping_id'));
        $this->addColumn(new Column\TextColumn('activite_id'));
        $this->addColumn(new Column\TextColumn('activite_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CampingActivite';
    }

} // BaseCampingActiviteListing
