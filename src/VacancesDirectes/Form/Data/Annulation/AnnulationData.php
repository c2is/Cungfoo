<?php

namespace VacancesDirectes\Form\Data\Annulation;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class AnnulationData
{
    public $nomAssure;
    public $prenomAssure;
    public $adresseAssure;
    public $codePostalAssure;
    public $villeAssure;
    public $paysAssure;
    public $emailAssure;
    public $telephone;
    public $montantSejourCamping;
    public $montantVerseCamping;
    public $nomCamping;
    public $departementCamping;
    public $numResaCamping;
    public $natureSinistre;
    public $suiteSinistre;
    public $dateSinistre = '';
    public $resumeSinistre;
    public $piecesJointes;
}
