<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'bon_plan' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseBonPlanListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\DateColumn('date_debut'));
        $this->addColumn(new Column\DateColumn('date_fin'));
        $this->addColumn(new Column\TextColumn('image_menu'));
        $this->addColumn(new Column\TextColumn('image_page'));
        $this->addColumn(new Column\TextColumn('image_liste'));
        $this->addColumn(new Column\TextColumn('active_compteur'));
        $this->addColumn(new Column\TextColumn('mise_en_avant'));
        $this->addColumn(new Column\TextColumn('push_home'));
        $this->addColumn(new Column\DateColumn('date_start'));
        $this->addColumn(new Column\TextColumn('period_categories'));
        $this->addColumn(new Column\TextColumn('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'BonPlan';
    }

} // BaseBonPlanListing
