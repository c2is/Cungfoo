<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'camping_service_complementaire' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseCampingServiceComplementaireListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('camping_id'));
        $this->addColumn(new Column\TextColumn('service_complementaire_id'));
        $this->addColumn(new Column\TextColumn('service_complementaire_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CampingServiceComplementaire';
    }

} // BaseCampingServiceComplementaireListing
