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
use Cungfoo\Model\DemandeAnnulation;
use Cungfoo\Model\DemandeAnnulationI18n;
use Cungfoo\Model\DemandeAnnulationI18nQuery;
use Cungfoo\Model\DemandeAnnulationPeer;
use Cungfoo\Model\DemandeAnnulationQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'demande_annulation' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDemandeAnnulation extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\DemandeAnnulationPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DemandeAnnulationPeer
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
     * The value for the assure_nom field.
     * @var        string
     */
    protected $assure_nom;

    /**
     * The value for the assure_prenom field.
     * @var        string
     */
    protected $assure_prenom;

    /**
     * The value for the assure_adresse field.
     * @var        string
     */
    protected $assure_adresse;

    /**
     * The value for the assure_code_postal field.
     * @var        string
     */
    protected $assure_code_postal;

    /**
     * The value for the assure_ville field.
     * @var        string
     */
    protected $assure_ville;

    /**
     * The value for the assure_pays field.
     * @var        string
     */
    protected $assure_pays;

    /**
     * The value for the assure_mail field.
     * @var        string
     */
    protected $assure_mail;

    /**
     * The value for the assure_telephone field.
     * @var        string
     */
    protected $assure_telephone;

    /**
     * The value for the camping_id field.
     * @var        int
     */
    protected $camping_id;

    /**
     * The value for the camping_num_resa field.
     * @var        string
     */
    protected $camping_num_resa;

    /**
     * The value for the camping_montant_sejour field.
     * @var        string
     */
    protected $camping_montant_sejour;

    /**
     * The value for the camping_montant_verse field.
     * @var        string
     */
    protected $camping_montant_verse;

    /**
     * The value for the sinistre_nature field.
     * @var        int
     */
    protected $sinistre_nature;

    /**
     * The value for the sinistre_suite field.
     * @var        int
     */
    protected $sinistre_suite;

    /**
     * The value for the sinistre_date field.
     * @var        string
     */
    protected $sinistre_date;

    /**
     * The value for the sinistre_resume field.
     * @var        string
     */
    protected $sinistre_resume;

    /**
     * The value for the file_1 field.
     * @var        string
     */
    protected $file_1;

    /**
     * The value for the file_2 field.
     * @var        string
     */
    protected $file_2;

    /**
     * The value for the file_3 field.
     * @var        string
     */
    protected $file_3;

    /**
     * The value for the file_4 field.
     * @var        string
     */
    protected $file_4;

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
     * @var        Etablissement
     */
    protected $aEtablissement;

    /**
     * @var        PropelObjectCollection|DemandeAnnulationI18n[] Collection to store aggregation of DemandeAnnulationI18n objects.
     */
    protected $collDemandeAnnulationI18ns;
    protected $collDemandeAnnulationI18nsPartial;

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
     * @var        array[DemandeAnnulationI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $demandeAnnulationI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseDemandeAnnulation object.
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
     * Get the [assure_nom] column value.
     *
     * @return string
     */
    public function getAssureNom()
    {
        return $this->assure_nom;
    }

    /**
     * Get the [assure_prenom] column value.
     *
     * @return string
     */
    public function getAssurePrenom()
    {
        return $this->assure_prenom;
    }

    /**
     * Get the [assure_adresse] column value.
     *
     * @return string
     */
    public function getAssureAdresse()
    {
        return $this->assure_adresse;
    }

    /**
     * Get the [assure_code_postal] column value.
     *
     * @return string
     */
    public function getAssureCodePostal()
    {
        return $this->assure_code_postal;
    }

    /**
     * Get the [assure_ville] column value.
     *
     * @return string
     */
    public function getAssureVille()
    {
        return $this->assure_ville;
    }

    /**
     * Get the [assure_pays] column value.
     *
     * @return string
     */
    public function getAssurePays()
    {
        return $this->assure_pays;
    }

    /**
     * Get the [assure_mail] column value.
     *
     * @return string
     */
    public function getAssureMail()
    {
        return $this->assure_mail;
    }

    /**
     * Get the [assure_telephone] column value.
     *
     * @return string
     */
    public function getAssureTelephone()
    {
        return $this->assure_telephone;
    }

    /**
     * Get the [camping_id] column value.
     *
     * @return int
     */
    public function getCampingId()
    {
        return $this->camping_id;
    }

    /**
     * Get the [camping_num_resa] column value.
     *
     * @return string
     */
    public function getCampingNumResa()
    {
        return $this->camping_num_resa;
    }

    /**
     * Get the [camping_montant_sejour] column value.
     *
     * @return string
     */
    public function getCampingMontantSejour()
    {
        return $this->camping_montant_sejour;
    }

    /**
     * Get the [camping_montant_verse] column value.
     *
     * @return string
     */
    public function getCampingMontantVerse()
    {
        return $this->camping_montant_verse;
    }

    /**
     * Get the [sinistre_nature] column value.
     *
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getSinistreNature()
    {
        if (null === $this->sinistre_nature) {
            return null;
        }
        $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_NATURE);
        if (!isset($valueSet[$this->sinistre_nature])) {
            throw new PropelException('Unknown stored enum key: ' . $this->sinistre_nature);
        }

        return $valueSet[$this->sinistre_nature];
    }

    /**
     * Get the [sinistre_suite] column value.
     *
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getSinistreSuite()
    {
        if (null === $this->sinistre_suite) {
            return null;
        }
        $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_SUITE);
        if (!isset($valueSet[$this->sinistre_suite])) {
            throw new PropelException('Unknown stored enum key: ' . $this->sinistre_suite);
        }

        return $valueSet[$this->sinistre_suite];
    }

    /**
     * Get the [sinistre_date] column value.
     *
     * @return string
     */
    public function getSinistreDate()
    {
        return $this->sinistre_date;
    }

    /**
     * Get the [sinistre_resume] column value.
     *
     * @return string
     */
    public function getSinistreResume()
    {
        return $this->sinistre_resume;
    }

    /**
     * Get the [file_1] column value.
     *
     * @return string
     */
    public function getFile1()
    {
        return $this->file_1;
    }

    /**
     * Get the [file_2] column value.
     *
     * @return string
     */
    public function getFile2()
    {
        return $this->file_2;
    }

    /**
     * Get the [file_3] column value.
     *
     * @return string
     */
    public function getFile3()
    {
        return $this->file_3;
    }

    /**
     * Get the [file_4] column value.
     *
     * @return string
     */
    public function getFile4()
    {
        return $this->file_4;
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
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [assure_nom] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssureNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_nom !== $v) {
            $this->assure_nom = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_NOM;
        }


        return $this;
    } // setAssureNom()

    /**
     * Set the value of [assure_prenom] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssurePrenom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_prenom !== $v) {
            $this->assure_prenom = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_PRENOM;
        }


        return $this;
    } // setAssurePrenom()

    /**
     * Set the value of [assure_adresse] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssureAdresse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_adresse !== $v) {
            $this->assure_adresse = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_ADRESSE;
        }


        return $this;
    } // setAssureAdresse()

    /**
     * Set the value of [assure_code_postal] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssureCodePostal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_code_postal !== $v) {
            $this->assure_code_postal = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_CODE_POSTAL;
        }


        return $this;
    } // setAssureCodePostal()

    /**
     * Set the value of [assure_ville] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssureVille($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_ville !== $v) {
            $this->assure_ville = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_VILLE;
        }


        return $this;
    } // setAssureVille()

    /**
     * Set the value of [assure_pays] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssurePays($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_pays !== $v) {
            $this->assure_pays = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_PAYS;
        }


        return $this;
    } // setAssurePays()

    /**
     * Set the value of [assure_mail] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssureMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_mail !== $v) {
            $this->assure_mail = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_MAIL;
        }


        return $this;
    } // setAssureMail()

    /**
     * Set the value of [assure_telephone] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setAssureTelephone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->assure_telephone !== $v) {
            $this->assure_telephone = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::ASSURE_TELEPHONE;
        }


        return $this;
    } // setAssureTelephone()

    /**
     * Set the value of [camping_id] column.
     *
     * @param int $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setCampingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->camping_id !== $v) {
            $this->camping_id = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::CAMPING_ID;
        }

        if ($this->aEtablissement !== null && $this->aEtablissement->getId() !== $v) {
            $this->aEtablissement = null;
        }


        return $this;
    } // setCampingId()

    /**
     * Set the value of [camping_num_resa] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setCampingNumResa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->camping_num_resa !== $v) {
            $this->camping_num_resa = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::CAMPING_NUM_RESA;
        }


        return $this;
    } // setCampingNumResa()

    /**
     * Set the value of [camping_montant_sejour] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setCampingMontantSejour($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->camping_montant_sejour !== $v) {
            $this->camping_montant_sejour = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR;
        }


        return $this;
    } // setCampingMontantSejour()

    /**
     * Set the value of [camping_montant_verse] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setCampingMontantVerse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->camping_montant_verse !== $v) {
            $this->camping_montant_verse = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::CAMPING_MONTANT_VERSE;
        }


        return $this;
    } // setCampingMontantVerse()

    /**
     * Set the value of [sinistre_nature] column.
     *
     * @param int $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setSinistreNature($v)
    {
        if ($v !== null) {
            $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_NATURE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->sinistre_nature !== $v) {
            $this->sinistre_nature = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::SINISTRE_NATURE;
        }


        return $this;
    } // setSinistreNature()

    /**
     * Set the value of [sinistre_suite] column.
     *
     * @param int $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setSinistreSuite($v)
    {
        if ($v !== null) {
            $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_SUITE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->sinistre_suite !== $v) {
            $this->sinistre_suite = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::SINISTRE_SUITE;
        }


        return $this;
    } // setSinistreSuite()

    /**
     * Set the value of [sinistre_date] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setSinistreDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sinistre_date !== $v) {
            $this->sinistre_date = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::SINISTRE_DATE;
        }


        return $this;
    } // setSinistreDate()

    /**
     * Set the value of [sinistre_resume] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setSinistreResume($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sinistre_resume !== $v) {
            $this->sinistre_resume = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::SINISTRE_RESUME;
        }


        return $this;
    } // setSinistreResume()

    /**
     * Set the value of [file_1] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setFile1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_1 !== $v) {
            $this->file_1 = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::FILE_1;
        }


        return $this;
    } // setFile1()

    /**
     * Set the value of [file_2] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setFile2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_2 !== $v) {
            $this->file_2 = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::FILE_2;
        }


        return $this;
    } // setFile2()

    /**
     * Set the value of [file_3] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setFile3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_3 !== $v) {
            $this->file_3 = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::FILE_3;
        }


        return $this;
    } // setFile3()

    /**
     * Set the value of [file_4] column.
     *
     * @param string $v new value
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setFile4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_4 !== $v) {
            $this->file_4 = $v;
            $this->modifiedColumns[] = DemandeAnnulationPeer::FILE_4;
        }


        return $this;
    } // setFile4()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = DemandeAnnulationPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = DemandeAnnulationPeer::UPDATED_AT;
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
     * @return DemandeAnnulation The current object (for fluent API support)
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
            $this->modifiedColumns[] = DemandeAnnulationPeer::ACTIVE;
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
            $this->assure_nom = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->assure_prenom = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->assure_adresse = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->assure_code_postal = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->assure_ville = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->assure_pays = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->assure_mail = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->assure_telephone = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->camping_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->camping_num_resa = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->camping_montant_sejour = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->camping_montant_verse = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->sinistre_nature = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->sinistre_suite = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
            $this->sinistre_date = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->sinistre_resume = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->file_1 = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->file_2 = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->file_3 = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->file_4 = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->created_at = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->updated_at = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->active = ($row[$startcol + 23] !== null) ? (boolean) $row[$startcol + 23] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 24; // 24 = DemandeAnnulationPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating DemandeAnnulation object", $e);
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

        if ($this->aEtablissement !== null && $this->camping_id !== $this->aEtablissement->getId()) {
            $this->aEtablissement = null;
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
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DemandeAnnulationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEtablissement = null;
            $this->collDemandeAnnulationI18ns = null;

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
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DemandeAnnulationQuery::create()
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
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(DemandeAnnulationPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DemandeAnnulationPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DemandeAnnulationPeer::UPDATED_AT)) {
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
                DemandeAnnulationPeer::addInstanceToPool($this);
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

            if ($this->aEtablissement !== null) {
                if ($this->aEtablissement->isModified() || $this->aEtablissement->isNew()) {
                    $affectedRows += $this->aEtablissement->save($con);
                }
                $this->setEtablissement($this->aEtablissement);
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

            if ($this->demandeAnnulationI18nsScheduledForDeletion !== null) {
                if (!$this->demandeAnnulationI18nsScheduledForDeletion->isEmpty()) {
                    DemandeAnnulationI18nQuery::create()
                        ->filterByPrimaryKeys($this->demandeAnnulationI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->demandeAnnulationI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collDemandeAnnulationI18ns !== null) {
                foreach ($this->collDemandeAnnulationI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = DemandeAnnulationPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DemandeAnnulationPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DemandeAnnulationPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_NOM)) {
            $modifiedColumns[':p' . $index++]  = '`assure_nom`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_PRENOM)) {
            $modifiedColumns[':p' . $index++]  = '`assure_prenom`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_ADRESSE)) {
            $modifiedColumns[':p' . $index++]  = '`assure_adresse`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_CODE_POSTAL)) {
            $modifiedColumns[':p' . $index++]  = '`assure_code_postal`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_VILLE)) {
            $modifiedColumns[':p' . $index++]  = '`assure_ville`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_PAYS)) {
            $modifiedColumns[':p' . $index++]  = '`assure_pays`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`assure_mail`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_TELEPHONE)) {
            $modifiedColumns[':p' . $index++]  = '`assure_telephone`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_ID)) {
            $modifiedColumns[':p' . $index++]  = '`camping_id`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_NUM_RESA)) {
            $modifiedColumns[':p' . $index++]  = '`camping_num_resa`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR)) {
            $modifiedColumns[':p' . $index++]  = '`camping_montant_sejour`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_MONTANT_VERSE)) {
            $modifiedColumns[':p' . $index++]  = '`camping_montant_verse`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_NATURE)) {
            $modifiedColumns[':p' . $index++]  = '`sinistre_nature`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_SUITE)) {
            $modifiedColumns[':p' . $index++]  = '`sinistre_suite`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`sinistre_date`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_RESUME)) {
            $modifiedColumns[':p' . $index++]  = '`sinistre_resume`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_1)) {
            $modifiedColumns[':p' . $index++]  = '`file_1`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_2)) {
            $modifiedColumns[':p' . $index++]  = '`file_2`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_3)) {
            $modifiedColumns[':p' . $index++]  = '`file_3`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_4)) {
            $modifiedColumns[':p' . $index++]  = '`file_4`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(DemandeAnnulationPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `demande_annulation` (%s) VALUES (%s)',
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
                    case '`assure_nom`':
                        $stmt->bindValue($identifier, $this->assure_nom, PDO::PARAM_STR);
                        break;
                    case '`assure_prenom`':
                        $stmt->bindValue($identifier, $this->assure_prenom, PDO::PARAM_STR);
                        break;
                    case '`assure_adresse`':
                        $stmt->bindValue($identifier, $this->assure_adresse, PDO::PARAM_STR);
                        break;
                    case '`assure_code_postal`':
                        $stmt->bindValue($identifier, $this->assure_code_postal, PDO::PARAM_STR);
                        break;
                    case '`assure_ville`':
                        $stmt->bindValue($identifier, $this->assure_ville, PDO::PARAM_STR);
                        break;
                    case '`assure_pays`':
                        $stmt->bindValue($identifier, $this->assure_pays, PDO::PARAM_STR);
                        break;
                    case '`assure_mail`':
                        $stmt->bindValue($identifier, $this->assure_mail, PDO::PARAM_STR);
                        break;
                    case '`assure_telephone`':
                        $stmt->bindValue($identifier, $this->assure_telephone, PDO::PARAM_STR);
                        break;
                    case '`camping_id`':
                        $stmt->bindValue($identifier, $this->camping_id, PDO::PARAM_INT);
                        break;
                    case '`camping_num_resa`':
                        $stmt->bindValue($identifier, $this->camping_num_resa, PDO::PARAM_STR);
                        break;
                    case '`camping_montant_sejour`':
                        $stmt->bindValue($identifier, $this->camping_montant_sejour, PDO::PARAM_STR);
                        break;
                    case '`camping_montant_verse`':
                        $stmt->bindValue($identifier, $this->camping_montant_verse, PDO::PARAM_STR);
                        break;
                    case '`sinistre_nature`':
                        $stmt->bindValue($identifier, $this->sinistre_nature, PDO::PARAM_INT);
                        break;
                    case '`sinistre_suite`':
                        $stmt->bindValue($identifier, $this->sinistre_suite, PDO::PARAM_INT);
                        break;
                    case '`sinistre_date`':
                        $stmt->bindValue($identifier, $this->sinistre_date, PDO::PARAM_STR);
                        break;
                    case '`sinistre_resume`':
                        $stmt->bindValue($identifier, $this->sinistre_resume, PDO::PARAM_STR);
                        break;
                    case '`file_1`':
                        $stmt->bindValue($identifier, $this->file_1, PDO::PARAM_STR);
                        break;
                    case '`file_2`':
                        $stmt->bindValue($identifier, $this->file_2, PDO::PARAM_STR);
                        break;
                    case '`file_3`':
                        $stmt->bindValue($identifier, $this->file_3, PDO::PARAM_STR);
                        break;
                    case '`file_4`':
                        $stmt->bindValue($identifier, $this->file_4, PDO::PARAM_STR);
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

            if ($this->aEtablissement !== null) {
                if (!$this->aEtablissement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEtablissement->getValidationFailures());
                }
            }


            if (($retval = DemandeAnnulationPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collDemandeAnnulationI18ns !== null) {
                    foreach ($this->collDemandeAnnulationI18ns as $referrerFK) {
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
        $pos = DemandeAnnulationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAssureNom();
                break;
            case 2:
                return $this->getAssurePrenom();
                break;
            case 3:
                return $this->getAssureAdresse();
                break;
            case 4:
                return $this->getAssureCodePostal();
                break;
            case 5:
                return $this->getAssureVille();
                break;
            case 6:
                return $this->getAssurePays();
                break;
            case 7:
                return $this->getAssureMail();
                break;
            case 8:
                return $this->getAssureTelephone();
                break;
            case 9:
                return $this->getCampingId();
                break;
            case 10:
                return $this->getCampingNumResa();
                break;
            case 11:
                return $this->getCampingMontantSejour();
                break;
            case 12:
                return $this->getCampingMontantVerse();
                break;
            case 13:
                return $this->getSinistreNature();
                break;
            case 14:
                return $this->getSinistreSuite();
                break;
            case 15:
                return $this->getSinistreDate();
                break;
            case 16:
                return $this->getSinistreResume();
                break;
            case 17:
                return $this->getFile1();
                break;
            case 18:
                return $this->getFile2();
                break;
            case 19:
                return $this->getFile3();
                break;
            case 20:
                return $this->getFile4();
                break;
            case 21:
                return $this->getCreatedAt();
                break;
            case 22:
                return $this->getUpdatedAt();
                break;
            case 23:
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
        if (isset($alreadyDumpedObjects['DemandeAnnulation'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['DemandeAnnulation'][$this->getPrimaryKey()] = true;
        $keys = DemandeAnnulationPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAssureNom(),
            $keys[2] => $this->getAssurePrenom(),
            $keys[3] => $this->getAssureAdresse(),
            $keys[4] => $this->getAssureCodePostal(),
            $keys[5] => $this->getAssureVille(),
            $keys[6] => $this->getAssurePays(),
            $keys[7] => $this->getAssureMail(),
            $keys[8] => $this->getAssureTelephone(),
            $keys[9] => $this->getCampingId(),
            $keys[10] => $this->getCampingNumResa(),
            $keys[11] => $this->getCampingMontantSejour(),
            $keys[12] => $this->getCampingMontantVerse(),
            $keys[13] => $this->getSinistreNature(),
            $keys[14] => $this->getSinistreSuite(),
            $keys[15] => $this->getSinistreDate(),
            $keys[16] => $this->getSinistreResume(),
            $keys[17] => $this->getFile1(),
            $keys[18] => $this->getFile2(),
            $keys[19] => $this->getFile3(),
            $keys[20] => $this->getFile4(),
            $keys[21] => $this->getCreatedAt(),
            $keys[22] => $this->getUpdatedAt(),
            $keys[23] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aEtablissement) {
                $result['Etablissement'] = $this->aEtablissement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDemandeAnnulationI18ns) {
                $result['DemandeAnnulationI18ns'] = $this->collDemandeAnnulationI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DemandeAnnulationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAssureNom($value);
                break;
            case 2:
                $this->setAssurePrenom($value);
                break;
            case 3:
                $this->setAssureAdresse($value);
                break;
            case 4:
                $this->setAssureCodePostal($value);
                break;
            case 5:
                $this->setAssureVille($value);
                break;
            case 6:
                $this->setAssurePays($value);
                break;
            case 7:
                $this->setAssureMail($value);
                break;
            case 8:
                $this->setAssureTelephone($value);
                break;
            case 9:
                $this->setCampingId($value);
                break;
            case 10:
                $this->setCampingNumResa($value);
                break;
            case 11:
                $this->setCampingMontantSejour($value);
                break;
            case 12:
                $this->setCampingMontantVerse($value);
                break;
            case 13:
                $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_NATURE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setSinistreNature($value);
                break;
            case 14:
                $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_SUITE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setSinistreSuite($value);
                break;
            case 15:
                $this->setSinistreDate($value);
                break;
            case 16:
                $this->setSinistreResume($value);
                break;
            case 17:
                $this->setFile1($value);
                break;
            case 18:
                $this->setFile2($value);
                break;
            case 19:
                $this->setFile3($value);
                break;
            case 20:
                $this->setFile4($value);
                break;
            case 21:
                $this->setCreatedAt($value);
                break;
            case 22:
                $this->setUpdatedAt($value);
                break;
            case 23:
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
        $keys = DemandeAnnulationPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAssureNom($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAssurePrenom($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAssureAdresse($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAssureCodePostal($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAssureVille($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAssurePays($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAssureMail($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setAssureTelephone($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCampingId($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCampingNumResa($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setCampingMontantSejour($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setCampingMontantVerse($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setSinistreNature($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setSinistreSuite($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setSinistreDate($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setSinistreResume($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setFile1($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setFile2($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setFile3($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setFile4($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setCreatedAt($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setUpdatedAt($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setActive($arr[$keys[23]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DemandeAnnulationPeer::DATABASE_NAME);

        if ($this->isColumnModified(DemandeAnnulationPeer::ID)) $criteria->add(DemandeAnnulationPeer::ID, $this->id);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_NOM)) $criteria->add(DemandeAnnulationPeer::ASSURE_NOM, $this->assure_nom);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_PRENOM)) $criteria->add(DemandeAnnulationPeer::ASSURE_PRENOM, $this->assure_prenom);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_ADRESSE)) $criteria->add(DemandeAnnulationPeer::ASSURE_ADRESSE, $this->assure_adresse);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_CODE_POSTAL)) $criteria->add(DemandeAnnulationPeer::ASSURE_CODE_POSTAL, $this->assure_code_postal);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_VILLE)) $criteria->add(DemandeAnnulationPeer::ASSURE_VILLE, $this->assure_ville);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_PAYS)) $criteria->add(DemandeAnnulationPeer::ASSURE_PAYS, $this->assure_pays);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_MAIL)) $criteria->add(DemandeAnnulationPeer::ASSURE_MAIL, $this->assure_mail);
        if ($this->isColumnModified(DemandeAnnulationPeer::ASSURE_TELEPHONE)) $criteria->add(DemandeAnnulationPeer::ASSURE_TELEPHONE, $this->assure_telephone);
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_ID)) $criteria->add(DemandeAnnulationPeer::CAMPING_ID, $this->camping_id);
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_NUM_RESA)) $criteria->add(DemandeAnnulationPeer::CAMPING_NUM_RESA, $this->camping_num_resa);
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR)) $criteria->add(DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR, $this->camping_montant_sejour);
        if ($this->isColumnModified(DemandeAnnulationPeer::CAMPING_MONTANT_VERSE)) $criteria->add(DemandeAnnulationPeer::CAMPING_MONTANT_VERSE, $this->camping_montant_verse);
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_NATURE)) $criteria->add(DemandeAnnulationPeer::SINISTRE_NATURE, $this->sinistre_nature);
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_SUITE)) $criteria->add(DemandeAnnulationPeer::SINISTRE_SUITE, $this->sinistre_suite);
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_DATE)) $criteria->add(DemandeAnnulationPeer::SINISTRE_DATE, $this->sinistre_date);
        if ($this->isColumnModified(DemandeAnnulationPeer::SINISTRE_RESUME)) $criteria->add(DemandeAnnulationPeer::SINISTRE_RESUME, $this->sinistre_resume);
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_1)) $criteria->add(DemandeAnnulationPeer::FILE_1, $this->file_1);
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_2)) $criteria->add(DemandeAnnulationPeer::FILE_2, $this->file_2);
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_3)) $criteria->add(DemandeAnnulationPeer::FILE_3, $this->file_3);
        if ($this->isColumnModified(DemandeAnnulationPeer::FILE_4)) $criteria->add(DemandeAnnulationPeer::FILE_4, $this->file_4);
        if ($this->isColumnModified(DemandeAnnulationPeer::CREATED_AT)) $criteria->add(DemandeAnnulationPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(DemandeAnnulationPeer::UPDATED_AT)) $criteria->add(DemandeAnnulationPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(DemandeAnnulationPeer::ACTIVE)) $criteria->add(DemandeAnnulationPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(DemandeAnnulationPeer::DATABASE_NAME);
        $criteria->add(DemandeAnnulationPeer::ID, $this->id);

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
     * @param object $copyObj An object of DemandeAnnulation (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAssureNom($this->getAssureNom());
        $copyObj->setAssurePrenom($this->getAssurePrenom());
        $copyObj->setAssureAdresse($this->getAssureAdresse());
        $copyObj->setAssureCodePostal($this->getAssureCodePostal());
        $copyObj->setAssureVille($this->getAssureVille());
        $copyObj->setAssurePays($this->getAssurePays());
        $copyObj->setAssureMail($this->getAssureMail());
        $copyObj->setAssureTelephone($this->getAssureTelephone());
        $copyObj->setCampingId($this->getCampingId());
        $copyObj->setCampingNumResa($this->getCampingNumResa());
        $copyObj->setCampingMontantSejour($this->getCampingMontantSejour());
        $copyObj->setCampingMontantVerse($this->getCampingMontantVerse());
        $copyObj->setSinistreNature($this->getSinistreNature());
        $copyObj->setSinistreSuite($this->getSinistreSuite());
        $copyObj->setSinistreDate($this->getSinistreDate());
        $copyObj->setSinistreResume($this->getSinistreResume());
        $copyObj->setFile1($this->getFile1());
        $copyObj->setFile2($this->getFile2());
        $copyObj->setFile3($this->getFile3());
        $copyObj->setFile4($this->getFile4());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getDemandeAnnulationI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDemandeAnnulationI18n($relObj->copy($deepCopy));
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
     * @return DemandeAnnulation Clone of current object.
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
     * @return DemandeAnnulationPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DemandeAnnulationPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return DemandeAnnulation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEtablissement(Etablissement $v = null)
    {
        if ($v === null) {
            $this->setCampingId(NULL);
        } else {
            $this->setCampingId($v->getId());
        }

        $this->aEtablissement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Etablissement object, it will not be re-added.
        if ($v !== null) {
            $v->addDemandeAnnulation($this);
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
    public function getEtablissement(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEtablissement === null && ($this->camping_id !== null) && $doQuery) {
            $this->aEtablissement = EtablissementQuery::create()->findPk($this->camping_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEtablissement->addDemandeAnnulations($this);
             */
        }

        return $this->aEtablissement;
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
        if ('DemandeAnnulationI18n' == $relationName) {
            $this->initDemandeAnnulationI18ns();
        }
    }

    /**
     * Clears out the collDemandeAnnulationI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return DemandeAnnulation The current object (for fluent API support)
     * @see        addDemandeAnnulationI18ns()
     */
    public function clearDemandeAnnulationI18ns()
    {
        $this->collDemandeAnnulationI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collDemandeAnnulationI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collDemandeAnnulationI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialDemandeAnnulationI18ns($v = true)
    {
        $this->collDemandeAnnulationI18nsPartial = $v;
    }

    /**
     * Initializes the collDemandeAnnulationI18ns collection.
     *
     * By default this just sets the collDemandeAnnulationI18ns collection to an empty array (like clearcollDemandeAnnulationI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDemandeAnnulationI18ns($overrideExisting = true)
    {
        if (null !== $this->collDemandeAnnulationI18ns && !$overrideExisting) {
            return;
        }
        $this->collDemandeAnnulationI18ns = new PropelObjectCollection();
        $this->collDemandeAnnulationI18ns->setModel('DemandeAnnulationI18n');
    }

    /**
     * Gets an array of DemandeAnnulationI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this DemandeAnnulation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DemandeAnnulationI18n[] List of DemandeAnnulationI18n objects
     * @throws PropelException
     */
    public function getDemandeAnnulationI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDemandeAnnulationI18nsPartial && !$this->isNew();
        if (null === $this->collDemandeAnnulationI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDemandeAnnulationI18ns) {
                // return empty collection
                $this->initDemandeAnnulationI18ns();
            } else {
                $collDemandeAnnulationI18ns = DemandeAnnulationI18nQuery::create(null, $criteria)
                    ->filterByDemandeAnnulation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDemandeAnnulationI18nsPartial && count($collDemandeAnnulationI18ns)) {
                      $this->initDemandeAnnulationI18ns(false);

                      foreach($collDemandeAnnulationI18ns as $obj) {
                        if (false == $this->collDemandeAnnulationI18ns->contains($obj)) {
                          $this->collDemandeAnnulationI18ns->append($obj);
                        }
                      }

                      $this->collDemandeAnnulationI18nsPartial = true;
                    }

                    return $collDemandeAnnulationI18ns;
                }

                if($partial && $this->collDemandeAnnulationI18ns) {
                    foreach($this->collDemandeAnnulationI18ns as $obj) {
                        if($obj->isNew()) {
                            $collDemandeAnnulationI18ns[] = $obj;
                        }
                    }
                }

                $this->collDemandeAnnulationI18ns = $collDemandeAnnulationI18ns;
                $this->collDemandeAnnulationI18nsPartial = false;
            }
        }

        return $this->collDemandeAnnulationI18ns;
    }

    /**
     * Sets a collection of DemandeAnnulationI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $demandeAnnulationI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function setDemandeAnnulationI18ns(PropelCollection $demandeAnnulationI18ns, PropelPDO $con = null)
    {
        $this->demandeAnnulationI18nsScheduledForDeletion = $this->getDemandeAnnulationI18ns(new Criteria(), $con)->diff($demandeAnnulationI18ns);

        foreach ($this->demandeAnnulationI18nsScheduledForDeletion as $demandeAnnulationI18nRemoved) {
            $demandeAnnulationI18nRemoved->setDemandeAnnulation(null);
        }

        $this->collDemandeAnnulationI18ns = null;
        foreach ($demandeAnnulationI18ns as $demandeAnnulationI18n) {
            $this->addDemandeAnnulationI18n($demandeAnnulationI18n);
        }

        $this->collDemandeAnnulationI18ns = $demandeAnnulationI18ns;
        $this->collDemandeAnnulationI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DemandeAnnulationI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DemandeAnnulationI18n objects.
     * @throws PropelException
     */
    public function countDemandeAnnulationI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDemandeAnnulationI18nsPartial && !$this->isNew();
        if (null === $this->collDemandeAnnulationI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDemandeAnnulationI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getDemandeAnnulationI18ns());
            }
            $query = DemandeAnnulationI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDemandeAnnulation($this)
                ->count($con);
        }

        return count($this->collDemandeAnnulationI18ns);
    }

    /**
     * Method called to associate a DemandeAnnulationI18n object to this object
     * through the DemandeAnnulationI18n foreign key attribute.
     *
     * @param    DemandeAnnulationI18n $l DemandeAnnulationI18n
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function addDemandeAnnulationI18n(DemandeAnnulationI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collDemandeAnnulationI18ns === null) {
            $this->initDemandeAnnulationI18ns();
            $this->collDemandeAnnulationI18nsPartial = true;
        }
        if (!in_array($l, $this->collDemandeAnnulationI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDemandeAnnulationI18n($l);
        }

        return $this;
    }

    /**
     * @param	DemandeAnnulationI18n $demandeAnnulationI18n The demandeAnnulationI18n object to add.
     */
    protected function doAddDemandeAnnulationI18n($demandeAnnulationI18n)
    {
        $this->collDemandeAnnulationI18ns[]= $demandeAnnulationI18n;
        $demandeAnnulationI18n->setDemandeAnnulation($this);
    }

    /**
     * @param	DemandeAnnulationI18n $demandeAnnulationI18n The demandeAnnulationI18n object to remove.
     * @return DemandeAnnulation The current object (for fluent API support)
     */
    public function removeDemandeAnnulationI18n($demandeAnnulationI18n)
    {
        if ($this->getDemandeAnnulationI18ns()->contains($demandeAnnulationI18n)) {
            $this->collDemandeAnnulationI18ns->remove($this->collDemandeAnnulationI18ns->search($demandeAnnulationI18n));
            if (null === $this->demandeAnnulationI18nsScheduledForDeletion) {
                $this->demandeAnnulationI18nsScheduledForDeletion = clone $this->collDemandeAnnulationI18ns;
                $this->demandeAnnulationI18nsScheduledForDeletion->clear();
            }
            $this->demandeAnnulationI18nsScheduledForDeletion[]= $demandeAnnulationI18n;
            $demandeAnnulationI18n->setDemandeAnnulation(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->assure_nom = null;
        $this->assure_prenom = null;
        $this->assure_adresse = null;
        $this->assure_code_postal = null;
        $this->assure_ville = null;
        $this->assure_pays = null;
        $this->assure_mail = null;
        $this->assure_telephone = null;
        $this->camping_id = null;
        $this->camping_num_resa = null;
        $this->camping_montant_sejour = null;
        $this->camping_montant_verse = null;
        $this->sinistre_nature = null;
        $this->sinistre_suite = null;
        $this->sinistre_date = null;
        $this->sinistre_resume = null;
        $this->file_1 = null;
        $this->file_2 = null;
        $this->file_3 = null;
        $this->file_4 = null;
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
            if ($this->collDemandeAnnulationI18ns) {
                foreach ($this->collDemandeAnnulationI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collDemandeAnnulationI18ns instanceof PropelCollection) {
            $this->collDemandeAnnulationI18ns->clearIterator();
        }
        $this->collDemandeAnnulationI18ns = null;
        $this->aEtablissement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DemandeAnnulationPeer::DEFAULT_STRING_FORMAT);
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
     * @return     DemandeAnnulation The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = DemandeAnnulationPeer::UPDATED_AT;

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
        if (!$form['file_1_deleted']->getData())
        {
            $this->resetModified(DemandeAnnulationPeer::FILE_1);
        }

        $this->uploadFile1($form);

        if (!$form['file_2_deleted']->getData())
        {
            $this->resetModified(DemandeAnnulationPeer::FILE_2);
        }

        $this->uploadFile2($form);

        if (!$form['file_3_deleted']->getData())
        {
            $this->resetModified(DemandeAnnulationPeer::FILE_3);
        }

        $this->uploadFile3($form);

        if (!$form['file_4_deleted']->getData())
        {
            $this->resetModified(DemandeAnnulationPeer::FILE_4);
        }

        $this->uploadFile4($form);

        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/demande_annulations';
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
    public function uploadFile1(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['file_1']->getData()))
        {
            if ($form['file_1']->getData()) {
                $image = uniqid().'.'.$form['file_1']->getData()->guessExtension();
                $form['file_1']->getData()->move($this->getUploadRootDir(), $image);
                $this->setFile1($this->getUploadDir() . '/' . $image);
            }
        }
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadFile2(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['file_2']->getData()))
        {
            if ($form['file_2']->getData()) {
                $image = uniqid().'.'.$form['file_2']->getData()->guessExtension();
                $form['file_2']->getData()->move($this->getUploadRootDir(), $image);
                $this->setFile2($this->getUploadDir() . '/' . $image);
            }
        }
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadFile3(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['file_3']->getData()))
        {
            if ($form['file_3']->getData()) {
                $image = uniqid().'.'.$form['file_3']->getData()->guessExtension();
                $form['file_3']->getData()->move($this->getUploadRootDir(), $image);
                $this->setFile3($this->getUploadDir() . '/' . $image);
            }
        }
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadFile4(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['file_4']->getData()))
        {
            if ($form['file_4']->getData()) {
                $image = uniqid().'.'.$form['file_4']->getData()->guessExtension();
                $form['file_4']->getData()->move($this->getUploadRootDir(), $image);
                $this->setFile4($this->getUploadDir() . '/' . $image);
            }
        }
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    DemandeAnnulation The current object (for fluent API support)
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
     * @return DemandeAnnulationI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collDemandeAnnulationI18ns) {
                foreach ($this->collDemandeAnnulationI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new DemandeAnnulationI18n();
                $translation->setLocale($locale);
            } else {
                $translation = DemandeAnnulationI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addDemandeAnnulationI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    DemandeAnnulation The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            DemandeAnnulationI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collDemandeAnnulationI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collDemandeAnnulationI18ns[$key]);
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
     * @return DemandeAnnulationI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
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
            return $peerClassName::getSeo()->getSeoTitle();
        }

        return '';
    }



        /**
         * Set the value of [seo_title] column.
         *
         * @param string $v new value
         * @return DemandeAnnulationI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoDescription();
        }

        return '';
    }



        /**
         * Set the value of [seo_description] column.
         *
         * @param string $v new value
         * @return DemandeAnnulationI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoH1();
        }

        return '';
    }



        /**
         * Set the value of [seo_h1] column.
         *
         * @param string $v new value
         * @return DemandeAnnulationI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoKeywords();
        }

        return '';
    }



        /**
         * Set the value of [seo_keywords] column.
         *
         * @param string $v new value
         * @return DemandeAnnulationI18n The current object (for fluent API support)
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
         * @return DemandeAnnulationI18n The current object (for fluent API support)
         */
        public function setActiveLocale($v)
        {    $this->getCurrentTranslation()->setActiveLocale($v);

        return $this;
    }

}
