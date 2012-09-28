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
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementEvent;
use Cungfoo\Model\EtablissementEventQuery;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\Event;
use Cungfoo\Model\EventI18n;
use Cungfoo\Model\EventI18nQuery;
use Cungfoo\Model\EventPeer;
use Cungfoo\Model\EventQuery;

/**
 * Base class that represents a row from the 'event' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEvent extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\EventPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EventPeer
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
     * The value for the category field.
     * @var        string
     */
    protected $category;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the address2 field.
     * @var        string
     */
    protected $address2;

    /**
     * The value for the zipcode field.
     * @var        string
     */
    protected $zipcode;

    /**
     * The value for the city field.
     * @var        string
     */
    protected $city;

    /**
     * The value for the image field.
     * @var        string
     */
    protected $image;

    /**
     * The value for the priority field.
     * @var        string
     */
    protected $priority;

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
     * @var        PropelObjectCollection|EtablissementEvent[] Collection to store aggregation of EtablissementEvent objects.
     */
    protected $collEtablissementEvents;
    protected $collEtablissementEventsPartial;

    /**
     * @var        PropelObjectCollection|EventI18n[] Collection to store aggregation of EventI18n objects.
     */
    protected $collEventI18ns;
    protected $collEventI18nsPartial;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissements;

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
     * @var        array[EventI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $eventI18nsScheduledForDeletion = null;

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
     * Get the [category] column value.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [address2] column value.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Get the [zipcode] column value.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [image] column value.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the [priority] column value.
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
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
        } else {
            try {
                $dt = new DateTime($this->created_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
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
        } else {
            try {
                $dt = new DateTime($this->updated_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EventPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [category] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setCategory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category !== $v) {
            $this->category = $v;
            $this->modifiedColumns[] = EventPeer::CATEGORY;
        }


        return $this;
    } // setCategory()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = EventPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[] = EventPeer::ADDRESS;
        }


        return $this;
    } // setAddress()

    /**
     * Set the value of [address2] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[] = EventPeer::ADDRESS2;
        }


        return $this;
    } // setAddress2()

    /**
     * Set the value of [zipcode] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setZipcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zipcode !== $v) {
            $this->zipcode = $v;
            $this->modifiedColumns[] = EventPeer::ZIPCODE;
        }


        return $this;
    } // setZipcode()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = EventPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [image] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[] = EventPeer::IMAGE;
        }


        return $this;
    } // setImage()

    /**
     * Set the value of [priority] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setPriority($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->priority !== $v) {
            $this->priority = $v;
            $this->modifiedColumns[] = EventPeer::PRIORITY;
        }


        return $this;
    } // setPriority()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Event The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = EventPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Event The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = EventPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

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
            $this->category = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->address = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->address2 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->zipcode = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->city = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->image = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->priority = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = EventPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Event object", $e);
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
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEtablissementEvents = null;

            $this->collEventI18ns = null;

            $this->collEtablissements = null;
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
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EventQuery::create()
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
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(EventPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(EventPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(EventPeer::UPDATED_AT)) {
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
                EventPeer::addInstanceToPool($this);
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

            if ($this->etablissementsScheduledForDeletion !== null) {
                if (!$this->etablissementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->etablissementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    EtablissementEventQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->etablissementsScheduledForDeletion = null;
                }

                foreach ($this->getEtablissements() as $etablissement) {
                    if ($etablissement->isModified()) {
                        $etablissement->save($con);
                    }
                }
            }

            if ($this->etablissementEventsScheduledForDeletion !== null) {
                if (!$this->etablissementEventsScheduledForDeletion->isEmpty()) {
                    EtablissementEventQuery::create()
                        ->filterByPrimaryKeys($this->etablissementEventsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementEventsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementEvents !== null) {
                foreach ($this->collEtablissementEvents as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->eventI18nsScheduledForDeletion !== null) {
                if (!$this->eventI18nsScheduledForDeletion->isEmpty()) {
                    EventI18nQuery::create()
                        ->filterByPrimaryKeys($this->eventI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->eventI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collEventI18ns !== null) {
                foreach ($this->collEventI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = EventPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EventPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EventPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(EventPeer::CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = '`CATEGORY`';
        }
        if ($this->isColumnModified(EventPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`TITLE`';
        }
        if ($this->isColumnModified(EventPeer::ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS`';
        }
        if ($this->isColumnModified(EventPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS2`';
        }
        if ($this->isColumnModified(EventPeer::ZIPCODE)) {
            $modifiedColumns[':p' . $index++]  = '`ZIPCODE`';
        }
        if ($this->isColumnModified(EventPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`CITY`';
        }
        if ($this->isColumnModified(EventPeer::IMAGE)) {
            $modifiedColumns[':p' . $index++]  = '`IMAGE`';
        }
        if ($this->isColumnModified(EventPeer::PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = '`PRIORITY`';
        }
        if ($this->isColumnModified(EventPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(EventPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `event` (%s) VALUES (%s)',
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
                    case '`CATEGORY`':
                        $stmt->bindValue($identifier, $this->category, PDO::PARAM_STR);
                        break;
                    case '`TITLE`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`ADDRESS`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`ADDRESS2`':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);
                        break;
                    case '`ZIPCODE`':
                        $stmt->bindValue($identifier, $this->zipcode, PDO::PARAM_STR);
                        break;
                    case '`CITY`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`IMAGE`':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case '`PRIORITY`':
                        $stmt->bindValue($identifier, $this->priority, PDO::PARAM_STR);
                        break;
                    case '`CREATED_AT`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
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


            if (($retval = EventPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collEtablissementEvents !== null) {
                    foreach ($this->collEtablissementEvents as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEventI18ns !== null) {
                    foreach ($this->collEventI18ns as $referrerFK) {
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
        $pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCategory();
                break;
            case 2:
                return $this->getTitle();
                break;
            case 3:
                return $this->getAddress();
                break;
            case 4:
                return $this->getAddress2();
                break;
            case 5:
                return $this->getZipcode();
                break;
            case 6:
                return $this->getCity();
                break;
            case 7:
                return $this->getImage();
                break;
            case 8:
                return $this->getPriority();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
                return $this->getUpdatedAt();
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
        if (isset($alreadyDumpedObjects['Event'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Event'][$this->getPrimaryKey()] = true;
        $keys = EventPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCategory(),
            $keys[2] => $this->getTitle(),
            $keys[3] => $this->getAddress(),
            $keys[4] => $this->getAddress2(),
            $keys[5] => $this->getZipcode(),
            $keys[6] => $this->getCity(),
            $keys[7] => $this->getImage(),
            $keys[8] => $this->getPriority(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collEtablissementEvents) {
                $result['EtablissementEvents'] = $this->collEtablissementEvents->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEventI18ns) {
                $result['EventI18ns'] = $this->collEventI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCategory($value);
                break;
            case 2:
                $this->setTitle($value);
                break;
            case 3:
                $this->setAddress($value);
                break;
            case 4:
                $this->setAddress2($value);
                break;
            case 5:
                $this->setZipcode($value);
                break;
            case 6:
                $this->setCity($value);
                break;
            case 7:
                $this->setImage($value);
                break;
            case 8:
                $this->setPriority($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
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
        $keys = EventPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCategory($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAddress($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAddress2($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setZipcode($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCity($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setImage($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setPriority($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EventPeer::DATABASE_NAME);

        if ($this->isColumnModified(EventPeer::ID)) $criteria->add(EventPeer::ID, $this->id);
        if ($this->isColumnModified(EventPeer::CATEGORY)) $criteria->add(EventPeer::CATEGORY, $this->category);
        if ($this->isColumnModified(EventPeer::TITLE)) $criteria->add(EventPeer::TITLE, $this->title);
        if ($this->isColumnModified(EventPeer::ADDRESS)) $criteria->add(EventPeer::ADDRESS, $this->address);
        if ($this->isColumnModified(EventPeer::ADDRESS2)) $criteria->add(EventPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(EventPeer::ZIPCODE)) $criteria->add(EventPeer::ZIPCODE, $this->zipcode);
        if ($this->isColumnModified(EventPeer::CITY)) $criteria->add(EventPeer::CITY, $this->city);
        if ($this->isColumnModified(EventPeer::IMAGE)) $criteria->add(EventPeer::IMAGE, $this->image);
        if ($this->isColumnModified(EventPeer::PRIORITY)) $criteria->add(EventPeer::PRIORITY, $this->priority);
        if ($this->isColumnModified(EventPeer::CREATED_AT)) $criteria->add(EventPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(EventPeer::UPDATED_AT)) $criteria->add(EventPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(EventPeer::DATABASE_NAME);
        $criteria->add(EventPeer::ID, $this->id);

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
     * @param object $copyObj An object of Event (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCategory($this->getCategory());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setZipcode($this->getZipcode());
        $copyObj->setCity($this->getCity());
        $copyObj->setImage($this->getImage());
        $copyObj->setPriority($this->getPriority());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getEtablissementEvents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementEvent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEventI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventI18n($relObj->copy($deepCopy));
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
     * @return Event Clone of current object.
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
     * @return EventPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EventPeer();
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
        if ('EtablissementEvent' == $relationName) {
            $this->initEtablissementEvents();
        }
        if ('EventI18n' == $relationName) {
            $this->initEventI18ns();
        }
    }

    /**
     * Clears out the collEtablissementEvents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementEvents()
     */
    public function clearEtablissementEvents()
    {
        $this->collEtablissementEvents = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementEventsPartial = null;
    }

    /**
     * reset is the collEtablissementEvents collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementEvents($v = true)
    {
        $this->collEtablissementEventsPartial = $v;
    }

    /**
     * Initializes the collEtablissementEvents collection.
     *
     * By default this just sets the collEtablissementEvents collection to an empty array (like clearcollEtablissementEvents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementEvents($overrideExisting = true)
    {
        if (null !== $this->collEtablissementEvents && !$overrideExisting) {
            return;
        }
        $this->collEtablissementEvents = new PropelObjectCollection();
        $this->collEtablissementEvents->setModel('EtablissementEvent');
    }

    /**
     * Gets an array of EtablissementEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementEvent[] List of EtablissementEvent objects
     * @throws PropelException
     */
    public function getEtablissementEvents($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementEventsPartial && !$this->isNew();
        if (null === $this->collEtablissementEvents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementEvents) {
                // return empty collection
                $this->initEtablissementEvents();
            } else {
                $collEtablissementEvents = EtablissementEventQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementEventsPartial && count($collEtablissementEvents)) {
                      $this->initEtablissementEvents(false);

                      foreach($collEtablissementEvents as $obj) {
                        if (false == $this->collEtablissementEvents->contains($obj)) {
                          $this->collEtablissementEvents->append($obj);
                        }
                      }

                      $this->collEtablissementEventsPartial = true;
                    }

                    return $collEtablissementEvents;
                }

                if($partial && $this->collEtablissementEvents) {
                    foreach($this->collEtablissementEvents as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementEvents[] = $obj;
                        }
                    }
                }

                $this->collEtablissementEvents = $collEtablissementEvents;
                $this->collEtablissementEventsPartial = false;
            }
        }

        return $this->collEtablissementEvents;
    }

    /**
     * Sets a collection of EtablissementEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementEvents A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementEvents(PropelCollection $etablissementEvents, PropelPDO $con = null)
    {
        $this->etablissementEventsScheduledForDeletion = $this->getEtablissementEvents(new Criteria(), $con)->diff($etablissementEvents);

        foreach ($this->etablissementEventsScheduledForDeletion as $etablissementEventRemoved) {
            $etablissementEventRemoved->setEvent(null);
        }

        $this->collEtablissementEvents = null;
        foreach ($etablissementEvents as $etablissementEvent) {
            $this->addEtablissementEvent($etablissementEvent);
        }

        $this->collEtablissementEvents = $etablissementEvents;
        $this->collEtablissementEventsPartial = false;
    }

    /**
     * Returns the number of related EtablissementEvent objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementEvent objects.
     * @throws PropelException
     */
    public function countEtablissementEvents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementEventsPartial && !$this->isNew();
        if (null === $this->collEtablissementEvents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementEvents) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementEvents());
                }
                $query = EtablissementEventQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEvent($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementEvents);
        }
    }

    /**
     * Method called to associate a EtablissementEvent object to this object
     * through the EtablissementEvent foreign key attribute.
     *
     * @param    EtablissementEvent $l EtablissementEvent
     * @return Event The current object (for fluent API support)
     */
    public function addEtablissementEvent(EtablissementEvent $l)
    {
        if ($this->collEtablissementEvents === null) {
            $this->initEtablissementEvents();
            $this->collEtablissementEventsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementEvents->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementEvent($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementEvent $etablissementEvent The etablissementEvent object to add.
     */
    protected function doAddEtablissementEvent($etablissementEvent)
    {
        $this->collEtablissementEvents[]= $etablissementEvent;
        $etablissementEvent->setEvent($this);
    }

    /**
     * @param	EtablissementEvent $etablissementEvent The etablissementEvent object to remove.
     */
    public function removeEtablissementEvent($etablissementEvent)
    {
        if ($this->getEtablissementEvents()->contains($etablissementEvent)) {
            $this->collEtablissementEvents->remove($this->collEtablissementEvents->search($etablissementEvent));
            if (null === $this->etablissementEventsScheduledForDeletion) {
                $this->etablissementEventsScheduledForDeletion = clone $this->collEtablissementEvents;
                $this->etablissementEventsScheduledForDeletion->clear();
            }
            $this->etablissementEventsScheduledForDeletion[]= $etablissementEvent;
            $etablissementEvent->setEvent(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related EtablissementEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementEvent[] List of EtablissementEvent objects
     */
    public function getEtablissementEventsJoinEtablissement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementEventQuery::create(null, $criteria);
        $query->joinWith('Etablissement', $join_behavior);

        return $this->getEtablissementEvents($query, $con);
    }

    /**
     * Clears out the collEventI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEventI18ns()
     */
    public function clearEventI18ns()
    {
        $this->collEventI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collEventI18nsPartial = null;
    }

    /**
     * reset is the collEventI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialEventI18ns($v = true)
    {
        $this->collEventI18nsPartial = $v;
    }

    /**
     * Initializes the collEventI18ns collection.
     *
     * By default this just sets the collEventI18ns collection to an empty array (like clearcollEventI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventI18ns($overrideExisting = true)
    {
        if (null !== $this->collEventI18ns && !$overrideExisting) {
            return;
        }
        $this->collEventI18ns = new PropelObjectCollection();
        $this->collEventI18ns->setModel('EventI18n');
    }

    /**
     * Gets an array of EventI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EventI18n[] List of EventI18n objects
     * @throws PropelException
     */
    public function getEventI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEventI18nsPartial && !$this->isNew();
        if (null === $this->collEventI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEventI18ns) {
                // return empty collection
                $this->initEventI18ns();
            } else {
                $collEventI18ns = EventI18nQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEventI18nsPartial && count($collEventI18ns)) {
                      $this->initEventI18ns(false);

                      foreach($collEventI18ns as $obj) {
                        if (false == $this->collEventI18ns->contains($obj)) {
                          $this->collEventI18ns->append($obj);
                        }
                      }

                      $this->collEventI18nsPartial = true;
                    }

                    return $collEventI18ns;
                }

                if($partial && $this->collEventI18ns) {
                    foreach($this->collEventI18ns as $obj) {
                        if($obj->isNew()) {
                            $collEventI18ns[] = $obj;
                        }
                    }
                }

                $this->collEventI18ns = $collEventI18ns;
                $this->collEventI18nsPartial = false;
            }
        }

        return $this->collEventI18ns;
    }

    /**
     * Sets a collection of EventI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $eventI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEventI18ns(PropelCollection $eventI18ns, PropelPDO $con = null)
    {
        $this->eventI18nsScheduledForDeletion = $this->getEventI18ns(new Criteria(), $con)->diff($eventI18ns);

        foreach ($this->eventI18nsScheduledForDeletion as $eventI18nRemoved) {
            $eventI18nRemoved->setEvent(null);
        }

        $this->collEventI18ns = null;
        foreach ($eventI18ns as $eventI18n) {
            $this->addEventI18n($eventI18n);
        }

        $this->collEventI18ns = $eventI18ns;
        $this->collEventI18nsPartial = false;
    }

    /**
     * Returns the number of related EventI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EventI18n objects.
     * @throws PropelException
     */
    public function countEventI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEventI18nsPartial && !$this->isNew();
        if (null === $this->collEventI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventI18ns) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEventI18ns());
                }
                $query = EventI18nQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEvent($this)
                    ->count($con);
            }
        } else {
            return count($this->collEventI18ns);
        }
    }

    /**
     * Method called to associate a EventI18n object to this object
     * through the EventI18n foreign key attribute.
     *
     * @param    EventI18n $l EventI18n
     * @return Event The current object (for fluent API support)
     */
    public function addEventI18n(EventI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collEventI18ns === null) {
            $this->initEventI18ns();
            $this->collEventI18nsPartial = true;
        }
        if (!in_array($l, $this->collEventI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEventI18n($l);
        }

        return $this;
    }

    /**
     * @param	EventI18n $eventI18n The eventI18n object to add.
     */
    protected function doAddEventI18n($eventI18n)
    {
        $this->collEventI18ns[]= $eventI18n;
        $eventI18n->setEvent($this);
    }

    /**
     * @param	EventI18n $eventI18n The eventI18n object to remove.
     */
    public function removeEventI18n($eventI18n)
    {
        if ($this->getEventI18ns()->contains($eventI18n)) {
            $this->collEventI18ns->remove($this->collEventI18ns->search($eventI18n));
            if (null === $this->eventI18nsScheduledForDeletion) {
                $this->eventI18nsScheduledForDeletion = clone $this->collEventI18ns;
                $this->eventI18nsScheduledForDeletion->clear();
            }
            $this->eventI18nsScheduledForDeletion[]= $eventI18n;
            $eventI18n->setEvent(null);
        }
    }

    /**
     * Clears out the collEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissements()
     */
    public function clearEtablissements()
    {
        $this->collEtablissements = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementsPartial = null;
    }

    /**
     * Initializes the collEtablissements collection.
     *
     * By default this just sets the collEtablissements collection to an empty collection (like clearEtablissements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initEtablissements()
    {
        $this->collEtablissements = new PropelObjectCollection();
        $this->collEtablissements->setModel('Etablissement');
    }

    /**
     * Gets a collection of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_event cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Etablissement[] List of Etablissement objects
     */
    public function getEtablissements($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collEtablissements || null !== $criteria) {
            if ($this->isNew() && null === $this->collEtablissements) {
                // return empty collection
                $this->initEtablissements();
            } else {
                $collEtablissements = EtablissementQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collEtablissements;
                }
                $this->collEtablissements = $collEtablissements;
            }
        }

        return $this->collEtablissements;
    }

    /**
     * Sets a collection of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_event cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissements(PropelCollection $etablissements, PropelPDO $con = null)
    {
        $this->clearEtablissements();
        $currentEtablissements = $this->getEtablissements();

        $this->etablissementsScheduledForDeletion = $currentEtablissements->diff($etablissements);

        foreach ($etablissements as $etablissement) {
            if (!$currentEtablissements->contains($etablissement)) {
                $this->doAddEtablissement($etablissement);
            }
        }

        $this->collEtablissements = $etablissements;
    }

    /**
     * Gets the number of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_event cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Etablissement objects
     */
    public function countEtablissements($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collEtablissements || null !== $criteria) {
            if ($this->isNew() && null === $this->collEtablissements) {
                return 0;
            } else {
                $query = EtablissementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEvent($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissements);
        }
    }

    /**
     * Associate a Etablissement object to this object
     * through the etablissement_event cross reference table.
     *
     * @param  Etablissement $etablissement The EtablissementEvent object to relate
     * @return void
     */
    public function addEtablissement(Etablissement $etablissement)
    {
        if ($this->collEtablissements === null) {
            $this->initEtablissements();
        }
        if (!$this->collEtablissements->contains($etablissement)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissement($etablissement);

            $this->collEtablissements[]= $etablissement;
        }
    }

    /**
     * @param	Etablissement $etablissement The etablissement object to add.
     */
    protected function doAddEtablissement($etablissement)
    {
        $etablissementEvent = new EtablissementEvent();
        $etablissementEvent->setEtablissement($etablissement);
        $this->addEtablissementEvent($etablissementEvent);
    }

    /**
     * Remove a Etablissement object to this object
     * through the etablissement_event cross reference table.
     *
     * @param Etablissement $etablissement The EtablissementEvent object to relate
     * @return void
     */
    public function removeEtablissement(Etablissement $etablissement)
    {
        if ($this->getEtablissements()->contains($etablissement)) {
            $this->collEtablissements->remove($this->collEtablissements->search($etablissement));
            if (null === $this->etablissementsScheduledForDeletion) {
                $this->etablissementsScheduledForDeletion = clone $this->collEtablissements;
                $this->etablissementsScheduledForDeletion->clear();
            }
            $this->etablissementsScheduledForDeletion[]= $etablissement;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->category = null;
        $this->title = null;
        $this->address = null;
        $this->address2 = null;
        $this->zipcode = null;
        $this->city = null;
        $this->image = null;
        $this->priority = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collEtablissementEvents) {
                foreach ($this->collEtablissementEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEventI18ns) {
                foreach ($this->collEventI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissements) {
                foreach ($this->collEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collEtablissementEvents instanceof PropelCollection) {
            $this->collEtablissementEvents->clearIterator();
        }
        $this->collEtablissementEvents = null;
        if ($this->collEventI18ns instanceof PropelCollection) {
            $this->collEventI18ns->clearIterator();
        }
        $this->collEventI18ns = null;
        if ($this->collEtablissements instanceof PropelCollection) {
            $this->collEtablissements->clearIterator();
        }
        $this->collEtablissements = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EventPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Event The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = EventPeer::UPDATED_AT;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Event The current object (for fluent API support)
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
     * @return EventI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collEventI18ns) {
                foreach ($this->collEventI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new EventI18n();
                $translation->setLocale($locale);
            } else {
                $translation = EventI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addEventI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Event The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            EventI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collEventI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collEventI18ns[$key]);
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
     * @return EventI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [str_date] column value.
         *
         * @return string
         */
        public function getStrDate()
        {
        return $this->getCurrentTranslation()->getStrDate();
    }


        /**
         * Set the value of [str_date] column.
         *
         * @param string $v new value
         * @return EventI18n The current object (for fluent API support)
         */
        public function setStrDate($v)
        {    $this->getCurrentTranslation()->setStrDate($v);

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
