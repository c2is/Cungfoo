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
use Cungfoo\Model\PortfolioMedia;
use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioMediaTagQuery;
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioTagI18n;
use Cungfoo\Model\PortfolioTagI18nQuery;
use Cungfoo\Model\PortfolioTagPeer;
use Cungfoo\Model\PortfolioTagQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'portfolio_tag' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioTag extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\PortfolioTagPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PortfolioTagPeer
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
     * The value for the description field.
     * @var        string
     */
    protected $description;

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
     * @var        PropelObjectCollection|PortfolioMediaTag[] Collection to store aggregation of PortfolioMediaTag objects.
     */
    protected $collPortfolioMediaTags;
    protected $collPortfolioMediaTagsPartial;

    /**
     * @var        PropelObjectCollection|PortfolioTagI18n[] Collection to store aggregation of PortfolioTagI18n objects.
     */
    protected $collPortfolioTagI18ns;
    protected $collPortfolioTagI18nsPartial;

    /**
     * @var        PropelObjectCollection|PortfolioMedia[] Collection to store aggregation of PortfolioMedia objects.
     */
    protected $collPortfolioMedias;

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
     * @var        array[PortfolioTagI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioMediasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioMediaTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioTagI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BasePortfolioTag object.
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
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PortfolioTagPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = PortfolioTagPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = PortfolioTagPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PortfolioTagPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PortfolioTagPeer::UPDATED_AT;
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
     * @return PortfolioTag The current object (for fluent API support)
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
            $this->modifiedColumns[] = PortfolioTagPeer::ACTIVE;
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
            $this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->created_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->updated_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = PortfolioTagPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating PortfolioTag object", $e);
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
            $con = Propel::getConnection(PortfolioTagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PortfolioTagPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPortfolioMediaTags = null;

            $this->collPortfolioTagI18ns = null;

            $this->collPortfolioMedias = null;
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
            $con = Propel::getConnection(PortfolioTagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PortfolioTagQuery::create()
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
            $con = Propel::getConnection(PortfolioTagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PortfolioTagPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PortfolioTagPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PortfolioTagPeer::UPDATED_AT)) {
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
                PortfolioTagPeer::addInstanceToPool($this);
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

            if ($this->portfolioMediasScheduledForDeletion !== null) {
                if (!$this->portfolioMediasScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->portfolioMediasScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    PortfolioMediaTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->portfolioMediasScheduledForDeletion = null;
                }

                foreach ($this->getPortfolioMedias() as $portfolioMedia) {
                    if ($portfolioMedia->isModified()) {
                        $portfolioMedia->save($con);
                    }
                }
            }

            if ($this->portfolioMediaTagsScheduledForDeletion !== null) {
                if (!$this->portfolioMediaTagsScheduledForDeletion->isEmpty()) {
                    PortfolioMediaTagQuery::create()
                        ->filterByPrimaryKeys($this->portfolioMediaTagsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->portfolioMediaTagsScheduledForDeletion = null;
                }
            }

            if ($this->collPortfolioMediaTags !== null) {
                foreach ($this->collPortfolioMediaTags as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->portfolioTagI18nsScheduledForDeletion !== null) {
                if (!$this->portfolioTagI18nsScheduledForDeletion->isEmpty()) {
                    PortfolioTagI18nQuery::create()
                        ->filterByPrimaryKeys($this->portfolioTagI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->portfolioTagI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPortfolioTagI18ns !== null) {
                foreach ($this->collPortfolioTagI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = PortfolioTagPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PortfolioTagPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PortfolioTagPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PortfolioTagPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(PortfolioTagPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(PortfolioTagPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PortfolioTagPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(PortfolioTagPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `portfolio_tag` (%s) VALUES (%s)',
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
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
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


            if (($retval = PortfolioTagPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPortfolioMediaTags !== null) {
                    foreach ($this->collPortfolioMediaTags as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPortfolioTagI18ns !== null) {
                    foreach ($this->collPortfolioTagI18ns as $referrerFK) {
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
        $pos = PortfolioTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDescription();
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
        if (isset($alreadyDumpedObjects['PortfolioTag'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PortfolioTag'][$this->getPrimaryKey()] = true;
        $keys = PortfolioTagPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
            $keys[5] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collPortfolioMediaTags) {
                $result['PortfolioMediaTags'] = $this->collPortfolioMediaTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPortfolioTagI18ns) {
                $result['PortfolioTagI18ns'] = $this->collPortfolioTagI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PortfolioTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDescription($value);
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
        $keys = PortfolioTagPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
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
        $criteria = new Criteria(PortfolioTagPeer::DATABASE_NAME);

        if ($this->isColumnModified(PortfolioTagPeer::ID)) $criteria->add(PortfolioTagPeer::ID, $this->id);
        if ($this->isColumnModified(PortfolioTagPeer::NAME)) $criteria->add(PortfolioTagPeer::NAME, $this->name);
        if ($this->isColumnModified(PortfolioTagPeer::DESCRIPTION)) $criteria->add(PortfolioTagPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(PortfolioTagPeer::CREATED_AT)) $criteria->add(PortfolioTagPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PortfolioTagPeer::UPDATED_AT)) $criteria->add(PortfolioTagPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(PortfolioTagPeer::ACTIVE)) $criteria->add(PortfolioTagPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(PortfolioTagPeer::DATABASE_NAME);
        $criteria->add(PortfolioTagPeer::ID, $this->id);

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
     * @param object $copyObj An object of PortfolioTag (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPortfolioMediaTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPortfolioMediaTag($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPortfolioTagI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPortfolioTagI18n($relObj->copy($deepCopy));
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
     * @return PortfolioTag Clone of current object.
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
     * @return PortfolioTagPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PortfolioTagPeer();
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
        if ('PortfolioMediaTag' == $relationName) {
            $this->initPortfolioMediaTags();
        }
        if ('PortfolioTagI18n' == $relationName) {
            $this->initPortfolioTagI18ns();
        }
    }

    /**
     * Clears out the collPortfolioMediaTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioTag The current object (for fluent API support)
     * @see        addPortfolioMediaTags()
     */
    public function clearPortfolioMediaTags()
    {
        $this->collPortfolioMediaTags = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioMediaTagsPartial = null;

        return $this;
    }

    /**
     * reset is the collPortfolioMediaTags collection loaded partially
     *
     * @return void
     */
    public function resetPartialPortfolioMediaTags($v = true)
    {
        $this->collPortfolioMediaTagsPartial = $v;
    }

    /**
     * Initializes the collPortfolioMediaTags collection.
     *
     * By default this just sets the collPortfolioMediaTags collection to an empty array (like clearcollPortfolioMediaTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPortfolioMediaTags($overrideExisting = true)
    {
        if (null !== $this->collPortfolioMediaTags && !$overrideExisting) {
            return;
        }
        $this->collPortfolioMediaTags = new PropelObjectCollection();
        $this->collPortfolioMediaTags->setModel('PortfolioMediaTag');
    }

    /**
     * Gets an array of PortfolioMediaTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioTag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PortfolioMediaTag[] List of PortfolioMediaTag objects
     * @throws PropelException
     */
    public function getPortfolioMediaTags($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioMediaTagsPartial && !$this->isNew();
        if (null === $this->collPortfolioMediaTags || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPortfolioMediaTags) {
                // return empty collection
                $this->initPortfolioMediaTags();
            } else {
                $collPortfolioMediaTags = PortfolioMediaTagQuery::create(null, $criteria)
                    ->filterByPortfolioTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPortfolioMediaTagsPartial && count($collPortfolioMediaTags)) {
                      $this->initPortfolioMediaTags(false);

                      foreach($collPortfolioMediaTags as $obj) {
                        if (false == $this->collPortfolioMediaTags->contains($obj)) {
                          $this->collPortfolioMediaTags->append($obj);
                        }
                      }

                      $this->collPortfolioMediaTagsPartial = true;
                    }

                    return $collPortfolioMediaTags;
                }

                if($partial && $this->collPortfolioMediaTags) {
                    foreach($this->collPortfolioMediaTags as $obj) {
                        if($obj->isNew()) {
                            $collPortfolioMediaTags[] = $obj;
                        }
                    }
                }

                $this->collPortfolioMediaTags = $collPortfolioMediaTags;
                $this->collPortfolioMediaTagsPartial = false;
            }
        }

        return $this->collPortfolioMediaTags;
    }

    /**
     * Sets a collection of PortfolioMediaTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioMediaTags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setPortfolioMediaTags(PropelCollection $portfolioMediaTags, PropelPDO $con = null)
    {
        $this->portfolioMediaTagsScheduledForDeletion = $this->getPortfolioMediaTags(new Criteria(), $con)->diff($portfolioMediaTags);

        foreach ($this->portfolioMediaTagsScheduledForDeletion as $portfolioMediaTagRemoved) {
            $portfolioMediaTagRemoved->setPortfolioTag(null);
        }

        $this->collPortfolioMediaTags = null;
        foreach ($portfolioMediaTags as $portfolioMediaTag) {
            $this->addPortfolioMediaTag($portfolioMediaTag);
        }

        $this->collPortfolioMediaTags = $portfolioMediaTags;
        $this->collPortfolioMediaTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PortfolioMediaTag objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PortfolioMediaTag objects.
     * @throws PropelException
     */
    public function countPortfolioMediaTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioMediaTagsPartial && !$this->isNew();
        if (null === $this->collPortfolioMediaTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPortfolioMediaTags) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPortfolioMediaTags());
            }
            $query = PortfolioMediaTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPortfolioTag($this)
                ->count($con);
        }

        return count($this->collPortfolioMediaTags);
    }

    /**
     * Method called to associate a PortfolioMediaTag object to this object
     * through the PortfolioMediaTag foreign key attribute.
     *
     * @param    PortfolioMediaTag $l PortfolioMediaTag
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function addPortfolioMediaTag(PortfolioMediaTag $l)
    {
        if ($this->collPortfolioMediaTags === null) {
            $this->initPortfolioMediaTags();
            $this->collPortfolioMediaTagsPartial = true;
        }
        if (!in_array($l, $this->collPortfolioMediaTags->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioMediaTag($l);
        }

        return $this;
    }

    /**
     * @param	PortfolioMediaTag $portfolioMediaTag The portfolioMediaTag object to add.
     */
    protected function doAddPortfolioMediaTag($portfolioMediaTag)
    {
        $this->collPortfolioMediaTags[]= $portfolioMediaTag;
        $portfolioMediaTag->setPortfolioTag($this);
    }

    /**
     * @param	PortfolioMediaTag $portfolioMediaTag The portfolioMediaTag object to remove.
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function removePortfolioMediaTag($portfolioMediaTag)
    {
        if ($this->getPortfolioMediaTags()->contains($portfolioMediaTag)) {
            $this->collPortfolioMediaTags->remove($this->collPortfolioMediaTags->search($portfolioMediaTag));
            if (null === $this->portfolioMediaTagsScheduledForDeletion) {
                $this->portfolioMediaTagsScheduledForDeletion = clone $this->collPortfolioMediaTags;
                $this->portfolioMediaTagsScheduledForDeletion->clear();
            }
            $this->portfolioMediaTagsScheduledForDeletion[]= $portfolioMediaTag;
            $portfolioMediaTag->setPortfolioTag(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PortfolioTag is new, it will return
     * an empty collection; or if this PortfolioTag has previously
     * been saved, it will retrieve related PortfolioMediaTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PortfolioTag.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PortfolioMediaTag[] List of PortfolioMediaTag objects
     */
    public function getPortfolioMediaTagsJoinPortfolioMedia($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PortfolioMediaTagQuery::create(null, $criteria);
        $query->joinWith('PortfolioMedia', $join_behavior);

        return $this->getPortfolioMediaTags($query, $con);
    }

    /**
     * Clears out the collPortfolioTagI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioTag The current object (for fluent API support)
     * @see        addPortfolioTagI18ns()
     */
    public function clearPortfolioTagI18ns()
    {
        $this->collPortfolioTagI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioTagI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collPortfolioTagI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialPortfolioTagI18ns($v = true)
    {
        $this->collPortfolioTagI18nsPartial = $v;
    }

    /**
     * Initializes the collPortfolioTagI18ns collection.
     *
     * By default this just sets the collPortfolioTagI18ns collection to an empty array (like clearcollPortfolioTagI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPortfolioTagI18ns($overrideExisting = true)
    {
        if (null !== $this->collPortfolioTagI18ns && !$overrideExisting) {
            return;
        }
        $this->collPortfolioTagI18ns = new PropelObjectCollection();
        $this->collPortfolioTagI18ns->setModel('PortfolioTagI18n');
    }

    /**
     * Gets an array of PortfolioTagI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioTag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PortfolioTagI18n[] List of PortfolioTagI18n objects
     * @throws PropelException
     */
    public function getPortfolioTagI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioTagI18nsPartial && !$this->isNew();
        if (null === $this->collPortfolioTagI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPortfolioTagI18ns) {
                // return empty collection
                $this->initPortfolioTagI18ns();
            } else {
                $collPortfolioTagI18ns = PortfolioTagI18nQuery::create(null, $criteria)
                    ->filterByPortfolioTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPortfolioTagI18nsPartial && count($collPortfolioTagI18ns)) {
                      $this->initPortfolioTagI18ns(false);

                      foreach($collPortfolioTagI18ns as $obj) {
                        if (false == $this->collPortfolioTagI18ns->contains($obj)) {
                          $this->collPortfolioTagI18ns->append($obj);
                        }
                      }

                      $this->collPortfolioTagI18nsPartial = true;
                    }

                    return $collPortfolioTagI18ns;
                }

                if($partial && $this->collPortfolioTagI18ns) {
                    foreach($this->collPortfolioTagI18ns as $obj) {
                        if($obj->isNew()) {
                            $collPortfolioTagI18ns[] = $obj;
                        }
                    }
                }

                $this->collPortfolioTagI18ns = $collPortfolioTagI18ns;
                $this->collPortfolioTagI18nsPartial = false;
            }
        }

        return $this->collPortfolioTagI18ns;
    }

    /**
     * Sets a collection of PortfolioTagI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioTagI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setPortfolioTagI18ns(PropelCollection $portfolioTagI18ns, PropelPDO $con = null)
    {
        $this->portfolioTagI18nsScheduledForDeletion = $this->getPortfolioTagI18ns(new Criteria(), $con)->diff($portfolioTagI18ns);

        foreach ($this->portfolioTagI18nsScheduledForDeletion as $portfolioTagI18nRemoved) {
            $portfolioTagI18nRemoved->setPortfolioTag(null);
        }

        $this->collPortfolioTagI18ns = null;
        foreach ($portfolioTagI18ns as $portfolioTagI18n) {
            $this->addPortfolioTagI18n($portfolioTagI18n);
        }

        $this->collPortfolioTagI18ns = $portfolioTagI18ns;
        $this->collPortfolioTagI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PortfolioTagI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PortfolioTagI18n objects.
     * @throws PropelException
     */
    public function countPortfolioTagI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioTagI18nsPartial && !$this->isNew();
        if (null === $this->collPortfolioTagI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPortfolioTagI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPortfolioTagI18ns());
            }
            $query = PortfolioTagI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPortfolioTag($this)
                ->count($con);
        }

        return count($this->collPortfolioTagI18ns);
    }

    /**
     * Method called to associate a PortfolioTagI18n object to this object
     * through the PortfolioTagI18n foreign key attribute.
     *
     * @param    PortfolioTagI18n $l PortfolioTagI18n
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function addPortfolioTagI18n(PortfolioTagI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPortfolioTagI18ns === null) {
            $this->initPortfolioTagI18ns();
            $this->collPortfolioTagI18nsPartial = true;
        }
        if (!in_array($l, $this->collPortfolioTagI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioTagI18n($l);
        }

        return $this;
    }

    /**
     * @param	PortfolioTagI18n $portfolioTagI18n The portfolioTagI18n object to add.
     */
    protected function doAddPortfolioTagI18n($portfolioTagI18n)
    {
        $this->collPortfolioTagI18ns[]= $portfolioTagI18n;
        $portfolioTagI18n->setPortfolioTag($this);
    }

    /**
     * @param	PortfolioTagI18n $portfolioTagI18n The portfolioTagI18n object to remove.
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function removePortfolioTagI18n($portfolioTagI18n)
    {
        if ($this->getPortfolioTagI18ns()->contains($portfolioTagI18n)) {
            $this->collPortfolioTagI18ns->remove($this->collPortfolioTagI18ns->search($portfolioTagI18n));
            if (null === $this->portfolioTagI18nsScheduledForDeletion) {
                $this->portfolioTagI18nsScheduledForDeletion = clone $this->collPortfolioTagI18ns;
                $this->portfolioTagI18nsScheduledForDeletion->clear();
            }
            $this->portfolioTagI18nsScheduledForDeletion[]= $portfolioTagI18n;
            $portfolioTagI18n->setPortfolioTag(null);
        }

        return $this;
    }

    /**
     * Clears out the collPortfolioMedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioTag The current object (for fluent API support)
     * @see        addPortfolioMedias()
     */
    public function clearPortfolioMedias()
    {
        $this->collPortfolioMedias = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioMediasPartial = null;

        return $this;
    }

    /**
     * Initializes the collPortfolioMedias collection.
     *
     * By default this just sets the collPortfolioMedias collection to an empty collection (like clearPortfolioMedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPortfolioMedias()
    {
        $this->collPortfolioMedias = new PropelObjectCollection();
        $this->collPortfolioMedias->setModel('PortfolioMedia');
    }

    /**
     * Gets a collection of PortfolioMedia objects related by a many-to-many relationship
     * to the current object by way of the portfolio_media_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioTag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|PortfolioMedia[] List of PortfolioMedia objects
     */
    public function getPortfolioMedias($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPortfolioMedias || null !== $criteria) {
            if ($this->isNew() && null === $this->collPortfolioMedias) {
                // return empty collection
                $this->initPortfolioMedias();
            } else {
                $collPortfolioMedias = PortfolioMediaQuery::create(null, $criteria)
                    ->filterByPortfolioTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPortfolioMedias;
                }
                $this->collPortfolioMedias = $collPortfolioMedias;
            }
        }

        return $this->collPortfolioMedias;
    }

    /**
     * Sets a collection of PortfolioMedia objects related by a many-to-many relationship
     * to the current object by way of the portfolio_media_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioMedias A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function setPortfolioMedias(PropelCollection $portfolioMedias, PropelPDO $con = null)
    {
        $this->clearPortfolioMedias();
        $currentPortfolioMedias = $this->getPortfolioMedias();

        $this->portfolioMediasScheduledForDeletion = $currentPortfolioMedias->diff($portfolioMedias);

        foreach ($portfolioMedias as $portfolioMedia) {
            if (!$currentPortfolioMedias->contains($portfolioMedia)) {
                $this->doAddPortfolioMedia($portfolioMedia);
            }
        }

        $this->collPortfolioMedias = $portfolioMedias;

        return $this;
    }

    /**
     * Gets the number of PortfolioMedia objects related by a many-to-many relationship
     * to the current object by way of the portfolio_media_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related PortfolioMedia objects
     */
    public function countPortfolioMedias($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPortfolioMedias || null !== $criteria) {
            if ($this->isNew() && null === $this->collPortfolioMedias) {
                return 0;
            } else {
                $query = PortfolioMediaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPortfolioTag($this)
                    ->count($con);
            }
        } else {
            return count($this->collPortfolioMedias);
        }
    }

    /**
     * Associate a PortfolioMedia object to this object
     * through the portfolio_media_tag cross reference table.
     *
     * @param  PortfolioMedia $portfolioMedia The PortfolioMediaTag object to relate
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function addPortfolioMedia(PortfolioMedia $portfolioMedia)
    {
        if ($this->collPortfolioMedias === null) {
            $this->initPortfolioMedias();
        }
        if (!$this->collPortfolioMedias->contains($portfolioMedia)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioMedia($portfolioMedia);

            $this->collPortfolioMedias[]= $portfolioMedia;
        }

        return $this;
    }

    /**
     * @param	PortfolioMedia $portfolioMedia The portfolioMedia object to add.
     */
    protected function doAddPortfolioMedia($portfolioMedia)
    {
        $portfolioMediaTag = new PortfolioMediaTag();
        $portfolioMediaTag->setPortfolioMedia($portfolioMedia);
        $this->addPortfolioMediaTag($portfolioMediaTag);
    }

    /**
     * Remove a PortfolioMedia object to this object
     * through the portfolio_media_tag cross reference table.
     *
     * @param PortfolioMedia $portfolioMedia The PortfolioMediaTag object to relate
     * @return PortfolioTag The current object (for fluent API support)
     */
    public function removePortfolioMedia(PortfolioMedia $portfolioMedia)
    {
        if ($this->getPortfolioMedias()->contains($portfolioMedia)) {
            $this->collPortfolioMedias->remove($this->collPortfolioMedias->search($portfolioMedia));
            if (null === $this->portfolioMediasScheduledForDeletion) {
                $this->portfolioMediasScheduledForDeletion = clone $this->collPortfolioMedias;
                $this->portfolioMediasScheduledForDeletion->clear();
            }
            $this->portfolioMediasScheduledForDeletion[]= $portfolioMedia;
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
        $this->description = null;
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
            if ($this->collPortfolioMediaTags) {
                foreach ($this->collPortfolioMediaTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPortfolioTagI18ns) {
                foreach ($this->collPortfolioTagI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPortfolioMedias) {
                foreach ($this->collPortfolioMedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collPortfolioMediaTags instanceof PropelCollection) {
            $this->collPortfolioMediaTags->clearIterator();
        }
        $this->collPortfolioMediaTags = null;
        if ($this->collPortfolioTagI18ns instanceof PropelCollection) {
            $this->collPortfolioTagI18ns->clearIterator();
        }
        $this->collPortfolioTagI18ns = null;
        if ($this->collPortfolioMedias instanceof PropelCollection) {
            $this->collPortfolioMedias->clearIterator();
        }
        $this->collPortfolioMedias = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PortfolioTagPeer::DEFAULT_STRING_FORMAT);
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
     * @return     PortfolioTag The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PortfolioTagPeer::UPDATED_AT;

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

    public function getPortfolioMediasActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\PortfolioMediaPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PortfolioMediaI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PortfolioMediaPeer::ID, \Cungfoo\Model\PortfolioMediaI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioMediaI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PortfolioMediaI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioMediaI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PortfolioMediaI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioMediaI18nPeer::LOCALE), $this->currentLocale);

        return $this->getPortfolioMedias($criteria, $con);
    }

    public function getPortfolioMediaTagsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\PortfolioMediaTagPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PortfolioMediaTagI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PortfolioMediaTagPeer::ID, \Cungfoo\Model\PortfolioMediaTagI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioMediaTagI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PortfolioMediaTagI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioMediaTagI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PortfolioMediaTagI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioMediaTagI18nPeer::LOCALE), $this->currentLocale);

        return $this->getPortfolioMediaTags($criteria, $con);
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
     * @return    PortfolioTag The current object (for fluent API support)
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
     * @return PortfolioTagI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPortfolioTagI18ns) {
                foreach ($this->collPortfolioTagI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new PortfolioTagI18n();
                $translation->setLocale($locale);
            } else {
                $translation = PortfolioTagI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPortfolioTagI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PortfolioTag The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            PortfolioTagI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPortfolioTagI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPortfolioTagI18ns[$key]);
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
     * @return PortfolioTagI18n */
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
         * @return PortfolioTagI18n The current object (for fluent API support)
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
         * @return PortfolioTagI18n The current object (for fluent API support)
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
         * @return PortfolioTagI18n The current object (for fluent API support)
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
         * @return PortfolioTagI18n The current object (for fluent API support)
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
         * @return PortfolioTagI18n The current object (for fluent API support)
         */
        public function setActiveLocale($v)
        {    $this->getCurrentTranslation()->setActiveLocale($v);

        return $this;
    }

}
