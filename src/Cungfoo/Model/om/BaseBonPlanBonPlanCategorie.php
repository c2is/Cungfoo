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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanBonPlanCategorie;
use Cungfoo\Model\BonPlanBonPlanCategoriePeer;
use Cungfoo\Model\BonPlanBonPlanCategorieQuery;
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanCategorieQuery;
use Cungfoo\Model\BonPlanQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'bon_plan_bon_plan_categorie' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanBonPlanCategorie extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\BonPlanBonPlanCategoriePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BonPlanBonPlanCategoriePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the bon_plan_id field.
     * @var        int
     */
    protected $bon_plan_id;

    /**
     * The value for the bon_plan_categorie_id field.
     * @var        int
     */
    protected $bon_plan_categorie_id;

    /**
     * The value for the sortable_rank field.
     * @var        int
     */
    protected $sortable_rank;

    /**
     * @var        BonPlan
     */
    protected $aBonPlan;

    /**
     * @var        BonPlanCategorie
     */
    protected $aBonPlanCategorie;

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

    /**
     * The old scope value.
     * @var        int
     */
    protected $oldScope;

    /**
     * Get the [bon_plan_id] column value.
     *
     * @return int
     */
    public function getBonPlanId()
    {
        return $this->bon_plan_id;
    }

    /**
     * Get the [bon_plan_categorie_id] column value.
     *
     * @return int
     */
    public function getBonPlanCategorieId()
    {
        return $this->bon_plan_categorie_id;
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
     * Set the value of [bon_plan_id] column.
     *
     * @param int $v new value
     * @return BonPlanBonPlanCategorie The current object (for fluent API support)
     */
    public function setBonPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bon_plan_id !== $v) {
            $this->bon_plan_id = $v;
            $this->modifiedColumns[] = BonPlanBonPlanCategoriePeer::BON_PLAN_ID;
        }

        if ($this->aBonPlan !== null && $this->aBonPlan->getId() !== $v) {
            $this->aBonPlan = null;
        }


        return $this;
    } // setBonPlanId()

    /**
     * Set the value of [bon_plan_categorie_id] column.
     *
     * @param int $v new value
     * @return BonPlanBonPlanCategorie The current object (for fluent API support)
     */
    public function setBonPlanCategorieId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bon_plan_categorie_id !== $v) {
            // sortable behavior
            $this->oldScope = $this->getBonPlanCategorieId();

            $this->bon_plan_categorie_id = $v;
            $this->modifiedColumns[] = BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID;
        }

        if ($this->aBonPlanCategorie !== null && $this->aBonPlanCategorie->getId() !== $v) {
            $this->aBonPlanCategorie = null;
        }


        return $this;
    } // setBonPlanCategorieId()

    /**
     * Set the value of [sortable_rank] column.
     *
     * @param int $v new value
     * @return BonPlanBonPlanCategorie The current object (for fluent API support)
     */
    public function setSortableRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sortable_rank !== $v) {
            $this->sortable_rank = $v;
            $this->modifiedColumns[] = BonPlanBonPlanCategoriePeer::SORTABLE_RANK;
        }


        return $this;
    } // setSortableRank()

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

            $this->bon_plan_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->bon_plan_categorie_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->sortable_rank = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BonPlanBonPlanCategorie object", $e);
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

        if ($this->aBonPlan !== null && $this->bon_plan_id !== $this->aBonPlan->getId()) {
            $this->aBonPlan = null;
        }
        if ($this->aBonPlanCategorie !== null && $this->bon_plan_categorie_id !== $this->aBonPlanCategorie->getId()) {
            $this->aBonPlanCategorie = null;
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
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BonPlanBonPlanCategoriePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBonPlan = null;
            $this->aBonPlanCategorie = null;
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
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BonPlanBonPlanCategorieQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // sortable behavior

            BonPlanBonPlanCategoriePeer::shiftRank(-1, $this->getSortableRank() + 1, null, $this->getBonPlanCategorieId(), $con);
            BonPlanBonPlanCategoriePeer::clearInstancePool();

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
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                if (!$this->isColumnModified(BonPlanBonPlanCategoriePeer::RANK_COL)) {
                    $this->setSortableRank(BonPlanBonPlanCategorieQuery::create()->getMaxRank($this->getBonPlanCategorieId(), $con) + 1);
                }

            } else {
                $ret = $ret && $this->preUpdate($con);
                // sortable behavior
                // if scope has changed and rank was not modified (if yes, assuming superior action)
                // insert object to the end of new scope and cleanup old one
                if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::SCOPE_COL) && !$this->isColumnModified(BonPlanBonPlanCategoriePeer::RANK_COL)) {
                    BonPlanBonPlanCategoriePeer::shiftRank(-1, $this->getSortableRank() + 1, null, $this->oldScope, $con);
                    $this->insertAtBottom($con);
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
                BonPlanBonPlanCategoriePeer::addInstanceToPool($this);
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

            if ($this->aBonPlan !== null) {
                if ($this->aBonPlan->isModified() || $this->aBonPlan->isNew()) {
                    $affectedRows += $this->aBonPlan->save($con);
                }
                $this->setBonPlan($this->aBonPlan);
            }

            if ($this->aBonPlanCategorie !== null) {
                if ($this->aBonPlanCategorie->isModified() || $this->aBonPlanCategorie->isNew()) {
                    $affectedRows += $this->aBonPlanCategorie->save($con);
                }
                $this->setBonPlanCategorie($this->aBonPlanCategorie);
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
        if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::BON_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bon_plan_id`';
        }
        if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bon_plan_categorie_id`';
        }
        if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::SORTABLE_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`sortable_rank`';
        }

        $sql = sprintf(
            'INSERT INTO `bon_plan_bon_plan_categorie` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`bon_plan_id`':
                        $stmt->bindValue($identifier, $this->bon_plan_id, PDO::PARAM_INT);
                        break;
                    case '`bon_plan_categorie_id`':
                        $stmt->bindValue($identifier, $this->bon_plan_categorie_id, PDO::PARAM_INT);
                        break;
                    case '`sortable_rank`':
                        $stmt->bindValue($identifier, $this->sortable_rank, PDO::PARAM_INT);
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

            if ($this->aBonPlan !== null) {
                if (!$this->aBonPlan->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBonPlan->getValidationFailures());
                }
            }

            if ($this->aBonPlanCategorie !== null) {
                if (!$this->aBonPlanCategorie->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBonPlanCategorie->getValidationFailures());
                }
            }


            if (($retval = BonPlanBonPlanCategoriePeer::doValidate($this, $columns)) !== true) {
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
        $pos = BonPlanBonPlanCategoriePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getBonPlanId();
                break;
            case 1:
                return $this->getBonPlanCategorieId();
                break;
            case 2:
                return $this->getSortableRank();
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
        if (isset($alreadyDumpedObjects['BonPlanBonPlanCategorie'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BonPlanBonPlanCategorie'][serialize($this->getPrimaryKey())] = true;
        $keys = BonPlanBonPlanCategoriePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBonPlanId(),
            $keys[1] => $this->getBonPlanCategorieId(),
            $keys[2] => $this->getSortableRank(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aBonPlan) {
                $result['BonPlan'] = $this->aBonPlan->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBonPlanCategorie) {
                $result['BonPlanCategorie'] = $this->aBonPlanCategorie->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = BonPlanBonPlanCategoriePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setBonPlanId($value);
                break;
            case 1:
                $this->setBonPlanCategorieId($value);
                break;
            case 2:
                $this->setSortableRank($value);
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
        $keys = BonPlanBonPlanCategoriePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setBonPlanId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setBonPlanCategorieId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSortableRank($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::BON_PLAN_ID)) $criteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $this->bon_plan_id);
        if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID)) $criteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $this->bon_plan_categorie_id);
        if ($this->isColumnModified(BonPlanBonPlanCategoriePeer::SORTABLE_RANK)) $criteria->add(BonPlanBonPlanCategoriePeer::SORTABLE_RANK, $this->sortable_rank);

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
        $criteria = new Criteria(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        $criteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $this->bon_plan_id);
        $criteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $this->bon_plan_categorie_id);

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
        $pks[0] = $this->getBonPlanId();
        $pks[1] = $this->getBonPlanCategorieId();

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
        $this->setBonPlanId($keys[0]);
        $this->setBonPlanCategorieId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getBonPlanId()) && (null === $this->getBonPlanCategorieId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of BonPlanBonPlanCategorie (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBonPlanId($this->getBonPlanId());
        $copyObj->setBonPlanCategorieId($this->getBonPlanCategorieId());
        $copyObj->setSortableRank($this->getSortableRank());

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
     * @return BonPlanBonPlanCategorie Clone of current object.
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
     * @return BonPlanBonPlanCategoriePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BonPlanBonPlanCategoriePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a BonPlan object.
     *
     * @param             BonPlan $v
     * @return BonPlanBonPlanCategorie The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBonPlan(BonPlan $v = null)
    {
        if ($v === null) {
            $this->setBonPlanId(NULL);
        } else {
            $this->setBonPlanId($v->getId());
        }

        $this->aBonPlan = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BonPlan object, it will not be re-added.
        if ($v !== null) {
            $v->addBonPlanBonPlanCategorie($this);
        }


        return $this;
    }


    /**
     * Get the associated BonPlan object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return BonPlan The associated BonPlan object.
     * @throws PropelException
     */
    public function getBonPlan(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBonPlan === null && ($this->bon_plan_id !== null) && $doQuery) {
            $this->aBonPlan = BonPlanQuery::create()->findPk($this->bon_plan_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBonPlan->addBonPlanBonPlanCategories($this);
             */
        }

        return $this->aBonPlan;
    }

    /**
     * Declares an association between this object and a BonPlanCategorie object.
     *
     * @param             BonPlanCategorie $v
     * @return BonPlanBonPlanCategorie The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBonPlanCategorie(BonPlanCategorie $v = null)
    {
        if ($v === null) {
            $this->setBonPlanCategorieId(NULL);
        } else {
            $this->setBonPlanCategorieId($v->getId());
        }

        $this->aBonPlanCategorie = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BonPlanCategorie object, it will not be re-added.
        if ($v !== null) {
            $v->addBonPlanBonPlanCategorie($this);
        }


        return $this;
    }


    /**
     * Get the associated BonPlanCategorie object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return BonPlanCategorie The associated BonPlanCategorie object.
     * @throws PropelException
     */
    public function getBonPlanCategorie(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBonPlanCategorie === null && ($this->bon_plan_categorie_id !== null) && $doQuery) {
            $this->aBonPlanCategorie = BonPlanCategorieQuery::create()->findPk($this->bon_plan_categorie_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBonPlanCategorie->addBonPlanBonPlanCategories($this);
             */
        }

        return $this->aBonPlanCategorie;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->bon_plan_id = null;
        $this->bon_plan_categorie_id = null;
        $this->sortable_rank = null;
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

        $this->aBonPlan = null;
        $this->aBonPlanCategorie = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BonPlanBonPlanCategoriePeer::DEFAULT_STRING_FORMAT);
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
     * @return    BonPlanBonPlanCategorie
     */
    public function setRank($v)
    {
        return $this->setSortableRank($v);
    }


    /**
     * Wrap the getter for scope value
     *
     * @return    int
     */
    public function getScopeValue()
    {
        return $this->bon_plan_categorie_id;
    }

    /**
     * Wrap the setter for scope value
     *
     * @param     int
     * @return    BonPlanBonPlanCategorie
     */
    public function setScopeValue($v)
    {
        return $this->setBonPlanCategorieId($v);
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
        return $this->getSortableRank() == BonPlanBonPlanCategorieQuery::create()->getMaxRank($this->getBonPlanCategorieId(), $con);
    }

    /**
     * Get the next item in the list, i.e. the one for which rank is immediately higher
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    BonPlanBonPlanCategorie
     */
    public function getNext(PropelPDO $con = null)
    {

        return BonPlanBonPlanCategorieQuery::create()->findOneByRank($this->getSortableRank() + 1, $this->getBonPlanCategorieId(), $con);
    }

    /**
     * Get the previous item in the list, i.e. the one for which rank is immediately lower
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    BonPlanBonPlanCategorie
     */
    public function getPrevious(PropelPDO $con = null)
    {

        return BonPlanBonPlanCategorieQuery::create()->findOneByRank($this->getSortableRank() - 1, $this->getBonPlanCategorieId(), $con);
    }

    /**
     * Insert at specified rank
     * The modifications are not persisted until the object is saved.
     *
     * @param     integer    $rank rank value
     * @param     PropelPDO  $con      optional connection
     *
     * @return    BonPlanBonPlanCategorie the current object
     *
     * @throws    PropelException
     */
    public function insertAtRank($rank, PropelPDO $con = null)
    {
        $maxRank = BonPlanBonPlanCategorieQuery::create()->getMaxRank($this->getBonPlanCategorieId(), $con);
        if ($rank < 1 || $rank > $maxRank + 1) {
            throw new PropelException('Invalid rank ' . $rank);
        }
        // move the object in the list, at the given rank
        $this->setSortableRank($rank);
        if ($rank != $maxRank + 1) {
            // Keep the list modification query for the save() transaction
            $this->sortableQueries []= array(
                'callable'  => array(self::PEER, 'shiftRank'),
                'arguments' => array(1, $rank, null, $this->getBonPlanCategorieId())
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
     * @return    BonPlanBonPlanCategorie the current object
     *
     * @throws    PropelException
     */
    public function insertAtBottom(PropelPDO $con = null)
    {
        $this->setSortableRank(BonPlanBonPlanCategorieQuery::create()->getMaxRank($this->getBonPlanCategorieId(), $con) + 1);

        return $this;
    }

    /**
     * Insert in the first rank
     * The modifications are not persisted until the object is saved.
     *
     * @return    BonPlanBonPlanCategorie the current object
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
     * @return    BonPlanBonPlanCategorie the current object
     *
     * @throws    PropelException
     */
    public function moveToRank($newRank, PropelPDO $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be moved. Please use insertAtRank() instead');
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }
        if ($newRank < 1 || $newRank > BonPlanBonPlanCategorieQuery::create()->getMaxRank($this->getBonPlanCategorieId(), $con)) {
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
            BonPlanBonPlanCategoriePeer::shiftRank($delta, min($oldRank, $newRank), max($oldRank, $newRank), $this->getBonPlanCategorieId(), $con);

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
     * @param     BonPlanBonPlanCategorie $object
     * @param     PropelPDO $con optional connection
     *
     * @return    BonPlanBonPlanCategorie the current object
     *
     * @throws Exception if the database cannot execute the two updates
     */
    public function swapWith($object, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $oldScope = $this->getBonPlanCategorieId();
            $newScope = $object->getBonPlanCategorieId();
            if ($oldScope != $newScope) {
                $this->setBonPlanCategorieId($newScope);
                $object->setBonPlanCategorieId($oldScope);
            }
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
     * @return    BonPlanBonPlanCategorie the current object
     */
    public function moveUp(PropelPDO $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
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
     * @return    BonPlanBonPlanCategorie the current object
     */
    public function moveDown(PropelPDO $con = null)
    {
        if ($this->isLast($con)) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
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
     * @return    BonPlanBonPlanCategorie the current object
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
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $bottom = BonPlanBonPlanCategorieQuery::create()->getMaxRank($this->getBonPlanCategorieId(), $con);
            $res = $this->moveToRank($bottom, $con);
            $con->commit();

            return $res;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Removes the current object from the list (moves it to the null scope).
     * The modifications are not persisted until the object is saved.
     *
     * @param     PropelPDO $con optional connection
     *
     * @return    BonPlanBonPlanCategorie the current object
     */
    public function removeFromList(PropelPDO $con = null)
    {
        // check if object is already removed
        if ($this->getBonPlanCategorieId() === null) {
            throw new PropelException('Object is already removed (has null scope)');
        }

        // move the object to the end of null scope
        $this->setBonPlanCategorieId(null);
    //    $this->insertAtBottom($con);

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

}
