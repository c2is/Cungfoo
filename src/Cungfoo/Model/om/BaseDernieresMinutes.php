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
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Cungfoo\Model\DernieresMinutes;
use Cungfoo\Model\DernieresMinutesDestination;
use Cungfoo\Model\DernieresMinutesDestinationQuery;
use Cungfoo\Model\DernieresMinutesEtablissement;
use Cungfoo\Model\DernieresMinutesEtablissementQuery;
use Cungfoo\Model\DernieresMinutesPeer;
use Cungfoo\Model\DernieresMinutesQuery;
use Cungfoo\Model\Destination;
use Cungfoo\Model\DestinationQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;

/**
 * Base class that represents a row from the 'dernieres_minutes' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDernieresMinutes extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\DernieresMinutesPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DernieresMinutesPeer
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
     * The value for the active field.
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the enabled field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $enabled;

    /**
     * @var        PropelObjectCollection|DernieresMinutesEtablissement[] Collection to store aggregation of DernieresMinutesEtablissement objects.
     */
    protected $collDernieresMinutesEtablissements;
    protected $collDernieresMinutesEtablissementsPartial;

    /**
     * @var        PropelObjectCollection|DernieresMinutesDestination[] Collection to store aggregation of DernieresMinutesDestination objects.
     */
    protected $collDernieresMinutesDestinations;
    protected $collDernieresMinutesDestinationsPartial;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissements;

    /**
     * @var        PropelObjectCollection|Destination[] Collection to store aggregation of Destination objects.
     */
    protected $collDestinations;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $destinationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $dernieresMinutesEtablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $dernieresMinutesDestinationsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->enabled = false;
    }

    /**
     * Initializes internal state of BaseDernieresMinutes object.
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
        } else {
            try {
                $dt = new DateTime($this->date_start);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_start, true), $x);
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
        $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_START);
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
        $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_RANGE);
        if (!isset($valueSet[$this->day_range])) {
            throw new PropelException('Unknown stored enum key: ' . $this->day_range);
        }

        return $valueSet[$this->day_range];
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
     * Get the [enabled] column value.
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return DernieresMinutes The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DernieresMinutesPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of [date_start] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return DernieresMinutes The current object (for fluent API support)
     */
    public function setDateStart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_start !== null || $dt !== null) {
            $currentDateAsString = ($this->date_start !== null && $tmpDt = new DateTime($this->date_start)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_start = $newDateAsString;
                $this->modifiedColumns[] = DernieresMinutesPeer::DATE_START;
            }
        } // if either are not null


        return $this;
    } // setDateStart()

    /**
     * Set the value of [day_start] column.
     *
     * @param int $v new value
     * @return DernieresMinutes The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setDayStart($v)
    {
        if ($v !== null) {
            $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_START);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->day_start !== $v) {
            $this->day_start = $v;
            $this->modifiedColumns[] = DernieresMinutesPeer::DAY_START;
        }


        return $this;
    } // setDayStart()

    /**
     * Set the value of [day_range] column.
     *
     * @param int $v new value
     * @return DernieresMinutes The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setDayRange($v)
    {
        if ($v !== null) {
            $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_RANGE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->day_range !== $v) {
            $this->day_range = $v;
            $this->modifiedColumns[] = DernieresMinutesPeer::DAY_RANGE;
        }


        return $this;
    } // setDayRange()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return DernieresMinutes The current object (for fluent API support)
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
            $this->modifiedColumns[] = DernieresMinutesPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Sets the value of the [enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return DernieresMinutes The current object (for fluent API support)
     */
    public function setEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->enabled !== $v) {
            $this->enabled = $v;
            $this->modifiedColumns[] = DernieresMinutesPeer::ENABLED;
        }


        return $this;
    } // setEnabled()

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
            if ($this->enabled !== false) {
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
            $this->date_start = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->day_start = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->day_range = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->active = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->enabled = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = DernieresMinutesPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating DernieresMinutes object", $e);
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
            $con = Propel::getConnection(DernieresMinutesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DernieresMinutesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDernieresMinutesEtablissements = null;

            $this->collDernieresMinutesDestinations = null;

            $this->collEtablissements = null;
            $this->collDestinations = null;
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
            $con = Propel::getConnection(DernieresMinutesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DernieresMinutesQuery::create()
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
            $con = Propel::getConnection(DernieresMinutesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                DernieresMinutesPeer::addInstanceToPool($this);
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

            if ($this->etablissementsScheduledForDeletion !== null) {
                if (!$this->etablissementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->etablissementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    DernieresMinutesEtablissementQuery::create()
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

            if ($this->destinationsScheduledForDeletion !== null) {
                if (!$this->destinationsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->destinationsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    DernieresMinutesDestinationQuery::create()
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

            if ($this->dernieresMinutesEtablissementsScheduledForDeletion !== null) {
                if (!$this->dernieresMinutesEtablissementsScheduledForDeletion->isEmpty()) {
                    DernieresMinutesEtablissementQuery::create()
                        ->filterByPrimaryKeys($this->dernieresMinutesEtablissementsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dernieresMinutesEtablissementsScheduledForDeletion = null;
                }
            }

            if ($this->collDernieresMinutesEtablissements !== null) {
                foreach ($this->collDernieresMinutesEtablissements as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dernieresMinutesDestinationsScheduledForDeletion !== null) {
                if (!$this->dernieresMinutesDestinationsScheduledForDeletion->isEmpty()) {
                    DernieresMinutesDestinationQuery::create()
                        ->filterByPrimaryKeys($this->dernieresMinutesDestinationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dernieresMinutesDestinationsScheduledForDeletion = null;
                }
            }

            if ($this->collDernieresMinutesDestinations !== null) {
                foreach ($this->collDernieresMinutesDestinations as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
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

        $this->modifiedColumns[] = DernieresMinutesPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DernieresMinutesPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DernieresMinutesPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(DernieresMinutesPeer::DATE_START)) {
            $modifiedColumns[':p' . $index++]  = '`DATE_START`';
        }
        if ($this->isColumnModified(DernieresMinutesPeer::DAY_START)) {
            $modifiedColumns[':p' . $index++]  = '`DAY_START`';
        }
        if ($this->isColumnModified(DernieresMinutesPeer::DAY_RANGE)) {
            $modifiedColumns[':p' . $index++]  = '`DAY_RANGE`';
        }
        if ($this->isColumnModified(DernieresMinutesPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }
        if ($this->isColumnModified(DernieresMinutesPeer::ENABLED)) {
            $modifiedColumns[':p' . $index++]  = '`ENABLED`';
        }

        $sql = sprintf(
            'INSERT INTO `dernieres_minutes` (%s) VALUES (%s)',
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
                    case '`DATE_START`':
                        $stmt->bindValue($identifier, $this->date_start, PDO::PARAM_STR);
                        break;
                    case '`DAY_START`':
                        $stmt->bindValue($identifier, $this->day_start, PDO::PARAM_INT);
                        break;
                    case '`DAY_RANGE`':
                        $stmt->bindValue($identifier, $this->day_range, PDO::PARAM_INT);
                        break;
                    case '`ACTIVE`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case '`ENABLED`':
                        $stmt->bindValue($identifier, (int) $this->enabled, PDO::PARAM_INT);
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


            if (($retval = DernieresMinutesPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collDernieresMinutesEtablissements !== null) {
                    foreach ($this->collDernieresMinutesEtablissements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collDernieresMinutesDestinations !== null) {
                    foreach ($this->collDernieresMinutesDestinations as $referrerFK) {
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
        $pos = DernieresMinutesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDateStart();
                break;
            case 2:
                return $this->getDayStart();
                break;
            case 3:
                return $this->getDayRange();
                break;
            case 4:
                return $this->getActive();
                break;
            case 5:
                return $this->getEnabled();
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
        if (isset($alreadyDumpedObjects['DernieresMinutes'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['DernieresMinutes'][$this->getPrimaryKey()] = true;
        $keys = DernieresMinutesPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDateStart(),
            $keys[2] => $this->getDayStart(),
            $keys[3] => $this->getDayRange(),
            $keys[4] => $this->getActive(),
            $keys[5] => $this->getEnabled(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collDernieresMinutesEtablissements) {
                $result['DernieresMinutesEtablissements'] = $this->collDernieresMinutesEtablissements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDernieresMinutesDestinations) {
                $result['DernieresMinutesDestinations'] = $this->collDernieresMinutesDestinations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DernieresMinutesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDateStart($value);
                break;
            case 2:
                $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_START);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setDayStart($value);
                break;
            case 3:
                $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_RANGE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setDayRange($value);
                break;
            case 4:
                $this->setActive($value);
                break;
            case 5:
                $this->setEnabled($value);
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
        $keys = DernieresMinutesPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDateStart($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDayStart($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDayRange($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setActive($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setEnabled($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DernieresMinutesPeer::DATABASE_NAME);

        if ($this->isColumnModified(DernieresMinutesPeer::ID)) $criteria->add(DernieresMinutesPeer::ID, $this->id);
        if ($this->isColumnModified(DernieresMinutesPeer::DATE_START)) $criteria->add(DernieresMinutesPeer::DATE_START, $this->date_start);
        if ($this->isColumnModified(DernieresMinutesPeer::DAY_START)) $criteria->add(DernieresMinutesPeer::DAY_START, $this->day_start);
        if ($this->isColumnModified(DernieresMinutesPeer::DAY_RANGE)) $criteria->add(DernieresMinutesPeer::DAY_RANGE, $this->day_range);
        if ($this->isColumnModified(DernieresMinutesPeer::ACTIVE)) $criteria->add(DernieresMinutesPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(DernieresMinutesPeer::ENABLED)) $criteria->add(DernieresMinutesPeer::ENABLED, $this->enabled);

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
        $criteria = new Criteria(DernieresMinutesPeer::DATABASE_NAME);
        $criteria->add(DernieresMinutesPeer::ID, $this->id);

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
     * @param object $copyObj An object of DernieresMinutes (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDateStart($this->getDateStart());
        $copyObj->setDayStart($this->getDayStart());
        $copyObj->setDayRange($this->getDayRange());
        $copyObj->setActive($this->getActive());
        $copyObj->setEnabled($this->getEnabled());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getDernieresMinutesEtablissements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDernieresMinutesEtablissement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDernieresMinutesDestinations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDernieresMinutesDestination($relObj->copy($deepCopy));
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
     * @return DernieresMinutes Clone of current object.
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
     * @return DernieresMinutesPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DernieresMinutesPeer();
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
        if ('DernieresMinutesEtablissement' == $relationName) {
            $this->initDernieresMinutesEtablissements();
        }
        if ('DernieresMinutesDestination' == $relationName) {
            $this->initDernieresMinutesDestinations();
        }
    }

    /**
     * Clears out the collDernieresMinutesEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDernieresMinutesEtablissements()
     */
    public function clearDernieresMinutesEtablissements()
    {
        $this->collDernieresMinutesEtablissements = null; // important to set this to null since that means it is uninitialized
        $this->collDernieresMinutesEtablissementsPartial = null;
    }

    /**
     * reset is the collDernieresMinutesEtablissements collection loaded partially
     *
     * @return void
     */
    public function resetPartialDernieresMinutesEtablissements($v = true)
    {
        $this->collDernieresMinutesEtablissementsPartial = $v;
    }

    /**
     * Initializes the collDernieresMinutesEtablissements collection.
     *
     * By default this just sets the collDernieresMinutesEtablissements collection to an empty array (like clearcollDernieresMinutesEtablissements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDernieresMinutesEtablissements($overrideExisting = true)
    {
        if (null !== $this->collDernieresMinutesEtablissements && !$overrideExisting) {
            return;
        }
        $this->collDernieresMinutesEtablissements = new PropelObjectCollection();
        $this->collDernieresMinutesEtablissements->setModel('DernieresMinutesEtablissement');
    }

    /**
     * Gets an array of DernieresMinutesEtablissement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this DernieresMinutes is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DernieresMinutesEtablissement[] List of DernieresMinutesEtablissement objects
     * @throws PropelException
     */
    public function getDernieresMinutesEtablissements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDernieresMinutesEtablissementsPartial && !$this->isNew();
        if (null === $this->collDernieresMinutesEtablissements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDernieresMinutesEtablissements) {
                // return empty collection
                $this->initDernieresMinutesEtablissements();
            } else {
                $collDernieresMinutesEtablissements = DernieresMinutesEtablissementQuery::create(null, $criteria)
                    ->filterByDernieresMinutes($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDernieresMinutesEtablissementsPartial && count($collDernieresMinutesEtablissements)) {
                      $this->initDernieresMinutesEtablissements(false);

                      foreach($collDernieresMinutesEtablissements as $obj) {
                        if (false == $this->collDernieresMinutesEtablissements->contains($obj)) {
                          $this->collDernieresMinutesEtablissements->append($obj);
                        }
                      }

                      $this->collDernieresMinutesEtablissementsPartial = true;
                    }

                    return $collDernieresMinutesEtablissements;
                }

                if($partial && $this->collDernieresMinutesEtablissements) {
                    foreach($this->collDernieresMinutesEtablissements as $obj) {
                        if($obj->isNew()) {
                            $collDernieresMinutesEtablissements[] = $obj;
                        }
                    }
                }

                $this->collDernieresMinutesEtablissements = $collDernieresMinutesEtablissements;
                $this->collDernieresMinutesEtablissementsPartial = false;
            }
        }

        return $this->collDernieresMinutesEtablissements;
    }

    /**
     * Sets a collection of DernieresMinutesEtablissement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $dernieresMinutesEtablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setDernieresMinutesEtablissements(PropelCollection $dernieresMinutesEtablissements, PropelPDO $con = null)
    {
        $this->dernieresMinutesEtablissementsScheduledForDeletion = $this->getDernieresMinutesEtablissements(new Criteria(), $con)->diff($dernieresMinutesEtablissements);

        foreach ($this->dernieresMinutesEtablissementsScheduledForDeletion as $dernieresMinutesEtablissementRemoved) {
            $dernieresMinutesEtablissementRemoved->setDernieresMinutes(null);
        }

        $this->collDernieresMinutesEtablissements = null;
        foreach ($dernieresMinutesEtablissements as $dernieresMinutesEtablissement) {
            $this->addDernieresMinutesEtablissement($dernieresMinutesEtablissement);
        }

        $this->collDernieresMinutesEtablissements = $dernieresMinutesEtablissements;
        $this->collDernieresMinutesEtablissementsPartial = false;
    }

    /**
     * Returns the number of related DernieresMinutesEtablissement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DernieresMinutesEtablissement objects.
     * @throws PropelException
     */
    public function countDernieresMinutesEtablissements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDernieresMinutesEtablissementsPartial && !$this->isNew();
        if (null === $this->collDernieresMinutesEtablissements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDernieresMinutesEtablissements) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getDernieresMinutesEtablissements());
                }
                $query = DernieresMinutesEtablissementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByDernieresMinutes($this)
                    ->count($con);
            }
        } else {
            return count($this->collDernieresMinutesEtablissements);
        }
    }

    /**
     * Method called to associate a DernieresMinutesEtablissement object to this object
     * through the DernieresMinutesEtablissement foreign key attribute.
     *
     * @param    DernieresMinutesEtablissement $l DernieresMinutesEtablissement
     * @return DernieresMinutes The current object (for fluent API support)
     */
    public function addDernieresMinutesEtablissement(DernieresMinutesEtablissement $l)
    {
        if ($this->collDernieresMinutesEtablissements === null) {
            $this->initDernieresMinutesEtablissements();
            $this->collDernieresMinutesEtablissementsPartial = true;
        }
        if (!in_array($l, $this->collDernieresMinutesEtablissements->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDernieresMinutesEtablissement($l);
        }

        return $this;
    }

    /**
     * @param	DernieresMinutesEtablissement $dernieresMinutesEtablissement The dernieresMinutesEtablissement object to add.
     */
    protected function doAddDernieresMinutesEtablissement($dernieresMinutesEtablissement)
    {
        $this->collDernieresMinutesEtablissements[]= $dernieresMinutesEtablissement;
        $dernieresMinutesEtablissement->setDernieresMinutes($this);
    }

    /**
     * @param	DernieresMinutesEtablissement $dernieresMinutesEtablissement The dernieresMinutesEtablissement object to remove.
     */
    public function removeDernieresMinutesEtablissement($dernieresMinutesEtablissement)
    {
        if ($this->getDernieresMinutesEtablissements()->contains($dernieresMinutesEtablissement)) {
            $this->collDernieresMinutesEtablissements->remove($this->collDernieresMinutesEtablissements->search($dernieresMinutesEtablissement));
            if (null === $this->dernieresMinutesEtablissementsScheduledForDeletion) {
                $this->dernieresMinutesEtablissementsScheduledForDeletion = clone $this->collDernieresMinutesEtablissements;
                $this->dernieresMinutesEtablissementsScheduledForDeletion->clear();
            }
            $this->dernieresMinutesEtablissementsScheduledForDeletion[]= $dernieresMinutesEtablissement;
            $dernieresMinutesEtablissement->setDernieresMinutes(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DernieresMinutes is new, it will return
     * an empty collection; or if this DernieresMinutes has previously
     * been saved, it will retrieve related DernieresMinutesEtablissements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DernieresMinutes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|DernieresMinutesEtablissement[] List of DernieresMinutesEtablissement objects
     */
    public function getDernieresMinutesEtablissementsJoinEtablissement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DernieresMinutesEtablissementQuery::create(null, $criteria);
        $query->joinWith('Etablissement', $join_behavior);

        return $this->getDernieresMinutesEtablissements($query, $con);
    }

    /**
     * Clears out the collDernieresMinutesDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDernieresMinutesDestinations()
     */
    public function clearDernieresMinutesDestinations()
    {
        $this->collDernieresMinutesDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collDernieresMinutesDestinationsPartial = null;
    }

    /**
     * reset is the collDernieresMinutesDestinations collection loaded partially
     *
     * @return void
     */
    public function resetPartialDernieresMinutesDestinations($v = true)
    {
        $this->collDernieresMinutesDestinationsPartial = $v;
    }

    /**
     * Initializes the collDernieresMinutesDestinations collection.
     *
     * By default this just sets the collDernieresMinutesDestinations collection to an empty array (like clearcollDernieresMinutesDestinations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDernieresMinutesDestinations($overrideExisting = true)
    {
        if (null !== $this->collDernieresMinutesDestinations && !$overrideExisting) {
            return;
        }
        $this->collDernieresMinutesDestinations = new PropelObjectCollection();
        $this->collDernieresMinutesDestinations->setModel('DernieresMinutesDestination');
    }

    /**
     * Gets an array of DernieresMinutesDestination objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this DernieresMinutes is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DernieresMinutesDestination[] List of DernieresMinutesDestination objects
     * @throws PropelException
     */
    public function getDernieresMinutesDestinations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDernieresMinutesDestinationsPartial && !$this->isNew();
        if (null === $this->collDernieresMinutesDestinations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDernieresMinutesDestinations) {
                // return empty collection
                $this->initDernieresMinutesDestinations();
            } else {
                $collDernieresMinutesDestinations = DernieresMinutesDestinationQuery::create(null, $criteria)
                    ->filterByDernieresMinutes($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDernieresMinutesDestinationsPartial && count($collDernieresMinutesDestinations)) {
                      $this->initDernieresMinutesDestinations(false);

                      foreach($collDernieresMinutesDestinations as $obj) {
                        if (false == $this->collDernieresMinutesDestinations->contains($obj)) {
                          $this->collDernieresMinutesDestinations->append($obj);
                        }
                      }

                      $this->collDernieresMinutesDestinationsPartial = true;
                    }

                    return $collDernieresMinutesDestinations;
                }

                if($partial && $this->collDernieresMinutesDestinations) {
                    foreach($this->collDernieresMinutesDestinations as $obj) {
                        if($obj->isNew()) {
                            $collDernieresMinutesDestinations[] = $obj;
                        }
                    }
                }

                $this->collDernieresMinutesDestinations = $collDernieresMinutesDestinations;
                $this->collDernieresMinutesDestinationsPartial = false;
            }
        }

        return $this->collDernieresMinutesDestinations;
    }

    /**
     * Sets a collection of DernieresMinutesDestination objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $dernieresMinutesDestinations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setDernieresMinutesDestinations(PropelCollection $dernieresMinutesDestinations, PropelPDO $con = null)
    {
        $this->dernieresMinutesDestinationsScheduledForDeletion = $this->getDernieresMinutesDestinations(new Criteria(), $con)->diff($dernieresMinutesDestinations);

        foreach ($this->dernieresMinutesDestinationsScheduledForDeletion as $dernieresMinutesDestinationRemoved) {
            $dernieresMinutesDestinationRemoved->setDernieresMinutes(null);
        }

        $this->collDernieresMinutesDestinations = null;
        foreach ($dernieresMinutesDestinations as $dernieresMinutesDestination) {
            $this->addDernieresMinutesDestination($dernieresMinutesDestination);
        }

        $this->collDernieresMinutesDestinations = $dernieresMinutesDestinations;
        $this->collDernieresMinutesDestinationsPartial = false;
    }

    /**
     * Returns the number of related DernieresMinutesDestination objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DernieresMinutesDestination objects.
     * @throws PropelException
     */
    public function countDernieresMinutesDestinations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDernieresMinutesDestinationsPartial && !$this->isNew();
        if (null === $this->collDernieresMinutesDestinations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDernieresMinutesDestinations) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getDernieresMinutesDestinations());
                }
                $query = DernieresMinutesDestinationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByDernieresMinutes($this)
                    ->count($con);
            }
        } else {
            return count($this->collDernieresMinutesDestinations);
        }
    }

    /**
     * Method called to associate a DernieresMinutesDestination object to this object
     * through the DernieresMinutesDestination foreign key attribute.
     *
     * @param    DernieresMinutesDestination $l DernieresMinutesDestination
     * @return DernieresMinutes The current object (for fluent API support)
     */
    public function addDernieresMinutesDestination(DernieresMinutesDestination $l)
    {
        if ($this->collDernieresMinutesDestinations === null) {
            $this->initDernieresMinutesDestinations();
            $this->collDernieresMinutesDestinationsPartial = true;
        }
        if (!in_array($l, $this->collDernieresMinutesDestinations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDernieresMinutesDestination($l);
        }

        return $this;
    }

    /**
     * @param	DernieresMinutesDestination $dernieresMinutesDestination The dernieresMinutesDestination object to add.
     */
    protected function doAddDernieresMinutesDestination($dernieresMinutesDestination)
    {
        $this->collDernieresMinutesDestinations[]= $dernieresMinutesDestination;
        $dernieresMinutesDestination->setDernieresMinutes($this);
    }

    /**
     * @param	DernieresMinutesDestination $dernieresMinutesDestination The dernieresMinutesDestination object to remove.
     */
    public function removeDernieresMinutesDestination($dernieresMinutesDestination)
    {
        if ($this->getDernieresMinutesDestinations()->contains($dernieresMinutesDestination)) {
            $this->collDernieresMinutesDestinations->remove($this->collDernieresMinutesDestinations->search($dernieresMinutesDestination));
            if (null === $this->dernieresMinutesDestinationsScheduledForDeletion) {
                $this->dernieresMinutesDestinationsScheduledForDeletion = clone $this->collDernieresMinutesDestinations;
                $this->dernieresMinutesDestinationsScheduledForDeletion->clear();
            }
            $this->dernieresMinutesDestinationsScheduledForDeletion[]= $dernieresMinutesDestination;
            $dernieresMinutesDestination->setDernieresMinutes(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DernieresMinutes is new, it will return
     * an empty collection; or if this DernieresMinutes has previously
     * been saved, it will retrieve related DernieresMinutesDestinations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DernieresMinutes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|DernieresMinutesDestination[] List of DernieresMinutesDestination objects
     */
    public function getDernieresMinutesDestinationsJoinDestination($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DernieresMinutesDestinationQuery::create(null, $criteria);
        $query->joinWith('Destination', $join_behavior);

        return $this->getDernieresMinutesDestinations($query, $con);
    }

    /**
     * Clears out the collEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissements()
     */
    public function clearEtablissements()
    {
        $this->collEtablissements = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementsPartial = null;
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
     * to the current object by way of the dernieres_minutes_etablissement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this DernieresMinutes is new, it will return
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
                    ->filterByDernieresMinutes($this)
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
     * to the current object by way of the dernieres_minutes_etablissement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
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
    }

    /**
     * Gets the number of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the dernieres_minutes_etablissement cross-reference table.
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
                    ->filterByDernieresMinutes($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissements);
        }
    }

    /**
     * Associate a Etablissement object to this object
     * through the dernieres_minutes_etablissement cross reference table.
     *
     * @param  Etablissement $etablissement The DernieresMinutesEtablissement object to relate
     * @return void
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
    }

    /**
     * @param	Etablissement $etablissement The etablissement object to add.
     */
    protected function doAddEtablissement($etablissement)
    {
        $dernieresMinutesEtablissement = new DernieresMinutesEtablissement();
        $dernieresMinutesEtablissement->setEtablissement($etablissement);
        $this->addDernieresMinutesEtablissement($dernieresMinutesEtablissement);
    }

    /**
     * Remove a Etablissement object to this object
     * through the dernieres_minutes_etablissement cross reference table.
     *
     * @param Etablissement $etablissement The DernieresMinutesEtablissement object to relate
     * @return void
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
    }

    /**
     * Clears out the collDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDestinations()
     */
    public function clearDestinations()
    {
        $this->collDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collDestinationsPartial = null;
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
     * to the current object by way of the dernieres_minutes_destination cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this DernieresMinutes is new, it will return
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
                    ->filterByDernieresMinutes($this)
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
     * to the current object by way of the dernieres_minutes_destination cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $destinations A Propel collection.
     * @param PropelPDO $con Optional connection object
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
    }

    /**
     * Gets the number of Destination objects related by a many-to-many relationship
     * to the current object by way of the dernieres_minutes_destination cross-reference table.
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
                    ->filterByDernieresMinutes($this)
                    ->count($con);
            }
        } else {
            return count($this->collDestinations);
        }
    }

    /**
     * Associate a Destination object to this object
     * through the dernieres_minutes_destination cross reference table.
     *
     * @param  Destination $destination The DernieresMinutesDestination object to relate
     * @return void
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
    }

    /**
     * @param	Destination $destination The destination object to add.
     */
    protected function doAddDestination($destination)
    {
        $dernieresMinutesDestination = new DernieresMinutesDestination();
        $dernieresMinutesDestination->setDestination($destination);
        $this->addDernieresMinutesDestination($dernieresMinutesDestination);
    }

    /**
     * Remove a Destination object to this object
     * through the dernieres_minutes_destination cross reference table.
     *
     * @param Destination $destination The DernieresMinutesDestination object to relate
     * @return void
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
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->date_start = null;
        $this->day_start = null;
        $this->day_range = null;
        $this->active = null;
        $this->enabled = null;
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
            if ($this->collDernieresMinutesEtablissements) {
                foreach ($this->collDernieresMinutesEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDernieresMinutesDestinations) {
                foreach ($this->collDernieresMinutesDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissements) {
                foreach ($this->collEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDestinations) {
                foreach ($this->collDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collDernieresMinutesEtablissements instanceof PropelCollection) {
            $this->collDernieresMinutesEtablissements->clearIterator();
        }
        $this->collDernieresMinutesEtablissements = null;
        if ($this->collDernieresMinutesDestinations instanceof PropelCollection) {
            $this->collDernieresMinutesDestinations->clearIterator();
        }
        $this->collDernieresMinutesDestinations = null;
        if ($this->collEtablissements instanceof PropelCollection) {
            $this->collEtablissements->clearIterator();
        }
        $this->collEtablissements = null;
        if ($this->collDestinations instanceof PropelCollection) {
            $this->collDestinations->clearIterator();
        }
        $this->collDestinations = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DernieresMinutesPeer::DEFAULT_STRING_FORMAT);
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
