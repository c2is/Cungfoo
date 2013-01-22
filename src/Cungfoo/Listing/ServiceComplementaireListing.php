<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseServiceComplementaireListing;

/**
 * Listing class for 'service_complementaire' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class ServiceComplementaireListing extends BaseServiceComplementaireListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('name'));
        $this->removeColumn('image_path');
        $this->removeColumn('vignette');
    }

} // ServiceComplementaireListing
