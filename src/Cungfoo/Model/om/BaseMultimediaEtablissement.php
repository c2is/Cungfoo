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
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\MultimediaEtablissement;
use Cungfoo\Model\MultimediaEtablissementI18n;
use Cungfoo\Model\MultimediaEtablissementI18nQuery;
use Cungfoo\Model\MultimediaEtablissementPeer;
use Cungfoo\Model\MultimediaEtablissementQuery;
use Cungfoo\Model\MultimediaEtablissementTag;
use Cungfoo\Model\MultimediaEtablissementTagQuery;
use Cungfoo\Model\Tag;
use Cungfoo\Model\TagQuery;

/**
 * Base class that represents a row from the 'multimedia_etablissement' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMultimediaEtablissement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\MultimediaEtablissementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MultimediaEtablissementPeer
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
     * The value for the etablissement_id field.
     * @var        int
     */
    protected $etablissement_id;

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
     * @var        Etablissement
     */
    protected $aEtablissement;

    /**
     * @var        PropelObjectCollection|MultimediaEtablissementTag[] Collection to store aggregation of MultimediaEtablissementTag objects.
     */
    protected $collMultimediaEtablissementTags;
    protected $collMultimediaEtablissementTagsPartial;

    /**
     * @var        PropelObjectCollection|MultimediaEtablissementI18n[] Collection to store aggregation of MultimediaEtablissementI18n objects.
     */
    protected $collMultimediaEtablissementI18ns;
    protected $collMultimediaEtablissementI18nsPartial;

    /**
     * @var        PropelObjectCollection|Tag[] Collection to store aggregation of Tag objects.
     */
    protected $collTags;

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
     * @var        array[MultimediaEtablissementI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $multimediaEtablissementTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $multimediaEtablissementI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseMultimediaEtablissement object.
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
     * Get the [etablissement_id] column value.
     *
     * @return int
     */
    public function getEtablissementId()
    {
        return $this->etablissement_id;
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
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = MultimediaEtablissementPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [etablissement_id] column.
     *
     * @param int $v new value
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setEtablissementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->etablissement_id !== $v) {
            $this->etablissement_id = $v;
            $this->modifiedColumns[] = MultimediaEtablissementPeer::ETABLISSEMENT_ID;
        }

        if ($this->aEtablissement !== null && $this->aEtablissement->getId() !== $v) {
            $this->aEtablissement = null;
        }


        return $this;
    } // setEtablissementId()

    /**
     * Set the value of [image_path] column.
     *
     * @param string $v new value
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setImagePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_path !== $v) {
            $this->image_path = $v;
            $this->modifiedColumns[] = MultimediaEtablissementPeer::IMAGE_PATH;
        }


        return $this;
    } // setImagePath()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = MultimediaEtablissementPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = MultimediaEtablissementPeer::UPDATED_AT;
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
     * @return MultimediaEtablissement The current object (for fluent API support)
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
            $this->modifiedColumns[] = MultimediaEtablissementPeer::ACTIVE;
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
            $this->etablissement_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
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
            return $startcol + 6; // 6 = MultimediaEtablissementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating MultimediaEtablissement object", $e);
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

        if ($this->aEtablissement !== null && $this->etablissement_id !== $this->aEtablissement->getId()) {
            $this->aEtablissement = null;
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
            $con = Propel::getConnection(MultimediaEtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MultimediaEtablissementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEtablissement = null;
            $this->collMultimediaEtablissementTags = null;

            $this->collMultimediaEtablissementI18ns = null;

            $this->collTags = null;
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
            $con = Propel::getConnection(MultimediaEtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MultimediaEtablissementQuery::create()
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
            $con = Propel::getConnection(MultimediaEtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(MultimediaEtablissementPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(MultimediaEtablissementPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(MultimediaEtablissementPeer::UPDATED_AT)) {
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
                MultimediaEtablissementPeer::addInstanceToPool($this);
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

            if ($this->aEtablissement !== null) {
                if ($this->aEtablissement->isModified() || $this->aEtablissement->isNew()) {
                    $affectedRows += $this->aEtablissement->save($con);
                }
                $this->setEtablissement($this->aEtablissement);
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

            if ($this->tagsScheduledForDeletion !== null) {
                if (!$this->tagsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->tagsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    MultimediaEtablissementTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->tagsScheduledForDeletion = null;
                }

                foreach ($this->getTags() as $tag) {
                    if ($tag->isModified()) {
                        $tag->save($con);
                    }
                }
            }

            if ($this->multimediaEtablissementTagsScheduledForDeletion !== null) {
                if (!$this->multimediaEtablissementTagsScheduledForDeletion->isEmpty()) {
                    MultimediaEtablissementTagQuery::create()
                        ->filterByPrimaryKeys($this->multimediaEtablissementTagsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->multimediaEtablissementTagsScheduledForDeletion = null;
                }
            }

            if ($this->collMultimediaEtablissementTags !== null) {
                foreach ($this->collMultimediaEtablissementTags as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->multimediaEtablissementI18nsScheduledForDeletion !== null) {
                if (!$this->multimediaEtablissementI18nsScheduledForDeletion->isEmpty()) {
                    MultimediaEtablissementI18nQuery::create()
                        ->filterByPrimaryKeys($this->multimediaEtablissementI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->multimediaEtablissementI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collMultimediaEtablissementI18ns !== null) {
                foreach ($this->collMultimediaEtablissementI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = MultimediaEtablissementPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MultimediaEtablissementPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MultimediaEtablissementPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(MultimediaEtablissementPeer::ETABLISSEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`etablissement_id`';
        }
        if ($this->isColumnModified(MultimediaEtablissementPeer::IMAGE_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_path`';
        }
        if ($this->isColumnModified(MultimediaEtablissementPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(MultimediaEtablissementPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(MultimediaEtablissementPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `multimedia_etablissement` (%s) VALUES (%s)',
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
                    case '`etablissement_id`':
                        $stmt->bindValue($identifier, $this->etablissement_id, PDO::PARAM_INT);
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

            if ($this->aEtablissement !== null) {
                if (!$this->aEtablissement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEtablissement->getValidationFailures());
                }
            }


            if (($retval = MultimediaEtablissementPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMultimediaEtablissementTags !== null) {
                    foreach ($this->collMultimediaEtablissementTags as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collMultimediaEtablissementI18ns !== null) {
                    foreach ($this->collMultimediaEtablissementI18ns as $referrerFK) {
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
        $pos = MultimediaEtablissementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getEtablissementId();
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
        if (isset($alreadyDumpedObjects['MultimediaEtablissement'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['MultimediaEtablissement'][$this->getPrimaryKey()] = true;
        $keys = MultimediaEtablissementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEtablissementId(),
            $keys[2] => $this->getImagePath(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
            $keys[5] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aEtablissement) {
                $result['Etablissement'] = $this->aEtablissement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMultimediaEtablissementTags) {
                $result['MultimediaEtablissementTags'] = $this->collMultimediaEtablissementTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMultimediaEtablissementI18ns) {
                $result['MultimediaEtablissementI18ns'] = $this->collMultimediaEtablissementI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MultimediaEtablissementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setEtablissementId($value);
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
        $keys = MultimediaEtablissementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setEtablissementId($arr[$keys[1]]);
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
        $criteria = new Criteria(MultimediaEtablissementPeer::DATABASE_NAME);

        if ($this->isColumnModified(MultimediaEtablissementPeer::ID)) $criteria->add(MultimediaEtablissementPeer::ID, $this->id);
        if ($this->isColumnModified(MultimediaEtablissementPeer::ETABLISSEMENT_ID)) $criteria->add(MultimediaEtablissementPeer::ETABLISSEMENT_ID, $this->etablissement_id);
        if ($this->isColumnModified(MultimediaEtablissementPeer::IMAGE_PATH)) $criteria->add(MultimediaEtablissementPeer::IMAGE_PATH, $this->image_path);
        if ($this->isColumnModified(MultimediaEtablissementPeer::CREATED_AT)) $criteria->add(MultimediaEtablissementPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(MultimediaEtablissementPeer::UPDATED_AT)) $criteria->add(MultimediaEtablissementPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(MultimediaEtablissementPeer::ACTIVE)) $criteria->add(MultimediaEtablissementPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(MultimediaEtablissementPeer::DATABASE_NAME);
        $criteria->add(MultimediaEtablissementPeer::ID, $this->id);

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
     * @param object $copyObj An object of MultimediaEtablissement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEtablissementId($this->getEtablissementId());
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

            foreach ($this->getMultimediaEtablissementTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMultimediaEtablissementTag($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMultimediaEtablissementI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMultimediaEtablissementI18n($relObj->copy($deepCopy));
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
     * @return MultimediaEtablissement Clone of current object.
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
     * @return MultimediaEtablissementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MultimediaEtablissementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return MultimediaEtablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEtablissement(Etablissement $v = null)
    {
        if ($v === null) {
            $this->setEtablissementId(NULL);
        } else {
            $this->setEtablissementId($v->getId());
        }

        $this->aEtablissement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Etablissement object, it will not be re-added.
        if ($v !== null) {
            $v->addMultimediaEtablissement($this);
        }


        return $this;
    }


    /**
     * Get the associated Etablissement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Etablissement The associated Etablissement object.
     * @throws PropelException
     */
    public function getEtablissement(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEtablissement === null && ($this->etablissement_id !== null) && $doQuery) {
            $this->aEtablissement = EtablissementQuery::create()->findPk($this->etablissement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEtablissement->addMultimediaEtablissements($this);
             */
        }

        return $this->aEtablissement;
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
        if ('MultimediaEtablissementTag' == $relationName) {
            $this->initMultimediaEtablissementTags();
        }
        if ('MultimediaEtablissementI18n' == $relationName) {
            $this->initMultimediaEtablissementI18ns();
        }
    }

    /**
     * Clears out the collMultimediaEtablissementTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return MultimediaEtablissement The current object (for fluent API support)
     * @see        addMultimediaEtablissementTags()
     */
    public function clearMultimediaEtablissementTags()
    {
        $this->collMultimediaEtablissementTags = null; // important to set this to null since that means it is uninitialized
        $this->collMultimediaEtablissementTagsPartial = null;

        return $this;
    }

    /**
     * reset is the collMultimediaEtablissementTags collection loaded partially
     *
     * @return void
     */
    public function resetPartialMultimediaEtablissementTags($v = true)
    {
        $this->collMultimediaEtablissementTagsPartial = $v;
    }

    /**
     * Initializes the collMultimediaEtablissementTags collection.
     *
     * By default this just sets the collMultimediaEtablissementTags collection to an empty array (like clearcollMultimediaEtablissementTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMultimediaEtablissementTags($overrideExisting = true)
    {
        if (null !== $this->collMultimediaEtablissementTags && !$overrideExisting) {
            return;
        }
        $this->collMultimediaEtablissementTags = new PropelObjectCollection();
        $this->collMultimediaEtablissementTags->setModel('MultimediaEtablissementTag');
    }

    /**
     * Gets an array of MultimediaEtablissementTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MultimediaEtablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MultimediaEtablissementTag[] List of MultimediaEtablissementTag objects
     * @throws PropelException
     */
    public function getMultimediaEtablissementTags($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMultimediaEtablissementTagsPartial && !$this->isNew();
        if (null === $this->collMultimediaEtablissementTags || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMultimediaEtablissementTags) {
                // return empty collection
                $this->initMultimediaEtablissementTags();
            } else {
                $collMultimediaEtablissementTags = MultimediaEtablissementTagQuery::create(null, $criteria)
                    ->filterByMultimediaEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMultimediaEtablissementTagsPartial && count($collMultimediaEtablissementTags)) {
                      $this->initMultimediaEtablissementTags(false);

                      foreach($collMultimediaEtablissementTags as $obj) {
                        if (false == $this->collMultimediaEtablissementTags->contains($obj)) {
                          $this->collMultimediaEtablissementTags->append($obj);
                        }
                      }

                      $this->collMultimediaEtablissementTagsPartial = true;
                    }

                    return $collMultimediaEtablissementTags;
                }

                if($partial && $this->collMultimediaEtablissementTags) {
                    foreach($this->collMultimediaEtablissementTags as $obj) {
                        if($obj->isNew()) {
                            $collMultimediaEtablissementTags[] = $obj;
                        }
                    }
                }

                $this->collMultimediaEtablissementTags = $collMultimediaEtablissementTags;
                $this->collMultimediaEtablissementTagsPartial = false;
            }
        }

        return $this->collMultimediaEtablissementTags;
    }

    /**
     * Sets a collection of MultimediaEtablissementTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $multimediaEtablissementTags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setMultimediaEtablissementTags(PropelCollection $multimediaEtablissementTags, PropelPDO $con = null)
    {
        $this->multimediaEtablissementTagsScheduledForDeletion = $this->getMultimediaEtablissementTags(new Criteria(), $con)->diff($multimediaEtablissementTags);

        foreach ($this->multimediaEtablissementTagsScheduledForDeletion as $multimediaEtablissementTagRemoved) {
            $multimediaEtablissementTagRemoved->setMultimediaEtablissement(null);
        }

        $this->collMultimediaEtablissementTags = null;
        foreach ($multimediaEtablissementTags as $multimediaEtablissementTag) {
            $this->addMultimediaEtablissementTag($multimediaEtablissementTag);
        }

        $this->collMultimediaEtablissementTags = $multimediaEtablissementTags;
        $this->collMultimediaEtablissementTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MultimediaEtablissementTag objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MultimediaEtablissementTag objects.
     * @throws PropelException
     */
    public function countMultimediaEtablissementTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMultimediaEtablissementTagsPartial && !$this->isNew();
        if (null === $this->collMultimediaEtablissementTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMultimediaEtablissementTags) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getMultimediaEtablissementTags());
            }
            $query = MultimediaEtablissementTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMultimediaEtablissement($this)
                ->count($con);
        }

        return count($this->collMultimediaEtablissementTags);
    }

    /**
     * Method called to associate a MultimediaEtablissementTag object to this object
     * through the MultimediaEtablissementTag foreign key attribute.
     *
     * @param    MultimediaEtablissementTag $l MultimediaEtablissementTag
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function addMultimediaEtablissementTag(MultimediaEtablissementTag $l)
    {
        if ($this->collMultimediaEtablissementTags === null) {
            $this->initMultimediaEtablissementTags();
            $this->collMultimediaEtablissementTagsPartial = true;
        }
        if (!in_array($l, $this->collMultimediaEtablissementTags->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMultimediaEtablissementTag($l);
        }

        return $this;
    }

    /**
     * @param	MultimediaEtablissementTag $multimediaEtablissementTag The multimediaEtablissementTag object to add.
     */
    protected function doAddMultimediaEtablissementTag($multimediaEtablissementTag)
    {
        $this->collMultimediaEtablissementTags[]= $multimediaEtablissementTag;
        $multimediaEtablissementTag->setMultimediaEtablissement($this);
    }

    /**
     * @param	MultimediaEtablissementTag $multimediaEtablissementTag The multimediaEtablissementTag object to remove.
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function removeMultimediaEtablissementTag($multimediaEtablissementTag)
    {
        if ($this->getMultimediaEtablissementTags()->contains($multimediaEtablissementTag)) {
            $this->collMultimediaEtablissementTags->remove($this->collMultimediaEtablissementTags->search($multimediaEtablissementTag));
            if (null === $this->multimediaEtablissementTagsScheduledForDeletion) {
                $this->multimediaEtablissementTagsScheduledForDeletion = clone $this->collMultimediaEtablissementTags;
                $this->multimediaEtablissementTagsScheduledForDeletion->clear();
            }
            $this->multimediaEtablissementTagsScheduledForDeletion[]= $multimediaEtablissementTag;
            $multimediaEtablissementTag->setMultimediaEtablissement(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MultimediaEtablissement is new, it will return
     * an empty collection; or if this MultimediaEtablissement has previously
     * been saved, it will retrieve related MultimediaEtablissementTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MultimediaEtablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MultimediaEtablissementTag[] List of MultimediaEtablissementTag objects
     */
    public function getMultimediaEtablissementTagsJoinTag($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MultimediaEtablissementTagQuery::create(null, $criteria);
        $query->joinWith('Tag', $join_behavior);

        return $this->getMultimediaEtablissementTags($query, $con);
    }

    /**
     * Clears out the collMultimediaEtablissementI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return MultimediaEtablissement The current object (for fluent API support)
     * @see        addMultimediaEtablissementI18ns()
     */
    public function clearMultimediaEtablissementI18ns()
    {
        $this->collMultimediaEtablissementI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collMultimediaEtablissementI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collMultimediaEtablissementI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialMultimediaEtablissementI18ns($v = true)
    {
        $this->collMultimediaEtablissementI18nsPartial = $v;
    }

    /**
     * Initializes the collMultimediaEtablissementI18ns collection.
     *
     * By default this just sets the collMultimediaEtablissementI18ns collection to an empty array (like clearcollMultimediaEtablissementI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMultimediaEtablissementI18ns($overrideExisting = true)
    {
        if (null !== $this->collMultimediaEtablissementI18ns && !$overrideExisting) {
            return;
        }
        $this->collMultimediaEtablissementI18ns = new PropelObjectCollection();
        $this->collMultimediaEtablissementI18ns->setModel('MultimediaEtablissementI18n');
    }

    /**
     * Gets an array of MultimediaEtablissementI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MultimediaEtablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MultimediaEtablissementI18n[] List of MultimediaEtablissementI18n objects
     * @throws PropelException
     */
    public function getMultimediaEtablissementI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMultimediaEtablissementI18nsPartial && !$this->isNew();
        if (null === $this->collMultimediaEtablissementI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMultimediaEtablissementI18ns) {
                // return empty collection
                $this->initMultimediaEtablissementI18ns();
            } else {
                $collMultimediaEtablissementI18ns = MultimediaEtablissementI18nQuery::create(null, $criteria)
                    ->filterByMultimediaEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMultimediaEtablissementI18nsPartial && count($collMultimediaEtablissementI18ns)) {
                      $this->initMultimediaEtablissementI18ns(false);

                      foreach($collMultimediaEtablissementI18ns as $obj) {
                        if (false == $this->collMultimediaEtablissementI18ns->contains($obj)) {
                          $this->collMultimediaEtablissementI18ns->append($obj);
                        }
                      }

                      $this->collMultimediaEtablissementI18nsPartial = true;
                    }

                    return $collMultimediaEtablissementI18ns;
                }

                if($partial && $this->collMultimediaEtablissementI18ns) {
                    foreach($this->collMultimediaEtablissementI18ns as $obj) {
                        if($obj->isNew()) {
                            $collMultimediaEtablissementI18ns[] = $obj;
                        }
                    }
                }

                $this->collMultimediaEtablissementI18ns = $collMultimediaEtablissementI18ns;
                $this->collMultimediaEtablissementI18nsPartial = false;
            }
        }

        return $this->collMultimediaEtablissementI18ns;
    }

    /**
     * Sets a collection of MultimediaEtablissementI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $multimediaEtablissementI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setMultimediaEtablissementI18ns(PropelCollection $multimediaEtablissementI18ns, PropelPDO $con = null)
    {
        $this->multimediaEtablissementI18nsScheduledForDeletion = $this->getMultimediaEtablissementI18ns(new Criteria(), $con)->diff($multimediaEtablissementI18ns);

        foreach ($this->multimediaEtablissementI18nsScheduledForDeletion as $multimediaEtablissementI18nRemoved) {
            $multimediaEtablissementI18nRemoved->setMultimediaEtablissement(null);
        }

        $this->collMultimediaEtablissementI18ns = null;
        foreach ($multimediaEtablissementI18ns as $multimediaEtablissementI18n) {
            $this->addMultimediaEtablissementI18n($multimediaEtablissementI18n);
        }

        $this->collMultimediaEtablissementI18ns = $multimediaEtablissementI18ns;
        $this->collMultimediaEtablissementI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MultimediaEtablissementI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MultimediaEtablissementI18n objects.
     * @throws PropelException
     */
    public function countMultimediaEtablissementI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMultimediaEtablissementI18nsPartial && !$this->isNew();
        if (null === $this->collMultimediaEtablissementI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMultimediaEtablissementI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getMultimediaEtablissementI18ns());
            }
            $query = MultimediaEtablissementI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMultimediaEtablissement($this)
                ->count($con);
        }

        return count($this->collMultimediaEtablissementI18ns);
    }

    /**
     * Method called to associate a MultimediaEtablissementI18n object to this object
     * through the MultimediaEtablissementI18n foreign key attribute.
     *
     * @param    MultimediaEtablissementI18n $l MultimediaEtablissementI18n
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function addMultimediaEtablissementI18n(MultimediaEtablissementI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collMultimediaEtablissementI18ns === null) {
            $this->initMultimediaEtablissementI18ns();
            $this->collMultimediaEtablissementI18nsPartial = true;
        }
        if (!in_array($l, $this->collMultimediaEtablissementI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMultimediaEtablissementI18n($l);
        }

        return $this;
    }

    /**
     * @param	MultimediaEtablissementI18n $multimediaEtablissementI18n The multimediaEtablissementI18n object to add.
     */
    protected function doAddMultimediaEtablissementI18n($multimediaEtablissementI18n)
    {
        $this->collMultimediaEtablissementI18ns[]= $multimediaEtablissementI18n;
        $multimediaEtablissementI18n->setMultimediaEtablissement($this);
    }

    /**
     * @param	MultimediaEtablissementI18n $multimediaEtablissementI18n The multimediaEtablissementI18n object to remove.
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function removeMultimediaEtablissementI18n($multimediaEtablissementI18n)
    {
        if ($this->getMultimediaEtablissementI18ns()->contains($multimediaEtablissementI18n)) {
            $this->collMultimediaEtablissementI18ns->remove($this->collMultimediaEtablissementI18ns->search($multimediaEtablissementI18n));
            if (null === $this->multimediaEtablissementI18nsScheduledForDeletion) {
                $this->multimediaEtablissementI18nsScheduledForDeletion = clone $this->collMultimediaEtablissementI18ns;
                $this->multimediaEtablissementI18nsScheduledForDeletion->clear();
            }
            $this->multimediaEtablissementI18nsScheduledForDeletion[]= $multimediaEtablissementI18n;
            $multimediaEtablissementI18n->setMultimediaEtablissement(null);
        }

        return $this;
    }

    /**
     * Clears out the collTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return MultimediaEtablissement The current object (for fluent API support)
     * @see        addTags()
     */
    public function clearTags()
    {
        $this->collTags = null; // important to set this to null since that means it is uninitialized
        $this->collTagsPartial = null;

        return $this;
    }

    /**
     * Initializes the collTags collection.
     *
     * By default this just sets the collTags collection to an empty collection (like clearTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initTags()
    {
        $this->collTags = new PropelObjectCollection();
        $this->collTags->setModel('Tag');
    }

    /**
     * Gets a collection of Tag objects related by a many-to-many relationship
     * to the current object by way of the multimedia_etablissement_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MultimediaEtablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Tag[] List of Tag objects
     */
    public function getTags($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collTags || null !== $criteria) {
            if ($this->isNew() && null === $this->collTags) {
                // return empty collection
                $this->initTags();
            } else {
                $collTags = TagQuery::create(null, $criteria)
                    ->filterByMultimediaEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collTags;
                }
                $this->collTags = $collTags;
            }
        }

        return $this->collTags;
    }

    /**
     * Sets a collection of Tag objects related by a many-to-many relationship
     * to the current object by way of the multimedia_etablissement_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function setTags(PropelCollection $tags, PropelPDO $con = null)
    {
        $this->clearTags();
        $currentTags = $this->getTags();

        $this->tagsScheduledForDeletion = $currentTags->diff($tags);

        foreach ($tags as $tag) {
            if (!$currentTags->contains($tag)) {
                $this->doAddTag($tag);
            }
        }

        $this->collTags = $tags;

        return $this;
    }

    /**
     * Gets the number of Tag objects related by a many-to-many relationship
     * to the current object by way of the multimedia_etablissement_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Tag objects
     */
    public function countTags($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collTags || null !== $criteria) {
            if ($this->isNew() && null === $this->collTags) {
                return 0;
            } else {
                $query = TagQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMultimediaEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collTags);
        }
    }

    /**
     * Associate a Tag object to this object
     * through the multimedia_etablissement_tag cross reference table.
     *
     * @param  Tag $tag The MultimediaEtablissementTag object to relate
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function addTag(Tag $tag)
    {
        if ($this->collTags === null) {
            $this->initTags();
        }
        if (!$this->collTags->contains($tag)) { // only add it if the **same** object is not already associated
            $this->doAddTag($tag);

            $this->collTags[]= $tag;
        }

        return $this;
    }

    /**
     * @param	Tag $tag The tag object to add.
     */
    protected function doAddTag($tag)
    {
        $multimediaEtablissementTag = new MultimediaEtablissementTag();
        $multimediaEtablissementTag->setTag($tag);
        $this->addMultimediaEtablissementTag($multimediaEtablissementTag);
    }

    /**
     * Remove a Tag object to this object
     * through the multimedia_etablissement_tag cross reference table.
     *
     * @param Tag $tag The MultimediaEtablissementTag object to relate
     * @return MultimediaEtablissement The current object (for fluent API support)
     */
    public function removeTag(Tag $tag)
    {
        if ($this->getTags()->contains($tag)) {
            $this->collTags->remove($this->collTags->search($tag));
            if (null === $this->tagsScheduledForDeletion) {
                $this->tagsScheduledForDeletion = clone $this->collTags;
                $this->tagsScheduledForDeletion->clear();
            }
            $this->tagsScheduledForDeletion[]= $tag;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->etablissement_id = null;
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
            if ($this->collMultimediaEtablissementTags) {
                foreach ($this->collMultimediaEtablissementTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMultimediaEtablissementI18ns) {
                foreach ($this->collMultimediaEtablissementI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTags) {
                foreach ($this->collTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collMultimediaEtablissementTags instanceof PropelCollection) {
            $this->collMultimediaEtablissementTags->clearIterator();
        }
        $this->collMultimediaEtablissementTags = null;
        if ($this->collMultimediaEtablissementI18ns instanceof PropelCollection) {
            $this->collMultimediaEtablissementI18ns->clearIterator();
        }
        $this->collMultimediaEtablissementI18ns = null;
        if ($this->collTags instanceof PropelCollection) {
            $this->collTags->clearIterator();
        }
        $this->collTags = null;
        $this->aEtablissement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MultimediaEtablissementPeer::DEFAULT_STRING_FORMAT);
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
     * @return     MultimediaEtablissement The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = MultimediaEtablissementPeer::UPDATED_AT;

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
     * @return    MultimediaEtablissement The current object (for fluent API support)
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
     * @return MultimediaEtablissementI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collMultimediaEtablissementI18ns) {
                foreach ($this->collMultimediaEtablissementI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new MultimediaEtablissementI18n();
                $translation->setLocale($locale);
            } else {
                $translation = MultimediaEtablissementI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addMultimediaEtablissementI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    MultimediaEtablissement The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            MultimediaEtablissementI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collMultimediaEtablissementI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collMultimediaEtablissementI18ns[$key]);
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
     * @return MultimediaEtablissementI18n */
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
         * @return MultimediaEtablissementI18n The current object (for fluent API support)
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
            $this->resetModified(MultimediaEtablissementPeer::IMAGE_PATH);
        }
    
        $this->uploadImagePath($form);
        
        return $this->save($con);
    }
    
    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/multimedia_etablissements';
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
