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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanBonPlanCategorie;
use Cungfoo\Model\BonPlanBonPlanCategorieQuery;
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanCategorieI18n;
use Cungfoo\Model\BonPlanCategorieI18nQuery;
use Cungfoo\Model\BonPlanCategoriePeer;
use Cungfoo\Model\BonPlanCategorieQuery;
use Cungfoo\Model\BonPlanQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'bon_plan_categorie' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanCategorie extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\BonPlanCategoriePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BonPlanCategoriePeer
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
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the sortable_rank field.
     * @var        int
     */
    protected $sortable_rank;

    /**
     * @var        PropelObjectCollection|BonPlanBonPlanCategorie[] Collection to store aggregation of BonPlanBonPlanCategorie objects.
     */
    protected $collBonPlanBonPlanCategories;
    protected $collBonPlanBonPlanCategoriesPartial;

    /**
     * @var        PropelObjectCollection|BonPlanCategorieI18n[] Collection to store aggregation of BonPlanCategorieI18n objects.
     */
    protected $collBonPlanCategorieI18ns;
    protected $collBonPlanCategorieI18nsPartial;

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
     * @var        array[BonPlanCategorieI18n]
     */
    protected $currentTranslations;

    // sortable behavior

    /**
     * Queries to be executed in the save transaction
     * @var        array
     */
    protected $sortableQueries = array();

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanBonPlanCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanCategorieI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseBonPlanCategorie object.
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
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BonPlanCategoriePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return BonPlanCategorie The current object (for fluent API support)
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
            $this->modifiedColumns[] = BonPlanCategoriePeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Set the value of [sortable_rank] column.
     *
     * @param int $v new value
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function setSortableRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sortable_rank !== $v) {
            $this->sortable_rank = $v;
            $this->modifiedColumns[] = BonPlanCategoriePeer::SORTABLE_RANK;
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
            $this->active = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
            $this->sortable_rank = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = BonPlanCategoriePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BonPlanCategorie object", $e);
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
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BonPlanCategoriePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBonPlanBonPlanCategories = null;

            $this->collBonPlanCategorieI18ns = null;

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
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BonPlanCategorieQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // sortable behavior

            BonPlanCategoriePeer::shiftRank(-1, $this->getSortableRank() + 1, null, $con);
            BonPlanCategoriePeer::clearInstancePool();

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
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                if (!$this->isColumnModified(BonPlanCategoriePeer::RANK_COL)) {
                    $this->setSortableRank(BonPlanCategorieQuery::create()->getMaxRank($con) + 1);
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
                BonPlanCategoriePeer::addInstanceToPool($this);
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

            if ($this->bonPlansScheduledForDeletion !== null) {
                if (!$this->bonPlansScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->bonPlansScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    BonPlanBonPlanCategorieQuery::create()
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

            if ($this->bonPlanBonPlanCategoriesScheduledForDeletion !== null) {
                if (!$this->bonPlanBonPlanCategoriesScheduledForDeletion->isEmpty()) {
                    BonPlanBonPlanCategorieQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanBonPlanCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanBonPlanCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanBonPlanCategories !== null) {
                foreach ($this->collBonPlanBonPlanCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bonPlanCategorieI18nsScheduledForDeletion !== null) {
                if (!$this->bonPlanCategorieI18nsScheduledForDeletion->isEmpty()) {
                    BonPlanCategorieI18nQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanCategorieI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanCategorieI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanCategorieI18ns !== null) {
                foreach ($this->collBonPlanCategorieI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = BonPlanCategoriePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BonPlanCategoriePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BonPlanCategoriePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(BonPlanCategoriePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(BonPlanCategoriePeer::SORTABLE_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`sortable_rank`';
        }

        $sql = sprintf(
            'INSERT INTO `bon_plan_categorie` (%s) VALUES (%s)',
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
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
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


            if (($retval = BonPlanCategoriePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBonPlanBonPlanCategories !== null) {
                    foreach ($this->collBonPlanBonPlanCategories as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBonPlanCategorieI18ns !== null) {
                    foreach ($this->collBonPlanCategorieI18ns as $referrerFK) {
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
        $pos = BonPlanCategoriePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getActive();
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
        if (isset($alreadyDumpedObjects['BonPlanCategorie'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BonPlanCategorie'][$this->getPrimaryKey()] = true;
        $keys = BonPlanCategoriePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getActive(),
            $keys[2] => $this->getSortableRank(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collBonPlanBonPlanCategories) {
                $result['BonPlanBonPlanCategories'] = $this->collBonPlanBonPlanCategories->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanCategorieI18ns) {
                $result['BonPlanCategorieI18ns'] = $this->collBonPlanCategorieI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BonPlanCategoriePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setActive($value);
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
        $keys = BonPlanCategoriePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setActive($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSortableRank($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BonPlanCategoriePeer::DATABASE_NAME);

        if ($this->isColumnModified(BonPlanCategoriePeer::ID)) $criteria->add(BonPlanCategoriePeer::ID, $this->id);
        if ($this->isColumnModified(BonPlanCategoriePeer::ACTIVE)) $criteria->add(BonPlanCategoriePeer::ACTIVE, $this->active);
        if ($this->isColumnModified(BonPlanCategoriePeer::SORTABLE_RANK)) $criteria->add(BonPlanCategoriePeer::SORTABLE_RANK, $this->sortable_rank);

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
        $criteria = new Criteria(BonPlanCategoriePeer::DATABASE_NAME);
        $criteria->add(BonPlanCategoriePeer::ID, $this->id);

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
     * @param object $copyObj An object of BonPlanCategorie (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setActive($this->getActive());
        $copyObj->setSortableRank($this->getSortableRank());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBonPlanBonPlanCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanBonPlanCategorie($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanCategorieI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanCategorieI18n($relObj->copy($deepCopy));
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
     * @return BonPlanCategorie Clone of current object.
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
     * @return BonPlanCategoriePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BonPlanCategoriePeer();
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
        if ('BonPlanBonPlanCategorie' == $relationName) {
            $this->initBonPlanBonPlanCategories();
        }
        if ('BonPlanCategorieI18n' == $relationName) {
            $this->initBonPlanCategorieI18ns();
        }
    }

    /**
     * Clears out the collBonPlanBonPlanCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlanCategorie The current object (for fluent API support)
     * @see        addBonPlanBonPlanCategories()
     */
    public function clearBonPlanBonPlanCategories()
    {
        $this->collBonPlanBonPlanCategories = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanBonPlanCategoriesPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanBonPlanCategories collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanBonPlanCategories($v = true)
    {
        $this->collBonPlanBonPlanCategoriesPartial = $v;
    }

    /**
     * Initializes the collBonPlanBonPlanCategories collection.
     *
     * By default this just sets the collBonPlanBonPlanCategories collection to an empty array (like clearcollBonPlanBonPlanCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanBonPlanCategories($overrideExisting = true)
    {
        if (null !== $this->collBonPlanBonPlanCategories && !$overrideExisting) {
            return;
        }
        $this->collBonPlanBonPlanCategories = new PropelObjectCollection();
        $this->collBonPlanBonPlanCategories->setModel('BonPlanBonPlanCategorie');
    }

    /**
     * Gets an array of BonPlanBonPlanCategorie objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlanCategorie is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanBonPlanCategorie[] List of BonPlanBonPlanCategorie objects
     * @throws PropelException
     */
    public function getBonPlanBonPlanCategories($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanBonPlanCategoriesPartial && !$this->isNew();
        if (null === $this->collBonPlanBonPlanCategories || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanBonPlanCategories) {
                // return empty collection
                $this->initBonPlanBonPlanCategories();
            } else {
                $collBonPlanBonPlanCategories = BonPlanBonPlanCategorieQuery::create(null, $criteria)
                    ->filterByBonPlanCategorie($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanBonPlanCategoriesPartial && count($collBonPlanBonPlanCategories)) {
                      $this->initBonPlanBonPlanCategories(false);

                      foreach($collBonPlanBonPlanCategories as $obj) {
                        if (false == $this->collBonPlanBonPlanCategories->contains($obj)) {
                          $this->collBonPlanBonPlanCategories->append($obj);
                        }
                      }

                      $this->collBonPlanBonPlanCategoriesPartial = true;
                    }

                    return $collBonPlanBonPlanCategories;
                }

                if($partial && $this->collBonPlanBonPlanCategories) {
                    foreach($this->collBonPlanBonPlanCategories as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanBonPlanCategories[] = $obj;
                        }
                    }
                }

                $this->collBonPlanBonPlanCategories = $collBonPlanBonPlanCategories;
                $this->collBonPlanBonPlanCategoriesPartial = false;
            }
        }

        return $this->collBonPlanBonPlanCategories;
    }

    /**
     * Sets a collection of BonPlanBonPlanCategorie objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanBonPlanCategories A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function setBonPlanBonPlanCategories(PropelCollection $bonPlanBonPlanCategories, PropelPDO $con = null)
    {
        $this->bonPlanBonPlanCategoriesScheduledForDeletion = $this->getBonPlanBonPlanCategories(new Criteria(), $con)->diff($bonPlanBonPlanCategories);

        foreach ($this->bonPlanBonPlanCategoriesScheduledForDeletion as $bonPlanBonPlanCategorieRemoved) {
            $bonPlanBonPlanCategorieRemoved->setBonPlanCategorie(null);
        }

        $this->collBonPlanBonPlanCategories = null;
        foreach ($bonPlanBonPlanCategories as $bonPlanBonPlanCategorie) {
            $this->addBonPlanBonPlanCategorie($bonPlanBonPlanCategorie);
        }

        $this->collBonPlanBonPlanCategories = $bonPlanBonPlanCategories;
        $this->collBonPlanBonPlanCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanBonPlanCategorie objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanBonPlanCategorie objects.
     * @throws PropelException
     */
    public function countBonPlanBonPlanCategories(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanBonPlanCategoriesPartial && !$this->isNew();
        if (null === $this->collBonPlanBonPlanCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanBonPlanCategories) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanBonPlanCategories());
            }
            $query = BonPlanBonPlanCategorieQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBonPlanCategorie($this)
                ->count($con);
        }

        return count($this->collBonPlanBonPlanCategories);
    }

    /**
     * Method called to associate a BonPlanBonPlanCategorie object to this object
     * through the BonPlanBonPlanCategorie foreign key attribute.
     *
     * @param    BonPlanBonPlanCategorie $l BonPlanBonPlanCategorie
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function addBonPlanBonPlanCategorie(BonPlanBonPlanCategorie $l)
    {
        if ($this->collBonPlanBonPlanCategories === null) {
            $this->initBonPlanBonPlanCategories();
            $this->collBonPlanBonPlanCategoriesPartial = true;
        }
        if (!in_array($l, $this->collBonPlanBonPlanCategories->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanBonPlanCategorie($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanBonPlanCategorie $bonPlanBonPlanCategorie The bonPlanBonPlanCategorie object to add.
     */
    protected function doAddBonPlanBonPlanCategorie($bonPlanBonPlanCategorie)
    {
        $this->collBonPlanBonPlanCategories[]= $bonPlanBonPlanCategorie;
        $bonPlanBonPlanCategorie->setBonPlanCategorie($this);
    }

    /**
     * @param	BonPlanBonPlanCategorie $bonPlanBonPlanCategorie The bonPlanBonPlanCategorie object to remove.
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function removeBonPlanBonPlanCategorie($bonPlanBonPlanCategorie)
    {
        if ($this->getBonPlanBonPlanCategories()->contains($bonPlanBonPlanCategorie)) {
            $this->collBonPlanBonPlanCategories->remove($this->collBonPlanBonPlanCategories->search($bonPlanBonPlanCategorie));
            if (null === $this->bonPlanBonPlanCategoriesScheduledForDeletion) {
                $this->bonPlanBonPlanCategoriesScheduledForDeletion = clone $this->collBonPlanBonPlanCategories;
                $this->bonPlanBonPlanCategoriesScheduledForDeletion->clear();
            }
            $this->bonPlanBonPlanCategoriesScheduledForDeletion[]= $bonPlanBonPlanCategorie;
            $bonPlanBonPlanCategorie->setBonPlanCategorie(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BonPlanCategorie is new, it will return
     * an empty collection; or if this BonPlanCategorie has previously
     * been saved, it will retrieve related BonPlanBonPlanCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BonPlanCategorie.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanBonPlanCategorie[] List of BonPlanBonPlanCategorie objects
     */
    public function getBonPlanBonPlanCategoriesJoinBonPlan($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanBonPlanCategorieQuery::create(null, $criteria);
        $query->joinWith('BonPlan', $join_behavior);

        return $this->getBonPlanBonPlanCategories($query, $con);
    }

    /**
     * Clears out the collBonPlanCategorieI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlanCategorie The current object (for fluent API support)
     * @see        addBonPlanCategorieI18ns()
     */
    public function clearBonPlanCategorieI18ns()
    {
        $this->collBonPlanCategorieI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanCategorieI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanCategorieI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanCategorieI18ns($v = true)
    {
        $this->collBonPlanCategorieI18nsPartial = $v;
    }

    /**
     * Initializes the collBonPlanCategorieI18ns collection.
     *
     * By default this just sets the collBonPlanCategorieI18ns collection to an empty array (like clearcollBonPlanCategorieI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanCategorieI18ns($overrideExisting = true)
    {
        if (null !== $this->collBonPlanCategorieI18ns && !$overrideExisting) {
            return;
        }
        $this->collBonPlanCategorieI18ns = new PropelObjectCollection();
        $this->collBonPlanCategorieI18ns->setModel('BonPlanCategorieI18n');
    }

    /**
     * Gets an array of BonPlanCategorieI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlanCategorie is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanCategorieI18n[] List of BonPlanCategorieI18n objects
     * @throws PropelException
     */
    public function getBonPlanCategorieI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanCategorieI18nsPartial && !$this->isNew();
        if (null === $this->collBonPlanCategorieI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanCategorieI18ns) {
                // return empty collection
                $this->initBonPlanCategorieI18ns();
            } else {
                $collBonPlanCategorieI18ns = BonPlanCategorieI18nQuery::create(null, $criteria)
                    ->filterByBonPlanCategorie($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanCategorieI18nsPartial && count($collBonPlanCategorieI18ns)) {
                      $this->initBonPlanCategorieI18ns(false);

                      foreach($collBonPlanCategorieI18ns as $obj) {
                        if (false == $this->collBonPlanCategorieI18ns->contains($obj)) {
                          $this->collBonPlanCategorieI18ns->append($obj);
                        }
                      }

                      $this->collBonPlanCategorieI18nsPartial = true;
                    }

                    return $collBonPlanCategorieI18ns;
                }

                if($partial && $this->collBonPlanCategorieI18ns) {
                    foreach($this->collBonPlanCategorieI18ns as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanCategorieI18ns[] = $obj;
                        }
                    }
                }

                $this->collBonPlanCategorieI18ns = $collBonPlanCategorieI18ns;
                $this->collBonPlanCategorieI18nsPartial = false;
            }
        }

        return $this->collBonPlanCategorieI18ns;
    }

    /**
     * Sets a collection of BonPlanCategorieI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanCategorieI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function setBonPlanCategorieI18ns(PropelCollection $bonPlanCategorieI18ns, PropelPDO $con = null)
    {
        $this->bonPlanCategorieI18nsScheduledForDeletion = $this->getBonPlanCategorieI18ns(new Criteria(), $con)->diff($bonPlanCategorieI18ns);

        foreach ($this->bonPlanCategorieI18nsScheduledForDeletion as $bonPlanCategorieI18nRemoved) {
            $bonPlanCategorieI18nRemoved->setBonPlanCategorie(null);
        }

        $this->collBonPlanCategorieI18ns = null;
        foreach ($bonPlanCategorieI18ns as $bonPlanCategorieI18n) {
            $this->addBonPlanCategorieI18n($bonPlanCategorieI18n);
        }

        $this->collBonPlanCategorieI18ns = $bonPlanCategorieI18ns;
        $this->collBonPlanCategorieI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanCategorieI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanCategorieI18n objects.
     * @throws PropelException
     */
    public function countBonPlanCategorieI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanCategorieI18nsPartial && !$this->isNew();
        if (null === $this->collBonPlanCategorieI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanCategorieI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanCategorieI18ns());
            }
            $query = BonPlanCategorieI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBonPlanCategorie($this)
                ->count($con);
        }

        return count($this->collBonPlanCategorieI18ns);
    }

    /**
     * Method called to associate a BonPlanCategorieI18n object to this object
     * through the BonPlanCategorieI18n foreign key attribute.
     *
     * @param    BonPlanCategorieI18n $l BonPlanCategorieI18n
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function addBonPlanCategorieI18n(BonPlanCategorieI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collBonPlanCategorieI18ns === null) {
            $this->initBonPlanCategorieI18ns();
            $this->collBonPlanCategorieI18nsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanCategorieI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanCategorieI18n($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanCategorieI18n $bonPlanCategorieI18n The bonPlanCategorieI18n object to add.
     */
    protected function doAddBonPlanCategorieI18n($bonPlanCategorieI18n)
    {
        $this->collBonPlanCategorieI18ns[]= $bonPlanCategorieI18n;
        $bonPlanCategorieI18n->setBonPlanCategorie($this);
    }

    /**
     * @param	BonPlanCategorieI18n $bonPlanCategorieI18n The bonPlanCategorieI18n object to remove.
     * @return BonPlanCategorie The current object (for fluent API support)
     */
    public function removeBonPlanCategorieI18n($bonPlanCategorieI18n)
    {
        if ($this->getBonPlanCategorieI18ns()->contains($bonPlanCategorieI18n)) {
            $this->collBonPlanCategorieI18ns->remove($this->collBonPlanCategorieI18ns->search($bonPlanCategorieI18n));
            if (null === $this->bonPlanCategorieI18nsScheduledForDeletion) {
                $this->bonPlanCategorieI18nsScheduledForDeletion = clone $this->collBonPlanCategorieI18ns;
                $this->bonPlanCategorieI18nsScheduledForDeletion->clear();
            }
            $this->bonPlanCategorieI18nsScheduledForDeletion[]= $bonPlanCategorieI18n;
            $bonPlanCategorieI18n->setBonPlanCategorie(null);
        }

        return $this;
    }

    /**
     * Clears out the collBonPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlanCategorie The current object (for fluent API support)
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
     * to the current object by way of the bon_plan_bon_plan_categorie cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlanCategorie is new, it will return
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
                    ->filterByBonPlanCategorie($this)
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
     * to the current object by way of the bon_plan_bon_plan_categorie cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlans A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlanCategorie The current object (for fluent API support)
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
     * to the current object by way of the bon_plan_bon_plan_categorie cross-reference table.
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
                    ->filterByBonPlanCategorie($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonPlans);
        }
    }

    /**
     * Associate a BonPlan object to this object
     * through the bon_plan_bon_plan_categorie cross reference table.
     *
     * @param  BonPlan $bonPlan The BonPlanBonPlanCategorie object to relate
     * @return BonPlanCategorie The current object (for fluent API support)
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
        $bonPlanBonPlanCategorie = new BonPlanBonPlanCategorie();
        $bonPlanBonPlanCategorie->setBonPlan($bonPlan);
        $this->addBonPlanBonPlanCategorie($bonPlanBonPlanCategorie);
    }

    /**
     * Remove a BonPlan object to this object
     * through the bon_plan_bon_plan_categorie cross reference table.
     *
     * @param BonPlan $bonPlan The BonPlanBonPlanCategorie object to relate
     * @return BonPlanCategorie The current object (for fluent API support)
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
        $this->active = null;
        $this->sortable_rank = null;
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
            if ($this->collBonPlanBonPlanCategories) {
                foreach ($this->collBonPlanBonPlanCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanCategorieI18ns) {
                foreach ($this->collBonPlanCategorieI18ns as $o) {
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

        if ($this->collBonPlanBonPlanCategories instanceof PropelCollection) {
            $this->collBonPlanBonPlanCategories->clearIterator();
        }
        $this->collBonPlanBonPlanCategories = null;
        if ($this->collBonPlanCategorieI18ns instanceof PropelCollection) {
            $this->collBonPlanCategorieI18ns->clearIterator();
        }
        $this->collBonPlanCategorieI18ns = null;
        if ($this->collBonPlans instanceof PropelCollection) {
            $this->collBonPlans->clearIterator();
        }
        $this->collBonPlans = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BonPlanCategoriePeer::DEFAULT_STRING_FORMAT);
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

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    BonPlanCategorie The current object (for fluent API support)
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
     * @return BonPlanCategorieI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collBonPlanCategorieI18ns) {
                foreach ($this->collBonPlanCategorieI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new BonPlanCategorieI18n();
                $translation->setLocale($locale);
            } else {
                $translation = BonPlanCategorieI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addBonPlanCategorieI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    BonPlanCategorie The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            BonPlanCategorieI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collBonPlanCategorieI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collBonPlanCategorieI18ns[$key]);
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
     * @return BonPlanCategorieI18n */
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
         * @return BonPlanCategorieI18n The current object (for fluent API support)
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
         * @return BonPlanCategorieI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

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
         * @return BonPlanCategorieI18n The current object (for fluent API support)
         */
        public function setSubtitle($v)
        {    $this->getCurrentTranslation()->setSubtitle($v);

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
         * @return BonPlanCategorieI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

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
     * @return    BonPlanCategorie
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
        return $this->getSortableRank() == BonPlanCategorieQuery::create()->getMaxRank($con);
    }

    /**
     * Get the next item in the list, i.e. the one for which rank is immediately higher
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    BonPlanCategorie
     */
    public function getNext(PropelPDO $con = null)
    {

        return BonPlanCategorieQuery::create()->findOneByRank($this->getSortableRank() + 1, $con);
    }

    /**
     * Get the previous item in the list, i.e. the one for which rank is immediately lower
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    BonPlanCategorie
     */
    public function getPrevious(PropelPDO $con = null)
    {

        return BonPlanCategorieQuery::create()->findOneByRank($this->getSortableRank() - 1, $con);
    }

    /**
     * Insert at specified rank
     * The modifications are not persisted until the object is saved.
     *
     * @param     integer    $rank rank value
     * @param     PropelPDO  $con      optional connection
     *
     * @return    BonPlanCategorie the current object
     *
     * @throws    PropelException
     */
    public function insertAtRank($rank, PropelPDO $con = null)
    {
        $maxRank = BonPlanCategorieQuery::create()->getMaxRank($con);
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
     * @return    BonPlanCategorie the current object
     *
     * @throws    PropelException
     */
    public function insertAtBottom(PropelPDO $con = null)
    {
        $this->setSortableRank(BonPlanCategorieQuery::create()->getMaxRank($con) + 1);

        return $this;
    }

    /**
     * Insert in the first rank
     * The modifications are not persisted until the object is saved.
     *
     * @return    BonPlanCategorie the current object
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
     * @return    BonPlanCategorie the current object
     *
     * @throws    PropelException
     */
    public function moveToRank($newRank, PropelPDO $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be moved. Please use insertAtRank() instead');
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
        }
        if ($newRank < 1 || $newRank > BonPlanCategorieQuery::create()->getMaxRank($con)) {
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
            BonPlanCategoriePeer::shiftRank($delta, min($oldRank, $newRank), max($oldRank, $newRank), $con);

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
     * @param     BonPlanCategorie $object
     * @param     PropelPDO $con optional connection
     *
     * @return    BonPlanCategorie the current object
     *
     * @throws Exception if the database cannot execute the two updates
     */
    public function swapWith($object, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
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
     * @return    BonPlanCategorie the current object
     */
    public function moveUp(PropelPDO $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
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
     * @return    BonPlanCategorie the current object
     */
    public function moveDown(PropelPDO $con = null)
    {
        if ($this->isLast($con)) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
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
     * @return    BonPlanCategorie the current object
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
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $bottom = BonPlanCategorieQuery::create()->getMaxRank($con);
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
     * @return    BonPlanCategorie the current object
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

}
