<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'demande_identifiant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseDemandeIdentifiantListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('societe_nom'));
        $this->addColumn(new Column\TextColumn('societe_adresse_1'));
        $this->addColumn(new Column\TextColumn('societe_adresse_2'));
        $this->addColumn(new Column\TextColumn('societe_adresse_3'));
        $this->addColumn(new Column\TextColumn('societe_adresse_4'));
        $this->addColumn(new Column\TextColumn('societe_telephone'));
        $this->addColumn(new Column\TextColumn('societe_fax'));
        $this->addColumn(new Column\TextColumn('contact_prenom'));
        $this->addColumn(new Column\TextColumn('contact_nom'));
        $this->addColumn(new Column\TextColumn('contact_telephone'));
        $this->addColumn(new Column\TextColumn('contact_mail'));
        $this->addColumn(new Column\TextColumn('permanence'));
        $this->addColumn(new Column\TextColumn('permanence_matin_de'));
        $this->addColumn(new Column\TextColumn('permanence_matin_a'));
        $this->addColumn(new Column\TextColumn('permanence_apres_midi_de'));
        $this->addColumn(new Column\TextColumn('permanence_apres_midi_a'));
        $this->addColumn(new Column\TextColumn('client_vc_code'));
        $this->addColumn(new Column\TextColumn('client_vd_code'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DemandeIdentifiant';
    }

} // BaseDemandeIdentifiantListing
