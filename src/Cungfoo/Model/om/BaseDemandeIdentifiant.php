<?php

namespace Cungfoo\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\DemandeIdentifiant;
use Cungfoo\Model\DemandeIdentifiantPeer;
use Cungfoo\Model\DemandeIdentifiantQuery;

/**
 * Base class that represents a row from the 'demande_identifiant' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDemandeIdentifiant extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\DemandeIdentifiantPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DemandeIdentifiantPeer
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
     * The value for the societe_nom field.
     * @var        string
     */
    protected $societe_nom;

    /**
     * The value for the societe_adresse_1 field.
     * @var        string
     */
    protected $societe_adresse_1;

    /**
     * The value for the societe_adresse_2 field.
     * @var        string
     */
    protected $societe_adresse_2;

    /**
     * The value for the societe_adresse_3 field.
     * @var        string
     */
    protected $societe_adresse_3;

    /**
     * The value for the societe_adresse_4 field.
     * @var        string
     */
    protected $societe_adresse_4;

    /**
     * The value for the societe_telephone field.
     * @var        string
     */
    protected $societe_telephone;

    /**
     * The value for the societe_fax field.
     * @var        string
     */
    protected $societe_fax;

    /**
     * The value for the contact_prenom field.
     * @var        string
     */
    protected $contact_prenom;

    /**
     * The value for the contact_nom field.
     * @var        string
     */
    protected $contact_nom;

    /**
     * The value for the contact_telephone field.
     * @var        string
     */
    protected $contact_telephone;

    /**
     * The value for the contact_mail field.
     * @var        string
     */
    protected $contact_mail;

    /**
     * The value for the permanence field.
     * @var        string
     */
    protected $permanence;

    /**
     * The value for the permanence_matin_de field.
     * @var        string
     */
    protected $permanence_matin_de;

    /**
     * The value for the permanence_matin_a field.
     * @var        string
     */
    protected $permanence_matin_a;

    /**
     * The value for the permanence_apres_midi_de field.
     * @var        string
     */
    protected $permanence_apres_midi_de;

    /**
     * The value for the permanence_apres_midi_a field.
     * @var        string
     */
    protected $permanence_apres_midi_a;

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
     * Get the [societe_nom] column value.
     *
     * @return string
     */
    public function getSocieteNom()
    {
        return $this->societe_nom;
    }

    /**
     * Get the [societe_adresse_1] column value.
     *
     * @return string
     */
    public function getSocieteAdresse1()
    {
        return $this->societe_adresse_1;
    }

    /**
     * Get the [societe_adresse_2] column value.
     *
     * @return string
     */
    public function getSocieteAdresse2()
    {
        return $this->societe_adresse_2;
    }

    /**
     * Get the [societe_adresse_3] column value.
     *
     * @return string
     */
    public function getSocieteAdresse3()
    {
        return $this->societe_adresse_3;
    }

    /**
     * Get the [societe_adresse_4] column value.
     *
     * @return string
     */
    public function getSocieteAdresse4()
    {
        return $this->societe_adresse_4;
    }

    /**
     * Get the [societe_telephone] column value.
     *
     * @return string
     */
    public function getSocieteTelephone()
    {
        return $this->societe_telephone;
    }

    /**
     * Get the [societe_fax] column value.
     *
     * @return string
     */
    public function getSocieteFax()
    {
        return $this->societe_fax;
    }

    /**
     * Get the [contact_prenom] column value.
     *
     * @return string
     */
    public function getContactPrenom()
    {
        return $this->contact_prenom;
    }

    /**
     * Get the [contact_nom] column value.
     *
     * @return string
     */
    public function getContactNom()
    {
        return $this->contact_nom;
    }

    /**
     * Get the [contact_telephone] column value.
     *
     * @return string
     */
    public function getContactTelephone()
    {
        return $this->contact_telephone;
    }

    /**
     * Get the [contact_mail] column value.
     *
     * @return string
     */
    public function getContactMail()
    {
        return $this->contact_mail;
    }

    /**
     * Get the [permanence] column value.
     *
     * @return string
     */
    public function getPermanence()
    {
        return $this->permanence;
    }

    /**
     * Get the [permanence_matin_de] column value.
     *
     * @return string
     */
    public function getPermanenceMatinDe()
    {
        return $this->permanence_matin_de;
    }

    /**
     * Get the [permanence_matin_a] column value.
     *
     * @return string
     */
    public function getPermanenceMatinA()
    {
        return $this->permanence_matin_a;
    }

    /**
     * Get the [permanence_apres_midi_de] column value.
     *
     * @return string
     */
    public function getPermanenceApresMidiDe()
    {
        return $this->permanence_apres_midi_de;
    }

    /**
     * Get the [permanence_apres_midi_a] column value.
     *
     * @return string
     */
    public function getPermanenceApresMidiA()
    {
        return $this->permanence_apres_midi_a;
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
        } else {
            try {
                $dt = new DateTime($this->created_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
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
        } else {
            try {
                $dt = new DateTime($this->updated_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [societe_nom] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_nom !== $v) {
            $this->societe_nom = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_NOM;
        }


        return $this;
    } // setSocieteNom()

    /**
     * Set the value of [societe_adresse_1] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteAdresse1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_adresse_1 !== $v) {
            $this->societe_adresse_1 = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_ADRESSE_1;
        }


        return $this;
    } // setSocieteAdresse1()

    /**
     * Set the value of [societe_adresse_2] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteAdresse2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_adresse_2 !== $v) {
            $this->societe_adresse_2 = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_ADRESSE_2;
        }


        return $this;
    } // setSocieteAdresse2()

    /**
     * Set the value of [societe_adresse_3] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteAdresse3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_adresse_3 !== $v) {
            $this->societe_adresse_3 = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_ADRESSE_3;
        }


        return $this;
    } // setSocieteAdresse3()

    /**
     * Set the value of [societe_adresse_4] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteAdresse4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_adresse_4 !== $v) {
            $this->societe_adresse_4 = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_ADRESSE_4;
        }


        return $this;
    } // setSocieteAdresse4()

    /**
     * Set the value of [societe_telephone] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteTelephone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_telephone !== $v) {
            $this->societe_telephone = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_TELEPHONE;
        }


        return $this;
    } // setSocieteTelephone()

    /**
     * Set the value of [societe_fax] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setSocieteFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->societe_fax !== $v) {
            $this->societe_fax = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::SOCIETE_FAX;
        }


        return $this;
    } // setSocieteFax()

    /**
     * Set the value of [contact_prenom] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setContactPrenom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_prenom !== $v) {
            $this->contact_prenom = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::CONTACT_PRENOM;
        }


        return $this;
    } // setContactPrenom()

    /**
     * Set the value of [contact_nom] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setContactNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_nom !== $v) {
            $this->contact_nom = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::CONTACT_NOM;
        }


        return $this;
    } // setContactNom()

    /**
     * Set the value of [contact_telephone] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setContactTelephone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_telephone !== $v) {
            $this->contact_telephone = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::CONTACT_TELEPHONE;
        }


        return $this;
    } // setContactTelephone()

    /**
     * Set the value of [contact_mail] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setContactMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_mail !== $v) {
            $this->contact_mail = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::CONTACT_MAIL;
        }


        return $this;
    } // setContactMail()

    /**
     * Set the value of [permanence] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setPermanence($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->permanence !== $v) {
            $this->permanence = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::PERMANENCE;
        }


        return $this;
    } // setPermanence()

    /**
     * Set the value of [permanence_matin_de] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setPermanenceMatinDe($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->permanence_matin_de !== $v) {
            $this->permanence_matin_de = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::PERMANENCE_MATIN_DE;
        }


        return $this;
    } // setPermanenceMatinDe()

    /**
     * Set the value of [permanence_matin_a] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setPermanenceMatinA($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->permanence_matin_a !== $v) {
            $this->permanence_matin_a = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::PERMANENCE_MATIN_A;
        }


        return $this;
    } // setPermanenceMatinA()

    /**
     * Set the value of [permanence_apres_midi_de] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setPermanenceApresMidiDe($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->permanence_apres_midi_de !== $v) {
            $this->permanence_apres_midi_de = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE;
        }


        return $this;
    } // setPermanenceApresMidiDe()

    /**
     * Set the value of [permanence_apres_midi_a] column.
     *
     * @param string $v new value
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setPermanenceApresMidiA($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->permanence_apres_midi_a !== $v) {
            $this->permanence_apres_midi_a = $v;
            $this->modifiedColumns[] = DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A;
        }


        return $this;
    } // setPermanenceApresMidiA()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = DemandeIdentifiantPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return DemandeIdentifiant The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = DemandeIdentifiantPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

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
            $this->societe_nom = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->societe_adresse_1 = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->societe_adresse_2 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->societe_adresse_3 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->societe_adresse_4 = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->societe_telephone = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->societe_fax = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->contact_prenom = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->contact_nom = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->contact_telephone = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->contact_mail = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->permanence = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->permanence_matin_de = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->permanence_matin_a = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->permanence_apres_midi_de = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->permanence_apres_midi_a = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->created_at = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->updated_at = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = DemandeIdentifiantPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating DemandeIdentifiant object", $e);
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
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DemandeIdentifiantPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

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
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DemandeIdentifiantQuery::create()
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
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(DemandeIdentifiantPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DemandeIdentifiantPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DemandeIdentifiantPeer::UPDATED_AT)) {
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
                DemandeIdentifiantPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = DemandeIdentifiantPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DemandeIdentifiantPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DemandeIdentifiantPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_NOM)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_NOM`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_1)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_ADRESSE_1`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_2)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_ADRESSE_2`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_3)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_ADRESSE_3`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_4)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_ADRESSE_4`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_TELEPHONE)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_TELEPHONE`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_FAX)) {
            $modifiedColumns[':p' . $index++]  = '`SOCIETE_FAX`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_PRENOM)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACT_PRENOM`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_NOM)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACT_NOM`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_TELEPHONE)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACT_TELEPHONE`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACT_MAIL`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE)) {
            $modifiedColumns[':p' . $index++]  = '`PERMANENCE`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_MATIN_DE)) {
            $modifiedColumns[':p' . $index++]  = '`PERMANENCE_MATIN_DE`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_MATIN_A)) {
            $modifiedColumns[':p' . $index++]  = '`PERMANENCE_MATIN_A`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE)) {
            $modifiedColumns[':p' . $index++]  = '`PERMANENCE_APRES_MIDI_DE`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A)) {
            $modifiedColumns[':p' . $index++]  = '`PERMANENCE_APRES_MIDI_A`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(DemandeIdentifiantPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `demande_identifiant` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`SOCIETE_NOM`':
                        $stmt->bindValue($identifier, $this->societe_nom, PDO::PARAM_STR);
                        break;
                    case '`SOCIETE_ADRESSE_1`':
                        $stmt->bindValue($identifier, $this->societe_adresse_1, PDO::PARAM_STR);
                        break;
                    case '`SOCIETE_ADRESSE_2`':
                        $stmt->bindValue($identifier, $this->societe_adresse_2, PDO::PARAM_STR);
                        break;
                    case '`SOCIETE_ADRESSE_3`':
                        $stmt->bindValue($identifier, $this->societe_adresse_3, PDO::PARAM_STR);
                        break;
                    case '`SOCIETE_ADRESSE_4`':
                        $stmt->bindValue($identifier, $this->societe_adresse_4, PDO::PARAM_STR);
                        break;
                    case '`SOCIETE_TELEPHONE`':
                        $stmt->bindValue($identifier, $this->societe_telephone, PDO::PARAM_STR);
                        break;
                    case '`SOCIETE_FAX`':
                        $stmt->bindValue($identifier, $this->societe_fax, PDO::PARAM_STR);
                        break;
                    case '`CONTACT_PRENOM`':
                        $stmt->bindValue($identifier, $this->contact_prenom, PDO::PARAM_STR);
                        break;
                    case '`CONTACT_NOM`':
                        $stmt->bindValue($identifier, $this->contact_nom, PDO::PARAM_STR);
                        break;
                    case '`CONTACT_TELEPHONE`':
                        $stmt->bindValue($identifier, $this->contact_telephone, PDO::PARAM_STR);
                        break;
                    case '`CONTACT_MAIL`':
                        $stmt->bindValue($identifier, $this->contact_mail, PDO::PARAM_STR);
                        break;
                    case '`PERMANENCE`':
                        $stmt->bindValue($identifier, $this->permanence, PDO::PARAM_STR);
                        break;
                    case '`PERMANENCE_MATIN_DE`':
                        $stmt->bindValue($identifier, $this->permanence_matin_de, PDO::PARAM_STR);
                        break;
                    case '`PERMANENCE_MATIN_A`':
                        $stmt->bindValue($identifier, $this->permanence_matin_a, PDO::PARAM_STR);
                        break;
                    case '`PERMANENCE_APRES_MIDI_DE`':
                        $stmt->bindValue($identifier, $this->permanence_apres_midi_de, PDO::PARAM_STR);
                        break;
                    case '`PERMANENCE_APRES_MIDI_A`':
                        $stmt->bindValue($identifier, $this->permanence_apres_midi_a, PDO::PARAM_STR);
                        break;
                    case '`CREATED_AT`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
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
        } else {
            $this->validationFailures = $res;

            return false;
        }
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


            if (($retval = DemandeIdentifiantPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = DemandeIdentifiantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getSocieteNom();
                break;
            case 2:
                return $this->getSocieteAdresse1();
                break;
            case 3:
                return $this->getSocieteAdresse2();
                break;
            case 4:
                return $this->getSocieteAdresse3();
                break;
            case 5:
                return $this->getSocieteAdresse4();
                break;
            case 6:
                return $this->getSocieteTelephone();
                break;
            case 7:
                return $this->getSocieteFax();
                break;
            case 8:
                return $this->getContactPrenom();
                break;
            case 9:
                return $this->getContactNom();
                break;
            case 10:
                return $this->getContactTelephone();
                break;
            case 11:
                return $this->getContactMail();
                break;
            case 12:
                return $this->getPermanence();
                break;
            case 13:
                return $this->getPermanenceMatinDe();
                break;
            case 14:
                return $this->getPermanenceMatinA();
                break;
            case 15:
                return $this->getPermanenceApresMidiDe();
                break;
            case 16:
                return $this->getPermanenceApresMidiA();
                break;
            case 17:
                return $this->getCreatedAt();
                break;
            case 18:
                return $this->getUpdatedAt();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['DemandeIdentifiant'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['DemandeIdentifiant'][$this->getPrimaryKey()] = true;
        $keys = DemandeIdentifiantPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getSocieteNom(),
            $keys[2] => $this->getSocieteAdresse1(),
            $keys[3] => $this->getSocieteAdresse2(),
            $keys[4] => $this->getSocieteAdresse3(),
            $keys[5] => $this->getSocieteAdresse4(),
            $keys[6] => $this->getSocieteTelephone(),
            $keys[7] => $this->getSocieteFax(),
            $keys[8] => $this->getContactPrenom(),
            $keys[9] => $this->getContactNom(),
            $keys[10] => $this->getContactTelephone(),
            $keys[11] => $this->getContactMail(),
            $keys[12] => $this->getPermanence(),
            $keys[13] => $this->getPermanenceMatinDe(),
            $keys[14] => $this->getPermanenceMatinA(),
            $keys[15] => $this->getPermanenceApresMidiDe(),
            $keys[16] => $this->getPermanenceApresMidiA(),
            $keys[17] => $this->getCreatedAt(),
            $keys[18] => $this->getUpdatedAt(),
        );

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
        $pos = DemandeIdentifiantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setSocieteNom($value);
                break;
            case 2:
                $this->setSocieteAdresse1($value);
                break;
            case 3:
                $this->setSocieteAdresse2($value);
                break;
            case 4:
                $this->setSocieteAdresse3($value);
                break;
            case 5:
                $this->setSocieteAdresse4($value);
                break;
            case 6:
                $this->setSocieteTelephone($value);
                break;
            case 7:
                $this->setSocieteFax($value);
                break;
            case 8:
                $this->setContactPrenom($value);
                break;
            case 9:
                $this->setContactNom($value);
                break;
            case 10:
                $this->setContactTelephone($value);
                break;
            case 11:
                $this->setContactMail($value);
                break;
            case 12:
                $this->setPermanence($value);
                break;
            case 13:
                $this->setPermanenceMatinDe($value);
                break;
            case 14:
                $this->setPermanenceMatinA($value);
                break;
            case 15:
                $this->setPermanenceApresMidiDe($value);
                break;
            case 16:
                $this->setPermanenceApresMidiA($value);
                break;
            case 17:
                $this->setCreatedAt($value);
                break;
            case 18:
                $this->setUpdatedAt($value);
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
        $keys = DemandeIdentifiantPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setSocieteNom($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSocieteAdresse1($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSocieteAdresse2($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSocieteAdresse3($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setSocieteAdresse4($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setSocieteTelephone($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSocieteFax($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setContactPrenom($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setContactNom($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setContactTelephone($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setContactMail($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setPermanence($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setPermanenceMatinDe($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setPermanenceMatinA($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setPermanenceApresMidiDe($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setPermanenceApresMidiA($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setCreatedAt($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setUpdatedAt($arr[$keys[18]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DemandeIdentifiantPeer::DATABASE_NAME);

        if ($this->isColumnModified(DemandeIdentifiantPeer::ID)) $criteria->add(DemandeIdentifiantPeer::ID, $this->id);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_NOM)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_NOM, $this->societe_nom);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_1)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_ADRESSE_1, $this->societe_adresse_1);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_2)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_ADRESSE_2, $this->societe_adresse_2);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_3)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_ADRESSE_3, $this->societe_adresse_3);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_ADRESSE_4)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_ADRESSE_4, $this->societe_adresse_4);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_TELEPHONE)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_TELEPHONE, $this->societe_telephone);
        if ($this->isColumnModified(DemandeIdentifiantPeer::SOCIETE_FAX)) $criteria->add(DemandeIdentifiantPeer::SOCIETE_FAX, $this->societe_fax);
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_PRENOM)) $criteria->add(DemandeIdentifiantPeer::CONTACT_PRENOM, $this->contact_prenom);
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_NOM)) $criteria->add(DemandeIdentifiantPeer::CONTACT_NOM, $this->contact_nom);
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_TELEPHONE)) $criteria->add(DemandeIdentifiantPeer::CONTACT_TELEPHONE, $this->contact_telephone);
        if ($this->isColumnModified(DemandeIdentifiantPeer::CONTACT_MAIL)) $criteria->add(DemandeIdentifiantPeer::CONTACT_MAIL, $this->contact_mail);
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE)) $criteria->add(DemandeIdentifiantPeer::PERMANENCE, $this->permanence);
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_MATIN_DE)) $criteria->add(DemandeIdentifiantPeer::PERMANENCE_MATIN_DE, $this->permanence_matin_de);
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_MATIN_A)) $criteria->add(DemandeIdentifiantPeer::PERMANENCE_MATIN_A, $this->permanence_matin_a);
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE)) $criteria->add(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE, $this->permanence_apres_midi_de);
        if ($this->isColumnModified(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A)) $criteria->add(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A, $this->permanence_apres_midi_a);
        if ($this->isColumnModified(DemandeIdentifiantPeer::CREATED_AT)) $criteria->add(DemandeIdentifiantPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(DemandeIdentifiantPeer::UPDATED_AT)) $criteria->add(DemandeIdentifiantPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(DemandeIdentifiantPeer::DATABASE_NAME);
        $criteria->add(DemandeIdentifiantPeer::ID, $this->id);

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
     * @param object $copyObj An object of DemandeIdentifiant (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSocieteNom($this->getSocieteNom());
        $copyObj->setSocieteAdresse1($this->getSocieteAdresse1());
        $copyObj->setSocieteAdresse2($this->getSocieteAdresse2());
        $copyObj->setSocieteAdresse3($this->getSocieteAdresse3());
        $copyObj->setSocieteAdresse4($this->getSocieteAdresse4());
        $copyObj->setSocieteTelephone($this->getSocieteTelephone());
        $copyObj->setSocieteFax($this->getSocieteFax());
        $copyObj->setContactPrenom($this->getContactPrenom());
        $copyObj->setContactNom($this->getContactNom());
        $copyObj->setContactTelephone($this->getContactTelephone());
        $copyObj->setContactMail($this->getContactMail());
        $copyObj->setPermanence($this->getPermanence());
        $copyObj->setPermanenceMatinDe($this->getPermanenceMatinDe());
        $copyObj->setPermanenceMatinA($this->getPermanenceMatinA());
        $copyObj->setPermanenceApresMidiDe($this->getPermanenceApresMidiDe());
        $copyObj->setPermanenceApresMidiA($this->getPermanenceApresMidiA());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
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
     * @return DemandeIdentifiant Clone of current object.
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
     * @return DemandeIdentifiantPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DemandeIdentifiantPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->societe_nom = null;
        $this->societe_adresse_1 = null;
        $this->societe_adresse_2 = null;
        $this->societe_adresse_3 = null;
        $this->societe_adresse_4 = null;
        $this->societe_telephone = null;
        $this->societe_fax = null;
        $this->contact_prenom = null;
        $this->contact_nom = null;
        $this->contact_telephone = null;
        $this->contact_mail = null;
        $this->permanence = null;
        $this->permanence_matin_de = null;
        $this->permanence_matin_a = null;
        $this->permanence_apres_midi_de = null;
        $this->permanence_apres_midi_a = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
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
        } // if ($deep)

    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DemandeIdentifiantPeer::DEFAULT_STRING_FORMAT);
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
     * @return     DemandeIdentifiant The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = DemandeIdentifiantPeer::UPDATED_AT;

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

}
