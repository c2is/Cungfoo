<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BasePortfolioMediaListing;

/**
 * Listing class for 'portfolio_media' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class PortfolioMediaListing extends BasePortfolioMediaListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->addColumn(new Column\ImageColumn('file', array('base_path' => $this->getApplication()['request']->getBasePath())));
    }

} // PortfolioMediaListing
