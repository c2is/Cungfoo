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
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioTagCategory;
use Cungfoo\Model\PortfolioTagCategoryI18n;
use Cungfoo\Model\PortfolioTagCategoryI18nQuery;
use Cungfoo\Model\PortfolioTagCategoryPeer;
use Cungfoo\Model\PortfolioTagCategoryQuery;
use Cungfoo\Model\PortfolioTagQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'portfolio_tag_category' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioTagCategory extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\PortfolioTagCategoryPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PortfolioTagCategoryPeer
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
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        PropelObjectCollection|PortfolioTag[] Collection to store aggregation of PortfolioTag objects.
     */
    protected $collPortfolioTags;
    protected $collPortfolioTagsPartial;

    /**
     * @var        PropelObjectCollection|PortfolioTagCategoryI18n[] Collection to store aggregation of PortfolioTagCategoryI18n objects.
     */
    protected $collPortfolioTagCategoryI18ns;
    protected $collPortfolioTagCategoryI18nsPartial;

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
     * @var        array[PortfolioTagCategoryI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioTagCategoryI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BasePortfolioTagCategory object.
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
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug ?: 'n-a';
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
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PortfolioTagCategoryPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = PortfolioTagCategoryPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = PortfolioTagCategoryPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return PortfolioTagCategory The current object (for fluent API support)
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
            $this->modifiedColumns[] = PortfolioTagCategoryPeer::ACTIVE;
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
            $this->slug = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->active = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 4; // 4 = PortfolioTagCategoryPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating PortfolioTagCategory object", $e);
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
            $con = Propel::getConnection(PortfolioTagCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PortfolioTagCategoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPortfolioTags = null;

            $this->collPortfolioTagCategoryI18ns = null;

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
            $con = Propel::getConnection(PortfolioTagCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PortfolioTagCategoryQuery::create()
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
            $con = Propel::getConnection(PortfolioTagCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                PortfolioTagCategoryPeer::addInstanceToPool($this);
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

            if ($this->portfolioTagsScheduledForDeletion !== null) {
                if (!$this->portfolioTagsScheduledForDeletion->isEmpty()) {
                    foreach ($this->portfolioTagsScheduledForDeletion as $portfolioTag) {
                        // need to save related object because we set the relation to null
                        $portfolioTag->save($con);
                    }
                    $this->portfolioTagsScheduledForDeletion = null;
                }
            }

            if ($this->collPortfolioTags !== null) {
                foreach ($this->collPortfolioTags as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->portfolioTagCategoryI18nsScheduledForDeletion !== null) {
                if (!$this->portfolioTagCategoryI18nsScheduledForDeletion->isEmpty()) {
                    PortfolioTagCategoryI18nQuery::create()
                        ->filterByPrimaryKeys($this->portfolioTagCategoryI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->portfolioTagCategoryI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPortfolioTagCategoryI18ns !== null) {
                foreach ($this->collPortfolioTagCategoryI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = PortfolioTagCategoryPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PortfolioTagCategoryPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PortfolioTagCategoryPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PortfolioTagCategoryPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(PortfolioTagCategoryPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(PortfolioTagCategoryPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `portfolio_tag_category` (%s) VALUES (%s)',
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
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
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


            if (($retval = PortfolioTagCategoryPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPortfolioTags !== null) {
                    foreach ($this->collPortfolioTags as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPortfolioTagCategoryI18ns !== null) {
                    foreach ($this->collPortfolioTagCategoryI18ns as $referrerFK) {
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
        $pos = PortfolioTagCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getSlug();
                break;
            case 3:
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
        if (isset($alreadyDumpedObjects['PortfolioTagCategory'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PortfolioTagCategory'][$this->getPrimaryKey()] = true;
        $keys = PortfolioTagCategoryPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getSlug(),
            $keys[3] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collPortfolioTags) {
                $result['PortfolioTags'] = $this->collPortfolioTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPortfolioTagCategoryI18ns) {
                $result['PortfolioTagCategoryI18ns'] = $this->collPortfolioTagCategoryI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PortfolioTagCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setSlug($value);
                break;
            case 3:
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
        $keys = PortfolioTagCategoryPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setActive($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PortfolioTagCategoryPeer::DATABASE_NAME);

        if ($this->isColumnModified(PortfolioTagCategoryPeer::ID)) $criteria->add(PortfolioTagCategoryPeer::ID, $this->id);
        if ($this->isColumnModified(PortfolioTagCategoryPeer::NAME)) $criteria->add(PortfolioTagCategoryPeer::NAME, $this->name);
        if ($this->isColumnModified(PortfolioTagCategoryPeer::SLUG)) $criteria->add(PortfolioTagCategoryPeer::SLUG, $this->slug);
        if ($this->isColumnModified(PortfolioTagCategoryPeer::ACTIVE)) $criteria->add(PortfolioTagCategoryPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(PortfolioTagCategoryPeer::DATABASE_NAME);
        $criteria->add(PortfolioTagCategoryPeer::ID, $this->id);

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
     * @param object $copyObj An object of PortfolioTagCategory (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPortfolioTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPortfolioTag($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPortfolioTagCategoryI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPortfolioTagCategoryI18n($relObj->copy($deepCopy));
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
     * @return PortfolioTagCategory Clone of current object.
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
     * @return PortfolioTagCategoryPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PortfolioTagCategoryPeer();
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
        if ('PortfolioTag' == $relationName) {
            $this->initPortfolioTags();
        }
        if ('PortfolioTagCategoryI18n' == $relationName) {
            $this->initPortfolioTagCategoryI18ns();
        }
    }

    /**
     * Clears out the collPortfolioTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioTagCategory The current object (for fluent API support)
     * @see        addPortfolioTags()
     */
    public function clearPortfolioTags()
    {
        $this->collPortfolioTags = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioTagsPartial = null;

        return $this;
    }

    /**
     * reset is the collPortfolioTags collection loaded partially
     *
     * @return void
     */
    public function resetPartialPortfolioTags($v = true)
    {
        $this->collPortfolioTagsPartial = $v;
    }

    /**
     * Initializes the collPortfolioTags collection.
     *
     * By default this just sets the collPortfolioTags collection to an empty array (like clearcollPortfolioTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPortfolioTags($overrideExisting = true)
    {
        if (null !== $this->collPortfolioTags && !$overrideExisting) {
            return;
        }
        $this->collPortfolioTags = new PropelObjectCollection();
        $this->collPortfolioTags->setModel('PortfolioTag');
    }

    /**
     * Gets an array of PortfolioTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioTagCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PortfolioTag[] List of PortfolioTag objects
     * @throws PropelException
     */
    public function getPortfolioTags($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioTagsPartial && !$this->isNew();
        if (null === $this->collPortfolioTags || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPortfolioTags) {
                // return empty collection
                $this->initPortfolioTags();
            } else {
                $collPortfolioTags = PortfolioTagQuery::create(null, $criteria)
                    ->filterByPortfolioTagCategory($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPortfolioTagsPartial && count($collPortfolioTags)) {
                      $this->initPortfolioTags(false);

                      foreach($collPortfolioTags as $obj) {
                        if (false == $this->collPortfolioTags->contains($obj)) {
                          $this->collPortfolioTags->append($obj);
                        }
                      }

                      $this->collPortfolioTagsPartial = true;
                    }

                    return $collPortfolioTags;
                }

                if($partial && $this->collPortfolioTags) {
                    foreach($this->collPortfolioTags as $obj) {
                        if($obj->isNew()) {
                            $collPortfolioTags[] = $obj;
                        }
                    }
                }

                $this->collPortfolioTags = $collPortfolioTags;
                $this->collPortfolioTagsPartial = false;
            }
        }

        return $this->collPortfolioTags;
    }

    /**
     * Sets a collection of PortfolioTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioTags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function setPortfolioTags(PropelCollection $portfolioTags, PropelPDO $con = null)
    {
        $this->portfolioTagsScheduledForDeletion = $this->getPortfolioTags(new Criteria(), $con)->diff($portfolioTags);

        foreach ($this->portfolioTagsScheduledForDeletion as $portfolioTagRemoved) {
            $portfolioTagRemoved->setPortfolioTagCategory(null);
        }

        $this->collPortfolioTags = null;
        foreach ($portfolioTags as $portfolioTag) {
            $this->addPortfolioTag($portfolioTag);
        }

        $this->collPortfolioTags = $portfolioTags;
        $this->collPortfolioTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PortfolioTag objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PortfolioTag objects.
     * @throws PropelException
     */
    public function countPortfolioTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioTagsPartial && !$this->isNew();
        if (null === $this->collPortfolioTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPortfolioTags) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPortfolioTags());
            }
            $query = PortfolioTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPortfolioTagCategory($this)
                ->count($con);
        }

        return count($this->collPortfolioTags);
    }

    /**
     * Method called to associate a PortfolioTag object to this object
     * through the PortfolioTag foreign key attribute.
     *
     * @param    PortfolioTag $l PortfolioTag
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function addPortfolioTag(PortfolioTag $l)
    {
        if ($this->collPortfolioTags === null) {
            $this->initPortfolioTags();
            $this->collPortfolioTagsPartial = true;
        }
        if (!in_array($l, $this->collPortfolioTags->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioTag($l);
        }

        return $this;
    }

    /**
     * @param	PortfolioTag $portfolioTag The portfolioTag object to add.
     */
    protected function doAddPortfolioTag($portfolioTag)
    {
        $this->collPortfolioTags[]= $portfolioTag;
        $portfolioTag->setPortfolioTagCategory($this);
    }

    /**
     * @param	PortfolioTag $portfolioTag The portfolioTag object to remove.
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function removePortfolioTag($portfolioTag)
    {
        if ($this->getPortfolioTags()->contains($portfolioTag)) {
            $this->collPortfolioTags->remove($this->collPortfolioTags->search($portfolioTag));
            if (null === $this->portfolioTagsScheduledForDeletion) {
                $this->portfolioTagsScheduledForDeletion = clone $this->collPortfolioTags;
                $this->portfolioTagsScheduledForDeletion->clear();
            }
            $this->portfolioTagsScheduledForDeletion[]= $portfolioTag;
            $portfolioTag->setPortfolioTagCategory(null);
        }

        return $this;
    }

    /**
     * Clears out the collPortfolioTagCategoryI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioTagCategory The current object (for fluent API support)
     * @see        addPortfolioTagCategoryI18ns()
     */
    public function clearPortfolioTagCategoryI18ns()
    {
        $this->collPortfolioTagCategoryI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioTagCategoryI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collPortfolioTagCategoryI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialPortfolioTagCategoryI18ns($v = true)
    {
        $this->collPortfolioTagCategoryI18nsPartial = $v;
    }

    /**
     * Initializes the collPortfolioTagCategoryI18ns collection.
     *
     * By default this just sets the collPortfolioTagCategoryI18ns collection to an empty array (like clearcollPortfolioTagCategoryI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPortfolioTagCategoryI18ns($overrideExisting = true)
    {
        if (null !== $this->collPortfolioTagCategoryI18ns && !$overrideExisting) {
            return;
        }
        $this->collPortfolioTagCategoryI18ns = new PropelObjectCollection();
        $this->collPortfolioTagCategoryI18ns->setModel('PortfolioTagCategoryI18n');
    }

    /**
     * Gets an array of PortfolioTagCategoryI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioTagCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PortfolioTagCategoryI18n[] List of PortfolioTagCategoryI18n objects
     * @throws PropelException
     */
    public function getPortfolioTagCategoryI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioTagCategoryI18nsPartial && !$this->isNew();
        if (null === $this->collPortfolioTagCategoryI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPortfolioTagCategoryI18ns) {
                // return empty collection
                $this->initPortfolioTagCategoryI18ns();
            } else {
                $collPortfolioTagCategoryI18ns = PortfolioTagCategoryI18nQuery::create(null, $criteria)
                    ->filterByPortfolioTagCategory($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPortfolioTagCategoryI18nsPartial && count($collPortfolioTagCategoryI18ns)) {
                      $this->initPortfolioTagCategoryI18ns(false);

                      foreach($collPortfolioTagCategoryI18ns as $obj) {
                        if (false == $this->collPortfolioTagCategoryI18ns->contains($obj)) {
                          $this->collPortfolioTagCategoryI18ns->append($obj);
                        }
                      }

                      $this->collPortfolioTagCategoryI18nsPartial = true;
                    }

                    return $collPortfolioTagCategoryI18ns;
                }

                if($partial && $this->collPortfolioTagCategoryI18ns) {
                    foreach($this->collPortfolioTagCategoryI18ns as $obj) {
                        if($obj->isNew()) {
                            $collPortfolioTagCategoryI18ns[] = $obj;
                        }
                    }
                }

                $this->collPortfolioTagCategoryI18ns = $collPortfolioTagCategoryI18ns;
                $this->collPortfolioTagCategoryI18nsPartial = false;
            }
        }

        return $this->collPortfolioTagCategoryI18ns;
    }

    /**
     * Sets a collection of PortfolioTagCategoryI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioTagCategoryI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function setPortfolioTagCategoryI18ns(PropelCollection $portfolioTagCategoryI18ns, PropelPDO $con = null)
    {
        $this->portfolioTagCategoryI18nsScheduledForDeletion = $this->getPortfolioTagCategoryI18ns(new Criteria(), $con)->diff($portfolioTagCategoryI18ns);

        foreach ($this->portfolioTagCategoryI18nsScheduledForDeletion as $portfolioTagCategoryI18nRemoved) {
            $portfolioTagCategoryI18nRemoved->setPortfolioTagCategory(null);
        }

        $this->collPortfolioTagCategoryI18ns = null;
        foreach ($portfolioTagCategoryI18ns as $portfolioTagCategoryI18n) {
            $this->addPortfolioTagCategoryI18n($portfolioTagCategoryI18n);
        }

        $this->collPortfolioTagCategoryI18ns = $portfolioTagCategoryI18ns;
        $this->collPortfolioTagCategoryI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PortfolioTagCategoryI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PortfolioTagCategoryI18n objects.
     * @throws PropelException
     */
    public function countPortfolioTagCategoryI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioTagCategoryI18nsPartial && !$this->isNew();
        if (null === $this->collPortfolioTagCategoryI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPortfolioTagCategoryI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPortfolioTagCategoryI18ns());
            }
            $query = PortfolioTagCategoryI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPortfolioTagCategory($this)
                ->count($con);
        }

        return count($this->collPortfolioTagCategoryI18ns);
    }

    /**
     * Method called to associate a PortfolioTagCategoryI18n object to this object
     * through the PortfolioTagCategoryI18n foreign key attribute.
     *
     * @param    PortfolioTagCategoryI18n $l PortfolioTagCategoryI18n
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function addPortfolioTagCategoryI18n(PortfolioTagCategoryI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPortfolioTagCategoryI18ns === null) {
            $this->initPortfolioTagCategoryI18ns();
            $this->collPortfolioTagCategoryI18nsPartial = true;
        }
        if (!in_array($l, $this->collPortfolioTagCategoryI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioTagCategoryI18n($l);
        }

        return $this;
    }

    /**
     * @param	PortfolioTagCategoryI18n $portfolioTagCategoryI18n The portfolioTagCategoryI18n object to add.
     */
    protected function doAddPortfolioTagCategoryI18n($portfolioTagCategoryI18n)
    {
        $this->collPortfolioTagCategoryI18ns[]= $portfolioTagCategoryI18n;
        $portfolioTagCategoryI18n->setPortfolioTagCategory($this);
    }

    /**
     * @param	PortfolioTagCategoryI18n $portfolioTagCategoryI18n The portfolioTagCategoryI18n object to remove.
     * @return PortfolioTagCategory The current object (for fluent API support)
     */
    public function removePortfolioTagCategoryI18n($portfolioTagCategoryI18n)
    {
        if ($this->getPortfolioTagCategoryI18ns()->contains($portfolioTagCategoryI18n)) {
            $this->collPortfolioTagCategoryI18ns->remove($this->collPortfolioTagCategoryI18ns->search($portfolioTagCategoryI18n));
            if (null === $this->portfolioTagCategoryI18nsScheduledForDeletion) {
                $this->portfolioTagCategoryI18nsScheduledForDeletion = clone $this->collPortfolioTagCategoryI18ns;
                $this->portfolioTagCategoryI18nsScheduledForDeletion->clear();
            }
            $this->portfolioTagCategoryI18nsScheduledForDeletion[]= $portfolioTagCategoryI18n;
            $portfolioTagCategoryI18n->setPortfolioTagCategory(null);
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
        $this->slug = null;
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
            if ($this->collPortfolioTags) {
                foreach ($this->collPortfolioTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPortfolioTagCategoryI18ns) {
                foreach ($this->collPortfolioTagCategoryI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collPortfolioTags instanceof PropelCollection) {
            $this->collPortfolioTags->clearIterator();
        }
        $this->collPortfolioTags = null;
        if ($this->collPortfolioTagCategoryI18ns instanceof PropelCollection) {
            $this->collPortfolioTagCategoryI18ns->clearIterator();
        }
        $this->collPortfolioTagCategoryI18ns = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PortfolioTagCategoryPeer::DEFAULT_STRING_FORMAT);
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

    public function getPortfolioTagsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\PortfolioTagPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PortfolioTagI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PortfolioTagPeer::ID, \Cungfoo\Model\PortfolioTagI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioTagI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PortfolioTagI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioTagI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PortfolioTagI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioTagI18nPeer::LOCALE), $this->currentLocale);

        return $this->getPortfolioTags($criteria, $con);
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
     * @return    PortfolioTagCategory The current object (for fluent API support)
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
     * @return PortfolioTagCategoryI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPortfolioTagCategoryI18ns) {
                foreach ($this->collPortfolioTagCategoryI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new PortfolioTagCategoryI18n();
                $translation->setLocale($locale);
            } else {
                $translation = PortfolioTagCategoryI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPortfolioTagCategoryI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PortfolioTagCategory The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            PortfolioTagCategoryI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPortfolioTagCategoryI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPortfolioTagCategoryI18ns[$key]);
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
     * @return PortfolioTagCategoryI18n */
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
         * @return PortfolioTagCategoryI18n The current object (for fluent API support)
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
         * @return PortfolioTagCategoryI18n The current object (for fluent API support)
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
         * @return PortfolioTagCategoryI18n The current object (for fluent API support)
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
         * @return PortfolioTagCategoryI18n The current object (for fluent API support)
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
         * @return PortfolioTagCategoryI18n The current object (for fluent API support)
         */
        public function setActiveLocale($v)
        {    $this->getCurrentTranslation()->setActiveLocale($v);

        return $this;
    }

}
