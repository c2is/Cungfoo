<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Cungfoo\Model\Navigation;
use Cungfoo\Model\NavigationI18n;
use Cungfoo\Model\NavigationI18nQuery;
use Cungfoo\Model\NavigationItem;
use Cungfoo\Model\NavigationItemQuery;
use Cungfoo\Model\NavigationPeer;
use Cungfoo\Model\NavigationQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'navigation' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseNavigation extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\NavigationPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NavigationPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        PropelObjectCollection|NavigationItem[] Collection to store aggregation of NavigationItem objects.
     */
    protected $collNavigationItems;
    protected $collNavigationItemsPartial;

    /**
     * @var        PropelObjectCollection|NavigationI18n[] Collection to store aggregation of NavigationI18n objects.
     */
    protected $collNavigationI18ns;
    protected $collNavigationI18nsPartial;

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
     * @var        array[NavigationI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $navigationItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $navigationI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseNavigation object.
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return Navigation The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NavigationPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Navigation The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = NavigationPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Navigation The current object (for fluent API support)
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
            $this->modifiedColumns[] = NavigationPeer::ACTIVE;
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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = NavigationPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Navigation object", $e);
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
            $con = Propel::getConnection(NavigationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NavigationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collNavigationItems = null;

            $this->collNavigationI18ns = null;

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
            $con = Propel::getConnection(NavigationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NavigationQuery::create()
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
            $con = Propel::getConnection(NavigationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NavigationPeer::addInstanceToPool($this);
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

            if ($this->navigationItemsScheduledForDeletion !== null) {
                if (!$this->navigationItemsScheduledForDeletion->isEmpty()) {
                    NavigationItemQuery::create()
                        ->filterByPrimaryKeys($this->navigationItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->navigationItemsScheduledForDeletion = null;
                }
            }

            if ($this->collNavigationItems !== null) {
                foreach ($this->collNavigationItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->navigationI18nsScheduledForDeletion !== null) {
                if (!$this->navigationI18nsScheduledForDeletion->isEmpty()) {
                    NavigationI18nQuery::create()
                        ->filterByPrimaryKeys($this->navigationI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->navigationI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collNavigationI18ns !== null) {
                foreach ($this->collNavigationI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = NavigationPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NavigationPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NavigationPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NavigationPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(NavigationPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `navigation` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
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


            if (($retval = NavigationPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collNavigationItems !== null) {
                    foreach ($this->collNavigationItems as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNavigationI18ns !== null) {
                    foreach ($this->collNavigationI18ns as $referrerFK) {
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
        $pos = NavigationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
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
        if (isset($alreadyDumpedObjects['Navigation'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Navigation'][$this->getPrimaryKey()] = true;
        $keys = NavigationPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collNavigationItems) {
                $result['NavigationItems'] = $this->collNavigationItems->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNavigationI18ns) {
                $result['NavigationI18ns'] = $this->collNavigationI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = NavigationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
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
        $keys = NavigationPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setActive($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NavigationPeer::DATABASE_NAME);

        if ($this->isColumnModified(NavigationPeer::ID)) $criteria->add(NavigationPeer::ID, $this->id);
        if ($this->isColumnModified(NavigationPeer::NAME)) $criteria->add(NavigationPeer::NAME, $this->name);
        if ($this->isColumnModified(NavigationPeer::ACTIVE)) $criteria->add(NavigationPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(NavigationPeer::DATABASE_NAME);
        $criteria->add(NavigationPeer::ID, $this->id);

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
     * @param object $copyObj An object of Navigation (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getNavigationItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNavigationItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNavigationI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNavigationI18n($relObj->copy($deepCopy));
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
     * @return Navigation Clone of current object.
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
     * @return NavigationPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NavigationPeer();
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
        if ('NavigationItem' == $relationName) {
            $this->initNavigationItems();
        }
        if ('NavigationI18n' == $relationName) {
            $this->initNavigationI18ns();
        }
    }

    /**
     * Clears out the collNavigationItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Navigation The current object (for fluent API support)
     * @see        addNavigationItems()
     */
    public function clearNavigationItems()
    {
        $this->collNavigationItems = null; // important to set this to null since that means it is uninitialized
        $this->collNavigationItemsPartial = null;

        return $this;
    }

    /**
     * reset is the collNavigationItems collection loaded partially
     *
     * @return void
     */
    public function resetPartialNavigationItems($v = true)
    {
        $this->collNavigationItemsPartial = $v;
    }

    /**
     * Initializes the collNavigationItems collection.
     *
     * By default this just sets the collNavigationItems collection to an empty array (like clearcollNavigationItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNavigationItems($overrideExisting = true)
    {
        if (null !== $this->collNavigationItems && !$overrideExisting) {
            return;
        }
        $this->collNavigationItems = new PropelObjectCollection();
        $this->collNavigationItems->setModel('NavigationItem');
    }

    /**
     * Gets an array of NavigationItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Navigation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NavigationItem[] List of NavigationItem objects
     * @throws PropelException
     */
    public function getNavigationItems($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNavigationItemsPartial && !$this->isNew();
        if (null === $this->collNavigationItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNavigationItems) {
                // return empty collection
                $this->initNavigationItems();
            } else {
                $collNavigationItems = NavigationItemQuery::create(null, $criteria)
                    ->filterByNavigation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNavigationItemsPartial && count($collNavigationItems)) {
                      $this->initNavigationItems(false);

                      foreach($collNavigationItems as $obj) {
                        if (false == $this->collNavigationItems->contains($obj)) {
                          $this->collNavigationItems->append($obj);
                        }
                      }

                      $this->collNavigationItemsPartial = true;
                    }

                    return $collNavigationItems;
                }

                if($partial && $this->collNavigationItems) {
                    foreach($this->collNavigationItems as $obj) {
                        if($obj->isNew()) {
                            $collNavigationItems[] = $obj;
                        }
                    }
                }

                $this->collNavigationItems = $collNavigationItems;
                $this->collNavigationItemsPartial = false;
            }
        }

        return $this->collNavigationItems;
    }

    /**
     * Sets a collection of NavigationItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $navigationItems A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Navigation The current object (for fluent API support)
     */
    public function setNavigationItems(PropelCollection $navigationItems, PropelPDO $con = null)
    {
        $this->navigationItemsScheduledForDeletion = $this->getNavigationItems(new Criteria(), $con)->diff($navigationItems);

        foreach ($this->navigationItemsScheduledForDeletion as $navigationItemRemoved) {
            $navigationItemRemoved->setNavigation(null);
        }

        $this->collNavigationItems = null;
        foreach ($navigationItems as $navigationItem) {
            $this->addNavigationItem($navigationItem);
        }

        $this->collNavigationItems = $navigationItems;
        $this->collNavigationItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NavigationItem objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NavigationItem objects.
     * @throws PropelException
     */
    public function countNavigationItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNavigationItemsPartial && !$this->isNew();
        if (null === $this->collNavigationItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNavigationItems) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNavigationItems());
            }
            $query = NavigationItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNavigation($this)
                ->count($con);
        }

        return count($this->collNavigationItems);
    }

    /**
     * Method called to associate a NavigationItem object to this object
     * through the NavigationItem foreign key attribute.
     *
     * @param    NavigationItem $l NavigationItem
     * @return Navigation The current object (for fluent API support)
     */
    public function addNavigationItem(NavigationItem $l)
    {
        if ($this->collNavigationItems === null) {
            $this->initNavigationItems();
            $this->collNavigationItemsPartial = true;
        }
        if (!in_array($l, $this->collNavigationItems->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNavigationItem($l);
        }

        return $this;
    }

    /**
     * @param	NavigationItem $navigationItem The navigationItem object to add.
     */
    protected function doAddNavigationItem($navigationItem)
    {
        $this->collNavigationItems[]= $navigationItem;
        $navigationItem->setNavigation($this);
    }

    /**
     * @param	NavigationItem $navigationItem The navigationItem object to remove.
     * @return Navigation The current object (for fluent API support)
     */
    public function removeNavigationItem($navigationItem)
    {
        if ($this->getNavigationItems()->contains($navigationItem)) {
            $this->collNavigationItems->remove($this->collNavigationItems->search($navigationItem));
            if (null === $this->navigationItemsScheduledForDeletion) {
                $this->navigationItemsScheduledForDeletion = clone $this->collNavigationItems;
                $this->navigationItemsScheduledForDeletion->clear();
            }
            $this->navigationItemsScheduledForDeletion[]= $navigationItem;
            $navigationItem->setNavigation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Navigation is new, it will return
     * an empty collection; or if this Navigation has previously
     * been saved, it will retrieve related NavigationItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Navigation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NavigationItem[] List of NavigationItem objects
     */
    public function getNavigationItemsJoinParent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NavigationItemQuery::create(null, $criteria);
        $query->joinWith('Parent', $join_behavior);

        return $this->getNavigationItems($query, $con);
    }

    /**
     * Clears out the collNavigationI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Navigation The current object (for fluent API support)
     * @see        addNavigationI18ns()
     */
    public function clearNavigationI18ns()
    {
        $this->collNavigationI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collNavigationI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collNavigationI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialNavigationI18ns($v = true)
    {
        $this->collNavigationI18nsPartial = $v;
    }

    /**
     * Initializes the collNavigationI18ns collection.
     *
     * By default this just sets the collNavigationI18ns collection to an empty array (like clearcollNavigationI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNavigationI18ns($overrideExisting = true)
    {
        if (null !== $this->collNavigationI18ns && !$overrideExisting) {
            return;
        }
        $this->collNavigationI18ns = new PropelObjectCollection();
        $this->collNavigationI18ns->setModel('NavigationI18n');
    }

    /**
     * Gets an array of NavigationI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Navigation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NavigationI18n[] List of NavigationI18n objects
     * @throws PropelException
     */
    public function getNavigationI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNavigationI18nsPartial && !$this->isNew();
        if (null === $this->collNavigationI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNavigationI18ns) {
                // return empty collection
                $this->initNavigationI18ns();
            } else {
                $collNavigationI18ns = NavigationI18nQuery::create(null, $criteria)
                    ->filterByNavigation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNavigationI18nsPartial && count($collNavigationI18ns)) {
                      $this->initNavigationI18ns(false);

                      foreach($collNavigationI18ns as $obj) {
                        if (false == $this->collNavigationI18ns->contains($obj)) {
                          $this->collNavigationI18ns->append($obj);
                        }
                      }

                      $this->collNavigationI18nsPartial = true;
                    }

                    return $collNavigationI18ns;
                }

                if($partial && $this->collNavigationI18ns) {
                    foreach($this->collNavigationI18ns as $obj) {
                        if($obj->isNew()) {
                            $collNavigationI18ns[] = $obj;
                        }
                    }
                }

                $this->collNavigationI18ns = $collNavigationI18ns;
                $this->collNavigationI18nsPartial = false;
            }
        }

        return $this->collNavigationI18ns;
    }

    /**
     * Sets a collection of NavigationI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $navigationI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Navigation The current object (for fluent API support)
     */
    public function setNavigationI18ns(PropelCollection $navigationI18ns, PropelPDO $con = null)
    {
        $this->navigationI18nsScheduledForDeletion = $this->getNavigationI18ns(new Criteria(), $con)->diff($navigationI18ns);

        foreach ($this->navigationI18nsScheduledForDeletion as $navigationI18nRemoved) {
            $navigationI18nRemoved->setNavigation(null);
        }

        $this->collNavigationI18ns = null;
        foreach ($navigationI18ns as $navigationI18n) {
            $this->addNavigationI18n($navigationI18n);
        }

        $this->collNavigationI18ns = $navigationI18ns;
        $this->collNavigationI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NavigationI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NavigationI18n objects.
     * @throws PropelException
     */
    public function countNavigationI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNavigationI18nsPartial && !$this->isNew();
        if (null === $this->collNavigationI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNavigationI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNavigationI18ns());
            }
            $query = NavigationI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNavigation($this)
                ->count($con);
        }

        return count($this->collNavigationI18ns);
    }

    /**
     * Method called to associate a NavigationI18n object to this object
     * through the NavigationI18n foreign key attribute.
     *
     * @param    NavigationI18n $l NavigationI18n
     * @return Navigation The current object (for fluent API support)
     */
    public function addNavigationI18n(NavigationI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collNavigationI18ns === null) {
            $this->initNavigationI18ns();
            $this->collNavigationI18nsPartial = true;
        }
        if (!in_array($l, $this->collNavigationI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNavigationI18n($l);
        }

        return $this;
    }

    /**
     * @param	NavigationI18n $navigationI18n The navigationI18n object to add.
     */
    protected function doAddNavigationI18n($navigationI18n)
    {
        $this->collNavigationI18ns[]= $navigationI18n;
        $navigationI18n->setNavigation($this);
    }

    /**
     * @param	NavigationI18n $navigationI18n The navigationI18n object to remove.
     * @return Navigation The current object (for fluent API support)
     */
    public function removeNavigationI18n($navigationI18n)
    {
        if ($this->getNavigationI18ns()->contains($navigationI18n)) {
            $this->collNavigationI18ns->remove($this->collNavigationI18ns->search($navigationI18n));
            if (null === $this->navigationI18nsScheduledForDeletion) {
                $this->navigationI18nsScheduledForDeletion = clone $this->collNavigationI18ns;
                $this->navigationI18nsScheduledForDeletion->clear();
            }
            $this->navigationI18nsScheduledForDeletion[]= $navigationI18n;
            $navigationI18n->setNavigation(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
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
            if ($this->collNavigationItems) {
                foreach ($this->collNavigationItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNavigationI18ns) {
                foreach ($this->collNavigationI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collNavigationItems instanceof PropelCollection) {
            $this->collNavigationItems->clearIterator();
        }
        $this->collNavigationItems = null;
        if ($this->collNavigationI18ns instanceof PropelCollection) {
            $this->collNavigationI18ns->clearIterator();
        }
        $this->collNavigationI18ns = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string The value of the 'name' column
     */
    public function __toString()
    {
        return (string) $this->getName();
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

    /**
     * return true is the object is active locale
     *
     * @return boolean
     */
    public function isActiveLocale()
    {
        return $this->getActiveLocale();
    }

    public function getItemsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\ItemPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ItemI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ItemPeer::ID, \Cungfoo\Model\ItemI18nPeer::alias('i18n_locale', \Cungfoo\Model\ItemI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ItemI18nPeer::alias('i18n_locale', \Cungfoo\Model\ItemI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ItemI18nPeer::alias('i18n_locale', \Cungfoo\Model\ItemI18nPeer::LOCALE), $this->currentLocale);

        return $this->getItems($criteria, $con);
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

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Navigation The current object (for fluent API support)
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
     * @return NavigationI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collNavigationI18ns) {
                foreach ($this->collNavigationI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new NavigationI18n();
                $translation->setLocale($locale);
            } else {
                $translation = NavigationI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addNavigationI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Navigation The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            NavigationI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collNavigationI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collNavigationI18ns[$key]);
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
     * @return NavigationI18n */
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
            return $peerClassName::getSeo($this->currentLocale)->getSeoTitle();
        }

        return '';
    }



        /**
         * Set the value of [seo_title] column.
         *
         * @param string $v new value
         * @return NavigationI18n The current object (for fluent API support)
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
         * @return NavigationI18n The current object (for fluent API support)
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
         * @return NavigationI18n The current object (for fluent API support)
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
         * @return NavigationI18n The current object (for fluent API support)
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
         * @return NavigationI18n The current object (for fluent API support)
         */
        public function setActiveLocale($v)
        {    $this->getCurrentTranslation()->setActiveLocale($v);

        return $this;
    }

}
