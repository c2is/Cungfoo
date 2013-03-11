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
use Cungfoo\Model\Pays;
use Cungfoo\Model\PaysI18n;
use Cungfoo\Model\PaysI18nQuery;
use Cungfoo\Model\PaysPeer;
use Cungfoo\Model\PaysQuery;
use Cungfoo\Model\Region;
use Cungfoo\Model\RegionQuery;
use Cungfoo\Model\RegionRef;
use Cungfoo\Model\RegionRefQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'pays' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePays extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\PaysPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PaysPeer
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
     * @var        PropelObjectCollection|Region[] Collection to store aggregation of Region objects.
     */
    protected $collRegions;
    protected $collRegionsPartial;

    /**
     * @var        PropelObjectCollection|RegionRef[] Collection to store aggregation of RegionRef objects.
     */
    protected $collRegionRefs;
    protected $collRegionRefsPartial;

    /**
     * @var        PropelObjectCollection|PaysI18n[] Collection to store aggregation of PaysI18n objects.
     */
    protected $collPaysI18ns;
    protected $collPaysI18nsPartial;

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
     * @var        array[PaysI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $regionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $regionRefsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $paysI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BasePays object.
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
     * @return Pays The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PaysPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return Pays The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = PaysPeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Pays The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PaysPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Pays The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PaysPeer::UPDATED_AT;
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
     * @return Pays The current object (for fluent API support)
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
            $this->modifiedColumns[] = PaysPeer::ACTIVE;
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
            $this->created_at = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->active = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 5; // 5 = PaysPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Pays object", $e);
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
            $con = Propel::getConnection(PaysPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PaysPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collRegions = null;

            $this->collRegionRefs = null;

            $this->collPaysI18ns = null;

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
            $con = Propel::getConnection(PaysPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PaysQuery::create()
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
            $con = Propel::getConnection(PaysPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PaysPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PaysPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PaysPeer::UPDATED_AT)) {
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
                PaysPeer::addInstanceToPool($this);
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

            if ($this->regionsScheduledForDeletion !== null) {
                if (!$this->regionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->regionsScheduledForDeletion as $region) {
                        // need to save related object because we set the relation to null
                        $region->save($con);
                    }
                    $this->regionsScheduledForDeletion = null;
                }
            }

            if ($this->collRegions !== null) {
                foreach ($this->collRegions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->regionRefsScheduledForDeletion !== null) {
                if (!$this->regionRefsScheduledForDeletion->isEmpty()) {
                    foreach ($this->regionRefsScheduledForDeletion as $regionRef) {
                        // need to save related object because we set the relation to null
                        $regionRef->save($con);
                    }
                    $this->regionRefsScheduledForDeletion = null;
                }
            }

            if ($this->collRegionRefs !== null) {
                foreach ($this->collRegionRefs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->paysI18nsScheduledForDeletion !== null) {
                if (!$this->paysI18nsScheduledForDeletion->isEmpty()) {
                    PaysI18nQuery::create()
                        ->filterByPrimaryKeys($this->paysI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->paysI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPaysI18ns !== null) {
                foreach ($this->collPaysI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = PaysPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PaysPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PaysPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PaysPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }
        if ($this->isColumnModified(PaysPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PaysPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(PaysPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `pays` (%s) VALUES (%s)',
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


            if (($retval = PaysPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collRegions !== null) {
                    foreach ($this->collRegions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRegionRefs !== null) {
                    foreach ($this->collRegionRefs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPaysI18ns !== null) {
                    foreach ($this->collPaysI18ns as $referrerFK) {
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
        $pos = PaysPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCreatedAt();
                break;
            case 3:
                return $this->getUpdatedAt();
                break;
            case 4:
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
        if (isset($alreadyDumpedObjects['Pays'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Pays'][$this->getPrimaryKey()] = true;
        $keys = PaysPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getCreatedAt(),
            $keys[3] => $this->getUpdatedAt(),
            $keys[4] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collRegions) {
                $result['Regions'] = $this->collRegions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRegionRefs) {
                $result['RegionRefs'] = $this->collRegionRefs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPaysI18ns) {
                $result['PaysI18ns'] = $this->collPaysI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PaysPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCreatedAt($value);
                break;
            case 3:
                $this->setUpdatedAt($value);
                break;
            case 4:
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
        $keys = PaysPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setActive($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PaysPeer::DATABASE_NAME);

        if ($this->isColumnModified(PaysPeer::ID)) $criteria->add(PaysPeer::ID, $this->id);
        if ($this->isColumnModified(PaysPeer::CODE)) $criteria->add(PaysPeer::CODE, $this->code);
        if ($this->isColumnModified(PaysPeer::CREATED_AT)) $criteria->add(PaysPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PaysPeer::UPDATED_AT)) $criteria->add(PaysPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(PaysPeer::ACTIVE)) $criteria->add(PaysPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(PaysPeer::DATABASE_NAME);
        $criteria->add(PaysPeer::ID, $this->id);

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
     * @param object $copyObj An object of Pays (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getRegions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRegion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRegionRefs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRegionRef($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPaysI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPaysI18n($relObj->copy($deepCopy));
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
     * @return Pays Clone of current object.
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
     * @return PaysPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PaysPeer();
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
        if ('Region' == $relationName) {
            $this->initRegions();
        }
        if ('RegionRef' == $relationName) {
            $this->initRegionRefs();
        }
        if ('PaysI18n' == $relationName) {
            $this->initPaysI18ns();
        }
    }

    /**
     * Clears out the collRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Pays The current object (for fluent API support)
     * @see        addRegions()
     */
    public function clearRegions()
    {
        $this->collRegions = null; // important to set this to null since that means it is uninitialized
        $this->collRegionsPartial = null;

        return $this;
    }

    /**
     * reset is the collRegions collection loaded partially
     *
     * @return void
     */
    public function resetPartialRegions($v = true)
    {
        $this->collRegionsPartial = $v;
    }

    /**
     * Initializes the collRegions collection.
     *
     * By default this just sets the collRegions collection to an empty array (like clearcollRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRegions($overrideExisting = true)
    {
        if (null !== $this->collRegions && !$overrideExisting) {
            return;
        }
        $this->collRegions = new PropelObjectCollection();
        $this->collRegions->setModel('Region');
    }

    /**
     * Gets an array of Region objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Pays is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Region[] List of Region objects
     * @throws PropelException
     */
    public function getRegions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRegionsPartial && !$this->isNew();
        if (null === $this->collRegions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRegions) {
                // return empty collection
                $this->initRegions();
            } else {
                $collRegions = RegionQuery::create(null, $criteria)
                    ->filterByPays($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRegionsPartial && count($collRegions)) {
                      $this->initRegions(false);

                      foreach($collRegions as $obj) {
                        if (false == $this->collRegions->contains($obj)) {
                          $this->collRegions->append($obj);
                        }
                      }

                      $this->collRegionsPartial = true;
                    }

                    return $collRegions;
                }

                if($partial && $this->collRegions) {
                    foreach($this->collRegions as $obj) {
                        if($obj->isNew()) {
                            $collRegions[] = $obj;
                        }
                    }
                }

                $this->collRegions = $collRegions;
                $this->collRegionsPartial = false;
            }
        }

        return $this->collRegions;
    }

    /**
     * Sets a collection of Region objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $regions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Pays The current object (for fluent API support)
     */
    public function setRegions(PropelCollection $regions, PropelPDO $con = null)
    {
        $this->regionsScheduledForDeletion = $this->getRegions(new Criteria(), $con)->diff($regions);

        foreach ($this->regionsScheduledForDeletion as $regionRemoved) {
            $regionRemoved->setPays(null);
        }

        $this->collRegions = null;
        foreach ($regions as $region) {
            $this->addRegion($region);
        }

        $this->collRegions = $regions;
        $this->collRegionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Region objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Region objects.
     * @throws PropelException
     */
    public function countRegions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRegionsPartial && !$this->isNew();
        if (null === $this->collRegions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegions) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRegions());
            }
            $query = RegionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPays($this)
                ->count($con);
        }

        return count($this->collRegions);
    }

    /**
     * Method called to associate a Region object to this object
     * through the Region foreign key attribute.
     *
     * @param    Region $l Region
     * @return Pays The current object (for fluent API support)
     */
    public function addRegion(Region $l)
    {
        if ($this->collRegions === null) {
            $this->initRegions();
            $this->collRegionsPartial = true;
        }
        if (!in_array($l, $this->collRegions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRegion($l);
        }

        return $this;
    }

    /**
     * @param	Region $region The region object to add.
     */
    protected function doAddRegion($region)
    {
        $this->collRegions[]= $region;
        $region->setPays($this);
    }

    /**
     * @param	Region $region The region object to remove.
     * @return Pays The current object (for fluent API support)
     */
    public function removeRegion($region)
    {
        if ($this->getRegions()->contains($region)) {
            $this->collRegions->remove($this->collRegions->search($region));
            if (null === $this->regionsScheduledForDeletion) {
                $this->regionsScheduledForDeletion = clone $this->collRegions;
                $this->regionsScheduledForDeletion->clear();
            }
            $this->regionsScheduledForDeletion[]= $region;
            $region->setPays(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pays is new, it will return
     * an empty collection; or if this Pays has previously
     * been saved, it will retrieve related Regions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pays.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Region[] List of Region objects
     */
    public function getRegionsJoinDestination($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RegionQuery::create(null, $criteria);
        $query->joinWith('Destination', $join_behavior);

        return $this->getRegions($query, $con);
    }

    /**
     * Clears out the collRegionRefs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Pays The current object (for fluent API support)
     * @see        addRegionRefs()
     */
    public function clearRegionRefs()
    {
        $this->collRegionRefs = null; // important to set this to null since that means it is uninitialized
        $this->collRegionRefsPartial = null;

        return $this;
    }

    /**
     * reset is the collRegionRefs collection loaded partially
     *
     * @return void
     */
    public function resetPartialRegionRefs($v = true)
    {
        $this->collRegionRefsPartial = $v;
    }

    /**
     * Initializes the collRegionRefs collection.
     *
     * By default this just sets the collRegionRefs collection to an empty array (like clearcollRegionRefs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRegionRefs($overrideExisting = true)
    {
        if (null !== $this->collRegionRefs && !$overrideExisting) {
            return;
        }
        $this->collRegionRefs = new PropelObjectCollection();
        $this->collRegionRefs->setModel('RegionRef');
    }

    /**
     * Gets an array of RegionRef objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Pays is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|RegionRef[] List of RegionRef objects
     * @throws PropelException
     */
    public function getRegionRefs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRegionRefsPartial && !$this->isNew();
        if (null === $this->collRegionRefs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRegionRefs) {
                // return empty collection
                $this->initRegionRefs();
            } else {
                $collRegionRefs = RegionRefQuery::create(null, $criteria)
                    ->filterByPays($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRegionRefsPartial && count($collRegionRefs)) {
                      $this->initRegionRefs(false);

                      foreach($collRegionRefs as $obj) {
                        if (false == $this->collRegionRefs->contains($obj)) {
                          $this->collRegionRefs->append($obj);
                        }
                      }

                      $this->collRegionRefsPartial = true;
                    }

                    return $collRegionRefs;
                }

                if($partial && $this->collRegionRefs) {
                    foreach($this->collRegionRefs as $obj) {
                        if($obj->isNew()) {
                            $collRegionRefs[] = $obj;
                        }
                    }
                }

                $this->collRegionRefs = $collRegionRefs;
                $this->collRegionRefsPartial = false;
            }
        }

        return $this->collRegionRefs;
    }

    /**
     * Sets a collection of RegionRef objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $regionRefs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Pays The current object (for fluent API support)
     */
    public function setRegionRefs(PropelCollection $regionRefs, PropelPDO $con = null)
    {
        $this->regionRefsScheduledForDeletion = $this->getRegionRefs(new Criteria(), $con)->diff($regionRefs);

        foreach ($this->regionRefsScheduledForDeletion as $regionRefRemoved) {
            $regionRefRemoved->setPays(null);
        }

        $this->collRegionRefs = null;
        foreach ($regionRefs as $regionRef) {
            $this->addRegionRef($regionRef);
        }

        $this->collRegionRefs = $regionRefs;
        $this->collRegionRefsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RegionRef objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related RegionRef objects.
     * @throws PropelException
     */
    public function countRegionRefs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRegionRefsPartial && !$this->isNew();
        if (null === $this->collRegionRefs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegionRefs) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRegionRefs());
            }
            $query = RegionRefQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPays($this)
                ->count($con);
        }

        return count($this->collRegionRefs);
    }

    /**
     * Method called to associate a RegionRef object to this object
     * through the RegionRef foreign key attribute.
     *
     * @param    RegionRef $l RegionRef
     * @return Pays The current object (for fluent API support)
     */
    public function addRegionRef(RegionRef $l)
    {
        if ($this->collRegionRefs === null) {
            $this->initRegionRefs();
            $this->collRegionRefsPartial = true;
        }
        if (!in_array($l, $this->collRegionRefs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRegionRef($l);
        }

        return $this;
    }

    /**
     * @param	RegionRef $regionRef The regionRef object to add.
     */
    protected function doAddRegionRef($regionRef)
    {
        $this->collRegionRefs[]= $regionRef;
        $regionRef->setPays($this);
    }

    /**
     * @param	RegionRef $regionRef The regionRef object to remove.
     * @return Pays The current object (for fluent API support)
     */
    public function removeRegionRef($regionRef)
    {
        if ($this->getRegionRefs()->contains($regionRef)) {
            $this->collRegionRefs->remove($this->collRegionRefs->search($regionRef));
            if (null === $this->regionRefsScheduledForDeletion) {
                $this->regionRefsScheduledForDeletion = clone $this->collRegionRefs;
                $this->regionRefsScheduledForDeletion->clear();
            }
            $this->regionRefsScheduledForDeletion[]= $regionRef;
            $regionRef->setPays(null);
        }

        return $this;
    }

    /**
     * Clears out the collPaysI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Pays The current object (for fluent API support)
     * @see        addPaysI18ns()
     */
    public function clearPaysI18ns()
    {
        $this->collPaysI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collPaysI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collPaysI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialPaysI18ns($v = true)
    {
        $this->collPaysI18nsPartial = $v;
    }

    /**
     * Initializes the collPaysI18ns collection.
     *
     * By default this just sets the collPaysI18ns collection to an empty array (like clearcollPaysI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPaysI18ns($overrideExisting = true)
    {
        if (null !== $this->collPaysI18ns && !$overrideExisting) {
            return;
        }
        $this->collPaysI18ns = new PropelObjectCollection();
        $this->collPaysI18ns->setModel('PaysI18n');
    }

    /**
     * Gets an array of PaysI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Pays is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PaysI18n[] List of PaysI18n objects
     * @throws PropelException
     */
    public function getPaysI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPaysI18nsPartial && !$this->isNew();
        if (null === $this->collPaysI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPaysI18ns) {
                // return empty collection
                $this->initPaysI18ns();
            } else {
                $collPaysI18ns = PaysI18nQuery::create(null, $criteria)
                    ->filterByPays($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPaysI18nsPartial && count($collPaysI18ns)) {
                      $this->initPaysI18ns(false);

                      foreach($collPaysI18ns as $obj) {
                        if (false == $this->collPaysI18ns->contains($obj)) {
                          $this->collPaysI18ns->append($obj);
                        }
                      }

                      $this->collPaysI18nsPartial = true;
                    }

                    return $collPaysI18ns;
                }

                if($partial && $this->collPaysI18ns) {
                    foreach($this->collPaysI18ns as $obj) {
                        if($obj->isNew()) {
                            $collPaysI18ns[] = $obj;
                        }
                    }
                }

                $this->collPaysI18ns = $collPaysI18ns;
                $this->collPaysI18nsPartial = false;
            }
        }

        return $this->collPaysI18ns;
    }

    /**
     * Sets a collection of PaysI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $paysI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Pays The current object (for fluent API support)
     */
    public function setPaysI18ns(PropelCollection $paysI18ns, PropelPDO $con = null)
    {
        $this->paysI18nsScheduledForDeletion = $this->getPaysI18ns(new Criteria(), $con)->diff($paysI18ns);

        foreach ($this->paysI18nsScheduledForDeletion as $paysI18nRemoved) {
            $paysI18nRemoved->setPays(null);
        }

        $this->collPaysI18ns = null;
        foreach ($paysI18ns as $paysI18n) {
            $this->addPaysI18n($paysI18n);
        }

        $this->collPaysI18ns = $paysI18ns;
        $this->collPaysI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PaysI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PaysI18n objects.
     * @throws PropelException
     */
    public function countPaysI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPaysI18nsPartial && !$this->isNew();
        if (null === $this->collPaysI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPaysI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPaysI18ns());
            }
            $query = PaysI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPays($this)
                ->count($con);
        }

        return count($this->collPaysI18ns);
    }

    /**
     * Method called to associate a PaysI18n object to this object
     * through the PaysI18n foreign key attribute.
     *
     * @param    PaysI18n $l PaysI18n
     * @return Pays The current object (for fluent API support)
     */
    public function addPaysI18n(PaysI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPaysI18ns === null) {
            $this->initPaysI18ns();
            $this->collPaysI18nsPartial = true;
        }
        if (!in_array($l, $this->collPaysI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPaysI18n($l);
        }

        return $this;
    }

    /**
     * @param	PaysI18n $paysI18n The paysI18n object to add.
     */
    protected function doAddPaysI18n($paysI18n)
    {
        $this->collPaysI18ns[]= $paysI18n;
        $paysI18n->setPays($this);
    }

    /**
     * @param	PaysI18n $paysI18n The paysI18n object to remove.
     * @return Pays The current object (for fluent API support)
     */
    public function removePaysI18n($paysI18n)
    {
        if ($this->getPaysI18ns()->contains($paysI18n)) {
            $this->collPaysI18ns->remove($this->collPaysI18ns->search($paysI18n));
            if (null === $this->paysI18nsScheduledForDeletion) {
                $this->paysI18nsScheduledForDeletion = clone $this->collPaysI18ns;
                $this->paysI18nsScheduledForDeletion->clear();
            }
            $this->paysI18nsScheduledForDeletion[]= $paysI18n;
            $paysI18n->setPays(null);
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
            if ($this->collRegions) {
                foreach ($this->collRegions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRegionRefs) {
                foreach ($this->collRegionRefs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPaysI18ns) {
                foreach ($this->collPaysI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collRegions instanceof PropelCollection) {
            $this->collRegions->clearIterator();
        }
        $this->collRegions = null;
        if ($this->collRegionRefs instanceof PropelCollection) {
            $this->collRegionRefs->clearIterator();
        }
        $this->collRegionRefs = null;
        if ($this->collPaysI18ns instanceof PropelCollection) {
            $this->collPaysI18ns->clearIterator();
        }
        $this->collPaysI18ns = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PaysPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Pays The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PaysPeer::UPDATED_AT;

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
    
    public function getRegionsActive($criteria = null, PropelPDO $con = null)
    {
    
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\RegionPeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\RegionPeer::ID, \Cungfoo\Model\RegionI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\RegionI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\RegionI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getRegions($criteria, $con);
    }
    
    public function getRegionRefsActive($criteria = null, PropelPDO $con = null)
    {
    
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\RegionRefPeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\RegionRefI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\RegionRefPeer::ID, \Cungfoo\Model\RegionRefI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionRefI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\RegionRefI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionRefI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\RegionRefI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionRefI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getRegionRefs($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Pays The current object (for fluent API support)
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
     * @return PaysI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPaysI18ns) {
                foreach ($this->collPaysI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new PaysI18n();
                $translation->setLocale($locale);
            } else {
                $translation = PaysI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPaysI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Pays The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            PaysI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPaysI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPaysI18ns[$key]);
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
     * @return PaysI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
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
         * @return PaysI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

        return $this;
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
         * @return PaysI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

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
         * @return PaysI18n The current object (for fluent API support)
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
         * @return PaysI18n The current object (for fluent API support)
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
         * @return PaysI18n The current object (for fluent API support)
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
         * @return PaysI18n The current object (for fluent API support)
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
         * @return PaysI18n The current object (for fluent API support)
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
         * @return PaysI18n The current object (for fluent API support)
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
         * @return PaysI18n The current object (for fluent API support)
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
        return 'uploads/payss';
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
    public function getImageDetail1()
    {
        $peer = self::PEER;
    
        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef($peer::TABLE_NAME.'.image_detail_1')
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
    public function setImageDetail1($v)
    {
        $peer = self::PEER;
    
        $values = explode(';', $v);
    
        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef($peer::TABLE_NAME.'.image_detail_1')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;
    
        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef($peer::TABLE_NAME.'.image_detail_1')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;
    
                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef($peer::TABLE_NAME.'.image_detail_1')
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
    public function getImageDetail2()
    {
        $peer = self::PEER;
    
        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef($peer::TABLE_NAME.'.image_detail_2')
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
    public function setImageDetail2($v)
    {
        $peer = self::PEER;
    
        $values = explode(';', $v);
    
        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef($peer::TABLE_NAME.'.image_detail_2')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;
    
        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef($peer::TABLE_NAME.'.image_detail_2')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;
    
                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef($peer::TABLE_NAME.'.image_detail_2')
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
