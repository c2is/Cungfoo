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
use Cungfoo\Model\Baignade;
use Cungfoo\Model\BaignadeI18n;
use Cungfoo\Model\BaignadeI18nQuery;
use Cungfoo\Model\BaignadePeer;
use Cungfoo\Model\BaignadeQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementBaignade;
use Cungfoo\Model\EtablissementBaignadeQuery;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\Theme;
use Cungfoo\Model\ThemeBaignade;
use Cungfoo\Model\ThemeBaignadeQuery;
use Cungfoo\Model\ThemeQuery;

/**
 * Base class that represents a row from the 'baignade' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBaignade extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\BaignadePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BaignadePeer
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
     * The value for the code field.
     * @var        string
     */
    protected $code;

    /**
     * The value for the vignette field.
     * @var        string
     */
    protected $vignette;

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
     * @var        PropelObjectCollection|EtablissementBaignade[] Collection to store aggregation of EtablissementBaignade objects.
     */
    protected $collEtablissementBaignades;
    protected $collEtablissementBaignadesPartial;

    /**
     * @var        PropelObjectCollection|ThemeBaignade[] Collection to store aggregation of ThemeBaignade objects.
     */
    protected $collThemeBaignades;
    protected $collThemeBaignadesPartial;

    /**
     * @var        PropelObjectCollection|BaignadeI18n[] Collection to store aggregation of BaignadeI18n objects.
     */
    protected $collBaignadeI18ns;
    protected $collBaignadeI18nsPartial;

    /**
     * @var        PropelObjectCollection|Etablissement[] Collection to store aggregation of Etablissement objects.
     */
    protected $collEtablissements;

    /**
     * @var        PropelObjectCollection|Theme[] Collection to store aggregation of Theme objects.
     */
    protected $collThemes;

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
     * @var        array[BaignadeI18n]
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
    protected $themesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementBaignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themeBaignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $baignadeI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseBaignade object.
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
     * Get the [code] column value.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the [vignette] column value.
     *
     * @return string
     */
    public function getVignette()
    {
        return $this->vignette;
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
     * @return Baignade The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BaignadePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return Baignade The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = BaignadePeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [vignette] column.
     *
     * @param string $v new value
     * @return Baignade The current object (for fluent API support)
     */
    public function setVignette($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->vignette !== $v) {
            $this->vignette = $v;
            $this->modifiedColumns[] = BaignadePeer::VIGNETTE;
        }


        return $this;
    } // setVignette()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Baignade The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = BaignadePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Baignade The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = BaignadePeer::UPDATED_AT;
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
     * @return Baignade The current object (for fluent API support)
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
            $this->modifiedColumns[] = BaignadePeer::ACTIVE;
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
            $this->code = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->vignette = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->created_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->updated_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = BaignadePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Baignade object", $e);
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
            $con = Propel::getConnection(BaignadePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BaignadePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEtablissementBaignades = null;

            $this->collThemeBaignades = null;

            $this->collBaignadeI18ns = null;

            $this->collEtablissements = null;
            $this->collThemes = null;
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
            $con = Propel::getConnection(BaignadePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BaignadeQuery::create()
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
            $con = Propel::getConnection(BaignadePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(BaignadePeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(BaignadePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(BaignadePeer::UPDATED_AT)) {
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
                BaignadePeer::addInstanceToPool($this);
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
                    EtablissementBaignadeQuery::create()
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

            if ($this->themesScheduledForDeletion !== null) {
                if (!$this->themesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->themesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    ThemeBaignadeQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->themesScheduledForDeletion = null;
                }

                foreach ($this->getThemes() as $theme) {
                    if ($theme->isModified()) {
                        $theme->save($con);
                    }
                }
            }

            if ($this->etablissementBaignadesScheduledForDeletion !== null) {
                if (!$this->etablissementBaignadesScheduledForDeletion->isEmpty()) {
                    EtablissementBaignadeQuery::create()
                        ->filterByPrimaryKeys($this->etablissementBaignadesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementBaignadesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementBaignades !== null) {
                foreach ($this->collEtablissementBaignades as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->themeBaignadesScheduledForDeletion !== null) {
                if (!$this->themeBaignadesScheduledForDeletion->isEmpty()) {
                    ThemeBaignadeQuery::create()
                        ->filterByPrimaryKeys($this->themeBaignadesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->themeBaignadesScheduledForDeletion = null;
                }
            }

            if ($this->collThemeBaignades !== null) {
                foreach ($this->collThemeBaignades as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->baignadeI18nsScheduledForDeletion !== null) {
                if (!$this->baignadeI18nsScheduledForDeletion->isEmpty()) {
                    BaignadeI18nQuery::create()
                        ->filterByPrimaryKeys($this->baignadeI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->baignadeI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collBaignadeI18ns !== null) {
                foreach ($this->collBaignadeI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = BaignadePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BaignadePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BaignadePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(BaignadePeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }
        if ($this->isColumnModified(BaignadePeer::VIGNETTE)) {
            $modifiedColumns[':p' . $index++]  = '`vignette`';
        }
        if ($this->isColumnModified(BaignadePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(BaignadePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(BaignadePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `baignade` (%s) VALUES (%s)',
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
                    case '`code`':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                    case '`vignette`':
                        $stmt->bindValue($identifier, $this->vignette, PDO::PARAM_STR);
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


            if (($retval = BaignadePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collEtablissementBaignades !== null) {
                    foreach ($this->collEtablissementBaignades as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collThemeBaignades !== null) {
                    foreach ($this->collThemeBaignades as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBaignadeI18ns !== null) {
                    foreach ($this->collBaignadeI18ns as $referrerFK) {
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
        $pos = BaignadePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCode();
                break;
            case 2:
                return $this->getVignette();
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
        if (isset($alreadyDumpedObjects['Baignade'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Baignade'][$this->getPrimaryKey()] = true;
        $keys = BaignadePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getVignette(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
            $keys[5] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collEtablissementBaignades) {
                $result['EtablissementBaignades'] = $this->collEtablissementBaignades->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThemeBaignades) {
                $result['ThemeBaignades'] = $this->collThemeBaignades->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBaignadeI18ns) {
                $result['BaignadeI18ns'] = $this->collBaignadeI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BaignadePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCode($value);
                break;
            case 2:
                $this->setVignette($value);
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
        $keys = BaignadePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setVignette($arr[$keys[2]]);
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
        $criteria = new Criteria(BaignadePeer::DATABASE_NAME);

        if ($this->isColumnModified(BaignadePeer::ID)) $criteria->add(BaignadePeer::ID, $this->id);
        if ($this->isColumnModified(BaignadePeer::CODE)) $criteria->add(BaignadePeer::CODE, $this->code);
        if ($this->isColumnModified(BaignadePeer::VIGNETTE)) $criteria->add(BaignadePeer::VIGNETTE, $this->vignette);
        if ($this->isColumnModified(BaignadePeer::CREATED_AT)) $criteria->add(BaignadePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(BaignadePeer::UPDATED_AT)) $criteria->add(BaignadePeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(BaignadePeer::ACTIVE)) $criteria->add(BaignadePeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(BaignadePeer::DATABASE_NAME);
        $criteria->add(BaignadePeer::ID, $this->id);

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
     * @param object $copyObj An object of Baignade (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setVignette($this->getVignette());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getEtablissementBaignades() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementBaignade($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThemeBaignades() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemeBaignade($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBaignadeI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBaignadeI18n($relObj->copy($deepCopy));
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
     * @return Baignade Clone of current object.
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
     * @return BaignadePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BaignadePeer();
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
        if ('EtablissementBaignade' == $relationName) {
            $this->initEtablissementBaignades();
        }
        if ('ThemeBaignade' == $relationName) {
            $this->initThemeBaignades();
        }
        if ('BaignadeI18n' == $relationName) {
            $this->initBaignadeI18ns();
        }
    }

    /**
     * Clears out the collEtablissementBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Baignade The current object (for fluent API support)
     * @see        addEtablissementBaignades()
     */
    public function clearEtablissementBaignades()
    {
        $this->collEtablissementBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementBaignadesPartial = null;

        return $this;
    }

    /**
     * reset is the collEtablissementBaignades collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementBaignades($v = true)
    {
        $this->collEtablissementBaignadesPartial = $v;
    }

    /**
     * Initializes the collEtablissementBaignades collection.
     *
     * By default this just sets the collEtablissementBaignades collection to an empty array (like clearcollEtablissementBaignades());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementBaignades($overrideExisting = true)
    {
        if (null !== $this->collEtablissementBaignades && !$overrideExisting) {
            return;
        }
        $this->collEtablissementBaignades = new PropelObjectCollection();
        $this->collEtablissementBaignades->setModel('EtablissementBaignade');
    }

    /**
     * Gets an array of EtablissementBaignade objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Baignade is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementBaignade[] List of EtablissementBaignade objects
     * @throws PropelException
     */
    public function getEtablissementBaignades($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementBaignadesPartial && !$this->isNew();
        if (null === $this->collEtablissementBaignades || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementBaignades) {
                // return empty collection
                $this->initEtablissementBaignades();
            } else {
                $collEtablissementBaignades = EtablissementBaignadeQuery::create(null, $criteria)
                    ->filterByBaignade($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementBaignadesPartial && count($collEtablissementBaignades)) {
                      $this->initEtablissementBaignades(false);

                      foreach($collEtablissementBaignades as $obj) {
                        if (false == $this->collEtablissementBaignades->contains($obj)) {
                          $this->collEtablissementBaignades->append($obj);
                        }
                      }

                      $this->collEtablissementBaignadesPartial = true;
                    }

                    return $collEtablissementBaignades;
                }

                if($partial && $this->collEtablissementBaignades) {
                    foreach($this->collEtablissementBaignades as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementBaignades[] = $obj;
                        }
                    }
                }

                $this->collEtablissementBaignades = $collEtablissementBaignades;
                $this->collEtablissementBaignadesPartial = false;
            }
        }

        return $this->collEtablissementBaignades;
    }

    /**
     * Sets a collection of EtablissementBaignade objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementBaignades A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Baignade The current object (for fluent API support)
     */
    public function setEtablissementBaignades(PropelCollection $etablissementBaignades, PropelPDO $con = null)
    {
        $this->etablissementBaignadesScheduledForDeletion = $this->getEtablissementBaignades(new Criteria(), $con)->diff($etablissementBaignades);

        foreach ($this->etablissementBaignadesScheduledForDeletion as $etablissementBaignadeRemoved) {
            $etablissementBaignadeRemoved->setBaignade(null);
        }

        $this->collEtablissementBaignades = null;
        foreach ($etablissementBaignades as $etablissementBaignade) {
            $this->addEtablissementBaignade($etablissementBaignade);
        }

        $this->collEtablissementBaignades = $etablissementBaignades;
        $this->collEtablissementBaignadesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EtablissementBaignade objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementBaignade objects.
     * @throws PropelException
     */
    public function countEtablissementBaignades(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementBaignadesPartial && !$this->isNew();
        if (null === $this->collEtablissementBaignades || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementBaignades) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getEtablissementBaignades());
            }
            $query = EtablissementBaignadeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBaignade($this)
                ->count($con);
        }

        return count($this->collEtablissementBaignades);
    }

    /**
     * Method called to associate a EtablissementBaignade object to this object
     * through the EtablissementBaignade foreign key attribute.
     *
     * @param    EtablissementBaignade $l EtablissementBaignade
     * @return Baignade The current object (for fluent API support)
     */
    public function addEtablissementBaignade(EtablissementBaignade $l)
    {
        if ($this->collEtablissementBaignades === null) {
            $this->initEtablissementBaignades();
            $this->collEtablissementBaignadesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementBaignades->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementBaignade($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementBaignade $etablissementBaignade The etablissementBaignade object to add.
     */
    protected function doAddEtablissementBaignade($etablissementBaignade)
    {
        $this->collEtablissementBaignades[]= $etablissementBaignade;
        $etablissementBaignade->setBaignade($this);
    }

    /**
     * @param	EtablissementBaignade $etablissementBaignade The etablissementBaignade object to remove.
     * @return Baignade The current object (for fluent API support)
     */
    public function removeEtablissementBaignade($etablissementBaignade)
    {
        if ($this->getEtablissementBaignades()->contains($etablissementBaignade)) {
            $this->collEtablissementBaignades->remove($this->collEtablissementBaignades->search($etablissementBaignade));
            if (null === $this->etablissementBaignadesScheduledForDeletion) {
                $this->etablissementBaignadesScheduledForDeletion = clone $this->collEtablissementBaignades;
                $this->etablissementBaignadesScheduledForDeletion->clear();
            }
            $this->etablissementBaignadesScheduledForDeletion[]= $etablissementBaignade;
            $etablissementBaignade->setBaignade(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Baignade is new, it will return
     * an empty collection; or if this Baignade has previously
     * been saved, it will retrieve related EtablissementBaignades from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Baignade.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementBaignade[] List of EtablissementBaignade objects
     */
    public function getEtablissementBaignadesJoinEtablissement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementBaignadeQuery::create(null, $criteria);
        $query->joinWith('Etablissement', $join_behavior);

        return $this->getEtablissementBaignades($query, $con);
    }

    /**
     * Clears out the collThemeBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Baignade The current object (for fluent API support)
     * @see        addThemeBaignades()
     */
    public function clearThemeBaignades()
    {
        $this->collThemeBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collThemeBaignadesPartial = null;

        return $this;
    }

    /**
     * reset is the collThemeBaignades collection loaded partially
     *
     * @return void
     */
    public function resetPartialThemeBaignades($v = true)
    {
        $this->collThemeBaignadesPartial = $v;
    }

    /**
     * Initializes the collThemeBaignades collection.
     *
     * By default this just sets the collThemeBaignades collection to an empty array (like clearcollThemeBaignades());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThemeBaignades($overrideExisting = true)
    {
        if (null !== $this->collThemeBaignades && !$overrideExisting) {
            return;
        }
        $this->collThemeBaignades = new PropelObjectCollection();
        $this->collThemeBaignades->setModel('ThemeBaignade');
    }

    /**
     * Gets an array of ThemeBaignade objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Baignade is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ThemeBaignade[] List of ThemeBaignade objects
     * @throws PropelException
     */
    public function getThemeBaignades($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThemeBaignadesPartial && !$this->isNew();
        if (null === $this->collThemeBaignades || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThemeBaignades) {
                // return empty collection
                $this->initThemeBaignades();
            } else {
                $collThemeBaignades = ThemeBaignadeQuery::create(null, $criteria)
                    ->filterByBaignade($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThemeBaignadesPartial && count($collThemeBaignades)) {
                      $this->initThemeBaignades(false);

                      foreach($collThemeBaignades as $obj) {
                        if (false == $this->collThemeBaignades->contains($obj)) {
                          $this->collThemeBaignades->append($obj);
                        }
                      }

                      $this->collThemeBaignadesPartial = true;
                    }

                    return $collThemeBaignades;
                }

                if($partial && $this->collThemeBaignades) {
                    foreach($this->collThemeBaignades as $obj) {
                        if($obj->isNew()) {
                            $collThemeBaignades[] = $obj;
                        }
                    }
                }

                $this->collThemeBaignades = $collThemeBaignades;
                $this->collThemeBaignadesPartial = false;
            }
        }

        return $this->collThemeBaignades;
    }

    /**
     * Sets a collection of ThemeBaignade objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themeBaignades A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Baignade The current object (for fluent API support)
     */
    public function setThemeBaignades(PropelCollection $themeBaignades, PropelPDO $con = null)
    {
        $this->themeBaignadesScheduledForDeletion = $this->getThemeBaignades(new Criteria(), $con)->diff($themeBaignades);

        foreach ($this->themeBaignadesScheduledForDeletion as $themeBaignadeRemoved) {
            $themeBaignadeRemoved->setBaignade(null);
        }

        $this->collThemeBaignades = null;
        foreach ($themeBaignades as $themeBaignade) {
            $this->addThemeBaignade($themeBaignade);
        }

        $this->collThemeBaignades = $themeBaignades;
        $this->collThemeBaignadesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ThemeBaignade objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ThemeBaignade objects.
     * @throws PropelException
     */
    public function countThemeBaignades(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThemeBaignadesPartial && !$this->isNew();
        if (null === $this->collThemeBaignades || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThemeBaignades) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getThemeBaignades());
            }
            $query = ThemeBaignadeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBaignade($this)
                ->count($con);
        }

        return count($this->collThemeBaignades);
    }

    /**
     * Method called to associate a ThemeBaignade object to this object
     * through the ThemeBaignade foreign key attribute.
     *
     * @param    ThemeBaignade $l ThemeBaignade
     * @return Baignade The current object (for fluent API support)
     */
    public function addThemeBaignade(ThemeBaignade $l)
    {
        if ($this->collThemeBaignades === null) {
            $this->initThemeBaignades();
            $this->collThemeBaignadesPartial = true;
        }
        if (!in_array($l, $this->collThemeBaignades->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThemeBaignade($l);
        }

        return $this;
    }

    /**
     * @param	ThemeBaignade $themeBaignade The themeBaignade object to add.
     */
    protected function doAddThemeBaignade($themeBaignade)
    {
        $this->collThemeBaignades[]= $themeBaignade;
        $themeBaignade->setBaignade($this);
    }

    /**
     * @param	ThemeBaignade $themeBaignade The themeBaignade object to remove.
     * @return Baignade The current object (for fluent API support)
     */
    public function removeThemeBaignade($themeBaignade)
    {
        if ($this->getThemeBaignades()->contains($themeBaignade)) {
            $this->collThemeBaignades->remove($this->collThemeBaignades->search($themeBaignade));
            if (null === $this->themeBaignadesScheduledForDeletion) {
                $this->themeBaignadesScheduledForDeletion = clone $this->collThemeBaignades;
                $this->themeBaignadesScheduledForDeletion->clear();
            }
            $this->themeBaignadesScheduledForDeletion[]= $themeBaignade;
            $themeBaignade->setBaignade(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Baignade is new, it will return
     * an empty collection; or if this Baignade has previously
     * been saved, it will retrieve related ThemeBaignades from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Baignade.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ThemeBaignade[] List of ThemeBaignade objects
     */
    public function getThemeBaignadesJoinTheme($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ThemeBaignadeQuery::create(null, $criteria);
        $query->joinWith('Theme', $join_behavior);

        return $this->getThemeBaignades($query, $con);
    }

    /**
     * Clears out the collBaignadeI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Baignade The current object (for fluent API support)
     * @see        addBaignadeI18ns()
     */
    public function clearBaignadeI18ns()
    {
        $this->collBaignadeI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collBaignadeI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collBaignadeI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialBaignadeI18ns($v = true)
    {
        $this->collBaignadeI18nsPartial = $v;
    }

    /**
     * Initializes the collBaignadeI18ns collection.
     *
     * By default this just sets the collBaignadeI18ns collection to an empty array (like clearcollBaignadeI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBaignadeI18ns($overrideExisting = true)
    {
        if (null !== $this->collBaignadeI18ns && !$overrideExisting) {
            return;
        }
        $this->collBaignadeI18ns = new PropelObjectCollection();
        $this->collBaignadeI18ns->setModel('BaignadeI18n');
    }

    /**
     * Gets an array of BaignadeI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Baignade is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BaignadeI18n[] List of BaignadeI18n objects
     * @throws PropelException
     */
    public function getBaignadeI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBaignadeI18nsPartial && !$this->isNew();
        if (null === $this->collBaignadeI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBaignadeI18ns) {
                // return empty collection
                $this->initBaignadeI18ns();
            } else {
                $collBaignadeI18ns = BaignadeI18nQuery::create(null, $criteria)
                    ->filterByBaignade($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBaignadeI18nsPartial && count($collBaignadeI18ns)) {
                      $this->initBaignadeI18ns(false);

                      foreach($collBaignadeI18ns as $obj) {
                        if (false == $this->collBaignadeI18ns->contains($obj)) {
                          $this->collBaignadeI18ns->append($obj);
                        }
                      }

                      $this->collBaignadeI18nsPartial = true;
                    }

                    return $collBaignadeI18ns;
                }

                if($partial && $this->collBaignadeI18ns) {
                    foreach($this->collBaignadeI18ns as $obj) {
                        if($obj->isNew()) {
                            $collBaignadeI18ns[] = $obj;
                        }
                    }
                }

                $this->collBaignadeI18ns = $collBaignadeI18ns;
                $this->collBaignadeI18nsPartial = false;
            }
        }

        return $this->collBaignadeI18ns;
    }

    /**
     * Sets a collection of BaignadeI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $baignadeI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Baignade The current object (for fluent API support)
     */
    public function setBaignadeI18ns(PropelCollection $baignadeI18ns, PropelPDO $con = null)
    {
        $this->baignadeI18nsScheduledForDeletion = $this->getBaignadeI18ns(new Criteria(), $con)->diff($baignadeI18ns);

        foreach ($this->baignadeI18nsScheduledForDeletion as $baignadeI18nRemoved) {
            $baignadeI18nRemoved->setBaignade(null);
        }

        $this->collBaignadeI18ns = null;
        foreach ($baignadeI18ns as $baignadeI18n) {
            $this->addBaignadeI18n($baignadeI18n);
        }

        $this->collBaignadeI18ns = $baignadeI18ns;
        $this->collBaignadeI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaignadeI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BaignadeI18n objects.
     * @throws PropelException
     */
    public function countBaignadeI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBaignadeI18nsPartial && !$this->isNew();
        if (null === $this->collBaignadeI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBaignadeI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBaignadeI18ns());
            }
            $query = BaignadeI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBaignade($this)
                ->count($con);
        }

        return count($this->collBaignadeI18ns);
    }

    /**
     * Method called to associate a BaignadeI18n object to this object
     * through the BaignadeI18n foreign key attribute.
     *
     * @param    BaignadeI18n $l BaignadeI18n
     * @return Baignade The current object (for fluent API support)
     */
    public function addBaignadeI18n(BaignadeI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collBaignadeI18ns === null) {
            $this->initBaignadeI18ns();
            $this->collBaignadeI18nsPartial = true;
        }
        if (!in_array($l, $this->collBaignadeI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBaignadeI18n($l);
        }

        return $this;
    }

    /**
     * @param	BaignadeI18n $baignadeI18n The baignadeI18n object to add.
     */
    protected function doAddBaignadeI18n($baignadeI18n)
    {
        $this->collBaignadeI18ns[]= $baignadeI18n;
        $baignadeI18n->setBaignade($this);
    }

    /**
     * @param	BaignadeI18n $baignadeI18n The baignadeI18n object to remove.
     * @return Baignade The current object (for fluent API support)
     */
    public function removeBaignadeI18n($baignadeI18n)
    {
        if ($this->getBaignadeI18ns()->contains($baignadeI18n)) {
            $this->collBaignadeI18ns->remove($this->collBaignadeI18ns->search($baignadeI18n));
            if (null === $this->baignadeI18nsScheduledForDeletion) {
                $this->baignadeI18nsScheduledForDeletion = clone $this->collBaignadeI18ns;
                $this->baignadeI18nsScheduledForDeletion->clear();
            }
            $this->baignadeI18nsScheduledForDeletion[]= $baignadeI18n;
            $baignadeI18n->setBaignade(null);
        }

        return $this;
    }

    /**
     * Clears out the collEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Baignade The current object (for fluent API support)
     * @see        addEtablissements()
     */
    public function clearEtablissements()
    {
        $this->collEtablissements = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementsPartial = null;

        return $this;
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
     * to the current object by way of the etablissement_baignade cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Baignade is new, it will return
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
                    ->filterByBaignade($this)
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
     * to the current object by way of the etablissement_baignade cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissements A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Baignade The current object (for fluent API support)
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

        return $this;
    }

    /**
     * Gets the number of Etablissement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_baignade cross-reference table.
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
                    ->filterByBaignade($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissements);
        }
    }

    /**
     * Associate a Etablissement object to this object
     * through the etablissement_baignade cross reference table.
     *
     * @param  Etablissement $etablissement The EtablissementBaignade object to relate
     * @return Baignade The current object (for fluent API support)
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

        return $this;
    }

    /**
     * @param	Etablissement $etablissement The etablissement object to add.
     */
    protected function doAddEtablissement($etablissement)
    {
        $etablissementBaignade = new EtablissementBaignade();
        $etablissementBaignade->setEtablissement($etablissement);
        $this->addEtablissementBaignade($etablissementBaignade);
    }

    /**
     * Remove a Etablissement object to this object
     * through the etablissement_baignade cross reference table.
     *
     * @param Etablissement $etablissement The EtablissementBaignade object to relate
     * @return Baignade The current object (for fluent API support)
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

        return $this;
    }

    /**
     * Clears out the collThemes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Baignade The current object (for fluent API support)
     * @see        addThemes()
     */
    public function clearThemes()
    {
        $this->collThemes = null; // important to set this to null since that means it is uninitialized
        $this->collThemesPartial = null;

        return $this;
    }

    /**
     * Initializes the collThemes collection.
     *
     * By default this just sets the collThemes collection to an empty collection (like clearThemes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initThemes()
    {
        $this->collThemes = new PropelObjectCollection();
        $this->collThemes->setModel('Theme');
    }

    /**
     * Gets a collection of Theme objects related by a many-to-many relationship
     * to the current object by way of the theme_baignade cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Baignade is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Theme[] List of Theme objects
     */
    public function getThemes($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collThemes || null !== $criteria) {
            if ($this->isNew() && null === $this->collThemes) {
                // return empty collection
                $this->initThemes();
            } else {
                $collThemes = ThemeQuery::create(null, $criteria)
                    ->filterByBaignade($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collThemes;
                }
                $this->collThemes = $collThemes;
            }
        }

        return $this->collThemes;
    }

    /**
     * Sets a collection of Theme objects related by a many-to-many relationship
     * to the current object by way of the theme_baignade cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themes A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Baignade The current object (for fluent API support)
     */
    public function setThemes(PropelCollection $themes, PropelPDO $con = null)
    {
        $this->clearThemes();
        $currentThemes = $this->getThemes();

        $this->themesScheduledForDeletion = $currentThemes->diff($themes);

        foreach ($themes as $theme) {
            if (!$currentThemes->contains($theme)) {
                $this->doAddTheme($theme);
            }
        }

        $this->collThemes = $themes;

        return $this;
    }

    /**
     * Gets the number of Theme objects related by a many-to-many relationship
     * to the current object by way of the theme_baignade cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Theme objects
     */
    public function countThemes($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collThemes || null !== $criteria) {
            if ($this->isNew() && null === $this->collThemes) {
                return 0;
            } else {
                $query = ThemeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBaignade($this)
                    ->count($con);
            }
        } else {
            return count($this->collThemes);
        }
    }

    /**
     * Associate a Theme object to this object
     * through the theme_baignade cross reference table.
     *
     * @param  Theme $theme The ThemeBaignade object to relate
     * @return Baignade The current object (for fluent API support)
     */
    public function addTheme(Theme $theme)
    {
        if ($this->collThemes === null) {
            $this->initThemes();
        }
        if (!$this->collThemes->contains($theme)) { // only add it if the **same** object is not already associated
            $this->doAddTheme($theme);

            $this->collThemes[]= $theme;
        }

        return $this;
    }

    /**
     * @param	Theme $theme The theme object to add.
     */
    protected function doAddTheme($theme)
    {
        $themeBaignade = new ThemeBaignade();
        $themeBaignade->setTheme($theme);
        $this->addThemeBaignade($themeBaignade);
    }

    /**
     * Remove a Theme object to this object
     * through the theme_baignade cross reference table.
     *
     * @param Theme $theme The ThemeBaignade object to relate
     * @return Baignade The current object (for fluent API support)
     */
    public function removeTheme(Theme $theme)
    {
        if ($this->getThemes()->contains($theme)) {
            $this->collThemes->remove($this->collThemes->search($theme));
            if (null === $this->themesScheduledForDeletion) {
                $this->themesScheduledForDeletion = clone $this->collThemes;
                $this->themesScheduledForDeletion->clear();
            }
            $this->themesScheduledForDeletion[]= $theme;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->code = null;
        $this->vignette = null;
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
            if ($this->collEtablissementBaignades) {
                foreach ($this->collEtablissementBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemeBaignades) {
                foreach ($this->collThemeBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBaignadeI18ns) {
                foreach ($this->collBaignadeI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissements) {
                foreach ($this->collEtablissements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemes) {
                foreach ($this->collThemes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collEtablissementBaignades instanceof PropelCollection) {
            $this->collEtablissementBaignades->clearIterator();
        }
        $this->collEtablissementBaignades = null;
        if ($this->collThemeBaignades instanceof PropelCollection) {
            $this->collThemeBaignades->clearIterator();
        }
        $this->collThemeBaignades = null;
        if ($this->collBaignadeI18ns instanceof PropelCollection) {
            $this->collBaignadeI18ns->clearIterator();
        }
        $this->collBaignadeI18ns = null;
        if ($this->collEtablissements instanceof PropelCollection) {
            $this->collEtablissements->clearIterator();
        }
        $this->collEtablissements = null;
        if ($this->collThemes instanceof PropelCollection) {
            $this->collThemes->clearIterator();
        }
        $this->collThemes = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BaignadePeer::DEFAULT_STRING_FORMAT);
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
     * @return     Baignade The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = BaignadePeer::UPDATED_AT;

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
     * @return    Baignade The current object (for fluent API support)
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
     * @return BaignadeI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collBaignadeI18ns) {
                foreach ($this->collBaignadeI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new BaignadeI18n();
                $translation->setLocale($locale);
            } else {
                $translation = BaignadeI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addBaignadeI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Baignade The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            BaignadeI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collBaignadeI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collBaignadeI18ns[$key]);
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
     * @return BaignadeI18n */
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
         * @return BaignadeI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

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
         * @return BaignadeI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }


        /**
         * Get the [keywords] column value.
         *
         * @return string
         */
        public function getKeywords()
        {
        return $this->getCurrentTranslation()->getKeywords();
    }


        /**
         * Set the value of [keywords] column.
         *
         * @param string $v new value
         * @return BaignadeI18n The current object (for fluent API support)
         */
        public function setKeywords($v)
        {    $this->getCurrentTranslation()->setKeywords($v);

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
        if (!$form['vignette_deleted']->getData())
        {
            $this->resetModified(BaignadePeer::VIGNETTE);
        }

        $this->uploadVignette($form);

        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/baignades';
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
    public function uploadVignette(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['vignette']->getData()))
        {
            $image = uniqid().'.'.$form['vignette']->getData()->guessExtension();
            $form['vignette']->getData()->move($this->getUploadRootDir(), $image);
            $this->setVignette($this->getUploadDir() . '/' . $image);
        }
    }

}
