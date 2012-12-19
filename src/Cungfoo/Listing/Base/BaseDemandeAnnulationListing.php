<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'demande_annulation' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseDemandeAnnulationListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('assure_nom'));
        $this->addColumn(new Column\TextColumn('assure_prenom'));
        $this->addColumn(new Column\TextColumn('assure_code_postal'));
        $this->addColumn(new Column\TextColumn('assure_ville'));
        $this->addColumn(new Column\TextColumn('assure_pays'));
        $this->addColumn(new Column\TextColumn('assure_mail'));
        $this->addColumn(new Column\TextColumn('assure_telephone'));
        $this->addColumn(new Column\TextColumn('montant_sejour_camping'));
        $this->addColumn(new Column\TextColumn('montant_verse_camping'));
        $this->addColumn(new Column\TextColumn('camping_num_resa'));
        $this->addColumn(new Column\TextColumn('sinistre_date'));
        $this->addColumn(new Column\TextColumn('sinistre_resume'));
        $this->addColumn(new Column\TextColumn('file_1'));
        $this->addColumn(new Column\TextColumn('file_2'));
        $this->addColumn(new Column\TextColumn('file_3'));
        $this->addColumn(new Column\TextColumn('file_4'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DemandeAnnulation';
    }

} // BaseDemandeAnnulationListing
