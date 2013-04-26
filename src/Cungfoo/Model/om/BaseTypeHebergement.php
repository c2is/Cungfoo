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
use Cungfoo\Model\BonPlanQuery;
use Cungfoo\Model\BonPlanTypeHebergement;
use Cungfoo\Model\BonPlanTypeHebergementQuery;
use Cungfoo\Model\CategoryTypeHebergement;
use Cungfoo\Model\CategoryTypeHebergementQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\EtablissementTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementCapacite;
use Cungfoo\Model\TypeHebergementCapaciteQuery;
use Cungfoo\Model\TypeHebergementI18n;
use Cungfoo\Model\TypeHebergementI18nQuery;
use Cungfoo\Model\TypeHebergementPeer;
use Cungfoo\Model\TypeHebergementQuery;
use Cungfoo\Model\TypeHebergementTypeHebergementCapacite;
use Cungfoo\Model\TypeHebergementTypeHebergementCapaciteQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'type_hebergement' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\TypeHebergementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TypeHebergementPeer
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
     * @var        string
     */
    protected $code;

    /**
     * The value for the category_type_hebergement_id field.
     * @var        int
     */
    protected $category_type_hebergement_id;

    /**
     * The value for the nombre_chambre field.
     * @var        int
     */
    protected $nombre_chambre;

    /**
     * The value for the nombre_place field.
     * @var        int
     */
    protected $nombre_place;

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
     * @var        CategoryTypeHebergement
     */
    protected $aCategoryTypeHebergement;

    /**
     * @var        PropelObjectCollection|EtablissementTypeHebergement[] Collection to store aggregation of EtablissementTypeHebergement objects.
     */
    protected $collEtablissementTypeHebergements;
    protected $collEtablissementTypeHebergementsPartial;

    /**
     * @var        PropelObjectCollection|TypeHebergementTypeHebergementCapacite[] Collection to store aggregation of TypeHebergementTypeHebergementCapacite objects.
     */
    protected $collTypeHebergementTypeHebergementCapacites;
    protected $collTypeHebergementTypeHebergementCapacitesPartial;

    /**
     * @var        PropelObjectCollection|BonPlanTypeHebergement[] Collection to store aggregation of BonPlanTypeHebergement objects.
     */
    protected $collBonPlanTypeHebergements;
    protected $collBonPlanTypeHebergementsPartial;

    /**
     * @var        PropelObjectCollection|TypeHebergementI18n[] Collection to store aggregation of TypeHebergementI18n objects.
     */
    protected $collTypeHebergementI18ns;
    protected $collTypeHebergementI18nsPartial;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissements;

    /**
     * @var        PropelObjectCollection|TypeHebergementCapacite[] Collection to store aggregation of TypeHebergementCapacite objects.
     */
    protected $collTypeHebergementCapacites;

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
     * @var        array[TypeHebergementI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeHebergementCapacitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementTypeHebergementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeHebergementTypeHebergementCapacitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanTypeHebergementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeHebergementI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseTypeHebergement object.
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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the [category_type_hebergement_id] column value.
     *
     * @return int
     */
    public function getCategoryTypeHebergementId()
    {
        return $this->category_type_hebergement_id;
    }

    /**
     * Get the [nombre_chambre] column value.
     *
     * @return int
     */
    public function getNombreChambre()
    {
        return $this->nombre_chambre;
    }

    /**
     * Get the [nombre_place] column value.
     *
     * @return int
     */
    public function getNombrePlace()
    {
        return $this->nombre_place;
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
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = TypeHebergementPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = TypeHebergementPeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [category_type_hebergement_id] column.
     *
     * @param int $v new value
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setCategoryTypeHebergementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->category_type_hebergement_id !== $v) {
            $this->category_type_hebergement_id = $v;
            $this->modifiedColumns[] = TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID;
        }

        if ($this->aCategoryTypeHebergement !== null && $this->aCategoryTypeHebergement->getId() !== $v) {
            $this->aCategoryTypeHebergement = null;
        }


        return $this;
    } // setCategoryTypeHebergementId()

    /**
     * Set the value of [nombre_chambre] column.
     *
     * @param int $v new value
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setNombreChambre($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nombre_chambre !== $v) {
            $this->nombre_chambre = $v;
            $this->modifiedColumns[] = TypeHebergementPeer::NOMBRE_CHAMBRE;
        }


        return $this;
    } // setNombreChambre()

    /**
     * Set the value of [nombre_place] column.
     *
     * @param int $v new value
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setNombrePlace($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nombre_place !== $v) {
            $this->nombre_place = $v;
            $this->modifiedColumns[] = TypeHebergementPeer::NOMBRE_PLACE;
        }


        return $this;
    } // setNombrePlace()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = TypeHebergementPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = TypeHebergementPeer::UPDATED_AT;
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
     * @return TypeHebergement The current object (for fluent API support)
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
            $this->modifiedColumns[] = TypeHebergementPeer::ACTIVE;
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
            $this->code = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->category_type_hebergement_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->nombre_chambre = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->nombre_place = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 8; // 8 = TypeHebergementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TypeHebergement object", $e);
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

        if ($this->aCategoryTypeHebergement !== null && $this->category_type_hebergement_id !== $this->aCategoryTypeHebergement->getId()) {
            $this->aCategoryTypeHebergement = null;
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
            $con = Propel::getConnection(TypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TypeHebergementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategoryTypeHebergement = null;
            $this->collEtablissementTypeHebergements = null;

            $this->collTypeHebergementTypeHebergementCapacites = null;

            $this->collBonPlanTypeHebergements = null;

            $this->collTypeHebergementI18ns = null;

            $this->collEtablissements = null;
            $this->collTypeHebergementCapacites = null;
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
            $con = Propel::getConnection(TypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TypeHebergementQuery::create()
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
            $con = Propel::getConnection(TypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(TypeHebergementPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(TypeHebergementPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(TypeHebergementPeer::UPDATED_AT)) {
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
                TypeHebergementPeer::addInstanceToPool($this);
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

            if ($this->aCategoryTypeHebergement !== null) {
                if ($this->aCategoryTypeHebergement->isModified() || $this->aCategoryTypeHebergement->isNew()) {
                    $affectedRows += $this->aCategoryTypeHebergement->save($con);
                }
                $this->setCategoryTypeHebergement($this->aCategoryTypeHebergement);
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

            if ($this->etablissementsScheduledForDeletion !== null) {
                if (!$this->etablissementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->etablissementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    EtablissementTypeHebergementQuery::create()
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

            if ($this->typeHebergementCapacitesScheduledForDeletion !== null) {
                if (!$this->typeHebergementCapacitesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->typeHebergementCapacitesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    TypeHebergementTypeHebergementCapaciteQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->typeHebergementCapacitesScheduledForDeletion = null;
                }

                foreach ($this->getTypeHebergementCapacites() as $typeHebergementCapacite) {
                    if ($typeHebergementCapacite->isModified()) {
                        $typeHebergementCapacite->save($con);
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
                    BonPlanTypeHebergementQuery::create()
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

            if ($this->typeHebergementTypeHebergementCapacitesScheduledForDeletion !== null) {
                if (!$this->typeHebergementTypeHebergementCapacitesScheduledForDeletion->isEmpty()) {
                    TypeHebergementTypeHebergementCapaciteQuery::create()
                        ->filterByPrimaryKeys($this->typeHebergementTypeHebergementCapacitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->typeHebergementTypeHebergementCapacitesScheduledForDeletion = null;
                }
            }

            if ($this->collTypeHebergementTypeHebergementCapacites !== null) {
                foreach ($this->collTypeHebergementTypeHebergementCapacites as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bonPlanTypeHebergementsScheduledForDeletion !== null) {
                if (!$this->bonPlanTypeHebergementsScheduledForDeletion->isEmpty()) {
                    BonPlanTypeHebergementQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanTypeHebergementsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanTypeHebergementsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanTypeHebergements !== null) {
                foreach ($this->collBonPlanTypeHebergements as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->typeHebergementI18nsScheduledForDeletion !== null) {
                if (!$this->typeHebergementI18nsScheduledForDeletion->isEmpty()) {
                    TypeHebergementI18nQuery::create()
                        ->filterByPrimaryKeys($this->typeHebergementI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->typeHebergementI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collTypeHebergementI18ns !== null) {
                foreach ($this->collTypeHebergementI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = TypeHebergementPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TypeHebergementPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TypeHebergementPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`category_type_hebergement_id`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::NOMBRE_CHAMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_chambre`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::NOMBRE_PLACE)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_place`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(TypeHebergementPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `type_hebergement` (%s) VALUES (%s)',
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
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                    case '`category_type_hebergement_id`':
                        $stmt->bindValue($identifier, $this->category_type_hebergement_id, PDO::PARAM_INT);
                        break;
                    case '`nombre_chambre`':
                        $stmt->bindValue($identifier, $this->nombre_chambre, PDO::PARAM_INT);
                        break;
                    case '`nombre_place`':
                        $stmt->bindValue($identifier, $this->nombre_place, PDO::PARAM_INT);
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

            if ($this->aCategoryTypeHebergement !== null) {
                if (!$this->aCategoryTypeHebergement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategoryTypeHebergement->getValidationFailures());
                }
            }


            if (($retval = TypeHebergementPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collEtablissementTypeHebergements !== null) {
                    foreach ($this->collEtablissementTypeHebergements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTypeHebergementTypeHebergementCapacites !== null) {
                    foreach ($this->collTypeHebergementTypeHebergementCapacites as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBonPlanTypeHebergements !== null) {
                    foreach ($this->collBonPlanTypeHebergements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTypeHebergementI18ns !== null) {
                    foreach ($this->collTypeHebergementI18ns as $referrerFK) {
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
        $pos = TypeHebergementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCategoryTypeHebergementId();
                break;
            case 3:
                return $this->getNombreChambre();
                break;
            case 4:
                return $this->getNombrePlace();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getUpdatedAt();
                break;
            case 7:
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
        if (isset($alreadyDumpedObjects['TypeHebergement'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TypeHebergement'][$this->getPrimaryKey()] = true;
        $keys = TypeHebergementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getCategoryTypeHebergementId(),
            $keys[3] => $this->getNombreChambre(),
            $keys[4] => $this->getNombrePlace(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
            $keys[7] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCategoryTypeHebergement) {
                $result['CategoryTypeHebergement'] = $this->aCategoryTypeHebergement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEtablissementTypeHebergements) {
                $result['EtablissementTypeHebergements'] = $this->collEtablissementTypeHebergements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTypeHebergementTypeHebergementCapacites) {
                $result['TypeHebergementTypeHebergementCapacites'] = $this->collTypeHebergementTypeHebergementCapacites->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanTypeHebergements) {
                $result['BonPlanTypeHebergements'] = $this->collBonPlanTypeHebergements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTypeHebergementI18ns) {
                $result['TypeHebergementI18ns'] = $this->collTypeHebergementI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TypeHebergementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCategoryTypeHebergementId($value);
                break;
            case 3:
                $this->setNombreChambre($value);
                break;
            case 4:
                $this->setNombrePlace($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setUpdatedAt($value);
                break;
            case 7:
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
        $keys = TypeHebergementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCategoryTypeHebergementId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setNombreChambre($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setNombrePlace($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setActive($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TypeHebergementPeer::DATABASE_NAME);

        if ($this->isColumnModified(TypeHebergementPeer::ID)) $criteria->add(TypeHebergementPeer::ID, $this->id);
        if ($this->isColumnModified(TypeHebergementPeer::CODE)) $criteria->add(TypeHebergementPeer::CODE, $this->code);
        if ($this->isColumnModified(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID)) $criteria->add(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID, $this->category_type_hebergement_id);
        if ($this->isColumnModified(TypeHebergementPeer::NOMBRE_CHAMBRE)) $criteria->add(TypeHebergementPeer::NOMBRE_CHAMBRE, $this->nombre_chambre);
        if ($this->isColumnModified(TypeHebergementPeer::NOMBRE_PLACE)) $criteria->add(TypeHebergementPeer::NOMBRE_PLACE, $this->nombre_place);
        if ($this->isColumnModified(TypeHebergementPeer::CREATED_AT)) $criteria->add(TypeHebergementPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(TypeHebergementPeer::UPDATED_AT)) $criteria->add(TypeHebergementPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(TypeHebergementPeer::ACTIVE)) $criteria->add(TypeHebergementPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(TypeHebergementPeer::DATABASE_NAME);
        $criteria->add(TypeHebergementPeer::ID, $this->id);

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
     * @param object $copyObj An object of TypeHebergement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setCategoryTypeHebergementId($this->getCategoryTypeHebergementId());
        $copyObj->setNombreChambre($this->getNombreChambre());
        $copyObj->setNombrePlace($this->getNombrePlace());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getEtablissementTypeHebergements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementTypeHebergement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTypeHebergementTypeHebergementCapacites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTypeHebergementTypeHebergementCapacite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanTypeHebergements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanTypeHebergement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTypeHebergementI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTypeHebergementI18n($relObj->copy($deepCopy));
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
     * @return TypeHebergement Clone of current object.
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
     * @return TypeHebergementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TypeHebergementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a CategoryTypeHebergement object.
     *
     * @param             CategoryTypeHebergement $v
     * @return TypeHebergement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategoryTypeHebergement(CategoryTypeHebergement $v = null)
    {
        if ($v === null) {
            $this->setCategoryTypeHebergementId(NULL);
        } else {
            $this->setCategoryTypeHebergementId($v->getId());
        }

        $this->aCategoryTypeHebergement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the CategoryTypeHebergement object, it will not be re-added.
        if ($v !== null) {
            $v->addTypeHebergement($this);
        }


        return $this;
    }


    /**
     * Get the associated CategoryTypeHebergement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return CategoryTypeHebergement The associated CategoryTypeHebergement object.
     * @throws PropelException
     */
    public function getCategoryTypeHebergement(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCategoryTypeHebergement === null && ($this->category_type_hebergement_id !== null) && $doQuery) {
            $this->aCategoryTypeHebergement = CategoryTypeHebergementQuery::create()->findPk($this->category_type_hebergement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategoryTypeHebergement->addTypeHebergements($this);
             */
        }

        return $this->aCategoryTypeHebergement;
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
        if ('EtablissementTypeHebergement' == $relationName) {
            $this->initEtablissementTypeHebergements();
        }
        if ('TypeHebergementTypeHebergementCapacite' == $relationName) {
            $this->initTypeHebergementTypeHebergementCapacites();
        }
        if ('BonPlanTypeHebergement' == $relationName) {
            $this->initBonPlanTypeHebergements();
        }
        if ('TypeHebergementI18n' == $relationName) {
            $this->initTypeHebergementI18ns();
        }
    }

    /**
     * Clears out the collEtablissementTypeHebergements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
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
     * If this TypeHebergement is new, it will return
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
                    ->filterByTypeHebergement($this)
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
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setEtablissementTypeHebergements(PropelCollection $etablissementTypeHebergements, PropelPDO $con = null)
    {
        $this->etablissementTypeHebergementsScheduledForDeletion = $this->getEtablissementTypeHebergements(new Criteria(), $con)->diff($etablissementTypeHebergements);

        foreach ($this->etablissementTypeHebergementsScheduledForDeletion as $etablissementTypeHebergementRemoved) {
            $etablissementTypeHebergementRemoved->setTypeHebergement(null);
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
                ->filterByTypeHebergement($this)
                ->count($con);
        }

        return count($this->collEtablissementTypeHebergements);
    }

    /**
     * Method called to associate a EtablissementTypeHebergement object to this object
     * through the EtablissementTypeHebergement foreign key attribute.
     *
     * @param    EtablissementTypeHebergement $l EtablissementTypeHebergement
     * @return TypeHebergement The current object (for fluent API support)
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
        $etablissementTypeHebergement->setTypeHebergement($this);
    }

    /**
     * @param	EtablissementTypeHebergement $etablissementTypeHebergement The etablissementTypeHebergement object to remove.
     * @return TypeHebergement The current object (for fluent API support)
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
            $etablissementTypeHebergement->setTypeHebergement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TypeHebergement is new, it will return
     * an empty collection; or if this TypeHebergement has previously
     * been saved, it will retrieve related EtablissementTypeHebergements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TypeHebergement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementTypeHebergement[] List of EtablissementTypeHebergement objects
     */
    public function getEtablissementTypeHebergementsJoinEtablissement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementTypeHebergementQuery::create(null, $criteria);
        $query->joinWith('Etablissement', $join_behavior);

        return $this->getEtablissementTypeHebergements($query, $con);
    }

    /**
     * Clears out the collTypeHebergementTypeHebergementCapacites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
     * @see        addTypeHebergementTypeHebergementCapacites()
     */
    public function clearTypeHebergementTypeHebergementCapacites()
    {
        $this->collTypeHebergementTypeHebergementCapacites = null; // important to set this to null since that means it is uninitialized
        $this->collTypeHebergementTypeHebergementCapacitesPartial = null;

        return $this;
    }

    /**
     * reset is the collTypeHebergementTypeHebergementCapacites collection loaded partially
     *
     * @return void
     */
    public function resetPartialTypeHebergementTypeHebergementCapacites($v = true)
    {
        $this->collTypeHebergementTypeHebergementCapacitesPartial = $v;
    }

    /**
     * Initializes the collTypeHebergementTypeHebergementCapacites collection.
     *
     * By default this just sets the collTypeHebergementTypeHebergementCapacites collection to an empty array (like clearcollTypeHebergementTypeHebergementCapacites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTypeHebergementTypeHebergementCapacites($overrideExisting = true)
    {
        if (null !== $this->collTypeHebergementTypeHebergementCapacites && !$overrideExisting) {
            return;
        }
        $this->collTypeHebergementTypeHebergementCapacites = new PropelObjectCollection();
        $this->collTypeHebergementTypeHebergementCapacites->setModel('TypeHebergementTypeHebergementCapacite');
    }

    /**
     * Gets an array of TypeHebergementTypeHebergementCapacite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TypeHebergement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TypeHebergementTypeHebergementCapacite[] List of TypeHebergementTypeHebergementCapacite objects
     * @throws PropelException
     */
    public function getTypeHebergementTypeHebergementCapacites($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTypeHebergementTypeHebergementCapacitesPartial && !$this->isNew();
        if (null === $this->collTypeHebergementTypeHebergementCapacites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTypeHebergementTypeHebergementCapacites) {
                // return empty collection
                $this->initTypeHebergementTypeHebergementCapacites();
            } else {
                $collTypeHebergementTypeHebergementCapacites = TypeHebergementTypeHebergementCapaciteQuery::create(null, $criteria)
                    ->filterByTypeHebergement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTypeHebergementTypeHebergementCapacitesPartial && count($collTypeHebergementTypeHebergementCapacites)) {
                      $this->initTypeHebergementTypeHebergementCapacites(false);

                      foreach($collTypeHebergementTypeHebergementCapacites as $obj) {
                        if (false == $this->collTypeHebergementTypeHebergementCapacites->contains($obj)) {
                          $this->collTypeHebergementTypeHebergementCapacites->append($obj);
                        }
                      }

                      $this->collTypeHebergementTypeHebergementCapacitesPartial = true;
                    }

                    return $collTypeHebergementTypeHebergementCapacites;
                }

                if($partial && $this->collTypeHebergementTypeHebergementCapacites) {
                    foreach($this->collTypeHebergementTypeHebergementCapacites as $obj) {
                        if($obj->isNew()) {
                            $collTypeHebergementTypeHebergementCapacites[] = $obj;
                        }
                    }
                }

                $this->collTypeHebergementTypeHebergementCapacites = $collTypeHebergementTypeHebergementCapacites;
                $this->collTypeHebergementTypeHebergementCapacitesPartial = false;
            }
        }

        return $this->collTypeHebergementTypeHebergementCapacites;
    }

    /**
     * Sets a collection of TypeHebergementTypeHebergementCapacite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeHebergementTypeHebergementCapacites A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setTypeHebergementTypeHebergementCapacites(PropelCollection $typeHebergementTypeHebergementCapacites, PropelPDO $con = null)
    {
        $this->typeHebergementTypeHebergementCapacitesScheduledForDeletion = $this->getTypeHebergementTypeHebergementCapacites(new Criteria(), $con)->diff($typeHebergementTypeHebergementCapacites);

        foreach ($this->typeHebergementTypeHebergementCapacitesScheduledForDeletion as $typeHebergementTypeHebergementCapaciteRemoved) {
            $typeHebergementTypeHebergementCapaciteRemoved->setTypeHebergement(null);
        }

        $this->collTypeHebergementTypeHebergementCapacites = null;
        foreach ($typeHebergementTypeHebergementCapacites as $typeHebergementTypeHebergementCapacite) {
            $this->addTypeHebergementTypeHebergementCapacite($typeHebergementTypeHebergementCapacite);
        }

        $this->collTypeHebergementTypeHebergementCapacites = $typeHebergementTypeHebergementCapacites;
        $this->collTypeHebergementTypeHebergementCapacitesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TypeHebergementTypeHebergementCapacite objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TypeHebergementTypeHebergementCapacite objects.
     * @throws PropelException
     */
    public function countTypeHebergementTypeHebergementCapacites(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTypeHebergementTypeHebergementCapacitesPartial && !$this->isNew();
        if (null === $this->collTypeHebergementTypeHebergementCapacites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTypeHebergementTypeHebergementCapacites) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTypeHebergementTypeHebergementCapacites());
            }
            $query = TypeHebergementTypeHebergementCapaciteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTypeHebergement($this)
                ->count($con);
        }

        return count($this->collTypeHebergementTypeHebergementCapacites);
    }

    /**
     * Method called to associate a TypeHebergementTypeHebergementCapacite object to this object
     * through the TypeHebergementTypeHebergementCapacite foreign key attribute.
     *
     * @param    TypeHebergementTypeHebergementCapacite $l TypeHebergementTypeHebergementCapacite
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function addTypeHebergementTypeHebergementCapacite(TypeHebergementTypeHebergementCapacite $l)
    {
        if ($this->collTypeHebergementTypeHebergementCapacites === null) {
            $this->initTypeHebergementTypeHebergementCapacites();
            $this->collTypeHebergementTypeHebergementCapacitesPartial = true;
        }
        if (!in_array($l, $this->collTypeHebergementTypeHebergementCapacites->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTypeHebergementTypeHebergementCapacite($l);
        }

        return $this;
    }

    /**
     * @param	TypeHebergementTypeHebergementCapacite $typeHebergementTypeHebergementCapacite The typeHebergementTypeHebergementCapacite object to add.
     */
    protected function doAddTypeHebergementTypeHebergementCapacite($typeHebergementTypeHebergementCapacite)
    {
        $this->collTypeHebergementTypeHebergementCapacites[]= $typeHebergementTypeHebergementCapacite;
        $typeHebergementTypeHebergementCapacite->setTypeHebergement($this);
    }

    /**
     * @param	TypeHebergementTypeHebergementCapacite $typeHebergementTypeHebergementCapacite The typeHebergementTypeHebergementCapacite object to remove.
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function removeTypeHebergementTypeHebergementCapacite($typeHebergementTypeHebergementCapacite)
    {
        if ($this->getTypeHebergementTypeHebergementCapacites()->contains($typeHebergementTypeHebergementCapacite)) {
            $this->collTypeHebergementTypeHebergementCapacites->remove($this->collTypeHebergementTypeHebergementCapacites->search($typeHebergementTypeHebergementCapacite));
            if (null === $this->typeHebergementTypeHebergementCapacitesScheduledForDeletion) {
                $this->typeHebergementTypeHebergementCapacitesScheduledForDeletion = clone $this->collTypeHebergementTypeHebergementCapacites;
                $this->typeHebergementTypeHebergementCapacitesScheduledForDeletion->clear();
            }
            $this->typeHebergementTypeHebergementCapacitesScheduledForDeletion[]= $typeHebergementTypeHebergementCapacite;
            $typeHebergementTypeHebergementCapacite->setTypeHebergement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TypeHebergement is new, it will return
     * an empty collection; or if this TypeHebergement has previously
     * been saved, it will retrieve related TypeHebergementTypeHebergementCapacites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TypeHebergement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TypeHebergementTypeHebergementCapacite[] List of TypeHebergementTypeHebergementCapacite objects
     */
    public function getTypeHebergementTypeHebergementCapacitesJoinTypeHebergementCapacite($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TypeHebergementTypeHebergementCapaciteQuery::create(null, $criteria);
        $query->joinWith('TypeHebergementCapacite', $join_behavior);

        return $this->getTypeHebergementTypeHebergementCapacites($query, $con);
    }

    /**
     * Clears out the collBonPlanTypeHebergements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
     * @see        addBonPlanTypeHebergements()
     */
    public function clearBonPlanTypeHebergements()
    {
        $this->collBonPlanTypeHebergements = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanTypeHebergementsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanTypeHebergements collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanTypeHebergements($v = true)
    {
        $this->collBonPlanTypeHebergementsPartial = $v;
    }

    /**
     * Initializes the collBonPlanTypeHebergements collection.
     *
     * By default this just sets the collBonPlanTypeHebergements collection to an empty array (like clearcollBonPlanTypeHebergements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanTypeHebergements($overrideExisting = true)
    {
        if (null !== $this->collBonPlanTypeHebergements && !$overrideExisting) {
            return;
        }
        $this->collBonPlanTypeHebergements = new PropelObjectCollection();
        $this->collBonPlanTypeHebergements->setModel('BonPlanTypeHebergement');
    }

    /**
     * Gets an array of BonPlanTypeHebergement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TypeHebergement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanTypeHebergement[] List of BonPlanTypeHebergement objects
     * @throws PropelException
     */
    public function getBonPlanTypeHebergements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanTypeHebergementsPartial && !$this->isNew();
        if (null === $this->collBonPlanTypeHebergements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanTypeHebergements) {
                // return empty collection
                $this->initBonPlanTypeHebergements();
            } else {
                $collBonPlanTypeHebergements = BonPlanTypeHebergementQuery::create(null, $criteria)
                    ->filterByTypeHebergement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanTypeHebergementsPartial && count($collBonPlanTypeHebergements)) {
                      $this->initBonPlanTypeHebergements(false);

                      foreach($collBonPlanTypeHebergements as $obj) {
                        if (false == $this->collBonPlanTypeHebergements->contains($obj)) {
                          $this->collBonPlanTypeHebergements->append($obj);
                        }
                      }

                      $this->collBonPlanTypeHebergementsPartial = true;
                    }

                    return $collBonPlanTypeHebergements;
                }

                if($partial && $this->collBonPlanTypeHebergements) {
                    foreach($this->collBonPlanTypeHebergements as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanTypeHebergements[] = $obj;
                        }
                    }
                }

                $this->collBonPlanTypeHebergements = $collBonPlanTypeHebergements;
                $this->collBonPlanTypeHebergementsPartial = false;
            }
        }

        return $this->collBonPlanTypeHebergements;
    }

    /**
     * Sets a collection of BonPlanTypeHebergement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanTypeHebergements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setBonPlanTypeHebergements(PropelCollection $bonPlanTypeHebergements, PropelPDO $con = null)
    {
        $this->bonPlanTypeHebergementsScheduledForDeletion = $this->getBonPlanTypeHebergements(new Criteria(), $con)->diff($bonPlanTypeHebergements);

        foreach ($this->bonPlanTypeHebergementsScheduledForDeletion as $bonPlanTypeHebergementRemoved) {
            $bonPlanTypeHebergementRemoved->setTypeHebergement(null);
        }

        $this->collBonPlanTypeHebergements = null;
        foreach ($bonPlanTypeHebergements as $bonPlanTypeHebergement) {
            $this->addBonPlanTypeHebergement($bonPlanTypeHebergement);
        }

        $this->collBonPlanTypeHebergements = $bonPlanTypeHebergements;
        $this->collBonPlanTypeHebergementsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanTypeHebergement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanTypeHebergement objects.
     * @throws PropelException
     */
    public function countBonPlanTypeHebergements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanTypeHebergementsPartial && !$this->isNew();
        if (null === $this->collBonPlanTypeHebergements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanTypeHebergements) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanTypeHebergements());
            }
            $query = BonPlanTypeHebergementQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTypeHebergement($this)
                ->count($con);
        }

        return count($this->collBonPlanTypeHebergements);
    }

    /**
     * Method called to associate a BonPlanTypeHebergement object to this object
     * through the BonPlanTypeHebergement foreign key attribute.
     *
     * @param    BonPlanTypeHebergement $l BonPlanTypeHebergement
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function addBonPlanTypeHebergement(BonPlanTypeHebergement $l)
    {
        if ($this->collBonPlanTypeHebergements === null) {
            $this->initBonPlanTypeHebergements();
            $this->collBonPlanTypeHebergementsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanTypeHebergements->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanTypeHebergement($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanTypeHebergement $bonPlanTypeHebergement The bonPlanTypeHebergement object to add.
     */
    protected function doAddBonPlanTypeHebergement($bonPlanTypeHebergement)
    {
        $this->collBonPlanTypeHebergements[]= $bonPlanTypeHebergement;
        $bonPlanTypeHebergement->setTypeHebergement($this);
    }

    /**
     * @param	BonPlanTypeHebergement $bonPlanTypeHebergement The bonPlanTypeHebergement object to remove.
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function removeBonPlanTypeHebergement($bonPlanTypeHebergement)
    {
        if ($this->getBonPlanTypeHebergements()->contains($bonPlanTypeHebergement)) {
            $this->collBonPlanTypeHebergements->remove($this->collBonPlanTypeHebergements->search($bonPlanTypeHebergement));
            if (null === $this->bonPlanTypeHebergementsScheduledForDeletion) {
                $this->bonPlanTypeHebergementsScheduledForDeletion = clone $this->collBonPlanTypeHebergements;
                $this->bonPlanTypeHebergementsScheduledForDeletion->clear();
            }
            $this->bonPlanTypeHebergementsScheduledForDeletion[]= $bonPlanTypeHebergement;
            $bonPlanTypeHebergement->setTypeHebergement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TypeHebergement is new, it will return
     * an empty collection; or if this TypeHebergement has previously
     * been saved, it will retrieve related BonPlanTypeHebergements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TypeHebergement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanTypeHebergement[] List of BonPlanTypeHebergement objects
     */
    public function getBonPlanTypeHebergementsJoinBonPlan($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanTypeHebergementQuery::create(null, $criteria);
        $query->joinWith('BonPlan', $join_behavior);

        return $this->getBonPlanTypeHebergements($query, $con);
    }

    /**
     * Clears out the collTypeHebergementI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
     * @see        addTypeHebergementI18ns()
     */
    public function clearTypeHebergementI18ns()
    {
        $this->collTypeHebergementI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collTypeHebergementI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collTypeHebergementI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialTypeHebergementI18ns($v = true)
    {
        $this->collTypeHebergementI18nsPartial = $v;
    }

    /**
     * Initializes the collTypeHebergementI18ns collection.
     *
     * By default this just sets the collTypeHebergementI18ns collection to an empty array (like clearcollTypeHebergementI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTypeHebergementI18ns($overrideExisting = true)
    {
        if (null !== $this->collTypeHebergementI18ns && !$overrideExisting) {
            return;
        }
        $this->collTypeHebergementI18ns = new PropelObjectCollection();
        $this->collTypeHebergementI18ns->setModel('TypeHebergementI18n');
    }

    /**
     * Gets an array of TypeHebergementI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TypeHebergement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TypeHebergementI18n[] List of TypeHebergementI18n objects
     * @throws PropelException
     */
    public function getTypeHebergementI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTypeHebergementI18nsPartial && !$this->isNew();
        if (null === $this->collTypeHebergementI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTypeHebergementI18ns) {
                // return empty collection
                $this->initTypeHebergementI18ns();
            } else {
                $collTypeHebergementI18ns = TypeHebergementI18nQuery::create(null, $criteria)
                    ->filterByTypeHebergement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTypeHebergementI18nsPartial && count($collTypeHebergementI18ns)) {
                      $this->initTypeHebergementI18ns(false);

                      foreach($collTypeHebergementI18ns as $obj) {
                        if (false == $this->collTypeHebergementI18ns->contains($obj)) {
                          $this->collTypeHebergementI18ns->append($obj);
                        }
                      }

                      $this->collTypeHebergementI18nsPartial = true;
                    }

                    return $collTypeHebergementI18ns;
                }

                if($partial && $this->collTypeHebergementI18ns) {
                    foreach($this->collTypeHebergementI18ns as $obj) {
                        if($obj->isNew()) {
                            $collTypeHebergementI18ns[] = $obj;
                        }
                    }
                }

                $this->collTypeHebergementI18ns = $collTypeHebergementI18ns;
                $this->collTypeHebergementI18nsPartial = false;
            }
        }

        return $this->collTypeHebergementI18ns;
    }

    /**
     * Sets a collection of TypeHebergementI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeHebergementI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setTypeHebergementI18ns(PropelCollection $typeHebergementI18ns, PropelPDO $con = null)
    {
        $this->typeHebergementI18nsScheduledForDeletion = $this->getTypeHebergementI18ns(new Criteria(), $con)->diff($typeHebergementI18ns);

        foreach ($this->typeHebergementI18nsScheduledForDeletion as $typeHebergementI18nRemoved) {
            $typeHebergementI18nRemoved->setTypeHebergement(null);
        }

        $this->collTypeHebergementI18ns = null;
        foreach ($typeHebergementI18ns as $typeHebergementI18n) {
            $this->addTypeHebergementI18n($typeHebergementI18n);
        }

        $this->collTypeHebergementI18ns = $typeHebergementI18ns;
        $this->collTypeHebergementI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TypeHebergementI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TypeHebergementI18n objects.
     * @throws PropelException
     */
    public function countTypeHebergementI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTypeHebergementI18nsPartial && !$this->isNew();
        if (null === $this->collTypeHebergementI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTypeHebergementI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTypeHebergementI18ns());
            }
            $query = TypeHebergementI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTypeHebergement($this)
                ->count($con);
        }

        return count($this->collTypeHebergementI18ns);
    }

    /**
     * Method called to associate a TypeHebergementI18n object to this object
     * through the TypeHebergementI18n foreign key attribute.
     *
     * @param    TypeHebergementI18n $l TypeHebergementI18n
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function addTypeHebergementI18n(TypeHebergementI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collTypeHebergementI18ns === null) {
            $this->initTypeHebergementI18ns();
            $this->collTypeHebergementI18nsPartial = true;
        }
        if (!in_array($l, $this->collTypeHebergementI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTypeHebergementI18n($l);
        }

        return $this;
    }

    /**
     * @param	TypeHebergementI18n $typeHebergementI18n The typeHebergementI18n object to add.
     */
    protected function doAddTypeHebergementI18n($typeHebergementI18n)
    {
        $this->collTypeHebergementI18ns[]= $typeHebergementI18n;
        $typeHebergementI18n->setTypeHebergement($this);
    }

    /**
     * @param	TypeHebergementI18n $typeHebergementI18n The typeHebergementI18n object to remove.
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function removeTypeHebergementI18n($typeHebergementI18n)
    {
        if ($this->getTypeHebergementI18ns()->contains($typeHebergementI18n)) {
            $this->collTypeHebergementI18ns->remove($this->collTypeHebergementI18ns->search($typeHebergementI18n));
            if (null === $this->typeHebergementI18nsScheduledForDeletion) {
                $this->typeHebergementI18nsScheduledForDeletion = clone $this->collTypeHebergementI18ns;
                $this->typeHebergementI18nsScheduledForDeletion->clear();
            }
            $this->typeHebergementI18nsScheduledForDeletion[]= $typeHebergementI18n;
            $typeHebergementI18n->setTypeHebergement(null);
        }

        return $this;
    }

    /**
     * Clears out the collEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
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
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TypeHebergement is new, it will return
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
                    ->filterByTypeHebergement($this)
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
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return TypeHebergement The current object (for fluent API support)
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
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
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
                    ->filterByTypeHebergement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissements);
        }
    }

    /**
     * Associate a Etablissement object to this object
     * through the etablissement_type_hebergement cross reference table.
     *
     * @param  Etablissement $etablissement The EtablissementTypeHebergement object to relate
     * @return TypeHebergement The current object (for fluent API support)
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
        $etablissementTypeHebergement = new EtablissementTypeHebergement();
        $etablissementTypeHebergement->setEtablissement($etablissement);
        $this->addEtablissementTypeHebergement($etablissementTypeHebergement);
    }

    /**
     * Remove a Etablissement object to this object
     * through the etablissement_type_hebergement cross reference table.
     *
     * @param Etablissement $etablissement The EtablissementTypeHebergement object to relate
     * @return TypeHebergement The current object (for fluent API support)
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
     * Clears out the collTypeHebergementCapacites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
     * @see        addTypeHebergementCapacites()
     */
    public function clearTypeHebergementCapacites()
    {
        $this->collTypeHebergementCapacites = null; // important to set this to null since that means it is uninitialized
        $this->collTypeHebergementCapacitesPartial = null;

        return $this;
    }

    /**
     * Initializes the collTypeHebergementCapacites collection.
     *
     * By default this just sets the collTypeHebergementCapacites collection to an empty collection (like clearTypeHebergementCapacites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initTypeHebergementCapacites()
    {
        $this->collTypeHebergementCapacites = new PropelObjectCollection();
        $this->collTypeHebergementCapacites->setModel('TypeHebergementCapacite');
    }

    /**
     * Gets a collection of TypeHebergementCapacite objects related by a many-to-many relationship
     * to the current object by way of the type_hebergement_type_hebergement_capacite cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TypeHebergement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|TypeHebergementCapacite[] List of TypeHebergementCapacite objects
     */
    public function getTypeHebergementCapacites($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collTypeHebergementCapacites || null !== $criteria) {
            if ($this->isNew() && null === $this->collTypeHebergementCapacites) {
                // return empty collection
                $this->initTypeHebergementCapacites();
            } else {
                $collTypeHebergementCapacites = TypeHebergementCapaciteQuery::create(null, $criteria)
                    ->filterByTypeHebergement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collTypeHebergementCapacites;
                }
                $this->collTypeHebergementCapacites = $collTypeHebergementCapacites;
            }
        }

        return $this->collTypeHebergementCapacites;
    }

    /**
     * Sets a collection of TypeHebergementCapacite objects related by a many-to-many relationship
     * to the current object by way of the type_hebergement_type_hebergement_capacite cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeHebergementCapacites A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function setTypeHebergementCapacites(PropelCollection $typeHebergementCapacites, PropelPDO $con = null)
    {
        $this->clearTypeHebergementCapacites();
        $currentTypeHebergementCapacites = $this->getTypeHebergementCapacites();

        $this->typeHebergementCapacitesScheduledForDeletion = $currentTypeHebergementCapacites->diff($typeHebergementCapacites);

        foreach ($typeHebergementCapacites as $typeHebergementCapacite) {
            if (!$currentTypeHebergementCapacites->contains($typeHebergementCapacite)) {
                $this->doAddTypeHebergementCapacite($typeHebergementCapacite);
            }
        }

        $this->collTypeHebergementCapacites = $typeHebergementCapacites;

        return $this;
    }

    /**
     * Gets the number of TypeHebergementCapacite objects related by a many-to-many relationship
     * to the current object by way of the type_hebergement_type_hebergement_capacite cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related TypeHebergementCapacite objects
     */
    public function countTypeHebergementCapacites($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collTypeHebergementCapacites || null !== $criteria) {
            if ($this->isNew() && null === $this->collTypeHebergementCapacites) {
                return 0;
            } else {
                $query = TypeHebergementCapaciteQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTypeHebergement($this)
                    ->count($con);
            }
        } else {
            return count($this->collTypeHebergementCapacites);
        }
    }

    /**
     * Associate a TypeHebergementCapacite object to this object
     * through the type_hebergement_type_hebergement_capacite cross reference table.
     *
     * @param  TypeHebergementCapacite $typeHebergementCapacite The TypeHebergementTypeHebergementCapacite object to relate
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function addTypeHebergementCapacite(TypeHebergementCapacite $typeHebergementCapacite)
    {
        if ($this->collTypeHebergementCapacites === null) {
            $this->initTypeHebergementCapacites();
        }
        if (!$this->collTypeHebergementCapacites->contains($typeHebergementCapacite)) { // only add it if the **same** object is not already associated
            $this->doAddTypeHebergementCapacite($typeHebergementCapacite);

            $this->collTypeHebergementCapacites[]= $typeHebergementCapacite;
        }

        return $this;
    }

    /**
     * @param	TypeHebergementCapacite $typeHebergementCapacite The typeHebergementCapacite object to add.
     */
    protected function doAddTypeHebergementCapacite($typeHebergementCapacite)
    {
        $typeHebergementTypeHebergementCapacite = new TypeHebergementTypeHebergementCapacite();
        $typeHebergementTypeHebergementCapacite->setTypeHebergementCapacite($typeHebergementCapacite);
        $this->addTypeHebergementTypeHebergementCapacite($typeHebergementTypeHebergementCapacite);
    }

    /**
     * Remove a TypeHebergementCapacite object to this object
     * through the type_hebergement_type_hebergement_capacite cross reference table.
     *
     * @param TypeHebergementCapacite $typeHebergementCapacite The TypeHebergementTypeHebergementCapacite object to relate
     * @return TypeHebergement The current object (for fluent API support)
     */
    public function removeTypeHebergementCapacite(TypeHebergementCapacite $typeHebergementCapacite)
    {
        if ($this->getTypeHebergementCapacites()->contains($typeHebergementCapacite)) {
            $this->collTypeHebergementCapacites->remove($this->collTypeHebergementCapacites->search($typeHebergementCapacite));
            if (null === $this->typeHebergementCapacitesScheduledForDeletion) {
                $this->typeHebergementCapacitesScheduledForDeletion = clone $this->collTypeHebergementCapacites;
                $this->typeHebergementCapacitesScheduledForDeletion->clear();
            }
            $this->typeHebergementCapacitesScheduledForDeletion[]= $typeHebergementCapacite;
        }

        return $this;
    }

    /**
     * Clears out the collBonPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return TypeHebergement The current object (for fluent API support)
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
     * to the current object by way of the bon_plan_type_hebergement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TypeHebergement is new, it will return
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
                    ->filterByTypeHebergement($this)
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
     * to the current object by way of the bon_plan_type_hebergement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlans A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return TypeHebergement The current object (for fluent API support)
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
     * to the current object by way of the bon_plan_type_hebergement cross-reference table.
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
                    ->filterByTypeHebergement($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonPlans);
        }
    }

    /**
     * Associate a BonPlan object to this object
     * through the bon_plan_type_hebergement cross reference table.
     *
     * @param  BonPlan $bonPlan The BonPlanTypeHebergement object to relate
     * @return TypeHebergement The current object (for fluent API support)
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
        $bonPlanTypeHebergement = new BonPlanTypeHebergement();
        $bonPlanTypeHebergement->setBonPlan($bonPlan);
        $this->addBonPlanTypeHebergement($bonPlanTypeHebergement);
    }

    /**
     * Remove a BonPlan object to this object
     * through the bon_plan_type_hebergement cross reference table.
     *
     * @param BonPlan $bonPlan The BonPlanTypeHebergement object to relate
     * @return TypeHebergement The current object (for fluent API support)
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
        $this->category_type_hebergement_id = null;
        $this->nombre_chambre = null;
        $this->nombre_place = null;
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
            if ($this->collEtablissementTypeHebergements) {
                foreach ($this->collEtablissementTypeHebergements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeHebergementTypeHebergementCapacites) {
                foreach ($this->collTypeHebergementTypeHebergementCapacites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanTypeHebergements) {
                foreach ($this->collBonPlanTypeHebergements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeHebergementI18ns) {
                foreach ($this->collTypeHebergementI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissements) {
                foreach ($this->collEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeHebergementCapacites) {
                foreach ($this->collTypeHebergementCapacites as $o) {
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

        if ($this->collEtablissementTypeHebergements instanceof PropelCollection) {
            $this->collEtablissementTypeHebergements->clearIterator();
        }
        $this->collEtablissementTypeHebergements = null;
        if ($this->collTypeHebergementTypeHebergementCapacites instanceof PropelCollection) {
            $this->collTypeHebergementTypeHebergementCapacites->clearIterator();
        }
        $this->collTypeHebergementTypeHebergementCapacites = null;
        if ($this->collBonPlanTypeHebergements instanceof PropelCollection) {
            $this->collBonPlanTypeHebergements->clearIterator();
        }
        $this->collBonPlanTypeHebergements = null;
        if ($this->collTypeHebergementI18ns instanceof PropelCollection) {
            $this->collTypeHebergementI18ns->clearIterator();
        }
        $this->collTypeHebergementI18ns = null;
        if ($this->collEtablissements instanceof PropelCollection) {
            $this->collEtablissements->clearIterator();
        }
        $this->collEtablissements = null;
        if ($this->collTypeHebergementCapacites instanceof PropelCollection) {
            $this->collTypeHebergementCapacites->clearIterator();
        }
        $this->collTypeHebergementCapacites = null;
        if ($this->collBonPlans instanceof PropelCollection) {
            $this->collBonPlans->clearIterator();
        }
        $this->collBonPlans = null;
        $this->aCategoryTypeHebergement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TypeHebergementPeer::DEFAULT_STRING_FORMAT);
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
     * @return     TypeHebergement The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = TypeHebergementPeer::UPDATED_AT;

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
    
    public function getEtablissementsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\EtablissementPeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\EtablissementPeer::ID, \Cungfoo\Model\EtablissementI18nPeer::alias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\EtablissementI18nPeer::alias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\EtablissementI18nPeer::alias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getEtablissements($criteria, $con);
    }
    
    public function getTypeHebergementCapacitesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\TypeHebergementCapacitePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\TypeHebergementCapaciteI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\TypeHebergementCapacitePeer::ID, \Cungfoo\Model\TypeHebergementCapaciteI18nPeer::alias('i18n_locale', \Cungfoo\Model\TypeHebergementCapaciteI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\TypeHebergementCapaciteI18nPeer::alias('i18n_locale', \Cungfoo\Model\TypeHebergementCapaciteI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\TypeHebergementCapaciteI18nPeer::alias('i18n_locale', \Cungfoo\Model\TypeHebergementCapaciteI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getTypeHebergementCapacites($criteria, $con);
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
    
    public function getCapacitesActive($criteria = null, PropelPDO $con = null)
    {
    
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\CapacitePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\CapaciteI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\CapacitePeer::ID, \Cungfoo\Model\CapaciteI18nPeer::alias('i18n_locale', \Cungfoo\Model\CapaciteI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\CapaciteI18nPeer::alias('i18n_locale', \Cungfoo\Model\CapaciteI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\CapaciteI18nPeer::alias('i18n_locale', \Cungfoo\Model\CapaciteI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getCapacites($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    TypeHebergement The current object (for fluent API support)
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
     * @return TypeHebergementI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collTypeHebergementI18ns) {
                foreach ($this->collTypeHebergementI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new TypeHebergementI18n();
                $translation->setLocale($locale);
            } else {
                $translation = TypeHebergementI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addTypeHebergementI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    TypeHebergement The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            TypeHebergementI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collTypeHebergementI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collTypeHebergementI18ns[$key]);
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
     * @return TypeHebergementI18n */
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
         * @return TypeHebergementI18n The current object (for fluent API support)
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
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

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
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setIndice($v)
        {    $this->getCurrentTranslation()->setIndice($v);

        return $this;
    }


        /**
         * Get the [surface] column value.
         *
         * @return string
         */
        public function getSurface()
        {
        return $this->getCurrentTranslation()->getSurface();
    }


        /**
         * Set the value of [surface] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setSurface($v)
        {    $this->getCurrentTranslation()->setSurface($v);

        return $this;
    }


        /**
         * Get the [type_terrasse] column value.
         *
         * @return string
         */
        public function getTypeTerrasse()
        {
        return $this->getCurrentTranslation()->getTypeTerrasse();
    }


        /**
         * Set the value of [type_terrasse] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setTypeTerrasse($v)
        {    $this->getCurrentTranslation()->setTypeTerrasse($v);

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
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }


        /**
         * Get the [composition] column value.
         *
         * @return string
         */
        public function getComposition()
        {
        return $this->getCurrentTranslation()->getComposition();
    }


        /**
         * Set the value of [composition] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setComposition($v)
        {    $this->getCurrentTranslation()->setComposition($v);

        return $this;
    }


        /**
         * Get the [presentation] column value.
         *
         * @return string
         */
        public function getPresentation()
        {
        return $this->getCurrentTranslation()->getPresentation();
    }


        /**
         * Set the value of [presentation] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setPresentation($v)
        {    $this->getCurrentTranslation()->setPresentation($v);

        return $this;
    }


        /**
         * Get the [capacite_hebergement] column value.
         *
         * @return string
         */
        public function getCapaciteHebergement()
        {
        return $this->getCurrentTranslation()->getCapaciteHebergement();
    }


        /**
         * Set the value of [capacite_hebergement] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setCapaciteHebergement($v)
        {    $this->getCurrentTranslation()->setCapaciteHebergement($v);

        return $this;
    }


        /**
         * Get the [dimensions] column value.
         *
         * @return string
         */
        public function getDimensions()
        {
        return $this->getCurrentTranslation()->getDimensions();
    }


        /**
         * Set the value of [dimensions] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setDimensions($v)
        {    $this->getCurrentTranslation()->setDimensions($v);

        return $this;
    }


        /**
         * Get the [agencement] column value.
         *
         * @return string
         */
        public function getAgencement()
        {
        return $this->getCurrentTranslation()->getAgencement();
    }


        /**
         * Set the value of [agencement] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setAgencement($v)
        {    $this->getCurrentTranslation()->setAgencement($v);

        return $this;
    }


        /**
         * Get the [equipements] column value.
         *
         * @return string
         */
        public function getEquipements()
        {
        return $this->getCurrentTranslation()->getEquipements();
    }


        /**
         * Set the value of [equipements] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setEquipements($v)
        {    $this->getCurrentTranslation()->setEquipements($v);

        return $this;
    }


        /**
         * Get the [annee_utilisation] column value.
         *
         * @return string
         */
        public function getAnneeUtilisation()
        {
        return $this->getCurrentTranslation()->getAnneeUtilisation();
    }


        /**
         * Set the value of [annee_utilisation] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setAnneeUtilisation($v)
        {    $this->getCurrentTranslation()->setAnneeUtilisation($v);

        return $this;
    }


        /**
         * Get the [remarque_1] column value.
         *
         * @return string
         */
        public function getRemarque1()
        {
        return $this->getCurrentTranslation()->getRemarque1();
    }


        /**
         * Set the value of [remarque_1] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setRemarque1($v)
        {    $this->getCurrentTranslation()->setRemarque1($v);

        return $this;
    }


        /**
         * Get the [remarque_2] column value.
         *
         * @return string
         */
        public function getRemarque2()
        {
        return $this->getCurrentTranslation()->getRemarque2();
    }


        /**
         * Set the value of [remarque_2] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setRemarque2($v)
        {    $this->getCurrentTranslation()->setRemarque2($v);

        return $this;
    }


        /**
         * Get the [remarque_3] column value.
         *
         * @return string
         */
        public function getRemarque3()
        {
        return $this->getCurrentTranslation()->getRemarque3();
    }


        /**
         * Set the value of [remarque_3] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setRemarque3($v)
        {    $this->getCurrentTranslation()->setRemarque3($v);

        return $this;
    }


        /**
         * Get the [remarque_4] column value.
         *
         * @return string
         */
        public function getRemarque4()
        {
        return $this->getCurrentTranslation()->getRemarque4();
    }


        /**
         * Set the value of [remarque_4] column.
         *
         * @param string $v new value
         * @return TypeHebergementI18n The current object (for fluent API support)
         */
        public function setRemarque4($v)
        {    $this->getCurrentTranslation()->setRemarque4($v);

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
         * @return TypeHebergementI18n The current object (for fluent API support)
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
         * @return TypeHebergementI18n The current object (for fluent API support)
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
         * @return TypeHebergementI18n The current object (for fluent API support)
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
         * @return TypeHebergementI18n The current object (for fluent API support)
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
         * @return TypeHebergementI18n The current object (for fluent API support)
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
        return 'uploads/type_hebergements';
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
    public function getImageHebergementPath()
    {
        $peer = self::PEER;
    
        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('image_hebergement_path')
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
    public function setImageHebergementPath($v)
    {
        $peer = self::PEER;
    
        $values = explode(';', $v);
    
        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('image_hebergement_path')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;
    
        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('image_hebergement_path')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;
    
                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('image_hebergement_path')
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
    public function getImageCompositionPath()
    {
        $peer = self::PEER;
    
        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('image_composition_path')
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
    public function setImageCompositionPath($v)
    {
        $peer = self::PEER;
    
        $values = explode(';', $v);
    
        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('image_composition_path')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;
    
        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('image_composition_path')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;
    
                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('image_composition_path')
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
