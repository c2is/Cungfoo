<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Cungfoo\Model\Activite;
use Cungfoo\Model\ActiviteQuery;
use Cungfoo\Model\Baignade;
use Cungfoo\Model\BaignadeQuery;
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanEtablissement;
use Cungfoo\Model\BonPlanEtablissementQuery;
use Cungfoo\Model\BonPlanQuery;
use Cungfoo\Model\Categorie;
use Cungfoo\Model\CategorieQuery;
use Cungfoo\Model\DemandeAnnulation;
use Cungfoo\Model\DemandeAnnulationQuery;
use Cungfoo\Model\Departement;
use Cungfoo\Model\DepartementQuery;
use Cungfoo\Model\Destination;
use Cungfoo\Model\DestinationQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementActivite;
use Cungfoo\Model\EtablissementActiviteQuery;
use Cungfoo\Model\EtablissementBaignade;
use Cungfoo\Model\EtablissementBaignadeQuery;
use Cungfoo\Model\EtablissementDestination;
use Cungfoo\Model\EtablissementDestinationQuery;
use Cungfoo\Model\EtablissementEvent;
use Cungfoo\Model\EtablissementEventQuery;
use Cungfoo\Model\EtablissementI18n;
use Cungfoo\Model\EtablissementI18nQuery;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\EtablissementPointInteret;
use Cungfoo\Model\EtablissementPointInteretQuery;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementServiceComplementaire;
use Cungfoo\Model\EtablissementServiceComplementaireQuery;
use Cungfoo\Model\EtablissementSituationGeographique;
use Cungfoo\Model\EtablissementSituationGeographiqueQuery;
use Cungfoo\Model\EtablissementThematique;
use Cungfoo\Model\EtablissementThematiqueQuery;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\EtablissementTypeHebergementQuery;
use Cungfoo\Model\Event;
use Cungfoo\Model\EventQuery;
use Cungfoo\Model\Personnage;
use Cungfoo\Model\PersonnageQuery;
use Cungfoo\Model\PointInteret;
use Cungfoo\Model\PointInteretQuery;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\ServiceComplementaireQuery;
use Cungfoo\Model\SituationGeographique;
use Cungfoo\Model\SituationGeographiqueQuery;
use Cungfoo\Model\Thematique;
use Cungfoo\Model\ThematiqueQuery;
use Cungfoo\Model\TopCamping;
use Cungfoo\Model\TopCampingQuery;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementQuery;
use Cungfoo\Model\Ville;
use Cungfoo\Model\VilleQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'etablissement' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\EtablissementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EtablissementPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the code field.
     * @var        int
     */
    protected $code;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the address1 field.
     * @var        string
     */
    protected $address1;

    /**
     * The value for the address2 field.
     * @var        string
     */
    protected $address2;

    /**
     * The value for the zip field.
     * @var        string
     */
    protected $zip;

    /**
     * The value for the city field.
     * @var        string
     */
    protected $city;

    /**
     * The value for the mail field.
     * @var        string
     */
    protected $mail;

    /**
     * The value for the country_code field.
     * @var        string
     */
    protected $country_code;

    /**
     * The value for the phone1 field.
     * @var        string
     */
    protected $phone1;

    /**
     * The value for the phone2 field.
     * @var        string
     */
    protected $phone2;

    /**
     * The value for the fax field.
     * @var        string
     */
    protected $fax;

    /**
     * The value for the opening_date field.
     * @var        string
     */
    protected $opening_date;

    /**
     * The value for the closing_date field.
     * @var        string
     */
    protected $closing_date;

    /**
     * The value for the ville_id field.
     * @var        int
     */
    protected $ville_id;

    /**
     * The value for the departement_id field.
     * @var        int
     */
    protected $departement_id;

    /**
     * The value for the categorie_id field.
     * @var        int
     */
    protected $categorie_id;

    /**
     * The value for the geo_coordinate_x field.
     * @var        string
     */
    protected $geo_coordinate_x;

    /**
     * The value for the geo_coordinate_y field.
     * @var        string
     */
    protected $geo_coordinate_y;

    /**
     * The value for the video_path field.
     * @var        string
     */
    protected $video_path;

    /**
     * The value for the image_360_path field.
     * @var        string
     */
    protected $image_360_path;

    /**
     * The value for the capacite field.
     * @var        string
     */
    protected $capacite;

    /**
     * The value for the related_1 field.
     * @var        int
     */
    protected $related_1;

    /**
     * The value for the related_2 field.
     * @var        int
     */
    protected $related_2;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        Ville
     */
    protected $aVille;

    /**
     * @var        Departement
     */
    protected $aDepartement;

    /**
     * @var        Categorie
     */
    protected $aCategorie;

    /**
     * @var        Etablissement
     */
    protected $aEtablissementRelatedByRelated1;

    /**
     * @var        Etablissement
     */
    protected $aEtablissementRelatedByRelated2;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissementsRelatedById0;
    protected $collEtablissementsRelatedById0Partial;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissementsRelatedById1;
    protected $collEtablissementsRelatedById1Partial;

    /**
     * @var        PropelObjectCollection|EtablissementTypeHebergement[] Collection to store aggregation of EtablissementTypeHebergement objects.
     */
    protected $collEtablissementTypeHebergements;
    protected $collEtablissementTypeHebergementsPartial;

    /**
     * @var        PropelObjectCollection|EtablissementDestination[] Collection to store aggregation of EtablissementDestination objects.
     */
    protected $collEtablissementDestinations;
    protected $collEtablissementDestinationsPartial;

    /**
     * @var        PropelObjectCollection|EtablissementActivite[] Collection to store aggregation of EtablissementActivite objects.
     */
    protected $collEtablissementActivites;
    protected $collEtablissementActivitesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementServiceComplementaire[] Collection to store aggregation of EtablissementServiceComplementaire objects.
     */
    protected $collEtablissementServiceComplementaires;
    protected $collEtablissementServiceComplementairesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementSituationGeographique[] Collection to store aggregation of EtablissementSituationGeographique objects.
     */
    protected $collEtablissementSituationGeographiques;
    protected $collEtablissementSituationGeographiquesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementBaignade[] Collection to store aggregation of EtablissementBaignade objects.
     */
    protected $collEtablissementBaignades;
    protected $collEtablissementBaignadesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementThematique[] Collection to store aggregation of EtablissementThematique objects.
     */
    protected $collEtablissementThematiques;
    protected $collEtablissementThematiquesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementPointInteret[] Collection to store aggregation of EtablissementPointInteret objects.
     */
    protected $collEtablissementPointInterets;
    protected $collEtablissementPointInteretsPartial;

    /**
     * @var        PropelObjectCollection|EtablissementEvent[] Collection to store aggregation of EtablissementEvent objects.
     */
    protected $collEtablissementEvents;
    protected $collEtablissementEventsPartial;

    /**
     * @var        PropelObjectCollection|Personnage[] Collection to store aggregation of Personnage objects.
     */
    protected $collPersonnages;
    protected $collPersonnagesPartial;

    /**
     * @var        PropelObjectCollection|TopCamping[] Collection to store aggregation of TopCamping objects.
     */
    protected $collTopCampings;
    protected $collTopCampingsPartial;

    /**
     * @var        PropelObjectCollection|BonPlanEtablissement[] Collection to store aggregation of BonPlanEtablissement objects.
     */
    protected $collBonPlanEtablissements;
    protected $collBonPlanEtablissementsPartial;

    /**
     * @var        PropelObjectCollection|DemandeAnnulation[] Collection to store aggregation of DemandeAnnulation objects.
     */
    protected $collDemandeAnnulations;
    protected $collDemandeAnnulationsPartial;

    /**
     * @var        PropelObjectCollection|EtablissementI18n[] Collection to store aggregation of EtablissementI18n objects.
     */
    protected $collEtablissementI18ns;
    protected $collEtablissementI18nsPartial;

    /**
     * @var        PropelObjectCollection|TypeHebergement[] Collection to store aggregation of TypeHebergement objects.
     */
    protected $collTypeHebergements;

    /**
     * @var        PropelObjectCollection|Destination[] Collection to store aggregation of Destination objects.
     */
    protected $collDestinations;

    /**
     * @var        PropelObjectCollection|Activite[] Collection to store aggregation of Activite objects.
     */
    protected $collActivites;

    /**
     * @var        PropelObjectCollection|ServiceComplementaire[] Collection to store aggregation of ServiceComplementaire objects.
     */
    protected $collServiceComplementaires;

    /**
     * @var        PropelObjectCollection|SituationGeographique[] Collection to store aggregation of SituationGeographique objects.
     */
    protected $collSituationGeographiques;

    /**
     * @var        PropelObjectCollection|Baignade[] Collection to store aggregation of Baignade objects.
     */
    protected $collBaignades;

    /**
     * @var        PropelObjectCollection|Thematique[] Collection to store aggregation of Thematique objects.
     */
    protected $collThematiques;

    /**
     * @var        PropelObjectCollection|PointInteret[] Collection to store aggregation of PointInteret objects.
     */
    protected $collPointInterets;

    /**
     * @var        PropelObjectCollection|Event[] Collection to store aggregation of Event objects.
     */
    protected $collEvents;

    /**
     * @var        PropelObjectCollection|BonPlan[] Collection to store aggregation of BonPlan objects.
     */
    protected $collBonPlans;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'fr';

    /**
     * Current translation objects
     * @var        array[EtablissementI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeHebergementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $destinationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $activitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $serviceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $situationGeographiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $baignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $thematiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pointInteretsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $eventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementsRelatedById0ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementsRelatedById1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementTypeHebergementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementDestinationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementActivitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementServiceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementSituationGeographiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementBaignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementThematiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementPointInteretsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $personnagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $topCampingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanEtablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $demandeAnnulationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementI18nsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->active = false;
    }

    /**
     * Initializes internal state of BaseEtablissement object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [code] column value.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug ?: 'n-a';
    }


    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [address1] column value.
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Get the [address2] column value.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Get the [zip] column value.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the [country_code] column value.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Get the [phone1] column value.
     *
     * @return string
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Get the [phone2] column value.
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Get the [fax] column value.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Get the [optionally formatted] temporal [opening_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getOpeningDate($format = null)
    {
        if ($this->opening_date === null) {
            return null;
        }

        if ($this->opening_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->opening_date);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->opening_date, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [closing_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getClosingDate($format = null)
    {
        if ($this->closing_date === null) {
            return null;
        }

        if ($this->closing_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->closing_date);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->closing_date, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [ville_id] column value.
     *
     * @return int
     */
    public function getVilleId()
    {
        return $this->ville_id;
    }

    /**
     * Get the [departement_id] column value.
     *
     * @return int
     */
    public function getDepartementId()
    {
        return $this->departement_id;
    }

    /**
     * Get the [categorie_id] column value.
     *
     * @return int
     */
    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    /**
     * Get the [geo_coordinate_x] column value.
     *
     * @return string
     */
    public function getGeoCoordinateX()
    {
        return $this->geo_coordinate_x;
    }

    /**
     * Get the [geo_coordinate_y] column value.
     *
     * @return string
     */
    public function getGeoCoordinateY()
    {
        return $this->geo_coordinate_y;
    }

    /**
     * Get the [video_path] column value.
     *
     * @return string
     */
    public function getVideoPath()
    {
        return $this->video_path;
    }

    /**
     * Get the [image_360_path] column value.
     *
     * @return string
     */
    public function getImage360Path()
    {
        return $this->image_360_path;
    }

    /**
     * Get the [capacite] column value.
     *
     * @return string
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Get the [related_1] column value.
     *
     * @return int
     */
    public function getRelated1()
    {
        return $this->related_1;
    }

    /**
     * Get the [related_2] column value.
     *
     * @return int
     */
    public function getRelated2()
    {
        return $this->related_2;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = null)
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = null)
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EtablissementPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = EtablissementPeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = EtablissementPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = EtablissementPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = EtablissementPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [address1] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address1 !== $v) {
            $this->address1 = $v;
            $this->modifiedColumns[] = EtablissementPeer::ADDRESS1;
        }


        return $this;
    } // setAddress1()

    /**
     * Set the value of [address2] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[] = EtablissementPeer::ADDRESS2;
        }


        return $this;
    } // setAddress2()

    /**
     * Set the value of [zip] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setZip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip !== $v) {
            $this->zip = $v;
            $this->modifiedColumns[] = EtablissementPeer::ZIP;
        }


        return $this;
    } // setZip()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = EtablissementPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[] = EtablissementPeer::MAIL;
        }


        return $this;
    } // setMail()

    /**
     * Set the value of [country_code] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCountryCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country_code !== $v) {
            $this->country_code = $v;
            $this->modifiedColumns[] = EtablissementPeer::COUNTRY_CODE;
        }


        return $this;
    } // setCountryCode()

    /**
     * Set the value of [phone1] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setPhone1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone1 !== $v) {
            $this->phone1 = $v;
            $this->modifiedColumns[] = EtablissementPeer::PHONE1;
        }


        return $this;
    } // setPhone1()

    /**
     * Set the value of [phone2] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setPhone2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone2 !== $v) {
            $this->phone2 = $v;
            $this->modifiedColumns[] = EtablissementPeer::PHONE2;
        }


        return $this;
    } // setPhone2()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[] = EtablissementPeer::FAX;
        }


        return $this;
    } // setFax()

    /**
     * Sets the value of [opening_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setOpeningDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->opening_date !== null || $dt !== null) {
            $currentDateAsString = ($this->opening_date !== null && $tmpDt = new DateTime($this->opening_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->opening_date = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::OPENING_DATE;
            }
        } // if either are not null


        return $this;
    } // setOpeningDate()

    /**
     * Sets the value of [closing_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setClosingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->closing_date !== null || $dt !== null) {
            $currentDateAsString = ($this->closing_date !== null && $tmpDt = new DateTime($this->closing_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->closing_date = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::CLOSING_DATE;
            }
        } // if either are not null


        return $this;
    } // setClosingDate()

    /**
     * Set the value of [ville_id] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setVilleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ville_id !== $v) {
            $this->ville_id = $v;
            $this->modifiedColumns[] = EtablissementPeer::VILLE_ID;
        }

        if ($this->aVille !== null && $this->aVille->getId() !== $v) {
            $this->aVille = null;
        }


        return $this;
    } // setVilleId()

    /**
     * Set the value of [departement_id] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setDepartementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->departement_id !== $v) {
            $this->departement_id = $v;
            $this->modifiedColumns[] = EtablissementPeer::DEPARTEMENT_ID;
        }

        if ($this->aDepartement !== null && $this->aDepartement->getId() !== $v) {
            $this->aDepartement = null;
        }


        return $this;
    } // setDepartementId()

    /**
     * Set the value of [categorie_id] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCategorieId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->categorie_id !== $v) {
            $this->categorie_id = $v;
            $this->modifiedColumns[] = EtablissementPeer::CATEGORIE_ID;
        }

        if ($this->aCategorie !== null && $this->aCategorie->getId() !== $v) {
            $this->aCategorie = null;
        }


        return $this;
    } // setCategorieId()

    /**
     * Set the value of [geo_coordinate_x] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setGeoCoordinateX($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_x !== $v) {
            $this->geo_coordinate_x = $v;
            $this->modifiedColumns[] = EtablissementPeer::GEO_COORDINATE_X;
        }


        return $this;
    } // setGeoCoordinateX()

    /**
     * Set the value of [geo_coordinate_y] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setGeoCoordinateY($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_y !== $v) {
            $this->geo_coordinate_y = $v;
            $this->modifiedColumns[] = EtablissementPeer::GEO_COORDINATE_Y;
        }


        return $this;
    } // setGeoCoordinateY()

    /**
     * Set the value of [video_path] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setVideoPath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_path !== $v) {
            $this->video_path = $v;
            $this->modifiedColumns[] = EtablissementPeer::VIDEO_PATH;
        }


        return $this;
    } // setVideoPath()

    /**
     * Set the value of [image_360_path] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setImage360Path($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_360_path !== $v) {
            $this->image_360_path = $v;
            $this->modifiedColumns[] = EtablissementPeer::IMAGE_360_PATH;
        }


        return $this;
    } // setImage360Path()

    /**
     * Set the value of [capacite] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCapacite($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->capacite !== $v) {
            $this->capacite = $v;
            $this->modifiedColumns[] = EtablissementPeer::CAPACITE;
        }


        return $this;
    } // setCapacite()

    /**
     * Set the value of [related_1] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setRelated1($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->related_1 !== $v) {
            $this->related_1 = $v;
            $this->modifiedColumns[] = EtablissementPeer::RELATED_1;
        }

        if ($this->aEtablissementRelatedByRelated1 !== null && $this->aEtablissementRelatedByRelated1->getId() !== $v) {
            $this->aEtablissementRelatedByRelated1 = null;
        }


        return $this;
    } // setRelated1()

    /**
     * Set the value of [related_2] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setRelated2($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->related_2 !== $v) {
            $this->related_2 = $v;
            $this->modifiedColumns[] = EtablissementPeer::RELATED_2;
        }

        if ($this->aEtablissementRelatedByRelated2 !== null && $this->aEtablissementRelatedByRelated2->getId() !== $v) {
            $this->aEtablissementRelatedByRelated2 = null;
        }


        return $this;
    } // setRelated2()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = EtablissementPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->active !== false) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->code = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->slug = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->title = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->address1 = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->address2 = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->zip = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->city = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->mail = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->country_code = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->phone1 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->phone2 = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->fax = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->opening_date = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->closing_date = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->ville_id = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
            $this->departement_id = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
            $this->categorie_id = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
            $this->geo_coordinate_x = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->geo_coordinate_y = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->video_path = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->image_360_path = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->capacite = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->related_1 = ($row[$startcol + 24] !== null) ? (int) $row[$startcol + 24] : null;
            $this->related_2 = ($row[$startcol + 25] !== null) ? (int) $row[$startcol + 25] : null;
            $this->created_at = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->updated_at = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
            $this->active = ($row[$startcol + 28] !== null) ? (boolean) $row[$startcol + 28] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 29; // 29 = EtablissementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Etablissement object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aVille !== null && $this->ville_id !== $this->aVille->getId()) {
            $this->aVille = null;
        }
        if ($this->aDepartement !== null && $this->departement_id !== $this->aDepartement->getId()) {
            $this->aDepartement = null;
        }
        if ($this->aCategorie !== null && $this->categorie_id !== $this->aCategorie->getId()) {
            $this->aCategorie = null;
        }
        if ($this->aEtablissementRelatedByRelated1 !== null && $this->related_1 !== $this->aEtablissementRelatedByRelated1->getId()) {
            $this->aEtablissementRelatedByRelated1 = null;
        }
        if ($this->aEtablissementRelatedByRelated2 !== null && $this->related_2 !== $this->aEtablissementRelatedByRelated2->getId()) {
            $this->aEtablissementRelatedByRelated2 = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EtablissementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aVille = null;
            $this->aDepartement = null;
            $this->aCategorie = null;
            $this->aEtablissementRelatedByRelated1 = null;
            $this->aEtablissementRelatedByRelated2 = null;
            $this->collEtablissementsRelatedById0 = null;

            $this->collEtablissementsRelatedById1 = null;

            $this->collEtablissementTypeHebergements = null;

            $this->collEtablissementDestinations = null;

            $this->collEtablissementActivites = null;

            $this->collEtablissementServiceComplementaires = null;

            $this->collEtablissementSituationGeographiques = null;

            $this->collEtablissementBaignades = null;

            $this->collEtablissementThematiques = null;

            $this->collEtablissementPointInterets = null;

            $this->collEtablissementEvents = null;

            $this->collPersonnages = null;

            $this->collTopCampings = null;

            $this->collBonPlanEtablissements = null;

            $this->collDemandeAnnulations = null;

            $this->collEtablissementI18ns = null;

            $this->collTypeHebergements = null;
            $this->collDestinations = null;
            $this->collActivites = null;
            $this->collServiceComplementaires = null;
            $this->collSituationGeographiques = null;
            $this->collBaignades = null;
            $this->collThematiques = null;
            $this->collPointInterets = null;
            $this->collEvents = null;
            $this->collBonPlans = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EtablissementQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(EtablissementPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(EtablissementPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(EtablissementPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EtablissementPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aVille !== null) {
                if ($this->aVille->isModified() || $this->aVille->isNew()) {
                    $affectedRows += $this->aVille->save($con);
                }
                $this->setVille($this->aVille);
            }

            if ($this->aDepartement !== null) {
                if ($this->aDepartement->isModified() || $this->aDepartement->isNew()) {
                    $affectedRows += $this->aDepartement->save($con);
                }
                $this->setDepartement($this->aDepartement);
            }

            if ($this->aCategorie !== null) {
                if ($this->aCategorie->isModified() || $this->aCategorie->isNew()) {
                    $affectedRows += $this->aCategorie->save($con);
                }
                $this->setCategorie($this->aCategorie);
            }

            if ($this->aEtablissementRelatedByRelated1 !== null) {
                if ($this->aEtablissementRelatedByRelated1->isModified() || $this->aEtablissementRelatedByRelated1->isNew()) {
                    $affectedRows += $this->aEtablissementRelatedByRelated1->save($con);
                }
                $this->setEtablissementRelatedByRelated1($this->aEtablissementRelatedByRelated1);
            }

            if ($this->aEtablissementRelatedByRelated2 !== null) {
                if ($this->aEtablissementRelatedByRelated2->isModified() || $this->aEtablissementRelatedByRelated2->isNew()) {
                    $affectedRows += $this->aEtablissementRelatedByRelated2->save($con);
                }
                $this->setEtablissementRelatedByRelated2($this->aEtablissementRelatedByRelated2);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->typeHebergementsScheduledForDeletion !== null) {
                if (!$this->typeHebergementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->typeHebergementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementTypeHebergementQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->typeHebergementsScheduledForDeletion = null;
                }

                foreach ($this->getTypeHebergements() as $typeHebergement) {
                    if ($typeHebergement->isModified()) {
                        $typeHebergement->save($con);
                    }
                }
            }

            if ($this->destinationsScheduledForDeletion !== null) {
                if (!$this->destinationsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->destinationsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementDestinationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->destinationsScheduledForDeletion = null;
                }

                foreach ($this->getDestinations() as $destination) {
                    if ($destination->isModified()) {
                        $destination->save($con);
                    }
                }
            }

            if ($this->activitesScheduledForDeletion !== null) {
                if (!$this->activitesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->activitesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementActiviteQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->activitesScheduledForDeletion = null;
                }

                foreach ($this->getActivites() as $activite) {
                    if ($activite->isModified()) {
                        $activite->save($con);
                    }
                }
            }

            if ($this->serviceComplementairesScheduledForDeletion !== null) {
                if (!$this->serviceComplementairesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->serviceComplementairesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementServiceComplementaireQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->serviceComplementairesScheduledForDeletion = null;
                }

                foreach ($this->getServiceComplementaires() as $serviceComplementaire) {
                    if ($serviceComplementaire->isModified()) {
                        $serviceComplementaire->save($con);
                    }
                }
            }

            if ($this->situationGeographiquesScheduledForDeletion !== null) {
                if (!$this->situationGeographiquesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->situationGeographiquesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementSituationGeographiqueQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->situationGeographiquesScheduledForDeletion = null;
                }

                foreach ($this->getSituationGeographiques() as $situationGeographique) {
                    if ($situationGeographique->isModified()) {
                        $situationGeographique->save($con);
                    }
                }
            }

            if ($this->baignadesScheduledForDeletion !== null) {
                if (!$this->baignadesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->baignadesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementBaignadeQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->baignadesScheduledForDeletion = null;
                }

                foreach ($this->getBaignades() as $baignade) {
                    if ($baignade->isModified()) {
                        $baignade->save($con);
                    }
                }
            }

            if ($this->thematiquesScheduledForDeletion !== null) {
                if (!$this->thematiquesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->thematiquesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementThematiqueQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->thematiquesScheduledForDeletion = null;
                }

                foreach ($this->getThematiques() as $thematique) {
                    if ($thematique->isModified()) {
                        $thematique->save($con);
                    }
                }
            }

            if ($this->pointInteretsScheduledForDeletion !== null) {
                if (!$this->pointInteretsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->pointInteretsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementPointInteretQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->pointInteretsScheduledForDeletion = null;
                }

                foreach ($this->getPointInterets() as $pointInteret) {
                    if ($pointInteret->isModified()) {
                        $pointInteret->save($con);
                    }
                }
            }

            if ($this->eventsScheduledForDeletion !== null) {
                if (!$this->eventsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->eventsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementEventQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->eventsScheduledForDeletion = null;
                }

                foreach ($this->getEvents() as $event) {
                    if ($event->isModified()) {
                        $event->save($con);
                    }
                }
            }

            if ($this->bonPlansScheduledForDeletion !== null) {
                if (!$this->bonPlansScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->bonPlansScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    BonPlanEtablissementQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->bonPlansScheduledForDeletion = null;
                }

                foreach ($this->getBonPlans() as $bonPlan) {
                    if ($bonPlan->isModified()) {
                        $bonPlan->save($con);
                    }
                }
            }

            if ($this->etablissementsRelatedById0ScheduledForDeletion !== null) {
                if (!$this->etablissementsRelatedById0ScheduledForDeletion->isEmpty()) {
                    foreach ($this->etablissementsRelatedById0ScheduledForDeletion as $etablissementRelatedById0) {
                        // need to save related object because we set the relation to null
                        $etablissementRelatedById0->save($con);
                    }
                    $this->etablissementsRelatedById0ScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementsRelatedById0 !== null) {
                foreach ($this->collEtablissementsRelatedById0 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementsRelatedById1ScheduledForDeletion !== null) {
                if (!$this->etablissementsRelatedById1ScheduledForDeletion->isEmpty()) {
                    foreach ($this->etablissementsRelatedById1ScheduledForDeletion as $etablissementRelatedById1) {
                        // need to save related object because we set the relation to null
                        $etablissementRelatedById1->save($con);
                    }
                    $this->etablissementsRelatedById1ScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementsRelatedById1 !== null) {
                foreach ($this->collEtablissementsRelatedById1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementTypeHebergementsScheduledForDeletion !== null) {
                if (!$this->etablissementTypeHebergementsScheduledForDeletion->isEmpty()) {
                    foreach ($this->etablissementTypeHebergementsScheduledForDeletion as $etablissementTypeHebergement) {
                        // need to save related object because we set the relation to null
                        $etablissementTypeHebergement->save($con);
                    }
                    $this->etablissementTypeHebergementsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementTypeHebergements !== null) {
                foreach ($this->collEtablissementTypeHebergements as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementDestinationsScheduledForDeletion !== null) {
                if (!$this->etablissementDestinationsScheduledForDeletion->isEmpty()) {
                    EtablissementDestinationQuery::create()
                        ->filterByPrimaryKeys($this->etablissementDestinationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementDestinationsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementDestinations !== null) {
                foreach ($this->collEtablissementDestinations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementActivitesScheduledForDeletion !== null) {
                if (!$this->etablissementActivitesScheduledForDeletion->isEmpty()) {
                    EtablissementActiviteQuery::create()
                        ->filterByPrimaryKeys($this->etablissementActivitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementActivitesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementActivites !== null) {
                foreach ($this->collEtablissementActivites as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementServiceComplementairesScheduledForDeletion !== null) {
                if (!$this->etablissementServiceComplementairesScheduledForDeletion->isEmpty()) {
                    EtablissementServiceComplementaireQuery::create()
                        ->filterByPrimaryKeys($this->etablissementServiceComplementairesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementServiceComplementairesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementServiceComplementaires !== null) {
                foreach ($this->collEtablissementServiceComplementaires as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementSituationGeographiquesScheduledForDeletion !== null) {
                if (!$this->etablissementSituationGeographiquesScheduledForDeletion->isEmpty()) {
                    EtablissementSituationGeographiqueQuery::create()
                        ->filterByPrimaryKeys($this->etablissementSituationGeographiquesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementSituationGeographiquesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementSituationGeographiques !== null) {
                foreach ($this->collEtablissementSituationGeographiques as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementBaignadesScheduledForDeletion !== null) {
                if (!$this->etablissementBaignadesScheduledForDeletion->isEmpty()) {
                    EtablissementBaignadeQuery::create()
                        ->filterByPrimaryKeys($this->etablissementBaignadesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementBaignadesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementBaignades !== null) {
                foreach ($this->collEtablissementBaignades as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementThematiquesScheduledForDeletion !== null) {
                if (!$this->etablissementThematiquesScheduledForDeletion->isEmpty()) {
                    EtablissementThematiqueQuery::create()
                        ->filterByPrimaryKeys($this->etablissementThematiquesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementThematiquesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementThematiques !== null) {
                foreach ($this->collEtablissementThematiques as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementPointInteretsScheduledForDeletion !== null) {
                if (!$this->etablissementPointInteretsScheduledForDeletion->isEmpty()) {
                    EtablissementPointInteretQuery::create()
                        ->filterByPrimaryKeys($this->etablissementPointInteretsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementPointInteretsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementPointInterets !== null) {
                foreach ($this->collEtablissementPointInterets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementEventsScheduledForDeletion !== null) {
                if (!$this->etablissementEventsScheduledForDeletion->isEmpty()) {
                    EtablissementEventQuery::create()
                        ->filterByPrimaryKeys($this->etablissementEventsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementEventsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementEvents !== null) {
                foreach ($this->collEtablissementEvents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->personnagesScheduledForDeletion !== null) {
                if (!$this->personnagesScheduledForDeletion->isEmpty()) {
                    foreach ($this->personnagesScheduledForDeletion as $personnage) {
                        // need to save related object because we set the relation to null
                        $personnage->save($con);
                    }
                    $this->personnagesScheduledForDeletion = null;
                }
            }

            if ($this->collPersonnages !== null) {
                foreach ($this->collPersonnages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->topCampingsScheduledForDeletion !== null) {
                if (!$this->topCampingsScheduledForDeletion->isEmpty()) {
                    TopCampingQuery::create()
                        ->filterByPrimaryKeys($this->topCampingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->topCampingsScheduledForDeletion = null;
                }
            }

            if ($this->collTopCampings !== null) {
                foreach ($this->collTopCampings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bonPlanEtablissementsScheduledForDeletion !== null) {
                if (!$this->bonPlanEtablissementsScheduledForDeletion->isEmpty()) {
                    BonPlanEtablissementQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanEtablissementsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanEtablissementsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanEtablissements !== null) {
                foreach ($this->collBonPlanEtablissements as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->demandeAnnulationsScheduledForDeletion !== null) {
                if (!$this->demandeAnnulationsScheduledForDeletion->isEmpty()) {
                    DemandeAnnulationQuery::create()
                        ->filterByPrimaryKeys($this->demandeAnnulationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->demandeAnnulationsScheduledForDeletion = null;
                }
            }

            if ($this->collDemandeAnnulations !== null) {
                foreach ($this->collDemandeAnnulations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementI18nsScheduledForDeletion !== null) {
                if (!$this->etablissementI18nsScheduledForDeletion->isEmpty()) {
                    EtablissementI18nQuery::create()
                        ->filterByPrimaryKeys($this->etablissementI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementI18ns !== null) {
                foreach ($this->collEtablissementI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = EtablissementPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EtablissementPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EtablissementPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EtablissementPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }
        if ($this->isColumnModified(EtablissementPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(EtablissementPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(EtablissementPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(EtablissementPeer::ADDRESS1)) {
            $modifiedColumns[':p' . $index++]  = '`address1`';
        }
        if ($this->isColumnModified(EtablissementPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`address2`';
        }
        if ($this->isColumnModified(EtablissementPeer::ZIP)) {
            $modifiedColumns[':p' . $index++]  = '`zip`';
        }
        if ($this->isColumnModified(EtablissementPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`city`';
        }
        if ($this->isColumnModified(EtablissementPeer::MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`mail`';
        }
        if ($this->isColumnModified(EtablissementPeer::COUNTRY_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`country_code`';
        }
        if ($this->isColumnModified(EtablissementPeer::PHONE1)) {
            $modifiedColumns[':p' . $index++]  = '`phone1`';
        }
        if ($this->isColumnModified(EtablissementPeer::PHONE2)) {
            $modifiedColumns[':p' . $index++]  = '`phone2`';
        }
        if ($this->isColumnModified(EtablissementPeer::FAX)) {
            $modifiedColumns[':p' . $index++]  = '`fax`';
        }
        if ($this->isColumnModified(EtablissementPeer::OPENING_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`opening_date`';
        }
        if ($this->isColumnModified(EtablissementPeer::CLOSING_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`closing_date`';
        }
        if ($this->isColumnModified(EtablissementPeer::VILLE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`ville_id`';
        }
        if ($this->isColumnModified(EtablissementPeer::DEPARTEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`departement_id`';
        }
        if ($this->isColumnModified(EtablissementPeer::CATEGORIE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`categorie_id`';
        }
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_X)) {
            $modifiedColumns[':p' . $index++]  = '`geo_coordinate_x`';
        }
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_Y)) {
            $modifiedColumns[':p' . $index++]  = '`geo_coordinate_y`';
        }
        if ($this->isColumnModified(EtablissementPeer::VIDEO_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`video_path`';
        }
        if ($this->isColumnModified(EtablissementPeer::IMAGE_360_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_360_path`';
        }
        if ($this->isColumnModified(EtablissementPeer::CAPACITE)) {
            $modifiedColumns[':p' . $index++]  = '`capacite`';
        }
        if ($this->isColumnModified(EtablissementPeer::RELATED_1)) {
            $modifiedColumns[':p' . $index++]  = '`related_1`';
        }
        if ($this->isColumnModified(EtablissementPeer::RELATED_2)) {
            $modifiedColumns[':p' . $index++]  = '`related_2`';
        }
        if ($this->isColumnModified(EtablissementPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(EtablissementPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(EtablissementPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `etablissement` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`code`':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_INT);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`address1`':
                        $stmt->bindValue($identifier, $this->address1, PDO::PARAM_STR);
                        break;
                    case '`address2`':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);
                        break;
                    case '`zip`':
                        $stmt->bindValue($identifier, $this->zip, PDO::PARAM_STR);
                        break;
                    case '`city`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`mail`':
                        $stmt->bindValue($identifier, $this->mail, PDO::PARAM_STR);
                        break;
                    case '`country_code`':
                        $stmt->bindValue($identifier, $this->country_code, PDO::PARAM_STR);
                        break;
                    case '`phone1`':
                        $stmt->bindValue($identifier, $this->phone1, PDO::PARAM_STR);
                        break;
                    case '`phone2`':
                        $stmt->bindValue($identifier, $this->phone2, PDO::PARAM_STR);
                        break;
                    case '`fax`':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);
                        break;
                    case '`opening_date`':
                        $stmt->bindValue($identifier, $this->opening_date, PDO::PARAM_STR);
                        break;
                    case '`closing_date`':
                        $stmt->bindValue($identifier, $this->closing_date, PDO::PARAM_STR);
                        break;
                    case '`ville_id`':
                        $stmt->bindValue($identifier, $this->ville_id, PDO::PARAM_INT);
                        break;
                    case '`departement_id`':
                        $stmt->bindValue($identifier, $this->departement_id, PDO::PARAM_INT);
                        break;
                    case '`categorie_id`':
                        $stmt->bindValue($identifier, $this->categorie_id, PDO::PARAM_INT);
                        break;
                    case '`geo_coordinate_x`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_x, PDO::PARAM_STR);
                        break;
                    case '`geo_coordinate_y`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_y, PDO::PARAM_STR);
                        break;
                    case '`video_path`':
                        $stmt->bindValue($identifier, $this->video_path, PDO::PARAM_STR);
                        break;
                    case '`image_360_path`':
                        $stmt->bindValue($identifier, $this->image_360_path, PDO::PARAM_STR);
                        break;
                    case '`capacite`':
                        $stmt->bindValue($identifier, $this->capacite, PDO::PARAM_STR);
                        break;
                    case '`related_1`':
                        $stmt->bindValue($identifier, $this->related_1, PDO::PARAM_INT);
                        break;
                    case '`related_2`':
                        $stmt->bindValue($identifier, $this->related_2, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aVille !== null) {
                if (!$this->aVille->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aVille->getValidationFailures());
                }
            }

            if ($this->aDepartement !== null) {
                if (!$this->aDepartement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aDepartement->getValidationFailures());
                }
            }

            if ($this->aCategorie !== null) {
                if (!$this->aCategorie->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategorie->getValidationFailures());
                }
            }

            if ($this->aEtablissementRelatedByRelated1 !== null) {
                if (!$this->aEtablissementRelatedByRelated1->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEtablissementRelatedByRelated1->getValidationFailures());
                }
            }

            if ($this->aEtablissementRelatedByRelated2 !== null) {
                if (!$this->aEtablissementRelatedByRelated2->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEtablissementRelatedByRelated2->getValidationFailures());
                }
            }


            if (($retval = EtablissementPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collEtablissementsRelatedById0 !== null) {
                    foreach ($this->collEtablissementsRelatedById0 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementsRelatedById1 !== null) {
                    foreach ($this->collEtablissementsRelatedById1 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementTypeHebergements !== null) {
                    foreach ($this->collEtablissementTypeHebergements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementDestinations !== null) {
                    foreach ($this->collEtablissementDestinations as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementActivites !== null) {
                    foreach ($this->collEtablissementActivites as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementServiceComplementaires !== null) {
                    foreach ($this->collEtablissementServiceComplementaires as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementSituationGeographiques !== null) {
                    foreach ($this->collEtablissementSituationGeographiques as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementBaignades !== null) {
                    foreach ($this->collEtablissementBaignades as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementThematiques !== null) {
                    foreach ($this->collEtablissementThematiques as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementPointInterets !== null) {
                    foreach ($this->collEtablissementPointInterets as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementEvents !== null) {
                    foreach ($this->collEtablissementEvents as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPersonnages !== null) {
                    foreach ($this->collPersonnages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTopCampings !== null) {
                    foreach ($this->collTopCampings as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBonPlanEtablissements !== null) {
                    foreach ($this->collBonPlanEtablissements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collDemandeAnnulations !== null) {
                    foreach ($this->collDemandeAnnulations as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementI18ns !== null) {
                    foreach ($this->collEtablissementI18ns as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EtablissementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCode();
                break;
            case 2:
                return $this->getSlug();
                break;
            case 3:
                return $this->getName();
                break;
            case 4:
                return $this->getTitle();
                break;
            case 5:
                return $this->getAddress1();
                break;
            case 6:
                return $this->getAddress2();
                break;
            case 7:
                return $this->getZip();
                break;
            case 8:
                return $this->getCity();
                break;
            case 9:
                return $this->getMail();
                break;
            case 10:
                return $this->getCountryCode();
                break;
            case 11:
                return $this->getPhone1();
                break;
            case 12:
                return $this->getPhone2();
                break;
            case 13:
                return $this->getFax();
                break;
            case 14:
                return $this->getOpeningDate();
                break;
            case 15:
                return $this->getClosingDate();
                break;
            case 16:
                return $this->getVilleId();
                break;
            case 17:
                return $this->getDepartementId();
                break;
            case 18:
                return $this->getCategorieId();
                break;
            case 19:
                return $this->getGeoCoordinateX();
                break;
            case 20:
                return $this->getGeoCoordinateY();
                break;
            case 21:
                return $this->getVideoPath();
                break;
            case 22:
                return $this->getImage360Path();
                break;
            case 23:
                return $this->getCapacite();
                break;
            case 24:
                return $this->getRelated1();
                break;
            case 25:
                return $this->getRelated2();
                break;
            case 26:
                return $this->getCreatedAt();
                break;
            case 27:
                return $this->getUpdatedAt();
                break;
            case 28:
                return $this->getActive();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Etablissement'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Etablissement'][$this->getPrimaryKey()] = true;
        $keys = EtablissementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getSlug(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getTitle(),
            $keys[5] => $this->getAddress1(),
            $keys[6] => $this->getAddress2(),
            $keys[7] => $this->getZip(),
            $keys[8] => $this->getCity(),
            $keys[9] => $this->getMail(),
            $keys[10] => $this->getCountryCode(),
            $keys[11] => $this->getPhone1(),
            $keys[12] => $this->getPhone2(),
            $keys[13] => $this->getFax(),
            $keys[14] => $this->getOpeningDate(),
            $keys[15] => $this->getClosingDate(),
            $keys[16] => $this->getVilleId(),
            $keys[17] => $this->getDepartementId(),
            $keys[18] => $this->getCategorieId(),
            $keys[19] => $this->getGeoCoordinateX(),
            $keys[20] => $this->getGeoCoordinateY(),
            $keys[21] => $this->getVideoPath(),
            $keys[22] => $this->getImage360Path(),
            $keys[23] => $this->getCapacite(),
            $keys[24] => $this->getRelated1(),
            $keys[25] => $this->getRelated2(),
            $keys[26] => $this->getCreatedAt(),
            $keys[27] => $this->getUpdatedAt(),
            $keys[28] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aVille) {
                $result['Ville'] = $this->aVille->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aDepartement) {
                $result['Departement'] = $this->aDepartement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategorie) {
                $result['Categorie'] = $this->aCategorie->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEtablissementRelatedByRelated1) {
                $result['EtablissementRelatedByRelated1'] = $this->aEtablissementRelatedByRelated1->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEtablissementRelatedByRelated2) {
                $result['EtablissementRelatedByRelated2'] = $this->aEtablissementRelatedByRelated2->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEtablissementsRelatedById0) {
                $result['EtablissementsRelatedById0'] = $this->collEtablissementsRelatedById0->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementsRelatedById1) {
                $result['EtablissementsRelatedById1'] = $this->collEtablissementsRelatedById1->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementTypeHebergements) {
                $result['EtablissementTypeHebergements'] = $this->collEtablissementTypeHebergements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementDestinations) {
                $result['EtablissementDestinations'] = $this->collEtablissementDestinations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementActivites) {
                $result['EtablissementActivites'] = $this->collEtablissementActivites->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementServiceComplementaires) {
                $result['EtablissementServiceComplementaires'] = $this->collEtablissementServiceComplementaires->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementSituationGeographiques) {
                $result['EtablissementSituationGeographiques'] = $this->collEtablissementSituationGeographiques->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementBaignades) {
                $result['EtablissementBaignades'] = $this->collEtablissementBaignades->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementThematiques) {
                $result['EtablissementThematiques'] = $this->collEtablissementThematiques->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementPointInterets) {
                $result['EtablissementPointInterets'] = $this->collEtablissementPointInterets->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementEvents) {
                $result['EtablissementEvents'] = $this->collEtablissementEvents->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPersonnages) {
                $result['Personnages'] = $this->collPersonnages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTopCampings) {
                $result['TopCampings'] = $this->collTopCampings->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanEtablissements) {
                $result['BonPlanEtablissements'] = $this->collBonPlanEtablissements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDemandeAnnulations) {
                $result['DemandeAnnulations'] = $this->collDemandeAnnulations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementI18ns) {
                $result['EtablissementI18ns'] = $this->collEtablissementI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EtablissementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCode($value);
                break;
            case 2:
                $this->setSlug($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setTitle($value);
                break;
            case 5:
                $this->setAddress1($value);
                break;
            case 6:
                $this->setAddress2($value);
                break;
            case 7:
                $this->setZip($value);
                break;
            case 8:
                $this->setCity($value);
                break;
            case 9:
                $this->setMail($value);
                break;
            case 10:
                $this->setCountryCode($value);
                break;
            case 11:
                $this->setPhone1($value);
                break;
            case 12:
                $this->setPhone2($value);
                break;
            case 13:
                $this->setFax($value);
                break;
            case 14:
                $this->setOpeningDate($value);
                break;
            case 15:
                $this->setClosingDate($value);
                break;
            case 16:
                $this->setVilleId($value);
                break;
            case 17:
                $this->setDepartementId($value);
                break;
            case 18:
                $this->setCategorieId($value);
                break;
            case 19:
                $this->setGeoCoordinateX($value);
                break;
            case 20:
                $this->setGeoCoordinateY($value);
                break;
            case 21:
                $this->setVideoPath($value);
                break;
            case 22:
                $this->setImage360Path($value);
                break;
            case 23:
                $this->setCapacite($value);
                break;
            case 24:
                $this->setRelated1($value);
                break;
            case 25:
                $this->setRelated2($value);
                break;
            case 26:
                $this->setCreatedAt($value);
                break;
            case 27:
                $this->setUpdatedAt($value);
                break;
            case 28:
                $this->setActive($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = EtablissementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTitle($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAddress1($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAddress2($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setZip($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCity($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMail($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCountryCode($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setPhone1($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setPhone2($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setFax($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setOpeningDate($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setClosingDate($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setVilleId($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setDepartementId($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setCategorieId($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setGeoCoordinateX($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setGeoCoordinateY($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setVideoPath($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setImage360Path($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setCapacite($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setRelated1($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setRelated2($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setCreatedAt($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setUpdatedAt($arr[$keys[27]]);
        if (array_key_exists($keys[28], $arr)) $this->setActive($arr[$keys[28]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);

        if ($this->isColumnModified(EtablissementPeer::ID)) $criteria->add(EtablissementPeer::ID, $this->id);
        if ($this->isColumnModified(EtablissementPeer::CODE)) $criteria->add(EtablissementPeer::CODE, $this->code);
        if ($this->isColumnModified(EtablissementPeer::SLUG)) $criteria->add(EtablissementPeer::SLUG, $this->slug);
        if ($this->isColumnModified(EtablissementPeer::NAME)) $criteria->add(EtablissementPeer::NAME, $this->name);
        if ($this->isColumnModified(EtablissementPeer::TITLE)) $criteria->add(EtablissementPeer::TITLE, $this->title);
        if ($this->isColumnModified(EtablissementPeer::ADDRESS1)) $criteria->add(EtablissementPeer::ADDRESS1, $this->address1);
        if ($this->isColumnModified(EtablissementPeer::ADDRESS2)) $criteria->add(EtablissementPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(EtablissementPeer::ZIP)) $criteria->add(EtablissementPeer::ZIP, $this->zip);
        if ($this->isColumnModified(EtablissementPeer::CITY)) $criteria->add(EtablissementPeer::CITY, $this->city);
        if ($this->isColumnModified(EtablissementPeer::MAIL)) $criteria->add(EtablissementPeer::MAIL, $this->mail);
        if ($this->isColumnModified(EtablissementPeer::COUNTRY_CODE)) $criteria->add(EtablissementPeer::COUNTRY_CODE, $this->country_code);
        if ($this->isColumnModified(EtablissementPeer::PHONE1)) $criteria->add(EtablissementPeer::PHONE1, $this->phone1);
        if ($this->isColumnModified(EtablissementPeer::PHONE2)) $criteria->add(EtablissementPeer::PHONE2, $this->phone2);
        if ($this->isColumnModified(EtablissementPeer::FAX)) $criteria->add(EtablissementPeer::FAX, $this->fax);
        if ($this->isColumnModified(EtablissementPeer::OPENING_DATE)) $criteria->add(EtablissementPeer::OPENING_DATE, $this->opening_date);
        if ($this->isColumnModified(EtablissementPeer::CLOSING_DATE)) $criteria->add(EtablissementPeer::CLOSING_DATE, $this->closing_date);
        if ($this->isColumnModified(EtablissementPeer::VILLE_ID)) $criteria->add(EtablissementPeer::VILLE_ID, $this->ville_id);
        if ($this->isColumnModified(EtablissementPeer::DEPARTEMENT_ID)) $criteria->add(EtablissementPeer::DEPARTEMENT_ID, $this->departement_id);
        if ($this->isColumnModified(EtablissementPeer::CATEGORIE_ID)) $criteria->add(EtablissementPeer::CATEGORIE_ID, $this->categorie_id);
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_X)) $criteria->add(EtablissementPeer::GEO_COORDINATE_X, $this->geo_coordinate_x);
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_Y)) $criteria->add(EtablissementPeer::GEO_COORDINATE_Y, $this->geo_coordinate_y);
        if ($this->isColumnModified(EtablissementPeer::VIDEO_PATH)) $criteria->add(EtablissementPeer::VIDEO_PATH, $this->video_path);
        if ($this->isColumnModified(EtablissementPeer::IMAGE_360_PATH)) $criteria->add(EtablissementPeer::IMAGE_360_PATH, $this->image_360_path);
        if ($this->isColumnModified(EtablissementPeer::CAPACITE)) $criteria->add(EtablissementPeer::CAPACITE, $this->capacite);
        if ($this->isColumnModified(EtablissementPeer::RELATED_1)) $criteria->add(EtablissementPeer::RELATED_1, $this->related_1);
        if ($this->isColumnModified(EtablissementPeer::RELATED_2)) $criteria->add(EtablissementPeer::RELATED_2, $this->related_2);
        if ($this->isColumnModified(EtablissementPeer::CREATED_AT)) $criteria->add(EtablissementPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(EtablissementPeer::UPDATED_AT)) $criteria->add(EtablissementPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(EtablissementPeer::ACTIVE)) $criteria->add(EtablissementPeer::ACTIVE, $this->active);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);
        $criteria->add(EtablissementPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Etablissement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setName($this->getName());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setZip($this->getZip());
        $copyObj->setCity($this->getCity());
        $copyObj->setMail($this->getMail());
        $copyObj->setCountryCode($this->getCountryCode());
        $copyObj->setPhone1($this->getPhone1());
        $copyObj->setPhone2($this->getPhone2());
        $copyObj->setFax($this->getFax());
        $copyObj->setOpeningDate($this->getOpeningDate());
        $copyObj->setClosingDate($this->getClosingDate());
        $copyObj->setVilleId($this->getVilleId());
        $copyObj->setDepartementId($this->getDepartementId());
        $copyObj->setCategorieId($this->getCategorieId());
        $copyObj->setGeoCoordinateX($this->getGeoCoordinateX());
        $copyObj->setGeoCoordinateY($this->getGeoCoordinateY());
        $copyObj->setVideoPath($this->getVideoPath());
        $copyObj->setImage360Path($this->getImage360Path());
        $copyObj->setCapacite($this->getCapacite());
        $copyObj->setRelated1($this->getRelated1());
        $copyObj->setRelated2($this->getRelated2());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getEtablissementsRelatedById0() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementRelatedById0($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementsRelatedById1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementRelatedById1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementTypeHebergements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementTypeHebergement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementDestinations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementDestination($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementActivites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementActivite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementServiceComplementaires() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementServiceComplementaire($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementSituationGeographiques() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementSituationGeographique($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementBaignades() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementBaignade($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementThematiques() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementThematique($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementPointInterets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementPointInteret($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementEvents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementEvent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPersonnages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersonnage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTopCampings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTopCamping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanEtablissements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanEtablissement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDemandeAnnulations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDemandeAnnulation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementI18n($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Etablissement Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return EtablissementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EtablissementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Ville object.
     *
     * @param             Ville $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVille(Ville $v = null)
    {
        if ($v === null) {
            $this->setVilleId(NULL);
        } else {
            $this->setVilleId($v->getId());
        }

        $this->aVille = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Ville object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissement($this);
        }


        return $this;
    }


    /**
     * Get the associated Ville object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Ville The associated Ville object.
     * @throws PropelException
     */
    public function getVille(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aVille === null && ($this->ville_id !== null) && $doQuery) {
            $this->aVille = VilleQuery::create()->findPk($this->ville_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVille->addEtablissements($this);
             */
        }

        return $this->aVille;
    }

    /**
     * Declares an association between this object and a Departement object.
     *
     * @param             Departement $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDepartement(Departement $v = null)
    {
        if ($v === null) {
            $this->setDepartementId(NULL);
        } else {
            $this->setDepartementId($v->getId());
        }

        $this->aDepartement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Departement object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissement($this);
        }


        return $this;
    }


    /**
     * Get the associated Departement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Departement The associated Departement object.
     * @throws PropelException
     */
    public function getDepartement(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aDepartement === null && ($this->departement_id !== null) && $doQuery) {
            $this->aDepartement = DepartementQuery::create()->findPk($this->departement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDepartement->addEtablissements($this);
             */
        }

        return $this->aDepartement;
    }

    /**
     * Declares an association between this object and a Categorie object.
     *
     * @param             Categorie $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategorie(Categorie $v = null)
    {
        if ($v === null) {
            $this->setCategorieId(NULL);
        } else {
            $this->setCategorieId($v->getId());
        }

        $this->aCategorie = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Categorie object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissement($this);
        }


        return $this;
    }


    /**
     * Get the associated Categorie object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Categorie The associated Categorie object.
     * @throws PropelException
     */
    public function getCategorie(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCategorie === null && ($this->categorie_id !== null) && $doQuery) {
            $this->aCategorie = CategorieQuery::create()->findPk($this->categorie_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategorie->addEtablissements($this);
             */
        }

        return $this->aCategorie;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEtablissementRelatedByRelated1(Etablissement $v = null)
    {
        if ($v === null) {
            $this->setRelated1(NULL);
        } else {
            $this->setRelated1($v->getId());
        }

        $this->aEtablissementRelatedByRelated1 = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Etablissement object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissementRelatedById0($this);
        }


        return $this;
    }


    /**
     * Get the associated Etablissement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Etablissement The associated Etablissement object.
     * @throws PropelException
     */
    public function getEtablissementRelatedByRelated1(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEtablissementRelatedByRelated1 === null && ($this->related_1 !== null) && $doQuery) {
            $this->aEtablissementRelatedByRelated1 = EtablissementQuery::create()->findPk($this->related_1, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEtablissementRelatedByRelated1->addEtablissementsRelatedById0($this);
             */
        }

        return $this->aEtablissementRelatedByRelated1;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEtablissementRelatedByRelated2(Etablissement $v = null)
    {
        if ($v === null) {
            $this->setRelated2(NULL);
        } else {
            $this->setRelated2($v->getId());
        }

        $this->aEtablissementRelatedByRelated2 = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Etablissement object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissementRelatedById1($this);
        }


        return $this;
    }


    /**
     * Get the associated Etablissement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Etablissement The associated Etablissement object.
     * @throws PropelException
     */
    public function getEtablissementRelatedByRelated2(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEtablissementRelatedByRelated2 === null && ($this->related_2 !== null) && $doQuery) {
            $this->aEtablissementRelatedByRelated2 = EtablissementQuery::create()->findPk($this->related_2, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEtablissementRelatedByRelated2->addEtablissementsRelatedById1($this);
             */
        }

        return $this->aEtablissementRelatedByRelated2;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('EtablissementRelatedById0' == $relationName) {
            $this->initEtablissementsRelatedById0();
        }
        if ('EtablissementRelatedById1' == $relationName) {
            $this->initEtablissementsRelatedById1();
        }
        if ('EtablissementTypeHebergement' == $relationName) {
            $this->initEtablissementTypeHebergements();
        }
        if ('EtablissementDestination' == $relationName) {
            $this->initEtablissementDestinations();
        }
        if ('EtablissementActivite' == $relationName) {
            $this->initEtablissementActivites();
        }
        if ('EtablissementServiceComplementaire' == $relationName) {
            $this->initEtablissementServiceComplementaires();
        }
        if ('EtablissementSituationGeographique' == $relationName) {
            $this->initEtablissementSituationGeographiques();
        }
        if ('EtablissementBaignade' == $relationName) {
            $this->initEtablissementBaignades();
        }
        if ('EtablissementThematique' == $relationName) {
            $this->initEtablissementThematiques();
        }
        if ('EtablissementPointInteret' == $relationName) {
            $this->initEtablissementPointInterets();
        }
        if ('EtablissementEvent' == $relationName) {
            $this->initEtablissementEvents();
        }
        if ('Personnage' == $relationName) {
            $this->initPersonnages();
        }
        if ('TopCamping' == $relationName) {
            $this->initTopCampings();
        }
        if ('BonPlanEtablissement' == $relationName) {
            $this->initBonPlanEtablissements();
        }
        if ('DemandeAnnulation' == $relationName) {
            $this->initDemandeAnnulations();
        }
        if ('EtablissementI18n' == $relationName) {
            $this->initEtablissementI18ns();
        }
    }

    /**
     * Clears out the collEtablissementsRelatedById0 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementsRelatedById0()
     */
    public function clearEtablissementsRelatedById0()
    {
        $this->collEtablissementsRelatedById0 = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementsRelatedById0Partial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementsRelatedById0 collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementsRelatedById0($v = true)
    {
        $this->collEtablissementsRelatedById0Partial = $v;
    }

    /**
     * Initializes the collEtablissementsRelatedById0 collection.
     *
     * By default this just sets the collEtablissementsRelatedById0 collection to an empty array (like clearcollEtablissementsRelatedById0());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementsRelatedById0($overrideExisting = true)
    {
        if (null !== $this->collEtablissementsRelatedById0 && !$overrideExisting) {
            return;
        }
        $this->collEtablissementsRelatedById0 = new PropelObjectCollection();
        $this->collEtablissementsRelatedById0->setModel('Etablissement');
    }

    /**
     * Gets an array of Etablissement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     * @throws PropelException
     */
    public function getEtablissementsRelatedById0($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementsRelatedById0Partial && !$this->isNew();
        if (null === $this->collEtablissementsRelatedById0 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementsRelatedById0) {
                // return empty collection
                $this->initEtablissementsRelatedById0();
            } else {
                $collEtablissementsRelatedById0 = EtablissementQuery::create(null, $criteria)
                    ->filterByEtablissementRelatedByRelated1($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementsRelatedById0Partial && count($collEtablissementsRelatedById0)) {
                      $this->initEtablissementsRelatedById0(false);

                      foreach($collEtablissementsRelatedById0 as $obj) {
                        if (false == $this->collEtablissementsRelatedById0->contains($obj)) {
                          $this->collEtablissementsRelatedById0->append($obj);
                        }
                      }

                      $this->collEtablissementsRelatedById0Partial = true;
                    }

                    return $collEtablissementsRelatedById0;
                }

                if($partial && $this->collEtablissementsRelatedById0) {
                    foreach($this->collEtablissementsRelatedById0 as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementsRelatedById0[] = $obj;
                        }
                    }
                }

                $this->collEtablissementsRelatedById0 = $collEtablissementsRelatedById0;
                $this->collEtablissementsRelatedById0Partial = false;
            }
        }

        return $this->collEtablissementsRelatedById0;
    }

    /**
     * Sets a collection of EtablissementRelatedById0 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementsRelatedById0 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementsRelatedById0(PropelCollection $etablissementsRelatedById0, PropelPDO $con = null)
    {
        $this->etablissementsRelatedById0ScheduledForDeletion = $this->getEtablissementsRelatedById0(new Criteria(), $con)->diff($etablissementsRelatedById0);

        foreach ($this->etablissementsRelatedById0ScheduledForDeletion as $etablissementRelatedById0Removed) {
            $etablissementRelatedById0Removed->setEtablissementRelatedByRelated1(null);
        }

        $this->collEtablissementsRelatedById0 = null;
        foreach ($etablissementsRelatedById0 as $etablissementRelatedById0) {
            $this->addEtablissementRelatedById0($etablissementRelatedById0);
        }

        $this->collEtablissementsRelatedById0 = $etablissementsRelatedById0;
        $this->collEtablissementsRelatedById0Partial = false;

        return $this;
    }

    /**
     * Returns the number of related Etablissement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Etablissement objects.
     * @throws PropelException
     */
    public function countEtablissementsRelatedById0(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementsRelatedById0Partial && !$this->isNew();
        if (null === $this->collEtablissementsRelatedById0 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementsRelatedById0) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementsRelatedById0());
            }
            $query = EtablissementQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissementRelatedByRelated1($this)
                ->count($con);
        }

        return count($this->collEtablissementsRelatedById0);
    }

    /**
     * Method called to associate a Etablissement object to this object
     * through the Etablissement foreign key attribute.
     *
     * @param    Etablissement $l Etablissement
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementRelatedById0(Etablissement $l)
    {
        if ($this->collEtablissementsRelatedById0 === null) {
            $this->initEtablissementsRelatedById0();
            $this->collEtablissementsRelatedById0Partial = true;
        }
        if (!in_array($l, $this->collEtablissementsRelatedById0->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementRelatedById0($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementRelatedById0 $etablissementRelatedById0 The etablissementRelatedById0 object to add.
     */
    protected function doAddEtablissementRelatedById0($etablissementRelatedById0)
    {
        $this->collEtablissementsRelatedById0[]= $etablissementRelatedById0;
        $etablissementRelatedById0->setEtablissementRelatedByRelated1($this);
    }

    /**
     * @param	EtablissementRelatedById0 $etablissementRelatedById0 The etablissementRelatedById0 object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementRelatedById0($etablissementRelatedById0)
    {
        if ($this->getEtablissementsRelatedById0()->contains($etablissementRelatedById0)) {
            $this->collEtablissementsRelatedById0->remove($this->collEtablissementsRelatedById0->search($etablissementRelatedById0));
            if (null === $this->etablissementsRelatedById0ScheduledForDeletion) {
                $this->etablissementsRelatedById0ScheduledForDeletion = clone $this->collEtablissementsRelatedById0;
                $this->etablissementsRelatedById0ScheduledForDeletion->clear();
            }
            $this->etablissementsRelatedById0ScheduledForDeletion[]= $etablissementRelatedById0;
            $etablissementRelatedById0->setEtablissementRelatedByRelated1(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementsRelatedById0 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissementsRelatedById0JoinVille($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementQuery::create(null, $criteria);
        $query->joinWith('Ville', $join_behavior);

        return $this->getEtablissementsRelatedById0($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementsRelatedById0 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissementsRelatedById0JoinDepartement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementQuery::create(null, $criteria);
        $query->joinWith('Departement', $join_behavior);

        return $this->getEtablissementsRelatedById0($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementsRelatedById0 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissementsRelatedById0JoinCategorie($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementQuery::create(null, $criteria);
        $query->joinWith('Categorie', $join_behavior);

        return $this->getEtablissementsRelatedById0($query, $con);
    }

    /**
     * Clears out the collEtablissementsRelatedById1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementsRelatedById1()
     */
    public function clearEtablissementsRelatedById1()
    {
        $this->collEtablissementsRelatedById1 = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementsRelatedById1Partial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementsRelatedById1 collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementsRelatedById1($v = true)
    {
        $this->collEtablissementsRelatedById1Partial = $v;
    }

    /**
     * Initializes the collEtablissementsRelatedById1 collection.
     *
     * By default this just sets the collEtablissementsRelatedById1 collection to an empty array (like clearcollEtablissementsRelatedById1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementsRelatedById1($overrideExisting = true)
    {
        if (null !== $this->collEtablissementsRelatedById1 && !$overrideExisting) {
            return;
        }
        $this->collEtablissementsRelatedById1 = new PropelObjectCollection();
        $this->collEtablissementsRelatedById1->setModel('Etablissement');
    }

    /**
     * Gets an array of Etablissement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     * @throws PropelException
     */
    public function getEtablissementsRelatedById1($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementsRelatedById1Partial && !$this->isNew();
        if (null === $this->collEtablissementsRelatedById1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementsRelatedById1) {
                // return empty collection
                $this->initEtablissementsRelatedById1();
            } else {
                $collEtablissementsRelatedById1 = EtablissementQuery::create(null, $criteria)
                    ->filterByEtablissementRelatedByRelated2($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementsRelatedById1Partial && count($collEtablissementsRelatedById1)) {
                      $this->initEtablissementsRelatedById1(false);

                      foreach($collEtablissementsRelatedById1 as $obj) {
                        if (false == $this->collEtablissementsRelatedById1->contains($obj)) {
                          $this->collEtablissementsRelatedById1->append($obj);
                        }
                      }

                      $this->collEtablissementsRelatedById1Partial = true;
                    }

                    return $collEtablissementsRelatedById1;
                }

                if($partial && $this->collEtablissementsRelatedById1) {
                    foreach($this->collEtablissementsRelatedById1 as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementsRelatedById1[] = $obj;
                        }
                    }
                }

                $this->collEtablissementsRelatedById1 = $collEtablissementsRelatedById1;
                $this->collEtablissementsRelatedById1Partial = false;
            }
        }

        return $this->collEtablissementsRelatedById1;
    }

    /**
     * Sets a collection of EtablissementRelatedById1 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementsRelatedById1 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementsRelatedById1(PropelCollection $etablissementsRelatedById1, PropelPDO $con = null)
    {
        $this->etablissementsRelatedById1ScheduledForDeletion = $this->getEtablissementsRelatedById1(new Criteria(), $con)->diff($etablissementsRelatedById1);

        foreach ($this->etablissementsRelatedById1ScheduledForDeletion as $etablissementRelatedById1Removed) {
            $etablissementRelatedById1Removed->setEtablissementRelatedByRelated2(null);
        }

        $this->collEtablissementsRelatedById1 = null;
        foreach ($etablissementsRelatedById1 as $etablissementRelatedById1) {
            $this->addEtablissementRelatedById1($etablissementRelatedById1);
        }

        $this->collEtablissementsRelatedById1 = $etablissementsRelatedById1;
        $this->collEtablissementsRelatedById1Partial = false;

        return $this;
    }

    /**
     * Returns the number of related Etablissement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Etablissement objects.
     * @throws PropelException
     */
    public function countEtablissementsRelatedById1(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementsRelatedById1Partial && !$this->isNew();
        if (null === $this->collEtablissementsRelatedById1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementsRelatedById1) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementsRelatedById1());
            }
            $query = EtablissementQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissementRelatedByRelated2($this)
                ->count($con);
        }

        return count($this->collEtablissementsRelatedById1);
    }

    /**
     * Method called to associate a Etablissement object to this object
     * through the Etablissement foreign key attribute.
     *
     * @param    Etablissement $l Etablissement
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementRelatedById1(Etablissement $l)
    {
        if ($this->collEtablissementsRelatedById1 === null) {
            $this->initEtablissementsRelatedById1();
            $this->collEtablissementsRelatedById1Partial = true;
        }
        if (!in_array($l, $this->collEtablissementsRelatedById1->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementRelatedById1($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementRelatedById1 $etablissementRelatedById1 The etablissementRelatedById1 object to add.
     */
    protected function doAddEtablissementRelatedById1($etablissementRelatedById1)
    {
        $this->collEtablissementsRelatedById1[]= $etablissementRelatedById1;
        $etablissementRelatedById1->setEtablissementRelatedByRelated2($this);
    }

    /**
     * @param	EtablissementRelatedById1 $etablissementRelatedById1 The etablissementRelatedById1 object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementRelatedById1($etablissementRelatedById1)
    {
        if ($this->getEtablissementsRelatedById1()->contains($etablissementRelatedById1)) {
            $this->collEtablissementsRelatedById1->remove($this->collEtablissementsRelatedById1->search($etablissementRelatedById1));
            if (null === $this->etablissementsRelatedById1ScheduledForDeletion) {
                $this->etablissementsRelatedById1ScheduledForDeletion = clone $this->collEtablissementsRelatedById1;
                $this->etablissementsRelatedById1ScheduledForDeletion->clear();
            }
            $this->etablissementsRelatedById1ScheduledForDeletion[]= $etablissementRelatedById1;
            $etablissementRelatedById1->setEtablissementRelatedByRelated2(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementsRelatedById1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissementsRelatedById1JoinVille($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementQuery::create(null, $criteria);
        $query->joinWith('Ville', $join_behavior);

        return $this->getEtablissementsRelatedById1($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementsRelatedById1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissementsRelatedById1JoinDepartement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementQuery::create(null, $criteria);
        $query->joinWith('Departement', $join_behavior);

        return $this->getEtablissementsRelatedById1($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementsRelatedById1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissementsRelatedById1JoinCategorie($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementQuery::create(null, $criteria);
        $query->joinWith('Categorie', $join_behavior);

        return $this->getEtablissementsRelatedById1($query, $con);
    }

    /**
     * Clears out the collEtablissementTypeHebergements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementTypeHebergements()
     */
    public function clearEtablissementTypeHebergements()
    {
        $this->collEtablissementTypeHebergements = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementTypeHebergementsPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementTypeHebergements collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementTypeHebergements($v = true)
    {
        $this->collEtablissementTypeHebergementsPartial = $v;
    }

    /**
     * Initializes the collEtablissementTypeHebergements collection.
     *
     * By default this just sets the collEtablissementTypeHebergements collection to an empty array (like clearcollEtablissementTypeHebergements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementTypeHebergements($overrideExisting = true)
    {
        if (null !== $this->collEtablissementTypeHebergements && !$overrideExisting) {
            return;
        }
        $this->collEtablissementTypeHebergements = new PropelObjectCollection();
        $this->collEtablissementTypeHebergements->setModel('EtablissementTypeHebergement');
    }

    /**
     * Gets an array of EtablissementTypeHebergement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementTypeHebergement[] List of EtablissementTypeHebergement objects
     * @throws PropelException
     */
    public function getEtablissementTypeHebergements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementTypeHebergementsPartial && !$this->isNew();
        if (null === $this->collEtablissementTypeHebergements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementTypeHebergements) {
                // return empty collection
                $this->initEtablissementTypeHebergements();
            } else {
                $collEtablissementTypeHebergements = EtablissementTypeHebergementQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementTypeHebergementsPartial && count($collEtablissementTypeHebergements)) {
                      $this->initEtablissementTypeHebergements(false);

                      foreach($collEtablissementTypeHebergements as $obj) {
                        if (false == $this->collEtablissementTypeHebergements->contains($obj)) {
                          $this->collEtablissementTypeHebergements->append($obj);
                        }
                      }

                      $this->collEtablissementTypeHebergementsPartial = true;
                    }

                    return $collEtablissementTypeHebergements;
                }

                if($partial && $this->collEtablissementTypeHebergements) {
                    foreach($this->collEtablissementTypeHebergements as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementTypeHebergements[] = $obj;
                        }
                    }
                }

                $this->collEtablissementTypeHebergements = $collEtablissementTypeHebergements;
                $this->collEtablissementTypeHebergementsPartial = false;
            }
        }

        return $this->collEtablissementTypeHebergements;
    }

    /**
     * Sets a collection of EtablissementTypeHebergement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementTypeHebergements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementTypeHebergements(PropelCollection $etablissementTypeHebergements, PropelPDO $con = null)
    {
        $this->etablissementTypeHebergementsScheduledForDeletion = $this->getEtablissementTypeHebergements(new Criteria(), $con)->diff($etablissementTypeHebergements);

        foreach ($this->etablissementTypeHebergementsScheduledForDeletion as $etablissementTypeHebergementRemoved) {
            $etablissementTypeHebergementRemoved->setEtablissement(null);
        }

        $this->collEtablissementTypeHebergements = null;
        foreach ($etablissementTypeHebergements as $etablissementTypeHebergement) {
            $this->addEtablissementTypeHebergement($etablissementTypeHebergement);
        }

        $this->collEtablissementTypeHebergements = $etablissementTypeHebergements;
        $this->collEtablissementTypeHebergementsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementTypeHebergement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementTypeHebergement objects.
     * @throws PropelException
     */
    public function countEtablissementTypeHebergements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementTypeHebergementsPartial && !$this->isNew();
        if (null === $this->collEtablissementTypeHebergements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementTypeHebergements) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementTypeHebergements());
            }
            $query = EtablissementTypeHebergementQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementTypeHebergements);
    }

    /**
     * Method called to associate a EtablissementTypeHebergement object to this object
     * through the EtablissementTypeHebergement foreign key attribute.
     *
     * @param    EtablissementTypeHebergement $l EtablissementTypeHebergement
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementTypeHebergement(EtablissementTypeHebergement $l)
    {
        if ($this->collEtablissementTypeHebergements === null) {
            $this->initEtablissementTypeHebergements();
            $this->collEtablissementTypeHebergementsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementTypeHebergements->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementTypeHebergement($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementTypeHebergement $etablissementTypeHebergement The etablissementTypeHebergement object to add.
     */
    protected function doAddEtablissementTypeHebergement($etablissementTypeHebergement)
    {
        $this->collEtablissementTypeHebergements[]= $etablissementTypeHebergement;
        $etablissementTypeHebergement->setEtablissement($this);
    }

    /**
     * @param	EtablissementTypeHebergement $etablissementTypeHebergement The etablissementTypeHebergement object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementTypeHebergement($etablissementTypeHebergement)
    {
        if ($this->getEtablissementTypeHebergements()->contains($etablissementTypeHebergement)) {
            $this->collEtablissementTypeHebergements->remove($this->collEtablissementTypeHebergements->search($etablissementTypeHebergement));
            if (null === $this->etablissementTypeHebergementsScheduledForDeletion) {
                $this->etablissementTypeHebergementsScheduledForDeletion = clone $this->collEtablissementTypeHebergements;
                $this->etablissementTypeHebergementsScheduledForDeletion->clear();
            }
            $this->etablissementTypeHebergementsScheduledForDeletion[]= $etablissementTypeHebergement;
            $etablissementTypeHebergement->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementTypeHebergements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementTypeHebergement[] List of EtablissementTypeHebergement objects
     */
    public function getEtablissementTypeHebergementsJoinTypeHebergement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementTypeHebergementQuery::create(null, $criteria);
        $query->joinWith('TypeHebergement', $join_behavior);

        return $this->getEtablissementTypeHebergements($query, $con);
    }

    /**
     * Clears out the collEtablissementDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementDestinations()
     */
    public function clearEtablissementDestinations()
    {
        $this->collEtablissementDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementDestinationsPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementDestinations collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementDestinations($v = true)
    {
        $this->collEtablissementDestinationsPartial = $v;
    }

    /**
     * Initializes the collEtablissementDestinations collection.
     *
     * By default this just sets the collEtablissementDestinations collection to an empty array (like clearcollEtablissementDestinations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementDestinations($overrideExisting = true)
    {
        if (null !== $this->collEtablissementDestinations && !$overrideExisting) {
            return;
        }
        $this->collEtablissementDestinations = new PropelObjectCollection();
        $this->collEtablissementDestinations->setModel('EtablissementDestination');
    }

    /**
     * Gets an array of EtablissementDestination objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementDestination[] List of EtablissementDestination objects
     * @throws PropelException
     */
    public function getEtablissementDestinations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementDestinationsPartial && !$this->isNew();
        if (null === $this->collEtablissementDestinations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementDestinations) {
                // return empty collection
                $this->initEtablissementDestinations();
            } else {
                $collEtablissementDestinations = EtablissementDestinationQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementDestinationsPartial && count($collEtablissementDestinations)) {
                      $this->initEtablissementDestinations(false);

                      foreach($collEtablissementDestinations as $obj) {
                        if (false == $this->collEtablissementDestinations->contains($obj)) {
                          $this->collEtablissementDestinations->append($obj);
                        }
                      }

                      $this->collEtablissementDestinationsPartial = true;
                    }

                    return $collEtablissementDestinations;
                }

                if($partial && $this->collEtablissementDestinations) {
                    foreach($this->collEtablissementDestinations as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementDestinations[] = $obj;
                        }
                    }
                }

                $this->collEtablissementDestinations = $collEtablissementDestinations;
                $this->collEtablissementDestinationsPartial = false;
            }
        }

        return $this->collEtablissementDestinations;
    }

    /**
     * Sets a collection of EtablissementDestination objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementDestinations A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementDestinations(PropelCollection $etablissementDestinations, PropelPDO $con = null)
    {
        $this->etablissementDestinationsScheduledForDeletion = $this->getEtablissementDestinations(new Criteria(), $con)->diff($etablissementDestinations);

        foreach ($this->etablissementDestinationsScheduledForDeletion as $etablissementDestinationRemoved) {
            $etablissementDestinationRemoved->setEtablissement(null);
        }

        $this->collEtablissementDestinations = null;
        foreach ($etablissementDestinations as $etablissementDestination) {
            $this->addEtablissementDestination($etablissementDestination);
        }

        $this->collEtablissementDestinations = $etablissementDestinations;
        $this->collEtablissementDestinationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementDestination objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementDestination objects.
     * @throws PropelException
     */
    public function countEtablissementDestinations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementDestinationsPartial && !$this->isNew();
        if (null === $this->collEtablissementDestinations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementDestinations) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementDestinations());
            }
            $query = EtablissementDestinationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementDestinations);
    }

    /**
     * Method called to associate a EtablissementDestination object to this object
     * through the EtablissementDestination foreign key attribute.
     *
     * @param    EtablissementDestination $l EtablissementDestination
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementDestination(EtablissementDestination $l)
    {
        if ($this->collEtablissementDestinations === null) {
            $this->initEtablissementDestinations();
            $this->collEtablissementDestinationsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementDestinations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementDestination($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementDestination $etablissementDestination The etablissementDestination object to add.
     */
    protected function doAddEtablissementDestination($etablissementDestination)
    {
        $this->collEtablissementDestinations[]= $etablissementDestination;
        $etablissementDestination->setEtablissement($this);
    }

    /**
     * @param	EtablissementDestination $etablissementDestination The etablissementDestination object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementDestination($etablissementDestination)
    {
        if ($this->getEtablissementDestinations()->contains($etablissementDestination)) {
            $this->collEtablissementDestinations->remove($this->collEtablissementDestinations->search($etablissementDestination));
            if (null === $this->etablissementDestinationsScheduledForDeletion) {
                $this->etablissementDestinationsScheduledForDeletion = clone $this->collEtablissementDestinations;
                $this->etablissementDestinationsScheduledForDeletion->clear();
            }
            $this->etablissementDestinationsScheduledForDeletion[]= $etablissementDestination;
            $etablissementDestination->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementDestinations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementDestination[] List of EtablissementDestination objects
     */
    public function getEtablissementDestinationsJoinDestination($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementDestinationQuery::create(null, $criteria);
        $query->joinWith('Destination', $join_behavior);

        return $this->getEtablissementDestinations($query, $con);
    }

    /**
     * Clears out the collEtablissementActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementActivites()
     */
    public function clearEtablissementActivites()
    {
        $this->collEtablissementActivites = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementActivitesPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementActivites collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementActivites($v = true)
    {
        $this->collEtablissementActivitesPartial = $v;
    }

    /**
     * Initializes the collEtablissementActivites collection.
     *
     * By default this just sets the collEtablissementActivites collection to an empty array (like clearcollEtablissementActivites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementActivites($overrideExisting = true)
    {
        if (null !== $this->collEtablissementActivites && !$overrideExisting) {
            return;
        }
        $this->collEtablissementActivites = new PropelObjectCollection();
        $this->collEtablissementActivites->setModel('EtablissementActivite');
    }

    /**
     * Gets an array of EtablissementActivite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementActivite[] List of EtablissementActivite objects
     * @throws PropelException
     */
    public function getEtablissementActivites($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementActivitesPartial && !$this->isNew();
        if (null === $this->collEtablissementActivites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementActivites) {
                // return empty collection
                $this->initEtablissementActivites();
            } else {
                $collEtablissementActivites = EtablissementActiviteQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementActivitesPartial && count($collEtablissementActivites)) {
                      $this->initEtablissementActivites(false);

                      foreach($collEtablissementActivites as $obj) {
                        if (false == $this->collEtablissementActivites->contains($obj)) {
                          $this->collEtablissementActivites->append($obj);
                        }
                      }

                      $this->collEtablissementActivitesPartial = true;
                    }

                    return $collEtablissementActivites;
                }

                if($partial && $this->collEtablissementActivites) {
                    foreach($this->collEtablissementActivites as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementActivites[] = $obj;
                        }
                    }
                }

                $this->collEtablissementActivites = $collEtablissementActivites;
                $this->collEtablissementActivitesPartial = false;
            }
        }

        return $this->collEtablissementActivites;
    }

    /**
     * Sets a collection of EtablissementActivite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementActivites A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementActivites(PropelCollection $etablissementActivites, PropelPDO $con = null)
    {
        $this->etablissementActivitesScheduledForDeletion = $this->getEtablissementActivites(new Criteria(), $con)->diff($etablissementActivites);

        foreach ($this->etablissementActivitesScheduledForDeletion as $etablissementActiviteRemoved) {
            $etablissementActiviteRemoved->setEtablissement(null);
        }

        $this->collEtablissementActivites = null;
        foreach ($etablissementActivites as $etablissementActivite) {
            $this->addEtablissementActivite($etablissementActivite);
        }

        $this->collEtablissementActivites = $etablissementActivites;
        $this->collEtablissementActivitesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementActivite objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementActivite objects.
     * @throws PropelException
     */
    public function countEtablissementActivites(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementActivitesPartial && !$this->isNew();
        if (null === $this->collEtablissementActivites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementActivites) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementActivites());
            }
            $query = EtablissementActiviteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementActivites);
    }

    /**
     * Method called to associate a EtablissementActivite object to this object
     * through the EtablissementActivite foreign key attribute.
     *
     * @param    EtablissementActivite $l EtablissementActivite
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementActivite(EtablissementActivite $l)
    {
        if ($this->collEtablissementActivites === null) {
            $this->initEtablissementActivites();
            $this->collEtablissementActivitesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementActivites->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementActivite($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementActivite $etablissementActivite The etablissementActivite object to add.
     */
    protected function doAddEtablissementActivite($etablissementActivite)
    {
        $this->collEtablissementActivites[]= $etablissementActivite;
        $etablissementActivite->setEtablissement($this);
    }

    /**
     * @param	EtablissementActivite $etablissementActivite The etablissementActivite object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementActivite($etablissementActivite)
    {
        if ($this->getEtablissementActivites()->contains($etablissementActivite)) {
            $this->collEtablissementActivites->remove($this->collEtablissementActivites->search($etablissementActivite));
            if (null === $this->etablissementActivitesScheduledForDeletion) {
                $this->etablissementActivitesScheduledForDeletion = clone $this->collEtablissementActivites;
                $this->etablissementActivitesScheduledForDeletion->clear();
            }
            $this->etablissementActivitesScheduledForDeletion[]= $etablissementActivite;
            $etablissementActivite->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementActivites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementActivite[] List of EtablissementActivite objects
     */
    public function getEtablissementActivitesJoinActivite($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementActiviteQuery::create(null, $criteria);
        $query->joinWith('Activite', $join_behavior);

        return $this->getEtablissementActivites($query, $con);
    }

    /**
     * Clears out the collEtablissementServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementServiceComplementaires()
     */
    public function clearEtablissementServiceComplementaires()
    {
        $this->collEtablissementServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementServiceComplementairesPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementServiceComplementaires collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementServiceComplementaires($v = true)
    {
        $this->collEtablissementServiceComplementairesPartial = $v;
    }

    /**
     * Initializes the collEtablissementServiceComplementaires collection.
     *
     * By default this just sets the collEtablissementServiceComplementaires collection to an empty array (like clearcollEtablissementServiceComplementaires());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementServiceComplementaires($overrideExisting = true)
    {
        if (null !== $this->collEtablissementServiceComplementaires && !$overrideExisting) {
            return;
        }
        $this->collEtablissementServiceComplementaires = new PropelObjectCollection();
        $this->collEtablissementServiceComplementaires->setModel('EtablissementServiceComplementaire');
    }

    /**
     * Gets an array of EtablissementServiceComplementaire objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementServiceComplementaire[] List of EtablissementServiceComplementaire objects
     * @throws PropelException
     */
    public function getEtablissementServiceComplementaires($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collEtablissementServiceComplementaires || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementServiceComplementaires) {
                // return empty collection
                $this->initEtablissementServiceComplementaires();
            } else {
                $collEtablissementServiceComplementaires = EtablissementServiceComplementaireQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementServiceComplementairesPartial && count($collEtablissementServiceComplementaires)) {
                      $this->initEtablissementServiceComplementaires(false);

                      foreach($collEtablissementServiceComplementaires as $obj) {
                        if (false == $this->collEtablissementServiceComplementaires->contains($obj)) {
                          $this->collEtablissementServiceComplementaires->append($obj);
                        }
                      }

                      $this->collEtablissementServiceComplementairesPartial = true;
                    }

                    return $collEtablissementServiceComplementaires;
                }

                if($partial && $this->collEtablissementServiceComplementaires) {
                    foreach($this->collEtablissementServiceComplementaires as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementServiceComplementaires[] = $obj;
                        }
                    }
                }

                $this->collEtablissementServiceComplementaires = $collEtablissementServiceComplementaires;
                $this->collEtablissementServiceComplementairesPartial = false;
            }
        }

        return $this->collEtablissementServiceComplementaires;
    }

    /**
     * Sets a collection of EtablissementServiceComplementaire objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementServiceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementServiceComplementaires(PropelCollection $etablissementServiceComplementaires, PropelPDO $con = null)
    {
        $this->etablissementServiceComplementairesScheduledForDeletion = $this->getEtablissementServiceComplementaires(new Criteria(), $con)->diff($etablissementServiceComplementaires);

        foreach ($this->etablissementServiceComplementairesScheduledForDeletion as $etablissementServiceComplementaireRemoved) {
            $etablissementServiceComplementaireRemoved->setEtablissement(null);
        }

        $this->collEtablissementServiceComplementaires = null;
        foreach ($etablissementServiceComplementaires as $etablissementServiceComplementaire) {
            $this->addEtablissementServiceComplementaire($etablissementServiceComplementaire);
        }

        $this->collEtablissementServiceComplementaires = $etablissementServiceComplementaires;
        $this->collEtablissementServiceComplementairesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementServiceComplementaire objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementServiceComplementaire objects.
     * @throws PropelException
     */
    public function countEtablissementServiceComplementaires(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collEtablissementServiceComplementaires || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementServiceComplementaires) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementServiceComplementaires());
            }
            $query = EtablissementServiceComplementaireQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementServiceComplementaires);
    }

    /**
     * Method called to associate a EtablissementServiceComplementaire object to this object
     * through the EtablissementServiceComplementaire foreign key attribute.
     *
     * @param    EtablissementServiceComplementaire $l EtablissementServiceComplementaire
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementServiceComplementaire(EtablissementServiceComplementaire $l)
    {
        if ($this->collEtablissementServiceComplementaires === null) {
            $this->initEtablissementServiceComplementaires();
            $this->collEtablissementServiceComplementairesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementServiceComplementaires->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementServiceComplementaire($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementServiceComplementaire $etablissementServiceComplementaire The etablissementServiceComplementaire object to add.
     */
    protected function doAddEtablissementServiceComplementaire($etablissementServiceComplementaire)
    {
        $this->collEtablissementServiceComplementaires[]= $etablissementServiceComplementaire;
        $etablissementServiceComplementaire->setEtablissement($this);
    }

    /**
     * @param	EtablissementServiceComplementaire $etablissementServiceComplementaire The etablissementServiceComplementaire object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementServiceComplementaire($etablissementServiceComplementaire)
    {
        if ($this->getEtablissementServiceComplementaires()->contains($etablissementServiceComplementaire)) {
            $this->collEtablissementServiceComplementaires->remove($this->collEtablissementServiceComplementaires->search($etablissementServiceComplementaire));
            if (null === $this->etablissementServiceComplementairesScheduledForDeletion) {
                $this->etablissementServiceComplementairesScheduledForDeletion = clone $this->collEtablissementServiceComplementaires;
                $this->etablissementServiceComplementairesScheduledForDeletion->clear();
            }
            $this->etablissementServiceComplementairesScheduledForDeletion[]= $etablissementServiceComplementaire;
            $etablissementServiceComplementaire->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementServiceComplementaires from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementServiceComplementaire[] List of EtablissementServiceComplementaire objects
     */
    public function getEtablissementServiceComplementairesJoinServiceComplementaire($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementServiceComplementaireQuery::create(null, $criteria);
        $query->joinWith('ServiceComplementaire', $join_behavior);

        return $this->getEtablissementServiceComplementaires($query, $con);
    }

    /**
     * Clears out the collEtablissementSituationGeographiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementSituationGeographiques()
     */
    public function clearEtablissementSituationGeographiques()
    {
        $this->collEtablissementSituationGeographiques = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementSituationGeographiquesPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementSituationGeographiques collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementSituationGeographiques($v = true)
    {
        $this->collEtablissementSituationGeographiquesPartial = $v;
    }

    /**
     * Initializes the collEtablissementSituationGeographiques collection.
     *
     * By default this just sets the collEtablissementSituationGeographiques collection to an empty array (like clearcollEtablissementSituationGeographiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementSituationGeographiques($overrideExisting = true)
    {
        if (null !== $this->collEtablissementSituationGeographiques && !$overrideExisting) {
            return;
        }
        $this->collEtablissementSituationGeographiques = new PropelObjectCollection();
        $this->collEtablissementSituationGeographiques->setModel('EtablissementSituationGeographique');
    }

    /**
     * Gets an array of EtablissementSituationGeographique objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementSituationGeographique[] List of EtablissementSituationGeographique objects
     * @throws PropelException
     */
    public function getEtablissementSituationGeographiques($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementSituationGeographiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementSituationGeographiques || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementSituationGeographiques) {
                // return empty collection
                $this->initEtablissementSituationGeographiques();
            } else {
                $collEtablissementSituationGeographiques = EtablissementSituationGeographiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementSituationGeographiquesPartial && count($collEtablissementSituationGeographiques)) {
                      $this->initEtablissementSituationGeographiques(false);

                      foreach($collEtablissementSituationGeographiques as $obj) {
                        if (false == $this->collEtablissementSituationGeographiques->contains($obj)) {
                          $this->collEtablissementSituationGeographiques->append($obj);
                        }
                      }

                      $this->collEtablissementSituationGeographiquesPartial = true;
                    }

                    return $collEtablissementSituationGeographiques;
                }

                if($partial && $this->collEtablissementSituationGeographiques) {
                    foreach($this->collEtablissementSituationGeographiques as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementSituationGeographiques[] = $obj;
                        }
                    }
                }

                $this->collEtablissementSituationGeographiques = $collEtablissementSituationGeographiques;
                $this->collEtablissementSituationGeographiquesPartial = false;
            }
        }

        return $this->collEtablissementSituationGeographiques;
    }

    /**
     * Sets a collection of EtablissementSituationGeographique objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementSituationGeographiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementSituationGeographiques(PropelCollection $etablissementSituationGeographiques, PropelPDO $con = null)
    {
        $this->etablissementSituationGeographiquesScheduledForDeletion = $this->getEtablissementSituationGeographiques(new Criteria(), $con)->diff($etablissementSituationGeographiques);

        foreach ($this->etablissementSituationGeographiquesScheduledForDeletion as $etablissementSituationGeographiqueRemoved) {
            $etablissementSituationGeographiqueRemoved->setEtablissement(null);
        }

        $this->collEtablissementSituationGeographiques = null;
        foreach ($etablissementSituationGeographiques as $etablissementSituationGeographique) {
            $this->addEtablissementSituationGeographique($etablissementSituationGeographique);
        }

        $this->collEtablissementSituationGeographiques = $etablissementSituationGeographiques;
        $this->collEtablissementSituationGeographiquesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementSituationGeographique objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementSituationGeographique objects.
     * @throws PropelException
     */
    public function countEtablissementSituationGeographiques(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementSituationGeographiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementSituationGeographiques || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementSituationGeographiques) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementSituationGeographiques());
            }
            $query = EtablissementSituationGeographiqueQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementSituationGeographiques);
    }

    /**
     * Method called to associate a EtablissementSituationGeographique object to this object
     * through the EtablissementSituationGeographique foreign key attribute.
     *
     * @param    EtablissementSituationGeographique $l EtablissementSituationGeographique
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementSituationGeographique(EtablissementSituationGeographique $l)
    {
        if ($this->collEtablissementSituationGeographiques === null) {
            $this->initEtablissementSituationGeographiques();
            $this->collEtablissementSituationGeographiquesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementSituationGeographiques->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementSituationGeographique($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementSituationGeographique $etablissementSituationGeographique The etablissementSituationGeographique object to add.
     */
    protected function doAddEtablissementSituationGeographique($etablissementSituationGeographique)
    {
        $this->collEtablissementSituationGeographiques[]= $etablissementSituationGeographique;
        $etablissementSituationGeographique->setEtablissement($this);
    }

    /**
     * @param	EtablissementSituationGeographique $etablissementSituationGeographique The etablissementSituationGeographique object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementSituationGeographique($etablissementSituationGeographique)
    {
        if ($this->getEtablissementSituationGeographiques()->contains($etablissementSituationGeographique)) {
            $this->collEtablissementSituationGeographiques->remove($this->collEtablissementSituationGeographiques->search($etablissementSituationGeographique));
            if (null === $this->etablissementSituationGeographiquesScheduledForDeletion) {
                $this->etablissementSituationGeographiquesScheduledForDeletion = clone $this->collEtablissementSituationGeographiques;
                $this->etablissementSituationGeographiquesScheduledForDeletion->clear();
            }
            $this->etablissementSituationGeographiquesScheduledForDeletion[]= $etablissementSituationGeographique;
            $etablissementSituationGeographique->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementSituationGeographiques from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementSituationGeographique[] List of EtablissementSituationGeographique objects
     */
    public function getEtablissementSituationGeographiquesJoinSituationGeographique($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementSituationGeographiqueQuery::create(null, $criteria);
        $query->joinWith('SituationGeographique', $join_behavior);

        return $this->getEtablissementSituationGeographiques($query, $con);
    }

    /**
     * Clears out the collEtablissementBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementBaignades()
     */
    public function clearEtablissementBaignades()
    {
        $this->collEtablissementBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementBaignadesPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementBaignades collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementBaignades($v = true)
    {
        $this->collEtablissementBaignadesPartial = $v;
    }

    /**
     * Initializes the collEtablissementBaignades collection.
     *
     * By default this just sets the collEtablissementBaignades collection to an empty array (like clearcollEtablissementBaignades());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementBaignades($overrideExisting = true)
    {
        if (null !== $this->collEtablissementBaignades && !$overrideExisting) {
            return;
        }
        $this->collEtablissementBaignades = new PropelObjectCollection();
        $this->collEtablissementBaignades->setModel('EtablissementBaignade');
    }

    /**
     * Gets an array of EtablissementBaignade objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementBaignade[] List of EtablissementBaignade objects
     * @throws PropelException
     */
    public function getEtablissementBaignades($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementBaignadesPartial && !$this->isNew();
        if (null === $this->collEtablissementBaignades || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementBaignades) {
                // return empty collection
                $this->initEtablissementBaignades();
            } else {
                $collEtablissementBaignades = EtablissementBaignadeQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementBaignadesPartial && count($collEtablissementBaignades)) {
                      $this->initEtablissementBaignades(false);

                      foreach($collEtablissementBaignades as $obj) {
                        if (false == $this->collEtablissementBaignades->contains($obj)) {
                          $this->collEtablissementBaignades->append($obj);
                        }
                      }

                      $this->collEtablissementBaignadesPartial = true;
                    }

                    return $collEtablissementBaignades;
                }

                if($partial && $this->collEtablissementBaignades) {
                    foreach($this->collEtablissementBaignades as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementBaignades[] = $obj;
                        }
                    }
                }

                $this->collEtablissementBaignades = $collEtablissementBaignades;
                $this->collEtablissementBaignadesPartial = false;
            }
        }

        return $this->collEtablissementBaignades;
    }

    /**
     * Sets a collection of EtablissementBaignade objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementBaignades A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementBaignades(PropelCollection $etablissementBaignades, PropelPDO $con = null)
    {
        $this->etablissementBaignadesScheduledForDeletion = $this->getEtablissementBaignades(new Criteria(), $con)->diff($etablissementBaignades);

        foreach ($this->etablissementBaignadesScheduledForDeletion as $etablissementBaignadeRemoved) {
            $etablissementBaignadeRemoved->setEtablissement(null);
        }

        $this->collEtablissementBaignades = null;
        foreach ($etablissementBaignades as $etablissementBaignade) {
            $this->addEtablissementBaignade($etablissementBaignade);
        }

        $this->collEtablissementBaignades = $etablissementBaignades;
        $this->collEtablissementBaignadesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementBaignade objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementBaignade objects.
     * @throws PropelException
     */
    public function countEtablissementBaignades(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementBaignadesPartial && !$this->isNew();
        if (null === $this->collEtablissementBaignades || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementBaignades) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementBaignades());
            }
            $query = EtablissementBaignadeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementBaignades);
    }

    /**
     * Method called to associate a EtablissementBaignade object to this object
     * through the EtablissementBaignade foreign key attribute.
     *
     * @param    EtablissementBaignade $l EtablissementBaignade
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementBaignade(EtablissementBaignade $l)
    {
        if ($this->collEtablissementBaignades === null) {
            $this->initEtablissementBaignades();
            $this->collEtablissementBaignadesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementBaignades->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementBaignade($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementBaignade $etablissementBaignade The etablissementBaignade object to add.
     */
    protected function doAddEtablissementBaignade($etablissementBaignade)
    {
        $this->collEtablissementBaignades[]= $etablissementBaignade;
        $etablissementBaignade->setEtablissement($this);
    }

    /**
     * @param	EtablissementBaignade $etablissementBaignade The etablissementBaignade object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementBaignade($etablissementBaignade)
    {
        if ($this->getEtablissementBaignades()->contains($etablissementBaignade)) {
            $this->collEtablissementBaignades->remove($this->collEtablissementBaignades->search($etablissementBaignade));
            if (null === $this->etablissementBaignadesScheduledForDeletion) {
                $this->etablissementBaignadesScheduledForDeletion = clone $this->collEtablissementBaignades;
                $this->etablissementBaignadesScheduledForDeletion->clear();
            }
            $this->etablissementBaignadesScheduledForDeletion[]= $etablissementBaignade;
            $etablissementBaignade->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementBaignades from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementBaignade[] List of EtablissementBaignade objects
     */
    public function getEtablissementBaignadesJoinBaignade($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementBaignadeQuery::create(null, $criteria);
        $query->joinWith('Baignade', $join_behavior);

        return $this->getEtablissementBaignades($query, $con);
    }

    /**
     * Clears out the collEtablissementThematiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementThematiques()
     */
    public function clearEtablissementThematiques()
    {
        $this->collEtablissementThematiques = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementThematiquesPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementThematiques collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementThematiques($v = true)
    {
        $this->collEtablissementThematiquesPartial = $v;
    }

    /**
     * Initializes the collEtablissementThematiques collection.
     *
     * By default this just sets the collEtablissementThematiques collection to an empty array (like clearcollEtablissementThematiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementThematiques($overrideExisting = true)
    {
        if (null !== $this->collEtablissementThematiques && !$overrideExisting) {
            return;
        }
        $this->collEtablissementThematiques = new PropelObjectCollection();
        $this->collEtablissementThematiques->setModel('EtablissementThematique');
    }

    /**
     * Gets an array of EtablissementThematique objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementThematique[] List of EtablissementThematique objects
     * @throws PropelException
     */
    public function getEtablissementThematiques($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementThematiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementThematiques || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementThematiques) {
                // return empty collection
                $this->initEtablissementThematiques();
            } else {
                $collEtablissementThematiques = EtablissementThematiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementThematiquesPartial && count($collEtablissementThematiques)) {
                      $this->initEtablissementThematiques(false);

                      foreach($collEtablissementThematiques as $obj) {
                        if (false == $this->collEtablissementThematiques->contains($obj)) {
                          $this->collEtablissementThematiques->append($obj);
                        }
                      }

                      $this->collEtablissementThematiquesPartial = true;
                    }

                    return $collEtablissementThematiques;
                }

                if($partial && $this->collEtablissementThematiques) {
                    foreach($this->collEtablissementThematiques as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementThematiques[] = $obj;
                        }
                    }
                }

                $this->collEtablissementThematiques = $collEtablissementThematiques;
                $this->collEtablissementThematiquesPartial = false;
            }
        }

        return $this->collEtablissementThematiques;
    }

    /**
     * Sets a collection of EtablissementThematique objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementThematiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementThematiques(PropelCollection $etablissementThematiques, PropelPDO $con = null)
    {
        $this->etablissementThematiquesScheduledForDeletion = $this->getEtablissementThematiques(new Criteria(), $con)->diff($etablissementThematiques);

        foreach ($this->etablissementThematiquesScheduledForDeletion as $etablissementThematiqueRemoved) {
            $etablissementThematiqueRemoved->setEtablissement(null);
        }

        $this->collEtablissementThematiques = null;
        foreach ($etablissementThematiques as $etablissementThematique) {
            $this->addEtablissementThematique($etablissementThematique);
        }

        $this->collEtablissementThematiques = $etablissementThematiques;
        $this->collEtablissementThematiquesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementThematique objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementThematique objects.
     * @throws PropelException
     */
    public function countEtablissementThematiques(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementThematiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementThematiques || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementThematiques) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementThematiques());
            }
            $query = EtablissementThematiqueQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementThematiques);
    }

    /**
     * Method called to associate a EtablissementThematique object to this object
     * through the EtablissementThematique foreign key attribute.
     *
     * @param    EtablissementThematique $l EtablissementThematique
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementThematique(EtablissementThematique $l)
    {
        if ($this->collEtablissementThematiques === null) {
            $this->initEtablissementThematiques();
            $this->collEtablissementThematiquesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementThematiques->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementThematique($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementThematique $etablissementThematique The etablissementThematique object to add.
     */
    protected function doAddEtablissementThematique($etablissementThematique)
    {
        $this->collEtablissementThematiques[]= $etablissementThematique;
        $etablissementThematique->setEtablissement($this);
    }

    /**
     * @param	EtablissementThematique $etablissementThematique The etablissementThematique object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementThematique($etablissementThematique)
    {
        if ($this->getEtablissementThematiques()->contains($etablissementThematique)) {
            $this->collEtablissementThematiques->remove($this->collEtablissementThematiques->search($etablissementThematique));
            if (null === $this->etablissementThematiquesScheduledForDeletion) {
                $this->etablissementThematiquesScheduledForDeletion = clone $this->collEtablissementThematiques;
                $this->etablissementThematiquesScheduledForDeletion->clear();
            }
            $this->etablissementThematiquesScheduledForDeletion[]= $etablissementThematique;
            $etablissementThematique->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementThematiques from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementThematique[] List of EtablissementThematique objects
     */
    public function getEtablissementThematiquesJoinThematique($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementThematiqueQuery::create(null, $criteria);
        $query->joinWith('Thematique', $join_behavior);

        return $this->getEtablissementThematiques($query, $con);
    }

    /**
     * Clears out the collEtablissementPointInterets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementPointInterets()
     */
    public function clearEtablissementPointInterets()
    {
        $this->collEtablissementPointInterets = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementPointInteretsPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementPointInterets collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementPointInterets($v = true)
    {
        $this->collEtablissementPointInteretsPartial = $v;
    }

    /**
     * Initializes the collEtablissementPointInterets collection.
     *
     * By default this just sets the collEtablissementPointInterets collection to an empty array (like clearcollEtablissementPointInterets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementPointInterets($overrideExisting = true)
    {
        if (null !== $this->collEtablissementPointInterets && !$overrideExisting) {
            return;
        }
        $this->collEtablissementPointInterets = new PropelObjectCollection();
        $this->collEtablissementPointInterets->setModel('EtablissementPointInteret');
    }

    /**
     * Gets an array of EtablissementPointInteret objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementPointInteret[] List of EtablissementPointInteret objects
     * @throws PropelException
     */
    public function getEtablissementPointInterets($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementPointInteretsPartial && !$this->isNew();
        if (null === $this->collEtablissementPointInterets || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementPointInterets) {
                // return empty collection
                $this->initEtablissementPointInterets();
            } else {
                $collEtablissementPointInterets = EtablissementPointInteretQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementPointInteretsPartial && count($collEtablissementPointInterets)) {
                      $this->initEtablissementPointInterets(false);

                      foreach($collEtablissementPointInterets as $obj) {
                        if (false == $this->collEtablissementPointInterets->contains($obj)) {
                          $this->collEtablissementPointInterets->append($obj);
                        }
                      }

                      $this->collEtablissementPointInteretsPartial = true;
                    }

                    return $collEtablissementPointInterets;
                }

                if($partial && $this->collEtablissementPointInterets) {
                    foreach($this->collEtablissementPointInterets as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementPointInterets[] = $obj;
                        }
                    }
                }

                $this->collEtablissementPointInterets = $collEtablissementPointInterets;
                $this->collEtablissementPointInteretsPartial = false;
            }
        }

        return $this->collEtablissementPointInterets;
    }

    /**
     * Sets a collection of EtablissementPointInteret objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementPointInterets A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementPointInterets(PropelCollection $etablissementPointInterets, PropelPDO $con = null)
    {
        $this->etablissementPointInteretsScheduledForDeletion = $this->getEtablissementPointInterets(new Criteria(), $con)->diff($etablissementPointInterets);

        foreach ($this->etablissementPointInteretsScheduledForDeletion as $etablissementPointInteretRemoved) {
            $etablissementPointInteretRemoved->setEtablissement(null);
        }

        $this->collEtablissementPointInterets = null;
        foreach ($etablissementPointInterets as $etablissementPointInteret) {
            $this->addEtablissementPointInteret($etablissementPointInteret);
        }

        $this->collEtablissementPointInterets = $etablissementPointInterets;
        $this->collEtablissementPointInteretsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementPointInteret objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementPointInteret objects.
     * @throws PropelException
     */
    public function countEtablissementPointInterets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementPointInteretsPartial && !$this->isNew();
        if (null === $this->collEtablissementPointInterets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementPointInterets) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementPointInterets());
            }
            $query = EtablissementPointInteretQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementPointInterets);
    }

    /**
     * Method called to associate a EtablissementPointInteret object to this object
     * through the EtablissementPointInteret foreign key attribute.
     *
     * @param    EtablissementPointInteret $l EtablissementPointInteret
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementPointInteret(EtablissementPointInteret $l)
    {
        if ($this->collEtablissementPointInterets === null) {
            $this->initEtablissementPointInterets();
            $this->collEtablissementPointInteretsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementPointInterets->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementPointInteret($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementPointInteret $etablissementPointInteret The etablissementPointInteret object to add.
     */
    protected function doAddEtablissementPointInteret($etablissementPointInteret)
    {
        $this->collEtablissementPointInterets[]= $etablissementPointInteret;
        $etablissementPointInteret->setEtablissement($this);
    }

    /**
     * @param	EtablissementPointInteret $etablissementPointInteret The etablissementPointInteret object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementPointInteret($etablissementPointInteret)
    {
        if ($this->getEtablissementPointInterets()->contains($etablissementPointInteret)) {
            $this->collEtablissementPointInterets->remove($this->collEtablissementPointInterets->search($etablissementPointInteret));
            if (null === $this->etablissementPointInteretsScheduledForDeletion) {
                $this->etablissementPointInteretsScheduledForDeletion = clone $this->collEtablissementPointInterets;
                $this->etablissementPointInteretsScheduledForDeletion->clear();
            }
            $this->etablissementPointInteretsScheduledForDeletion[]= $etablissementPointInteret;
            $etablissementPointInteret->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementPointInterets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementPointInteret[] List of EtablissementPointInteret objects
     */
    public function getEtablissementPointInteretsJoinPointInteret($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementPointInteretQuery::create(null, $criteria);
        $query->joinWith('PointInteret', $join_behavior);

        return $this->getEtablissementPointInterets($query, $con);
    }

    /**
     * Clears out the collEtablissementEvents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementEvents()
     */
    public function clearEtablissementEvents()
    {
        $this->collEtablissementEvents = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementEventsPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementEvents collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementEvents($v = true)
    {
        $this->collEtablissementEventsPartial = $v;
    }

    /**
     * Initializes the collEtablissementEvents collection.
     *
     * By default this just sets the collEtablissementEvents collection to an empty array (like clearcollEtablissementEvents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementEvents($overrideExisting = true)
    {
        if (null !== $this->collEtablissementEvents && !$overrideExisting) {
            return;
        }
        $this->collEtablissementEvents = new PropelObjectCollection();
        $this->collEtablissementEvents->setModel('EtablissementEvent');
    }

    /**
     * Gets an array of EtablissementEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementEvent[] List of EtablissementEvent objects
     * @throws PropelException
     */
    public function getEtablissementEvents($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementEventsPartial && !$this->isNew();
        if (null === $this->collEtablissementEvents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementEvents) {
                // return empty collection
                $this->initEtablissementEvents();
            } else {
                $collEtablissementEvents = EtablissementEventQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementEventsPartial && count($collEtablissementEvents)) {
                      $this->initEtablissementEvents(false);

                      foreach($collEtablissementEvents as $obj) {
                        if (false == $this->collEtablissementEvents->contains($obj)) {
                          $this->collEtablissementEvents->append($obj);
                        }
                      }

                      $this->collEtablissementEventsPartial = true;
                    }

                    return $collEtablissementEvents;
                }

                if($partial && $this->collEtablissementEvents) {
                    foreach($this->collEtablissementEvents as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementEvents[] = $obj;
                        }
                    }
                }

                $this->collEtablissementEvents = $collEtablissementEvents;
                $this->collEtablissementEventsPartial = false;
            }
        }

        return $this->collEtablissementEvents;
    }

    /**
     * Sets a collection of EtablissementEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementEvents A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementEvents(PropelCollection $etablissementEvents, PropelPDO $con = null)
    {
        $this->etablissementEventsScheduledForDeletion = $this->getEtablissementEvents(new Criteria(), $con)->diff($etablissementEvents);

        foreach ($this->etablissementEventsScheduledForDeletion as $etablissementEventRemoved) {
            $etablissementEventRemoved->setEtablissement(null);
        }

        $this->collEtablissementEvents = null;
        foreach ($etablissementEvents as $etablissementEvent) {
            $this->addEtablissementEvent($etablissementEvent);
        }

        $this->collEtablissementEvents = $etablissementEvents;
        $this->collEtablissementEventsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementEvent objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementEvent objects.
     * @throws PropelException
     */
    public function countEtablissementEvents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementEventsPartial && !$this->isNew();
        if (null === $this->collEtablissementEvents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementEvents) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementEvents());
            }
            $query = EtablissementEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementEvents);
    }

    /**
     * Method called to associate a EtablissementEvent object to this object
     * through the EtablissementEvent foreign key attribute.
     *
     * @param    EtablissementEvent $l EtablissementEvent
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementEvent(EtablissementEvent $l)
    {
        if ($this->collEtablissementEvents === null) {
            $this->initEtablissementEvents();
            $this->collEtablissementEventsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementEvents->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementEvent($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementEvent $etablissementEvent The etablissementEvent object to add.
     */
    protected function doAddEtablissementEvent($etablissementEvent)
    {
        $this->collEtablissementEvents[]= $etablissementEvent;
        $etablissementEvent->setEtablissement($this);
    }

    /**
     * @param	EtablissementEvent $etablissementEvent The etablissementEvent object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementEvent($etablissementEvent)
    {
        if ($this->getEtablissementEvents()->contains($etablissementEvent)) {
            $this->collEtablissementEvents->remove($this->collEtablissementEvents->search($etablissementEvent));
            if (null === $this->etablissementEventsScheduledForDeletion) {
                $this->etablissementEventsScheduledForDeletion = clone $this->collEtablissementEvents;
                $this->etablissementEventsScheduledForDeletion->clear();
            }
            $this->etablissementEventsScheduledForDeletion[]= $etablissementEvent;
            $etablissementEvent->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementEvent[] List of EtablissementEvent objects
     */
    public function getEtablissementEventsJoinEvent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementEventQuery::create(null, $criteria);
        $query->joinWith('Event', $join_behavior);

        return $this->getEtablissementEvents($query, $con);
    }

    /**
     * Clears out the collPersonnages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addPersonnages()
     */
    public function clearPersonnages()
    {
        $this->collPersonnages = null; // important to set this to null since that means it is uninitialized
        $this->collPersonnagesPartial = null;

        return $this;
    }

    /**
     * reset is the collPersonnages collection loaded partially
     *
     * @return void
     */
    public function resetPartialPersonnages($v = true)
    {
        $this->collPersonnagesPartial = $v;
    }

    /**
     * Initializes the collPersonnages collection.
     *
     * By default this just sets the collPersonnages collection to an empty array (like clearcollPersonnages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersonnages($overrideExisting = true)
    {
        if (null !== $this->collPersonnages && !$overrideExisting) {
            return;
        }
        $this->collPersonnages = new PropelObjectCollection();
        $this->collPersonnages->setModel('Personnage');
    }

    /**
     * Gets an array of Personnage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Personnage[] List of Personnage objects
     * @throws PropelException
     */
    public function getPersonnages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPersonnagesPartial && !$this->isNew();
        if (null === $this->collPersonnages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersonnages) {
                // return empty collection
                $this->initPersonnages();
            } else {
                $collPersonnages = PersonnageQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPersonnagesPartial && count($collPersonnages)) {
                      $this->initPersonnages(false);

                      foreach($collPersonnages as $obj) {
                        if (false == $this->collPersonnages->contains($obj)) {
                          $this->collPersonnages->append($obj);
                        }
                      }

                      $this->collPersonnagesPartial = true;
                    }

                    return $collPersonnages;
                }

                if($partial && $this->collPersonnages) {
                    foreach($this->collPersonnages as $obj) {
                        if($obj->isNew()) {
                            $collPersonnages[] = $obj;
                        }
                    }
                }

                $this->collPersonnages = $collPersonnages;
                $this->collPersonnagesPartial = false;
            }
        }

        return $this->collPersonnages;
    }

    /**
     * Sets a collection of Personnage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $personnages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setPersonnages(PropelCollection $personnages, PropelPDO $con = null)
    {
        $this->personnagesScheduledForDeletion = $this->getPersonnages(new Criteria(), $con)->diff($personnages);

        foreach ($this->personnagesScheduledForDeletion as $personnageRemoved) {
            $personnageRemoved->setEtablissement(null);
        }

        $this->collPersonnages = null;
        foreach ($personnages as $personnage) {
            $this->addPersonnage($personnage);
        }

        $this->collPersonnages = $personnages;
        $this->collPersonnagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Personnage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Personnage objects.
     * @throws PropelException
     */
    public function countPersonnages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPersonnagesPartial && !$this->isNew();
        if (null === $this->collPersonnages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersonnages) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPersonnages());
            }
            $query = PersonnageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collPersonnages);
    }

    /**
     * Method called to associate a Personnage object to this object
     * through the Personnage foreign key attribute.
     *
     * @param    Personnage $l Personnage
     * @return Etablissement The current object (for fluent API support)
     */
    public function addPersonnage(Personnage $l)
    {
        if ($this->collPersonnages === null) {
            $this->initPersonnages();
            $this->collPersonnagesPartial = true;
        }
        if (!in_array($l, $this->collPersonnages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPersonnage($l);
        }

        return $this;
    }

    /**
     * @param	Personnage $personnage The personnage object to add.
     */
    protected function doAddPersonnage($personnage)
    {
        $this->collPersonnages[]= $personnage;
        $personnage->setEtablissement($this);
    }

    /**
     * @param	Personnage $personnage The personnage object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removePersonnage($personnage)
    {
        if ($this->getPersonnages()->contains($personnage)) {
            $this->collPersonnages->remove($this->collPersonnages->search($personnage));
            if (null === $this->personnagesScheduledForDeletion) {
                $this->personnagesScheduledForDeletion = clone $this->collPersonnages;
                $this->personnagesScheduledForDeletion->clear();
            }
            $this->personnagesScheduledForDeletion[]= $personnage;
            $personnage->setEtablissement(null);
        }

        return $this;
    }

    /**
     * Clears out the collTopCampings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addTopCampings()
     */
    public function clearTopCampings()
    {
        $this->collTopCampings = null; // important to set this to null since that means it is uninitialized
        $this->collTopCampingsPartial = null;

        return $this;
    }

    /**
     * reset is the collTopCampings collection loaded partially
     *
     * @return void
     */
    public function resetPartialTopCampings($v = true)
    {
        $this->collTopCampingsPartial = $v;
    }

    /**
     * Initializes the collTopCampings collection.
     *
     * By default this just sets the collTopCampings collection to an empty array (like clearcollTopCampings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTopCampings($overrideExisting = true)
    {
        if (null !== $this->collTopCampings && !$overrideExisting) {
            return;
        }
        $this->collTopCampings = new PropelObjectCollection();
        $this->collTopCampings->setModel('TopCamping');
    }

    /**
     * Gets an array of TopCamping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TopCamping[] List of TopCamping objects
     * @throws PropelException
     */
    public function getTopCampings($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTopCampingsPartial && !$this->isNew();
        if (null === $this->collTopCampings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTopCampings) {
                // return empty collection
                $this->initTopCampings();
            } else {
                $collTopCampings = TopCampingQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTopCampingsPartial && count($collTopCampings)) {
                      $this->initTopCampings(false);

                      foreach($collTopCampings as $obj) {
                        if (false == $this->collTopCampings->contains($obj)) {
                          $this->collTopCampings->append($obj);
                        }
                      }

                      $this->collTopCampingsPartial = true;
                    }

                    return $collTopCampings;
                }

                if($partial && $this->collTopCampings) {
                    foreach($this->collTopCampings as $obj) {
                        if($obj->isNew()) {
                            $collTopCampings[] = $obj;
                        }
                    }
                }

                $this->collTopCampings = $collTopCampings;
                $this->collTopCampingsPartial = false;
            }
        }

        return $this->collTopCampings;
    }

    /**
     * Sets a collection of TopCamping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $topCampings A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setTopCampings(PropelCollection $topCampings, PropelPDO $con = null)
    {
        $this->topCampingsScheduledForDeletion = $this->getTopCampings(new Criteria(), $con)->diff($topCampings);

        foreach ($this->topCampingsScheduledForDeletion as $topCampingRemoved) {
            $topCampingRemoved->setEtablissement(null);
        }

        $this->collTopCampings = null;
        foreach ($topCampings as $topCamping) {
            $this->addTopCamping($topCamping);
        }

        $this->collTopCampings = $topCampings;
        $this->collTopCampingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TopCamping objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TopCamping objects.
     * @throws PropelException
     */
    public function countTopCampings(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTopCampingsPartial && !$this->isNew();
        if (null === $this->collTopCampings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTopCampings) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTopCampings());
            }
            $query = TopCampingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collTopCampings);
    }

    /**
     * Method called to associate a TopCamping object to this object
     * through the TopCamping foreign key attribute.
     *
     * @param    TopCamping $l TopCamping
     * @return Etablissement The current object (for fluent API support)
     */
    public function addTopCamping(TopCamping $l)
    {
        if ($this->collTopCampings === null) {
            $this->initTopCampings();
            $this->collTopCampingsPartial = true;
        }
        if (!in_array($l, $this->collTopCampings->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTopCamping($l);
        }

        return $this;
    }

    /**
     * @param	TopCamping $topCamping The topCamping object to add.
     */
    protected function doAddTopCamping($topCamping)
    {
        $this->collTopCampings[]= $topCamping;
        $topCamping->setEtablissement($this);
    }

    /**
     * @param	TopCamping $topCamping The topCamping object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeTopCamping($topCamping)
    {
        if ($this->getTopCampings()->contains($topCamping)) {
            $this->collTopCampings->remove($this->collTopCampings->search($topCamping));
            if (null === $this->topCampingsScheduledForDeletion) {
                $this->topCampingsScheduledForDeletion = clone $this->collTopCampings;
                $this->topCampingsScheduledForDeletion->clear();
            }
            $this->topCampingsScheduledForDeletion[]= $topCamping;
            $topCamping->setEtablissement(null);
        }

        return $this;
    }

    /**
     * Clears out the collBonPlanEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addBonPlanEtablissements()
     */
    public function clearBonPlanEtablissements()
    {
        $this->collBonPlanEtablissements = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanEtablissementsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanEtablissements collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanEtablissements($v = true)
    {
        $this->collBonPlanEtablissementsPartial = $v;
    }

    /**
     * Initializes the collBonPlanEtablissements collection.
     *
     * By default this just sets the collBonPlanEtablissements collection to an empty array (like clearcollBonPlanEtablissements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanEtablissements($overrideExisting = true)
    {
        if (null !== $this->collBonPlanEtablissements && !$overrideExisting) {
            return;
        }
        $this->collBonPlanEtablissements = new PropelObjectCollection();
        $this->collBonPlanEtablissements->setModel('BonPlanEtablissement');
    }

    /**
     * Gets an array of BonPlanEtablissement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanEtablissement[] List of BonPlanEtablissement objects
     * @throws PropelException
     */
    public function getBonPlanEtablissements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanEtablissementsPartial && !$this->isNew();
        if (null === $this->collBonPlanEtablissements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanEtablissements) {
                // return empty collection
                $this->initBonPlanEtablissements();
            } else {
                $collBonPlanEtablissements = BonPlanEtablissementQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanEtablissementsPartial && count($collBonPlanEtablissements)) {
                      $this->initBonPlanEtablissements(false);

                      foreach($collBonPlanEtablissements as $obj) {
                        if (false == $this->collBonPlanEtablissements->contains($obj)) {
                          $this->collBonPlanEtablissements->append($obj);
                        }
                      }

                      $this->collBonPlanEtablissementsPartial = true;
                    }

                    return $collBonPlanEtablissements;
                }

                if($partial && $this->collBonPlanEtablissements) {
                    foreach($this->collBonPlanEtablissements as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanEtablissements[] = $obj;
                        }
                    }
                }

                $this->collBonPlanEtablissements = $collBonPlanEtablissements;
                $this->collBonPlanEtablissementsPartial = false;
            }
        }

        return $this->collBonPlanEtablissements;
    }

    /**
     * Sets a collection of BonPlanEtablissement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanEtablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setBonPlanEtablissements(PropelCollection $bonPlanEtablissements, PropelPDO $con = null)
    {
        $this->bonPlanEtablissementsScheduledForDeletion = $this->getBonPlanEtablissements(new Criteria(), $con)->diff($bonPlanEtablissements);

        foreach ($this->bonPlanEtablissementsScheduledForDeletion as $bonPlanEtablissementRemoved) {
            $bonPlanEtablissementRemoved->setEtablissement(null);
        }

        $this->collBonPlanEtablissements = null;
        foreach ($bonPlanEtablissements as $bonPlanEtablissement) {
            $this->addBonPlanEtablissement($bonPlanEtablissement);
        }

        $this->collBonPlanEtablissements = $bonPlanEtablissements;
        $this->collBonPlanEtablissementsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanEtablissement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanEtablissement objects.
     * @throws PropelException
     */
    public function countBonPlanEtablissements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanEtablissementsPartial && !$this->isNew();
        if (null === $this->collBonPlanEtablissements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanEtablissements) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanEtablissements());
            }
            $query = BonPlanEtablissementQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collBonPlanEtablissements);
    }

    /**
     * Method called to associate a BonPlanEtablissement object to this object
     * through the BonPlanEtablissement foreign key attribute.
     *
     * @param    BonPlanEtablissement $l BonPlanEtablissement
     * @return Etablissement The current object (for fluent API support)
     */
    public function addBonPlanEtablissement(BonPlanEtablissement $l)
    {
        if ($this->collBonPlanEtablissements === null) {
            $this->initBonPlanEtablissements();
            $this->collBonPlanEtablissementsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanEtablissements->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanEtablissement($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanEtablissement $bonPlanEtablissement The bonPlanEtablissement object to add.
     */
    protected function doAddBonPlanEtablissement($bonPlanEtablissement)
    {
        $this->collBonPlanEtablissements[]= $bonPlanEtablissement;
        $bonPlanEtablissement->setEtablissement($this);
    }

    /**
     * @param	BonPlanEtablissement $bonPlanEtablissement The bonPlanEtablissement object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeBonPlanEtablissement($bonPlanEtablissement)
    {
        if ($this->getBonPlanEtablissements()->contains($bonPlanEtablissement)) {
            $this->collBonPlanEtablissements->remove($this->collBonPlanEtablissements->search($bonPlanEtablissement));
            if (null === $this->bonPlanEtablissementsScheduledForDeletion) {
                $this->bonPlanEtablissementsScheduledForDeletion = clone $this->collBonPlanEtablissements;
                $this->bonPlanEtablissementsScheduledForDeletion->clear();
            }
            $this->bonPlanEtablissementsScheduledForDeletion[]= $bonPlanEtablissement;
            $bonPlanEtablissement->setEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related BonPlanEtablissements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanEtablissement[] List of BonPlanEtablissement objects
     */
    public function getBonPlanEtablissementsJoinBonPlan($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanEtablissementQuery::create(null, $criteria);
        $query->joinWith('BonPlan', $join_behavior);

        return $this->getBonPlanEtablissements($query, $con);
    }

    /**
     * Clears out the collDemandeAnnulations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addDemandeAnnulations()
     */
    public function clearDemandeAnnulations()
    {
        $this->collDemandeAnnulations = null; // important to set this to null since that means it is uninitialized
        $this->collDemandeAnnulationsPartial = null;

        return $this;
    }

    /**
     * reset is the collDemandeAnnulations collection loaded partially
     *
     * @return void
     */
    public function resetPartialDemandeAnnulations($v = true)
    {
        $this->collDemandeAnnulationsPartial = $v;
    }

    /**
     * Initializes the collDemandeAnnulations collection.
     *
     * By default this just sets the collDemandeAnnulations collection to an empty array (like clearcollDemandeAnnulations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDemandeAnnulations($overrideExisting = true)
    {
        if (null !== $this->collDemandeAnnulations && !$overrideExisting) {
            return;
        }
        $this->collDemandeAnnulations = new PropelObjectCollection();
        $this->collDemandeAnnulations->setModel('DemandeAnnulation');
    }

    /**
     * Gets an array of DemandeAnnulation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DemandeAnnulation[] List of DemandeAnnulation objects
     * @throws PropelException
     */
    public function getDemandeAnnulations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDemandeAnnulationsPartial && !$this->isNew();
        if (null === $this->collDemandeAnnulations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDemandeAnnulations) {
                // return empty collection
                $this->initDemandeAnnulations();
            } else {
                $collDemandeAnnulations = DemandeAnnulationQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDemandeAnnulationsPartial && count($collDemandeAnnulations)) {
                      $this->initDemandeAnnulations(false);

                      foreach($collDemandeAnnulations as $obj) {
                        if (false == $this->collDemandeAnnulations->contains($obj)) {
                          $this->collDemandeAnnulations->append($obj);
                        }
                      }

                      $this->collDemandeAnnulationsPartial = true;
                    }

                    return $collDemandeAnnulations;
                }

                if($partial && $this->collDemandeAnnulations) {
                    foreach($this->collDemandeAnnulations as $obj) {
                        if($obj->isNew()) {
                            $collDemandeAnnulations[] = $obj;
                        }
                    }
                }

                $this->collDemandeAnnulations = $collDemandeAnnulations;
                $this->collDemandeAnnulationsPartial = false;
            }
        }

        return $this->collDemandeAnnulations;
    }

    /**
     * Sets a collection of DemandeAnnulation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $demandeAnnulations A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setDemandeAnnulations(PropelCollection $demandeAnnulations, PropelPDO $con = null)
    {
        $this->demandeAnnulationsScheduledForDeletion = $this->getDemandeAnnulations(new Criteria(), $con)->diff($demandeAnnulations);

        foreach ($this->demandeAnnulationsScheduledForDeletion as $demandeAnnulationRemoved) {
            $demandeAnnulationRemoved->setEtablissement(null);
        }

        $this->collDemandeAnnulations = null;
        foreach ($demandeAnnulations as $demandeAnnulation) {
            $this->addDemandeAnnulation($demandeAnnulation);
        }

        $this->collDemandeAnnulations = $demandeAnnulations;
        $this->collDemandeAnnulationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DemandeAnnulation objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DemandeAnnulation objects.
     * @throws PropelException
     */
    public function countDemandeAnnulations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDemandeAnnulationsPartial && !$this->isNew();
        if (null === $this->collDemandeAnnulations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDemandeAnnulations) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getDemandeAnnulations());
            }
            $query = DemandeAnnulationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collDemandeAnnulations);
    }

    /**
     * Method called to associate a DemandeAnnulation object to this object
     * through the DemandeAnnulation foreign key attribute.
     *
     * @param    DemandeAnnulation $l DemandeAnnulation
     * @return Etablissement The current object (for fluent API support)
     */
    public function addDemandeAnnulation(DemandeAnnulation $l)
    {
        if ($this->collDemandeAnnulations === null) {
            $this->initDemandeAnnulations();
            $this->collDemandeAnnulationsPartial = true;
        }
        if (!in_array($l, $this->collDemandeAnnulations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDemandeAnnulation($l);
        }

        return $this;
    }

    /**
     * @param	DemandeAnnulation $demandeAnnulation The demandeAnnulation object to add.
     */
    protected function doAddDemandeAnnulation($demandeAnnulation)
    {
        $this->collDemandeAnnulations[]= $demandeAnnulation;
        $demandeAnnulation->setEtablissement($this);
    }

    /**
     * @param	DemandeAnnulation $demandeAnnulation The demandeAnnulation object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeDemandeAnnulation($demandeAnnulation)
    {
        if ($this->getDemandeAnnulations()->contains($demandeAnnulation)) {
            $this->collDemandeAnnulations->remove($this->collDemandeAnnulations->search($demandeAnnulation));
            if (null === $this->demandeAnnulationsScheduledForDeletion) {
                $this->demandeAnnulationsScheduledForDeletion = clone $this->collDemandeAnnulations;
                $this->demandeAnnulationsScheduledForDeletion->clear();
            }
            $this->demandeAnnulationsScheduledForDeletion[]= $demandeAnnulation;
            $demandeAnnulation->setEtablissement(null);
        }

        return $this;
    }

    /**
     * Clears out the collEtablissementI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEtablissementI18ns()
     */
    public function clearEtablissementI18ns()
    {
        $this->collEtablissementI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementI18ns($v = true)
    {
        $this->collEtablissementI18nsPartial = $v;
    }

    /**
     * Initializes the collEtablissementI18ns collection.
     *
     * By default this just sets the collEtablissementI18ns collection to an empty array (like clearcollEtablissementI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementI18ns($overrideExisting = true)
    {
        if (null !== $this->collEtablissementI18ns && !$overrideExisting) {
            return;
        }
        $this->collEtablissementI18ns = new PropelObjectCollection();
        $this->collEtablissementI18ns->setModel('EtablissementI18n');
    }

    /**
     * Gets an array of EtablissementI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementI18n[] List of EtablissementI18n objects
     * @throws PropelException
     */
    public function getEtablissementI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementI18nsPartial && !$this->isNew();
        if (null === $this->collEtablissementI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementI18ns) {
                // return empty collection
                $this->initEtablissementI18ns();
            } else {
                $collEtablissementI18ns = EtablissementI18nQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementI18nsPartial && count($collEtablissementI18ns)) {
                      $this->initEtablissementI18ns(false);

                      foreach($collEtablissementI18ns as $obj) {
                        if (false == $this->collEtablissementI18ns->contains($obj)) {
                          $this->collEtablissementI18ns->append($obj);
                        }
                      }

                      $this->collEtablissementI18nsPartial = true;
                    }

                    return $collEtablissementI18ns;
                }

                if($partial && $this->collEtablissementI18ns) {
                    foreach($this->collEtablissementI18ns as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementI18ns[] = $obj;
                        }
                    }
                }

                $this->collEtablissementI18ns = $collEtablissementI18ns;
                $this->collEtablissementI18nsPartial = false;
            }
        }

        return $this->collEtablissementI18ns;
    }

    /**
     * Sets a collection of EtablissementI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEtablissementI18ns(PropelCollection $etablissementI18ns, PropelPDO $con = null)
    {
        $this->etablissementI18nsScheduledForDeletion = $this->getEtablissementI18ns(new Criteria(), $con)->diff($etablissementI18ns);

        foreach ($this->etablissementI18nsScheduledForDeletion as $etablissementI18nRemoved) {
            $etablissementI18nRemoved->setEtablissement(null);
        }

        $this->collEtablissementI18ns = null;
        foreach ($etablissementI18ns as $etablissementI18n) {
            $this->addEtablissementI18n($etablissementI18n);
        }

        $this->collEtablissementI18ns = $etablissementI18ns;
        $this->collEtablissementI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementI18n objects.
     * @throws PropelException
     */
    public function countEtablissementI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementI18nsPartial && !$this->isNew();
        if (null === $this->collEtablissementI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementI18ns());
            }
            $query = EtablissementI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEtablissement($this)
                ->count($con);
        }

        return count($this->collEtablissementI18ns);
    }

    /**
     * Method called to associate a EtablissementI18n object to this object
     * through the EtablissementI18n foreign key attribute.
     *
     * @param    EtablissementI18n $l EtablissementI18n
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementI18n(EtablissementI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collEtablissementI18ns === null) {
            $this->initEtablissementI18ns();
            $this->collEtablissementI18nsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementI18n($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementI18n $etablissementI18n The etablissementI18n object to add.
     */
    protected function doAddEtablissementI18n($etablissementI18n)
    {
        $this->collEtablissementI18ns[]= $etablissementI18n;
        $etablissementI18n->setEtablissement($this);
    }

    /**
     * @param	EtablissementI18n $etablissementI18n The etablissementI18n object to remove.
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEtablissementI18n($etablissementI18n)
    {
        if ($this->getEtablissementI18ns()->contains($etablissementI18n)) {
            $this->collEtablissementI18ns->remove($this->collEtablissementI18ns->search($etablissementI18n));
            if (null === $this->etablissementI18nsScheduledForDeletion) {
                $this->etablissementI18nsScheduledForDeletion = clone $this->collEtablissementI18ns;
                $this->etablissementI18nsScheduledForDeletion->clear();
            }
            $this->etablissementI18nsScheduledForDeletion[]= $etablissementI18n;
            $etablissementI18n->setEtablissement(null);
        }

        return $this;
    }

    /**
     * Clears out the collTypeHebergements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addTypeHebergements()
     */
    public function clearTypeHebergements()
    {
        $this->collTypeHebergements = null; // important to set this to null since that means it is uninitialized
        $this->collTypeHebergementsPartial = null;

        return $this;
    }

    /**
     * Initializes the collTypeHebergements collection.
     *
     * By default this just sets the collTypeHebergements collection to an empty collection (like clearTypeHebergements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initTypeHebergements()
    {
        $this->collTypeHebergements = new PropelObjectCollection();
        $this->collTypeHebergements->setModel('TypeHebergement');
    }

    /**
     * Gets a collection of TypeHebergement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|TypeHebergement[] List of TypeHebergement objects
     */
    public function getTypeHebergements($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collTypeHebergements || null !== $criteria) {
            if ($this->isNew() && null === $this->collTypeHebergements) {
                // return empty collection
                $this->initTypeHebergements();
            } else {
                $collTypeHebergements = TypeHebergementQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collTypeHebergements;
                }
                $this->collTypeHebergements = $collTypeHebergements;
            }
        }

        return $this->collTypeHebergements;
    }

    /**
     * Sets a collection of TypeHebergement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeHebergements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setTypeHebergements(PropelCollection $typeHebergements, PropelPDO $con = null)
    {
        $this->clearTypeHebergements();
        $currentTypeHebergements = $this->getTypeHebergements();

        $this->typeHebergementsScheduledForDeletion = $currentTypeHebergements->diff($typeHebergements);

        foreach ($typeHebergements as $typeHebergement) {
            if (!$currentTypeHebergements->contains($typeHebergement)) {
                $this->doAddTypeHebergement($typeHebergement);
            }
        }

        $this->collTypeHebergements = $typeHebergements;

        return $this;
    }

    /**
     * Gets the number of TypeHebergement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related TypeHebergement objects
     */
    public function countTypeHebergements($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collTypeHebergements || null !== $criteria) {
            if ($this->isNew() && null === $this->collTypeHebergements) {
                return 0;
            } else {
                $query = TypeHebergementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collTypeHebergements);
        }
    }

    /**
     * Associate a TypeHebergement object to this object
     * through the etablissement_type_hebergement cross reference table.
     *
     * @param  TypeHebergement $typeHebergement The EtablissementTypeHebergement object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addTypeHebergement(TypeHebergement $typeHebergement)
    {
        if ($this->collTypeHebergements === null) {
            $this->initTypeHebergements();
        }
        if (!$this->collTypeHebergements->contains($typeHebergement)) { // only add it if the **same** object is not already associated
            $this->doAddTypeHebergement($typeHebergement);

            $this->collTypeHebergements[]= $typeHebergement;
        }

        return $this;
    }

    /**
     * @param	TypeHebergement $typeHebergement The typeHebergement object to add.
     */
    protected function doAddTypeHebergement($typeHebergement)
    {
        $etablissementTypeHebergement = new EtablissementTypeHebergement();
        $etablissementTypeHebergement->setTypeHebergement($typeHebergement);
        $this->addEtablissementTypeHebergement($etablissementTypeHebergement);
    }

    /**
     * Remove a TypeHebergement object to this object
     * through the etablissement_type_hebergement cross reference table.
     *
     * @param TypeHebergement $typeHebergement The EtablissementTypeHebergement object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeTypeHebergement(TypeHebergement $typeHebergement)
    {
        if ($this->getTypeHebergements()->contains($typeHebergement)) {
            $this->collTypeHebergements->remove($this->collTypeHebergements->search($typeHebergement));
            if (null === $this->typeHebergementsScheduledForDeletion) {
                $this->typeHebergementsScheduledForDeletion = clone $this->collTypeHebergements;
                $this->typeHebergementsScheduledForDeletion->clear();
            }
            $this->typeHebergementsScheduledForDeletion[]= $typeHebergement;
        }

        return $this;
    }

    /**
     * Clears out the collDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addDestinations()
     */
    public function clearDestinations()
    {
        $this->collDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collDestinationsPartial = null;

        return $this;
    }

    /**
     * Initializes the collDestinations collection.
     *
     * By default this just sets the collDestinations collection to an empty collection (like clearDestinations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initDestinations()
    {
        $this->collDestinations = new PropelObjectCollection();
        $this->collDestinations->setModel('Destination');
    }

    /**
     * Gets a collection of Destination objects related by a many-to-many relationship
     * to the current object by way of the etablissement_destination cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Destination[] List of Destination objects
     */
    public function getDestinations($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collDestinations || null !== $criteria) {
            if ($this->isNew() && null === $this->collDestinations) {
                // return empty collection
                $this->initDestinations();
            } else {
                $collDestinations = DestinationQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collDestinations;
                }
                $this->collDestinations = $collDestinations;
            }
        }

        return $this->collDestinations;
    }

    /**
     * Sets a collection of Destination objects related by a many-to-many relationship
     * to the current object by way of the etablissement_destination cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $destinations A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setDestinations(PropelCollection $destinations, PropelPDO $con = null)
    {
        $this->clearDestinations();
        $currentDestinations = $this->getDestinations();

        $this->destinationsScheduledForDeletion = $currentDestinations->diff($destinations);

        foreach ($destinations as $destination) {
            if (!$currentDestinations->contains($destination)) {
                $this->doAddDestination($destination);
            }
        }

        $this->collDestinations = $destinations;

        return $this;
    }

    /**
     * Gets the number of Destination objects related by a many-to-many relationship
     * to the current object by way of the etablissement_destination cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Destination objects
     */
    public function countDestinations($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collDestinations || null !== $criteria) {
            if ($this->isNew() && null === $this->collDestinations) {
                return 0;
            } else {
                $query = DestinationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collDestinations);
        }
    }

    /**
     * Associate a Destination object to this object
     * through the etablissement_destination cross reference table.
     *
     * @param  Destination $destination The EtablissementDestination object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addDestination(Destination $destination)
    {
        if ($this->collDestinations === null) {
            $this->initDestinations();
        }
        if (!$this->collDestinations->contains($destination)) { // only add it if the **same** object is not already associated
            $this->doAddDestination($destination);

            $this->collDestinations[]= $destination;
        }

        return $this;
    }

    /**
     * @param	Destination $destination The destination object to add.
     */
    protected function doAddDestination($destination)
    {
        $etablissementDestination = new EtablissementDestination();
        $etablissementDestination->setDestination($destination);
        $this->addEtablissementDestination($etablissementDestination);
    }

    /**
     * Remove a Destination object to this object
     * through the etablissement_destination cross reference table.
     *
     * @param Destination $destination The EtablissementDestination object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeDestination(Destination $destination)
    {
        if ($this->getDestinations()->contains($destination)) {
            $this->collDestinations->remove($this->collDestinations->search($destination));
            if (null === $this->destinationsScheduledForDeletion) {
                $this->destinationsScheduledForDeletion = clone $this->collDestinations;
                $this->destinationsScheduledForDeletion->clear();
            }
            $this->destinationsScheduledForDeletion[]= $destination;
        }

        return $this;
    }

    /**
     * Clears out the collActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addActivites()
     */
    public function clearActivites()
    {
        $this->collActivites = null; // important to set this to null since that means it is uninitialized
        $this->collActivitesPartial = null;

        return $this;
    }

    /**
     * Initializes the collActivites collection.
     *
     * By default this just sets the collActivites collection to an empty collection (like clearActivites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initActivites()
    {
        $this->collActivites = new PropelObjectCollection();
        $this->collActivites->setModel('Activite');
    }

    /**
     * Gets a collection of Activite objects related by a many-to-many relationship
     * to the current object by way of the etablissement_activite cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Activite[] List of Activite objects
     */
    public function getActivites($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collActivites || null !== $criteria) {
            if ($this->isNew() && null === $this->collActivites) {
                // return empty collection
                $this->initActivites();
            } else {
                $collActivites = ActiviteQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collActivites;
                }
                $this->collActivites = $collActivites;
            }
        }

        return $this->collActivites;
    }

    /**
     * Sets a collection of Activite objects related by a many-to-many relationship
     * to the current object by way of the etablissement_activite cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $activites A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setActivites(PropelCollection $activites, PropelPDO $con = null)
    {
        $this->clearActivites();
        $currentActivites = $this->getActivites();

        $this->activitesScheduledForDeletion = $currentActivites->diff($activites);

        foreach ($activites as $activite) {
            if (!$currentActivites->contains($activite)) {
                $this->doAddActivite($activite);
            }
        }

        $this->collActivites = $activites;

        return $this;
    }

    /**
     * Gets the number of Activite objects related by a many-to-many relationship
     * to the current object by way of the etablissement_activite cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Activite objects
     */
    public function countActivites($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collActivites || null !== $criteria) {
            if ($this->isNew() && null === $this->collActivites) {
                return 0;
            } else {
                $query = ActiviteQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collActivites);
        }
    }

    /**
     * Associate a Activite object to this object
     * through the etablissement_activite cross reference table.
     *
     * @param  Activite $activite The EtablissementActivite object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addActivite(Activite $activite)
    {
        if ($this->collActivites === null) {
            $this->initActivites();
        }
        if (!$this->collActivites->contains($activite)) { // only add it if the **same** object is not already associated
            $this->doAddActivite($activite);

            $this->collActivites[]= $activite;
        }

        return $this;
    }

    /**
     * @param	Activite $activite The activite object to add.
     */
    protected function doAddActivite($activite)
    {
        $etablissementActivite = new EtablissementActivite();
        $etablissementActivite->setActivite($activite);
        $this->addEtablissementActivite($etablissementActivite);
    }

    /**
     * Remove a Activite object to this object
     * through the etablissement_activite cross reference table.
     *
     * @param Activite $activite The EtablissementActivite object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeActivite(Activite $activite)
    {
        if ($this->getActivites()->contains($activite)) {
            $this->collActivites->remove($this->collActivites->search($activite));
            if (null === $this->activitesScheduledForDeletion) {
                $this->activitesScheduledForDeletion = clone $this->collActivites;
                $this->activitesScheduledForDeletion->clear();
            }
            $this->activitesScheduledForDeletion[]= $activite;
        }

        return $this;
    }

    /**
     * Clears out the collServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addServiceComplementaires()
     */
    public function clearServiceComplementaires()
    {
        $this->collServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collServiceComplementairesPartial = null;

        return $this;
    }

    /**
     * Initializes the collServiceComplementaires collection.
     *
     * By default this just sets the collServiceComplementaires collection to an empty collection (like clearServiceComplementaires());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initServiceComplementaires()
    {
        $this->collServiceComplementaires = new PropelObjectCollection();
        $this->collServiceComplementaires->setModel('ServiceComplementaire');
    }

    /**
     * Gets a collection of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the etablissement_service_complementaire cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|ServiceComplementaire[] List of ServiceComplementaire objects
     */
    public function getServiceComplementaires($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collServiceComplementaires || null !== $criteria) {
            if ($this->isNew() && null === $this->collServiceComplementaires) {
                // return empty collection
                $this->initServiceComplementaires();
            } else {
                $collServiceComplementaires = ServiceComplementaireQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collServiceComplementaires;
                }
                $this->collServiceComplementaires = $collServiceComplementaires;
            }
        }

        return $this->collServiceComplementaires;
    }

    /**
     * Sets a collection of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the etablissement_service_complementaire cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $serviceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setServiceComplementaires(PropelCollection $serviceComplementaires, PropelPDO $con = null)
    {
        $this->clearServiceComplementaires();
        $currentServiceComplementaires = $this->getServiceComplementaires();

        $this->serviceComplementairesScheduledForDeletion = $currentServiceComplementaires->diff($serviceComplementaires);

        foreach ($serviceComplementaires as $serviceComplementaire) {
            if (!$currentServiceComplementaires->contains($serviceComplementaire)) {
                $this->doAddServiceComplementaire($serviceComplementaire);
            }
        }

        $this->collServiceComplementaires = $serviceComplementaires;

        return $this;
    }

    /**
     * Gets the number of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the etablissement_service_complementaire cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related ServiceComplementaire objects
     */
    public function countServiceComplementaires($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collServiceComplementaires || null !== $criteria) {
            if ($this->isNew() && null === $this->collServiceComplementaires) {
                return 0;
            } else {
                $query = ServiceComplementaireQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collServiceComplementaires);
        }
    }

    /**
     * Associate a ServiceComplementaire object to this object
     * through the etablissement_service_complementaire cross reference table.
     *
     * @param  ServiceComplementaire $serviceComplementaire The EtablissementServiceComplementaire object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addServiceComplementaire(ServiceComplementaire $serviceComplementaire)
    {
        if ($this->collServiceComplementaires === null) {
            $this->initServiceComplementaires();
        }
        if (!$this->collServiceComplementaires->contains($serviceComplementaire)) { // only add it if the **same** object is not already associated
            $this->doAddServiceComplementaire($serviceComplementaire);

            $this->collServiceComplementaires[]= $serviceComplementaire;
        }

        return $this;
    }

    /**
     * @param	ServiceComplementaire $serviceComplementaire The serviceComplementaire object to add.
     */
    protected function doAddServiceComplementaire($serviceComplementaire)
    {
        $etablissementServiceComplementaire = new EtablissementServiceComplementaire();
        $etablissementServiceComplementaire->setServiceComplementaire($serviceComplementaire);
        $this->addEtablissementServiceComplementaire($etablissementServiceComplementaire);
    }

    /**
     * Remove a ServiceComplementaire object to this object
     * through the etablissement_service_complementaire cross reference table.
     *
     * @param ServiceComplementaire $serviceComplementaire The EtablissementServiceComplementaire object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeServiceComplementaire(ServiceComplementaire $serviceComplementaire)
    {
        if ($this->getServiceComplementaires()->contains($serviceComplementaire)) {
            $this->collServiceComplementaires->remove($this->collServiceComplementaires->search($serviceComplementaire));
            if (null === $this->serviceComplementairesScheduledForDeletion) {
                $this->serviceComplementairesScheduledForDeletion = clone $this->collServiceComplementaires;
                $this->serviceComplementairesScheduledForDeletion->clear();
            }
            $this->serviceComplementairesScheduledForDeletion[]= $serviceComplementaire;
        }

        return $this;
    }

    /**
     * Clears out the collSituationGeographiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addSituationGeographiques()
     */
    public function clearSituationGeographiques()
    {
        $this->collSituationGeographiques = null; // important to set this to null since that means it is uninitialized
        $this->collSituationGeographiquesPartial = null;

        return $this;
    }

    /**
     * Initializes the collSituationGeographiques collection.
     *
     * By default this just sets the collSituationGeographiques collection to an empty collection (like clearSituationGeographiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSituationGeographiques()
    {
        $this->collSituationGeographiques = new PropelObjectCollection();
        $this->collSituationGeographiques->setModel('SituationGeographique');
    }

    /**
     * Gets a collection of SituationGeographique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_situation_geographique cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|SituationGeographique[] List of SituationGeographique objects
     */
    public function getSituationGeographiques($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSituationGeographiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collSituationGeographiques) {
                // return empty collection
                $this->initSituationGeographiques();
            } else {
                $collSituationGeographiques = SituationGeographiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSituationGeographiques;
                }
                $this->collSituationGeographiques = $collSituationGeographiques;
            }
        }

        return $this->collSituationGeographiques;
    }

    /**
     * Sets a collection of SituationGeographique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_situation_geographique cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $situationGeographiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setSituationGeographiques(PropelCollection $situationGeographiques, PropelPDO $con = null)
    {
        $this->clearSituationGeographiques();
        $currentSituationGeographiques = $this->getSituationGeographiques();

        $this->situationGeographiquesScheduledForDeletion = $currentSituationGeographiques->diff($situationGeographiques);

        foreach ($situationGeographiques as $situationGeographique) {
            if (!$currentSituationGeographiques->contains($situationGeographique)) {
                $this->doAddSituationGeographique($situationGeographique);
            }
        }

        $this->collSituationGeographiques = $situationGeographiques;

        return $this;
    }

    /**
     * Gets the number of SituationGeographique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_situation_geographique cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related SituationGeographique objects
     */
    public function countSituationGeographiques($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSituationGeographiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collSituationGeographiques) {
                return 0;
            } else {
                $query = SituationGeographiqueQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collSituationGeographiques);
        }
    }

    /**
     * Associate a SituationGeographique object to this object
     * through the etablissement_situation_geographique cross reference table.
     *
     * @param  SituationGeographique $situationGeographique The EtablissementSituationGeographique object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addSituationGeographique(SituationGeographique $situationGeographique)
    {
        if ($this->collSituationGeographiques === null) {
            $this->initSituationGeographiques();
        }
        if (!$this->collSituationGeographiques->contains($situationGeographique)) { // only add it if the **same** object is not already associated
            $this->doAddSituationGeographique($situationGeographique);

            $this->collSituationGeographiques[]= $situationGeographique;
        }

        return $this;
    }

    /**
     * @param	SituationGeographique $situationGeographique The situationGeographique object to add.
     */
    protected function doAddSituationGeographique($situationGeographique)
    {
        $etablissementSituationGeographique = new EtablissementSituationGeographique();
        $etablissementSituationGeographique->setSituationGeographique($situationGeographique);
        $this->addEtablissementSituationGeographique($etablissementSituationGeographique);
    }

    /**
     * Remove a SituationGeographique object to this object
     * through the etablissement_situation_geographique cross reference table.
     *
     * @param SituationGeographique $situationGeographique The EtablissementSituationGeographique object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeSituationGeographique(SituationGeographique $situationGeographique)
    {
        if ($this->getSituationGeographiques()->contains($situationGeographique)) {
            $this->collSituationGeographiques->remove($this->collSituationGeographiques->search($situationGeographique));
            if (null === $this->situationGeographiquesScheduledForDeletion) {
                $this->situationGeographiquesScheduledForDeletion = clone $this->collSituationGeographiques;
                $this->situationGeographiquesScheduledForDeletion->clear();
            }
            $this->situationGeographiquesScheduledForDeletion[]= $situationGeographique;
        }

        return $this;
    }

    /**
     * Clears out the collBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addBaignades()
     */
    public function clearBaignades()
    {
        $this->collBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collBaignadesPartial = null;

        return $this;
    }

    /**
     * Initializes the collBaignades collection.
     *
     * By default this just sets the collBaignades collection to an empty collection (like clearBaignades());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBaignades()
    {
        $this->collBaignades = new PropelObjectCollection();
        $this->collBaignades->setModel('Baignade');
    }

    /**
     * Gets a collection of Baignade objects related by a many-to-many relationship
     * to the current object by way of the etablissement_baignade cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Baignade[] List of Baignade objects
     */
    public function getBaignades($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBaignades || null !== $criteria) {
            if ($this->isNew() && null === $this->collBaignades) {
                // return empty collection
                $this->initBaignades();
            } else {
                $collBaignades = BaignadeQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBaignades;
                }
                $this->collBaignades = $collBaignades;
            }
        }

        return $this->collBaignades;
    }

    /**
     * Sets a collection of Baignade objects related by a many-to-many relationship
     * to the current object by way of the etablissement_baignade cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $baignades A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setBaignades(PropelCollection $baignades, PropelPDO $con = null)
    {
        $this->clearBaignades();
        $currentBaignades = $this->getBaignades();

        $this->baignadesScheduledForDeletion = $currentBaignades->diff($baignades);

        foreach ($baignades as $baignade) {
            if (!$currentBaignades->contains($baignade)) {
                $this->doAddBaignade($baignade);
            }
        }

        $this->collBaignades = $baignades;

        return $this;
    }

    /**
     * Gets the number of Baignade objects related by a many-to-many relationship
     * to the current object by way of the etablissement_baignade cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Baignade objects
     */
    public function countBaignades($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBaignades || null !== $criteria) {
            if ($this->isNew() && null === $this->collBaignades) {
                return 0;
            } else {
                $query = BaignadeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collBaignades);
        }
    }

    /**
     * Associate a Baignade object to this object
     * through the etablissement_baignade cross reference table.
     *
     * @param  Baignade $baignade The EtablissementBaignade object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addBaignade(Baignade $baignade)
    {
        if ($this->collBaignades === null) {
            $this->initBaignades();
        }
        if (!$this->collBaignades->contains($baignade)) { // only add it if the **same** object is not already associated
            $this->doAddBaignade($baignade);

            $this->collBaignades[]= $baignade;
        }

        return $this;
    }

    /**
     * @param	Baignade $baignade The baignade object to add.
     */
    protected function doAddBaignade($baignade)
    {
        $etablissementBaignade = new EtablissementBaignade();
        $etablissementBaignade->setBaignade($baignade);
        $this->addEtablissementBaignade($etablissementBaignade);
    }

    /**
     * Remove a Baignade object to this object
     * through the etablissement_baignade cross reference table.
     *
     * @param Baignade $baignade The EtablissementBaignade object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeBaignade(Baignade $baignade)
    {
        if ($this->getBaignades()->contains($baignade)) {
            $this->collBaignades->remove($this->collBaignades->search($baignade));
            if (null === $this->baignadesScheduledForDeletion) {
                $this->baignadesScheduledForDeletion = clone $this->collBaignades;
                $this->baignadesScheduledForDeletion->clear();
            }
            $this->baignadesScheduledForDeletion[]= $baignade;
        }

        return $this;
    }

    /**
     * Clears out the collThematiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addThematiques()
     */
    public function clearThematiques()
    {
        $this->collThematiques = null; // important to set this to null since that means it is uninitialized
        $this->collThematiquesPartial = null;

        return $this;
    }

    /**
     * Initializes the collThematiques collection.
     *
     * By default this just sets the collThematiques collection to an empty collection (like clearThematiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initThematiques()
    {
        $this->collThematiques = new PropelObjectCollection();
        $this->collThematiques->setModel('Thematique');
    }

    /**
     * Gets a collection of Thematique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_thematique cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Thematique[] List of Thematique objects
     */
    public function getThematiques($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collThematiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collThematiques) {
                // return empty collection
                $this->initThematiques();
            } else {
                $collThematiques = ThematiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collThematiques;
                }
                $this->collThematiques = $collThematiques;
            }
        }

        return $this->collThematiques;
    }

    /**
     * Sets a collection of Thematique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_thematique cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $thematiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setThematiques(PropelCollection $thematiques, PropelPDO $con = null)
    {
        $this->clearThematiques();
        $currentThematiques = $this->getThematiques();

        $this->thematiquesScheduledForDeletion = $currentThematiques->diff($thematiques);

        foreach ($thematiques as $thematique) {
            if (!$currentThematiques->contains($thematique)) {
                $this->doAddThematique($thematique);
            }
        }

        $this->collThematiques = $thematiques;

        return $this;
    }

    /**
     * Gets the number of Thematique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_thematique cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Thematique objects
     */
    public function countThematiques($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collThematiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collThematiques) {
                return 0;
            } else {
                $query = ThematiqueQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collThematiques);
        }
    }

    /**
     * Associate a Thematique object to this object
     * through the etablissement_thematique cross reference table.
     *
     * @param  Thematique $thematique The EtablissementThematique object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addThematique(Thematique $thematique)
    {
        if ($this->collThematiques === null) {
            $this->initThematiques();
        }
        if (!$this->collThematiques->contains($thematique)) { // only add it if the **same** object is not already associated
            $this->doAddThematique($thematique);

            $this->collThematiques[]= $thematique;
        }

        return $this;
    }

    /**
     * @param	Thematique $thematique The thematique object to add.
     */
    protected function doAddThematique($thematique)
    {
        $etablissementThematique = new EtablissementThematique();
        $etablissementThematique->setThematique($thematique);
        $this->addEtablissementThematique($etablissementThematique);
    }

    /**
     * Remove a Thematique object to this object
     * through the etablissement_thematique cross reference table.
     *
     * @param Thematique $thematique The EtablissementThematique object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeThematique(Thematique $thematique)
    {
        if ($this->getThematiques()->contains($thematique)) {
            $this->collThematiques->remove($this->collThematiques->search($thematique));
            if (null === $this->thematiquesScheduledForDeletion) {
                $this->thematiquesScheduledForDeletion = clone $this->collThematiques;
                $this->thematiquesScheduledForDeletion->clear();
            }
            $this->thematiquesScheduledForDeletion[]= $thematique;
        }

        return $this;
    }

    /**
     * Clears out the collPointInterets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addPointInterets()
     */
    public function clearPointInterets()
    {
        $this->collPointInterets = null; // important to set this to null since that means it is uninitialized
        $this->collPointInteretsPartial = null;

        return $this;
    }

    /**
     * Initializes the collPointInterets collection.
     *
     * By default this just sets the collPointInterets collection to an empty collection (like clearPointInterets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPointInterets()
    {
        $this->collPointInterets = new PropelObjectCollection();
        $this->collPointInterets->setModel('PointInteret');
    }

    /**
     * Gets a collection of PointInteret objects related by a many-to-many relationship
     * to the current object by way of the etablissement_point_interet cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|PointInteret[] List of PointInteret objects
     */
    public function getPointInterets($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPointInterets || null !== $criteria) {
            if ($this->isNew() && null === $this->collPointInterets) {
                // return empty collection
                $this->initPointInterets();
            } else {
                $collPointInterets = PointInteretQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPointInterets;
                }
                $this->collPointInterets = $collPointInterets;
            }
        }

        return $this->collPointInterets;
    }

    /**
     * Sets a collection of PointInteret objects related by a many-to-many relationship
     * to the current object by way of the etablissement_point_interet cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pointInterets A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setPointInterets(PropelCollection $pointInterets, PropelPDO $con = null)
    {
        $this->clearPointInterets();
        $currentPointInterets = $this->getPointInterets();

        $this->pointInteretsScheduledForDeletion = $currentPointInterets->diff($pointInterets);

        foreach ($pointInterets as $pointInteret) {
            if (!$currentPointInterets->contains($pointInteret)) {
                $this->doAddPointInteret($pointInteret);
            }
        }

        $this->collPointInterets = $pointInterets;

        return $this;
    }

    /**
     * Gets the number of PointInteret objects related by a many-to-many relationship
     * to the current object by way of the etablissement_point_interet cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related PointInteret objects
     */
    public function countPointInterets($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPointInterets || null !== $criteria) {
            if ($this->isNew() && null === $this->collPointInterets) {
                return 0;
            } else {
                $query = PointInteretQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collPointInterets);
        }
    }

    /**
     * Associate a PointInteret object to this object
     * through the etablissement_point_interet cross reference table.
     *
     * @param  PointInteret $pointInteret The EtablissementPointInteret object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addPointInteret(PointInteret $pointInteret)
    {
        if ($this->collPointInterets === null) {
            $this->initPointInterets();
        }
        if (!$this->collPointInterets->contains($pointInteret)) { // only add it if the **same** object is not already associated
            $this->doAddPointInteret($pointInteret);

            $this->collPointInterets[]= $pointInteret;
        }

        return $this;
    }

    /**
     * @param	PointInteret $pointInteret The pointInteret object to add.
     */
    protected function doAddPointInteret($pointInteret)
    {
        $etablissementPointInteret = new EtablissementPointInteret();
        $etablissementPointInteret->setPointInteret($pointInteret);
        $this->addEtablissementPointInteret($etablissementPointInteret);
    }

    /**
     * Remove a PointInteret object to this object
     * through the etablissement_point_interet cross reference table.
     *
     * @param PointInteret $pointInteret The EtablissementPointInteret object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removePointInteret(PointInteret $pointInteret)
    {
        if ($this->getPointInterets()->contains($pointInteret)) {
            $this->collPointInterets->remove($this->collPointInterets->search($pointInteret));
            if (null === $this->pointInteretsScheduledForDeletion) {
                $this->pointInteretsScheduledForDeletion = clone $this->collPointInterets;
                $this->pointInteretsScheduledForDeletion->clear();
            }
            $this->pointInteretsScheduledForDeletion[]= $pointInteret;
        }

        return $this;
    }

    /**
     * Clears out the collEvents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addEvents()
     */
    public function clearEvents()
    {
        $this->collEvents = null; // important to set this to null since that means it is uninitialized
        $this->collEventsPartial = null;

        return $this;
    }

    /**
     * Initializes the collEvents collection.
     *
     * By default this just sets the collEvents collection to an empty collection (like clearEvents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initEvents()
    {
        $this->collEvents = new PropelObjectCollection();
        $this->collEvents->setModel('Event');
    }

    /**
     * Gets a collection of Event objects related by a many-to-many relationship
     * to the current object by way of the etablissement_event cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Event[] List of Event objects
     */
    public function getEvents($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collEvents || null !== $criteria) {
            if ($this->isNew() && null === $this->collEvents) {
                // return empty collection
                $this->initEvents();
            } else {
                $collEvents = EventQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collEvents;
                }
                $this->collEvents = $collEvents;
            }
        }

        return $this->collEvents;
    }

    /**
     * Sets a collection of Event objects related by a many-to-many relationship
     * to the current object by way of the etablissement_event cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $events A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setEvents(PropelCollection $events, PropelPDO $con = null)
    {
        $this->clearEvents();
        $currentEvents = $this->getEvents();

        $this->eventsScheduledForDeletion = $currentEvents->diff($events);

        foreach ($events as $event) {
            if (!$currentEvents->contains($event)) {
                $this->doAddEvent($event);
            }
        }

        $this->collEvents = $events;

        return $this;
    }

    /**
     * Gets the number of Event objects related by a many-to-many relationship
     * to the current object by way of the etablissement_event cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Event objects
     */
    public function countEvents($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collEvents || null !== $criteria) {
            if ($this->isNew() && null === $this->collEvents) {
                return 0;
            } else {
                $query = EventQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEvents);
        }
    }

    /**
     * Associate a Event object to this object
     * through the etablissement_event cross reference table.
     *
     * @param  Event $event The EtablissementEvent object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEvent(Event $event)
    {
        if ($this->collEvents === null) {
            $this->initEvents();
        }
        if (!$this->collEvents->contains($event)) { // only add it if the **same** object is not already associated
            $this->doAddEvent($event);

            $this->collEvents[]= $event;
        }

        return $this;
    }

    /**
     * @param	Event $event The event object to add.
     */
    protected function doAddEvent($event)
    {
        $etablissementEvent = new EtablissementEvent();
        $etablissementEvent->setEvent($event);
        $this->addEtablissementEvent($etablissementEvent);
    }

    /**
     * Remove a Event object to this object
     * through the etablissement_event cross reference table.
     *
     * @param Event $event The EtablissementEvent object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeEvent(Event $event)
    {
        if ($this->getEvents()->contains($event)) {
            $this->collEvents->remove($this->collEvents->search($event));
            if (null === $this->eventsScheduledForDeletion) {
                $this->eventsScheduledForDeletion = clone $this->collEvents;
                $this->eventsScheduledForDeletion->clear();
            }
            $this->eventsScheduledForDeletion[]= $event;
        }

        return $this;
    }

    /**
     * Clears out the collBonPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Etablissement The current object (for fluent API support)
     * @see        addBonPlans()
     */
    public function clearBonPlans()
    {
        $this->collBonPlans = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlansPartial = null;

        return $this;
    }

    /**
     * Initializes the collBonPlans collection.
     *
     * By default this just sets the collBonPlans collection to an empty collection (like clearBonPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBonPlans()
    {
        $this->collBonPlans = new PropelObjectCollection();
        $this->collBonPlans->setModel('BonPlan');
    }

    /**
     * Gets a collection of BonPlan objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_etablissement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|BonPlan[] List of BonPlan objects
     */
    public function getBonPlans($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBonPlans || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonPlans) {
                // return empty collection
                $this->initBonPlans();
            } else {
                $collBonPlans = BonPlanQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBonPlans;
                }
                $this->collBonPlans = $collBonPlans;
            }
        }

        return $this->collBonPlans;
    }

    /**
     * Sets a collection of BonPlan objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_etablissement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlans A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Etablissement The current object (for fluent API support)
     */
    public function setBonPlans(PropelCollection $bonPlans, PropelPDO $con = null)
    {
        $this->clearBonPlans();
        $currentBonPlans = $this->getBonPlans();

        $this->bonPlansScheduledForDeletion = $currentBonPlans->diff($bonPlans);

        foreach ($bonPlans as $bonPlan) {
            if (!$currentBonPlans->contains($bonPlan)) {
                $this->doAddBonPlan($bonPlan);
            }
        }

        $this->collBonPlans = $bonPlans;

        return $this;
    }

    /**
     * Gets the number of BonPlan objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_etablissement cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related BonPlan objects
     */
    public function countBonPlans($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBonPlans || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonPlans) {
                return 0;
            } else {
                $query = BonPlanQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonPlans);
        }
    }

    /**
     * Associate a BonPlan object to this object
     * through the bon_plan_etablissement cross reference table.
     *
     * @param  BonPlan $bonPlan The BonPlanEtablissement object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function addBonPlan(BonPlan $bonPlan)
    {
        if ($this->collBonPlans === null) {
            $this->initBonPlans();
        }
        if (!$this->collBonPlans->contains($bonPlan)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlan($bonPlan);

            $this->collBonPlans[]= $bonPlan;
        }

        return $this;
    }

    /**
     * @param	BonPlan $bonPlan The bonPlan object to add.
     */
    protected function doAddBonPlan($bonPlan)
    {
        $bonPlanEtablissement = new BonPlanEtablissement();
        $bonPlanEtablissement->setBonPlan($bonPlan);
        $this->addBonPlanEtablissement($bonPlanEtablissement);
    }

    /**
     * Remove a BonPlan object to this object
     * through the bon_plan_etablissement cross reference table.
     *
     * @param BonPlan $bonPlan The BonPlanEtablissement object to relate
     * @return Etablissement The current object (for fluent API support)
     */
    public function removeBonPlan(BonPlan $bonPlan)
    {
        if ($this->getBonPlans()->contains($bonPlan)) {
            $this->collBonPlans->remove($this->collBonPlans->search($bonPlan));
            if (null === $this->bonPlansScheduledForDeletion) {
                $this->bonPlansScheduledForDeletion = clone $this->collBonPlans;
                $this->bonPlansScheduledForDeletion->clear();
            }
            $this->bonPlansScheduledForDeletion[]= $bonPlan;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->code = null;
        $this->slug = null;
        $this->name = null;
        $this->title = null;
        $this->address1 = null;
        $this->address2 = null;
        $this->zip = null;
        $this->city = null;
        $this->mail = null;
        $this->country_code = null;
        $this->phone1 = null;
        $this->phone2 = null;
        $this->fax = null;
        $this->opening_date = null;
        $this->closing_date = null;
        $this->ville_id = null;
        $this->departement_id = null;
        $this->categorie_id = null;
        $this->geo_coordinate_x = null;
        $this->geo_coordinate_y = null;
        $this->video_path = null;
        $this->image_360_path = null;
        $this->capacite = null;
        $this->related_1 = null;
        $this->related_2 = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->active = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collEtablissementsRelatedById0) {
                foreach ($this->collEtablissementsRelatedById0 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementsRelatedById1) {
                foreach ($this->collEtablissementsRelatedById1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementTypeHebergements) {
                foreach ($this->collEtablissementTypeHebergements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementDestinations) {
                foreach ($this->collEtablissementDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementActivites) {
                foreach ($this->collEtablissementActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementServiceComplementaires) {
                foreach ($this->collEtablissementServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementSituationGeographiques) {
                foreach ($this->collEtablissementSituationGeographiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementBaignades) {
                foreach ($this->collEtablissementBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementThematiques) {
                foreach ($this->collEtablissementThematiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementPointInterets) {
                foreach ($this->collEtablissementPointInterets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementEvents) {
                foreach ($this->collEtablissementEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPersonnages) {
                foreach ($this->collPersonnages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTopCampings) {
                foreach ($this->collTopCampings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanEtablissements) {
                foreach ($this->collBonPlanEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDemandeAnnulations) {
                foreach ($this->collDemandeAnnulations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementI18ns) {
                foreach ($this->collEtablissementI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeHebergements) {
                foreach ($this->collTypeHebergements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDestinations) {
                foreach ($this->collDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collActivites) {
                foreach ($this->collActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collServiceComplementaires) {
                foreach ($this->collServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSituationGeographiques) {
                foreach ($this->collSituationGeographiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBaignades) {
                foreach ($this->collBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThematiques) {
                foreach ($this->collThematiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPointInterets) {
                foreach ($this->collPointInterets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEvents) {
                foreach ($this->collEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlans) {
                foreach ($this->collBonPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collEtablissementsRelatedById0 instanceof PropelCollection) {
            $this->collEtablissementsRelatedById0->clearIterator();
        }
        $this->collEtablissementsRelatedById0 = null;
        if ($this->collEtablissementsRelatedById1 instanceof PropelCollection) {
            $this->collEtablissementsRelatedById1->clearIterator();
        }
        $this->collEtablissementsRelatedById1 = null;
        if ($this->collEtablissementTypeHebergements instanceof PropelCollection) {
            $this->collEtablissementTypeHebergements->clearIterator();
        }
        $this->collEtablissementTypeHebergements = null;
        if ($this->collEtablissementDestinations instanceof PropelCollection) {
            $this->collEtablissementDestinations->clearIterator();
        }
        $this->collEtablissementDestinations = null;
        if ($this->collEtablissementActivites instanceof PropelCollection) {
            $this->collEtablissementActivites->clearIterator();
        }
        $this->collEtablissementActivites = null;
        if ($this->collEtablissementServiceComplementaires instanceof PropelCollection) {
            $this->collEtablissementServiceComplementaires->clearIterator();
        }
        $this->collEtablissementServiceComplementaires = null;
        if ($this->collEtablissementSituationGeographiques instanceof PropelCollection) {
            $this->collEtablissementSituationGeographiques->clearIterator();
        }
        $this->collEtablissementSituationGeographiques = null;
        if ($this->collEtablissementBaignades instanceof PropelCollection) {
            $this->collEtablissementBaignades->clearIterator();
        }
        $this->collEtablissementBaignades = null;
        if ($this->collEtablissementThematiques instanceof PropelCollection) {
            $this->collEtablissementThematiques->clearIterator();
        }
        $this->collEtablissementThematiques = null;
        if ($this->collEtablissementPointInterets instanceof PropelCollection) {
            $this->collEtablissementPointInterets->clearIterator();
        }
        $this->collEtablissementPointInterets = null;
        if ($this->collEtablissementEvents instanceof PropelCollection) {
            $this->collEtablissementEvents->clearIterator();
        }
        $this->collEtablissementEvents = null;
        if ($this->collPersonnages instanceof PropelCollection) {
            $this->collPersonnages->clearIterator();
        }
        $this->collPersonnages = null;
        if ($this->collTopCampings instanceof PropelCollection) {
            $this->collTopCampings->clearIterator();
        }
        $this->collTopCampings = null;
        if ($this->collBonPlanEtablissements instanceof PropelCollection) {
            $this->collBonPlanEtablissements->clearIterator();
        }
        $this->collBonPlanEtablissements = null;
        if ($this->collDemandeAnnulations instanceof PropelCollection) {
            $this->collDemandeAnnulations->clearIterator();
        }
        $this->collDemandeAnnulations = null;
        if ($this->collEtablissementI18ns instanceof PropelCollection) {
            $this->collEtablissementI18ns->clearIterator();
        }
        $this->collEtablissementI18ns = null;
        if ($this->collTypeHebergements instanceof PropelCollection) {
            $this->collTypeHebergements->clearIterator();
        }
        $this->collTypeHebergements = null;
        if ($this->collDestinations instanceof PropelCollection) {
            $this->collDestinations->clearIterator();
        }
        $this->collDestinations = null;
        if ($this->collActivites instanceof PropelCollection) {
            $this->collActivites->clearIterator();
        }
        $this->collActivites = null;
        if ($this->collServiceComplementaires instanceof PropelCollection) {
            $this->collServiceComplementaires->clearIterator();
        }
        $this->collServiceComplementaires = null;
        if ($this->collSituationGeographiques instanceof PropelCollection) {
            $this->collSituationGeographiques->clearIterator();
        }
        $this->collSituationGeographiques = null;
        if ($this->collBaignades instanceof PropelCollection) {
            $this->collBaignades->clearIterator();
        }
        $this->collBaignades = null;
        if ($this->collThematiques instanceof PropelCollection) {
            $this->collThematiques->clearIterator();
        }
        $this->collThematiques = null;
        if ($this->collPointInterets instanceof PropelCollection) {
            $this->collPointInterets->clearIterator();
        }
        $this->collPointInterets = null;
        if ($this->collEvents instanceof PropelCollection) {
            $this->collEvents->clearIterator();
        }
        $this->collEvents = null;
        if ($this->collBonPlans instanceof PropelCollection) {
            $this->collBonPlans->clearIterator();
        }
        $this->collBonPlans = null;
        $this->aVille = null;
        $this->aDepartement = null;
        $this->aCategorie = null;
        $this->aEtablissementRelatedByRelated1 = null;
        $this->aEtablissementRelatedByRelated2 = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EtablissementPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Etablissement The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = EtablissementPeer::UPDATED_AT;

        return $this;
    }

    // active behavior


    /**
     * return true is the object is active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * return true is the object is active locale
     *
     * @return boolean
     */
    public function isActiveLocale()
    {
        return $this->getActiveLocale();
    }

    public function getTypeHebergementsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\TypeHebergementPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\TypeHebergementI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\TypeHebergementPeer::ID, \Cungfoo\Model\TypeHebergementI18nPeer::alias('i18n_locale', \Cungfoo\Model\TypeHebergementI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\TypeHebergementI18nPeer::alias('i18n_locale', \Cungfoo\Model\TypeHebergementI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\TypeHebergementI18nPeer::alias('i18n_locale', \Cungfoo\Model\TypeHebergementI18nPeer::LOCALE), $this->currentLocale);

        return $this->getTypeHebergements($criteria, $con);
    }

    public function getDestinationsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\DestinationPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\DestinationI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\DestinationPeer::ID, \Cungfoo\Model\DestinationI18nPeer::alias('i18n_locale', \Cungfoo\Model\DestinationI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\DestinationI18nPeer::alias('i18n_locale', \Cungfoo\Model\DestinationI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\DestinationI18nPeer::alias('i18n_locale', \Cungfoo\Model\DestinationI18nPeer::LOCALE), $this->currentLocale);

        return $this->getDestinations($criteria, $con);
    }

    public function getActivitesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\ActivitePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ActivitePeer::ID, \Cungfoo\Model\ActiviteI18nPeer::alias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ActiviteI18nPeer::alias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ActiviteI18nPeer::alias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::LOCALE), $this->currentLocale);

        return $this->getActivites($criteria, $con);
    }

    public function getServiceComplementairesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\ServiceComplementairePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ServiceComplementairePeer::ID, \Cungfoo\Model\ServiceComplementaireI18nPeer::alias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ServiceComplementaireI18nPeer::alias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ServiceComplementaireI18nPeer::alias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::LOCALE), $this->currentLocale);

        return $this->getServiceComplementaires($criteria, $con);
    }

    public function getSituationGeographiquesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\SituationGeographiquePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\SituationGeographiqueI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\SituationGeographiquePeer::ID, \Cungfoo\Model\SituationGeographiqueI18nPeer::alias('i18n_locale', \Cungfoo\Model\SituationGeographiqueI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\SituationGeographiqueI18nPeer::alias('i18n_locale', \Cungfoo\Model\SituationGeographiqueI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\SituationGeographiqueI18nPeer::alias('i18n_locale', \Cungfoo\Model\SituationGeographiqueI18nPeer::LOCALE), $this->currentLocale);

        return $this->getSituationGeographiques($criteria, $con);
    }

    public function getBaignadesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\BaignadePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\BaignadePeer::ID, \Cungfoo\Model\BaignadeI18nPeer::alias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\BaignadeI18nPeer::alias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\BaignadeI18nPeer::alias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::LOCALE), $this->currentLocale);

        return $this->getBaignades($criteria, $con);
    }

    public function getThematiquesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\ThematiquePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ThematiqueI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ThematiquePeer::ID, \Cungfoo\Model\ThematiqueI18nPeer::alias('i18n_locale', \Cungfoo\Model\ThematiqueI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ThematiqueI18nPeer::alias('i18n_locale', \Cungfoo\Model\ThematiqueI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ThematiqueI18nPeer::alias('i18n_locale', \Cungfoo\Model\ThematiqueI18nPeer::LOCALE), $this->currentLocale);

        return $this->getThematiques($criteria, $con);
    }

    public function getPointInteretsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\PointInteretPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PointInteretI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PointInteretPeer::ID, \Cungfoo\Model\PointInteretI18nPeer::alias('i18n_locale', \Cungfoo\Model\PointInteretI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PointInteretI18nPeer::alias('i18n_locale', \Cungfoo\Model\PointInteretI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PointInteretI18nPeer::alias('i18n_locale', \Cungfoo\Model\PointInteretI18nPeer::LOCALE), $this->currentLocale);

        return $this->getPointInterets($criteria, $con);
    }

    public function getEventsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\EventPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\EventI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\EventPeer::ID, \Cungfoo\Model\EventI18nPeer::alias('i18n_locale', \Cungfoo\Model\EventI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\EventI18nPeer::alias('i18n_locale', \Cungfoo\Model\EventI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\EventI18nPeer::alias('i18n_locale', \Cungfoo\Model\EventI18nPeer::LOCALE), $this->currentLocale);

        return $this->getEvents($criteria, $con);
    }

    public function getBonPlansActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\BonPlanPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\BonPlanPeer::ID, \Cungfoo\Model\BonPlanI18nPeer::alias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\BonPlanI18nPeer::alias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\BonPlanI18nPeer::alias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::LOCALE), $this->currentLocale);

        return $this->getBonPlans($criteria, $con);
    }

    public function getsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\Peer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\I18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\Peer::ID, \Cungfoo\Model\I18nPeer::alias('i18n_locale', \Cungfoo\Model\I18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\I18nPeer::alias('i18n_locale', \Cungfoo\Model\I18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\I18nPeer::alias('i18n_locale', \Cungfoo\Model\I18nPeer::LOCALE), $this->currentLocale);

        return $this->gets($criteria, $con);
    }

    public function getPersonnagesActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\PersonnagePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PersonnagePeer::ID, \Cungfoo\Model\PersonnageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PersonnageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PersonnageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::LOCALE), $this->currentLocale);

        return $this->getPersonnages($criteria, $con);
    }

    public function getTopCampingsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\TopCampingPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\TopCampingI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\TopCampingPeer::ID, \Cungfoo\Model\TopCampingI18nPeer::alias('i18n_locale', \Cungfoo\Model\TopCampingI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\TopCampingI18nPeer::alias('i18n_locale', \Cungfoo\Model\TopCampingI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\TopCampingI18nPeer::alias('i18n_locale', \Cungfoo\Model\TopCampingI18nPeer::LOCALE), $this->currentLocale);

        return $this->getTopCampings($criteria, $con);
    }

    public function getDemandeAnnulationsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\DemandeAnnulationPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\DemandeAnnulationI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\DemandeAnnulationPeer::ID, \Cungfoo\Model\DemandeAnnulationI18nPeer::alias('i18n_locale', \Cungfoo\Model\DemandeAnnulationI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\DemandeAnnulationI18nPeer::alias('i18n_locale', \Cungfoo\Model\DemandeAnnulationI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\DemandeAnnulationI18nPeer::alias('i18n_locale', \Cungfoo\Model\DemandeAnnulationI18nPeer::LOCALE), $this->currentLocale);

        return $this->getDemandeAnnulations($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Etablissement The current object (for fluent API support)
     */
    public function setLocale($locale = 'fr')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return EtablissementI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collEtablissementI18ns) {
                foreach ($this->collEtablissementI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new EtablissementI18n();
                $translation->setLocale($locale);
            } else {
                $translation = EtablissementI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addEtablissementI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Etablissement The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            EtablissementI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collEtablissementI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collEtablissementI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     PropelPDO $con an optional connection object
     *
     * @return EtablissementI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [country] column value.
         *
         * @return string
         */
        public function getCountry()
        {
        return $this->getCurrentTranslation()->getCountry();
    }


        /**
         * Set the value of [country] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setCountry($v)
        {    $this->getCurrentTranslation()->setCountry($v);

        return $this;
    }


        /**
         * Get the [ouverture_reception] column value.
         *
         * @return string
         */
        public function getOuvertureReception()
        {
        return $this->getCurrentTranslation()->getOuvertureReception();
    }


        /**
         * Set the value of [ouverture_reception] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setOuvertureReception($v)
        {    $this->getCurrentTranslation()->setOuvertureReception($v);

        return $this;
    }


        /**
         * Get the [ouverture_camping] column value.
         *
         * @return string
         */
        public function getOuvertureCamping()
        {
        return $this->getCurrentTranslation()->getOuvertureCamping();
    }


        /**
         * Set the value of [ouverture_camping] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setOuvertureCamping($v)
        {    $this->getCurrentTranslation()->setOuvertureCamping($v);

        return $this;
    }


        /**
         * Get the [arrivees_departs] column value.
         *
         * @return string
         */
        public function getArriveesDeparts()
        {
        return $this->getCurrentTranslation()->getArriveesDeparts();
    }


        /**
         * Set the value of [arrivees_departs] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setArriveesDeparts($v)
        {    $this->getCurrentTranslation()->setArriveesDeparts($v);

        return $this;
    }


        /**
         * Get the [description] column value.
         *
         * @return string
         */
        public function getDescription()
        {
        return $this->getCurrentTranslation()->getDescription();
    }


        /**
         * Set the value of [description] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }

    /**
     * Get the [seo_title] column value.
     *
     * @return string
     */
    public function getSeoTitle()
    {
        if (trim($this->getCurrentTranslation()->getSeoTitle()))
        {
            return trim($this->getCurrentTranslation()->getSeoTitle());
        }

        $peerClassName = self::PEER;
        if ($peerClassName::getSeo())
        {
            return $peerClassName::getSeo($this->currentLocale)->getSeoTitle();
        }

        return '';
    }



        /**
         * Set the value of [seo_title] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setSeoTitle($v)
        {    $this->getCurrentTranslation()->setSeoTitle($v);

        return $this;
    }

    /**
     * Get the [seo_description] column value.
     *
     * @return string
     */
    public function getSeoDescription()
    {
        if (trim($this->getCurrentTranslation()->getSeoDescription()))
        {
            return trim($this->getCurrentTranslation()->getSeoDescription());
        }

        $peerClassName = self::PEER;
        if ($peerClassName::getSeo())
        {
            return $peerClassName::getSeo($this->currentLocale)->getSeoDescription();
        }

        return '';
    }



        /**
         * Set the value of [seo_description] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setSeoDescription($v)
        {    $this->getCurrentTranslation()->setSeoDescription($v);

        return $this;
    }

    /**
     * Get the [seo_h1] column value.
     *
     * @return string
     */
    public function getSeoH1()
    {
        if (trim($this->getCurrentTranslation()->getSeoH1()))
        {
            return trim($this->getCurrentTranslation()->getSeoH1());
        }

        $peerClassName = self::PEER;
        if ($peerClassName::getSeo())
        {
            return $peerClassName::getSeo($this->currentLocale)->getSeoH1();
        }

        return '';
    }



        /**
         * Set the value of [seo_h1] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setSeoH1($v)
        {    $this->getCurrentTranslation()->setSeoH1($v);

        return $this;
    }

    /**
     * Get the [seo_keywords] column value.
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        if (trim($this->getCurrentTranslation()->getSeoKeywords()))
        {
            return trim($this->getCurrentTranslation()->getSeoKeywords());
        }

        $peerClassName = self::PEER;
        if ($peerClassName::getSeo())
        {
            return $peerClassName::getSeo($this->currentLocale)->getSeoKeywords();
        }

        return '';
    }



        /**
         * Set the value of [seo_keywords] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setSeoKeywords($v)
        {    $this->getCurrentTranslation()->setSeoKeywords($v);

        return $this;
    }


        /**
         * Get the [active_locale] column value.
         *
         * @return boolean
         */
        public function getActiveLocale()
        {
        return $this->getCurrentTranslation()->getActiveLocale();
    }


        /**
         * Set the value of [active_locale] column.
         *
         * @param boolean $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setActiveLocale($v)
        {    $this->getCurrentTranslation()->setActiveLocale($v);

        return $this;
    }

    // crudable behavior

    /**
     * @param \Symfony\Component\Form\Form $form
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function saveFromCrud(\Symfony\Component\Form\Form $form, PropelPDO $con = null)
    {
        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/etablissements';
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * @return void
     */
    public function getPlan()
    {
        $peer = self::PEER;

        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('plan')
                ->filterByElementId($this->getId())
            ->endUse()
            ->find()
            ->toArray()
        ;

        return implode(';', $medias);
    }

    /**
     * @return void
     */
    public function setPlan($v)
    {
        $peer = self::PEER;

        $values = explode(';', $v);

        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('plan')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;

        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('plan')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;

                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('plan')
                        ->setElementId($this->getId())
                        ->setMediaId($value)
                    ;
                }

                $usage
                    ->setSortableRank($index)
                    ->save()
                ;
            }

        }
    }

    /**
     * @return void
     */
    public function getVignette()
    {
        $peer = self::PEER;

        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('vignette')
                ->filterByElementId($this->getId())
            ->endUse()
            ->find()
            ->toArray()
        ;

        return implode(';', $medias);
    }

    /**
     * @return void
     */
    public function setVignette($v)
    {
        $peer = self::PEER;

        $values = explode(';', $v);

        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('vignette')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;

        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('vignette')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;

                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('vignette')
                        ->setElementId($this->getId())
                        ->setMediaId($value)
                    ;
                }

                $usage
                    ->setSortableRank($index)
                    ->save()
                ;
            }

        }
    }

    /**
     * @return void
     */
    public function getSlider()
    {
        $peer = self::PEER;

        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('slider')
                ->filterByElementId($this->getId())
            ->endUse()
            ->find()
            ->toArray()
        ;

        return implode(';', $medias);
    }

    /**
     * @return void
     */
    public function setSlider($v)
    {
        $peer = self::PEER;

        $values = explode(';', $v);

        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('slider')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;

        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('slider')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;

                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('slider')
                        ->setElementId($this->getId())
                        ->setMediaId($value)
                    ;
                }

                $usage
                    ->setSortableRank($index)
                    ->save()
                ;
            }

        }
    }

}
