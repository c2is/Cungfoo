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
use Cungfoo\Model\Event;
use Cungfoo\Model\EventI18n;
use Cungfoo\Model\EventI18nPeer;
use Cungfoo\Model\EventI18nQuery;
use Cungfoo\Model\EventQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'event_i18n' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEventI18n extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\EventI18nPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EventI18nPeer
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
     * The value for the locale field.
     * Note: this column has a database default value of: 'fr'
     * @var        string
     */
    protected $locale;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the str_date field.
     * @var        string
     */
    protected $str_date;

    /**
     * The value for the subtitle field.
     * @var        string
     */
    protected $subtitle;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the transport field.
     * @var        string
     */
    protected $transport;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the seo_title field.
     * @var        string
     */
    protected $seo_title;

    /**
     * The value for the seo_description field.
     * @var        string
     */
    protected $seo_description;

    /**
     * The value for the seo_h1 field.
     * @var        string
     */
    protected $seo_h1;

    /**
     * The value for the seo_keywords field.
     * @var        string
     */
    protected $seo_keywords;

    /**
     * The value for the active_locale field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active_locale;

    /**
     * @var        Event
     */
    protected $aEvent;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->locale = 'fr';
        $this->active_locale = false;
    }

    /**
     * Initializes internal state of BaseEventI18n object.
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
     * Get the [locale] column value.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
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
     * Get the [str_date] column value.
     *
     * @return string
     */
    public function getStrDate()
    {
        return $this->str_date;
    }

    /**
     * Get the [subtitle] column value.
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
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
     * Get the [transport] column value.
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the [seo_title] column value.
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seo_title;
    }

    /**
     * Get the [seo_description] column value.
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seo_description;
    }

    /**
     * Get the [seo_h1] column value.
     *
     * @return string
     */
    public function getSeoH1()
    {
        return $this->seo_h1;
    }

    /**
     * Get the [seo_keywords] column value.
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seo_keywords;
    }

    /**
     * Get the [active_locale] column value.
     *
     * @return boolean
     */
    public function getActiveLocale()
    {
        return $this->active_locale;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EventI18nPeer::ID;
        }

        if ($this->aEvent !== null && $this->aEvent->getId() !== $v) {
            $this->aEvent = null;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [locale] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setLocale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locale !== $v) {
            $this->locale = $v;
            $this->modifiedColumns[] = EventI18nPeer::LOCALE;
        }


        return $this;
    } // setLocale()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = EventI18nPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [str_date] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setStrDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->str_date !== $v) {
            $this->str_date = $v;
            $this->modifiedColumns[] = EventI18nPeer::STR_DATE;
        }


        return $this;
    } // setStrDate()

    /**
     * Set the value of [subtitle] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setSubtitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subtitle !== $v) {
            $this->subtitle = $v;
            $this->modifiedColumns[] = EventI18nPeer::SUBTITLE;
        }


        return $this;
    } // setSubtitle()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = EventI18nPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [transport] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setTransport($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transport !== $v) {
            $this->transport = $v;
            $this->modifiedColumns[] = EventI18nPeer::TRANSPORT;
        }


        return $this;
    } // setTransport()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = EventI18nPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [seo_title] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setSeoTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_title !== $v) {
            $this->seo_title = $v;
            $this->modifiedColumns[] = EventI18nPeer::SEO_TITLE;
        }


        return $this;
    } // setSeoTitle()

    /**
     * Set the value of [seo_description] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setSeoDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_description !== $v) {
            $this->seo_description = $v;
            $this->modifiedColumns[] = EventI18nPeer::SEO_DESCRIPTION;
        }


        return $this;
    } // setSeoDescription()

    /**
     * Set the value of [seo_h1] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setSeoH1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_h1 !== $v) {
            $this->seo_h1 = $v;
            $this->modifiedColumns[] = EventI18nPeer::SEO_H1;
        }


        return $this;
    } // setSeoH1()

    /**
     * Set the value of [seo_keywords] column.
     *
     * @param string $v new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setSeoKeywords($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_keywords !== $v) {
            $this->seo_keywords = $v;
            $this->modifiedColumns[] = EventI18nPeer::SEO_KEYWORDS;
        }


        return $this;
    } // setSeoKeywords()

    /**
     * Sets the value of the [active_locale] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return EventI18n The current object (for fluent API support)
     */
    public function setActiveLocale($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active_locale !== $v) {
            $this->active_locale = $v;
            $this->modifiedColumns[] = EventI18nPeer::ACTIVE_LOCALE;
        }


        return $this;
    } // setActiveLocale()

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
            if ($this->locale !== 'fr') {
                return false;
            }

            if ($this->active_locale !== false) {
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
            $this->locale = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->str_date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->subtitle = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->description = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->transport = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->slug = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->seo_title = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->seo_description = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->seo_h1 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->seo_keywords = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->active_locale = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 13; // 13 = EventI18nPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating EventI18n object", $e);
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

        if ($this->aEvent !== null && $this->id !== $this->aEvent->getId()) {
            $this->aEvent = null;
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
            $con = Propel::getConnection(EventI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EventI18nPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEvent = null;
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
            $con = Propel::getConnection(EventI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EventI18nQuery::create()
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
            $con = Propel::getConnection(EventI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                EventI18nPeer::addInstanceToPool($this);
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

            if ($this->aEvent !== null) {
                if ($this->aEvent->isModified() || $this->aEvent->isNew()) {
                    $affectedRows += $this->aEvent->save($con);
                }
                $this->setEvent($this->aEvent);
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
        if ($this->isColumnModified(EventI18nPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EventI18nPeer::LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`locale`';
        }
        if ($this->isColumnModified(EventI18nPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(EventI18nPeer::STR_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`str_date`';
        }
        if ($this->isColumnModified(EventI18nPeer::SUBTITLE)) {
            $modifiedColumns[':p' . $index++]  = '`subtitle`';
        }
        if ($this->isColumnModified(EventI18nPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(EventI18nPeer::TRANSPORT)) {
            $modifiedColumns[':p' . $index++]  = '`transport`';
        }
        if ($this->isColumnModified(EventI18nPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(EventI18nPeer::SEO_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`seo_title`';
        }
        if ($this->isColumnModified(EventI18nPeer::SEO_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`seo_description`';
        }
        if ($this->isColumnModified(EventI18nPeer::SEO_H1)) {
            $modifiedColumns[':p' . $index++]  = '`seo_h1`';
        }
        if ($this->isColumnModified(EventI18nPeer::SEO_KEYWORDS)) {
            $modifiedColumns[':p' . $index++]  = '`seo_keywords`';
        }
        if ($this->isColumnModified(EventI18nPeer::ACTIVE_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`active_locale`';
        }

        $sql = sprintf(
            'INSERT INTO `event_i18n` (%s) VALUES (%s)',
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
                    case '`locale`':
                        $stmt->bindValue($identifier, $this->locale, PDO::PARAM_STR);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`str_date`':
                        $stmt->bindValue($identifier, $this->str_date, PDO::PARAM_STR);
                        break;
                    case '`subtitle`':
                        $stmt->bindValue($identifier, $this->subtitle, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`transport`':
                        $stmt->bindValue($identifier, $this->transport, PDO::PARAM_STR);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`seo_title`':
                        $stmt->bindValue($identifier, $this->seo_title, PDO::PARAM_STR);
                        break;
                    case '`seo_description`':
                        $stmt->bindValue($identifier, $this->seo_description, PDO::PARAM_STR);
                        break;
                    case '`seo_h1`':
                        $stmt->bindValue($identifier, $this->seo_h1, PDO::PARAM_STR);
                        break;
                    case '`seo_keywords`':
                        $stmt->bindValue($identifier, $this->seo_keywords, PDO::PARAM_STR);
                        break;
                    case '`active_locale`':
                        $stmt->bindValue($identifier, (int) $this->active_locale, PDO::PARAM_INT);
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

            if ($this->aEvent !== null) {
                if (!$this->aEvent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEvent->getValidationFailures());
                }
            }


            if (($retval = EventI18nPeer::doValidate($this, $columns)) !== true) {
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
        $pos = EventI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getLocale();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getStrDate();
                break;
            case 4:
                return $this->getSubtitle();
                break;
            case 5:
                return $this->getDescription();
                break;
            case 6:
                return $this->getTransport();
                break;
            case 7:
                return $this->getSlug();
                break;
            case 8:
                return $this->getSeoTitle();
                break;
            case 9:
                return $this->getSeoDescription();
                break;
            case 10:
                return $this->getSeoH1();
                break;
            case 11:
                return $this->getSeoKeywords();
                break;
            case 12:
                return $this->getActiveLocale();
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
        if (isset($alreadyDumpedObjects['EventI18n'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['EventI18n'][serialize($this->getPrimaryKey())] = true;
        $keys = EventI18nPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLocale(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getStrDate(),
            $keys[4] => $this->getSubtitle(),
            $keys[5] => $this->getDescription(),
            $keys[6] => $this->getTransport(),
            $keys[7] => $this->getSlug(),
            $keys[8] => $this->getSeoTitle(),
            $keys[9] => $this->getSeoDescription(),
            $keys[10] => $this->getSeoH1(),
            $keys[11] => $this->getSeoKeywords(),
            $keys[12] => $this->getActiveLocale(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aEvent) {
                $result['Event'] = $this->aEvent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = EventI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setLocale($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setStrDate($value);
                break;
            case 4:
                $this->setSubtitle($value);
                break;
            case 5:
                $this->setDescription($value);
                break;
            case 6:
                $this->setTransport($value);
                break;
            case 7:
                $this->setSlug($value);
                break;
            case 8:
                $this->setSeoTitle($value);
                break;
            case 9:
                $this->setSeoDescription($value);
                break;
            case 10:
                $this->setSeoH1($value);
                break;
            case 11:
                $this->setSeoKeywords($value);
                break;
            case 12:
                $this->setActiveLocale($value);
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
        $keys = EventI18nPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLocale($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStrDate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSubtitle($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setTransport($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSlug($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSeoTitle($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setSeoDescription($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setSeoH1($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setSeoKeywords($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setActiveLocale($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EventI18nPeer::DATABASE_NAME);

        if ($this->isColumnModified(EventI18nPeer::ID)) $criteria->add(EventI18nPeer::ID, $this->id);
        if ($this->isColumnModified(EventI18nPeer::LOCALE)) $criteria->add(EventI18nPeer::LOCALE, $this->locale);
        if ($this->isColumnModified(EventI18nPeer::NAME)) $criteria->add(EventI18nPeer::NAME, $this->name);
        if ($this->isColumnModified(EventI18nPeer::STR_DATE)) $criteria->add(EventI18nPeer::STR_DATE, $this->str_date);
        if ($this->isColumnModified(EventI18nPeer::SUBTITLE)) $criteria->add(EventI18nPeer::SUBTITLE, $this->subtitle);
        if ($this->isColumnModified(EventI18nPeer::DESCRIPTION)) $criteria->add(EventI18nPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(EventI18nPeer::TRANSPORT)) $criteria->add(EventI18nPeer::TRANSPORT, $this->transport);
        if ($this->isColumnModified(EventI18nPeer::SLUG)) $criteria->add(EventI18nPeer::SLUG, $this->slug);
        if ($this->isColumnModified(EventI18nPeer::SEO_TITLE)) $criteria->add(EventI18nPeer::SEO_TITLE, $this->seo_title);
        if ($this->isColumnModified(EventI18nPeer::SEO_DESCRIPTION)) $criteria->add(EventI18nPeer::SEO_DESCRIPTION, $this->seo_description);
        if ($this->isColumnModified(EventI18nPeer::SEO_H1)) $criteria->add(EventI18nPeer::SEO_H1, $this->seo_h1);
        if ($this->isColumnModified(EventI18nPeer::SEO_KEYWORDS)) $criteria->add(EventI18nPeer::SEO_KEYWORDS, $this->seo_keywords);
        if ($this->isColumnModified(EventI18nPeer::ACTIVE_LOCALE)) $criteria->add(EventI18nPeer::ACTIVE_LOCALE, $this->active_locale);

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
        $criteria = new Criteria(EventI18nPeer::DATABASE_NAME);
        $criteria->add(EventI18nPeer::ID, $this->id);
        $criteria->add(EventI18nPeer::LOCALE, $this->locale);

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
        $pks[0] = $this->getId();
        $pks[1] = $this->getLocale();

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
        $this->setId($keys[0]);
        $this->setLocale($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getId()) && (null === $this->getLocale());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of EventI18n (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setLocale($this->getLocale());
        $copyObj->setName($this->getName());
        $copyObj->setStrDate($this->getStrDate());
        $copyObj->setSubtitle($this->getSubtitle());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setTransport($this->getTransport());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setSeoTitle($this->getSeoTitle());
        $copyObj->setSeoDescription($this->getSeoDescription());
        $copyObj->setSeoH1($this->getSeoH1());
        $copyObj->setSeoKeywords($this->getSeoKeywords());
        $copyObj->setActiveLocale($this->getActiveLocale());

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
     * @return EventI18n Clone of current object.
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
     * @return EventI18nPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EventI18nPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Event object.
     *
     * @param             Event $v
     * @return EventI18n The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEvent(Event $v = null)
    {
        if ($v === null) {
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aEvent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Event object, it will not be re-added.
        if ($v !== null) {
            $v->addEventI18n($this);
        }


        return $this;
    }


    /**
     * Get the associated Event object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Event The associated Event object.
     * @throws PropelException
     */
    public function getEvent(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEvent === null && ($this->id !== null) && $doQuery) {
            $this->aEvent = EventQuery::create()->findPk($this->id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEvent->addEventI18ns($this);
             */
        }

        return $this->aEvent;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->locale = null;
        $this->name = null;
        $this->str_date = null;
        $this->subtitle = null;
        $this->description = null;
        $this->transport = null;
        $this->slug = null;
        $this->seo_title = null;
        $this->seo_description = null;
        $this->seo_h1 = null;
        $this->seo_keywords = null;
        $this->active_locale = null;
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
        } // if ($deep)

        $this->aEvent = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EventI18nPeer::DEFAULT_STRING_FORMAT);
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
