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
use Cungfoo\Model\Metadata;
use Cungfoo\Model\MetadataI18n;
use Cungfoo\Model\MetadataI18nQuery;
use Cungfoo\Model\MetadataPeer;
use Cungfoo\Model\MetadataQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'metadata' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMetadata extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\MetadataPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MetadataPeer
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
     * The value for the table_ref field.
     * @var        string
     */
    protected $table_ref;

    /**
     * The value for the visuel field.
     * @var        string
     */
    protected $visuel;

    /**
     * @var        PropelObjectCollection|MetadataI18n[] Collection to store aggregation of MetadataI18n objects.
     */
    protected $collMetadataI18ns;
    protected $collMetadataI18nsPartial;

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
     * @var        array[MetadataI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $metadataI18nsScheduledForDeletion = null;

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
     * Get the [table_ref] column value.
     *
     * @return string
     */
    public function getTableRef()
    {
        return $this->table_ref;
    }

    /**
     * Get the [visuel] column value.
     *
     * @return string
     */
    public function getVisuel()
    {
        return $this->visuel;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Metadata The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = MetadataPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [table_ref] column.
     *
     * @param string $v new value
     * @return Metadata The current object (for fluent API support)
     */
    public function setTableRef($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->table_ref !== $v) {
            $this->table_ref = $v;
            $this->modifiedColumns[] = MetadataPeer::TABLE_REF;
        }


        return $this;
    } // setTableRef()

    /**
     * Set the value of [visuel] column.
     *
     * @param string $v new value
     * @return Metadata The current object (for fluent API support)
     */
    public function setVisuel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visuel !== $v) {
            $this->visuel = $v;
            $this->modifiedColumns[] = MetadataPeer::VISUEL;
        }


        return $this;
    } // setVisuel()

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
            $this->table_ref = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->visuel = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = MetadataPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Metadata object", $e);
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
            $con = Propel::getConnection(MetadataPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MetadataPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMetadataI18ns = null;

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
            $con = Propel::getConnection(MetadataPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MetadataQuery::create()
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
            $con = Propel::getConnection(MetadataPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                MetadataPeer::addInstanceToPool($this);
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

            if ($this->metadataI18nsScheduledForDeletion !== null) {
                if (!$this->metadataI18nsScheduledForDeletion->isEmpty()) {
                    MetadataI18nQuery::create()
                        ->filterByPrimaryKeys($this->metadataI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->metadataI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collMetadataI18ns !== null) {
                foreach ($this->collMetadataI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = MetadataPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MetadataPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MetadataPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(MetadataPeer::TABLE_REF)) {
            $modifiedColumns[':p' . $index++]  = '`table_ref`';
        }
        if ($this->isColumnModified(MetadataPeer::VISUEL)) {
            $modifiedColumns[':p' . $index++]  = '`visuel`';
        }

        $sql = sprintf(
            'INSERT INTO `metadata` (%s) VALUES (%s)',
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
                    case '`table_ref`':
                        $stmt->bindValue($identifier, $this->table_ref, PDO::PARAM_STR);
                        break;
                    case '`visuel`':
                        $stmt->bindValue($identifier, $this->visuel, PDO::PARAM_STR);
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


            if (($retval = MetadataPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMetadataI18ns !== null) {
                    foreach ($this->collMetadataI18ns as $referrerFK) {
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
        $pos = MetadataPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getTableRef();
                break;
            case 2:
                return $this->getVisuel();
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
        if (isset($alreadyDumpedObjects['Metadata'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Metadata'][$this->getPrimaryKey()] = true;
        $keys = MetadataPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTableRef(),
            $keys[2] => $this->getVisuel(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collMetadataI18ns) {
                $result['MetadataI18ns'] = $this->collMetadataI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MetadataPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setTableRef($value);
                break;
            case 2:
                $this->setVisuel($value);
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
        $keys = MetadataPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTableRef($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setVisuel($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MetadataPeer::DATABASE_NAME);

        if ($this->isColumnModified(MetadataPeer::ID)) $criteria->add(MetadataPeer::ID, $this->id);
        if ($this->isColumnModified(MetadataPeer::TABLE_REF)) $criteria->add(MetadataPeer::TABLE_REF, $this->table_ref);
        if ($this->isColumnModified(MetadataPeer::VISUEL)) $criteria->add(MetadataPeer::VISUEL, $this->visuel);

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
        $criteria = new Criteria(MetadataPeer::DATABASE_NAME);
        $criteria->add(MetadataPeer::ID, $this->id);

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
     * @param object $copyObj An object of Metadata (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTableRef($this->getTableRef());
        $copyObj->setVisuel($this->getVisuel());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getMetadataI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMetadataI18n($relObj->copy($deepCopy));
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
     * @return Metadata Clone of current object.
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
     * @return MetadataPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MetadataPeer();
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
        if ('MetadataI18n' == $relationName) {
            $this->initMetadataI18ns();
        }
    }

    /**
     * Clears out the collMetadataI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Metadata The current object (for fluent API support)
     * @see        addMetadataI18ns()
     */
    public function clearMetadataI18ns()
    {
        $this->collMetadataI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collMetadataI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collMetadataI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialMetadataI18ns($v = true)
    {
        $this->collMetadataI18nsPartial = $v;
    }

    /**
     * Initializes the collMetadataI18ns collection.
     *
     * By default this just sets the collMetadataI18ns collection to an empty array (like clearcollMetadataI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMetadataI18ns($overrideExisting = true)
    {
        if (null !== $this->collMetadataI18ns && !$overrideExisting) {
            return;
        }
        $this->collMetadataI18ns = new PropelObjectCollection();
        $this->collMetadataI18ns->setModel('MetadataI18n');
    }

    /**
     * Gets an array of MetadataI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Metadata is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MetadataI18n[] List of MetadataI18n objects
     * @throws PropelException
     */
    public function getMetadataI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMetadataI18nsPartial && !$this->isNew();
        if (null === $this->collMetadataI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMetadataI18ns) {
                // return empty collection
                $this->initMetadataI18ns();
            } else {
                $collMetadataI18ns = MetadataI18nQuery::create(null, $criteria)
                    ->filterByMetadata($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMetadataI18nsPartial && count($collMetadataI18ns)) {
                      $this->initMetadataI18ns(false);

                      foreach($collMetadataI18ns as $obj) {
                        if (false == $this->collMetadataI18ns->contains($obj)) {
                          $this->collMetadataI18ns->append($obj);
                        }
                      }

                      $this->collMetadataI18nsPartial = true;
                    }

                    return $collMetadataI18ns;
                }

                if($partial && $this->collMetadataI18ns) {
                    foreach($this->collMetadataI18ns as $obj) {
                        if($obj->isNew()) {
                            $collMetadataI18ns[] = $obj;
                        }
                    }
                }

                $this->collMetadataI18ns = $collMetadataI18ns;
                $this->collMetadataI18nsPartial = false;
            }
        }

        return $this->collMetadataI18ns;
    }

    /**
     * Sets a collection of MetadataI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $metadataI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Metadata The current object (for fluent API support)
     */
    public function setMetadataI18ns(PropelCollection $metadataI18ns, PropelPDO $con = null)
    {
        $this->metadataI18nsScheduledForDeletion = $this->getMetadataI18ns(new Criteria(), $con)->diff($metadataI18ns);

        foreach ($this->metadataI18nsScheduledForDeletion as $metadataI18nRemoved) {
            $metadataI18nRemoved->setMetadata(null);
        }

        $this->collMetadataI18ns = null;
        foreach ($metadataI18ns as $metadataI18n) {
            $this->addMetadataI18n($metadataI18n);
        }

        $this->collMetadataI18ns = $metadataI18ns;
        $this->collMetadataI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MetadataI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MetadataI18n objects.
     * @throws PropelException
     */
    public function countMetadataI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMetadataI18nsPartial && !$this->isNew();
        if (null === $this->collMetadataI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMetadataI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getMetadataI18ns());
            }
            $query = MetadataI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMetadata($this)
                ->count($con);
        }

        return count($this->collMetadataI18ns);
    }

    /**
     * Method called to associate a MetadataI18n object to this object
     * through the MetadataI18n foreign key attribute.
     *
     * @param    MetadataI18n $l MetadataI18n
     * @return Metadata The current object (for fluent API support)
     */
    public function addMetadataI18n(MetadataI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collMetadataI18ns === null) {
            $this->initMetadataI18ns();
            $this->collMetadataI18nsPartial = true;
        }
        if (!in_array($l, $this->collMetadataI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMetadataI18n($l);
        }

        return $this;
    }

    /**
     * @param	MetadataI18n $metadataI18n The metadataI18n object to add.
     */
    protected function doAddMetadataI18n($metadataI18n)
    {
        $this->collMetadataI18ns[]= $metadataI18n;
        $metadataI18n->setMetadata($this);
    }

    /**
     * @param	MetadataI18n $metadataI18n The metadataI18n object to remove.
     * @return Metadata The current object (for fluent API support)
     */
    public function removeMetadataI18n($metadataI18n)
    {
        if ($this->getMetadataI18ns()->contains($metadataI18n)) {
            $this->collMetadataI18ns->remove($this->collMetadataI18ns->search($metadataI18n));
            if (null === $this->metadataI18nsScheduledForDeletion) {
                $this->metadataI18nsScheduledForDeletion = clone $this->collMetadataI18ns;
                $this->metadataI18nsScheduledForDeletion->clear();
            }
            $this->metadataI18nsScheduledForDeletion[]= $metadataI18n;
            $metadataI18n->setMetadata(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->table_ref = null;
        $this->visuel = null;
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
            if ($this->collMetadataI18ns) {
                foreach ($this->collMetadataI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collMetadataI18ns instanceof PropelCollection) {
            $this->collMetadataI18ns->clearIterator();
        }
        $this->collMetadataI18ns = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MetadataPeer::DEFAULT_STRING_FORMAT);
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
        if (!$form['visuel_deleted']->getData())
        {
            $this->resetModified(MetadataPeer::VISUEL);
        }

        $this->uploadVisuel($form);

        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/metadatas';
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
    public function uploadVisuel(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['visuel']->getData()))
        {
            if ($form['visuel']->getData()) {
                $image = uniqid().'.'.$form['visuel']->getData()->guessExtension();
                $form['visuel']->getData()->move($this->getUploadRootDir(), $image);
                $this->setVisuel($this->getUploadDir() . '/' . $image);
            }
        }
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Metadata The current object (for fluent API support)
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
     * @return MetadataI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collMetadataI18ns) {
                foreach ($this->collMetadataI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new MetadataI18n();
                $translation->setLocale($locale);
            } else {
                $translation = MetadataI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addMetadataI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Metadata The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            MetadataI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collMetadataI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collMetadataI18ns[$key]);
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
     * @return MetadataI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [title] column value.
         *
         * @return string
         */
        public function getTitle()
        {
        return $this->getCurrentTranslation()->getTitle();
    }


        /**
         * Set the value of [title] column.
         *
         * @param string $v new value
         * @return MetadataI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }


        /**
         * Get the [subtitle] column value.
         *
         * @return string
         */
        public function getSubtitle()
        {
        return $this->getCurrentTranslation()->getSubtitle();
    }


        /**
         * Set the value of [subtitle] column.
         *
         * @param string $v new value
         * @return MetadataI18n The current object (for fluent API support)
         */
        public function setSubtitle($v)
        {    $this->getCurrentTranslation()->setSubtitle($v);

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
         * @return MetadataI18n The current object (for fluent API support)
         */
        public function setAccroche($v)
        {    $this->getCurrentTranslation()->setAccroche($v);

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
         * @return MetadataI18n The current object (for fluent API support)
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
         * @return MetadataI18n The current object (for fluent API support)
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
         * @return MetadataI18n The current object (for fluent API support)
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
         * @return MetadataI18n The current object (for fluent API support)
         */
        public function setSeoKeywords($v)
        {    $this->getCurrentTranslation()->setSeoKeywords($v);

        return $this;
    }

}
