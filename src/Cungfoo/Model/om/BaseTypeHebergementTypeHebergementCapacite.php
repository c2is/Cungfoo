<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementCapacite;
use Cungfoo\Model\TypeHebergementCapaciteQuery;
use Cungfoo\Model\TypeHebergementQuery;
use Cungfoo\Model\TypeHebergementTypeHebergementCapacite;
use Cungfoo\Model\TypeHebergementTypeHebergementCapacitePeer;
use Cungfoo\Model\TypeHebergementTypeHebergementCapaciteQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'type_hebergement_type_hebergement_capacite' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergementTypeHebergementCapacite extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\TypeHebergementTypeHebergementCapacitePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TypeHebergementTypeHebergementCapacitePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the type_hebergement_id field.
     * @var        int
     */
    protected $type_hebergement_id;

    /**
     * The value for the type_hebergement_capacite_id field.
     * @var        int
     */
    protected $type_hebergement_capacite_id;

    /**
     * @var        TypeHebergement
     */
    protected $aTypeHebergement;

    /**
     * @var        TypeHebergementCapacite
     */
    protected $aTypeHebergementCapacite;

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
     * Get the [type_hebergement_id] column value.
     *
     * @return int
     */
    public function getTypeHebergementId()
    {
        return $this->type_hebergement_id;
    }

    /**
     * Get the [type_hebergement_capacite_id] column value.
     *
     * @return int
     */
    public function getTypeHebergementCapaciteId()
    {
        return $this->type_hebergement_capacite_id;
    }

    /**
     * Set the value of [type_hebergement_id] column.
     *
     * @param int $v new value
     * @return TypeHebergementTypeHebergementCapacite The current object (for fluent API support)
     */
    public function setTypeHebergementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_hebergement_id !== $v) {
            $this->type_hebergement_id = $v;
            $this->modifiedColumns[] = TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_ID;
        }

        if ($this->aTypeHebergement !== null && $this->aTypeHebergement->getId() !== $v) {
            $this->aTypeHebergement = null;
        }


        return $this;
    } // setTypeHebergementId()

    /**
     * Set the value of [type_hebergement_capacite_id] column.
     *
     * @param int $v new value
     * @return TypeHebergementTypeHebergementCapacite The current object (for fluent API support)
     */
    public function setTypeHebergementCapaciteId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_hebergement_capacite_id !== $v) {
            $this->type_hebergement_capacite_id = $v;
            $this->modifiedColumns[] = TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_CAPACITE_ID;
        }

        if ($this->aTypeHebergementCapacite !== null && $this->aTypeHebergementCapacite->getId() !== $v) {
            $this->aTypeHebergementCapacite = null;
        }


        return $this;
    } // setTypeHebergementCapaciteId()

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

            $this->type_hebergement_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->type_hebergement_capacite_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 2; // 2 = TypeHebergementTypeHebergementCapacitePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TypeHebergementTypeHebergementCapacite object", $e);
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

        if ($this->aTypeHebergement !== null && $this->type_hebergement_id !== $this->aTypeHebergement->getId()) {
            $this->aTypeHebergement = null;
        }
        if ($this->aTypeHebergementCapacite !== null && $this->type_hebergement_capacite_id !== $this->aTypeHebergementCapacite->getId()) {
            $this->aTypeHebergementCapacite = null;
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
            $con = Propel::getConnection(TypeHebergementTypeHebergementCapacitePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TypeHebergementTypeHebergementCapacitePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTypeHebergement = null;
            $this->aTypeHebergementCapacite = null;
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
            $con = Propel::getConnection(TypeHebergementTypeHebergementCapacitePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TypeHebergementTypeHebergementCapaciteQuery::create()
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
            $con = Propel::getConnection(TypeHebergementTypeHebergementCapacitePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TypeHebergementTypeHebergementCapacitePeer::addInstanceToPool($this);
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

            if ($this->aTypeHebergement !== null) {
                if ($this->aTypeHebergement->isModified() || $this->aTypeHebergement->isNew()) {
                    $affectedRows += $this->aTypeHebergement->save($con);
                }
                $this->setTypeHebergement($this->aTypeHebergement);
            }

            if ($this->aTypeHebergementCapacite !== null) {
                if ($this->aTypeHebergementCapacite->isModified() || $this->aTypeHebergementCapacite->isNew()) {
                    $affectedRows += $this->aTypeHebergementCapacite->save($con);
                }
                $this->setTypeHebergementCapacite($this->aTypeHebergementCapacite);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`type_hebergement_id`';
        }
        if ($this->isColumnModified(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_CAPACITE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`type_hebergement_capacite_id`';
        }

        $sql = sprintf(
            'INSERT INTO `type_hebergement_type_hebergement_capacite` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`type_hebergement_id`':
                        $stmt->bindValue($identifier, $this->type_hebergement_id, PDO::PARAM_INT);
                        break;
                    case '`type_hebergement_capacite_id`':
                        $stmt->bindValue($identifier, $this->type_hebergement_capacite_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

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

            if ($this->aTypeHebergement !== null) {
                if (!$this->aTypeHebergement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeHebergement->getValidationFailures());
                }
            }

            if ($this->aTypeHebergementCapacite !== null) {
                if (!$this->aTypeHebergementCapacite->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeHebergementCapacite->getValidationFailures());
                }
            }


            if (($retval = TypeHebergementTypeHebergementCapacitePeer::doValidate($this, $columns)) !== true) {
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
        $pos = TypeHebergementTypeHebergementCapacitePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getTypeHebergementId();
                break;
            case 1:
                return $this->getTypeHebergementCapaciteId();
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
        if (isset($alreadyDumpedObjects['TypeHebergementTypeHebergementCapacite'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TypeHebergementTypeHebergementCapacite'][serialize($this->getPrimaryKey())] = true;
        $keys = TypeHebergementTypeHebergementCapacitePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getTypeHebergementId(),
            $keys[1] => $this->getTypeHebergementCapaciteId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTypeHebergement) {
                $result['TypeHebergement'] = $this->aTypeHebergement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTypeHebergementCapacite) {
                $result['TypeHebergementCapacite'] = $this->aTypeHebergementCapacite->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TypeHebergementTypeHebergementCapacitePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setTypeHebergementId($value);
                break;
            case 1:
                $this->setTypeHebergementCapaciteId($value);
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
        $keys = TypeHebergementTypeHebergementCapacitePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setTypeHebergementId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTypeHebergementCapaciteId($arr[$keys[1]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TypeHebergementTypeHebergementCapacitePeer::DATABASE_NAME);

        if ($this->isColumnModified(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_ID)) $criteria->add(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_ID, $this->type_hebergement_id);
        if ($this->isColumnModified(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_CAPACITE_ID)) $criteria->add(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_CAPACITE_ID, $this->type_hebergement_capacite_id);

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
        $criteria = new Criteria(TypeHebergementTypeHebergementCapacitePeer::DATABASE_NAME);
        $criteria->add(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_ID, $this->type_hebergement_id);
        $criteria->add(TypeHebergementTypeHebergementCapacitePeer::TYPE_HEBERGEMENT_CAPACITE_ID, $this->type_hebergement_capacite_id);

        return $criteria;
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getTypeHebergementId();
        $pks[1] = $this->getTypeHebergementCapaciteId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setTypeHebergementId($keys[0]);
        $this->setTypeHebergementCapaciteId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getTypeHebergementId()) && (null === $this->getTypeHebergementCapaciteId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of TypeHebergementTypeHebergementCapacite (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTypeHebergementId($this->getTypeHebergementId());
        $copyObj->setTypeHebergementCapaciteId($this->getTypeHebergementCapaciteId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return TypeHebergementTypeHebergementCapacite Clone of current object.
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
     * @return TypeHebergementTypeHebergementCapacitePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TypeHebergementTypeHebergementCapacitePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TypeHebergement object.
     *
     * @param             TypeHebergement $v
     * @return TypeHebergementTypeHebergementCapacite The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTypeHebergement(TypeHebergement $v = null)
    {
        if ($v === null) {
            $this->setTypeHebergementId(NULL);
        } else {
            $this->setTypeHebergementId($v->getId());
        }

        $this->aTypeHebergement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TypeHebergement object, it will not be re-added.
        if ($v !== null) {
            $v->addTypeHebergementTypeHebergementCapacite($this);
        }


        return $this;
    }


    /**
     * Get the associated TypeHebergement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return TypeHebergement The associated TypeHebergement object.
     * @throws PropelException
     */
    public function getTypeHebergement(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTypeHebergement === null && ($this->type_hebergement_id !== null) && $doQuery) {
            $this->aTypeHebergement = TypeHebergementQuery::create()->findPk($this->type_hebergement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypeHebergement->addTypeHebergementTypeHebergementCapacites($this);
             */
        }

        return $this->aTypeHebergement;
    }

    /**
     * Declares an association between this object and a TypeHebergementCapacite object.
     *
     * @param             TypeHebergementCapacite $v
     * @return TypeHebergementTypeHebergementCapacite The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTypeHebergementCapacite(TypeHebergementCapacite $v = null)
    {
        if ($v === null) {
            $this->setTypeHebergementCapaciteId(NULL);
        } else {
            $this->setTypeHebergementCapaciteId($v->getId());
        }

        $this->aTypeHebergementCapacite = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TypeHebergementCapacite object, it will not be re-added.
        if ($v !== null) {
            $v->addTypeHebergementTypeHebergementCapacite($this);
        }


        return $this;
    }


    /**
     * Get the associated TypeHebergementCapacite object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return TypeHebergementCapacite The associated TypeHebergementCapacite object.
     * @throws PropelException
     */
    public function getTypeHebergementCapacite(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTypeHebergementCapacite === null && ($this->type_hebergement_capacite_id !== null) && $doQuery) {
            $this->aTypeHebergementCapacite = TypeHebergementCapaciteQuery::create()->findPk($this->type_hebergement_capacite_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypeHebergementCapacite->addTypeHebergementTypeHebergementCapacites($this);
             */
        }

        return $this->aTypeHebergementCapacite;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->type_hebergement_id = null;
        $this->type_hebergement_capacite_id = null;
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

        $this->aTypeHebergement = null;
        $this->aTypeHebergementCapacite = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TypeHebergementTypeHebergementCapacitePeer::DEFAULT_STRING_FORMAT);
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

}
