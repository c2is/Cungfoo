<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseBonPlanListing;

/**
 * Listing class for 'bon_plan' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class BonPlanListing extends BaseBonPlanListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->removeColumn('date_debut');
        $this->removeColumn('date_fin');
        $this->removeColumn('image_menu');
        $this->removeColumn('image_page');
        $this->removeColumn('image_liste');
        $this->removeColumn('active_compteur');
        $this->removeColumn('mise_en_avant');
        $this->removeColumn('push_home');
        $this->removeColumn('date_start');
        $this->removeColumn('period_categories');
        $this->addColumn(new Column\TextColumn('name'));
    }

} // BonPlanListing
