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
use Cungfoo\Model\MiseEnAvant;
use Cungfoo\Model\MiseEnAvantI18n;
use Cungfoo\Model\MiseEnAvantI18nQuery;
use Cungfoo\Model\MiseEnAvantPeer;
use Cungfoo\Model\MiseEnAvantQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'mise_en_avant' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMiseEnAvant extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\MiseEnAvantPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MiseEnAvantPeer
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
     * The value for the prix field.
     * @var        string
     */
    protected $prix;

    /**
     * The value for the date_fin_validite field.
     * @var        string
     */
    protected $date_fin_validite;

    /**
     * The value for the sortable_rank field.
     * @var        int
     */
    protected $sortable_rank;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        PropelObjectCollection|MiseEnAvantI18n[] Collection to store aggregation of MiseEnAvantI18n objects.
     */
    protected $collMiseEnAvantI18ns;
    protected $collMiseEnAvantI18nsPartial;

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

    // sortable behavior

    /**
     * Queries to be executed in the save transaction
     * @var        array
     */
    protected $sortableQueries = array();

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'fr';

    /**
     * Current translation objects
     * @var        array[MiseEnAvantI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $miseEnAvantI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseMiseEnAvant object.
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
     * Get the [prix] column value.
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Get the [optionally formatted] temporal [date_fin_validite] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateFinValidite($format = null)
    {
        if ($this->date_fin_validite === null) {
            return null;
        }

        if ($this->date_fin_validite === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_fin_validite);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_fin_validite, true), $x);
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
     * Get the [sortable_rank] column value.
     *
     * @return int
     */
    public function getSortableRank()
    {
        return $this->sortable_rank;
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
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = MiseEnAvantPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [prix] column.
     *
     * @param string $v new value
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function setPrix($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prix !== $v) {
            $this->prix = $v;
            $this->modifiedColumns[] = MiseEnAvantPeer::PRIX;
        }


        return $this;
    } // setPrix()

    /**
     * Sets the value of [date_fin_validite] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function setDateFinValidite($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_fin_validite !== null || $dt !== null) {
            $currentDateAsString = ($this->date_fin_validite !== null && $tmpDt = new DateTime($this->date_fin_validite)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_fin_validite = $newDateAsString;
                $this->modifiedColumns[] = MiseEnAvantPeer::DATE_FIN_VALIDITE;
            }
        } // if either are not null


        return $this;
    } // setDateFinValidite()

    /**
     * Set the value of [sortable_rank] column.
     *
     * @param int $v new value
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function setSortableRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sortable_rank !== $v) {
            $this->sortable_rank = $v;
            $this->modifiedColumns[] = MiseEnAvantPeer::SORTABLE_RANK;
        }


        return $this;
    } // setSortableRank()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return MiseEnAvant The current object (for fluent API support)
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
            $this->modifiedColumns[] = MiseEnAvantPeer::ACTIVE;
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
            $this->prix = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->date_fin_validite = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->sortable_rank = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->active = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 5; // 5 = MiseEnAvantPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating MiseEnAvant object", $e);
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
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MiseEnAvantPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMiseEnAvantI18ns = null;

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
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MiseEnAvantQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // sortable behavior

            MiseEnAvantPeer::shiftRank(-1, $this->getSortableRank() + 1, null, $con);
            MiseEnAvantPeer::clearInstancePool();

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
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            // sortable behavior
            $this->processSortableQueries($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // sortable behavior
                if (!$this->isColumnModified(MiseEnAvantPeer::RANK_COL)) {
                    $this->setSortableRank(MiseEnAvantQuery::create()->getMaxRank($con) + 1);
                }

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
                MiseEnAvantPeer::addInstanceToPool($this);
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

            if ($this->miseEnAvantI18nsScheduledForDeletion !== null) {
                if (!$this->miseEnAvantI18nsScheduledForDeletion->isEmpty()) {
                    MiseEnAvantI18nQuery::create()
                        ->filterByPrimaryKeys($this->miseEnAvantI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->miseEnAvantI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collMiseEnAvantI18ns !== null) {
                foreach ($this->collMiseEnAvantI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = MiseEnAvantPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MiseEnAvantPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MiseEnAvantPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(MiseEnAvantPeer::PRIX)) {
            $modifiedColumns[':p' . $index++]  = '`prix`';
        }
        if ($this->isColumnModified(MiseEnAvantPeer::DATE_FIN_VALIDITE)) {
            $modifiedColumns[':p' . $index++]  = '`date_fin_validite`';
        }
        if ($this->isColumnModified(MiseEnAvantPeer::SORTABLE_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`sortable_rank`';
        }
        if ($this->isColumnModified(MiseEnAvantPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `mise_en_avant` (%s) VALUES (%s)',
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
                    case '`prix`':
                        $stmt->bindValue($identifier, $this->prix, PDO::PARAM_STR);
                        break;
                    case '`date_fin_validite`':
                        $stmt->bindValue($identifier, $this->date_fin_validite, PDO::PARAM_STR);
                        break;
                    case '`sortable_rank`':
                        $stmt->bindValue($identifier, $this->sortable_rank, PDO::PARAM_INT);
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


            if (($retval = MiseEnAvantPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMiseEnAvantI18ns !== null) {
                    foreach ($this->collMiseEnAvantI18ns as $referrerFK) {
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
        $pos = MiseEnAvantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getPrix();
                break;
            case 2:
                return $this->getDateFinValidite();
                break;
            case 3:
                return $this->getSortableRank();
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
        if (isset($alreadyDumpedObjects['MiseEnAvant'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['MiseEnAvant'][$this->getPrimaryKey()] = true;
        $keys = MiseEnAvantPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPrix(),
            $keys[2] => $this->getDateFinValidite(),
            $keys[3] => $this->getSortableRank(),
            $keys[4] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collMiseEnAvantI18ns) {
                $result['MiseEnAvantI18ns'] = $this->collMiseEnAvantI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MiseEnAvantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setPrix($value);
                break;
            case 2:
                $this->setDateFinValidite($value);
                break;
            case 3:
                $this->setSortableRank($value);
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
        $keys = MiseEnAvantPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPrix($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDateFinValidite($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSortableRank($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setActive($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MiseEnAvantPeer::DATABASE_NAME);

        if ($this->isColumnModified(MiseEnAvantPeer::ID)) $criteria->add(MiseEnAvantPeer::ID, $this->id);
        if ($this->isColumnModified(MiseEnAvantPeer::PRIX)) $criteria->add(MiseEnAvantPeer::PRIX, $this->prix);
        if ($this->isColumnModified(MiseEnAvantPeer::DATE_FIN_VALIDITE)) $criteria->add(MiseEnAvantPeer::DATE_FIN_VALIDITE, $this->date_fin_validite);
        if ($this->isColumnModified(MiseEnAvantPeer::SORTABLE_RANK)) $criteria->add(MiseEnAvantPeer::SORTABLE_RANK, $this->sortable_rank);
        if ($this->isColumnModified(MiseEnAvantPeer::ACTIVE)) $criteria->add(MiseEnAvantPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(MiseEnAvantPeer::DATABASE_NAME);
        $criteria->add(MiseEnAvantPeer::ID, $this->id);

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
     * @param object $copyObj An object of MiseEnAvant (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPrix($this->getPrix());
        $copyObj->setDateFinValidite($this->getDateFinValidite());
        $copyObj->setSortableRank($this->getSortableRank());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getMiseEnAvantI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMiseEnAvantI18n($relObj->copy($deepCopy));
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
     * @return MiseEnAvant Clone of current object.
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
     * @return MiseEnAvantPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MiseEnAvantPeer();
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
        if ('MiseEnAvantI18n' == $relationName) {
            $this->initMiseEnAvantI18ns();
        }
    }

    /**
     * Clears out the collMiseEnAvantI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return MiseEnAvant The current object (for fluent API support)
     * @see        addMiseEnAvantI18ns()
     */
    public function clearMiseEnAvantI18ns()
    {
        $this->collMiseEnAvantI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collMiseEnAvantI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collMiseEnAvantI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialMiseEnAvantI18ns($v = true)
    {
        $this->collMiseEnAvantI18nsPartial = $v;
    }

    /**
     * Initializes the collMiseEnAvantI18ns collection.
     *
     * By default this just sets the collMiseEnAvantI18ns collection to an empty array (like clearcollMiseEnAvantI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMiseEnAvantI18ns($overrideExisting = true)
    {
        if (null !== $this->collMiseEnAvantI18ns && !$overrideExisting) {
            return;
        }
        $this->collMiseEnAvantI18ns = new PropelObjectCollection();
        $this->collMiseEnAvantI18ns->setModel('MiseEnAvantI18n');
    }

    /**
     * Gets an array of MiseEnAvantI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MiseEnAvant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MiseEnAvantI18n[] List of MiseEnAvantI18n objects
     * @throws PropelException
     */
    public function getMiseEnAvantI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMiseEnAvantI18nsPartial && !$this->isNew();
        if (null === $this->collMiseEnAvantI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMiseEnAvantI18ns) {
                // return empty collection
                $this->initMiseEnAvantI18ns();
            } else {
                $collMiseEnAvantI18ns = MiseEnAvantI18nQuery::create(null, $criteria)
                    ->filterByMiseEnAvant($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMiseEnAvantI18nsPartial && count($collMiseEnAvantI18ns)) {
                      $this->initMiseEnAvantI18ns(false);

                      foreach($collMiseEnAvantI18ns as $obj) {
                        if (false == $this->collMiseEnAvantI18ns->contains($obj)) {
                          $this->collMiseEnAvantI18ns->append($obj);
                        }
                      }

                      $this->collMiseEnAvantI18nsPartial = true;
                    }

                    return $collMiseEnAvantI18ns;
                }

                if($partial && $this->collMiseEnAvantI18ns) {
                    foreach($this->collMiseEnAvantI18ns as $obj) {
                        if($obj->isNew()) {
                            $collMiseEnAvantI18ns[] = $obj;
                        }
                    }
                }

                $this->collMiseEnAvantI18ns = $collMiseEnAvantI18ns;
                $this->collMiseEnAvantI18nsPartial = false;
            }
        }

        return $this->collMiseEnAvantI18ns;
    }

    /**
     * Sets a collection of MiseEnAvantI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $miseEnAvantI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function setMiseEnAvantI18ns(PropelCollection $miseEnAvantI18ns, PropelPDO $con = null)
    {
        $this->miseEnAvantI18nsScheduledForDeletion = $this->getMiseEnAvantI18ns(new Criteria(), $con)->diff($miseEnAvantI18ns);

        foreach ($this->miseEnAvantI18nsScheduledForDeletion as $miseEnAvantI18nRemoved) {
            $miseEnAvantI18nRemoved->setMiseEnAvant(null);
        }

        $this->collMiseEnAvantI18ns = null;
        foreach ($miseEnAvantI18ns as $miseEnAvantI18n) {
            $this->addMiseEnAvantI18n($miseEnAvantI18n);
        }

        $this->collMiseEnAvantI18ns = $miseEnAvantI18ns;
        $this->collMiseEnAvantI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MiseEnAvantI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MiseEnAvantI18n objects.
     * @throws PropelException
     */
    public function countMiseEnAvantI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMiseEnAvantI18nsPartial && !$this->isNew();
        if (null === $this->collMiseEnAvantI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMiseEnAvantI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getMiseEnAvantI18ns());
            }
            $query = MiseEnAvantI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMiseEnAvant($this)
                ->count($con);
        }

        return count($this->collMiseEnAvantI18ns);
    }

    /**
     * Method called to associate a MiseEnAvantI18n object to this object
     * through the MiseEnAvantI18n foreign key attribute.
     *
     * @param    MiseEnAvantI18n $l MiseEnAvantI18n
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function addMiseEnAvantI18n(MiseEnAvantI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collMiseEnAvantI18ns === null) {
            $this->initMiseEnAvantI18ns();
            $this->collMiseEnAvantI18nsPartial = true;
        }
        if (!in_array($l, $this->collMiseEnAvantI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMiseEnAvantI18n($l);
        }

        return $this;
    }

    /**
     * @param	MiseEnAvantI18n $miseEnAvantI18n The miseEnAvantI18n object to add.
     */
    protected function doAddMiseEnAvantI18n($miseEnAvantI18n)
    {
        $this->collMiseEnAvantI18ns[]= $miseEnAvantI18n;
        $miseEnAvantI18n->setMiseEnAvant($this);
    }

    /**
     * @param	MiseEnAvantI18n $miseEnAvantI18n The miseEnAvantI18n object to remove.
     * @return MiseEnAvant The current object (for fluent API support)
     */
    public function removeMiseEnAvantI18n($miseEnAvantI18n)
    {
        if ($this->getMiseEnAvantI18ns()->contains($miseEnAvantI18n)) {
            $this->collMiseEnAvantI18ns->remove($this->collMiseEnAvantI18ns->search($miseEnAvantI18n));
            if (null === $this->miseEnAvantI18nsScheduledForDeletion) {
                $this->miseEnAvantI18nsScheduledForDeletion = clone $this->collMiseEnAvantI18ns;
                $this->miseEnAvantI18nsScheduledForDeletion->clear();
            }
            $this->miseEnAvantI18nsScheduledForDeletion[]= $miseEnAvantI18n;
            $miseEnAvantI18n->setMiseEnAvant(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->prix = null;
        $this->date_fin_validite = null;
        $this->sortable_rank = null;
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
            if ($this->collMiseEnAvantI18ns) {
                foreach ($this->collMiseEnAvantI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collMiseEnAvantI18ns instanceof PropelCollection) {
            $this->collMiseEnAvantI18ns->clearIterator();
        }
        $this->collMiseEnAvantI18ns = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MiseEnAvantPeer::DEFAULT_STRING_FORMAT);
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

    // sortable behavior

    /**
     * Wrap the getter for rank value
     *
     * @return    int
     */
    public function getRank()
    {
        return $this->sortable_rank;
    }

    /**
     * Wrap the setter for rank value
     *
     * @param     int
     * @return    MiseEnAvant
     */
    public function setRank($v)
    {
        return $this->setSortableRank($v);
    }

    /**
     * Check if the object is first in the list, i.e. if it has 1 for rank
     *
     * @return    boolean
     */
    public function isFirst()
    {
        return $this->getSortableRank() == 1;
    }

    /**
     * Check if the object is last in the list, i.e. if its rank is the highest rank
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    boolean
     */
    public function isLast(PropelPDO $con = null)
    {
        return $this->getSortableRank() == MiseEnAvantQuery::create()->getMaxRank($con);
    }

    /**
     * Get the next item in the list, i.e. the one for which rank is immediately higher
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    MiseEnAvant
     */
    public function getNext(PropelPDO $con = null)
    {

        return MiseEnAvantQuery::create()->findOneByRank($this->getSortableRank() + 1, $con);
    }

    /**
     * Get the previous item in the list, i.e. the one for which rank is immediately lower
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    MiseEnAvant
     */
    public function getPrevious(PropelPDO $con = null)
    {

        return MiseEnAvantQuery::create()->findOneByRank($this->getSortableRank() - 1, $con);
    }

    /**
     * Insert at specified rank
     * The modifications are not persisted until the object is saved.
     *
     * @param     integer    $rank rank value
     * @param     PropelPDO  $con      optional connection
     *
     * @return    MiseEnAvant the current object
     *
     * @throws    PropelException
     */
    public function insertAtRank($rank, PropelPDO $con = null)
    {
        $maxRank = MiseEnAvantQuery::create()->getMaxRank($con);
        if ($rank < 1 || $rank > $maxRank + 1) {
            throw new PropelException('Invalid rank ' . $rank);
        }
        // move the object in the list, at the given rank
        $this->setSortableRank($rank);
        if ($rank != $maxRank + 1) {
            // Keep the list modification query for the save() transaction
            $this->sortableQueries []= array(
                'callable'  => array(self::PEER, 'shiftRank'),
                'arguments' => array(1, $rank, null, )
            );
        }

        return $this;
    }

    /**
     * Insert in the last rank
     * The modifications are not persisted until the object is saved.
     *
     * @param PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     *
     * @throws    PropelException
     */
    public function insertAtBottom(PropelPDO $con = null)
    {
        $this->setSortableRank(MiseEnAvantQuery::create()->getMaxRank($con) + 1);

        return $this;
    }

    /**
     * Insert in the first rank
     * The modifications are not persisted until the object is saved.
     *
     * @return    MiseEnAvant the current object
     */
    public function insertAtTop()
    {
        return $this->insertAtRank(1);
    }

    /**
     * Move the object to a new rank, and shifts the rank
     * Of the objects inbetween the old and new rank accordingly
     *
     * @param     integer   $newRank rank value
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     *
     * @throws    PropelException
     */
    public function moveToRank($newRank, PropelPDO $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be moved. Please use insertAtRank() instead');
        }
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }
        if ($newRank < 1 || $newRank > MiseEnAvantQuery::create()->getMaxRank($con)) {
            throw new PropelException('Invalid rank ' . $newRank);
        }

        $oldRank = $this->getSortableRank();
        if ($oldRank == $newRank) {
            return $this;
        }

        $con->beginTransaction();
        try {
            // shift the objects between the old and the new rank
            $delta = ($oldRank < $newRank) ? -1 : 1;
            MiseEnAvantPeer::shiftRank($delta, min($oldRank, $newRank), max($oldRank, $newRank), $con);

            // move the object to its new rank
            $this->setSortableRank($newRank);
            $this->save($con);

            $con->commit();

            return $this;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Exchange the rank of the object with the one passed as argument, and saves both objects
     *
     * @param     MiseEnAvant $object
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     *
     * @throws Exception if the database cannot execute the two updates
     */
    public function swapWith($object, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $oldRank = $this->getSortableRank();
            $newRank = $object->getSortableRank();
            $this->setSortableRank($newRank);
            $this->save($con);
            $object->setSortableRank($oldRank);
            $object->save($con);
            $con->commit();

            return $this;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Move the object higher in the list, i.e. exchanges its rank with the one of the previous object
     *
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     */
    public function moveUp(PropelPDO $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $prev = $this->getPrevious($con);
            $this->swapWith($prev, $con);
            $con->commit();

            return $this;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Move the object higher in the list, i.e. exchanges its rank with the one of the next object
     *
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     */
    public function moveDown(PropelPDO $con = null)
    {
        if ($this->isLast($con)) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $next = $this->getNext($con);
            $this->swapWith($next, $con);
            $con->commit();

            return $this;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Move the object to the top of the list
     *
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     */
    public function moveToTop(PropelPDO $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }

        return $this->moveToRank(1, $con);
    }

    /**
     * Move the object to the bottom of the list
     *
     * @param     PropelPDO $con optional connection
     *
     * @return integer the old object's rank
     */
    public function moveToBottom(PropelPDO $con = null)
    {
        if ($this->isLast($con)) {
            return false;
        }
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $bottom = MiseEnAvantQuery::create()->getMaxRank($con);
            $res = $this->moveToRank($bottom, $con);
            $con->commit();

            return $res;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Removes the current object from the list.
     * The modifications are not persisted until the object is saved.
     *
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant the current object
     */
    public function removeFromList(PropelPDO $con = null)
    {
        // Keep the list modification query for the save() transaction
        $this->sortableQueries []= array(
            'callable'  => array(self::PEER, 'shiftRank'),
            'arguments' => array(-1, $this->getSortableRank() + 1, null)
        );
        // remove the object from the list
        $this->setSortableRank(null);

        return $this;
    }

    /**
     * Execute queries that were saved to be run inside the save transaction
     */
    protected function processSortableQueries($con)
    {
        foreach ($this->sortableQueries as $query) {
            $query['arguments'][]= $con;
            call_user_func_array($query['callable'], $query['arguments']);
        }
        $this->sortableQueries = array();
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
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    MiseEnAvant The current object (for fluent API support)
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
     * @return MiseEnAvantI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collMiseEnAvantI18ns) {
                foreach ($this->collMiseEnAvantI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new MiseEnAvantI18n();
                $translation->setLocale($locale);
            } else {
                $translation = MiseEnAvantI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addMiseEnAvantI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    MiseEnAvant The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            MiseEnAvantI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collMiseEnAvantI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collMiseEnAvantI18ns[$key]);
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
     * @return MiseEnAvantI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [titre] column value.
         *
         * @return string
         */
        public function getTitre()
        {
        return $this->getCurrentTranslation()->getTitre();
    }


        /**
         * Set the value of [titre] column.
         *
         * @param string $v new value
         * @return MiseEnAvantI18n The current object (for fluent API support)
         */
        public function setTitre($v)
        {    $this->getCurrentTranslation()->setTitre($v);

        return $this;
    }


        /**
         * Get the [accroche] column value.
         *
         * @return string
         */
        public function getAccroche()
        {
        return $this->getCurrentTranslation()->getAccroche();
    }


        /**
         * Set the value of [accroche] column.
         *
         * @param string $v new value
         * @return MiseEnAvantI18n The current object (for fluent API support)
         */
        public function setAccroche($v)
        {    $this->getCurrentTranslation()->setAccroche($v);

        return $this;
    }


        /**
         * Get the [lien] column value.
         *
         * @return string
         */
        public function getLien()
        {
        return $this->getCurrentTranslation()->getLien();
    }


        /**
         * Set the value of [lien] column.
         *
         * @param string $v new value
         * @return MiseEnAvantI18n The current object (for fluent API support)
         */
        public function setLien($v)
        {    $this->getCurrentTranslation()->setLien($v);

        return $this;
    }


        /**
         * Get the [titre_lien] column value.
         *
         * @return string
         */
        public function getTitreLien()
        {
        return $this->getCurrentTranslation()->getTitreLien();
    }


        /**
         * Set the value of [titre_lien] column.
         *
         * @param string $v new value
         * @return MiseEnAvantI18n The current object (for fluent API support)
         */
        public function setTitreLien($v)
        {    $this->getCurrentTranslation()->setTitreLien($v);

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
         * @return MiseEnAvantI18n The current object (for fluent API support)
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
         * @return MiseEnAvantI18n The current object (for fluent API support)
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
         * @return MiseEnAvantI18n The current object (for fluent API support)
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
         * @return MiseEnAvantI18n The current object (for fluent API support)
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
         * @return MiseEnAvantI18n The current object (for fluent API support)
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
        return 'uploads/mise_en_avants';
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
    public function getImageFondPath()
    {
        $peer = self::PEER;

        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('image_fond_path')
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
    public function setImageFondPath($v)
    {
        $peer = self::PEER;

        $values = explode(';', $v);

        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('image_fond_path')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;

        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('image_fond_path')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;

                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('image_fond_path')
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
    public function getIllustrationPath()
    {
        $peer = self::PEER;

        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('illustration_path')
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
    public function setIllustrationPath($v)
    {
        $peer = self::PEER;

        $values = explode(';', $v);

        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('illustration_path')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;

        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('illustration_path')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;

                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('illustration_path')
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
