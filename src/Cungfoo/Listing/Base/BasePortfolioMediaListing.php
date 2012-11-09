<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'portfolio_media' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BasePortfolioMediaListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('name_origin'));
        $this->addColumn(new Column\TextColumn('name'));
        $this->addColumn(new Column\TextColumn('path_origin'));
        $this->addColumn(new Column\TextColumn('path_miniature'));
        $this->addColumn(new Column\TextColumn('size'));
        $this->addColumn(new Column\TextColumn('type'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PortfolioMedia';
    }

} // BasePortfolioMediaListing
