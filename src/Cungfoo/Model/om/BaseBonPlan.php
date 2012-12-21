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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanCategorieQuery;
use Cungfoo\Model\BonPlanI18n;
use Cungfoo\Model\BonPlanI18nQuery;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\BonPlanQuery;

/**
 * Base class that represents a row from the 'bon_plan' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlan extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\BonPlanPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BonPlanPeer
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
     * The value for the bon_plan_categorie_id field.
     * @var        int
     */
    protected $bon_plan_categorie_id;

    /**
     * The value for the date_debut field.
     * @var        string
     */
    protected $date_debut;

    /**
     * The value for the date_fin field.
     * @var        string
     */
    protected $date_fin;

    /**
     * The value for the prix field.
     * @var        int
     */
    protected $prix;

    /**
     * The value for the prix_barre field.
     * @var        int
     */
    protected $prix_barre;

    /**
     * The value for the image_menu field.
     * @var        string
     */
    protected $image_menu;

    /**
     * The value for the image_page field.
     * @var        string
     */
    protected $image_page;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * @var        BonPlanCategorie
     */
    protected $aBonPlanCategorie;

    /**
     * @var        PropelObjectCollection|BonPlanI18n[] Collection to store aggregation of BonPlanI18n objects.
     */
    protected $collBonPlanI18ns;
    protected $collBonPlanI18nsPartial;

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
     * @var        array[BonPlanI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseBonPlan object.
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
     * Get the [bon_plan_categorie_id] column value.
     *
     * @return int
     */
    public function getBonPlanCategorieId()
    {
        return $this->bon_plan_categorie_id;
    }

    /**
     * Get the [optionally formatted] temporal [date_debut] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateDebut($format = null)
    {
        if ($this->date_debut === null) {
            return null;
        }

        if ($this->date_debut === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_debut);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_debut, true), $x);
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
     * Get the [optionally formatted] temporal [date_fin] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateFin($format = null)
    {
        if ($this->date_fin === null) {
            return null;
        }

        if ($this->date_fin === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_fin);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_fin, true), $x);
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
     * Get the [prix] column value.
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Get the [prix_barre] column value.
     *
     * @return int
     */
    public function getPrixBarre()
    {
        return $this->prix_barre;
    }

    /**
     * Get the [image_menu] column value.
     *
     * @return string
     */
    public function getImageMenu()
    {
        return $this->image_menu;
    }

    /**
     * Get the [image_page] column value.
     *
     * @return string
     */
    public function getImagePage()
    {
        return $this->image_page;
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
     * @return BonPlan The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BonPlanPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [bon_plan_categorie_id] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanCategorieId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bon_plan_categorie_id !== $v) {
            $this->bon_plan_categorie_id = $v;
            $this->modifiedColumns[] = BonPlanPeer::BON_PLAN_CATEGORIE_ID;
        }

        if ($this->aBonPlanCategorie !== null && $this->aBonPlanCategorie->getId() !== $v) {
            $this->aBonPlanCategorie = null;
        }


        return $this;
    } // setBonPlanCategorieId()

    /**
     * Sets the value of [date_debut] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BonPlan The current object (for fluent API support)
     */
    public function setDateDebut($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_debut !== null || $dt !== null) {
            $currentDateAsString = ($this->date_debut !== null && $tmpDt = new DateTime($this->date_debut)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_debut = $newDateAsString;
                $this->modifiedColumns[] = BonPlanPeer::DATE_DEBUT;
            }
        } // if either are not null


        return $this;
    } // setDateDebut()

    /**
     * Sets the value of [date_fin] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BonPlan The current object (for fluent API support)
     */
    public function setDateFin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_fin !== null || $dt !== null) {
            $currentDateAsString = ($this->date_fin !== null && $tmpDt = new DateTime($this->date_fin)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_fin = $newDateAsString;
                $this->modifiedColumns[] = BonPlanPeer::DATE_FIN;
            }
        } // if either are not null


        return $this;
    } // setDateFin()

    /**
     * Set the value of [prix] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setPrix($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prix !== $v) {
            $this->prix = $v;
            $this->modifiedColumns[] = BonPlanPeer::PRIX;
        }


        return $this;
    } // setPrix()

    /**
     * Set the value of [prix_barre] column.
     *
     * @param int $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setPrixBarre($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prix_barre !== $v) {
            $this->prix_barre = $v;
            $this->modifiedColumns[] = BonPlanPeer::PRIX_BARRE;
        }


        return $this;
    } // setPrixBarre()

    /**
     * Set the value of [image_menu] column.
     *
     * @param string $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setImageMenu($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_menu !== $v) {
            $this->image_menu = $v;
            $this->modifiedColumns[] = BonPlanPeer::IMAGE_MENU;
        }


        return $this;
    } // setImageMenu()

    /**
     * Set the value of [image_page] column.
     *
     * @param string $v new value
     * @return BonPlan The current object (for fluent API support)
     */
    public function setImagePage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_page !== $v) {
            $this->image_page = $v;
            $this->modifiedColumns[] = BonPlanPeer::IMAGE_PAGE;
        }


        return $this;
    } // setImagePage()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return BonPlan The current object (for fluent API support)
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
            $this->modifiedColumns[] = BonPlanPeer::ACTIVE;
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
            $this->bon_plan_categorie_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->date_debut = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->date_fin = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->prix = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->prix_barre = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->image_menu = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->image_page = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->active = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 9; // 9 = BonPlanPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BonPlan object", $e);
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

        if ($this->aBonPlanCategorie !== null && $this->bon_plan_categorie_id !== $this->aBonPlanCategorie->getId()) {
            $this->aBonPlanCategorie = null;
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BonPlanPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBonPlanCategorie = null;
            $this->collBonPlanI18ns = null;

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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BonPlanQuery::create()
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                BonPlanPeer::addInstanceToPool($this);
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

            if ($this->aBonPlanCategorie !== null) {
                if ($this->aBonPlanCategorie->isModified() || $this->aBonPlanCategorie->isNew()) {
                    $affectedRows += $this->aBonPlanCategorie->save($con);
                }
                $this->setBonPlanCategorie($this->aBonPlanCategorie);
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

            if ($this->bonPlanI18nsScheduledForDeletion !== null) {
                if (!$this->bonPlanI18nsScheduledForDeletion->isEmpty()) {
                    BonPlanI18nQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanI18ns !== null) {
                foreach ($this->collBonPlanI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = BonPlanPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BonPlanPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BonPlanPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(BonPlanPeer::BON_PLAN_CATEGORIE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bon_plan_categorie_id`';
        }
        if ($this->isColumnModified(BonPlanPeer::DATE_DEBUT)) {
            $modifiedColumns[':p' . $index++]  = '`date_debut`';
        }
        if ($this->isColumnModified(BonPlanPeer::DATE_FIN)) {
            $modifiedColumns[':p' . $index++]  = '`date_fin`';
        }
        if ($this->isColumnModified(BonPlanPeer::PRIX)) {
            $modifiedColumns[':p' . $index++]  = '`prix`';
        }
        if ($this->isColumnModified(BonPlanPeer::PRIX_BARRE)) {
            $modifiedColumns[':p' . $index++]  = '`prix_barre`';
        }
        if ($this->isColumnModified(BonPlanPeer::IMAGE_MENU)) {
            $modifiedColumns[':p' . $index++]  = '`image_menu`';
        }
        if ($this->isColumnModified(BonPlanPeer::IMAGE_PAGE)) {
            $modifiedColumns[':p' . $index++]  = '`image_page`';
        }
        if ($this->isColumnModified(BonPlanPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `bon_plan` (%s) VALUES (%s)',
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
                    case '`bon_plan_categorie_id`':
                        $stmt->bindValue($identifier, $this->bon_plan_categorie_id, PDO::PARAM_INT);
                        break;
                    case '`date_debut`':
                        $stmt->bindValue($identifier, $this->date_debut, PDO::PARAM_STR);
                        break;
                    case '`date_fin`':
                        $stmt->bindValue($identifier, $this->date_fin, PDO::PARAM_STR);
                        break;
                    case '`prix`':
                        $stmt->bindValue($identifier, $this->prix, PDO::PARAM_INT);
                        break;
                    case '`prix_barre`':
                        $stmt->bindValue($identifier, $this->prix_barre, PDO::PARAM_INT);
                        break;
                    case '`image_menu`':
                        $stmt->bindValue($identifier, $this->image_menu, PDO::PARAM_STR);
                        break;
                    case '`image_page`':
                        $stmt->bindValue($identifier, $this->image_page, PDO::PARAM_STR);
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

            if ($this->aBonPlanCategorie !== null) {
                if (!$this->aBonPlanCategorie->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBonPlanCategorie->getValidationFailures());
                }
            }


            if (($retval = BonPlanPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBonPlanI18ns !== null) {
                    foreach ($this->collBonPlanI18ns as $referrerFK) {
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
        $pos = BonPlanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getBonPlanCategorieId();
                break;
            case 2:
                return $this->getDateDebut();
                break;
            case 3:
                return $this->getDateFin();
                break;
            case 4:
                return $this->getPrix();
                break;
            case 5:
                return $this->getPrixBarre();
                break;
            case 6:
                return $this->getImageMenu();
                break;
            case 7:
                return $this->getImagePage();
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
        if (isset($alreadyDumpedObjects['BonPlan'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BonPlan'][$this->getPrimaryKey()] = true;
        $keys = BonPlanPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBonPlanCategorieId(),
            $keys[2] => $this->getDateDebut(),
            $keys[3] => $this->getDateFin(),
            $keys[4] => $this->getPrix(),
            $keys[5] => $this->getPrixBarre(),
            $keys[6] => $this->getImageMenu(),
            $keys[7] => $this->getImagePage(),
            $keys[8] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aBonPlanCategorie) {
                $result['BonPlanCategorie'] = $this->aBonPlanCategorie->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBonPlanI18ns) {
                $result['BonPlanI18ns'] = $this->collBonPlanI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BonPlanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setBonPlanCategorieId($value);
                break;
            case 2:
                $this->setDateDebut($value);
                break;
            case 3:
                $this->setDateFin($value);
                break;
            case 4:
                $this->setPrix($value);
                break;
            case 5:
                $this->setPrixBarre($value);
                break;
            case 6:
                $this->setImageMenu($value);
                break;
            case 7:
                $this->setImagePage($value);
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
        $keys = BonPlanPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setBonPlanCategorieId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDateDebut($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDateFin($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPrix($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPrixBarre($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setImageMenu($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setImagePage($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setActive($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);

        if ($this->isColumnModified(BonPlanPeer::ID)) $criteria->add(BonPlanPeer::ID, $this->id);
        if ($this->isColumnModified(BonPlanPeer::BON_PLAN_CATEGORIE_ID)) $criteria->add(BonPlanPeer::BON_PLAN_CATEGORIE_ID, $this->bon_plan_categorie_id);
        if ($this->isColumnModified(BonPlanPeer::DATE_DEBUT)) $criteria->add(BonPlanPeer::DATE_DEBUT, $this->date_debut);
        if ($this->isColumnModified(BonPlanPeer::DATE_FIN)) $criteria->add(BonPlanPeer::DATE_FIN, $this->date_fin);
        if ($this->isColumnModified(BonPlanPeer::PRIX)) $criteria->add(BonPlanPeer::PRIX, $this->prix);
        if ($this->isColumnModified(BonPlanPeer::PRIX_BARRE)) $criteria->add(BonPlanPeer::PRIX_BARRE, $this->prix_barre);
        if ($this->isColumnModified(BonPlanPeer::IMAGE_MENU)) $criteria->add(BonPlanPeer::IMAGE_MENU, $this->image_menu);
        if ($this->isColumnModified(BonPlanPeer::IMAGE_PAGE)) $criteria->add(BonPlanPeer::IMAGE_PAGE, $this->image_page);
        if ($this->isColumnModified(BonPlanPeer::ACTIVE)) $criteria->add(BonPlanPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);
        $criteria->add(BonPlanPeer::ID, $this->id);

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
     * @param object $copyObj An object of BonPlan (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBonPlanCategorieId($this->getBonPlanCategorieId());
        $copyObj->setDateDebut($this->getDateDebut());
        $copyObj->setDateFin($this->getDateFin());
        $copyObj->setPrix($this->getPrix());
        $copyObj->setPrixBarre($this->getPrixBarre());
        $copyObj->setImageMenu($this->getImageMenu());
        $copyObj->setImagePage($this->getImagePage());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBonPlanI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanI18n($relObj->copy($deepCopy));
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
     * @return BonPlan Clone of current object.
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
     * @return BonPlanPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BonPlanPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a BonPlanCategorie object.
     *
     * @param             BonPlanCategorie $v
     * @return BonPlan The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBonPlanCategorie(BonPlanCategorie $v = null)
    {
        if ($v === null) {
            $this->setBonPlanCategorieId(NULL);
        } else {
            $this->setBonPlanCategorieId($v->getId());
        }

        $this->aBonPlanCategorie = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BonPlanCategorie object, it will not be re-added.
        if ($v !== null) {
            $v->addBonPlan($this);
        }


        return $this;
    }


    /**
     * Get the associated BonPlanCategorie object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return BonPlanCategorie The associated BonPlanCategorie object.
     * @throws PropelException
     */
    public function getBonPlanCategorie(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBonPlanCategorie === null && ($this->bon_plan_categorie_id !== null) && $doQuery) {
            $this->aBonPlanCategorie = BonPlanCategorieQuery::create()->findPk($this->bon_plan_categorie_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBonPlanCategorie->addBonPlans($this);
             */
        }

        return $this->aBonPlanCategorie;
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
        if ('BonPlanI18n' == $relationName) {
            $this->initBonPlanI18ns();
        }
    }

    /**
     * Clears out the collBonPlanI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BonPlan The current object (for fluent API support)
     * @see        addBonPlanI18ns()
     */
    public function clearBonPlanI18ns()
    {
        $this->collBonPlanI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanI18ns($v = true)
    {
        $this->collBonPlanI18nsPartial = $v;
    }

    /**
     * Initializes the collBonPlanI18ns collection.
     *
     * By default this just sets the collBonPlanI18ns collection to an empty array (like clearcollBonPlanI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanI18ns($overrideExisting = true)
    {
        if (null !== $this->collBonPlanI18ns && !$overrideExisting) {
            return;
        }
        $this->collBonPlanI18ns = new PropelObjectCollection();
        $this->collBonPlanI18ns->setModel('BonPlanI18n');
    }

    /**
     * Gets an array of BonPlanI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BonPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanI18n[] List of BonPlanI18n objects
     * @throws PropelException
     */
    public function getBonPlanI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanI18nsPartial && !$this->isNew();
        if (null === $this->collBonPlanI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanI18ns) {
                // return empty collection
                $this->initBonPlanI18ns();
            } else {
                $collBonPlanI18ns = BonPlanI18nQuery::create(null, $criteria)
                    ->filterByBonPlan($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanI18nsPartial && count($collBonPlanI18ns)) {
                      $this->initBonPlanI18ns(false);

                      foreach($collBonPlanI18ns as $obj) {
                        if (false == $this->collBonPlanI18ns->contains($obj)) {
                          $this->collBonPlanI18ns->append($obj);
                        }
                      }

                      $this->collBonPlanI18nsPartial = true;
                    }

                    return $collBonPlanI18ns;
                }

                if($partial && $this->collBonPlanI18ns) {
                    foreach($this->collBonPlanI18ns as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanI18ns[] = $obj;
                        }
                    }
                }

                $this->collBonPlanI18ns = $collBonPlanI18ns;
                $this->collBonPlanI18nsPartial = false;
            }
        }

        return $this->collBonPlanI18ns;
    }

    /**
     * Sets a collection of BonPlanI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BonPlan The current object (for fluent API support)
     */
    public function setBonPlanI18ns(PropelCollection $bonPlanI18ns, PropelPDO $con = null)
    {
        $this->bonPlanI18nsScheduledForDeletion = $this->getBonPlanI18ns(new Criteria(), $con)->diff($bonPlanI18ns);

        foreach ($this->bonPlanI18nsScheduledForDeletion as $bonPlanI18nRemoved) {
            $bonPlanI18nRemoved->setBonPlan(null);
        }

        $this->collBonPlanI18ns = null;
        foreach ($bonPlanI18ns as $bonPlanI18n) {
            $this->addBonPlanI18n($bonPlanI18n);
        }

        $this->collBonPlanI18ns = $bonPlanI18ns;
        $this->collBonPlanI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanI18n objects.
     * @throws PropelException
     */
    public function countBonPlanI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanI18nsPartial && !$this->isNew();
        if (null === $this->collBonPlanI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanI18ns());
            }
            $query = BonPlanI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBonPlan($this)
                ->count($con);
        }

        return count($this->collBonPlanI18ns);
    }

    /**
     * Method called to associate a BonPlanI18n object to this object
     * through the BonPlanI18n foreign key attribute.
     *
     * @param    BonPlanI18n $l BonPlanI18n
     * @return BonPlan The current object (for fluent API support)
     */
    public function addBonPlanI18n(BonPlanI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collBonPlanI18ns === null) {
            $this->initBonPlanI18ns();
            $this->collBonPlanI18nsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanI18n($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanI18n $bonPlanI18n The bonPlanI18n object to add.
     */
    protected function doAddBonPlanI18n($bonPlanI18n)
    {
        $this->collBonPlanI18ns[]= $bonPlanI18n;
        $bonPlanI18n->setBonPlan($this);
    }

    /**
     * @param	BonPlanI18n $bonPlanI18n The bonPlanI18n object to remove.
     * @return BonPlan The current object (for fluent API support)
     */
    public function removeBonPlanI18n($bonPlanI18n)
    {
        if ($this->getBonPlanI18ns()->contains($bonPlanI18n)) {
            $this->collBonPlanI18ns->remove($this->collBonPlanI18ns->search($bonPlanI18n));
            if (null === $this->bonPlanI18nsScheduledForDeletion) {
                $this->bonPlanI18nsScheduledForDeletion = clone $this->collBonPlanI18ns;
                $this->bonPlanI18nsScheduledForDeletion->clear();
            }
            $this->bonPlanI18nsScheduledForDeletion[]= $bonPlanI18n;
            $bonPlanI18n->setBonPlan(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->bon_plan_categorie_id = null;
        $this->date_debut = null;
        $this->date_fin = null;
        $this->prix = null;
        $this->prix_barre = null;
        $this->image_menu = null;
        $this->image_page = null;
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
            if ($this->collBonPlanI18ns) {
                foreach ($this->collBonPlanI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collBonPlanI18ns instanceof PropelCollection) {
            $this->collBonPlanI18ns->clearIterator();
        }
        $this->collBonPlanI18ns = null;
        $this->aBonPlanCategorie = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BonPlanPeer::DEFAULT_STRING_FORMAT);
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

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    BonPlan The current object (for fluent API support)
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
     * @return BonPlanI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collBonPlanI18ns) {
                foreach ($this->collBonPlanI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new BonPlanI18n();
                $translation->setLocale($locale);
            } else {
                $translation = BonPlanI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addBonPlanI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    BonPlan The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            BonPlanI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collBonPlanI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collBonPlanI18ns[$key]);
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
     * @return BonPlanI18n */
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
         * @return BonPlanI18n The current object (for fluent API support)
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
         * @return BonPlanI18n The current object (for fluent API support)
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
         * @return BonPlanI18n The current object (for fluent API support)
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
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }


        /**
         * Get the [indice] column value.
         *
         * @return string
         */
        public function getIndice()
        {
        return $this->getCurrentTranslation()->getIndice();
    }


        /**
         * Set the value of [indice] column.
         *
         * @param string $v new value
         * @return BonPlanI18n The current object (for fluent API support)
         */
        public function setIndice($v)
        {    $this->getCurrentTranslation()->setIndice($v);

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
        if (!$form['image_menu_deleted']->getData())
        {
            $this->resetModified(BonPlanPeer::IMAGE_MENU);
        }

        $this->uploadImageMenu($form);

        if (!$form['image_page_deleted']->getData())
        {
            $this->resetModified(BonPlanPeer::IMAGE_PAGE);
        }

        $this->uploadImagePage($form);

        return $this->save($con);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/bon_plans';
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
    public function uploadImageMenu(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_menu']->getData()))
        {
            $image = uniqid().'.'.$form['image_menu']->getData()->guessExtension();
            $form['image_menu']->getData()->move($this->getUploadRootDir(), $image);
            $this->setImageMenu($this->getUploadDir() . '/' . $image);
        }
    }

    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImagePage(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_page']->getData()))
        {
            $image = uniqid().'.'.$form['image_page']->getData()->guessExtension();
            $form['image_page']->getData()->move($this->getUploadRootDir(), $image);
            $this->setImagePage($this->getUploadDir() . '/' . $image);
        }
    }

}
