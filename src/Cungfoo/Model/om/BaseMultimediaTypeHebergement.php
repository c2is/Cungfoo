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
use Cungfoo\Model\MultimediaTypeHebergement;
use Cungfoo\Model\MultimediaTypeHebergementI18n;
use Cungfoo\Model\MultimediaTypeHebergementI18nQuery;
use Cungfoo\Model\MultimediaTypeHebergementPeer;
use Cungfoo\Model\MultimediaTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementQuery;

/**
 * Base class that represents a row from the 'multimedia_type_hebergement' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMultimediaTypeHebergement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\MultimediaTypeHebergementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MultimediaTypeHebergementPeer
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
     * The value for the type_hebergement_id field.
     * @var        int
     */
    protected $type_hebergement_id;

    /**
     * The value for the image_path field.
     * @var        string
     */
    protected $image_path;

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
     * @var        TypeHebergement
     */
    protected $aTypeHebergement;

    /**
     * @var        PropelObjectCollection|MultimediaTypeHebergementI18n[] Collection to store aggregation of MultimediaTypeHebergementI18n objects.
     */
    protected $collMultimediaTypeHebergementI18ns;
    protected $collMultimediaTypeHebergementI18nsPartial;

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
     * @var        array[MultimediaTypeHebergementI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $multimediaTypeHebergementI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseMultimediaTypeHebergement object.
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
     * Get the [type_hebergement_id] column value.
     *
     * @return int
     */
    public function getTypeHebergementId()
    {
        return $this->type_hebergement_id;
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
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = MultimediaTypeHebergementPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [type_hebergement_id] column.
     *
     * @param int $v new value
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function setTypeHebergementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_hebergement_id !== $v) {
            $this->type_hebergement_id = $v;
            $this->modifiedColumns[] = MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID;
        }

        if ($this->aTypeHebergement !== null && $this->aTypeHebergement->getId() !== $v) {
            $this->aTypeHebergement = null;
        }


        return $this;
    } // setTypeHebergementId()

    /**
     * Set the value of [image_path] column.
     *
     * @param string $v new value
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function setImagePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_path !== $v) {
            $this->image_path = $v;
            $this->modifiedColumns[] = MultimediaTypeHebergementPeer::IMAGE_PATH;
        }


        return $this;
    } // setImagePath()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = MultimediaTypeHebergementPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = MultimediaTypeHebergementPeer::UPDATED_AT;
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
     * @return MultimediaTypeHebergement The current object (for fluent API support)
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
            $this->modifiedColumns[] = MultimediaTypeHebergementPeer::ACTIVE;
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
            $this->type_hebergement_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->image_path = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->created_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->updated_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = MultimediaTypeHebergementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating MultimediaTypeHebergement object", $e);
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
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MultimediaTypeHebergementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTypeHebergement = null;
            $this->collMultimediaTypeHebergementI18ns = null;

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
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MultimediaTypeHebergementQuery::create()
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
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(MultimediaTypeHebergementPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(MultimediaTypeHebergementPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(MultimediaTypeHebergementPeer::UPDATED_AT)) {
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
                MultimediaTypeHebergementPeer::addInstanceToPool($this);
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

            if ($this->multimediaTypeHebergementI18nsScheduledForDeletion !== null) {
                if (!$this->multimediaTypeHebergementI18nsScheduledForDeletion->isEmpty()) {
                    MultimediaTypeHebergementI18nQuery::create()
                        ->filterByPrimaryKeys($this->multimediaTypeHebergementI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->multimediaTypeHebergementI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collMultimediaTypeHebergementI18ns !== null) {
                foreach ($this->collMultimediaTypeHebergementI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = MultimediaTypeHebergementPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MultimediaTypeHebergementPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`type_hebergement_id`';
        }
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::IMAGE_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_path`';
        }
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `multimedia_type_hebergement` (%s) VALUES (%s)',
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
                    case '`type_hebergement_id`':
                        $stmt->bindValue($identifier, $this->type_hebergement_id, PDO::PARAM_INT);
                        break;
                    case '`image_path`':
                        $stmt->bindValue($identifier, $this->image_path, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTypeHebergement !== null) {
                if (!$this->aTypeHebergement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeHebergement->getValidationFailures());
                }
            }


            if (($retval = MultimediaTypeHebergementPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMultimediaTypeHebergementI18ns !== null) {
                    foreach ($this->collMultimediaTypeHebergementI18ns as $referrerFK) {
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
        $pos = MultimediaTypeHebergementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getTypeHebergementId();
                break;
            case 2:
                return $this->getImagePath();
                break;
            case 3:
                return $this->getCreatedAt();
                break;
            case 4:
                return $this->getUpdatedAt();
                break;
            case 5:
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
        if (isset($alreadyDumpedObjects['MultimediaTypeHebergement'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['MultimediaTypeHebergement'][$this->getPrimaryKey()] = true;
        $keys = MultimediaTypeHebergementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTypeHebergementId(),
            $keys[2] => $this->getImagePath(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
            $keys[5] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTypeHebergement) {
                $result['TypeHebergement'] = $this->aTypeHebergement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMultimediaTypeHebergementI18ns) {
                $result['MultimediaTypeHebergementI18ns'] = $this->collMultimediaTypeHebergementI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MultimediaTypeHebergementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setTypeHebergementId($value);
                break;
            case 2:
                $this->setImagePath($value);
                break;
            case 3:
                $this->setCreatedAt($value);
                break;
            case 4:
                $this->setUpdatedAt($value);
                break;
            case 5:
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
        $keys = MultimediaTypeHebergementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTypeHebergementId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setImagePath($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setActive($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MultimediaTypeHebergementPeer::DATABASE_NAME);

        if ($this->isColumnModified(MultimediaTypeHebergementPeer::ID)) $criteria->add(MultimediaTypeHebergementPeer::ID, $this->id);
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID)) $criteria->add(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $this->type_hebergement_id);
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::IMAGE_PATH)) $criteria->add(MultimediaTypeHebergementPeer::IMAGE_PATH, $this->image_path);
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::CREATED_AT)) $criteria->add(MultimediaTypeHebergementPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::UPDATED_AT)) $criteria->add(MultimediaTypeHebergementPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(MultimediaTypeHebergementPeer::ACTIVE)) $criteria->add(MultimediaTypeHebergementPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(MultimediaTypeHebergementPeer::DATABASE_NAME);
        $criteria->add(MultimediaTypeHebergementPeer::ID, $this->id);

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
     * @param object $copyObj An object of MultimediaTypeHebergement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTypeHebergementId($this->getTypeHebergementId());
        $copyObj->setImagePath($this->getImagePath());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getMultimediaTypeHebergementI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMultimediaTypeHebergementI18n($relObj->copy($deepCopy));
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
     * @return MultimediaTypeHebergement Clone of current object.
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
     * @return MultimediaTypeHebergementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MultimediaTypeHebergementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TypeHebergement object.
     *
     * @param             TypeHebergement $v
     * @return MultimediaTypeHebergement The current object (for fluent API support)
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
            $v->addMultimediaTypeHebergement($this);
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
                $this->aTypeHebergement->addMultimediaTypeHebergements($this);
             */
        }

        return $this->aTypeHebergement;
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
        if ('MultimediaTypeHebergementI18n' == $relationName) {
            $this->initMultimediaTypeHebergementI18ns();
        }
    }

    /**
     * Clears out the collMultimediaTypeHebergementI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     * @see        addMultimediaTypeHebergementI18ns()
     */
    public function clearMultimediaTypeHebergementI18ns()
    {
        $this->collMultimediaTypeHebergementI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collMultimediaTypeHebergementI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collMultimediaTypeHebergementI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialMultimediaTypeHebergementI18ns($v = true)
    {
        $this->collMultimediaTypeHebergementI18nsPartial = $v;
    }

    /**
     * Initializes the collMultimediaTypeHebergementI18ns collection.
     *
     * By default this just sets the collMultimediaTypeHebergementI18ns collection to an empty array (like clearcollMultimediaTypeHebergementI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMultimediaTypeHebergementI18ns($overrideExisting = true)
    {
        if (null !== $this->collMultimediaTypeHebergementI18ns && !$overrideExisting) {
            return;
        }
        $this->collMultimediaTypeHebergementI18ns = new PropelObjectCollection();
        $this->collMultimediaTypeHebergementI18ns->setModel('MultimediaTypeHebergementI18n');
    }

    /**
     * Gets an array of MultimediaTypeHebergementI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MultimediaTypeHebergement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MultimediaTypeHebergementI18n[] List of MultimediaTypeHebergementI18n objects
     * @throws PropelException
     */
    public function getMultimediaTypeHebergementI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMultimediaTypeHebergementI18nsPartial && !$this->isNew();
        if (null === $this->collMultimediaTypeHebergementI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMultimediaTypeHebergementI18ns) {
                // return empty collection
                $this->initMultimediaTypeHebergementI18ns();
            } else {
                $collMultimediaTypeHebergementI18ns = MultimediaTypeHebergementI18nQuery::create(null, $criteria)
                    ->filterByMultimediaTypeHebergement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMultimediaTypeHebergementI18nsPartial && count($collMultimediaTypeHebergementI18ns)) {
                      $this->initMultimediaTypeHebergementI18ns(false);

                      foreach($collMultimediaTypeHebergementI18ns as $obj) {
                        if (false == $this->collMultimediaTypeHebergementI18ns->contains($obj)) {
                          $this->collMultimediaTypeHebergementI18ns->append($obj);
                        }
                      }

                      $this->collMultimediaTypeHebergementI18nsPartial = true;
                    }

                    return $collMultimediaTypeHebergementI18ns;
                }

                if($partial && $this->collMultimediaTypeHebergementI18ns) {
                    foreach($this->collMultimediaTypeHebergementI18ns as $obj) {
                        if($obj->isNew()) {
                            $collMultimediaTypeHebergementI18ns[] = $obj;
                        }
                    }
                }

                $this->collMultimediaTypeHebergementI18ns = $collMultimediaTypeHebergementI18ns;
                $this->collMultimediaTypeHebergementI18nsPartial = false;
            }
        }

        return $this->collMultimediaTypeHebergementI18ns;
    }

    /**
     * Sets a collection of MultimediaTypeHebergementI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $multimediaTypeHebergementI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function setMultimediaTypeHebergementI18ns(PropelCollection $multimediaTypeHebergementI18ns, PropelPDO $con = null)
    {
        $this->multimediaTypeHebergementI18nsScheduledForDeletion = $this->getMultimediaTypeHebergementI18ns(new Criteria(), $con)->diff($multimediaTypeHebergementI18ns);

        foreach ($this->multimediaTypeHebergementI18nsScheduledForDeletion as $multimediaTypeHebergementI18nRemoved) {
            $multimediaTypeHebergementI18nRemoved->setMultimediaTypeHebergement(null);
        }

        $this->collMultimediaTypeHebergementI18ns = null;
        foreach ($multimediaTypeHebergementI18ns as $multimediaTypeHebergementI18n) {
            $this->addMultimediaTypeHebergementI18n($multimediaTypeHebergementI18n);
        }

        $this->collMultimediaTypeHebergementI18ns = $multimediaTypeHebergementI18ns;
        $this->collMultimediaTypeHebergementI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MultimediaTypeHebergementI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MultimediaTypeHebergementI18n objects.
     * @throws PropelException
     */
    public function countMultimediaTypeHebergementI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMultimediaTypeHebergementI18nsPartial && !$this->isNew();
        if (null === $this->collMultimediaTypeHebergementI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMultimediaTypeHebergementI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getMultimediaTypeHebergementI18ns());
            }
            $query = MultimediaTypeHebergementI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMultimediaTypeHebergement($this)
                ->count($con);
        }

        return count($this->collMultimediaTypeHebergementI18ns);
    }

    /**
     * Method called to associate a MultimediaTypeHebergementI18n object to this object
     * through the MultimediaTypeHebergementI18n foreign key attribute.
     *
     * @param    MultimediaTypeHebergementI18n $l MultimediaTypeHebergementI18n
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function addMultimediaTypeHebergementI18n(MultimediaTypeHebergementI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collMultimediaTypeHebergementI18ns === null) {
            $this->initMultimediaTypeHebergementI18ns();
            $this->collMultimediaTypeHebergementI18nsPartial = true;
        }
        if (!in_array($l, $this->collMultimediaTypeHebergementI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMultimediaTypeHebergementI18n($l);
        }

        return $this;
    }

    /**
     * @param	MultimediaTypeHebergementI18n $multimediaTypeHebergementI18n The multimediaTypeHebergementI18n object to add.
     */
    protected function doAddMultimediaTypeHebergementI18n($multimediaTypeHebergementI18n)
    {
        $this->collMultimediaTypeHebergementI18ns[]= $multimediaTypeHebergementI18n;
        $multimediaTypeHebergementI18n->setMultimediaTypeHebergement($this);
    }

    /**
     * @param	MultimediaTypeHebergementI18n $multimediaTypeHebergementI18n The multimediaTypeHebergementI18n object to remove.
     * @return MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function removeMultimediaTypeHebergementI18n($multimediaTypeHebergementI18n)
    {
        if ($this->getMultimediaTypeHebergementI18ns()->contains($multimediaTypeHebergementI18n)) {
            $this->collMultimediaTypeHebergementI18ns->remove($this->collMultimediaTypeHebergementI18ns->search($multimediaTypeHebergementI18n));
            if (null === $this->multimediaTypeHebergementI18nsScheduledForDeletion) {
                $this->multimediaTypeHebergementI18nsScheduledForDeletion = clone $this->collMultimediaTypeHebergementI18ns;
                $this->multimediaTypeHebergementI18nsScheduledForDeletion->clear();
            }
            $this->multimediaTypeHebergementI18nsScheduledForDeletion[]= $multimediaTypeHebergementI18n;
            $multimediaTypeHebergementI18n->setMultimediaTypeHebergement(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->type_hebergement_id = null;
        $this->image_path = null;
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
            if ($this->collMultimediaTypeHebergementI18ns) {
                foreach ($this->collMultimediaTypeHebergementI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collMultimediaTypeHebergementI18ns instanceof PropelCollection) {
            $this->collMultimediaTypeHebergementI18ns->clearIterator();
        }
        $this->collMultimediaTypeHebergementI18ns = null;
        $this->aTypeHebergement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MultimediaTypeHebergementPeer::DEFAULT_STRING_FORMAT);
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
     * @return     MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = MultimediaTypeHebergementPeer::UPDATED_AT;

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

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    MultimediaTypeHebergement The current object (for fluent API support)
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
     * @return MultimediaTypeHebergementI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collMultimediaTypeHebergementI18ns) {
                foreach ($this->collMultimediaTypeHebergementI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new MultimediaTypeHebergementI18n();
                $translation->setLocale($locale);
            } else {
                $translation = MultimediaTypeHebergementI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addMultimediaTypeHebergementI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    MultimediaTypeHebergement The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            MultimediaTypeHebergementI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collMultimediaTypeHebergementI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collMultimediaTypeHebergementI18ns[$key]);
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
     * @return MultimediaTypeHebergementI18n */
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
         * @return MultimediaTypeHebergementI18n The current object (for fluent API support)
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
            $this->resetModified(MultimediaTypeHebergementPeer::IMAGE_PATH);
        }
    
        $this->uploadImagePath($form);
        
        return $this->save($con);
    }
    
    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/multimedia_type_hebergements';
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
