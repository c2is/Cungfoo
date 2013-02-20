<?php

namespace Cungfoo\Model\om;

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
use Cungfoo\Model\Activite;
use Cungfoo\Model\ActiviteQuery;
use Cungfoo\Model\Baignade;
use Cungfoo\Model\BaignadeQuery;
use Cungfoo\Model\Personnage;
use Cungfoo\Model\PersonnageQuery;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\ServiceComplementaireQuery;
use Cungfoo\Model\Theme;
use Cungfoo\Model\ThemeActivite;
use Cungfoo\Model\ThemeActiviteQuery;
use Cungfoo\Model\ThemeBaignade;
use Cungfoo\Model\ThemeBaignadeQuery;
use Cungfoo\Model\ThemeI18n;
use Cungfoo\Model\ThemeI18nQuery;
use Cungfoo\Model\ThemePeer;
use Cungfoo\Model\ThemePersonnage;
use Cungfoo\Model\ThemePersonnageQuery;
use Cungfoo\Model\ThemeQuery;
use Cungfoo\Model\ThemeServiceComplementaire;
use Cungfoo\Model\ThemeServiceComplementaireQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'theme' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTheme extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\ThemePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ThemePeer
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
     * @var        PropelObjectCollection|ThemeActivite[] Collection to store aggregation of ThemeActivite objects.
     */
    protected $collThemeActivites;
    protected $collThemeActivitesPartial;

    /**
     * @var        PropelObjectCollection|ThemeBaignade[] Collection to store aggregation of ThemeBaignade objects.
     */
    protected $collThemeBaignades;
    protected $collThemeBaignadesPartial;

    /**
     * @var        PropelObjectCollection|ThemeServiceComplementaire[] Collection to store aggregation of ThemeServiceComplementaire objects.
     */
    protected $collThemeServiceComplementaires;
    protected $collThemeServiceComplementairesPartial;

    /**
     * @var        PropelObjectCollection|ThemePersonnage[] Collection to store aggregation of ThemePersonnage objects.
     */
    protected $collThemePersonnages;
    protected $collThemePersonnagesPartial;

    /**
     * @var        PropelObjectCollection|ThemeI18n[] Collection to store aggregation of ThemeI18n objects.
     */
    protected $collThemeI18ns;
    protected $collThemeI18nsPartial;

    /**
     * @var        PropelObjectCollection|Activite[] Collection to store aggregation of Activite objects.
     */
    protected $collActivites;

    /**
     * @var        PropelObjectCollection|Baignade[] Collection to store aggregation of Baignade objects.
     */
    protected $collBaignades;

    /**
     * @var        PropelObjectCollection|ServiceComplementaire[] Collection to store aggregation of ServiceComplementaire objects.
     */
    protected $collServiceComplementaires;

    /**
     * @var        PropelObjectCollection|Personnage[] Collection to store aggregation of Personnage objects.
     */
    protected $collPersonnages;

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
     * @var        array[ThemeI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $activitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $baignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $serviceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $personnagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themeActivitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themeBaignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themeServiceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themePersonnagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $themeI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseTheme object.
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
     * @return Theme The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ThemePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [image_path] column.
     *
     * @param string $v new value
     * @return Theme The current object (for fluent API support)
     */
    public function setImagePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_path !== $v) {
            $this->image_path = $v;
            $this->modifiedColumns[] = ThemePeer::IMAGE_PATH;
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
     * @return Theme The current object (for fluent API support)
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
            $this->modifiedColumns[] = ThemePeer::ACTIVE;
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
            $this->image_path = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = ThemePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Theme object", $e);
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
            $con = Propel::getConnection(ThemePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ThemePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collThemeActivites = null;

            $this->collThemeBaignades = null;

            $this->collThemeServiceComplementaires = null;

            $this->collThemePersonnages = null;

            $this->collThemeI18ns = null;

            $this->collActivites = null;
            $this->collBaignades = null;
            $this->collServiceComplementaires = null;
            $this->collPersonnages = null;
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
            $con = Propel::getConnection(ThemePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ThemeQuery::create()
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
            $con = Propel::getConnection(ThemePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ThemePeer::addInstanceToPool($this);
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

            if ($this->activitesScheduledForDeletion !== null) {
                if (!$this->activitesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->activitesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ThemeActiviteQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->activitesScheduledForDeletion = null;
                }

                foreach ($this->getActivites() as $activite) {
                    if ($activite->isModified()) {
                        $activite->save($con);
                    }
                }
            }

            if ($this->baignadesScheduledForDeletion !== null) {
                if (!$this->baignadesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->baignadesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ThemeBaignadeQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->baignadesScheduledForDeletion = null;
                }

                foreach ($this->getBaignades() as $baignade) {
                    if ($baignade->isModified()) {
                        $baignade->save($con);
                    }
                }
            }

            if ($this->serviceComplementairesScheduledForDeletion !== null) {
                if (!$this->serviceComplementairesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->serviceComplementairesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ThemeServiceComplementaireQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->serviceComplementairesScheduledForDeletion = null;
                }

                foreach ($this->getServiceComplementaires() as $serviceComplementaire) {
                    if ($serviceComplementaire->isModified()) {
                        $serviceComplementaire->save($con);
                    }
                }
            }

            if ($this->personnagesScheduledForDeletion !== null) {
                if (!$this->personnagesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->personnagesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ThemePersonnageQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->personnagesScheduledForDeletion = null;
                }

                foreach ($this->getPersonnages() as $personnage) {
                    if ($personnage->isModified()) {
                        $personnage->save($con);
                    }
                }
            }

            if ($this->themeActivitesScheduledForDeletion !== null) {
                if (!$this->themeActivitesScheduledForDeletion->isEmpty()) {
                    ThemeActiviteQuery::create()
                        ->filterByPrimaryKeys($this->themeActivitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->themeActivitesScheduledForDeletion = null;
                }
            }

            if ($this->collThemeActivites !== null) {
                foreach ($this->collThemeActivites as $referrerFK) {
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

            if ($this->themeServiceComplementairesScheduledForDeletion !== null) {
                if (!$this->themeServiceComplementairesScheduledForDeletion->isEmpty()) {
                    ThemeServiceComplementaireQuery::create()
                        ->filterByPrimaryKeys($this->themeServiceComplementairesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->themeServiceComplementairesScheduledForDeletion = null;
                }
            }

            if ($this->collThemeServiceComplementaires !== null) {
                foreach ($this->collThemeServiceComplementaires as $referrerFK) {
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

            if ($this->themeI18nsScheduledForDeletion !== null) {
                if (!$this->themeI18nsScheduledForDeletion->isEmpty()) {
                    ThemeI18nQuery::create()
                        ->filterByPrimaryKeys($this->themeI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->themeI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collThemeI18ns !== null) {
                foreach ($this->collThemeI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = ThemePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ThemePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ThemePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ThemePeer::IMAGE_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_path`';
        }
        if ($this->isColumnModified(ThemePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `theme` (%s) VALUES (%s)',
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
                    case '`image_path`':
                        $stmt->bindValue($identifier, $this->image_path, PDO::PARAM_STR);
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


            if (($retval = ThemePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collThemeActivites !== null) {
                    foreach ($this->collThemeActivites as $referrerFK) {
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

                if ($this->collThemeServiceComplementaires !== null) {
                    foreach ($this->collThemeServiceComplementaires as $referrerFK) {
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

                if ($this->collThemeI18ns !== null) {
                    foreach ($this->collThemeI18ns as $referrerFK) {
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
        $pos = ThemePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getImagePath();
                break;
            case 2:
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
        if (isset($alreadyDumpedObjects['Theme'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Theme'][$this->getPrimaryKey()] = true;
        $keys = ThemePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getImagePath(),
            $keys[2] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collThemeActivites) {
                $result['ThemeActivites'] = $this->collThemeActivites->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThemeBaignades) {
                $result['ThemeBaignades'] = $this->collThemeBaignades->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThemeServiceComplementaires) {
                $result['ThemeServiceComplementaires'] = $this->collThemeServiceComplementaires->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThemePersonnages) {
                $result['ThemePersonnages'] = $this->collThemePersonnages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThemeI18ns) {
                $result['ThemeI18ns'] = $this->collThemeI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ThemePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setImagePath($value);
                break;
            case 2:
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
        $keys = ThemePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setImagePath($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setActive($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ThemePeer::DATABASE_NAME);

        if ($this->isColumnModified(ThemePeer::ID)) $criteria->add(ThemePeer::ID, $this->id);
        if ($this->isColumnModified(ThemePeer::IMAGE_PATH)) $criteria->add(ThemePeer::IMAGE_PATH, $this->image_path);
        if ($this->isColumnModified(ThemePeer::ACTIVE)) $criteria->add(ThemePeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(ThemePeer::DATABASE_NAME);
        $criteria->add(ThemePeer::ID, $this->id);

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
     * @param object $copyObj An object of Theme (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setImagePath($this->getImagePath());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getThemeActivites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemeActivite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThemeBaignades() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemeBaignade($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThemeServiceComplementaires() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemeServiceComplementaire($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThemePersonnages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemePersonnage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThemeI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThemeI18n($relObj->copy($deepCopy));
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
     * @return Theme Clone of current object.
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
     * @return ThemePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ThemePeer();
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
        if ('ThemeActivite' == $relationName) {
            $this->initThemeActivites();
        }
        if ('ThemeBaignade' == $relationName) {
            $this->initThemeBaignades();
        }
        if ('ThemeServiceComplementaire' == $relationName) {
            $this->initThemeServiceComplementaires();
        }
        if ('ThemePersonnage' == $relationName) {
            $this->initThemePersonnages();
        }
        if ('ThemeI18n' == $relationName) {
            $this->initThemeI18ns();
        }
    }

    /**
     * Clears out the collThemeActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addThemeActivites()
     */
    public function clearThemeActivites()
    {
        $this->collThemeActivites = null; // important to set this to null since that means it is uninitialized
        $this->collThemeActivitesPartial = null;

        return $this;
    }

    /**
     * reset is the collThemeActivites collection loaded partially
     *
     * @return void
     */
    public function resetPartialThemeActivites($v = true)
    {
        $this->collThemeActivitesPartial = $v;
    }

    /**
     * Initializes the collThemeActivites collection.
     *
     * By default this just sets the collThemeActivites collection to an empty array (like clearcollThemeActivites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThemeActivites($overrideExisting = true)
    {
        if (null !== $this->collThemeActivites && !$overrideExisting) {
            return;
        }
        $this->collThemeActivites = new PropelObjectCollection();
        $this->collThemeActivites->setModel('ThemeActivite');
    }

    /**
     * Gets an array of ThemeActivite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ThemeActivite[] List of ThemeActivite objects
     * @throws PropelException
     */
    public function getThemeActivites($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThemeActivitesPartial && !$this->isNew();
        if (null === $this->collThemeActivites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThemeActivites) {
                // return empty collection
                $this->initThemeActivites();
            } else {
                $collThemeActivites = ThemeActiviteQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThemeActivitesPartial && count($collThemeActivites)) {
                      $this->initThemeActivites(false);

                      foreach($collThemeActivites as $obj) {
                        if (false == $this->collThemeActivites->contains($obj)) {
                          $this->collThemeActivites->append($obj);
                        }
                      }

                      $this->collThemeActivitesPartial = true;
                    }

                    return $collThemeActivites;
                }

                if($partial && $this->collThemeActivites) {
                    foreach($this->collThemeActivites as $obj) {
                        if($obj->isNew()) {
                            $collThemeActivites[] = $obj;
                        }
                    }
                }

                $this->collThemeActivites = $collThemeActivites;
                $this->collThemeActivitesPartial = false;
            }
        }

        return $this->collThemeActivites;
    }

    /**
     * Sets a collection of ThemeActivite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themeActivites A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setThemeActivites(PropelCollection $themeActivites, PropelPDO $con = null)
    {
        $this->themeActivitesScheduledForDeletion = $this->getThemeActivites(new Criteria(), $con)->diff($themeActivites);

        foreach ($this->themeActivitesScheduledForDeletion as $themeActiviteRemoved) {
            $themeActiviteRemoved->setTheme(null);
        }

        $this->collThemeActivites = null;
        foreach ($themeActivites as $themeActivite) {
            $this->addThemeActivite($themeActivite);
        }

        $this->collThemeActivites = $themeActivites;
        $this->collThemeActivitesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ThemeActivite objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ThemeActivite objects.
     * @throws PropelException
     */
    public function countThemeActivites(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThemeActivitesPartial && !$this->isNew();
        if (null === $this->collThemeActivites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThemeActivites) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getThemeActivites());
            }
            $query = ThemeActiviteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTheme($this)
                ->count($con);
        }

        return count($this->collThemeActivites);
    }

    /**
     * Method called to associate a ThemeActivite object to this object
     * through the ThemeActivite foreign key attribute.
     *
     * @param    ThemeActivite $l ThemeActivite
     * @return Theme The current object (for fluent API support)
     */
    public function addThemeActivite(ThemeActivite $l)
    {
        if ($this->collThemeActivites === null) {
            $this->initThemeActivites();
            $this->collThemeActivitesPartial = true;
        }
        if (!in_array($l, $this->collThemeActivites->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThemeActivite($l);
        }

        return $this;
    }

    /**
     * @param	ThemeActivite $themeActivite The themeActivite object to add.
     */
    protected function doAddThemeActivite($themeActivite)
    {
        $this->collThemeActivites[]= $themeActivite;
        $themeActivite->setTheme($this);
    }

    /**
     * @param	ThemeActivite $themeActivite The themeActivite object to remove.
     * @return Theme The current object (for fluent API support)
     */
    public function removeThemeActivite($themeActivite)
    {
        if ($this->getThemeActivites()->contains($themeActivite)) {
            $this->collThemeActivites->remove($this->collThemeActivites->search($themeActivite));
            if (null === $this->themeActivitesScheduledForDeletion) {
                $this->themeActivitesScheduledForDeletion = clone $this->collThemeActivites;
                $this->themeActivitesScheduledForDeletion->clear();
            }
            $this->themeActivitesScheduledForDeletion[]= $themeActivite;
            $themeActivite->setTheme(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Theme is new, it will return
     * an empty collection; or if this Theme has previously
     * been saved, it will retrieve related ThemeActivites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Theme.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ThemeActivite[] List of ThemeActivite objects
     */
    public function getThemeActivitesJoinActivite($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ThemeActiviteQuery::create(null, $criteria);
        $query->joinWith('Activite', $join_behavior);

        return $this->getThemeActivites($query, $con);
    }

    /**
     * Clears out the collThemeBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
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
     * If this Theme is new, it will return
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
                    ->filterByTheme($this)
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
     * @return Theme The current object (for fluent API support)
     */
    public function setThemeBaignades(PropelCollection $themeBaignades, PropelPDO $con = null)
    {
        $this->themeBaignadesScheduledForDeletion = $this->getThemeBaignades(new Criteria(), $con)->diff($themeBaignades);

        foreach ($this->themeBaignadesScheduledForDeletion as $themeBaignadeRemoved) {
            $themeBaignadeRemoved->setTheme(null);
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
                ->filterByTheme($this)
                ->count($con);
        }

        return count($this->collThemeBaignades);
    }

    /**
     * Method called to associate a ThemeBaignade object to this object
     * through the ThemeBaignade foreign key attribute.
     *
     * @param    ThemeBaignade $l ThemeBaignade
     * @return Theme The current object (for fluent API support)
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
        $themeBaignade->setTheme($this);
    }

    /**
     * @param	ThemeBaignade $themeBaignade The themeBaignade object to remove.
     * @return Theme The current object (for fluent API support)
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
            $themeBaignade->setTheme(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Theme is new, it will return
     * an empty collection; or if this Theme has previously
     * been saved, it will retrieve related ThemeBaignades from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Theme.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ThemeBaignade[] List of ThemeBaignade objects
     */
    public function getThemeBaignadesJoinBaignade($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ThemeBaignadeQuery::create(null, $criteria);
        $query->joinWith('Baignade', $join_behavior);

        return $this->getThemeBaignades($query, $con);
    }

    /**
     * Clears out the collThemeServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addThemeServiceComplementaires()
     */
    public function clearThemeServiceComplementaires()
    {
        $this->collThemeServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collThemeServiceComplementairesPartial = null;

        return $this;
    }

    /**
     * reset is the collThemeServiceComplementaires collection loaded partially
     *
     * @return void
     */
    public function resetPartialThemeServiceComplementaires($v = true)
    {
        $this->collThemeServiceComplementairesPartial = $v;
    }

    /**
     * Initializes the collThemeServiceComplementaires collection.
     *
     * By default this just sets the collThemeServiceComplementaires collection to an empty array (like clearcollThemeServiceComplementaires());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThemeServiceComplementaires($overrideExisting = true)
    {
        if (null !== $this->collThemeServiceComplementaires && !$overrideExisting) {
            return;
        }
        $this->collThemeServiceComplementaires = new PropelObjectCollection();
        $this->collThemeServiceComplementaires->setModel('ThemeServiceComplementaire');
    }

    /**
     * Gets an array of ThemeServiceComplementaire objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ThemeServiceComplementaire[] List of ThemeServiceComplementaire objects
     * @throws PropelException
     */
    public function getThemeServiceComplementaires($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThemeServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collThemeServiceComplementaires || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThemeServiceComplementaires) {
                // return empty collection
                $this->initThemeServiceComplementaires();
            } else {
                $collThemeServiceComplementaires = ThemeServiceComplementaireQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThemeServiceComplementairesPartial && count($collThemeServiceComplementaires)) {
                      $this->initThemeServiceComplementaires(false);

                      foreach($collThemeServiceComplementaires as $obj) {
                        if (false == $this->collThemeServiceComplementaires->contains($obj)) {
                          $this->collThemeServiceComplementaires->append($obj);
                        }
                      }

                      $this->collThemeServiceComplementairesPartial = true;
                    }

                    return $collThemeServiceComplementaires;
                }

                if($partial && $this->collThemeServiceComplementaires) {
                    foreach($this->collThemeServiceComplementaires as $obj) {
                        if($obj->isNew()) {
                            $collThemeServiceComplementaires[] = $obj;
                        }
                    }
                }

                $this->collThemeServiceComplementaires = $collThemeServiceComplementaires;
                $this->collThemeServiceComplementairesPartial = false;
            }
        }

        return $this->collThemeServiceComplementaires;
    }

    /**
     * Sets a collection of ThemeServiceComplementaire objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themeServiceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setThemeServiceComplementaires(PropelCollection $themeServiceComplementaires, PropelPDO $con = null)
    {
        $this->themeServiceComplementairesScheduledForDeletion = $this->getThemeServiceComplementaires(new Criteria(), $con)->diff($themeServiceComplementaires);

        foreach ($this->themeServiceComplementairesScheduledForDeletion as $themeServiceComplementaireRemoved) {
            $themeServiceComplementaireRemoved->setTheme(null);
        }

        $this->collThemeServiceComplementaires = null;
        foreach ($themeServiceComplementaires as $themeServiceComplementaire) {
            $this->addThemeServiceComplementaire($themeServiceComplementaire);
        }

        $this->collThemeServiceComplementaires = $themeServiceComplementaires;
        $this->collThemeServiceComplementairesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ThemeServiceComplementaire objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ThemeServiceComplementaire objects.
     * @throws PropelException
     */
    public function countThemeServiceComplementaires(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThemeServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collThemeServiceComplementaires || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThemeServiceComplementaires) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getThemeServiceComplementaires());
            }
            $query = ThemeServiceComplementaireQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTheme($this)
                ->count($con);
        }

        return count($this->collThemeServiceComplementaires);
    }

    /**
     * Method called to associate a ThemeServiceComplementaire object to this object
     * through the ThemeServiceComplementaire foreign key attribute.
     *
     * @param    ThemeServiceComplementaire $l ThemeServiceComplementaire
     * @return Theme The current object (for fluent API support)
     */
    public function addThemeServiceComplementaire(ThemeServiceComplementaire $l)
    {
        if ($this->collThemeServiceComplementaires === null) {
            $this->initThemeServiceComplementaires();
            $this->collThemeServiceComplementairesPartial = true;
        }
        if (!in_array($l, $this->collThemeServiceComplementaires->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThemeServiceComplementaire($l);
        }

        return $this;
    }

    /**
     * @param	ThemeServiceComplementaire $themeServiceComplementaire The themeServiceComplementaire object to add.
     */
    protected function doAddThemeServiceComplementaire($themeServiceComplementaire)
    {
        $this->collThemeServiceComplementaires[]= $themeServiceComplementaire;
        $themeServiceComplementaire->setTheme($this);
    }

    /**
     * @param	ThemeServiceComplementaire $themeServiceComplementaire The themeServiceComplementaire object to remove.
     * @return Theme The current object (for fluent API support)
     */
    public function removeThemeServiceComplementaire($themeServiceComplementaire)
    {
        if ($this->getThemeServiceComplementaires()->contains($themeServiceComplementaire)) {
            $this->collThemeServiceComplementaires->remove($this->collThemeServiceComplementaires->search($themeServiceComplementaire));
            if (null === $this->themeServiceComplementairesScheduledForDeletion) {
                $this->themeServiceComplementairesScheduledForDeletion = clone $this->collThemeServiceComplementaires;
                $this->themeServiceComplementairesScheduledForDeletion->clear();
            }
            $this->themeServiceComplementairesScheduledForDeletion[]= $themeServiceComplementaire;
            $themeServiceComplementaire->setTheme(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Theme is new, it will return
     * an empty collection; or if this Theme has previously
     * been saved, it will retrieve related ThemeServiceComplementaires from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Theme.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ThemeServiceComplementaire[] List of ThemeServiceComplementaire objects
     */
    public function getThemeServiceComplementairesJoinServiceComplementaire($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ThemeServiceComplementaireQuery::create(null, $criteria);
        $query->joinWith('ServiceComplementaire', $join_behavior);

        return $this->getThemeServiceComplementaires($query, $con);
    }

    /**
     * Clears out the collThemePersonnages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
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
     * If this Theme is new, it will return
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
                    ->filterByTheme($this)
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
     * @return Theme The current object (for fluent API support)
     */
    public function setThemePersonnages(PropelCollection $themePersonnages, PropelPDO $con = null)
    {
        $this->themePersonnagesScheduledForDeletion = $this->getThemePersonnages(new Criteria(), $con)->diff($themePersonnages);

        foreach ($this->themePersonnagesScheduledForDeletion as $themePersonnageRemoved) {
            $themePersonnageRemoved->setTheme(null);
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
                ->filterByTheme($this)
                ->count($con);
        }

        return count($this->collThemePersonnages);
    }

    /**
     * Method called to associate a ThemePersonnage object to this object
     * through the ThemePersonnage foreign key attribute.
     *
     * @param    ThemePersonnage $l ThemePersonnage
     * @return Theme The current object (for fluent API support)
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
        $themePersonnage->setTheme($this);
    }

    /**
     * @param	ThemePersonnage $themePersonnage The themePersonnage object to remove.
     * @return Theme The current object (for fluent API support)
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
            $themePersonnage->setTheme(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Theme is new, it will return
     * an empty collection; or if this Theme has previously
     * been saved, it will retrieve related ThemePersonnages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Theme.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ThemePersonnage[] List of ThemePersonnage objects
     */
    public function getThemePersonnagesJoinPersonnage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ThemePersonnageQuery::create(null, $criteria);
        $query->joinWith('Personnage', $join_behavior);

        return $this->getThemePersonnages($query, $con);
    }

    /**
     * Clears out the collThemeI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addThemeI18ns()
     */
    public function clearThemeI18ns()
    {
        $this->collThemeI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collThemeI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collThemeI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialThemeI18ns($v = true)
    {
        $this->collThemeI18nsPartial = $v;
    }

    /**
     * Initializes the collThemeI18ns collection.
     *
     * By default this just sets the collThemeI18ns collection to an empty array (like clearcollThemeI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThemeI18ns($overrideExisting = true)
    {
        if (null !== $this->collThemeI18ns && !$overrideExisting) {
            return;
        }
        $this->collThemeI18ns = new PropelObjectCollection();
        $this->collThemeI18ns->setModel('ThemeI18n');
    }

    /**
     * Gets an array of ThemeI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ThemeI18n[] List of ThemeI18n objects
     * @throws PropelException
     */
    public function getThemeI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThemeI18nsPartial && !$this->isNew();
        if (null === $this->collThemeI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThemeI18ns) {
                // return empty collection
                $this->initThemeI18ns();
            } else {
                $collThemeI18ns = ThemeI18nQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThemeI18nsPartial && count($collThemeI18ns)) {
                      $this->initThemeI18ns(false);

                      foreach($collThemeI18ns as $obj) {
                        if (false == $this->collThemeI18ns->contains($obj)) {
                          $this->collThemeI18ns->append($obj);
                        }
                      }

                      $this->collThemeI18nsPartial = true;
                    }

                    return $collThemeI18ns;
                }

                if($partial && $this->collThemeI18ns) {
                    foreach($this->collThemeI18ns as $obj) {
                        if($obj->isNew()) {
                            $collThemeI18ns[] = $obj;
                        }
                    }
                }

                $this->collThemeI18ns = $collThemeI18ns;
                $this->collThemeI18nsPartial = false;
            }
        }

        return $this->collThemeI18ns;
    }

    /**
     * Sets a collection of ThemeI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $themeI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setThemeI18ns(PropelCollection $themeI18ns, PropelPDO $con = null)
    {
        $this->themeI18nsScheduledForDeletion = $this->getThemeI18ns(new Criteria(), $con)->diff($themeI18ns);

        foreach ($this->themeI18nsScheduledForDeletion as $themeI18nRemoved) {
            $themeI18nRemoved->setTheme(null);
        }

        $this->collThemeI18ns = null;
        foreach ($themeI18ns as $themeI18n) {
            $this->addThemeI18n($themeI18n);
        }

        $this->collThemeI18ns = $themeI18ns;
        $this->collThemeI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ThemeI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ThemeI18n objects.
     * @throws PropelException
     */
    public function countThemeI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThemeI18nsPartial && !$this->isNew();
        if (null === $this->collThemeI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThemeI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getThemeI18ns());
            }
            $query = ThemeI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTheme($this)
                ->count($con);
        }

        return count($this->collThemeI18ns);
    }

    /**
     * Method called to associate a ThemeI18n object to this object
     * through the ThemeI18n foreign key attribute.
     *
     * @param    ThemeI18n $l ThemeI18n
     * @return Theme The current object (for fluent API support)
     */
    public function addThemeI18n(ThemeI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collThemeI18ns === null) {
            $this->initThemeI18ns();
            $this->collThemeI18nsPartial = true;
        }
        if (!in_array($l, $this->collThemeI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThemeI18n($l);
        }

        return $this;
    }

    /**
     * @param	ThemeI18n $themeI18n The themeI18n object to add.
     */
    protected function doAddThemeI18n($themeI18n)
    {
        $this->collThemeI18ns[]= $themeI18n;
        $themeI18n->setTheme($this);
    }

    /**
     * @param	ThemeI18n $themeI18n The themeI18n object to remove.
     * @return Theme The current object (for fluent API support)
     */
    public function removeThemeI18n($themeI18n)
    {
        if ($this->getThemeI18ns()->contains($themeI18n)) {
            $this->collThemeI18ns->remove($this->collThemeI18ns->search($themeI18n));
            if (null === $this->themeI18nsScheduledForDeletion) {
                $this->themeI18nsScheduledForDeletion = clone $this->collThemeI18ns;
                $this->themeI18nsScheduledForDeletion->clear();
            }
            $this->themeI18nsScheduledForDeletion[]= $themeI18n;
            $themeI18n->setTheme(null);
        }

        return $this;
    }

    /**
     * Clears out the collActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addActivites()
     */
    public function clearActivites()
    {
        $this->collActivites = null; // important to set this to null since that means it is uninitialized
        $this->collActivitesPartial = null;

        return $this;
    }

    /**
     * Initializes the collActivites collection.
     *
     * By default this just sets the collActivites collection to an empty collection (like clearActivites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initActivites()
    {
        $this->collActivites = new PropelObjectCollection();
        $this->collActivites->setModel('Activite');
    }

    /**
     * Gets a collection of Activite objects related by a many-to-many relationship
     * to the current object by way of the theme_activite cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Activite[] List of Activite objects
     */
    public function getActivites($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collActivites || null !== $criteria) {
            if ($this->isNew() && null === $this->collActivites) {
                // return empty collection
                $this->initActivites();
            } else {
                $collActivites = ActiviteQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collActivites;
                }
                $this->collActivites = $collActivites;
            }
        }

        return $this->collActivites;
    }

    /**
     * Sets a collection of Activite objects related by a many-to-many relationship
     * to the current object by way of the theme_activite cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $activites A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setActivites(PropelCollection $activites, PropelPDO $con = null)
    {
        $this->clearActivites();
        $currentActivites = $this->getActivites();

        $this->activitesScheduledForDeletion = $currentActivites->diff($activites);

        foreach ($activites as $activite) {
            if (!$currentActivites->contains($activite)) {
                $this->doAddActivite($activite);
            }
        }

        $this->collActivites = $activites;

        return $this;
    }

    /**
     * Gets the number of Activite objects related by a many-to-many relationship
     * to the current object by way of the theme_activite cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Activite objects
     */
    public function countActivites($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collActivites || null !== $criteria) {
            if ($this->isNew() && null === $this->collActivites) {
                return 0;
            } else {
                $query = ActiviteQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTheme($this)
                    ->count($con);
            }
        } else {
            return count($this->collActivites);
        }
    }

    /**
     * Associate a Activite object to this object
     * through the theme_activite cross reference table.
     *
     * @param  Activite $activite The ThemeActivite object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function addActivite(Activite $activite)
    {
        if ($this->collActivites === null) {
            $this->initActivites();
        }
        if (!$this->collActivites->contains($activite)) { // only add it if the **same** object is not already associated
            $this->doAddActivite($activite);

            $this->collActivites[]= $activite;
        }

        return $this;
    }

    /**
     * @param	Activite $activite The activite object to add.
     */
    protected function doAddActivite($activite)
    {
        $themeActivite = new ThemeActivite();
        $themeActivite->setActivite($activite);
        $this->addThemeActivite($themeActivite);
    }

    /**
     * Remove a Activite object to this object
     * through the theme_activite cross reference table.
     *
     * @param Activite $activite The ThemeActivite object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function removeActivite(Activite $activite)
    {
        if ($this->getActivites()->contains($activite)) {
            $this->collActivites->remove($this->collActivites->search($activite));
            if (null === $this->activitesScheduledForDeletion) {
                $this->activitesScheduledForDeletion = clone $this->collActivites;
                $this->activitesScheduledForDeletion->clear();
            }
            $this->activitesScheduledForDeletion[]= $activite;
        }

        return $this;
    }

    /**
     * Clears out the collBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addBaignades()
     */
    public function clearBaignades()
    {
        $this->collBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collBaignadesPartial = null;

        return $this;
    }

    /**
     * Initializes the collBaignades collection.
     *
     * By default this just sets the collBaignades collection to an empty collection (like clearBaignades());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBaignades()
    {
        $this->collBaignades = new PropelObjectCollection();
        $this->collBaignades->setModel('Baignade');
    }

    /**
     * Gets a collection of Baignade objects related by a many-to-many relationship
     * to the current object by way of the theme_baignade cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Baignade[] List of Baignade objects
     */
    public function getBaignades($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBaignades || null !== $criteria) {
            if ($this->isNew() && null === $this->collBaignades) {
                // return empty collection
                $this->initBaignades();
            } else {
                $collBaignades = BaignadeQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBaignades;
                }
                $this->collBaignades = $collBaignades;
            }
        }

        return $this->collBaignades;
    }

    /**
     * Sets a collection of Baignade objects related by a many-to-many relationship
     * to the current object by way of the theme_baignade cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $baignades A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setBaignades(PropelCollection $baignades, PropelPDO $con = null)
    {
        $this->clearBaignades();
        $currentBaignades = $this->getBaignades();

        $this->baignadesScheduledForDeletion = $currentBaignades->diff($baignades);

        foreach ($baignades as $baignade) {
            if (!$currentBaignades->contains($baignade)) {
                $this->doAddBaignade($baignade);
            }
        }

        $this->collBaignades = $baignades;

        return $this;
    }

    /**
     * Gets the number of Baignade objects related by a many-to-many relationship
     * to the current object by way of the theme_baignade cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Baignade objects
     */
    public function countBaignades($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBaignades || null !== $criteria) {
            if ($this->isNew() && null === $this->collBaignades) {
                return 0;
            } else {
                $query = BaignadeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTheme($this)
                    ->count($con);
            }
        } else {
            return count($this->collBaignades);
        }
    }

    /**
     * Associate a Baignade object to this object
     * through the theme_baignade cross reference table.
     *
     * @param  Baignade $baignade The ThemeBaignade object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function addBaignade(Baignade $baignade)
    {
        if ($this->collBaignades === null) {
            $this->initBaignades();
        }
        if (!$this->collBaignades->contains($baignade)) { // only add it if the **same** object is not already associated
            $this->doAddBaignade($baignade);

            $this->collBaignades[]= $baignade;
        }

        return $this;
    }

    /**
     * @param	Baignade $baignade The baignade object to add.
     */
    protected function doAddBaignade($baignade)
    {
        $themeBaignade = new ThemeBaignade();
        $themeBaignade->setBaignade($baignade);
        $this->addThemeBaignade($themeBaignade);
    }

    /**
     * Remove a Baignade object to this object
     * through the theme_baignade cross reference table.
     *
     * @param Baignade $baignade The ThemeBaignade object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function removeBaignade(Baignade $baignade)
    {
        if ($this->getBaignades()->contains($baignade)) {
            $this->collBaignades->remove($this->collBaignades->search($baignade));
            if (null === $this->baignadesScheduledForDeletion) {
                $this->baignadesScheduledForDeletion = clone $this->collBaignades;
                $this->baignadesScheduledForDeletion->clear();
            }
            $this->baignadesScheduledForDeletion[]= $baignade;
        }

        return $this;
    }

    /**
     * Clears out the collServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addServiceComplementaires()
     */
    public function clearServiceComplementaires()
    {
        $this->collServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collServiceComplementairesPartial = null;

        return $this;
    }

    /**
     * Initializes the collServiceComplementaires collection.
     *
     * By default this just sets the collServiceComplementaires collection to an empty collection (like clearServiceComplementaires());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initServiceComplementaires()
    {
        $this->collServiceComplementaires = new PropelObjectCollection();
        $this->collServiceComplementaires->setModel('ServiceComplementaire');
    }

    /**
     * Gets a collection of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the theme_service_complementaire cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|ServiceComplementaire[] List of ServiceComplementaire objects
     */
    public function getServiceComplementaires($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collServiceComplementaires || null !== $criteria) {
            if ($this->isNew() && null === $this->collServiceComplementaires) {
                // return empty collection
                $this->initServiceComplementaires();
            } else {
                $collServiceComplementaires = ServiceComplementaireQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collServiceComplementaires;
                }
                $this->collServiceComplementaires = $collServiceComplementaires;
            }
        }

        return $this->collServiceComplementaires;
    }

    /**
     * Sets a collection of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the theme_service_complementaire cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $serviceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setServiceComplementaires(PropelCollection $serviceComplementaires, PropelPDO $con = null)
    {
        $this->clearServiceComplementaires();
        $currentServiceComplementaires = $this->getServiceComplementaires();

        $this->serviceComplementairesScheduledForDeletion = $currentServiceComplementaires->diff($serviceComplementaires);

        foreach ($serviceComplementaires as $serviceComplementaire) {
            if (!$currentServiceComplementaires->contains($serviceComplementaire)) {
                $this->doAddServiceComplementaire($serviceComplementaire);
            }
        }

        $this->collServiceComplementaires = $serviceComplementaires;

        return $this;
    }

    /**
     * Gets the number of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the theme_service_complementaire cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related ServiceComplementaire objects
     */
    public function countServiceComplementaires($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collServiceComplementaires || null !== $criteria) {
            if ($this->isNew() && null === $this->collServiceComplementaires) {
                return 0;
            } else {
                $query = ServiceComplementaireQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTheme($this)
                    ->count($con);
            }
        } else {
            return count($this->collServiceComplementaires);
        }
    }

    /**
     * Associate a ServiceComplementaire object to this object
     * through the theme_service_complementaire cross reference table.
     *
     * @param  ServiceComplementaire $serviceComplementaire The ThemeServiceComplementaire object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function addServiceComplementaire(ServiceComplementaire $serviceComplementaire)
    {
        if ($this->collServiceComplementaires === null) {
            $this->initServiceComplementaires();
        }
        if (!$this->collServiceComplementaires->contains($serviceComplementaire)) { // only add it if the **same** object is not already associated
            $this->doAddServiceComplementaire($serviceComplementaire);

            $this->collServiceComplementaires[]= $serviceComplementaire;
        }

        return $this;
    }

    /**
     * @param	ServiceComplementaire $serviceComplementaire The serviceComplementaire object to add.
     */
    protected function doAddServiceComplementaire($serviceComplementaire)
    {
        $themeServiceComplementaire = new ThemeServiceComplementaire();
        $themeServiceComplementaire->setServiceComplementaire($serviceComplementaire);
        $this->addThemeServiceComplementaire($themeServiceComplementaire);
    }

    /**
     * Remove a ServiceComplementaire object to this object
     * through the theme_service_complementaire cross reference table.
     *
     * @param ServiceComplementaire $serviceComplementaire The ThemeServiceComplementaire object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function removeServiceComplementaire(ServiceComplementaire $serviceComplementaire)
    {
        if ($this->getServiceComplementaires()->contains($serviceComplementaire)) {
            $this->collServiceComplementaires->remove($this->collServiceComplementaires->search($serviceComplementaire));
            if (null === $this->serviceComplementairesScheduledForDeletion) {
                $this->serviceComplementairesScheduledForDeletion = clone $this->collServiceComplementaires;
                $this->serviceComplementairesScheduledForDeletion->clear();
            }
            $this->serviceComplementairesScheduledForDeletion[]= $serviceComplementaire;
        }

        return $this;
    }

    /**
     * Clears out the collPersonnages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Theme The current object (for fluent API support)
     * @see        addPersonnages()
     */
    public function clearPersonnages()
    {
        $this->collPersonnages = null; // important to set this to null since that means it is uninitialized
        $this->collPersonnagesPartial = null;

        return $this;
    }

    /**
     * Initializes the collPersonnages collection.
     *
     * By default this just sets the collPersonnages collection to an empty collection (like clearPersonnages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPersonnages()
    {
        $this->collPersonnages = new PropelObjectCollection();
        $this->collPersonnages->setModel('Personnage');
    }

    /**
     * Gets a collection of Personnage objects related by a many-to-many relationship
     * to the current object by way of the theme_personnage cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Theme is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Personnage[] List of Personnage objects
     */
    public function getPersonnages($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPersonnages || null !== $criteria) {
            if ($this->isNew() && null === $this->collPersonnages) {
                // return empty collection
                $this->initPersonnages();
            } else {
                $collPersonnages = PersonnageQuery::create(null, $criteria)
                    ->filterByTheme($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPersonnages;
                }
                $this->collPersonnages = $collPersonnages;
            }
        }

        return $this->collPersonnages;
    }

    /**
     * Sets a collection of Personnage objects related by a many-to-many relationship
     * to the current object by way of the theme_personnage cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $personnages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Theme The current object (for fluent API support)
     */
    public function setPersonnages(PropelCollection $personnages, PropelPDO $con = null)
    {
        $this->clearPersonnages();
        $currentPersonnages = $this->getPersonnages();

        $this->personnagesScheduledForDeletion = $currentPersonnages->diff($personnages);

        foreach ($personnages as $personnage) {
            if (!$currentPersonnages->contains($personnage)) {
                $this->doAddPersonnage($personnage);
            }
        }

        $this->collPersonnages = $personnages;

        return $this;
    }

    /**
     * Gets the number of Personnage objects related by a many-to-many relationship
     * to the current object by way of the theme_personnage cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Personnage objects
     */
    public function countPersonnages($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPersonnages || null !== $criteria) {
            if ($this->isNew() && null === $this->collPersonnages) {
                return 0;
            } else {
                $query = PersonnageQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTheme($this)
                    ->count($con);
            }
        } else {
            return count($this->collPersonnages);
        }
    }

    /**
     * Associate a Personnage object to this object
     * through the theme_personnage cross reference table.
     *
     * @param  Personnage $personnage The ThemePersonnage object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function addPersonnage(Personnage $personnage)
    {
        if ($this->collPersonnages === null) {
            $this->initPersonnages();
        }
        if (!$this->collPersonnages->contains($personnage)) { // only add it if the **same** object is not already associated
            $this->doAddPersonnage($personnage);

            $this->collPersonnages[]= $personnage;
        }

        return $this;
    }

    /**
     * @param	Personnage $personnage The personnage object to add.
     */
    protected function doAddPersonnage($personnage)
    {
        $themePersonnage = new ThemePersonnage();
        $themePersonnage->setPersonnage($personnage);
        $this->addThemePersonnage($themePersonnage);
    }

    /**
     * Remove a Personnage object to this object
     * through the theme_personnage cross reference table.
     *
     * @param Personnage $personnage The ThemePersonnage object to relate
     * @return Theme The current object (for fluent API support)
     */
    public function removePersonnage(Personnage $personnage)
    {
        if ($this->getPersonnages()->contains($personnage)) {
            $this->collPersonnages->remove($this->collPersonnages->search($personnage));
            if (null === $this->personnagesScheduledForDeletion) {
                $this->personnagesScheduledForDeletion = clone $this->collPersonnages;
                $this->personnagesScheduledForDeletion->clear();
            }
            $this->personnagesScheduledForDeletion[]= $personnage;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
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
            if ($this->collThemeActivites) {
                foreach ($this->collThemeActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemeBaignades) {
                foreach ($this->collThemeBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemeServiceComplementaires) {
                foreach ($this->collThemeServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemePersonnages) {
                foreach ($this->collThemePersonnages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThemeI18ns) {
                foreach ($this->collThemeI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collActivites) {
                foreach ($this->collActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBaignades) {
                foreach ($this->collBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collServiceComplementaires) {
                foreach ($this->collServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPersonnages) {
                foreach ($this->collPersonnages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collThemeActivites instanceof PropelCollection) {
            $this->collThemeActivites->clearIterator();
        }
        $this->collThemeActivites = null;
        if ($this->collThemeBaignades instanceof PropelCollection) {
            $this->collThemeBaignades->clearIterator();
        }
        $this->collThemeBaignades = null;
        if ($this->collThemeServiceComplementaires instanceof PropelCollection) {
            $this->collThemeServiceComplementaires->clearIterator();
        }
        $this->collThemeServiceComplementaires = null;
        if ($this->collThemePersonnages instanceof PropelCollection) {
            $this->collThemePersonnages->clearIterator();
        }
        $this->collThemePersonnages = null;
        if ($this->collThemeI18ns instanceof PropelCollection) {
            $this->collThemeI18ns->clearIterator();
        }
        $this->collThemeI18ns = null;
        if ($this->collActivites instanceof PropelCollection) {
            $this->collActivites->clearIterator();
        }
        $this->collActivites = null;
        if ($this->collBaignades instanceof PropelCollection) {
            $this->collBaignades->clearIterator();
        }
        $this->collBaignades = null;
        if ($this->collServiceComplementaires instanceof PropelCollection) {
            $this->collServiceComplementaires->clearIterator();
        }
        $this->collServiceComplementaires = null;
        if ($this->collPersonnages instanceof PropelCollection) {
            $this->collPersonnages->clearIterator();
        }
        $this->collPersonnages = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ThemePeer::DEFAULT_STRING_FORMAT);
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
    
    /**
     * return true is the object is active locale
     *
     * @return boolean
     */
    public function isActiveLocale()
    {
        return $this->getActiveLocale();
    }
    
    public function getActivitesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\ActivitePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ActivitePeer::ID, \Cungfoo\Model\ActiviteI18nPeer::alias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ActiviteI18nPeer::alias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ActiviteI18nPeer::alias('i18n_locale', \Cungfoo\Model\ActiviteI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getActivites($criteria, $con);
    }
    
    public function getBaignadesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\BaignadePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\BaignadePeer::ID, \Cungfoo\Model\BaignadeI18nPeer::alias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\BaignadeI18nPeer::alias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\BaignadeI18nPeer::alias('i18n_locale', \Cungfoo\Model\BaignadeI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getBaignades($criteria, $con);
    }
    
    public function getServiceComplementairesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\ServiceComplementairePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\ServiceComplementairePeer::ID, \Cungfoo\Model\ServiceComplementaireI18nPeer::alias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\ServiceComplementaireI18nPeer::alias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\ServiceComplementaireI18nPeer::alias('i18n_locale', \Cungfoo\Model\ServiceComplementaireI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getServiceComplementaires($criteria, $con);
    }
    
    public function getPersonnagesActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\PersonnagePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\PersonnagePeer::ID, \Cungfoo\Model\PersonnageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\PersonnageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\PersonnageI18nPeer::alias('i18n_locale', \Cungfoo\Model\PersonnageI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getPersonnages($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Theme The current object (for fluent API support)
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
     * @return ThemeI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collThemeI18ns) {
                foreach ($this->collThemeI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ThemeI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ThemeI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addThemeI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Theme The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            ThemeI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collThemeI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collThemeI18ns[$key]);
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
     * @return ThemeI18n */
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
         * @return ThemeI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [slug] column value.
         *
         * @return string
         */
        public function getSlug()
        {
        return $this->getCurrentTranslation()->getSlug();
    }


        /**
         * Set the value of [slug] column.
         *
         * @param string $v new value
         * @return ThemeI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

        return $this;
    }


        /**
         * Get the [introduction] column value.
         *
         * @return string
         */
        public function getIntroduction()
        {
        return $this->getCurrentTranslation()->getIntroduction();
    }


        /**
         * Set the value of [introduction] column.
         *
         * @param string $v new value
         * @return ThemeI18n The current object (for fluent API support)
         */
        public function setIntroduction($v)
        {    $this->getCurrentTranslation()->setIntroduction($v);

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
         * @return ThemeI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoTitle();
        }

        return '';
    }



        /**
         * Set the value of [seo_title] column.
         *
         * @param string $v new value
         * @return ThemeI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoDescription();
        }

        return '';
    }



        /**
         * Set the value of [seo_description] column.
         *
         * @param string $v new value
         * @return ThemeI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoH1();
        }

        return '';
    }



        /**
         * Set the value of [seo_h1] column.
         *
         * @param string $v new value
         * @return ThemeI18n The current object (for fluent API support)
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
            return $peerClassName::getSeo()->getSeoKeywords();
        }

        return '';
    }



        /**
         * Set the value of [seo_keywords] column.
         *
         * @param string $v new value
         * @return ThemeI18n The current object (for fluent API support)
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
         * @return ThemeI18n The current object (for fluent API support)
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
        if (!$form['image_path_deleted']->getData())
        {
            $this->resetModified(ThemePeer::IMAGE_PATH);
        }
    
        $this->uploadImagePath($form);
        
        return $this->save($con);
    }
    
    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/themes';
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
            if ($form['image_path']->getData()) {
                $image = uniqid().'.'.$form['image_path']->getData()->guessExtension();
                $form['image_path']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImagePath($this->getUploadDir() . '/' . $image);
            }
        }
    }

}
