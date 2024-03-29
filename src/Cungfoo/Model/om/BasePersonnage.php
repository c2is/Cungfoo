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
use Cungfoo\Model\Avantage;
use Cungfoo\Model\AvantageQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\Personnage;
use Cungfoo\Model\PersonnageI18n;
use Cungfoo\Model\PersonnageI18nQuery;
use Cungfoo\Model\PersonnagePeer;
use Cungfoo\Model\PersonnageQuery;
use Cungfoo\Model\Theme;
use Cungfoo\Model\ThemePersonnage;
use Cungfoo\Model\ThemePersonnageQuery;
use Cungfoo\Model\ThemeQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'personnage' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePersonnage extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\PersonnagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PersonnagePeer
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
     * The value for the age field.
     * @var        string
     */
    protected $age;

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
     * @var        PropelObjectCollection|Avantage[] Collection to store aggregation of Avantage objects.
     */
    protected $collAvantages;
    protected $collAvantagesPartial;

    /**
     * @var        PropelObjectCollection|ThemePersonnage[] Collection to store aggregation of ThemePersonnage objects.
     */
    protected $collThemePersonnages;
    protected $collThemePersonnagesPartial;

    /**
     * @var        PropelObjectCollection|PersonnageI18n[] Collection to store aggregation of PersonnageI18n objects.
     */
    protected $collPersonnageI18ns;
    protected $collPersonnageI18nsPartial;

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
     * @var        array[PersonnageI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $avantagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themePersonnagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $personnageI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BasePersonnage object.
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
     * Get the [age] column value.
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
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
     * @return Personnage The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PersonnagePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [etablissement_id] column.
     *
     * @param int $v new value
     * @return Personnage The current object (for fluent API support)
     */
    public function setEtablissementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->etablissement_id !== $v) {
            $this->etablissement_id = $v;
            $this->modifiedColumns[] = PersonnagePeer::ETABLISSEMENT_ID;
        }

        if ($this->aEtablissement !== null && $this->aEtablissement->getId() !== $v) {
            $this->aEtablissement = null;
        }


        return $this;
    } // setEtablissementId()

    /**
     * Set the value of [age] column.
     *
     * @param string $v new value
     * @return Personnage The current object (for fluent API support)
     */
    public function setAge($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->age !== $v) {
            $this->age = $v;
            $this->modifiedColumns[] = PersonnagePeer::AGE;
        }


        return $this;
    } // setAge()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Personnage The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PersonnagePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Personnage The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PersonnagePeer::UPDATED_AT;
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
     * @return Personnage The current object (for fluent API support)
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
            $this->modifiedColumns[] = PersonnagePeer::ACTIVE;
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
            $this->age = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->created_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->updated_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = PersonnagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Personnage object", $e);
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
            $con = Propel::getConnection(PersonnagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PersonnagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEtablissement = null;
            $this->collAvantages = null;

            $this->collThemePersonnages = null;

            $this->collPersonnageI18ns = null;

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
            $con = Propel::getConnection(PersonnagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PersonnageQuery::create()
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
            $con = Propel::getConnection(PersonnagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PersonnagePeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PersonnagePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PersonnagePeer::UPDATED_AT)) {
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
                PersonnagePeer::addInstanceToPool($this);
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

            if ($this->themesScheduledForDeletion !== null) {
                if (!$this->themesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->themesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    ThemePersonnageQuery::create()
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

            if ($this->avantagesScheduledForDeletion !== null) {
                if (!$this->avantagesScheduledForDeletion->isEmpty()) {
                    foreach ($this->avantagesScheduledForDeletion as $avantage) {
                        // need to save related object because we set the relation to null
                        $avantage->save($con);
                    }
                    $this->avantagesScheduledForDeletion = null;
                }
            }

            if ($this->collAvantages !== null) {
                foreach ($this->collAvantages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->themePersonnagesScheduledForDeletion !== null) {
                if (!$this->themePersonnagesScheduledForDeletion->isEmpty()) {
                    ThemePersonnageQuery::create()
                        ->filterByPrimaryKeys($this->themePersonnagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->themePersonnagesScheduledForDeletion = null;
                }
            }

            if ($this->collThemePersonnages !== null) {
                foreach ($this->collThemePersonnages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->personnageI18nsScheduledForDeletion !== null) {
                if (!$this->personnageI18nsScheduledForDeletion->isEmpty()) {
                    PersonnageI18nQuery::create()
                        ->filterByPrimaryKeys($this->personnageI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->personnageI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPersonnageI18ns !== null) {
                foreach ($this->collPersonnageI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = PersonnagePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PersonnagePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PersonnagePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PersonnagePeer::ETABLISSEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`etablissement_id`';
        }
        if ($this->isColumnModified(PersonnagePeer::AGE)) {
            $modifiedColumns[':p' . $index++]  = '`age`';
        }
        if ($this->isColumnModified(PersonnagePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PersonnagePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(PersonnagePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `personnage` (%s) VALUES (%s)',
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
                    case '`age`':
                        $stmt->bindValue($identifier, $this->age, PDO::PARAM_STR);
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


            if (($retval = PersonnagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collAvantages !== null) {
                    foreach ($this->collAvantages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collThemePersonnages !== null) {
                    foreach ($this->collThemePersonnages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPersonnageI18ns !== null) {
                    foreach ($this->collPersonnageI18ns as $referrerFK) {
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
        $pos = PersonnagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAge();
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
        if (isset($alreadyDumpedObjects['Personnage'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Personnage'][$this->getPrimaryKey()] = true;
        $keys = PersonnagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEtablissementId(),
            $keys[2] => $this->getAge(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
            $keys[5] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aEtablissement) {
                $result['Etablissement'] = $this->aEtablissement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAvantages) {
                $result['Avantages'] = $this->collAvantages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThemePersonnages) {
                $result['ThemePersonnages'] = $this->collThemePersonnages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPersonnageI18ns) {
                $result['PersonnageI18ns'] = $this->collPersonnageI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PersonnagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAge($value);
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
        $keys = PersonnagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setEtablissementId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAge($arr[$keys[2]]);
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
        $criteria = new Criteria(PersonnagePeer::DATABASE_NAME);

        if ($this->isColumnModified(PersonnagePeer::ID)) $criteria->add(PersonnagePeer::ID, $this->id);
        if ($this->isColumnModified(PersonnagePeer::ETABLISSEMENT_ID)) $criteria->add(PersonnagePeer::ETABLISSEMENT_ID, $this->etablissement_id);
        if ($this->isColumnModified(PersonnagePeer::AGE)) $criteria->add(PersonnagePeer::AGE, $this->age);
        if ($this->isColumnModified(PersonnagePeer::CREATED_AT)) $criteria->add(PersonnagePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PersonnagePeer::UPDATED_AT)) $criteria->add(PersonnagePeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(PersonnagePeer::ACTIVE)) $criteria->add(PersonnagePeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(PersonnagePeer::DATABASE_NAME);
        $criteria->add(PersonnagePeer::ID, $this->id);

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
     * @param object $copyObj An object of Personnage (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEtablissementId($this->getEtablissementId());
        $copyObj->setAge($this->getAge());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getAvantages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAvantage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThemePersonnages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemePersonnage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPersonnageI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersonnageI18n($relObj->copy($deepCopy));
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
     * @return Personnage Clone of current object.
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
     * @return PersonnagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PersonnagePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return Personnage The current object (for fluent API support)
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
            $v->addPersonnage($this);
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
                $this->aEtablissement->addPersonnages($this);
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
        if ('Avantage' == $relationName) {
            $this->initAvantages();
        }
        if ('ThemePersonnage' == $relationName) {
            $this->initThemePersonnages();
        }
        if ('PersonnageI18n' == $relationName) {
            $this->initPersonnageI18ns();
        }
    }

    /**
     * Clears out the collAvantages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Personnage The current object (for fluent API support)
     * @see        addAvantages()
     */
    public function clearAvantages()
    {
        $this->collAvantages = null; // important to set this to null since that means it is uninitialized
        $this->collAvantagesPartial = null;

        return $this;
    }

    /**
     * reset is the collAvantages collection loaded partially
     *
     * @return void
     */
    public function resetPartialAvantages($v = true)
    {
        $this->collAvantagesPartial = $v;
    }

    /**
     * Initializes the collAvantages collection.
     *
     * By default this just sets the collAvantages collection to an empty array (like clearcollAvantages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAvantages($overrideExisting = true)
    {
        if (null !== $this->collAvantages && !$overrideExisting) {
            return;
        }
        $this->collAvantages = new PropelObjectCollection();
        $this->collAvantages->setModel('Avantage');
    }

    /**
     * Gets an array of Avantage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Personnage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Avantage[] List of Avantage objects
     * @throws PropelException
     */
    public function getAvantages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAvantagesPartial && !$this->isNew();
        if (null === $this->collAvantages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAvantages) {
                // return empty collection
                $this->initAvantages();
            } else {
                $collAvantages = AvantageQuery::create(null, $criteria)
                    ->filterByPersonnage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAvantagesPartial && count($collAvantages)) {
                      $this->initAvantages(false);

                      foreach($collAvantages as $obj) {
                        if (false == $this->collAvantages->contains($obj)) {
                          $this->collAvantages->append($obj);
                        }
                      }

                      $this->collAvantagesPartial = true;
                    }

                    return $collAvantages;
                }

                if($partial && $this->collAvantages) {
                    foreach($this->collAvantages as $obj) {
                        if($obj->isNew()) {
                            $collAvantages[] = $obj;
                        }
                    }
                }

                $this->collAvantages = $collAvantages;
                $this->collAvantagesPartial = false;
            }
        }

        return $this->collAvantages;
    }

    /**
     * Sets a collection of Avantage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $avantages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Personnage The current object (for fluent API support)
     */
    public function setAvantages(PropelCollection $avantages, PropelPDO $con = null)
    {
        $this->avantagesScheduledForDeletion = $this->getAvantages(new Criteria(), $con)->diff($avantages);

        foreach ($this->avantagesScheduledForDeletion as $avantageRemoved) {
            $avantageRemoved->setPersonnage(null);
        }

        $this->collAvantages = null;
        foreach ($avantages as $avantage) {
            $this->addAvantage($avantage);
        }

        $this->collAvantages = $avantages;
        $this->collAvantagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Avantage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Avantage objects.
     * @throws PropelException
     */
    public function countAvantages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAvantagesPartial && !$this->isNew();
        if (null === $this->collAvantages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAvantages) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getAvantages());
            }
            $query = AvantageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonnage($this)
                ->count($con);
        }

        return count($this->collAvantages);
    }

    /**
     * Method called to associate a Avantage object to this object
     * through the Avantage foreign key attribute.
     *
     * @param    Avantage $l Avantage
     * @return Personnage The current object (for fluent API support)
     */
    public function addAvantage(Avantage $l)
    {
        if ($this->collAvantages === null) {
            $this->initAvantages();
            $this->collAvantagesPartial = true;
        }
        if (!in_array($l, $this->collAvantages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAvantage($l);
        }

        return $this;
    }

    /**
     * @param	Avantage $avantage The avantage object to add.
     */
    protected function doAddAvantage($avantage)
    {
        $this->collAvantages[]= $avantage;
        $avantage->setPersonnage($this);
    }

    /**
     * @param	Avantage $avantage The avantage object to remove.
     * @return Personnage The current object (for fluent API support)
     */
    public function removeAvantage($avantage)
    {
        if ($this->getAvantages()->contains($avantage)) {
            $this->collAvantages->remove($this->collAvantages->search($avantage));
            if (null === $this->avantagesScheduledForDeletion) {
                $this->avantagesScheduledForDeletion = clone $this->collAvantages;
                $this->avantagesScheduledForDeletion->clear();
            }
            $this->avantagesScheduledForDeletion[]= $avantage;
            $avantage->setPersonnage(null);
        }

        return $this;
    }

    /**
     * Clears out the collThemePersonnages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Personnage The current object (for fluent API support)
     * @see        addThemePersonnages()
     */
    public function clearThemePersonnages()
    {
        $this->collThemePersonnages = null; // important to set this to null since that means it is uninitialized
        $this->collThemePersonnagesPartial = null;

        return $this;
    }

    /**
     * reset is the collThemePersonnages collection loaded partially
     *
     * @return void
     */
    public function resetPartialThemePersonnages($v = true)
    {
        $this->collThemePersonnagesPartial = $v;
    }

    /**
     * Initializes the collThemePersonnages collection.
     *
     * By default this just sets the collThemePersonnages collection to an empty array (like clearcollThemePersonnages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThemePersonnages($overrideExisting = true)
    {
        if (null !== $this->collThemePersonnages && !$overrideExisting) {
            return;
        }
        $this->collThemePersonnages = new PropelObjectCollection();
        $this->collThemePersonnages->setModel('ThemePersonnage');
    }

    /**
     * Gets an array of ThemePersonnage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Personnage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ThemePersonnage[] List of ThemePersonnage objects
     * @throws PropelException
     */
    public function getThemePersonnages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThemePersonnagesPartial && !$this->isNew();
        if (null === $this->collThemePersonnages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThemePersonnages) {
                // return empty collection
                $this->initThemePersonnages();
            } else {
                $collThemePersonnages = ThemePersonnageQuery::create(null, $criteria)
                    ->filterByPersonnage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThemePersonnagesPartial && count($collThemePersonnages)) {
                      $this->initThemePersonnages(false);

                      foreach($collThemePersonnages as $obj) {
                        if (false == $this->collThemePersonnages->contains($obj)) {
                          $this->collThemePersonnages->append($obj);
                        }
                      }

                      $this->collThemePersonnagesPartial = true;
                    }

                    return $collThemePersonnages;
                }

                if($partial && $this->collThemePersonnages) {
                    foreach($this->collThemePersonnages as $obj) {
                        if($obj->isNew()) {
                            $collThemePersonnages[] = $obj;
                        }
                    }
                }

                $this->collThemePersonnages = $collThemePersonnages;
                $this->collThemePersonnagesPartial = false;
            }
        }

        return $this->collThemePersonnages;
    }

    /**
     * Sets a collection of ThemePersonnage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themePersonnages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Personnage The current object (for fluent API support)
     */
    public function setThemePersonnages(PropelCollection $themePersonnages, PropelPDO $con = null)
    {
        $this->themePersonnagesScheduledForDeletion = $this->getThemePersonnages(new Criteria(), $con)->diff($themePersonnages);

        foreach ($this->themePersonnagesScheduledForDeletion as $themePersonnageRemoved) {
            $themePersonnageRemoved->setPersonnage(null);
        }

        $this->collThemePersonnages = null;
        foreach ($themePersonnages as $themePersonnage) {
            $this->addThemePersonnage($themePersonnage);
        }

        $this->collThemePersonnages = $themePersonnages;
        $this->collThemePersonnagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ThemePersonnage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ThemePersonnage objects.
     * @throws PropelException
     */
    public function countThemePersonnages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThemePersonnagesPartial && !$this->isNew();
        if (null === $this->collThemePersonnages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThemePersonnages) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getThemePersonnages());
            }
            $query = ThemePersonnageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonnage($this)
                ->count($con);
        }

        return count($this->collThemePersonnages);
    }

    /**
     * Method called to associate a ThemePersonnage object to this object
     * through the ThemePersonnage foreign key attribute.
     *
     * @param    ThemePersonnage $l ThemePersonnage
     * @return Personnage The current object (for fluent API support)
     */
    public function addThemePersonnage(ThemePersonnage $l)
    {
        if ($this->collThemePersonnages === null) {
            $this->initThemePersonnages();
            $this->collThemePersonnagesPartial = true;
        }
        if (!in_array($l, $this->collThemePersonnages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThemePersonnage($l);
        }

        return $this;
    }

    /**
     * @param	ThemePersonnage $themePersonnage The themePersonnage object to add.
     */
    protected function doAddThemePersonnage($themePersonnage)
    {
        $this->collThemePersonnages[]= $themePersonnage;
        $themePersonnage->setPersonnage($this);
    }

    /**
     * @param	ThemePersonnage $themePersonnage The themePersonnage object to remove.
     * @return Personnage The current object (for fluent API support)
     */
    public function removeThemePersonnage($themePersonnage)
    {
        if ($this->getThemePersonnages()->contains($themePersonnage)) {
            $this->collThemePersonnages->remove($this->collThemePersonnages->search($themePersonnage));
            if (null === $this->themePersonnagesScheduledForDeletion) {
                $this->themePersonnagesScheduledForDeletion = clone $this->collThemePersonnages;
                $this->themePersonnagesScheduledForDeletion->clear();
            }
            $this->themePersonnagesScheduledForDeletion[]= $themePersonnage;
            $themePersonnage->setPersonnage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Personnage is new, it will return
     * an empty collection; or if this Personnage has previously
     * been saved, it will retrieve related ThemePersonnages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Personnage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ThemePersonnage[] List of ThemePersonnage objects
     */
    public function getThemePersonnagesJoinTheme($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ThemePersonnageQuery::create(null, $criteria);
        $query->joinWith('Theme', $join_behavior);

        return $this->getThemePersonnages($query, $con);
    }

    /**
     * Clears out the collPersonnageI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Personnage The current object (for fluent API support)
     * @see        addPersonnageI18ns()
     */
    public function clearPersonnageI18ns()
    {
        $this->collPersonnageI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collPersonnageI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collPersonnageI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialPersonnageI18ns($v = true)
    {
        $this->collPersonnageI18nsPartial = $v;
    }

    /**
     * Initializes the collPersonnageI18ns collection.
     *
     * By default this just sets the collPersonnageI18ns collection to an empty array (like clearcollPersonnageI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersonnageI18ns($overrideExisting = true)
    {
        if (null !== $this->collPersonnageI18ns && !$overrideExisting) {
            return;
        }
        $this->collPersonnageI18ns = new PropelObjectCollection();
        $this->collPersonnageI18ns->setModel('PersonnageI18n');
    }

    /**
     * Gets an array of PersonnageI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Personnage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PersonnageI18n[] List of PersonnageI18n objects
     * @throws PropelException
     */
    public function getPersonnageI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPersonnageI18nsPartial && !$this->isNew();
        if (null === $this->collPersonnageI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersonnageI18ns) {
                // return empty collection
                $this->initPersonnageI18ns();
            } else {
                $collPersonnageI18ns = PersonnageI18nQuery::create(null, $criteria)
                    ->filterByPersonnage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPersonnageI18nsPartial && count($collPersonnageI18ns)) {
                      $this->initPersonnageI18ns(false);

                      foreach($collPersonnageI18ns as $obj) {
                        if (false == $this->collPersonnageI18ns->contains($obj)) {
                          $this->collPersonnageI18ns->append($obj);
                        }
                      }

                      $this->collPersonnageI18nsPartial = true;
                    }

                    return $collPersonnageI18ns;
                }

                if($partial && $this->collPersonnageI18ns) {
                    foreach($this->collPersonnageI18ns as $obj) {
                        if($obj->isNew()) {
                            $collPersonnageI18ns[] = $obj;
                        }
                    }
                }

                $this->collPersonnageI18ns = $collPersonnageI18ns;
                $this->collPersonnageI18nsPartial = false;
            }
        }

        return $this->collPersonnageI18ns;
    }

    /**
     * Sets a collection of PersonnageI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $personnageI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Personnage The current object (for fluent API support)
     */
    public function setPersonnageI18ns(PropelCollection $personnageI18ns, PropelPDO $con = null)
    {
        $this->personnageI18nsScheduledForDeletion = $this->getPersonnageI18ns(new Criteria(), $con)->diff($personnageI18ns);

        foreach ($this->personnageI18nsScheduledForDeletion as $personnageI18nRemoved) {
            $personnageI18nRemoved->setPersonnage(null);
        }

        $this->collPersonnageI18ns = null;
        foreach ($personnageI18ns as $personnageI18n) {
            $this->addPersonnageI18n($personnageI18n);
        }

        $this->collPersonnageI18ns = $personnageI18ns;
        $this->collPersonnageI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PersonnageI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PersonnageI18n objects.
     * @throws PropelException
     */
    public function countPersonnageI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPersonnageI18nsPartial && !$this->isNew();
        if (null === $this->collPersonnageI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersonnageI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getPersonnageI18ns());
            }
            $query = PersonnageI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonnage($this)
                ->count($con);
        }

        return count($this->collPersonnageI18ns);
    }

    /**
     * Method called to associate a PersonnageI18n object to this object
     * through the PersonnageI18n foreign key attribute.
     *
     * @param    PersonnageI18n $l PersonnageI18n
     * @return Personnage The current object (for fluent API support)
     */
    public function addPersonnageI18n(PersonnageI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPersonnageI18ns === null) {
            $this->initPersonnageI18ns();
            $this->collPersonnageI18nsPartial = true;
        }
        if (!in_array($l, $this->collPersonnageI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPersonnageI18n($l);
        }

        return $this;
    }

    /**
     * @param	PersonnageI18n $personnageI18n The personnageI18n object to add.
     */
    protected function doAddPersonnageI18n($personnageI18n)
    {
        $this->collPersonnageI18ns[]= $personnageI18n;
        $personnageI18n->setPersonnage($this);
    }

    /**
     * @param	PersonnageI18n $personnageI18n The personnageI18n object to remove.
     * @return Personnage The current object (for fluent API support)
     */
    public function removePersonnageI18n($personnageI18n)
    {
        if ($this->getPersonnageI18ns()->contains($personnageI18n)) {
            $this->collPersonnageI18ns->remove($this->collPersonnageI18ns->search($personnageI18n));
            if (null === $this->personnageI18nsScheduledForDeletion) {
                $this->personnageI18nsScheduledForDeletion = clone $this->collPersonnageI18ns;
                $this->personnageI18nsScheduledForDeletion->clear();
            }
            $this->personnageI18nsScheduledForDeletion[]= $personnageI18n;
            $personnageI18n->setPersonnage(null);
        }

        return $this;
    }

    /**
     * Clears out the collThemes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Personnage The current object (for fluent API support)
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
     * to the current object by way of the theme_personnage cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Personnage is new, it will return
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
                    ->filterByPersonnage($this)
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
     * to the current object by way of the theme_personnage cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themes A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Personnage The current object (for fluent API support)
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
     * to the current object by way of the theme_personnage cross-reference table.
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
                    ->filterByPersonnage($this)
                    ->count($con);
            }
        } else {
            return count($this->collThemes);
        }
    }

    /**
     * Associate a Theme object to this object
     * through the theme_personnage cross reference table.
     *
     * @param  Theme $theme The ThemePersonnage object to relate
     * @return Personnage The current object (for fluent API support)
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
        $themePersonnage = new ThemePersonnage();
        $themePersonnage->setTheme($theme);
        $this->addThemePersonnage($themePersonnage);
    }

    /**
     * Remove a Theme object to this object
     * through the theme_personnage cross reference table.
     *
     * @param Theme $theme The ThemePersonnage object to relate
     * @return Personnage The current object (for fluent API support)
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
        $this->etablissement_id = null;
        $this->age = null;
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
            if ($this->collAvantages) {
                foreach ($this->collAvantages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemePersonnages) {
                foreach ($this->collThemePersonnages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPersonnageI18ns) {
                foreach ($this->collPersonnageI18ns as $o) {
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

        if ($this->collAvantages instanceof PropelCollection) {
            $this->collAvantages->clearIterator();
        }
        $this->collAvantages = null;
        if ($this->collThemePersonnages instanceof PropelCollection) {
            $this->collThemePersonnages->clearIterator();
        }
        $this->collThemePersonnages = null;
        if ($this->collPersonnageI18ns instanceof PropelCollection) {
            $this->collPersonnageI18ns->clearIterator();
        }
        $this->collPersonnageI18ns = null;
        if ($this->collThemes instanceof PropelCollection) {
            $this->collThemes->clearIterator();
        }
        $this->collThemes = null;
        $this->aEtablissement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PersonnagePeer::DEFAULT_STRING_FORMAT);
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
     * @return     Personnage The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PersonnagePeer::UPDATED_AT;

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

    public function getThemesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\ThemePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ThemeI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ThemePeer::ID, \Cungfoo\Model\ThemeI18nPeer::alias('i18n_locale', \Cungfoo\Model\ThemeI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ThemeI18nPeer::alias('i18n_locale', \Cungfoo\Model\ThemeI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ThemeI18nPeer::alias('i18n_locale', \Cungfoo\Model\ThemeI18nPeer::LOCALE), $this->currentLocale);

        return $this->getThemes($criteria, $con);
    }

    public function getAvantagesActive($criteria = null, PropelPDO $con = null)
    {

        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\AvantagePeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\AvantageI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\AvantagePeer::ID, \Cungfoo\Model\AvantageI18nPeer::alias('i18n_locale', \Cungfoo\Model\AvantageI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\AvantageI18nPeer::alias('i18n_locale', \Cungfoo\Model\AvantageI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\AvantageI18nPeer::alias('i18n_locale', \Cungfoo\Model\AvantageI18nPeer::LOCALE), $this->currentLocale);

        return $this->getAvantages($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Personnage The current object (for fluent API support)
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
     * @return PersonnageI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPersonnageI18ns) {
                foreach ($this->collPersonnageI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new PersonnageI18n();
                $translation->setLocale($locale);
            } else {
                $translation = PersonnageI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPersonnageI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Personnage The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            PersonnageI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPersonnageI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPersonnageI18ns[$key]);
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
     * @return PersonnageI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [prenom] column value.
         *
         * @return string
         */
        public function getPrenom()
        {
        return $this->getCurrentTranslation()->getPrenom();
    }


        /**
         * Set the value of [prenom] column.
         *
         * @param string $v new value
         * @return PersonnageI18n The current object (for fluent API support)
         */
        public function setPrenom($v)
        {    $this->getCurrentTranslation()->setPrenom($v);

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
         * @return PersonnageI18n The current object (for fluent API support)
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
         * @return PersonnageI18n The current object (for fluent API support)
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
         * @return PersonnageI18n The current object (for fluent API support)
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
         * @return PersonnageI18n The current object (for fluent API support)
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
         * @return PersonnageI18n The current object (for fluent API support)
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

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/personnages';
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * @return void
     */
    public function getImagePath()
    {
        $peer = self::PEER;

        $medias = \Cungfoo\Model\PortfolioMediaQuery::create()
            ->select('id')
            ->usePortfolioUsageQuery()
                ->filterByTableRef($peer::TABLE_NAME)
                ->filterByColumnRef('image_path')
                ->filterByElementId($this->getId())
            ->endUse()
            ->find()
            ->toArray()
        ;

        return implode(';', $medias);
    }

    /**
     * @return void
     */
    public function setImagePath($v)
    {
        $peer = self::PEER;

        $values = explode(';', $v);

        \Cungfoo\Model\PortfolioUsageQuery::create()
            ->filterByTableRef($peer::TABLE_NAME)
            ->filterByColumnRef('image_path')
            ->filterByElementId($this->getId())
            ->filterByMediaId($values, \Criteria::NOT_IN)
            ->find()
            ->delete()
        ;

        if ($v) {
            foreach ($values as $index => $value) {
                $usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                    ->filterByTableRef($peer::TABLE_NAME)
                    ->filterByColumnRef('image_path')
                    ->filterByElementId($this->getId())
                    ->filterByMediaId($value)
                    ->findOne()
                ;

                if (!$usage) {
                    $usage = new \Cungfoo\Model\PortfolioUsage();
                    $usage
                        ->setTableRef($peer::TABLE_NAME)
                        ->setColumnRef('image_path')
                        ->setElementId($this->getId())
                        ->setMediaId($value)
                    ;
                }

                $usage
                    ->setSortableRank($index)
                    ->save()
                ;
            }

        }
    }

}
