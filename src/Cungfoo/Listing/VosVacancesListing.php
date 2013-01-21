<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseVosVacancesListing;

/**
 * Listing class for 'vos_vacances' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class VosVacancesListing extends BaseVosVacancesListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('titre'));
        $this->addColumn(new Column\TextColumn('description'));
        $this->removeColumn('image_path');
        $this->removeColumn('age');
    }

} // VosVacancesListing
