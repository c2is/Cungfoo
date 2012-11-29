<?php

namespace Cungfoo\Model\om;

use \BaseObject;
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
use Cungfoo\Model\IdeeWeekend;
use Cungfoo\Model\IdeeWeekendI18n;
use Cungfoo\Model\IdeeWeekendI18nQuery;
use Cungfoo\Model\IdeeWeekendPeer;
use Cungfoo\Model\IdeeWeekendQuery;

/**
 * Base class that represents a row from the 'idee_weekend' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseIdeeWeekend extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\IdeeWeekendPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        IdeeWeekendPeer
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
     * The value for the highlight field.
     * @var        boolean
     */
    protected $highlight;

    /**
     * The value for the prix field.
     * @var        string
     */
    protected $prix;

    /**
     * The value for the home field.
     * @var        boolean
     */
    protected $home;

    /**
     * The value for the lien field.
     * @var        string
     */
    protected $lien;

    /**
     * The value for the image_path field.
     * @var        string
     */
    protected $image_path;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        PropelObjectCollection|IdeeWeekendI18n[] Collection to store aggregation of IdeeWeekendI18n objects.
     */
    protected $collIdeeWeekendI18ns;
    protected $collIdeeWeekendI18nsPartial;

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
     * @var        array[IdeeWeekendI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $ideeWeekendI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseIdeeWeekend object.
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
     * Get the [highlight] column value.
     *
     * @return boolean
     */
    public function getHighlight()
    {
        return $this->highlight;
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
     * Get the [home] column value.
     *
     * @return boolean
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Get the [lien] column value.
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Get the [image_path] column value.
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->image_path;
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
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = IdeeWeekendPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of the [highlight] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function setHighlight($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->highlight !== $v) {
            $this->highlight = $v;
            $this->modifiedColumns[] = IdeeWeekendPeer::HIGHLIGHT;
        }


        return $this;
    } // setHighlight()

    /**
     * Set the value of [prix] column.
     *
     * @param string $v new value
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function setPrix($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prix !== $v) {
            $this->prix = $v;
            $this->modifiedColumns[] = IdeeWeekendPeer::PRIX;
        }


        return $this;
    } // setPrix()

    /**
     * Sets the value of the [home] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function setHome($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->home !== $v) {
            $this->home = $v;
            $this->modifiedColumns[] = IdeeWeekendPeer::HOME;
        }


        return $this;
    } // setHome()

    /**
     * Set the value of [lien] column.
     *
     * @param string $v new value
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function setLien($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lien !== $v) {
            $this->lien = $v;
            $this->modifiedColumns[] = IdeeWeekendPeer::LIEN;
        }


        return $this;
    } // setLien()

    /**
     * Set the value of [image_path] column.
     *
     * @param string $v new value
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function setImagePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_path !== $v) {
            $this->image_path = $v;
            $this->modifiedColumns[] = IdeeWeekendPeer::IMAGE_PATH;
        }


        return $this;
    } // setImagePath()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return IdeeWeekend The current object (for fluent API support)
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
            $this->modifiedColumns[] = IdeeWeekendPeer::ACTIVE;
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
            $this->highlight = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
            $this->prix = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->home = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->lien = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->image_path = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->active = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 7; // 7 = IdeeWeekendPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating IdeeWeekend object", $e);
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
            $con = Propel::getConnection(IdeeWeekendPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = IdeeWeekendPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collIdeeWeekendI18ns = null;

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
            $con = Propel::getConnection(IdeeWeekendPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = IdeeWeekendQuery::create()
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
            $con = Propel::getConnection(IdeeWeekendPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                IdeeWeekendPeer::addInstanceToPool($this);
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

            if ($this->ideeWeekendI18nsScheduledForDeletion !== null) {
                if (!$this->ideeWeekendI18nsScheduledForDeletion->isEmpty()) {
                    IdeeWeekendI18nQuery::create()
                        ->filterByPrimaryKeys($this->ideeWeekendI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ideeWeekendI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collIdeeWeekendI18ns !== null) {
                foreach ($this->collIdeeWeekendI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = IdeeWeekendPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . IdeeWeekendPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(IdeeWeekendPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(IdeeWeekendPeer::HIGHLIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`HIGHLIGHT`';
        }
        if ($this->isColumnModified(IdeeWeekendPeer::PRIX)) {
            $modifiedColumns[':p' . $index++]  = '`PRIX`';
        }
        if ($this->isColumnModified(IdeeWeekendPeer::HOME)) {
            $modifiedColumns[':p' . $index++]  = '`HOME`';
        }
        if ($this->isColumnModified(IdeeWeekendPeer::LIEN)) {
            $modifiedColumns[':p' . $index++]  = '`LIEN`';
        }
        if ($this->isColumnModified(IdeeWeekendPeer::IMAGE_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`IMAGE_PATH`';
        }
        if ($this->isColumnModified(IdeeWeekendPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }

        $sql = sprintf(
            'INSERT INTO `idee_weekend` (%s) VALUES (%s)',
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
                    case '`HIGHLIGHT`':
                        $stmt->bindValue($identifier, (int) $this->highlight, PDO::PARAM_INT);
                        break;
                    case '`PRIX`':
                        $stmt->bindValue($identifier, $this->prix, PDO::PARAM_STR);
                        break;
                    case '`HOME`':
                        $stmt->bindValue($identifier, (int) $this->home, PDO::PARAM_INT);
                        break;
                    case '`LIEN`':
                        $stmt->bindValue($identifier, $this->lien, PDO::PARAM_STR);
                        break;
                    case '`IMAGE_PATH`':
                        $stmt->bindValue($identifier, $this->image_path, PDO::PARAM_STR);
                        break;
                    case '`ACTIVE`':
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


            if (($retval = IdeeWeekendPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collIdeeWeekendI18ns !== null) {
                    foreach ($this->collIdeeWeekendI18ns as $referrerFK) {
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
        $pos = IdeeWeekendPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getHighlight();
                break;
            case 2:
                return $this->getPrix();
                break;
            case 3:
                return $this->getHome();
                break;
            case 4:
                return $this->getLien();
                break;
            case 5:
                return $this->getImagePath();
                break;
            case 6:
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
        if (isset($alreadyDumpedObjects['IdeeWeekend'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['IdeeWeekend'][$this->getPrimaryKey()] = true;
        $keys = IdeeWeekendPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getHighlight(),
            $keys[2] => $this->getPrix(),
            $keys[3] => $this->getHome(),
            $keys[4] => $this->getLien(),
            $keys[5] => $this->getImagePath(),
            $keys[6] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collIdeeWeekendI18ns) {
                $result['IdeeWeekendI18ns'] = $this->collIdeeWeekendI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = IdeeWeekendPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setHighlight($value);
                break;
            case 2:
                $this->setPrix($value);
                break;
            case 3:
                $this->setHome($value);
                break;
            case 4:
                $this->setLien($value);
                break;
            case 5:
                $this->setImagePath($value);
                break;
            case 6:
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
        $keys = IdeeWeekendPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setHighlight($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPrix($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setHome($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLien($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setImagePath($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setActive($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(IdeeWeekendPeer::DATABASE_NAME);

        if ($this->isColumnModified(IdeeWeekendPeer::ID)) $criteria->add(IdeeWeekendPeer::ID, $this->id);
        if ($this->isColumnModified(IdeeWeekendPeer::HIGHLIGHT)) $criteria->add(IdeeWeekendPeer::HIGHLIGHT, $this->highlight);
        if ($this->isColumnModified(IdeeWeekendPeer::PRIX)) $criteria->add(IdeeWeekendPeer::PRIX, $this->prix);
        if ($this->isColumnModified(IdeeWeekendPeer::HOME)) $criteria->add(IdeeWeekendPeer::HOME, $this->home);
        if ($this->isColumnModified(IdeeWeekendPeer::LIEN)) $criteria->add(IdeeWeekendPeer::LIEN, $this->lien);
        if ($this->isColumnModified(IdeeWeekendPeer::IMAGE_PATH)) $criteria->add(IdeeWeekendPeer::IMAGE_PATH, $this->image_path);
        if ($this->isColumnModified(IdeeWeekendPeer::ACTIVE)) $criteria->add(IdeeWeekendPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(IdeeWeekendPeer::DATABASE_NAME);
        $criteria->add(IdeeWeekendPeer::ID, $this->id);

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
     * @param object $copyObj An object of IdeeWeekend (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setHighlight($this->getHighlight());
        $copyObj->setPrix($this->getPrix());
        $copyObj->setHome($this->getHome());
        $copyObj->setLien($this->getLien());
        $copyObj->setImagePath($this->getImagePath());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getIdeeWeekendI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addIdeeWeekendI18n($relObj->copy($deepCopy));
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
     * @return IdeeWeekend Clone of current object.
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
     * @return IdeeWeekendPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new IdeeWeekendPeer();
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
        if ('IdeeWeekendI18n' == $relationName) {
            $this->initIdeeWeekendI18ns();
        }
    }

    /**
     * Clears out the collIdeeWeekendI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addIdeeWeekendI18ns()
     */
    public function clearIdeeWeekendI18ns()
    {
        $this->collIdeeWeekendI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collIdeeWeekendI18nsPartial = null;
    }

    /**
     * reset is the collIdeeWeekendI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialIdeeWeekendI18ns($v = true)
    {
        $this->collIdeeWeekendI18nsPartial = $v;
    }

    /**
     * Initializes the collIdeeWeekendI18ns collection.
     *
     * By default this just sets the collIdeeWeekendI18ns collection to an empty array (like clearcollIdeeWeekendI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initIdeeWeekendI18ns($overrideExisting = true)
    {
        if (null !== $this->collIdeeWeekendI18ns && !$overrideExisting) {
            return;
        }
        $this->collIdeeWeekendI18ns = new PropelObjectCollection();
        $this->collIdeeWeekendI18ns->setModel('IdeeWeekendI18n');
    }

    /**
     * Gets an array of IdeeWeekendI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this IdeeWeekend is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|IdeeWeekendI18n[] List of IdeeWeekendI18n objects
     * @throws PropelException
     */
    public function getIdeeWeekendI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collIdeeWeekendI18nsPartial && !$this->isNew();
        if (null === $this->collIdeeWeekendI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collIdeeWeekendI18ns) {
                // return empty collection
                $this->initIdeeWeekendI18ns();
            } else {
                $collIdeeWeekendI18ns = IdeeWeekendI18nQuery::create(null, $criteria)
                    ->filterByIdeeWeekend($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collIdeeWeekendI18nsPartial && count($collIdeeWeekendI18ns)) {
                      $this->initIdeeWeekendI18ns(false);

                      foreach($collIdeeWeekendI18ns as $obj) {
                        if (false == $this->collIdeeWeekendI18ns->contains($obj)) {
                          $this->collIdeeWeekendI18ns->append($obj);
                        }
                      }

                      $this->collIdeeWeekendI18nsPartial = true;
                    }

                    return $collIdeeWeekendI18ns;
                }

                if($partial && $this->collIdeeWeekendI18ns) {
                    foreach($this->collIdeeWeekendI18ns as $obj) {
                        if($obj->isNew()) {
                            $collIdeeWeekendI18ns[] = $obj;
                        }
                    }
                }

                $this->collIdeeWeekendI18ns = $collIdeeWeekendI18ns;
                $this->collIdeeWeekendI18nsPartial = false;
            }
        }

        return $this->collIdeeWeekendI18ns;
    }

    /**
     * Sets a collection of IdeeWeekendI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $ideeWeekendI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setIdeeWeekendI18ns(PropelCollection $ideeWeekendI18ns, PropelPDO $con = null)
    {
        $this->ideeWeekendI18nsScheduledForDeletion = $this->getIdeeWeekendI18ns(new Criteria(), $con)->diff($ideeWeekendI18ns);

        foreach ($this->ideeWeekendI18nsScheduledForDeletion as $ideeWeekendI18nRemoved) {
            $ideeWeekendI18nRemoved->setIdeeWeekend(null);
        }

        $this->collIdeeWeekendI18ns = null;
        foreach ($ideeWeekendI18ns as $ideeWeekendI18n) {
            $this->addIdeeWeekendI18n($ideeWeekendI18n);
        }

        $this->collIdeeWeekendI18ns = $ideeWeekendI18ns;
        $this->collIdeeWeekendI18nsPartial = false;
    }

    /**
     * Returns the number of related IdeeWeekendI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related IdeeWeekendI18n objects.
     * @throws PropelException
     */
    public function countIdeeWeekendI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collIdeeWeekendI18nsPartial && !$this->isNew();
        if (null === $this->collIdeeWeekendI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collIdeeWeekendI18ns) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getIdeeWeekendI18ns());
                }
                $query = IdeeWeekendI18nQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByIdeeWeekend($this)
                    ->count($con);
            }
        } else {
            return count($this->collIdeeWeekendI18ns);
        }
    }

    /**
     * Method called to associate a IdeeWeekendI18n object to this object
     * through the IdeeWeekendI18n foreign key attribute.
     *
     * @param    IdeeWeekendI18n $l IdeeWeekendI18n
     * @return IdeeWeekend The current object (for fluent API support)
     */
    public function addIdeeWeekendI18n(IdeeWeekendI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collIdeeWeekendI18ns === null) {
            $this->initIdeeWeekendI18ns();
            $this->collIdeeWeekendI18nsPartial = true;
        }
        if (!in_array($l, $this->collIdeeWeekendI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddIdeeWeekendI18n($l);
        }

        return $this;
    }

    /**
     * @param	IdeeWeekendI18n $ideeWeekendI18n The ideeWeekendI18n object to add.
     */
    protected function doAddIdeeWeekendI18n($ideeWeekendI18n)
    {
        $this->collIdeeWeekendI18ns[]= $ideeWeekendI18n;
        $ideeWeekendI18n->setIdeeWeekend($this);
    }

    /**
     * @param	IdeeWeekendI18n $ideeWeekendI18n The ideeWeekendI18n object to remove.
     */
    public function removeIdeeWeekendI18n($ideeWeekendI18n)
    {
        if ($this->getIdeeWeekendI18ns()->contains($ideeWeekendI18n)) {
            $this->collIdeeWeekendI18ns->remove($this->collIdeeWeekendI18ns->search($ideeWeekendI18n));
            if (null === $this->ideeWeekendI18nsScheduledForDeletion) {
                $this->ideeWeekendI18nsScheduledForDeletion = clone $this->collIdeeWeekendI18ns;
                $this->ideeWeekendI18nsScheduledForDeletion->clear();
            }
            $this->ideeWeekendI18nsScheduledForDeletion[]= $ideeWeekendI18n;
            $ideeWeekendI18n->setIdeeWeekend(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->highlight = null;
        $this->prix = null;
        $this->home = null;
        $this->lien = null;
        $this->image_path = null;
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
            if ($this->collIdeeWeekendI18ns) {
                foreach ($this->collIdeeWeekendI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collIdeeWeekendI18ns instanceof PropelCollection) {
            $this->collIdeeWeekendI18ns->clearIterator();
        }
        $this->collIdeeWeekendI18ns = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(IdeeWeekendPeer::DEFAULT_STRING_FORMAT);
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
     * @return    IdeeWeekend The current object (for fluent API support)
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
     * @return IdeeWeekendI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collIdeeWeekendI18ns) {
                foreach ($this->collIdeeWeekendI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new IdeeWeekendI18n();
                $translation->setLocale($locale);
            } else {
                $translation = IdeeWeekendI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addIdeeWeekendI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    IdeeWeekend The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            IdeeWeekendI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collIdeeWeekendI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collIdeeWeekendI18ns[$key]);
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
     * @return IdeeWeekendI18n */
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
         * @return IdeeWeekendI18n The current object (for fluent API support)
         */
        public function setTitre($v)
        {    $this->getCurrentTranslation()->setTitre($v);

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
        if (!$form['image_path_deleted']->getData())
        {
            $this->resetModified(IdeeWeekendPeer::IMAGE_PATH);
        }

        $this->uploadImagePath($form);

        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/idee_weekends';
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
    public function uploadImagePath(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_path']->getData()))
        {
            $image = uniqid().'.'.$form['image_path']->getData()->guessExtension();
            $form['image_path']->getData()->move($this->getUploadRootDir(), $image);
            $this->setImagePath($this->getUploadDir() . '/' . $image);
        }
    }

}
