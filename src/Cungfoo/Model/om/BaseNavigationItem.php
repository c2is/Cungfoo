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
use Cungfoo\Model\Navigation;
use Cungfoo\Model\NavigationItem;
use Cungfoo\Model\NavigationItemI18n;
use Cungfoo\Model\NavigationItemI18nQuery;
use Cungfoo\Model\NavigationItemPeer;
use Cungfoo\Model\NavigationItemQuery;
use Cungfoo\Model\NavigationQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'navigation_item' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseNavigationItem extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\NavigationItemPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NavigationItemPeer
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
     * The value for the parent_id field.
     * @var        int
     */
    protected $parent_id;

    /**
     * The value for the navigation_id field.
     * @var        int
     */
    protected $navigation_id;

    /**
     * The value for the sortable_rank field.
     * @var        int
     */
    protected $sortable_rank;

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
     * @var        NavigationItem
     */
    protected $aParent;

    /**
     * @var        Navigation
     */
    protected $aNavigation;

    /**
     * @var        PropelObjectCollection|NavigationItem[] Collection to store aggregation of NavigationItem objects.
     */
    protected $collChilds;
    protected $collChildsPartial;

    /**
     * @var        PropelObjectCollection|NavigationItemI18n[] Collection to store aggregation of NavigationItemI18n objects.
     */
    protected $collNavigationItemI18ns;
    protected $collNavigationItemI18nsPartial;

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

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'fr';

    /**
     * Current translation objects
     * @var        array[NavigationItemI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $childsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $navigationItemI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseNavigationItem object.
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
     * Get the [parent_id] column value.
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the [navigation_id] column value.
     *
     * @return int
     */
    public function getNavigationId()
    {
        return $this->navigation_id;
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
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NavigationItemPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [parent_id] column.
     *
     * @param int $v new value
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[] = NavigationItemPeer::PARENT_ID;
        }

        if ($this->aParent !== null && $this->aParent->getId() !== $v) {
            $this->aParent = null;
        }


        return $this;
    } // setParentId()

    /**
     * Set the value of [navigation_id] column.
     *
     * @param int $v new value
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setNavigationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->navigation_id !== $v) {
            $this->navigation_id = $v;
            $this->modifiedColumns[] = NavigationItemPeer::NAVIGATION_ID;
        }

        if ($this->aNavigation !== null && $this->aNavigation->getId() !== $v) {
            $this->aNavigation = null;
        }


        return $this;
    } // setNavigationId()

    /**
     * Set the value of [sortable_rank] column.
     *
     * @param int $v new value
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setSortableRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sortable_rank !== $v) {
            $this->sortable_rank = $v;
            $this->modifiedColumns[] = NavigationItemPeer::SORTABLE_RANK;
        }


        return $this;
    } // setSortableRank()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = NavigationItemPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = NavigationItemPeer::UPDATED_AT;
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
     * @return NavigationItem The current object (for fluent API support)
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
            $this->modifiedColumns[] = NavigationItemPeer::ACTIVE;
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
            $this->parent_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->navigation_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->sortable_rank = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->created_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->updated_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->active = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 7; // 7 = NavigationItemPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NavigationItem object", $e);
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

        if ($this->aParent !== null && $this->parent_id !== $this->aParent->getId()) {
            $this->aParent = null;
        }
        if ($this->aNavigation !== null && $this->navigation_id !== $this->aNavigation->getId()) {
            $this->aNavigation = null;
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
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NavigationItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aParent = null;
            $this->aNavigation = null;
            $this->collChilds = null;

            $this->collNavigationItemI18ns = null;

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
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NavigationItemQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // sortable behavior

            NavigationItemPeer::shiftRank(-1, $this->getSortableRank() + 1, null, $con);
            NavigationItemPeer::clearInstancePool();

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
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                if (!$this->isColumnModified(NavigationItemPeer::RANK_COL)) {
                    $this->setSortableRank(NavigationItemQuery::create()->getMaxRank($con) + 1);
                }

                // timestampable behavior
                if (!$this->isColumnModified(NavigationItemPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(NavigationItemPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(NavigationItemPeer::UPDATED_AT)) {
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
                NavigationItemPeer::addInstanceToPool($this);
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

            if ($this->aParent !== null) {
                if ($this->aParent->isModified() || $this->aParent->isNew()) {
                    $affectedRows += $this->aParent->save($con);
                }
                $this->setParent($this->aParent);
            }

            if ($this->aNavigation !== null) {
                if ($this->aNavigation->isModified() || $this->aNavigation->isNew()) {
                    $affectedRows += $this->aNavigation->save($con);
                }
                $this->setNavigation($this->aNavigation);
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

            if ($this->childsScheduledForDeletion !== null) {
                if (!$this->childsScheduledForDeletion->isEmpty()) {
                    foreach ($this->childsScheduledForDeletion as $child) {
                        // need to save related object because we set the relation to null
                        $child->save($con);
                    }
                    $this->childsScheduledForDeletion = null;
                }
            }

            if ($this->collChilds !== null) {
                foreach ($this->collChilds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->navigationItemI18nsScheduledForDeletion !== null) {
                if (!$this->navigationItemI18nsScheduledForDeletion->isEmpty()) {
                    NavigationItemI18nQuery::create()
                        ->filterByPrimaryKeys($this->navigationItemI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->navigationItemI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collNavigationItemI18ns !== null) {
                foreach ($this->collNavigationItemI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = NavigationItemPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NavigationItemPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NavigationItemPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NavigationItemPeer::PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`parent_id`';
        }
        if ($this->isColumnModified(NavigationItemPeer::NAVIGATION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`navigation_id`';
        }
        if ($this->isColumnModified(NavigationItemPeer::SORTABLE_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`sortable_rank`';
        }
        if ($this->isColumnModified(NavigationItemPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(NavigationItemPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(NavigationItemPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `navigation_item` (%s) VALUES (%s)',
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
                    case '`parent_id`':
                        $stmt->bindValue($identifier, $this->parent_id, PDO::PARAM_INT);
                        break;
                    case '`navigation_id`':
                        $stmt->bindValue($identifier, $this->navigation_id, PDO::PARAM_INT);
                        break;
                    case '`sortable_rank`':
                        $stmt->bindValue($identifier, $this->sortable_rank, PDO::PARAM_INT);
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

            if ($this->aParent !== null) {
                if (!$this->aParent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aParent->getValidationFailures());
                }
            }

            if ($this->aNavigation !== null) {
                if (!$this->aNavigation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNavigation->getValidationFailures());
                }
            }


            if (($retval = NavigationItemPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collChilds !== null) {
                    foreach ($this->collChilds as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNavigationItemI18ns !== null) {
                    foreach ($this->collNavigationItemI18ns as $referrerFK) {
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
        $pos = NavigationItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getParentId();
                break;
            case 2:
                return $this->getNavigationId();
                break;
            case 3:
                return $this->getSortableRank();
                break;
            case 4:
                return $this->getCreatedAt();
                break;
            case 5:
                return $this->getUpdatedAt();
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
        if (isset($alreadyDumpedObjects['NavigationItem'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NavigationItem'][$this->getPrimaryKey()] = true;
        $keys = NavigationItemPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getParentId(),
            $keys[2] => $this->getNavigationId(),
            $keys[3] => $this->getSortableRank(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
            $keys[6] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aParent) {
                $result['Parent'] = $this->aParent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aNavigation) {
                $result['Navigation'] = $this->aNavigation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collChilds) {
                $result['Childs'] = $this->collChilds->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNavigationItemI18ns) {
                $result['NavigationItemI18ns'] = $this->collNavigationItemI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = NavigationItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setParentId($value);
                break;
            case 2:
                $this->setNavigationId($value);
                break;
            case 3:
                $this->setSortableRank($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
                $this->setUpdatedAt($value);
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
        $keys = NavigationItemPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setNavigationId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSortableRank($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setActive($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NavigationItemPeer::DATABASE_NAME);

        if ($this->isColumnModified(NavigationItemPeer::ID)) $criteria->add(NavigationItemPeer::ID, $this->id);
        if ($this->isColumnModified(NavigationItemPeer::PARENT_ID)) $criteria->add(NavigationItemPeer::PARENT_ID, $this->parent_id);
        if ($this->isColumnModified(NavigationItemPeer::NAVIGATION_ID)) $criteria->add(NavigationItemPeer::NAVIGATION_ID, $this->navigation_id);
        if ($this->isColumnModified(NavigationItemPeer::SORTABLE_RANK)) $criteria->add(NavigationItemPeer::SORTABLE_RANK, $this->sortable_rank);
        if ($this->isColumnModified(NavigationItemPeer::CREATED_AT)) $criteria->add(NavigationItemPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(NavigationItemPeer::UPDATED_AT)) $criteria->add(NavigationItemPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(NavigationItemPeer::ACTIVE)) $criteria->add(NavigationItemPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(NavigationItemPeer::DATABASE_NAME);
        $criteria->add(NavigationItemPeer::ID, $this->id);

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
     * @param object $copyObj An object of NavigationItem (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setParentId($this->getParentId());
        $copyObj->setNavigationId($this->getNavigationId());
        $copyObj->setSortableRank($this->getSortableRank());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getChilds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addChild($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNavigationItemI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNavigationItemI18n($relObj->copy($deepCopy));
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
     * @return NavigationItem Clone of current object.
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
     * @return NavigationItemPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NavigationItemPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NavigationItem object.
     *
     * @param             NavigationItem $v
     * @return NavigationItem The current object (for fluent API support)
     * @throws PropelException
     */
    public function setParent(NavigationItem $v = null)
    {
        if ($v === null) {
            $this->setParentId(NULL);
        } else {
            $this->setParentId($v->getId());
        }

        $this->aParent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NavigationItem object, it will not be re-added.
        if ($v !== null) {
            $v->addChild($this);
        }


        return $this;
    }


    /**
     * Get the associated NavigationItem object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NavigationItem The associated NavigationItem object.
     * @throws PropelException
     */
    public function getParent(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aParent === null && ($this->parent_id !== null) && $doQuery) {
            $this->aParent = NavigationItemQuery::create()->findPk($this->parent_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aParent->addChilds($this);
             */
        }

        return $this->aParent;
    }

    /**
     * Declares an association between this object and a Navigation object.
     *
     * @param             Navigation $v
     * @return NavigationItem The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNavigation(Navigation $v = null)
    {
        if ($v === null) {
            $this->setNavigationId(NULL);
        } else {
            $this->setNavigationId($v->getId());
        }

        $this->aNavigation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Navigation object, it will not be re-added.
        if ($v !== null) {
            $v->addNavigationItem($this);
        }


        return $this;
    }


    /**
     * Get the associated Navigation object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Navigation The associated Navigation object.
     * @throws PropelException
     */
    public function getNavigation(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNavigation === null && ($this->navigation_id !== null) && $doQuery) {
            $this->aNavigation = NavigationQuery::create()->findPk($this->navigation_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNavigation->addNavigationItems($this);
             */
        }

        return $this->aNavigation;
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
        if ('Child' == $relationName) {
            $this->initChilds();
        }
        if ('NavigationItemI18n' == $relationName) {
            $this->initNavigationItemI18ns();
        }
    }

    /**
     * Clears out the collChilds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NavigationItem The current object (for fluent API support)
     * @see        addChilds()
     */
    public function clearChilds()
    {
        $this->collChilds = null; // important to set this to null since that means it is uninitialized
        $this->collChildsPartial = null;

        return $this;
    }

    /**
     * reset is the collChilds collection loaded partially
     *
     * @return void
     */
    public function resetPartialChilds($v = true)
    {
        $this->collChildsPartial = $v;
    }

    /**
     * Initializes the collChilds collection.
     *
     * By default this just sets the collChilds collection to an empty array (like clearcollChilds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initChilds($overrideExisting = true)
    {
        if (null !== $this->collChilds && !$overrideExisting) {
            return;
        }
        $this->collChilds = new PropelObjectCollection();
        $this->collChilds->setModel('NavigationItem');
    }

    /**
     * Gets an array of NavigationItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NavigationItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NavigationItem[] List of NavigationItem objects
     * @throws PropelException
     */
    public function getChilds($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collChildsPartial && !$this->isNew();
        if (null === $this->collChilds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collChilds) {
                // return empty collection
                $this->initChilds();
            } else {
                $collChilds = NavigationItemQuery::create(null, $criteria)
                    ->filterByParent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collChildsPartial && count($collChilds)) {
                      $this->initChilds(false);

                      foreach($collChilds as $obj) {
                        if (false == $this->collChilds->contains($obj)) {
                          $this->collChilds->append($obj);
                        }
                      }

                      $this->collChildsPartial = true;
                    }

                    return $collChilds;
                }

                if($partial && $this->collChilds) {
                    foreach($this->collChilds as $obj) {
                        if($obj->isNew()) {
                            $collChilds[] = $obj;
                        }
                    }
                }

                $this->collChilds = $collChilds;
                $this->collChildsPartial = false;
            }
        }

        return $this->collChilds;
    }

    /**
     * Sets a collection of Child objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $childs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setChilds(PropelCollection $childs, PropelPDO $con = null)
    {
        $this->childsScheduledForDeletion = $this->getChilds(new Criteria(), $con)->diff($childs);

        foreach ($this->childsScheduledForDeletion as $childRemoved) {
            $childRemoved->setParent(null);
        }

        $this->collChilds = null;
        foreach ($childs as $child) {
            $this->addChild($child);
        }

        $this->collChilds = $childs;
        $this->collChildsPartial = false;

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
    public function countChilds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collChildsPartial && !$this->isNew();
        if (null === $this->collChilds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collChilds) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getChilds());
            }
            $query = NavigationItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByParent($this)
                ->count($con);
        }

        return count($this->collChilds);
    }

    /**
     * Method called to associate a NavigationItem object to this object
     * through the NavigationItem foreign key attribute.
     *
     * @param    NavigationItem $l NavigationItem
     * @return NavigationItem The current object (for fluent API support)
     */
    public function addChild(NavigationItem $l)
    {
        if ($this->collChilds === null) {
            $this->initChilds();
            $this->collChildsPartial = true;
        }
        if (!in_array($l, $this->collChilds->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddChild($l);
        }

        return $this;
    }

    /**
     * @param	Child $child The child object to add.
     */
    protected function doAddChild($child)
    {
        $this->collChilds[]= $child;
        $child->setParent($this);
    }

    /**
     * @param	Child $child The child object to remove.
     * @return NavigationItem The current object (for fluent API support)
     */
    public function removeChild($child)
    {
        if ($this->getChilds()->contains($child)) {
            $this->collChilds->remove($this->collChilds->search($child));
            if (null === $this->childsScheduledForDeletion) {
                $this->childsScheduledForDeletion = clone $this->collChilds;
                $this->childsScheduledForDeletion->clear();
            }
            $this->childsScheduledForDeletion[]= $child;
            $child->setParent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NavigationItem is new, it will return
     * an empty collection; or if this NavigationItem has previously
     * been saved, it will retrieve related Childs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NavigationItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NavigationItem[] List of NavigationItem objects
     */
    public function getChildsJoinNavigation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NavigationItemQuery::create(null, $criteria);
        $query->joinWith('Navigation', $join_behavior);

        return $this->getChilds($query, $con);
    }

    /**
     * Clears out the collNavigationItemI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NavigationItem The current object (for fluent API support)
     * @see        addNavigationItemI18ns()
     */
    public function clearNavigationItemI18ns()
    {
        $this->collNavigationItemI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collNavigationItemI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collNavigationItemI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialNavigationItemI18ns($v = true)
    {
        $this->collNavigationItemI18nsPartial = $v;
    }

    /**
     * Initializes the collNavigationItemI18ns collection.
     *
     * By default this just sets the collNavigationItemI18ns collection to an empty array (like clearcollNavigationItemI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNavigationItemI18ns($overrideExisting = true)
    {
        if (null !== $this->collNavigationItemI18ns && !$overrideExisting) {
            return;
        }
        $this->collNavigationItemI18ns = new PropelObjectCollection();
        $this->collNavigationItemI18ns->setModel('NavigationItemI18n');
    }

    /**
     * Gets an array of NavigationItemI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NavigationItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NavigationItemI18n[] List of NavigationItemI18n objects
     * @throws PropelException
     */
    public function getNavigationItemI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNavigationItemI18nsPartial && !$this->isNew();
        if (null === $this->collNavigationItemI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNavigationItemI18ns) {
                // return empty collection
                $this->initNavigationItemI18ns();
            } else {
                $collNavigationItemI18ns = NavigationItemI18nQuery::create(null, $criteria)
                    ->filterByNavigationItem($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNavigationItemI18nsPartial && count($collNavigationItemI18ns)) {
                      $this->initNavigationItemI18ns(false);

                      foreach($collNavigationItemI18ns as $obj) {
                        if (false == $this->collNavigationItemI18ns->contains($obj)) {
                          $this->collNavigationItemI18ns->append($obj);
                        }
                      }

                      $this->collNavigationItemI18nsPartial = true;
                    }

                    return $collNavigationItemI18ns;
                }

                if($partial && $this->collNavigationItemI18ns) {
                    foreach($this->collNavigationItemI18ns as $obj) {
                        if($obj->isNew()) {
                            $collNavigationItemI18ns[] = $obj;
                        }
                    }
                }

                $this->collNavigationItemI18ns = $collNavigationItemI18ns;
                $this->collNavigationItemI18nsPartial = false;
            }
        }

        return $this->collNavigationItemI18ns;
    }

    /**
     * Sets a collection of NavigationItemI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $navigationItemI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NavigationItem The current object (for fluent API support)
     */
    public function setNavigationItemI18ns(PropelCollection $navigationItemI18ns, PropelPDO $con = null)
    {
        $this->navigationItemI18nsScheduledForDeletion = $this->getNavigationItemI18ns(new Criteria(), $con)->diff($navigationItemI18ns);

        foreach ($this->navigationItemI18nsScheduledForDeletion as $navigationItemI18nRemoved) {
            $navigationItemI18nRemoved->setNavigationItem(null);
        }

        $this->collNavigationItemI18ns = null;
        foreach ($navigationItemI18ns as $navigationItemI18n) {
            $this->addNavigationItemI18n($navigationItemI18n);
        }

        $this->collNavigationItemI18ns = $navigationItemI18ns;
        $this->collNavigationItemI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NavigationItemI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NavigationItemI18n objects.
     * @throws PropelException
     */
    public function countNavigationItemI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNavigationItemI18nsPartial && !$this->isNew();
        if (null === $this->collNavigationItemI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNavigationItemI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNavigationItemI18ns());
            }
            $query = NavigationItemI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNavigationItem($this)
                ->count($con);
        }

        return count($this->collNavigationItemI18ns);
    }

    /**
     * Method called to associate a NavigationItemI18n object to this object
     * through the NavigationItemI18n foreign key attribute.
     *
     * @param    NavigationItemI18n $l NavigationItemI18n
     * @return NavigationItem The current object (for fluent API support)
     */
    public function addNavigationItemI18n(NavigationItemI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collNavigationItemI18ns === null) {
            $this->initNavigationItemI18ns();
            $this->collNavigationItemI18nsPartial = true;
        }
        if (!in_array($l, $this->collNavigationItemI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNavigationItemI18n($l);
        }

        return $this;
    }

    /**
     * @param	NavigationItemI18n $navigationItemI18n The navigationItemI18n object to add.
     */
    protected function doAddNavigationItemI18n($navigationItemI18n)
    {
        $this->collNavigationItemI18ns[]= $navigationItemI18n;
        $navigationItemI18n->setNavigationItem($this);
    }

    /**
     * @param	NavigationItemI18n $navigationItemI18n The navigationItemI18n object to remove.
     * @return NavigationItem The current object (for fluent API support)
     */
    public function removeNavigationItemI18n($navigationItemI18n)
    {
        if ($this->getNavigationItemI18ns()->contains($navigationItemI18n)) {
            $this->collNavigationItemI18ns->remove($this->collNavigationItemI18ns->search($navigationItemI18n));
            if (null === $this->navigationItemI18nsScheduledForDeletion) {
                $this->navigationItemI18nsScheduledForDeletion = clone $this->collNavigationItemI18ns;
                $this->navigationItemI18nsScheduledForDeletion->clear();
            }
            $this->navigationItemI18nsScheduledForDeletion[]= $navigationItemI18n;
            $navigationItemI18n->setNavigationItem(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->parent_id = null;
        $this->navigation_id = null;
        $this->sortable_rank = null;
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
            if ($this->collChilds) {
                foreach ($this->collChilds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNavigationItemI18ns) {
                foreach ($this->collNavigationItemI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collChilds instanceof PropelCollection) {
            $this->collChilds->clearIterator();
        }
        $this->collChilds = null;
        if ($this->collNavigationItemI18ns instanceof PropelCollection) {
            $this->collNavigationItemI18ns->clearIterator();
        }
        $this->collNavigationItemI18ns = null;
        $this->aParent = null;
        $this->aNavigation = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NavigationItemPeer::DEFAULT_STRING_FORMAT);
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
     * @return    NavigationItem
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
        return $this->getSortableRank() == NavigationItemQuery::create()->getMaxRank($con);
    }

    /**
     * Get the next item in the list, i.e. the one for which rank is immediately higher
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    NavigationItem
     */
    public function getNext(PropelPDO $con = null)
    {

        return NavigationItemQuery::create()->findOneByRank($this->getSortableRank() + 1, $con);
    }

    /**
     * Get the previous item in the list, i.e. the one for which rank is immediately lower
     *
     * @param     PropelPDO  $con      optional connection
     *
     * @return    NavigationItem
     */
    public function getPrevious(PropelPDO $con = null)
    {

        return NavigationItemQuery::create()->findOneByRank($this->getSortableRank() - 1, $con);
    }

    /**
     * Insert at specified rank
     * The modifications are not persisted until the object is saved.
     *
     * @param     integer    $rank rank value
     * @param     PropelPDO  $con      optional connection
     *
     * @return    NavigationItem the current object
     *
     * @throws    PropelException
     */
    public function insertAtRank($rank, PropelPDO $con = null)
    {
        $maxRank = NavigationItemQuery::create()->getMaxRank($con);
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
     * @return    NavigationItem the current object
     *
     * @throws    PropelException
     */
    public function insertAtBottom(PropelPDO $con = null)
    {
        $this->setSortableRank(NavigationItemQuery::create()->getMaxRank($con) + 1);

        return $this;
    }

    /**
     * Insert in the first rank
     * The modifications are not persisted until the object is saved.
     *
     * @return    NavigationItem the current object
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
     * @return    NavigationItem the current object
     *
     * @throws    PropelException
     */
    public function moveToRank($newRank, PropelPDO $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be moved. Please use insertAtRank() instead');
        }
        if ($con === null) {
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME);
        }
        if ($newRank < 1 || $newRank > NavigationItemQuery::create()->getMaxRank($con)) {
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
            NavigationItemPeer::shiftRank($delta, min($oldRank, $newRank), max($oldRank, $newRank), $con);

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
     * @param     NavigationItem $object
     * @param     PropelPDO $con optional connection
     *
     * @return    NavigationItem the current object
     *
     * @throws Exception if the database cannot execute the two updates
     */
    public function swapWith($object, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME);
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
     * @return    NavigationItem the current object
     */
    public function moveUp(PropelPDO $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME);
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
     * @return    NavigationItem the current object
     */
    public function moveDown(PropelPDO $con = null)
    {
        if ($this->isLast($con)) {
            return $this;
        }
        if ($con === null) {
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME);
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
     * @return    NavigationItem the current object
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
            $con = Propel::getConnection(NavigationItemPeer::DATABASE_NAME);
        }
        $con->beginTransaction();
        try {
            $bottom = NavigationItemQuery::create()->getMaxRank($con);
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
     * @return    NavigationItem the current object
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     NavigationItem The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = NavigationItemPeer::UPDATED_AT;

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

    public function getsActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\Peer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\I18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\Peer::ID, \Cungfoo\Model\I18nPeer::alias('i18n_locale', \Cungfoo\Model\I18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\I18nPeer::alias('i18n_locale', \Cungfoo\Model\I18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\I18nPeer::alias('i18n_locale', \Cungfoo\Model\I18nPeer::LOCALE), $this->currentLocale);

        return $this->gets($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    NavigationItem The current object (for fluent API support)
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
     * @return NavigationItemI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collNavigationItemI18ns) {
                foreach ($this->collNavigationItemI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new NavigationItemI18n();
                $translation->setLocale($locale);
            } else {
                $translation = NavigationItemI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addNavigationItemI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    NavigationItem The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            NavigationItemI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collNavigationItemI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collNavigationItemI18ns[$key]);
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
     * @return NavigationItemI18n */
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
         * @return NavigationItemI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }


        /**
         * Get the [path] column value.
         *
         * @return string
         */
        public function getPath()
        {
        return $this->getCurrentTranslation()->getPath();
    }


        /**
         * Set the value of [path] column.
         *
         * @param string $v new value
         * @return NavigationItemI18n The current object (for fluent API support)
         */
        public function setPath($v)
        {    $this->getCurrentTranslation()->setPath($v);

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
         * @return NavigationItemI18n The current object (for fluent API support)
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
         * @return NavigationItemI18n The current object (for fluent API support)
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
         * @return NavigationItemI18n The current object (for fluent API support)
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
         * @return NavigationItemI18n The current object (for fluent API support)
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
         * @return NavigationItemI18n The current object (for fluent API support)
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
