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
use Cungfoo\Model\PortfolioMediaI18n;
use Cungfoo\Model\PortfolioMediaI18nQuery;
use Cungfoo\Model\PortfolioMediaPeer;
use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioMediaTagQuery;
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioTagQuery;
use Cungfoo\Model\PortfolioUsage;
use Cungfoo\Model\PortfolioUsageQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'portfolio_media' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioMedia extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\PortfolioMediaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PortfolioMediaPeer
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
     * The value for the file field.
     * @var        string
     */
    protected $file;

    /**
     * The value for the width field.
     * @var        string
     */
    protected $width;

    /**
     * The value for the height field.
     * @var        string
     */
    protected $height;

    /**
     * The value for the size field.
     * @var        string
     */
    protected $size;

    /**
     * The value for the type field.
     * @var        string
     */
    protected $type;

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
     * @var        PropelObjectCollection|PortfolioUsage[] Collection to store aggregation of PortfolioUsage objects.
     */
    protected $collPortfolioUsages;
    protected $collPortfolioUsagesPartial;

    /**
     * @var        PropelObjectCollection|PortfolioMediaI18n[] Collection to store aggregation of PortfolioMediaI18n objects.
     */
    protected $collPortfolioMediaI18ns;
    protected $collPortfolioMediaI18nsPartial;

    /**
     * @var        PropelObjectCollection|PortfolioTag[] Collection to store aggregation of PortfolioTag objects.
     */
    protected $collPortfolioTags;

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
     * @var        array[PortfolioMediaI18n]
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
    protected $portfolioMediaTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioUsagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $portfolioMediaI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BasePortfolioMedia object.
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
     * Get the [file] column value.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Get the [width] column value.
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get the [height] column value.
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the [size] column value.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PortfolioMediaPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [file] column.
     *
     * @param string $v new value
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setFile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file !== $v) {
            $this->file = $v;
            $this->modifiedColumns[] = PortfolioMediaPeer::FILE;
        }


        return $this;
    } // setFile()

    /**
     * Set the value of [width] column.
     *
     * @param string $v new value
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setWidth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->width !== $v) {
            $this->width = $v;
            $this->modifiedColumns[] = PortfolioMediaPeer::WIDTH;
        }


        return $this;
    } // setWidth()

    /**
     * Set the value of [height] column.
     *
     * @param string $v new value
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setHeight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->height !== $v) {
            $this->height = $v;
            $this->modifiedColumns[] = PortfolioMediaPeer::HEIGHT;
        }


        return $this;
    } // setHeight()

    /**
     * Set the value of [size] column.
     *
     * @param string $v new value
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size !== $v) {
            $this->size = $v;
            $this->modifiedColumns[] = PortfolioMediaPeer::SIZE;
        }


        return $this;
    } // setSize()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[] = PortfolioMediaPeer::TYPE;
        }


        return $this;
    } // setType()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PortfolioMediaPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PortfolioMediaPeer::UPDATED_AT;
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
     * @return PortfolioMedia The current object (for fluent API support)
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
            $this->modifiedColumns[] = PortfolioMediaPeer::ACTIVE;
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
            $this->file = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->width = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->height = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->size = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->type = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->created_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->updated_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->active = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 9; // 9 = PortfolioMediaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating PortfolioMedia object", $e);
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
            $con = Propel::getConnection(PortfolioMediaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PortfolioMediaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPortfolioMediaTags = null;

            $this->collPortfolioUsages = null;

            $this->collPortfolioMediaI18ns = null;

            $this->collPortfolioTags = null;
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
            $con = Propel::getConnection(PortfolioMediaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PortfolioMediaQuery::create()
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
            $con = Propel::getConnection(PortfolioMediaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PortfolioMediaPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PortfolioMediaPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PortfolioMediaPeer::UPDATED_AT)) {
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
                PortfolioMediaPeer::addInstanceToPool($this);
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
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->portfolioTagsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    PortfolioMediaTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->portfolioTagsScheduledForDeletion = null;
                }

                foreach ($this->getPortfolioTags() as $portfolioTag) {
                    if ($portfolioTag->isModified()) {
                        $portfolioTag->save($con);
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

            if ($this->portfolioUsagesScheduledForDeletion !== null) {
                if (!$this->portfolioUsagesScheduledForDeletion->isEmpty()) {
                    PortfolioUsageQuery::create()
                        ->filterByPrimaryKeys($this->portfolioUsagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->portfolioUsagesScheduledForDeletion = null;
                }
            }

            if ($this->collPortfolioUsages !== null) {
                foreach ($this->collPortfolioUsages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->portfolioMediaI18nsScheduledForDeletion !== null) {
                if (!$this->portfolioMediaI18nsScheduledForDeletion->isEmpty()) {
                    PortfolioMediaI18nQuery::create()
                        ->filterByPrimaryKeys($this->portfolioMediaI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->portfolioMediaI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPortfolioMediaI18ns !== null) {
                foreach ($this->collPortfolioMediaI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = PortfolioMediaPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PortfolioMediaPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PortfolioMediaPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::FILE)) {
            $modifiedColumns[':p' . $index++]  = '`file`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::WIDTH)) {
            $modifiedColumns[':p' . $index++]  = '`width`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`height`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::SIZE)) {
            $modifiedColumns[':p' . $index++]  = '`size`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(PortfolioMediaPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `portfolio_media` (%s) VALUES (%s)',
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
                    case '`file`':
                        $stmt->bindValue($identifier, $this->file, PDO::PARAM_STR);
                        break;
                    case '`width`':
                        $stmt->bindValue($identifier, $this->width, PDO::PARAM_STR);
                        break;
                    case '`height`':
                        $stmt->bindValue($identifier, $this->height, PDO::PARAM_STR);
                        break;
                    case '`size`':
                        $stmt->bindValue($identifier, $this->size, PDO::PARAM_STR);
                        break;
                    case '`type`':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
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


            if (($retval = PortfolioMediaPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPortfolioMediaTags !== null) {
                    foreach ($this->collPortfolioMediaTags as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPortfolioUsages !== null) {
                    foreach ($this->collPortfolioUsages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPortfolioMediaI18ns !== null) {
                    foreach ($this->collPortfolioMediaI18ns as $referrerFK) {
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
        $pos = PortfolioMediaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFile();
                break;
            case 2:
                return $this->getWidth();
                break;
            case 3:
                return $this->getHeight();
                break;
            case 4:
                return $this->getSize();
                break;
            case 5:
                return $this->getType();
                break;
            case 6:
                return $this->getCreatedAt();
                break;
            case 7:
                return $this->getUpdatedAt();
                break;
            case 8:
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
        if (isset($alreadyDumpedObjects['PortfolioMedia'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PortfolioMedia'][$this->getPrimaryKey()] = true;
        $keys = PortfolioMediaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFile(),
            $keys[2] => $this->getWidth(),
            $keys[3] => $this->getHeight(),
            $keys[4] => $this->getSize(),
            $keys[5] => $this->getType(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
            $keys[8] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collPortfolioMediaTags) {
                $result['PortfolioMediaTags'] = $this->collPortfolioMediaTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPortfolioUsages) {
                $result['PortfolioUsages'] = $this->collPortfolioUsages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPortfolioMediaI18ns) {
                $result['PortfolioMediaI18ns'] = $this->collPortfolioMediaI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PortfolioMediaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFile($value);
                break;
            case 2:
                $this->setWidth($value);
                break;
            case 3:
                $this->setHeight($value);
                break;
            case 4:
                $this->setSize($value);
                break;
            case 5:
                $this->setType($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
                $this->setUpdatedAt($value);
                break;
            case 8:
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
        $keys = PortfolioMediaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFile($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setWidth($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setHeight($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSize($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setType($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setActive($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PortfolioMediaPeer::DATABASE_NAME);

        if ($this->isColumnModified(PortfolioMediaPeer::ID)) $criteria->add(PortfolioMediaPeer::ID, $this->id);
        if ($this->isColumnModified(PortfolioMediaPeer::FILE)) $criteria->add(PortfolioMediaPeer::FILE, $this->file);
        if ($this->isColumnModified(PortfolioMediaPeer::WIDTH)) $criteria->add(PortfolioMediaPeer::WIDTH, $this->width);
        if ($this->isColumnModified(PortfolioMediaPeer::HEIGHT)) $criteria->add(PortfolioMediaPeer::HEIGHT, $this->height);
        if ($this->isColumnModified(PortfolioMediaPeer::SIZE)) $criteria->add(PortfolioMediaPeer::SIZE, $this->size);
        if ($this->isColumnModified(PortfolioMediaPeer::TYPE)) $criteria->add(PortfolioMediaPeer::TYPE, $this->type);
        if ($this->isColumnModified(PortfolioMediaPeer::CREATED_AT)) $criteria->add(PortfolioMediaPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PortfolioMediaPeer::UPDATED_AT)) $criteria->add(PortfolioMediaPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(PortfolioMediaPeer::ACTIVE)) $criteria->add(PortfolioMediaPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(PortfolioMediaPeer::DATABASE_NAME);
        $criteria->add(PortfolioMediaPeer::ID, $this->id);

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
     * @param object $copyObj An object of PortfolioMedia (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFile($this->getFile());
        $copyObj->setWidth($this->getWidth());
        $copyObj->setHeight($this->getHeight());
        $copyObj->setSize($this->getSize());
        $copyObj->setType($this->getType());
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

            foreach ($this->getPortfolioUsages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPortfolioUsage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPortfolioMediaI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPortfolioMediaI18n($relObj->copy($deepCopy));
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
     * @return PortfolioMedia Clone of current object.
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
     * @return PortfolioMediaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PortfolioMediaPeer();
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
        if ('PortfolioUsage' == $relationName) {
            $this->initPortfolioUsages();
        }
        if ('PortfolioMediaI18n' == $relationName) {
            $this->initPortfolioMediaI18ns();
        }
    }

    /**
     * Clears out the collPortfolioMediaTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioMedia The current object (for fluent API support)
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
     * If this PortfolioMedia is new, it will return
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
                    ->filterByPortfolioMedia($this)
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
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setPortfolioMediaTags(PropelCollection $portfolioMediaTags, PropelPDO $con = null)
    {
        $this->portfolioMediaTagsScheduledForDeletion = $this->getPortfolioMediaTags(new Criteria(), $con)->diff($portfolioMediaTags);

        foreach ($this->portfolioMediaTagsScheduledForDeletion as $portfolioMediaTagRemoved) {
            $portfolioMediaTagRemoved->setPortfolioMedia(null);
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
                ->filterByPortfolioMedia($this)
                ->count($con);
        }

        return count($this->collPortfolioMediaTags);
    }

    /**
     * Method called to associate a PortfolioMediaTag object to this object
     * through the PortfolioMediaTag foreign key attribute.
     *
     * @param    PortfolioMediaTag $l PortfolioMediaTag
     * @return PortfolioMedia The current object (for fluent API support)
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
        $portfolioMediaTag->setPortfolioMedia($this);
    }

    /**
     * @param	PortfolioMediaTag $portfolioMediaTag The portfolioMediaTag object to remove.
     * @return PortfolioMedia The current object (for fluent API support)
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
            $portfolioMediaTag->setPortfolioMedia(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PortfolioMedia is new, it will return
     * an empty collection; or if this PortfolioMedia has previously
     * been saved, it will retrieve related PortfolioMediaTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PortfolioMedia.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PortfolioMediaTag[] List of PortfolioMediaTag objects
     */
    public function getPortfolioMediaTagsJoinPortfolioTag($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PortfolioMediaTagQuery::create(null, $criteria);
        $query->joinWith('PortfolioTag', $join_behavior);

        return $this->getPortfolioMediaTags($query, $con);
    }

    /**
     * Clears out the collPortfolioUsages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioMedia The current object (for fluent API support)
     * @see        addPortfolioUsages()
     */
    public function clearPortfolioUsages()
    {
        $this->collPortfolioUsages = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioUsagesPartial = null;

        return $this;
    }

    /**
     * reset is the collPortfolioUsages collection loaded partially
     *
     * @return void
     */
    public function resetPartialPortfolioUsages($v = true)
    {
        $this->collPortfolioUsagesPartial = $v;
    }

    /**
     * Initializes the collPortfolioUsages collection.
     *
     * By default this just sets the collPortfolioUsages collection to an empty array (like clearcollPortfolioUsages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPortfolioUsages($overrideExisting = true)
    {
        if (null !== $this->collPortfolioUsages && !$overrideExisting) {
            return;
        }
        $this->collPortfolioUsages = new PropelObjectCollection();
        $this->collPortfolioUsages->setModel('PortfolioUsage');
    }

    /**
     * Gets an array of PortfolioUsage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioMedia is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PortfolioUsage[] List of PortfolioUsage objects
     * @throws PropelException
     */
    public function getPortfolioUsages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioUsagesPartial && !$this->isNew();
        if (null === $this->collPortfolioUsages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPortfolioUsages) {
                // return empty collection
                $this->initPortfolioUsages();
            } else {
                $collPortfolioUsages = PortfolioUsageQuery::create(null, $criteria)
                    ->filterByPortfolioMedia($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPortfolioUsagesPartial && count($collPortfolioUsages)) {
                      $this->initPortfolioUsages(false);

                      foreach($collPortfolioUsages as $obj) {
                        if (false == $this->collPortfolioUsages->contains($obj)) {
                          $this->collPortfolioUsages->append($obj);
                        }
                      }

                      $this->collPortfolioUsagesPartial = true;
                    }

                    return $collPortfolioUsages;
                }

                if($partial && $this->collPortfolioUsages) {
                    foreach($this->collPortfolioUsages as $obj) {
                        if($obj->isNew()) {
                            $collPortfolioUsages[] = $obj;
                        }
                    }
                }

                $this->collPortfolioUsages = $collPortfolioUsages;
                $this->collPortfolioUsagesPartial = false;
            }
        }

        return $this->collPortfolioUsages;
    }

    /**
     * Sets a collection of PortfolioUsage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioUsages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setPortfolioUsages(PropelCollection $portfolioUsages, PropelPDO $con = null)
    {
        $this->portfolioUsagesScheduledForDeletion = $this->getPortfolioUsages(new Criteria(), $con)->diff($portfolioUsages);

        foreach ($this->portfolioUsagesScheduledForDeletion as $portfolioUsageRemoved) {
            $portfolioUsageRemoved->setPortfolioMedia(null);
        }

        $this->collPortfolioUsages = null;
        foreach ($portfolioUsages as $portfolioUsage) {
            $this->addPortfolioUsage($portfolioUsage);
        }

        $this->collPortfolioUsages = $portfolioUsages;
        $this->collPortfolioUsagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PortfolioUsage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PortfolioUsage objects.
     * @throws PropelException
     */
    public function countPortfolioUsages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioUsagesPartial && !$this->isNew();
        if (null === $this->collPortfolioUsages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPortfolioUsages) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPortfolioUsages());
            }
            $query = PortfolioUsageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPortfolioMedia($this)
                ->count($con);
        }

        return count($this->collPortfolioUsages);
    }

    /**
     * Method called to associate a PortfolioUsage object to this object
     * through the PortfolioUsage foreign key attribute.
     *
     * @param    PortfolioUsage $l PortfolioUsage
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function addPortfolioUsage(PortfolioUsage $l)
    {
        if ($this->collPortfolioUsages === null) {
            $this->initPortfolioUsages();
            $this->collPortfolioUsagesPartial = true;
        }
        if (!in_array($l, $this->collPortfolioUsages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioUsage($l);
        }

        return $this;
    }

    /**
     * @param	PortfolioUsage $portfolioUsage The portfolioUsage object to add.
     */
    protected function doAddPortfolioUsage($portfolioUsage)
    {
        $this->collPortfolioUsages[]= $portfolioUsage;
        $portfolioUsage->setPortfolioMedia($this);
    }

    /**
     * @param	PortfolioUsage $portfolioUsage The portfolioUsage object to remove.
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function removePortfolioUsage($portfolioUsage)
    {
        if ($this->getPortfolioUsages()->contains($portfolioUsage)) {
            $this->collPortfolioUsages->remove($this->collPortfolioUsages->search($portfolioUsage));
            if (null === $this->portfolioUsagesScheduledForDeletion) {
                $this->portfolioUsagesScheduledForDeletion = clone $this->collPortfolioUsages;
                $this->portfolioUsagesScheduledForDeletion->clear();
            }
            $this->portfolioUsagesScheduledForDeletion[]= $portfolioUsage;
            $portfolioUsage->setPortfolioMedia(null);
        }

        return $this;
    }

    /**
     * Clears out the collPortfolioMediaI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioMedia The current object (for fluent API support)
     * @see        addPortfolioMediaI18ns()
     */
    public function clearPortfolioMediaI18ns()
    {
        $this->collPortfolioMediaI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioMediaI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collPortfolioMediaI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialPortfolioMediaI18ns($v = true)
    {
        $this->collPortfolioMediaI18nsPartial = $v;
    }

    /**
     * Initializes the collPortfolioMediaI18ns collection.
     *
     * By default this just sets the collPortfolioMediaI18ns collection to an empty array (like clearcollPortfolioMediaI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPortfolioMediaI18ns($overrideExisting = true)
    {
        if (null !== $this->collPortfolioMediaI18ns && !$overrideExisting) {
            return;
        }
        $this->collPortfolioMediaI18ns = new PropelObjectCollection();
        $this->collPortfolioMediaI18ns->setModel('PortfolioMediaI18n');
    }

    /**
     * Gets an array of PortfolioMediaI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioMedia is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PortfolioMediaI18n[] List of PortfolioMediaI18n objects
     * @throws PropelException
     */
    public function getPortfolioMediaI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioMediaI18nsPartial && !$this->isNew();
        if (null === $this->collPortfolioMediaI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPortfolioMediaI18ns) {
                // return empty collection
                $this->initPortfolioMediaI18ns();
            } else {
                $collPortfolioMediaI18ns = PortfolioMediaI18nQuery::create(null, $criteria)
                    ->filterByPortfolioMedia($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPortfolioMediaI18nsPartial && count($collPortfolioMediaI18ns)) {
                      $this->initPortfolioMediaI18ns(false);

                      foreach($collPortfolioMediaI18ns as $obj) {
                        if (false == $this->collPortfolioMediaI18ns->contains($obj)) {
                          $this->collPortfolioMediaI18ns->append($obj);
                        }
                      }

                      $this->collPortfolioMediaI18nsPartial = true;
                    }

                    return $collPortfolioMediaI18ns;
                }

                if($partial && $this->collPortfolioMediaI18ns) {
                    foreach($this->collPortfolioMediaI18ns as $obj) {
                        if($obj->isNew()) {
                            $collPortfolioMediaI18ns[] = $obj;
                        }
                    }
                }

                $this->collPortfolioMediaI18ns = $collPortfolioMediaI18ns;
                $this->collPortfolioMediaI18nsPartial = false;
            }
        }

        return $this->collPortfolioMediaI18ns;
    }

    /**
     * Sets a collection of PortfolioMediaI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioMediaI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setPortfolioMediaI18ns(PropelCollection $portfolioMediaI18ns, PropelPDO $con = null)
    {
        $this->portfolioMediaI18nsScheduledForDeletion = $this->getPortfolioMediaI18ns(new Criteria(), $con)->diff($portfolioMediaI18ns);

        foreach ($this->portfolioMediaI18nsScheduledForDeletion as $portfolioMediaI18nRemoved) {
            $portfolioMediaI18nRemoved->setPortfolioMedia(null);
        }

        $this->collPortfolioMediaI18ns = null;
        foreach ($portfolioMediaI18ns as $portfolioMediaI18n) {
            $this->addPortfolioMediaI18n($portfolioMediaI18n);
        }

        $this->collPortfolioMediaI18ns = $portfolioMediaI18ns;
        $this->collPortfolioMediaI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PortfolioMediaI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PortfolioMediaI18n objects.
     * @throws PropelException
     */
    public function countPortfolioMediaI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPortfolioMediaI18nsPartial && !$this->isNew();
        if (null === $this->collPortfolioMediaI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPortfolioMediaI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPortfolioMediaI18ns());
            }
            $query = PortfolioMediaI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPortfolioMedia($this)
                ->count($con);
        }

        return count($this->collPortfolioMediaI18ns);
    }

    /**
     * Method called to associate a PortfolioMediaI18n object to this object
     * through the PortfolioMediaI18n foreign key attribute.
     *
     * @param    PortfolioMediaI18n $l PortfolioMediaI18n
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function addPortfolioMediaI18n(PortfolioMediaI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPortfolioMediaI18ns === null) {
            $this->initPortfolioMediaI18ns();
            $this->collPortfolioMediaI18nsPartial = true;
        }
        if (!in_array($l, $this->collPortfolioMediaI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioMediaI18n($l);
        }

        return $this;
    }

    /**
     * @param	PortfolioMediaI18n $portfolioMediaI18n The portfolioMediaI18n object to add.
     */
    protected function doAddPortfolioMediaI18n($portfolioMediaI18n)
    {
        $this->collPortfolioMediaI18ns[]= $portfolioMediaI18n;
        $portfolioMediaI18n->setPortfolioMedia($this);
    }

    /**
     * @param	PortfolioMediaI18n $portfolioMediaI18n The portfolioMediaI18n object to remove.
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function removePortfolioMediaI18n($portfolioMediaI18n)
    {
        if ($this->getPortfolioMediaI18ns()->contains($portfolioMediaI18n)) {
            $this->collPortfolioMediaI18ns->remove($this->collPortfolioMediaI18ns->search($portfolioMediaI18n));
            if (null === $this->portfolioMediaI18nsScheduledForDeletion) {
                $this->portfolioMediaI18nsScheduledForDeletion = clone $this->collPortfolioMediaI18ns;
                $this->portfolioMediaI18nsScheduledForDeletion->clear();
            }
            $this->portfolioMediaI18nsScheduledForDeletion[]= $portfolioMediaI18n;
            $portfolioMediaI18n->setPortfolioMedia(null);
        }

        return $this;
    }

    /**
     * Clears out the collPortfolioTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return PortfolioMedia The current object (for fluent API support)
     * @see        addPortfolioTags()
     */
    public function clearPortfolioTags()
    {
        $this->collPortfolioTags = null; // important to set this to null since that means it is uninitialized
        $this->collPortfolioTagsPartial = null;

        return $this;
    }

    /**
     * Initializes the collPortfolioTags collection.
     *
     * By default this just sets the collPortfolioTags collection to an empty collection (like clearPortfolioTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPortfolioTags()
    {
        $this->collPortfolioTags = new PropelObjectCollection();
        $this->collPortfolioTags->setModel('PortfolioTag');
    }

    /**
     * Gets a collection of PortfolioTag objects related by a many-to-many relationship
     * to the current object by way of the portfolio_media_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PortfolioMedia is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|PortfolioTag[] List of PortfolioTag objects
     */
    public function getPortfolioTags($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPortfolioTags || null !== $criteria) {
            if ($this->isNew() && null === $this->collPortfolioTags) {
                // return empty collection
                $this->initPortfolioTags();
            } else {
                $collPortfolioTags = PortfolioTagQuery::create(null, $criteria)
                    ->filterByPortfolioMedia($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPortfolioTags;
                }
                $this->collPortfolioTags = $collPortfolioTags;
            }
        }

        return $this->collPortfolioTags;
    }

    /**
     * Sets a collection of PortfolioTag objects related by a many-to-many relationship
     * to the current object by way of the portfolio_media_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $portfolioTags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function setPortfolioTags(PropelCollection $portfolioTags, PropelPDO $con = null)
    {
        $this->clearPortfolioTags();
        $currentPortfolioTags = $this->getPortfolioTags();

        $this->portfolioTagsScheduledForDeletion = $currentPortfolioTags->diff($portfolioTags);

        foreach ($portfolioTags as $portfolioTag) {
            if (!$currentPortfolioTags->contains($portfolioTag)) {
                $this->doAddPortfolioTag($portfolioTag);
            }
        }

        $this->collPortfolioTags = $portfolioTags;

        return $this;
    }

    /**
     * Gets the number of PortfolioTag objects related by a many-to-many relationship
     * to the current object by way of the portfolio_media_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related PortfolioTag objects
     */
    public function countPortfolioTags($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPortfolioTags || null !== $criteria) {
            if ($this->isNew() && null === $this->collPortfolioTags) {
                return 0;
            } else {
                $query = PortfolioTagQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPortfolioMedia($this)
                    ->count($con);
            }
        } else {
            return count($this->collPortfolioTags);
        }
    }

    /**
     * Associate a PortfolioTag object to this object
     * through the portfolio_media_tag cross reference table.
     *
     * @param  PortfolioTag $portfolioTag The PortfolioMediaTag object to relate
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function addPortfolioTag(PortfolioTag $portfolioTag)
    {
        if ($this->collPortfolioTags === null) {
            $this->initPortfolioTags();
        }
        if (!$this->collPortfolioTags->contains($portfolioTag)) { // only add it if the **same** object is not already associated
            $this->doAddPortfolioTag($portfolioTag);

            $this->collPortfolioTags[]= $portfolioTag;
        }

        return $this;
    }

    /**
     * @param	PortfolioTag $portfolioTag The portfolioTag object to add.
     */
    protected function doAddPortfolioTag($portfolioTag)
    {
        $portfolioMediaTag = new PortfolioMediaTag();
        $portfolioMediaTag->setPortfolioTag($portfolioTag);
        $this->addPortfolioMediaTag($portfolioMediaTag);
    }

    /**
     * Remove a PortfolioTag object to this object
     * through the portfolio_media_tag cross reference table.
     *
     * @param PortfolioTag $portfolioTag The PortfolioMediaTag object to relate
     * @return PortfolioMedia The current object (for fluent API support)
     */
    public function removePortfolioTag(PortfolioTag $portfolioTag)
    {
        if ($this->getPortfolioTags()->contains($portfolioTag)) {
            $this->collPortfolioTags->remove($this->collPortfolioTags->search($portfolioTag));
            if (null === $this->portfolioTagsScheduledForDeletion) {
                $this->portfolioTagsScheduledForDeletion = clone $this->collPortfolioTags;
                $this->portfolioTagsScheduledForDeletion->clear();
            }
            $this->portfolioTagsScheduledForDeletion[]= $portfolioTag;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->file = null;
        $this->width = null;
        $this->height = null;
        $this->size = null;
        $this->type = null;
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
            if ($this->collPortfolioUsages) {
                foreach ($this->collPortfolioUsages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPortfolioMediaI18ns) {
                foreach ($this->collPortfolioMediaI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPortfolioTags) {
                foreach ($this->collPortfolioTags as $o) {
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
        if ($this->collPortfolioUsages instanceof PropelCollection) {
            $this->collPortfolioUsages->clearIterator();
        }
        $this->collPortfolioUsages = null;
        if ($this->collPortfolioMediaI18ns instanceof PropelCollection) {
            $this->collPortfolioMediaI18ns->clearIterator();
        }
        $this->collPortfolioMediaI18ns = null;
        if ($this->collPortfolioTags instanceof PropelCollection) {
            $this->collPortfolioTags->clearIterator();
        }
        $this->collPortfolioTags = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PortfolioMediaPeer::DEFAULT_STRING_FORMAT);
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
     * @return     PortfolioMedia The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PortfolioMediaPeer::UPDATED_AT;

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
    
    public function getTagsActive($criteria = null, PropelPDO $con = null)
    {
    
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\TagPeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\TagI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\TagPeer::ID, \Cungfoo\Model\TagI18nPeer::alias('i18n_locale', \Cungfoo\Model\TagI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\TagI18nPeer::alias('i18n_locale', \Cungfoo\Model\TagI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\TagI18nPeer::alias('i18n_locale', \Cungfoo\Model\TagI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getTags($criteria, $con);
    }
    
    public function getPortfolioUsagesActive($criteria = null, PropelPDO $con = null)
    {
    
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\PortfolioUsagePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PortfolioUsageI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PortfolioUsagePeer::ID, \Cungfoo\Model\PortfolioUsageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioUsageI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PortfolioUsageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioUsageI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PortfolioUsageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PortfolioUsageI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getPortfolioUsages($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    PortfolioMedia The current object (for fluent API support)
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
     * @return PortfolioMediaI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPortfolioMediaI18ns) {
                foreach ($this->collPortfolioMediaI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new PortfolioMediaI18n();
                $translation->setLocale($locale);
            } else {
                $translation = PortfolioMediaI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPortfolioMediaI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PortfolioMedia The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            PortfolioMediaI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPortfolioMediaI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPortfolioMediaI18ns[$key]);
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
     * @return PortfolioMediaI18n */
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
         * @return PortfolioMediaI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

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
         * @return PortfolioMediaI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

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
         * @return PortfolioMediaI18n The current object (for fluent API support)
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
         * @return PortfolioMediaI18n The current object (for fluent API support)
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
         * @return PortfolioMediaI18n The current object (for fluent API support)
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
         * @return PortfolioMediaI18n The current object (for fluent API support)
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
         * @return PortfolioMediaI18n The current object (for fluent API support)
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

}
