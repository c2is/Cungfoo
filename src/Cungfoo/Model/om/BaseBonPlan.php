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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanBonPlanCategorie;
use Cungfoo\Model\BonPlanBonPlanCategorieQuery;
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanCategorieQuery;
use Cungfoo\Model\BonPlanEtablissement;
use Cungfoo\Model\BonPlanEtablissementQuery;
use Cungfoo\Model\BonPlanI18n;
use Cungfoo\Model\BonPlanI18nQuery;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\BonPlanQuery;
use Cungfoo\Model\BonPlanRegion;
use Cungfoo\Model\BonPlanRegionQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\Region;
use Cungfoo\Model\RegionQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'bon_plan' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlan extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\BonPlanPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BonPlanPeer
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
     * The value for the date_debut field.
     * @var        string
     */
    protected $date_debut;

    /**
     * The value for the date_fin field.
     * @var        string
     */
    protected $date_fin;

    /**
     * The value for the prix field.
     * @var        int
     */
    protected $prix;

    /**
     * The value for the prix_barre field.
     * @var        int
     */
    protected $prix_barre;

    /**
     * The value for the image_menu field.
     * @var        string
     */
    protected $image_menu;

    /**
     * The value for the image_page field.
     * @var        string
     */
    protected $image_page;

    /**
     * The value for the image_liste field.
     * @var        string
     */
    protected $image_liste;

    /**
     * The value for the active_compteur field.
     * @var        boolean
     */
    protected $active_compteur;

    /**
     * The value for the mise_en_avant field.
     * @var        boolean
     */
    protected $mise_en_avant;

    /**
     * The value for the push_home field.
     * @var        boolean
     */
    protected $push_home;

    /**
     * The value for the date_start field.
     * @var        string
     */
    protected $date_start;

    /**
     * The value for the day_start field.
     * @var        int
     */
    protected $day_start;

    /**
     * The value for the day_range field.
     * @var        int
     */
    protected $day_range;

    /**
     * The value for the nb_adultes field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $nb_adultes;

    /**
     * The value for the nb_enfants field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $nb_enfants;

    /**
     * The value for the period_categories field.
     * @var        string
     */
    protected $period_categories;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        PropelObjectCollection|BonPlanBonPlanCategorie[] Collection to store aggregation of BonPlanBonPlanCategorie objects.
     */
    protected $collBonPlanBonPlanCategories;
    protected $collBonPlanBonPlanCategoriesPartial;

    /**
     * @var        PropelObjectCollection|BonPlanEtablissement[] Collection to store aggregation of BonPlanEtablissement objects.
     */
    protected $collBonPlanEtablissements;
    protected $collBonPlanEtablissementsPartial;

    /**
     * @var        PropelObjectCollection|BonPlanRegion[] Collection to store aggregation of BonPlanRegion objects.
     */
    protected $collBonPlanRegions;
    protected $collBonPlanRegionsPartial;

    /**
     * @var        PropelObjectCollection|BonPlanI18n[] Collection to store aggregation of BonPlanI18n objects.
     */
    protected $collBonPlanI18ns;
    protected $collBonPlanI18nsPartial;

    /**
     * @var        PropelObjectCollection|BonPlanCategorie[] Collection to store aggregation of BonPlanCategorie objects.
     */
    protected $collBonPlanCategories;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissements;

    /**
     * @var        PropelObjectCollection|Region[] Collection to store aggregation of Region objects.
     */
    protected $collRegions;

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
     * @var        array[BonPlanI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $regionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanBonPlanCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanEtablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanRegionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanI18nsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->nb_adultes = 1;
        $this->nb_enfants = 0;
        $this->active = false;
    }

    /**
     * Initializes internal state of BaseBonPlan object.
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
     * Get the [optionally formatted] temporal [date_debut] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateDebut($format = null)
    {
        if ($this->date_debut === null) {
            return null;
        }

        if ($this->date_debut === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_debut);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_debut, true), $x);
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
     * Get the [optionally formatted] temporal [date_fin] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateFin($format = null)
    {
        if ($this->date_fin === null) {
            return null;
        }

        if ($this->date_fin === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_fin);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_fin, true), $x);
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
     * Get the [prix] column value.
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Get the [prix_barre] column value.
     *
     * @return int
     */
    public function getPrixBarre()
    {
        return $this->prix_barre;
    }

    /**
     * Get the [image_menu] column value.
     *
     * @return string
     */
    public function getImageMenu()
    {
        return $this->image_menu;
    }

    /**
     * Get the [image_page] column value.
     *
     * @return string
     */
    public function getImagePage()
    {
        return $this->image_page;
    }

    /**
     * Get the [image_liste] column value.
     *
     * @return string
     */
    public function getImageListe()
    {
        return $this->image_liste;
    }

    /**
     * Get the [active_compteur] column value.
     *
     * @return boolean
     */
    public function getActiveCompteur()
    {
        return $this->active_compteur;
    }

    /**
     * Get the [mise_en_avant] column value.
     *
     * @return boolean
     */
    public function getMiseEnAvant()
    {
        return $this->mise_en_avant;
    }

    /**
     * Get the [push_home] column value.
     *
     * @return boolean
     */
    public function getPushHome()
    {
        return $this->push_home;
    }

    /**
     * Get the [optionally formatted] temporal [date_start] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateStart($format = null)
    {
        if ($this->date_start === null) {
            return null;
        }

        if ($this->date_start === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_start);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_start, true), $x);
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
     * Get the [day_start] column value.
     *
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getDayStart()
    {
        if (null === $this->day_start) {
            return null;
        }
        $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_START);
        if (!isset($valueSet[$this->day_start])) {
            throw new PropelException('Unknown stored enum key: ' . $this->day_start);
        }

        return $valueSet[$this->day_start];
    }

    /**
     * Get the [day_range] column value.
     *
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getDayRange()
    {
        if (null === $this->day_range) {
            return null;
        }
        $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_RANGE);
        if (!isset($valueSet[$this->day_range])) {
            throw new PropelException('Unknown stored enum key: ' . $this->day_range);
        }

        return $valueSet[$this->day_range];
    }

    /**
     * Get the [nb_adultes] column value.
     *
     * @return int
     */
    public function getNbAdultes()
    {
        return $this->nb_adultes;
    }

    /**
     * Get the [nb_enfants] column value.
     *
     * @return int
     */
    public function getNbEnfants()
    {
        return $this->nb_enfants;
    }

    /**
     * Get the [period_categories] column value.
     *
     * @return string
     */
    public function getPeriodCategories()
    {
        return $this->period_categories;
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
     * @return BonPlan The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BonPlanPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of [date_debut] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BonPlan The current object (for fluent API support)
     */
    public function setDateDebut($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_debut !== null || $dt !== null) {
            $currentDateAsString = ($this->date_debut !== null && $tmpDt = new DateTime($this->date_debut)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_debut = $newDateAsString;
                $this->modifiedColumns[] = BonPlanPeer::DATE_DEBUT;
            }
        } // if either are not null


        return $this;
    } // setDateDebut()

    /**
     * Sets the value of [date_fin] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BonPlan The current object (for fluent API support)
     */
    public function setDateFin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_fin !== null || $dt !== null) {
            $currentDateAsString = ($this->date_fin !== null && $tmpDt = new DateTime($this->date_fin)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_fin = $newDateAsString;
                $this->modifiedColumns[] = BonPlanPeer::DATE_FIN;
            }
        } // if either are not null


        return $this;
    } // setDateFin()

    /**
     * Set the value of [prix] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setPrix($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prix !== $v) {
            $this->prix = $v;
            $this->modifiedColumns[] = BonPlanPeer::PRIX;
        }


        return $this;
    } // setPrix()

    /**
     * Set the value of [prix_barre] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setPrixBarre($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prix_barre !== $v) {
            $this->prix_barre = $v;
            $this->modifiedColumns[] = BonPlanPeer::PRIX_BARRE;
        }


        return $this;
    } // setPrixBarre()

    /**
     * Set the value of [image_menu] column.
     *
     * @param string $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setImageMenu($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_menu !== $v) {
            $this->image_menu = $v;
            $this->modifiedColumns[] = BonPlanPeer::IMAGE_MENU;
        }


        return $this;
    } // setImageMenu()

    /**
     * Set the value of [image_page] column.
     *
     * @param string $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setImagePage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_page !== $v) {
            $this->image_page = $v;
            $this->modifiedColumns[] = BonPlanPeer::IMAGE_PAGE;
        }


        return $this;
    } // setImagePage()

    /**
     * Set the value of [image_liste] column.
     *
     * @param string $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setImageListe($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_liste !== $v) {
            $this->image_liste = $v;
            $this->modifiedColumns[] = BonPlanPeer::IMAGE_LISTE;
        }


        return $this;
    } // setImageListe()

    /**
     * Sets the value of the [active_compteur] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setActiveCompteur($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active_compteur !== $v) {
            $this->active_compteur = $v;
            $this->modifiedColumns[] = BonPlanPeer::ACTIVE_COMPTEUR;
        }


        return $this;
    } // setActiveCompteur()

    /**
     * Sets the value of the [mise_en_avant] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setMiseEnAvant($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->mise_en_avant !== $v) {
            $this->mise_en_avant = $v;
            $this->modifiedColumns[] = BonPlanPeer::MISE_EN_AVANT;
        }


        return $this;
    } // setMiseEnAvant()

    /**
     * Sets the value of the [push_home] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setPushHome($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->push_home !== $v) {
            $this->push_home = $v;
            $this->modifiedColumns[] = BonPlanPeer::PUSH_HOME;
        }


        return $this;
    } // setPushHome()

    /**
     * Sets the value of [date_start] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BonPlan The current object (for fluent API support)
     */
    public function setDateStart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_start !== null || $dt !== null) {
            $currentDateAsString = ($this->date_start !== null && $tmpDt = new DateTime($this->date_start)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_start = $newDateAsString;
                $this->modifiedColumns[] = BonPlanPeer::DATE_START;
            }
        } // if either are not null


        return $this;
    } // setDateStart()

    /**
     * Set the value of [day_start] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setDayStart($v)
    {
        if ($v !== null) {
            $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_START);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->day_start !== $v) {
            $this->day_start = $v;
            $this->modifiedColumns[] = BonPlanPeer::DAY_START;
        }


        return $this;
    } // setDayStart()

    /**
     * Set the value of [day_range] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setDayRange($v)
    {
        if ($v !== null) {
            $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_RANGE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->day_range !== $v) {
            $this->day_range = $v;
            $this->modifiedColumns[] = BonPlanPeer::DAY_RANGE;
        }


        return $this;
    } // setDayRange()

    /**
     * Set the value of [nb_adultes] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setNbAdultes($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nb_adultes !== $v) {
            $this->nb_adultes = $v;
            $this->modifiedColumns[] = BonPlanPeer::NB_ADULTES;
        }


        return $this;
    } // setNbAdultes()

    /**
     * Set the value of [nb_enfants] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setNbEnfants($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nb_enfants !== $v) {
            $this->nb_enfants = $v;
            $this->modifiedColumns[] = BonPlanPeer::NB_ENFANTS;
        }


        return $this;
    } // setNbEnfants()

    /**
     * Set the value of [period_categories] column.
     *
     * @param string $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setPeriodCategories($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->period_categories !== $v) {
            $this->period_categories = $v;
            $this->modifiedColumns[] = BonPlanPeer::PERIOD_CATEGORIES;
        }


        return $this;
    } // setPeriodCategories()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return BonPlan The current object (for fluent API support)
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
            $this->modifiedColumns[] = BonPlanPeer::ACTIVE;
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
            if ($this->nb_adultes !== 1) {
                return false;
            }

            if ($this->nb_enfants !== 0) {
                return false;
            }

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
            $this->date_debut = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->date_fin = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->prix = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->prix_barre = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->image_menu = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->image_page = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->image_liste = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->active_compteur = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->mise_en_avant = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->push_home = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
            $this->date_start = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->day_start = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->day_range = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->nb_adultes = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
            $this->nb_enfants = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
            $this->period_categories = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->active = ($row[$startcol + 17] !== null) ? (boolean) $row[$startcol + 17] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 18; // 18 = BonPlanPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BonPlan object", $e);
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BonPlanPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBonPlanBonPlanCategories = null;

            $this->collBonPlanEtablissements = null;

            $this->collBonPlanRegions = null;

            $this->collBonPlanI18ns = null;

            $this->collBonPlanCategories = null;
            $this->collEtablissements = null;
            $this->collRegions = null;
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BonPlanQuery::create()
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                BonPlanPeer::addInstanceToPool($this);
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

            if ($this->bonPlanCategoriesScheduledForDeletion !== null) {
                if (!$this->bonPlanCategoriesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->bonPlanCategoriesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    BonPlanBonPlanCategorieQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->bonPlanCategoriesScheduledForDeletion = null;
                }

                foreach ($this->getBonPlanCategories() as $bonPlanCategorie) {
                    if ($bonPlanCategorie->isModified()) {
                        $bonPlanCategorie->save($con);
                    }
                }
            }

            if ($this->etablissementsScheduledForDeletion !== null) {
                if (!$this->etablissementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->etablissementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    BonPlanEtablissementQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->etablissementsScheduledForDeletion = null;
                }

                foreach ($this->getEtablissements() as $etablissement) {
                    if ($etablissement->isModified()) {
                        $etablissement->save($con);
                    }
                }
            }

            if ($this->regionsScheduledForDeletion !== null) {
                if (!$this->regionsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->regionsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    BonPlanRegionQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->regionsScheduledForDeletion = null;
                }

                foreach ($this->getRegions() as $region) {
                    if ($region->isModified()) {
                        $region->save($con);
                    }
                }
            }

            if ($this->bonPlanBonPlanCategoriesScheduledForDeletion !== null) {
                if (!$this->bonPlanBonPlanCategoriesScheduledForDeletion->isEmpty()) {
                    BonPlanBonPlanCategorieQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanBonPlanCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanBonPlanCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanBonPlanCategories !== null) {
                foreach ($this->collBonPlanBonPlanCategories as $referrerFK) {
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

            if ($this->bonPlanRegionsScheduledForDeletion !== null) {
                if (!$this->bonPlanRegionsScheduledForDeletion->isEmpty()) {
                    BonPlanRegionQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanRegionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanRegionsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanRegions !== null) {
                foreach ($this->collBonPlanRegions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bonPlanI18nsScheduledForDeletion !== null) {
                if (!$this->bonPlanI18nsScheduledForDeletion->isEmpty()) {
                    BonPlanI18nQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanI18ns !== null) {
                foreach ($this->collBonPlanI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = BonPlanPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BonPlanPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BonPlanPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(BonPlanPeer::DATE_DEBUT)) {
            $modifiedColumns[':p' . $index++]  = '`date_debut`';
        }
        if ($this->isColumnModified(BonPlanPeer::DATE_FIN)) {
            $modifiedColumns[':p' . $index++]  = '`date_fin`';
        }
        if ($this->isColumnModified(BonPlanPeer::PRIX)) {
            $modifiedColumns[':p' . $index++]  = '`prix`';
        }
        if ($this->isColumnModified(BonPlanPeer::PRIX_BARRE)) {
            $modifiedColumns[':p' . $index++]  = '`prix_barre`';
        }
        if ($this->isColumnModified(BonPlanPeer::IMAGE_MENU)) {
            $modifiedColumns[':p' . $index++]  = '`image_menu`';
        }
        if ($this->isColumnModified(BonPlanPeer::IMAGE_PAGE)) {
            $modifiedColumns[':p' . $index++]  = '`image_page`';
        }
        if ($this->isColumnModified(BonPlanPeer::IMAGE_LISTE)) {
            $modifiedColumns[':p' . $index++]  = '`image_liste`';
        }
        if ($this->isColumnModified(BonPlanPeer::ACTIVE_COMPTEUR)) {
            $modifiedColumns[':p' . $index++]  = '`active_compteur`';
        }
        if ($this->isColumnModified(BonPlanPeer::MISE_EN_AVANT)) {
            $modifiedColumns[':p' . $index++]  = '`mise_en_avant`';
        }
        if ($this->isColumnModified(BonPlanPeer::PUSH_HOME)) {
            $modifiedColumns[':p' . $index++]  = '`push_home`';
        }
        if ($this->isColumnModified(BonPlanPeer::DATE_START)) {
            $modifiedColumns[':p' . $index++]  = '`date_start`';
        }
        if ($this->isColumnModified(BonPlanPeer::DAY_START)) {
            $modifiedColumns[':p' . $index++]  = '`day_start`';
        }
        if ($this->isColumnModified(BonPlanPeer::DAY_RANGE)) {
            $modifiedColumns[':p' . $index++]  = '`day_range`';
        }
        if ($this->isColumnModified(BonPlanPeer::NB_ADULTES)) {
            $modifiedColumns[':p' . $index++]  = '`nb_adultes`';
        }
        if ($this->isColumnModified(BonPlanPeer::NB_ENFANTS)) {
            $modifiedColumns[':p' . $index++]  = '`nb_enfants`';
        }
        if ($this->isColumnModified(BonPlanPeer::PERIOD_CATEGORIES)) {
            $modifiedColumns[':p' . $index++]  = '`period_categories`';
        }
        if ($this->isColumnModified(BonPlanPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `bon_plan` (%s) VALUES (%s)',
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
                    case '`date_debut`':
                        $stmt->bindValue($identifier, $this->date_debut, PDO::PARAM_STR);
                        break;
                    case '`date_fin`':
                        $stmt->bindValue($identifier, $this->date_fin, PDO::PARAM_STR);
                        break;
                    case '`prix`':
                        $stmt->bindValue($identifier, $this->prix, PDO::PARAM_INT);
                        break;
                    case '`prix_barre`':
                        $stmt->bindValue($identifier, $this->prix_barre, PDO::PARAM_INT);
                        break;
                    case '`image_menu`':
                        $stmt->bindValue($identifier, $this->image_menu, PDO::PARAM_STR);
                        break;
                    case '`image_page`':
                        $stmt->bindValue($identifier, $this->image_page, PDO::PARAM_STR);
                        break;
                    case '`image_liste`':
                        $stmt->bindValue($identifier, $this->image_liste, PDO::PARAM_STR);
                        break;
                    case '`active_compteur`':
                        $stmt->bindValue($identifier, (int) $this->active_compteur, PDO::PARAM_INT);
                        break;
                    case '`mise_en_avant`':
                        $stmt->bindValue($identifier, (int) $this->mise_en_avant, PDO::PARAM_INT);
                        break;
                    case '`push_home`':
                        $stmt->bindValue($identifier, (int) $this->push_home, PDO::PARAM_INT);
                        break;
                    case '`date_start`':
                        $stmt->bindValue($identifier, $this->date_start, PDO::PARAM_STR);
                        break;
                    case '`day_start`':
                        $stmt->bindValue($identifier, $this->day_start, PDO::PARAM_INT);
                        break;
                    case '`day_range`':
                        $stmt->bindValue($identifier, $this->day_range, PDO::PARAM_INT);
                        break;
                    case '`nb_adultes`':
                        $stmt->bindValue($identifier, $this->nb_adultes, PDO::PARAM_INT);
                        break;
                    case '`nb_enfants`':
                        $stmt->bindValue($identifier, $this->nb_enfants, PDO::PARAM_INT);
                        break;
                    case '`period_categories`':
                        $stmt->bindValue($identifier, $this->period_categories, PDO::PARAM_STR);
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


            if (($retval = BonPlanPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBonPlanBonPlanCategories !== null) {
                    foreach ($this->collBonPlanBonPlanCategories as $referrerFK) {
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

                if ($this->collBonPlanRegions !== null) {
                    foreach ($this->collBonPlanRegions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBonPlanI18ns !== null) {
                    foreach ($this->collBonPlanI18ns as $referrerFK) {
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
        $pos = BonPlanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDateDebut();
                break;
            case 2:
                return $this->getDateFin();
                break;
            case 3:
                return $this->getPrix();
                break;
            case 4:
                return $this->getPrixBarre();
                break;
            case 5:
                return $this->getImageMenu();
                break;
            case 6:
                return $this->getImagePage();
                break;
            case 7:
                return $this->getImageListe();
                break;
            case 8:
                return $this->getActiveCompteur();
                break;
            case 9:
                return $this->getMiseEnAvant();
                break;
            case 10:
                return $this->getPushHome();
                break;
            case 11:
                return $this->getDateStart();
                break;
            case 12:
                return $this->getDayStart();
                break;
            case 13:
                return $this->getDayRange();
                break;
            case 14:
                return $this->getNbAdultes();
                break;
            case 15:
                return $this->getNbEnfants();
                break;
            case 16:
                return $this->getPeriodCategories();
                break;
            case 17:
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
        if (isset($alreadyDumpedObjects['BonPlan'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BonPlan'][$this->getPrimaryKey()] = true;
        $keys = BonPlanPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDateDebut(),
            $keys[2] => $this->getDateFin(),
            $keys[3] => $this->getPrix(),
            $keys[4] => $this->getPrixBarre(),
            $keys[5] => $this->getImageMenu(),
            $keys[6] => $this->getImagePage(),
            $keys[7] => $this->getImageListe(),
            $keys[8] => $this->getActiveCompteur(),
            $keys[9] => $this->getMiseEnAvant(),
            $keys[10] => $this->getPushHome(),
            $keys[11] => $this->getDateStart(),
            $keys[12] => $this->getDayStart(),
            $keys[13] => $this->getDayRange(),
            $keys[14] => $this->getNbAdultes(),
            $keys[15] => $this->getNbEnfants(),
            $keys[16] => $this->getPeriodCategories(),
            $keys[17] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collBonPlanBonPlanCategories) {
                $result['BonPlanBonPlanCategories'] = $this->collBonPlanBonPlanCategories->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanEtablissements) {
                $result['BonPlanEtablissements'] = $this->collBonPlanEtablissements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanRegions) {
                $result['BonPlanRegions'] = $this->collBonPlanRegions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanI18ns) {
                $result['BonPlanI18ns'] = $this->collBonPlanI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BonPlanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDateDebut($value);
                break;
            case 2:
                $this->setDateFin($value);
                break;
            case 3:
                $this->setPrix($value);
                break;
            case 4:
                $this->setPrixBarre($value);
                break;
            case 5:
                $this->setImageMenu($value);
                break;
            case 6:
                $this->setImagePage($value);
                break;
            case 7:
                $this->setImageListe($value);
                break;
            case 8:
                $this->setActiveCompteur($value);
                break;
            case 9:
                $this->setMiseEnAvant($value);
                break;
            case 10:
                $this->setPushHome($value);
                break;
            case 11:
                $this->setDateStart($value);
                break;
            case 12:
                $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_START);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setDayStart($value);
                break;
            case 13:
                $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_RANGE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setDayRange($value);
                break;
            case 14:
                $this->setNbAdultes($value);
                break;
            case 15:
                $this->setNbEnfants($value);
                break;
            case 16:
                $this->setPeriodCategories($value);
                break;
            case 17:
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
        $keys = BonPlanPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDateDebut($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDateFin($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPrix($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPrixBarre($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setImageMenu($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setImagePage($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setImageListe($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setActiveCompteur($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMiseEnAvant($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setPushHome($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDateStart($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setDayStart($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setDayRange($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setNbAdultes($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setNbEnfants($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setPeriodCategories($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setActive($arr[$keys[17]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);

        if ($this->isColumnModified(BonPlanPeer::ID)) $criteria->add(BonPlanPeer::ID, $this->id);
        if ($this->isColumnModified(BonPlanPeer::DATE_DEBUT)) $criteria->add(BonPlanPeer::DATE_DEBUT, $this->date_debut);
        if ($this->isColumnModified(BonPlanPeer::DATE_FIN)) $criteria->add(BonPlanPeer::DATE_FIN, $this->date_fin);
        if ($this->isColumnModified(BonPlanPeer::PRIX)) $criteria->add(BonPlanPeer::PRIX, $this->prix);
        if ($this->isColumnModified(BonPlanPeer::PRIX_BARRE)) $criteria->add(BonPlanPeer::PRIX_BARRE, $this->prix_barre);
        if ($this->isColumnModified(BonPlanPeer::IMAGE_MENU)) $criteria->add(BonPlanPeer::IMAGE_MENU, $this->image_menu);
        if ($this->isColumnModified(BonPlanPeer::IMAGE_PAGE)) $criteria->add(BonPlanPeer::IMAGE_PAGE, $this->image_page);
        if ($this->isColumnModified(BonPlanPeer::IMAGE_LISTE)) $criteria->add(BonPlanPeer::IMAGE_LISTE, $this->image_liste);
        if ($this->isColumnModified(BonPlanPeer::ACTIVE_COMPTEUR)) $criteria->add(BonPlanPeer::ACTIVE_COMPTEUR, $this->active_compteur);
        if ($this->isColumnModified(BonPlanPeer::MISE_EN_AVANT)) $criteria->add(BonPlanPeer::MISE_EN_AVANT, $this->mise_en_avant);
        if ($this->isColumnModified(BonPlanPeer::PUSH_HOME)) $criteria->add(BonPlanPeer::PUSH_HOME, $this->push_home);
        if ($this->isColumnModified(BonPlanPeer::DATE_START)) $criteria->add(BonPlanPeer::DATE_START, $this->date_start);
        if ($this->isColumnModified(BonPlanPeer::DAY_START)) $criteria->add(BonPlanPeer::DAY_START, $this->day_start);
        if ($this->isColumnModified(BonPlanPeer::DAY_RANGE)) $criteria->add(BonPlanPeer::DAY_RANGE, $this->day_range);
        if ($this->isColumnModified(BonPlanPeer::NB_ADULTES)) $criteria->add(BonPlanPeer::NB_ADULTES, $this->nb_adultes);
        if ($this->isColumnModified(BonPlanPeer::NB_ENFANTS)) $criteria->add(BonPlanPeer::NB_ENFANTS, $this->nb_enfants);
        if ($this->isColumnModified(BonPlanPeer::PERIOD_CATEGORIES)) $criteria->add(BonPlanPeer::PERIOD_CATEGORIES, $this->period_categories);
        if ($this->isColumnModified(BonPlanPeer::ACTIVE)) $criteria->add(BonPlanPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);
        $criteria->add(BonPlanPeer::ID, $this->id);

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
     * @param object $copyObj An object of BonPlan (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDateDebut($this->getDateDebut());
        $copyObj->setDateFin($this->getDateFin());
        $copyObj->setPrix($this->getPrix());
        $copyObj->setPrixBarre($this->getPrixBarre());
        $copyObj->setImageMenu($this->getImageMenu());
        $copyObj->setImagePage($this->getImagePage());
        $copyObj->setImageListe($this->getImageListe());
        $copyObj->setActiveCompteur($this->getActiveCompteur());
        $copyObj->setMiseEnAvant($this->getMiseEnAvant());
        $copyObj->setPushHome($this->getPushHome());
        $copyObj->setDateStart($this->getDateStart());
        $copyObj->setDayStart($this->getDayStart());
        $copyObj->setDayRange($this->getDayRange());
        $copyObj->setNbAdultes($this->getNbAdultes());
        $copyObj->setNbEnfants($this->getNbEnfants());
        $copyObj->setPeriodCategories($this->getPeriodCategories());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBonPlanBonPlanCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanBonPlanCategorie($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanEtablissements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanEtablissement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanRegions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanRegion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanI18n($relObj->copy($deepCopy));
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
     * @return BonPlan Clone of current object.
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
     * @return BonPlanPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BonPlanPeer();
        }

        return self::$peer;
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
        if ('BonPlanBonPlanCategorie' == $relationName) {
            $this->initBonPlanBonPlanCategories();
        }
        if ('BonPlanEtablissement' == $relationName) {
            $this->initBonPlanEtablissements();
        }
        if ('BonPlanRegion' == $relationName) {
            $this->initBonPlanRegions();
        }
        if ('BonPlanI18n' == $relationName) {
            $this->initBonPlanI18ns();
        }
    }

    /**
     * Clears out the collBonPlanBonPlanCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addBonPlanBonPlanCategories()
     */
    public function clearBonPlanBonPlanCategories()
    {
        $this->collBonPlanBonPlanCategories = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanBonPlanCategoriesPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanBonPlanCategories collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanBonPlanCategories($v = true)
    {
        $this->collBonPlanBonPlanCategoriesPartial = $v;
    }

    /**
     * Initializes the collBonPlanBonPlanCategories collection.
     *
     * By default this just sets the collBonPlanBonPlanCategories collection to an empty array (like clearcollBonPlanBonPlanCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanBonPlanCategories($overrideExisting = true)
    {
        if (null !== $this->collBonPlanBonPlanCategories && !$overrideExisting) {
            return;
        }
        $this->collBonPlanBonPlanCategories = new PropelObjectCollection();
        $this->collBonPlanBonPlanCategories->setModel('BonPlanBonPlanCategorie');
    }

    /**
     * Gets an array of BonPlanBonPlanCategorie objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanBonPlanCategorie[] List of BonPlanBonPlanCategorie objects
     * @throws PropelException
     */
    public function getBonPlanBonPlanCategories($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanBonPlanCategoriesPartial && !$this->isNew();
        if (null === $this->collBonPlanBonPlanCategories || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanBonPlanCategories) {
                // return empty collection
                $this->initBonPlanBonPlanCategories();
            } else {
                $collBonPlanBonPlanCategories = BonPlanBonPlanCategorieQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanBonPlanCategoriesPartial && count($collBonPlanBonPlanCategories)) {
                      $this->initBonPlanBonPlanCategories(false);

                      foreach($collBonPlanBonPlanCategories as $obj) {
                        if (false == $this->collBonPlanBonPlanCategories->contains($obj)) {
                          $this->collBonPlanBonPlanCategories->append($obj);
                        }
                      }

                      $this->collBonPlanBonPlanCategoriesPartial = true;
                    }

                    return $collBonPlanBonPlanCategories;
                }

                if($partial && $this->collBonPlanBonPlanCategories) {
                    foreach($this->collBonPlanBonPlanCategories as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanBonPlanCategories[] = $obj;
                        }
                    }
                }

                $this->collBonPlanBonPlanCategories = $collBonPlanBonPlanCategories;
                $this->collBonPlanBonPlanCategoriesPartial = false;
            }
        }

        return $this->collBonPlanBonPlanCategories;
    }

    /**
     * Sets a collection of BonPlanBonPlanCategorie objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanBonPlanCategories A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanBonPlanCategories(PropelCollection $bonPlanBonPlanCategories, PropelPDO $con = null)
    {
        $this->bonPlanBonPlanCategoriesScheduledForDeletion = $this->getBonPlanBonPlanCategories(new Criteria(), $con)->diff($bonPlanBonPlanCategories);

        foreach ($this->bonPlanBonPlanCategoriesScheduledForDeletion as $bonPlanBonPlanCategorieRemoved) {
            $bonPlanBonPlanCategorieRemoved->setBonPlan(null);
        }

        $this->collBonPlanBonPlanCategories = null;
        foreach ($bonPlanBonPlanCategories as $bonPlanBonPlanCategorie) {
            $this->addBonPlanBonPlanCategorie($bonPlanBonPlanCategorie);
        }

        $this->collBonPlanBonPlanCategories = $bonPlanBonPlanCategories;
        $this->collBonPlanBonPlanCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanBonPlanCategorie objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanBonPlanCategorie objects.
     * @throws PropelException
     */
    public function countBonPlanBonPlanCategories(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanBonPlanCategoriesPartial && !$this->isNew();
        if (null === $this->collBonPlanBonPlanCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanBonPlanCategories) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanBonPlanCategories());
            }
            $query = BonPlanBonPlanCategorieQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBonPlan($this)
                ->count($con);
        }

        return count($this->collBonPlanBonPlanCategories);
    }

    /**
     * Method called to associate a BonPlanBonPlanCategorie object to this object
     * through the BonPlanBonPlanCategorie foreign key attribute.
     *
     * @param    BonPlanBonPlanCategorie $l BonPlanBonPlanCategorie
     * @return BonPlan The current object (for fluent API support)
     */
    public function addBonPlanBonPlanCategorie(BonPlanBonPlanCategorie $l)
    {
        if ($this->collBonPlanBonPlanCategories === null) {
            $this->initBonPlanBonPlanCategories();
            $this->collBonPlanBonPlanCategoriesPartial = true;
        }
        if (!in_array($l, $this->collBonPlanBonPlanCategories->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanBonPlanCategorie($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanBonPlanCategorie $bonPlanBonPlanCategorie The bonPlanBonPlanCategorie object to add.
     */
    protected function doAddBonPlanBonPlanCategorie($bonPlanBonPlanCategorie)
    {
        $this->collBonPlanBonPlanCategories[]= $bonPlanBonPlanCategorie;
        $bonPlanBonPlanCategorie->setBonPlan($this);
    }

    /**
     * @param	BonPlanBonPlanCategorie $bonPlanBonPlanCategorie The bonPlanBonPlanCategorie object to remove.
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeBonPlanBonPlanCategorie($bonPlanBonPlanCategorie)
    {
        if ($this->getBonPlanBonPlanCategories()->contains($bonPlanBonPlanCategorie)) {
            $this->collBonPlanBonPlanCategories->remove($this->collBonPlanBonPlanCategories->search($bonPlanBonPlanCategorie));
            if (null === $this->bonPlanBonPlanCategoriesScheduledForDeletion) {
                $this->bonPlanBonPlanCategoriesScheduledForDeletion = clone $this->collBonPlanBonPlanCategories;
                $this->bonPlanBonPlanCategoriesScheduledForDeletion->clear();
            }
            $this->bonPlanBonPlanCategoriesScheduledForDeletion[]= $bonPlanBonPlanCategorie;
            $bonPlanBonPlanCategorie->setBonPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BonPlan is new, it will return
     * an empty collection; or if this BonPlan has previously
     * been saved, it will retrieve related BonPlanBonPlanCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BonPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanBonPlanCategorie[] List of BonPlanBonPlanCategorie objects
     */
    public function getBonPlanBonPlanCategoriesJoinBonPlanCategorie($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanBonPlanCategorieQuery::create(null, $criteria);
        $query->joinWith('BonPlanCategorie', $join_behavior);

        return $this->getBonPlanBonPlanCategories($query, $con);
    }

    /**
     * Clears out the collBonPlanEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
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
     * If this BonPlan is new, it will return
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
                    ->filterByBonPlan($this)
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
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanEtablissements(PropelCollection $bonPlanEtablissements, PropelPDO $con = null)
    {
        $this->bonPlanEtablissementsScheduledForDeletion = $this->getBonPlanEtablissements(new Criteria(), $con)->diff($bonPlanEtablissements);

        foreach ($this->bonPlanEtablissementsScheduledForDeletion as $bonPlanEtablissementRemoved) {
            $bonPlanEtablissementRemoved->setBonPlan(null);
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
                ->filterByBonPlan($this)
                ->count($con);
        }

        return count($this->collBonPlanEtablissements);
    }

    /**
     * Method called to associate a BonPlanEtablissement object to this object
     * through the BonPlanEtablissement foreign key attribute.
     *
     * @param    BonPlanEtablissement $l BonPlanEtablissement
     * @return BonPlan The current object (for fluent API support)
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
        $bonPlanEtablissement->setBonPlan($this);
    }

    /**
     * @param	BonPlanEtablissement $bonPlanEtablissement The bonPlanEtablissement object to remove.
     * @return BonPlan The current object (for fluent API support)
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
            $bonPlanEtablissement->setBonPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BonPlan is new, it will return
     * an empty collection; or if this BonPlan has previously
     * been saved, it will retrieve related BonPlanEtablissements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BonPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanEtablissement[] List of BonPlanEtablissement objects
     */
    public function getBonPlanEtablissementsJoinEtablissement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanEtablissementQuery::create(null, $criteria);
        $query->joinWith('Etablissement', $join_behavior);

        return $this->getBonPlanEtablissements($query, $con);
    }

    /**
     * Clears out the collBonPlanRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addBonPlanRegions()
     */
    public function clearBonPlanRegions()
    {
        $this->collBonPlanRegions = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanRegionsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanRegions collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanRegions($v = true)
    {
        $this->collBonPlanRegionsPartial = $v;
    }

    /**
     * Initializes the collBonPlanRegions collection.
     *
     * By default this just sets the collBonPlanRegions collection to an empty array (like clearcollBonPlanRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanRegions($overrideExisting = true)
    {
        if (null !== $this->collBonPlanRegions && !$overrideExisting) {
            return;
        }
        $this->collBonPlanRegions = new PropelObjectCollection();
        $this->collBonPlanRegions->setModel('BonPlanRegion');
    }

    /**
     * Gets an array of BonPlanRegion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanRegion[] List of BonPlanRegion objects
     * @throws PropelException
     */
    public function getBonPlanRegions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanRegionsPartial && !$this->isNew();
        if (null === $this->collBonPlanRegions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanRegions) {
                // return empty collection
                $this->initBonPlanRegions();
            } else {
                $collBonPlanRegions = BonPlanRegionQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanRegionsPartial && count($collBonPlanRegions)) {
                      $this->initBonPlanRegions(false);

                      foreach($collBonPlanRegions as $obj) {
                        if (false == $this->collBonPlanRegions->contains($obj)) {
                          $this->collBonPlanRegions->append($obj);
                        }
                      }

                      $this->collBonPlanRegionsPartial = true;
                    }

                    return $collBonPlanRegions;
                }

                if($partial && $this->collBonPlanRegions) {
                    foreach($this->collBonPlanRegions as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanRegions[] = $obj;
                        }
                    }
                }

                $this->collBonPlanRegions = $collBonPlanRegions;
                $this->collBonPlanRegionsPartial = false;
            }
        }

        return $this->collBonPlanRegions;
    }

    /**
     * Sets a collection of BonPlanRegion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanRegions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanRegions(PropelCollection $bonPlanRegions, PropelPDO $con = null)
    {
        $this->bonPlanRegionsScheduledForDeletion = $this->getBonPlanRegions(new Criteria(), $con)->diff($bonPlanRegions);

        foreach ($this->bonPlanRegionsScheduledForDeletion as $bonPlanRegionRemoved) {
            $bonPlanRegionRemoved->setBonPlan(null);
        }

        $this->collBonPlanRegions = null;
        foreach ($bonPlanRegions as $bonPlanRegion) {
            $this->addBonPlanRegion($bonPlanRegion);
        }

        $this->collBonPlanRegions = $bonPlanRegions;
        $this->collBonPlanRegionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanRegion objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanRegion objects.
     * @throws PropelException
     */
    public function countBonPlanRegions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanRegionsPartial && !$this->isNew();
        if (null === $this->collBonPlanRegions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanRegions) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanRegions());
            }
            $query = BonPlanRegionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBonPlan($this)
                ->count($con);
        }

        return count($this->collBonPlanRegions);
    }

    /**
     * Method called to associate a BonPlanRegion object to this object
     * through the BonPlanRegion foreign key attribute.
     *
     * @param    BonPlanRegion $l BonPlanRegion
     * @return BonPlan The current object (for fluent API support)
     */
    public function addBonPlanRegion(BonPlanRegion $l)
    {
        if ($this->collBonPlanRegions === null) {
            $this->initBonPlanRegions();
            $this->collBonPlanRegionsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanRegions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanRegion($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanRegion $bonPlanRegion The bonPlanRegion object to add.
     */
    protected function doAddBonPlanRegion($bonPlanRegion)
    {
        $this->collBonPlanRegions[]= $bonPlanRegion;
        $bonPlanRegion->setBonPlan($this);
    }

    /**
     * @param	BonPlanRegion $bonPlanRegion The bonPlanRegion object to remove.
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeBonPlanRegion($bonPlanRegion)
    {
        if ($this->getBonPlanRegions()->contains($bonPlanRegion)) {
            $this->collBonPlanRegions->remove($this->collBonPlanRegions->search($bonPlanRegion));
            if (null === $this->bonPlanRegionsScheduledForDeletion) {
                $this->bonPlanRegionsScheduledForDeletion = clone $this->collBonPlanRegions;
                $this->bonPlanRegionsScheduledForDeletion->clear();
            }
            $this->bonPlanRegionsScheduledForDeletion[]= $bonPlanRegion;
            $bonPlanRegion->setBonPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BonPlan is new, it will return
     * an empty collection; or if this BonPlan has previously
     * been saved, it will retrieve related BonPlanRegions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BonPlan.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanRegion[] List of BonPlanRegion objects
     */
    public function getBonPlanRegionsJoinRegion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanRegionQuery::create(null, $criteria);
        $query->joinWith('Region', $join_behavior);

        return $this->getBonPlanRegions($query, $con);
    }

    /**
     * Clears out the collBonPlanI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addBonPlanI18ns()
     */
    public function clearBonPlanI18ns()
    {
        $this->collBonPlanI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanI18ns($v = true)
    {
        $this->collBonPlanI18nsPartial = $v;
    }

    /**
     * Initializes the collBonPlanI18ns collection.
     *
     * By default this just sets the collBonPlanI18ns collection to an empty array (like clearcollBonPlanI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanI18ns($overrideExisting = true)
    {
        if (null !== $this->collBonPlanI18ns && !$overrideExisting) {
            return;
        }
        $this->collBonPlanI18ns = new PropelObjectCollection();
        $this->collBonPlanI18ns->setModel('BonPlanI18n');
    }

    /**
     * Gets an array of BonPlanI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanI18n[] List of BonPlanI18n objects
     * @throws PropelException
     */
    public function getBonPlanI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanI18nsPartial && !$this->isNew();
        if (null === $this->collBonPlanI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanI18ns) {
                // return empty collection
                $this->initBonPlanI18ns();
            } else {
                $collBonPlanI18ns = BonPlanI18nQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanI18nsPartial && count($collBonPlanI18ns)) {
                      $this->initBonPlanI18ns(false);

                      foreach($collBonPlanI18ns as $obj) {
                        if (false == $this->collBonPlanI18ns->contains($obj)) {
                          $this->collBonPlanI18ns->append($obj);
                        }
                      }

                      $this->collBonPlanI18nsPartial = true;
                    }

                    return $collBonPlanI18ns;
                }

                if($partial && $this->collBonPlanI18ns) {
                    foreach($this->collBonPlanI18ns as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanI18ns[] = $obj;
                        }
                    }
                }

                $this->collBonPlanI18ns = $collBonPlanI18ns;
                $this->collBonPlanI18nsPartial = false;
            }
        }

        return $this->collBonPlanI18ns;
    }

    /**
     * Sets a collection of BonPlanI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanI18ns(PropelCollection $bonPlanI18ns, PropelPDO $con = null)
    {
        $this->bonPlanI18nsScheduledForDeletion = $this->getBonPlanI18ns(new Criteria(), $con)->diff($bonPlanI18ns);

        foreach ($this->bonPlanI18nsScheduledForDeletion as $bonPlanI18nRemoved) {
            $bonPlanI18nRemoved->setBonPlan(null);
        }

        $this->collBonPlanI18ns = null;
        foreach ($bonPlanI18ns as $bonPlanI18n) {
            $this->addBonPlanI18n($bonPlanI18n);
        }

        $this->collBonPlanI18ns = $bonPlanI18ns;
        $this->collBonPlanI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanI18n objects.
     * @throws PropelException
     */
    public function countBonPlanI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanI18nsPartial && !$this->isNew();
        if (null === $this->collBonPlanI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanI18ns());
            }
            $query = BonPlanI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBonPlan($this)
                ->count($con);
        }

        return count($this->collBonPlanI18ns);
    }

    /**
     * Method called to associate a BonPlanI18n object to this object
     * through the BonPlanI18n foreign key attribute.
     *
     * @param    BonPlanI18n $l BonPlanI18n
     * @return BonPlan The current object (for fluent API support)
     */
    public function addBonPlanI18n(BonPlanI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collBonPlanI18ns === null) {
            $this->initBonPlanI18ns();
            $this->collBonPlanI18nsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanI18n($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanI18n $bonPlanI18n The bonPlanI18n object to add.
     */
    protected function doAddBonPlanI18n($bonPlanI18n)
    {
        $this->collBonPlanI18ns[]= $bonPlanI18n;
        $bonPlanI18n->setBonPlan($this);
    }

    /**
     * @param	BonPlanI18n $bonPlanI18n The bonPlanI18n object to remove.
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeBonPlanI18n($bonPlanI18n)
    {
        if ($this->getBonPlanI18ns()->contains($bonPlanI18n)) {
            $this->collBonPlanI18ns->remove($this->collBonPlanI18ns->search($bonPlanI18n));
            if (null === $this->bonPlanI18nsScheduledForDeletion) {
                $this->bonPlanI18nsScheduledForDeletion = clone $this->collBonPlanI18ns;
                $this->bonPlanI18nsScheduledForDeletion->clear();
            }
            $this->bonPlanI18nsScheduledForDeletion[]= $bonPlanI18n;
            $bonPlanI18n->setBonPlan(null);
        }

        return $this;
    }

    /**
     * Clears out the collBonPlanCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addBonPlanCategories()
     */
    public function clearBonPlanCategories()
    {
        $this->collBonPlanCategories = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanCategoriesPartial = null;

        return $this;
    }

    /**
     * Initializes the collBonPlanCategories collection.
     *
     * By default this just sets the collBonPlanCategories collection to an empty collection (like clearBonPlanCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBonPlanCategories()
    {
        $this->collBonPlanCategories = new PropelObjectCollection();
        $this->collBonPlanCategories->setModel('BonPlanCategorie');
    }

    /**
     * Gets a collection of BonPlanCategorie objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_bon_plan_categorie cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|BonPlanCategorie[] List of BonPlanCategorie objects
     */
    public function getBonPlanCategories($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBonPlanCategories || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonPlanCategories) {
                // return empty collection
                $this->initBonPlanCategories();
            } else {
                $collBonPlanCategories = BonPlanCategorieQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBonPlanCategories;
                }
                $this->collBonPlanCategories = $collBonPlanCategories;
            }
        }

        return $this->collBonPlanCategories;
    }

    /**
     * Sets a collection of BonPlanCategorie objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_bon_plan_categorie cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanCategories A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanCategories(PropelCollection $bonPlanCategories, PropelPDO $con = null)
    {
        $this->clearBonPlanCategories();
        $currentBonPlanCategories = $this->getBonPlanCategories();

        $this->bonPlanCategoriesScheduledForDeletion = $currentBonPlanCategories->diff($bonPlanCategories);

        foreach ($bonPlanCategories as $bonPlanCategorie) {
            if (!$currentBonPlanCategories->contains($bonPlanCategorie)) {
                $this->doAddBonPlanCategorie($bonPlanCategorie);
            }
        }

        $this->collBonPlanCategories = $bonPlanCategories;

        return $this;
    }

    /**
     * Gets the number of BonPlanCategorie objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_bon_plan_categorie cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related BonPlanCategorie objects
     */
    public function countBonPlanCategories($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBonPlanCategories || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonPlanCategories) {
                return 0;
            } else {
                $query = BonPlanCategorieQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBonPlan($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonPlanCategories);
        }
    }

    /**
     * Associate a BonPlanCategorie object to this object
     * through the bon_plan_bon_plan_categorie cross reference table.
     *
     * @param  BonPlanCategorie $bonPlanCategorie The BonPlanBonPlanCategorie object to relate
     * @return BonPlan The current object (for fluent API support)
     */
    public function addBonPlanCategorie(BonPlanCategorie $bonPlanCategorie)
    {
        if ($this->collBonPlanCategories === null) {
            $this->initBonPlanCategories();
        }
        if (!$this->collBonPlanCategories->contains($bonPlanCategorie)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanCategorie($bonPlanCategorie);

            $this->collBonPlanCategories[]= $bonPlanCategorie;
        }

        return $this;
    }

    /**
     * @param	BonPlanCategorie $bonPlanCategorie The bonPlanCategorie object to add.
     */
    protected function doAddBonPlanCategorie($bonPlanCategorie)
    {
        $bonPlanBonPlanCategorie = new BonPlanBonPlanCategorie();
        $bonPlanBonPlanCategorie->setBonPlanCategorie($bonPlanCategorie);
        $this->addBonPlanBonPlanCategorie($bonPlanBonPlanCategorie);
    }

    /**
     * Remove a BonPlanCategorie object to this object
     * through the bon_plan_bon_plan_categorie cross reference table.
     *
     * @param BonPlanCategorie $bonPlanCategorie The BonPlanBonPlanCategorie object to relate
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeBonPlanCategorie(BonPlanCategorie $bonPlanCategorie)
    {
        if ($this->getBonPlanCategories()->contains($bonPlanCategorie)) {
            $this->collBonPlanCategories->remove($this->collBonPlanCategories->search($bonPlanCategorie));
            if (null === $this->bonPlanCategoriesScheduledForDeletion) {
                $this->bonPlanCategoriesScheduledForDeletion = clone $this->collBonPlanCategories;
                $this->bonPlanCategoriesScheduledForDeletion->clear();
            }
            $this->bonPlanCategoriesScheduledForDeletion[]= $bonPlanCategorie;
        }

        return $this;
    }

    /**
     * Clears out the collEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addEtablissements()
     */
    public function clearEtablissements()
    {
        $this->collEtablissements = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementsPartial = null;

        return $this;
    }

    /**
     * Initializes the collEtablissements collection.
     *
     * By default this just sets the collEtablissements collection to an empty collection (like clearEtablissements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initEtablissements()
    {
        $this->collEtablissements = new PropelObjectCollection();
        $this->collEtablissements->setModel('Etablissement');
    }

    /**
     * Gets a collection of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_etablissement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissements($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collEtablissements || null !== $criteria) {
            if ($this->isNew() && null === $this->collEtablissements) {
                // return empty collection
                $this->initEtablissements();
            } else {
                $collEtablissements = EtablissementQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collEtablissements;
                }
                $this->collEtablissements = $collEtablissements;
            }
        }

        return $this->collEtablissements;
    }

    /**
     * Sets a collection of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_etablissement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setEtablissements(PropelCollection $etablissements, PropelPDO $con = null)
    {
        $this->clearEtablissements();
        $currentEtablissements = $this->getEtablissements();

        $this->etablissementsScheduledForDeletion = $currentEtablissements->diff($etablissements);

        foreach ($etablissements as $etablissement) {
            if (!$currentEtablissements->contains($etablissement)) {
                $this->doAddEtablissement($etablissement);
            }
        }

        $this->collEtablissements = $etablissements;

        return $this;
    }

    /**
     * Gets the number of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_etablissement cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Etablissement objects
     */
    public function countEtablissements($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collEtablissements || null !== $criteria) {
            if ($this->isNew() && null === $this->collEtablissements) {
                return 0;
            } else {
                $query = EtablissementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBonPlan($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissements);
        }
    }

    /**
     * Associate a Etablissement object to this object
     * through the bon_plan_etablissement cross reference table.
     *
     * @param  Etablissement $etablissement The BonPlanEtablissement object to relate
     * @return BonPlan The current object (for fluent API support)
     */
    public function addEtablissement(Etablissement $etablissement)
    {
        if ($this->collEtablissements === null) {
            $this->initEtablissements();
        }
        if (!$this->collEtablissements->contains($etablissement)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissement($etablissement);

            $this->collEtablissements[]= $etablissement;
        }

        return $this;
    }

    /**
     * @param	Etablissement $etablissement The etablissement object to add.
     */
    protected function doAddEtablissement($etablissement)
    {
        $bonPlanEtablissement = new BonPlanEtablissement();
        $bonPlanEtablissement->setEtablissement($etablissement);
        $this->addBonPlanEtablissement($bonPlanEtablissement);
    }

    /**
     * Remove a Etablissement object to this object
     * through the bon_plan_etablissement cross reference table.
     *
     * @param Etablissement $etablissement The BonPlanEtablissement object to relate
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeEtablissement(Etablissement $etablissement)
    {
        if ($this->getEtablissements()->contains($etablissement)) {
            $this->collEtablissements->remove($this->collEtablissements->search($etablissement));
            if (null === $this->etablissementsScheduledForDeletion) {
                $this->etablissementsScheduledForDeletion = clone $this->collEtablissements;
                $this->etablissementsScheduledForDeletion->clear();
            }
            $this->etablissementsScheduledForDeletion[]= $etablissement;
        }

        return $this;
    }

    /**
     * Clears out the collRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addRegions()
     */
    public function clearRegions()
    {
        $this->collRegions = null; // important to set this to null since that means it is uninitialized
        $this->collRegionsPartial = null;

        return $this;
    }

    /**
     * Initializes the collRegions collection.
     *
     * By default this just sets the collRegions collection to an empty collection (like clearRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initRegions()
    {
        $this->collRegions = new PropelObjectCollection();
        $this->collRegions->setModel('Region');
    }

    /**
     * Gets a collection of Region objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_region cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Region[] List of Region objects
     */
    public function getRegions($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collRegions || null !== $criteria) {
            if ($this->isNew() && null === $this->collRegions) {
                // return empty collection
                $this->initRegions();
            } else {
                $collRegions = RegionQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collRegions;
                }
                $this->collRegions = $collRegions;
            }
        }

        return $this->collRegions;
    }

    /**
     * Sets a collection of Region objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_region cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $regions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setRegions(PropelCollection $regions, PropelPDO $con = null)
    {
        $this->clearRegions();
        $currentRegions = $this->getRegions();

        $this->regionsScheduledForDeletion = $currentRegions->diff($regions);

        foreach ($regions as $region) {
            if (!$currentRegions->contains($region)) {
                $this->doAddRegion($region);
            }
        }

        $this->collRegions = $regions;

        return $this;
    }

    /**
     * Gets the number of Region objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_region cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Region objects
     */
    public function countRegions($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collRegions || null !== $criteria) {
            if ($this->isNew() && null === $this->collRegions) {
                return 0;
            } else {
                $query = RegionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBonPlan($this)
                    ->count($con);
            }
        } else {
            return count($this->collRegions);
        }
    }

    /**
     * Associate a Region object to this object
     * through the bon_plan_region cross reference table.
     *
     * @param  Region $region The BonPlanRegion object to relate
     * @return BonPlan The current object (for fluent API support)
     */
    public function addRegion(Region $region)
    {
        if ($this->collRegions === null) {
            $this->initRegions();
        }
        if (!$this->collRegions->contains($region)) { // only add it if the **same** object is not already associated
            $this->doAddRegion($region);

            $this->collRegions[]= $region;
        }

        return $this;
    }

    /**
     * @param	Region $region The region object to add.
     */
    protected function doAddRegion($region)
    {
        $bonPlanRegion = new BonPlanRegion();
        $bonPlanRegion->setRegion($region);
        $this->addBonPlanRegion($bonPlanRegion);
    }

    /**
     * Remove a Region object to this object
     * through the bon_plan_region cross reference table.
     *
     * @param Region $region The BonPlanRegion object to relate
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeRegion(Region $region)
    {
        if ($this->getRegions()->contains($region)) {
            $this->collRegions->remove($this->collRegions->search($region));
            if (null === $this->regionsScheduledForDeletion) {
                $this->regionsScheduledForDeletion = clone $this->collRegions;
                $this->regionsScheduledForDeletion->clear();
            }
            $this->regionsScheduledForDeletion[]= $region;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->date_debut = null;
        $this->date_fin = null;
        $this->prix = null;
        $this->prix_barre = null;
        $this->image_menu = null;
        $this->image_page = null;
        $this->image_liste = null;
        $this->active_compteur = null;
        $this->mise_en_avant = null;
        $this->push_home = null;
        $this->date_start = null;
        $this->day_start = null;
        $this->day_range = null;
        $this->nb_adultes = null;
        $this->nb_enfants = null;
        $this->period_categories = null;
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
            if ($this->collBonPlanBonPlanCategories) {
                foreach ($this->collBonPlanBonPlanCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanEtablissements) {
                foreach ($this->collBonPlanEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanRegions) {
                foreach ($this->collBonPlanRegions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanI18ns) {
                foreach ($this->collBonPlanI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanCategories) {
                foreach ($this->collBonPlanCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissements) {
                foreach ($this->collEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRegions) {
                foreach ($this->collRegions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collBonPlanBonPlanCategories instanceof PropelCollection) {
            $this->collBonPlanBonPlanCategories->clearIterator();
        }
        $this->collBonPlanBonPlanCategories = null;
        if ($this->collBonPlanEtablissements instanceof PropelCollection) {
            $this->collBonPlanEtablissements->clearIterator();
        }
        $this->collBonPlanEtablissements = null;
        if ($this->collBonPlanRegions instanceof PropelCollection) {
            $this->collBonPlanRegions->clearIterator();
        }
        $this->collBonPlanRegions = null;
        if ($this->collBonPlanI18ns instanceof PropelCollection) {
            $this->collBonPlanI18ns->clearIterator();
        }
        $this->collBonPlanI18ns = null;
        if ($this->collBonPlanCategories instanceof PropelCollection) {
            $this->collBonPlanCategories->clearIterator();
        }
        $this->collBonPlanCategories = null;
        if ($this->collEtablissements instanceof PropelCollection) {
            $this->collEtablissements->clearIterator();
        }
        $this->collEtablissements = null;
        if ($this->collRegions instanceof PropelCollection) {
            $this->collRegions->clearIterator();
        }
        $this->collRegions = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BonPlanPeer::DEFAULT_STRING_FORMAT);
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

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    BonPlan The current object (for fluent API support)
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
     * @return BonPlanI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collBonPlanI18ns) {
                foreach ($this->collBonPlanI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new BonPlanI18n();
                $translation->setLocale($locale);
            } else {
                $translation = BonPlanI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addBonPlanI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    BonPlan The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            BonPlanI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collBonPlanI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collBonPlanI18ns[$key]);
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
     * @return BonPlanI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [name] column value.
         *
         * @return string
         */
        public function getName()
        {
        return $this->getCurrentTranslation()->getName();
    }


        /**
         * Set the value of [name] column.
         *
         * @param string $v new value
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [slug] column value.
         *
         * @return string
         */
        public function getSlug()
        {
        return $this->getCurrentTranslation()->getSlug();
    }


        /**
         * Set the value of [slug] column.
         *
         * @param string $v new value
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

        return $this;
    }


        /**
         * Get the [introduction] column value.
         *
         * @return string
         */
        public function getIntroduction()
        {
        return $this->getCurrentTranslation()->getIntroduction();
    }


        /**
         * Set the value of [introduction] column.
         *
         * @param string $v new value
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setIntroduction($v)
        {    $this->getCurrentTranslation()->setIntroduction($v);

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
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }


        /**
         * Get the [indice] column value.
         *
         * @return string
         */
        public function getIndice()
        {
        return $this->getCurrentTranslation()->getIndice();
    }


        /**
         * Set the value of [indice] column.
         *
         * @param string $v new value
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setIndice($v)
        {    $this->getCurrentTranslation()->setIndice($v);

        return $this;
    }


        /**
         * Get the [indice_prix] column value.
         *
         * @return string
         */
        public function getIndicePrix()
        {
        return $this->getCurrentTranslation()->getIndicePrix();
    }


        /**
         * Set the value of [indice_prix] column.
         *
         * @param string $v new value
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setIndicePrix($v)
        {    $this->getCurrentTranslation()->setIndicePrix($v);

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
        if (!$form['image_menu_deleted']->getData())
        {
            $this->resetModified(BonPlanPeer::IMAGE_MENU);
        }

        $this->uploadImageMenu($form);

        if (!$form['image_page_deleted']->getData())
        {
            $this->resetModified(BonPlanPeer::IMAGE_PAGE);
        }

        $this->uploadImagePage($form);

        if (!$form['image_liste_deleted']->getData())
        {
            $this->resetModified(BonPlanPeer::IMAGE_LISTE);
        }

        $this->uploadImageListe($form);

        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/bon_plans';
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImageMenu(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_menu']->getData()))
        {
            if ($form['image_menu']->getData()) {
                $image = uniqid().'.'.$form['image_menu']->getData()->guessExtension();
                $form['image_menu']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImageMenu($this->getUploadDir() . '/' . $image);
            }
        }
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImagePage(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_page']->getData()))
        {
            if ($form['image_page']->getData()) {
                $image = uniqid().'.'.$form['image_page']->getData()->guessExtension();
                $form['image_page']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImagePage($this->getUploadDir() . '/' . $image);
            }
        }
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImageListe(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_liste']->getData()))
        {
            if ($form['image_liste']->getData()) {
                $image = uniqid().'.'.$form['image_liste']->getData()->guessExtension();
                $form['image_liste']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImageListe($this->getUploadDir() . '/' . $image);
            }
        }
    }

}
