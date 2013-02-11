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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanQuery;
use Cungfoo\Model\BonPlanRegion;
use Cungfoo\Model\BonPlanRegionQuery;
use Cungfoo\Model\Destination;
use Cungfoo\Model\DestinationQuery;
use Cungfoo\Model\Pays;
use Cungfoo\Model\PaysQuery;
use Cungfoo\Model\Region;
use Cungfoo\Model\RegionI18n;
use Cungfoo\Model\RegionI18nQuery;
use Cungfoo\Model\RegionPeer;
use Cungfoo\Model\RegionQuery;
use Cungfoo\Model\Ville;
use Cungfoo\Model\VilleQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'region' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseRegion extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\RegionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        RegionPeer
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
     * The value for the image_path field.
     * @var        string
     */
    protected $image_path;

    /**
     * The value for the image_encart_path field.
     * @var        string
     */
    protected $image_encart_path;

    /**
     * The value for the image_encart_petite_path field.
     * @var        string
     */
    protected $image_encart_petite_path;

    /**
     * The value for the pays_id field.
     * @var        int
     */
    protected $pays_id;

    /**
     * The value for the destination_id field.
     * @var        int
     */
    protected $destination_id;

    /**
     * The value for the mea_home field.
     * @var        boolean
     */
    protected $mea_home;

    /**
     * The value for the image_detail_1 field.
     * @var        string
     */
    protected $image_detail_1;

    /**
     * The value for the image_detail_2 field.
     * @var        string
     */
    protected $image_detail_2;

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
     * @var        Pays
     */
    protected $aPays;

    /**
     * @var        Destination
     */
    protected $aDestination;

    /**
     * @var        PropelObjectCollection|Ville[] Collection to store aggregation of Ville objects.
     */
    protected $collVilles;
    protected $collVillesPartial;

    /**
     * @var        PropelObjectCollection|BonPlanRegion[] Collection to store aggregation of BonPlanRegion objects.
     */
    protected $collBonPlanRegions;
    protected $collBonPlanRegionsPartial;

    /**
     * @var        PropelObjectCollection|RegionI18n[] Collection to store aggregation of RegionI18n objects.
     */
    protected $collRegionI18ns;
    protected $collRegionI18nsPartial;

    /**
     * @var        PropelObjectCollection|BonPlan[] Collection to store aggregation of BonPlan objects.
     */
    protected $collBonPlans;

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
     * @var        array[RegionI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $villesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonPlanRegionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $regionI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseRegion object.
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
     * Get the [image_path] column value.
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * Get the [image_encart_path] column value.
     *
     * @return string
     */
    public function getImageEncartPath()
    {
        return $this->image_encart_path;
    }

    /**
     * Get the [image_encart_petite_path] column value.
     *
     * @return string
     */
    public function getImageEncartPetitePath()
    {
        return $this->image_encart_petite_path;
    }

    /**
     * Get the [pays_id] column value.
     *
     * @return int
     */
    public function getPaysId()
    {
        return $this->pays_id;
    }

    /**
     * Get the [destination_id] column value.
     *
     * @return int
     */
    public function getDestinationId()
    {
        return $this->destination_id;
    }

    /**
     * Get the [mea_home] column value.
     *
     * @return boolean
     */
    public function getMeaHome()
    {
        return $this->mea_home;
    }

    /**
     * Get the [image_detail_1] column value.
     *
     * @return string
     */
    public function getImageDetail1()
    {
        return $this->image_detail_1;
    }

    /**
     * Get the [image_detail_2] column value.
     *
     * @return string
     */
    public function getImageDetail2()
    {
        return $this->image_detail_2;
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
     * @return Region The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = RegionPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = RegionPeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [image_path] column.
     *
     * @param string $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setImagePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_path !== $v) {
            $this->image_path = $v;
            $this->modifiedColumns[] = RegionPeer::IMAGE_PATH;
        }


        return $this;
    } // setImagePath()

    /**
     * Set the value of [image_encart_path] column.
     *
     * @param string $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setImageEncartPath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_encart_path !== $v) {
            $this->image_encart_path = $v;
            $this->modifiedColumns[] = RegionPeer::IMAGE_ENCART_PATH;
        }


        return $this;
    } // setImageEncartPath()

    /**
     * Set the value of [image_encart_petite_path] column.
     *
     * @param string $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setImageEncartPetitePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_encart_petite_path !== $v) {
            $this->image_encart_petite_path = $v;
            $this->modifiedColumns[] = RegionPeer::IMAGE_ENCART_PETITE_PATH;
        }


        return $this;
    } // setImageEncartPetitePath()

    /**
     * Set the value of [pays_id] column.
     *
     * @param int $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setPaysId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pays_id !== $v) {
            $this->pays_id = $v;
            $this->modifiedColumns[] = RegionPeer::PAYS_ID;
        }

        if ($this->aPays !== null && $this->aPays->getId() !== $v) {
            $this->aPays = null;
        }


        return $this;
    } // setPaysId()

    /**
     * Set the value of [destination_id] column.
     *
     * @param int $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setDestinationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->destination_id !== $v) {
            $this->destination_id = $v;
            $this->modifiedColumns[] = RegionPeer::DESTINATION_ID;
        }

        if ($this->aDestination !== null && $this->aDestination->getId() !== $v) {
            $this->aDestination = null;
        }


        return $this;
    } // setDestinationId()

    /**
     * Sets the value of the [mea_home] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Region The current object (for fluent API support)
     */
    public function setMeaHome($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->mea_home !== $v) {
            $this->mea_home = $v;
            $this->modifiedColumns[] = RegionPeer::MEA_HOME;
        }


        return $this;
    } // setMeaHome()

    /**
     * Set the value of [image_detail_1] column.
     *
     * @param string $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setImageDetail1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_detail_1 !== $v) {
            $this->image_detail_1 = $v;
            $this->modifiedColumns[] = RegionPeer::IMAGE_DETAIL_1;
        }


        return $this;
    } // setImageDetail1()

    /**
     * Set the value of [image_detail_2] column.
     *
     * @param string $v new value
     * @return Region The current object (for fluent API support)
     */
    public function setImageDetail2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image_detail_2 !== $v) {
            $this->image_detail_2 = $v;
            $this->modifiedColumns[] = RegionPeer::IMAGE_DETAIL_2;
        }


        return $this;
    } // setImageDetail2()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Region The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = RegionPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Region The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = RegionPeer::UPDATED_AT;
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
     * @return Region The current object (for fluent API support)
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
            $this->modifiedColumns[] = RegionPeer::ACTIVE;
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
            $this->image_path = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->image_encart_path = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->image_encart_petite_path = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->pays_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->destination_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->mea_home = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
            $this->image_detail_1 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->image_detail_2 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->active = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 13; // 13 = RegionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Region object", $e);
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

        if ($this->aPays !== null && $this->pays_id !== $this->aPays->getId()) {
            $this->aPays = null;
        }
        if ($this->aDestination !== null && $this->destination_id !== $this->aDestination->getId()) {
            $this->aDestination = null;
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
            $con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = RegionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPays = null;
            $this->aDestination = null;
            $this->collVilles = null;

            $this->collBonPlanRegions = null;

            $this->collRegionI18ns = null;

            $this->collBonPlans = null;
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
            $con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = RegionQuery::create()
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
            $con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(RegionPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(RegionPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(RegionPeer::UPDATED_AT)) {
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
                RegionPeer::addInstanceToPool($this);
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

            if ($this->aPays !== null) {
                if ($this->aPays->isModified() || $this->aPays->isNew()) {
                    $affectedRows += $this->aPays->save($con);
                }
                $this->setPays($this->aPays);
            }

            if ($this->aDestination !== null) {
                if ($this->aDestination->isModified() || $this->aDestination->isNew()) {
                    $affectedRows += $this->aDestination->save($con);
                }
                $this->setDestination($this->aDestination);
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

            if ($this->bonPlansScheduledForDeletion !== null) {
                if (!$this->bonPlansScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->bonPlansScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    BonPlanRegionQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->bonPlansScheduledForDeletion = null;
                }

                foreach ($this->getBonPlans() as $bonPlan) {
                    if ($bonPlan->isModified()) {
                        $bonPlan->save($con);
                    }
                }
            }

            if ($this->villesScheduledForDeletion !== null) {
                if (!$this->villesScheduledForDeletion->isEmpty()) {
                    foreach ($this->villesScheduledForDeletion as $ville) {
                        // need to save related object because we set the relation to null
                        $ville->save($con);
                    }
                    $this->villesScheduledForDeletion = null;
                }
            }

            if ($this->collVilles !== null) {
                foreach ($this->collVilles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bonPlanRegionsScheduledForDeletion !== null) {
                if (!$this->bonPlanRegionsScheduledForDeletion->isEmpty()) {
                    BonPlanRegionQuery::create()
                        ->filterByPrimaryKeys($this->bonPlanRegionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bonPlanRegionsScheduledForDeletion = null;
                }
            }

            if ($this->collBonPlanRegions !== null) {
                foreach ($this->collBonPlanRegions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->regionI18nsScheduledForDeletion !== null) {
                if (!$this->regionI18nsScheduledForDeletion->isEmpty()) {
                    RegionI18nQuery::create()
                        ->filterByPrimaryKeys($this->regionI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->regionI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collRegionI18ns !== null) {
                foreach ($this->collRegionI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = RegionPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RegionPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RegionPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(RegionPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }
        if ($this->isColumnModified(RegionPeer::IMAGE_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_path`';
        }
        if ($this->isColumnModified(RegionPeer::IMAGE_ENCART_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_encart_path`';
        }
        if ($this->isColumnModified(RegionPeer::IMAGE_ENCART_PETITE_PATH)) {
            $modifiedColumns[':p' . $index++]  = '`image_encart_petite_path`';
        }
        if ($this->isColumnModified(RegionPeer::PAYS_ID)) {
            $modifiedColumns[':p' . $index++]  = '`pays_id`';
        }
        if ($this->isColumnModified(RegionPeer::DESTINATION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`destination_id`';
        }
        if ($this->isColumnModified(RegionPeer::MEA_HOME)) {
            $modifiedColumns[':p' . $index++]  = '`mea_home`';
        }
        if ($this->isColumnModified(RegionPeer::IMAGE_DETAIL_1)) {
            $modifiedColumns[':p' . $index++]  = '`image_detail_1`';
        }
        if ($this->isColumnModified(RegionPeer::IMAGE_DETAIL_2)) {
            $modifiedColumns[':p' . $index++]  = '`image_detail_2`';
        }
        if ($this->isColumnModified(RegionPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(RegionPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(RegionPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `region` (%s) VALUES (%s)',
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
                    case '`image_path`':
                        $stmt->bindValue($identifier, $this->image_path, PDO::PARAM_STR);
                        break;
                    case '`image_encart_path`':
                        $stmt->bindValue($identifier, $this->image_encart_path, PDO::PARAM_STR);
                        break;
                    case '`image_encart_petite_path`':
                        $stmt->bindValue($identifier, $this->image_encart_petite_path, PDO::PARAM_STR);
                        break;
                    case '`pays_id`':
                        $stmt->bindValue($identifier, $this->pays_id, PDO::PARAM_INT);
                        break;
                    case '`destination_id`':
                        $stmt->bindValue($identifier, $this->destination_id, PDO::PARAM_INT);
                        break;
                    case '`mea_home`':
                        $stmt->bindValue($identifier, (int) $this->mea_home, PDO::PARAM_INT);
                        break;
                    case '`image_detail_1`':
                        $stmt->bindValue($identifier, $this->image_detail_1, PDO::PARAM_STR);
                        break;
                    case '`image_detail_2`':
                        $stmt->bindValue($identifier, $this->image_detail_2, PDO::PARAM_STR);
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

            if ($this->aPays !== null) {
                if (!$this->aPays->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPays->getValidationFailures());
                }
            }

            if ($this->aDestination !== null) {
                if (!$this->aDestination->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aDestination->getValidationFailures());
                }
            }


            if (($retval = RegionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collVilles !== null) {
                    foreach ($this->collVilles as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBonPlanRegions !== null) {
                    foreach ($this->collBonPlanRegions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRegionI18ns !== null) {
                    foreach ($this->collRegionI18ns as $referrerFK) {
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
        $pos = RegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getImagePath();
                break;
            case 3:
                return $this->getImageEncartPath();
                break;
            case 4:
                return $this->getImageEncartPetitePath();
                break;
            case 5:
                return $this->getPaysId();
                break;
            case 6:
                return $this->getDestinationId();
                break;
            case 7:
                return $this->getMeaHome();
                break;
            case 8:
                return $this->getImageDetail1();
                break;
            case 9:
                return $this->getImageDetail2();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
                return $this->getUpdatedAt();
                break;
            case 12:
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
        if (isset($alreadyDumpedObjects['Region'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Region'][$this->getPrimaryKey()] = true;
        $keys = RegionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getImagePath(),
            $keys[3] => $this->getImageEncartPath(),
            $keys[4] => $this->getImageEncartPetitePath(),
            $keys[5] => $this->getPaysId(),
            $keys[6] => $this->getDestinationId(),
            $keys[7] => $this->getMeaHome(),
            $keys[8] => $this->getImageDetail1(),
            $keys[9] => $this->getImageDetail2(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aPays) {
                $result['Pays'] = $this->aPays->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aDestination) {
                $result['Destination'] = $this->aDestination->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collVilles) {
                $result['Villes'] = $this->collVilles->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBonPlanRegions) {
                $result['BonPlanRegions'] = $this->collBonPlanRegions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRegionI18ns) {
                $result['RegionI18ns'] = $this->collRegionI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = RegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setImagePath($value);
                break;
            case 3:
                $this->setImageEncartPath($value);
                break;
            case 4:
                $this->setImageEncartPetitePath($value);
                break;
            case 5:
                $this->setPaysId($value);
                break;
            case 6:
                $this->setDestinationId($value);
                break;
            case 7:
                $this->setMeaHome($value);
                break;
            case 8:
                $this->setImageDetail1($value);
                break;
            case 9:
                $this->setImageDetail2($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
                break;
            case 12:
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
        $keys = RegionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setImagePath($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setImageEncartPath($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setImageEncartPetitePath($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPaysId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setDestinationId($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setMeaHome($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setImageDetail1($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setImageDetail2($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setActive($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RegionPeer::DATABASE_NAME);

        if ($this->isColumnModified(RegionPeer::ID)) $criteria->add(RegionPeer::ID, $this->id);
        if ($this->isColumnModified(RegionPeer::CODE)) $criteria->add(RegionPeer::CODE, $this->code);
        if ($this->isColumnModified(RegionPeer::IMAGE_PATH)) $criteria->add(RegionPeer::IMAGE_PATH, $this->image_path);
        if ($this->isColumnModified(RegionPeer::IMAGE_ENCART_PATH)) $criteria->add(RegionPeer::IMAGE_ENCART_PATH, $this->image_encart_path);
        if ($this->isColumnModified(RegionPeer::IMAGE_ENCART_PETITE_PATH)) $criteria->add(RegionPeer::IMAGE_ENCART_PETITE_PATH, $this->image_encart_petite_path);
        if ($this->isColumnModified(RegionPeer::PAYS_ID)) $criteria->add(RegionPeer::PAYS_ID, $this->pays_id);
        if ($this->isColumnModified(RegionPeer::DESTINATION_ID)) $criteria->add(RegionPeer::DESTINATION_ID, $this->destination_id);
        if ($this->isColumnModified(RegionPeer::MEA_HOME)) $criteria->add(RegionPeer::MEA_HOME, $this->mea_home);
        if ($this->isColumnModified(RegionPeer::IMAGE_DETAIL_1)) $criteria->add(RegionPeer::IMAGE_DETAIL_1, $this->image_detail_1);
        if ($this->isColumnModified(RegionPeer::IMAGE_DETAIL_2)) $criteria->add(RegionPeer::IMAGE_DETAIL_2, $this->image_detail_2);
        if ($this->isColumnModified(RegionPeer::CREATED_AT)) $criteria->add(RegionPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(RegionPeer::UPDATED_AT)) $criteria->add(RegionPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(RegionPeer::ACTIVE)) $criteria->add(RegionPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(RegionPeer::DATABASE_NAME);
        $criteria->add(RegionPeer::ID, $this->id);

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
     * @param object $copyObj An object of Region (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setImagePath($this->getImagePath());
        $copyObj->setImageEncartPath($this->getImageEncartPath());
        $copyObj->setImageEncartPetitePath($this->getImageEncartPetitePath());
        $copyObj->setPaysId($this->getPaysId());
        $copyObj->setDestinationId($this->getDestinationId());
        $copyObj->setMeaHome($this->getMeaHome());
        $copyObj->setImageDetail1($this->getImageDetail1());
        $copyObj->setImageDetail2($this->getImageDetail2());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getVilles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVille($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBonPlanRegions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBonPlanRegion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRegionI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRegionI18n($relObj->copy($deepCopy));
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
     * @return Region Clone of current object.
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
     * @return RegionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new RegionPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Pays object.
     *
     * @param             Pays $v
     * @return Region The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPays(Pays $v = null)
    {
        if ($v === null) {
            $this->setPaysId(NULL);
        } else {
            $this->setPaysId($v->getId());
        }

        $this->aPays = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Pays object, it will not be re-added.
        if ($v !== null) {
            $v->addRegion($this);
        }


        return $this;
    }


    /**
     * Get the associated Pays object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Pays The associated Pays object.
     * @throws PropelException
     */
    public function getPays(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aPays === null && ($this->pays_id !== null) && $doQuery) {
            $this->aPays = PaysQuery::create()->findPk($this->pays_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPays->addRegions($this);
             */
        }

        return $this->aPays;
    }

    /**
     * Declares an association between this object and a Destination object.
     *
     * @param             Destination $v
     * @return Region The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDestination(Destination $v = null)
    {
        if ($v === null) {
            $this->setDestinationId(NULL);
        } else {
            $this->setDestinationId($v->getId());
        }

        $this->aDestination = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Destination object, it will not be re-added.
        if ($v !== null) {
            $v->addRegion($this);
        }


        return $this;
    }


    /**
     * Get the associated Destination object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Destination The associated Destination object.
     * @throws PropelException
     */
    public function getDestination(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aDestination === null && ($this->destination_id !== null) && $doQuery) {
            $this->aDestination = DestinationQuery::create()->findPk($this->destination_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDestination->addRegions($this);
             */
        }

        return $this->aDestination;
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
        if ('Ville' == $relationName) {
            $this->initVilles();
        }
        if ('BonPlanRegion' == $relationName) {
            $this->initBonPlanRegions();
        }
        if ('RegionI18n' == $relationName) {
            $this->initRegionI18ns();
        }
    }

    /**
     * Clears out the collVilles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Region The current object (for fluent API support)
     * @see        addVilles()
     */
    public function clearVilles()
    {
        $this->collVilles = null; // important to set this to null since that means it is uninitialized
        $this->collVillesPartial = null;

        return $this;
    }

    /**
     * reset is the collVilles collection loaded partially
     *
     * @return void
     */
    public function resetPartialVilles($v = true)
    {
        $this->collVillesPartial = $v;
    }

    /**
     * Initializes the collVilles collection.
     *
     * By default this just sets the collVilles collection to an empty array (like clearcollVilles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVilles($overrideExisting = true)
    {
        if (null !== $this->collVilles && !$overrideExisting) {
            return;
        }
        $this->collVilles = new PropelObjectCollection();
        $this->collVilles->setModel('Ville');
    }

    /**
     * Gets an array of Ville objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Region is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Ville[] List of Ville objects
     * @throws PropelException
     */
    public function getVilles($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collVillesPartial && !$this->isNew();
        if (null === $this->collVilles || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVilles) {
                // return empty collection
                $this->initVilles();
            } else {
                $collVilles = VilleQuery::create(null, $criteria)
                    ->filterByRegion($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collVillesPartial && count($collVilles)) {
                      $this->initVilles(false);

                      foreach($collVilles as $obj) {
                        if (false == $this->collVilles->contains($obj)) {
                          $this->collVilles->append($obj);
                        }
                      }

                      $this->collVillesPartial = true;
                    }

                    return $collVilles;
                }

                if($partial && $this->collVilles) {
                    foreach($this->collVilles as $obj) {
                        if($obj->isNew()) {
                            $collVilles[] = $obj;
                        }
                    }
                }

                $this->collVilles = $collVilles;
                $this->collVillesPartial = false;
            }
        }

        return $this->collVilles;
    }

    /**
     * Sets a collection of Ville objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $villes A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Region The current object (for fluent API support)
     */
    public function setVilles(PropelCollection $villes, PropelPDO $con = null)
    {
        $this->villesScheduledForDeletion = $this->getVilles(new Criteria(), $con)->diff($villes);

        foreach ($this->villesScheduledForDeletion as $villeRemoved) {
            $villeRemoved->setRegion(null);
        }

        $this->collVilles = null;
        foreach ($villes as $ville) {
            $this->addVille($ville);
        }

        $this->collVilles = $villes;
        $this->collVillesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Ville objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Ville objects.
     * @throws PropelException
     */
    public function countVilles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collVillesPartial && !$this->isNew();
        if (null === $this->collVilles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVilles) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getVilles());
            }
            $query = VilleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRegion($this)
                ->count($con);
        }

        return count($this->collVilles);
    }

    /**
     * Method called to associate a Ville object to this object
     * through the Ville foreign key attribute.
     *
     * @param    Ville $l Ville
     * @return Region The current object (for fluent API support)
     */
    public function addVille(Ville $l)
    {
        if ($this->collVilles === null) {
            $this->initVilles();
            $this->collVillesPartial = true;
        }
        if (!in_array($l, $this->collVilles->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddVille($l);
        }

        return $this;
    }

    /**
     * @param	Ville $ville The ville object to add.
     */
    protected function doAddVille($ville)
    {
        $this->collVilles[]= $ville;
        $ville->setRegion($this);
    }

    /**
     * @param	Ville $ville The ville object to remove.
     * @return Region The current object (for fluent API support)
     */
    public function removeVille($ville)
    {
        if ($this->getVilles()->contains($ville)) {
            $this->collVilles->remove($this->collVilles->search($ville));
            if (null === $this->villesScheduledForDeletion) {
                $this->villesScheduledForDeletion = clone $this->collVilles;
                $this->villesScheduledForDeletion->clear();
            }
            $this->villesScheduledForDeletion[]= $ville;
            $ville->setRegion(null);
        }

        return $this;
    }

    /**
     * Clears out the collBonPlanRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Region The current object (for fluent API support)
     * @see        addBonPlanRegions()
     */
    public function clearBonPlanRegions()
    {
        $this->collBonPlanRegions = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlanRegionsPartial = null;

        return $this;
    }

    /**
     * reset is the collBonPlanRegions collection loaded partially
     *
     * @return void
     */
    public function resetPartialBonPlanRegions($v = true)
    {
        $this->collBonPlanRegionsPartial = $v;
    }

    /**
     * Initializes the collBonPlanRegions collection.
     *
     * By default this just sets the collBonPlanRegions collection to an empty array (like clearcollBonPlanRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBonPlanRegions($overrideExisting = true)
    {
        if (null !== $this->collBonPlanRegions && !$overrideExisting) {
            return;
        }
        $this->collBonPlanRegions = new PropelObjectCollection();
        $this->collBonPlanRegions->setModel('BonPlanRegion');
    }

    /**
     * Gets an array of BonPlanRegion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Region is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BonPlanRegion[] List of BonPlanRegion objects
     * @throws PropelException
     */
    public function getBonPlanRegions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanRegionsPartial && !$this->isNew();
        if (null === $this->collBonPlanRegions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBonPlanRegions) {
                // return empty collection
                $this->initBonPlanRegions();
            } else {
                $collBonPlanRegions = BonPlanRegionQuery::create(null, $criteria)
                    ->filterByRegion($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBonPlanRegionsPartial && count($collBonPlanRegions)) {
                      $this->initBonPlanRegions(false);

                      foreach($collBonPlanRegions as $obj) {
                        if (false == $this->collBonPlanRegions->contains($obj)) {
                          $this->collBonPlanRegions->append($obj);
                        }
                      }

                      $this->collBonPlanRegionsPartial = true;
                    }

                    return $collBonPlanRegions;
                }

                if($partial && $this->collBonPlanRegions) {
                    foreach($this->collBonPlanRegions as $obj) {
                        if($obj->isNew()) {
                            $collBonPlanRegions[] = $obj;
                        }
                    }
                }

                $this->collBonPlanRegions = $collBonPlanRegions;
                $this->collBonPlanRegionsPartial = false;
            }
        }

        return $this->collBonPlanRegions;
    }

    /**
     * Sets a collection of BonPlanRegion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlanRegions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Region The current object (for fluent API support)
     */
    public function setBonPlanRegions(PropelCollection $bonPlanRegions, PropelPDO $con = null)
    {
        $this->bonPlanRegionsScheduledForDeletion = $this->getBonPlanRegions(new Criteria(), $con)->diff($bonPlanRegions);

        foreach ($this->bonPlanRegionsScheduledForDeletion as $bonPlanRegionRemoved) {
            $bonPlanRegionRemoved->setRegion(null);
        }

        $this->collBonPlanRegions = null;
        foreach ($bonPlanRegions as $bonPlanRegion) {
            $this->addBonPlanRegion($bonPlanRegion);
        }

        $this->collBonPlanRegions = $bonPlanRegions;
        $this->collBonPlanRegionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BonPlanRegion objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BonPlanRegion objects.
     * @throws PropelException
     */
    public function countBonPlanRegions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBonPlanRegionsPartial && !$this->isNew();
        if (null === $this->collBonPlanRegions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBonPlanRegions) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBonPlanRegions());
            }
            $query = BonPlanRegionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRegion($this)
                ->count($con);
        }

        return count($this->collBonPlanRegions);
    }

    /**
     * Method called to associate a BonPlanRegion object to this object
     * through the BonPlanRegion foreign key attribute.
     *
     * @param    BonPlanRegion $l BonPlanRegion
     * @return Region The current object (for fluent API support)
     */
    public function addBonPlanRegion(BonPlanRegion $l)
    {
        if ($this->collBonPlanRegions === null) {
            $this->initBonPlanRegions();
            $this->collBonPlanRegionsPartial = true;
        }
        if (!in_array($l, $this->collBonPlanRegions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlanRegion($l);
        }

        return $this;
    }

    /**
     * @param	BonPlanRegion $bonPlanRegion The bonPlanRegion object to add.
     */
    protected function doAddBonPlanRegion($bonPlanRegion)
    {
        $this->collBonPlanRegions[]= $bonPlanRegion;
        $bonPlanRegion->setRegion($this);
    }

    /**
     * @param	BonPlanRegion $bonPlanRegion The bonPlanRegion object to remove.
     * @return Region The current object (for fluent API support)
     */
    public function removeBonPlanRegion($bonPlanRegion)
    {
        if ($this->getBonPlanRegions()->contains($bonPlanRegion)) {
            $this->collBonPlanRegions->remove($this->collBonPlanRegions->search($bonPlanRegion));
            if (null === $this->bonPlanRegionsScheduledForDeletion) {
                $this->bonPlanRegionsScheduledForDeletion = clone $this->collBonPlanRegions;
                $this->bonPlanRegionsScheduledForDeletion->clear();
            }
            $this->bonPlanRegionsScheduledForDeletion[]= $bonPlanRegion;
            $bonPlanRegion->setRegion(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Region is new, it will return
     * an empty collection; or if this Region has previously
     * been saved, it will retrieve related BonPlanRegions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Region.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BonPlanRegion[] List of BonPlanRegion objects
     */
    public function getBonPlanRegionsJoinBonPlan($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BonPlanRegionQuery::create(null, $criteria);
        $query->joinWith('BonPlan', $join_behavior);

        return $this->getBonPlanRegions($query, $con);
    }

    /**
     * Clears out the collRegionI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Region The current object (for fluent API support)
     * @see        addRegionI18ns()
     */
    public function clearRegionI18ns()
    {
        $this->collRegionI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collRegionI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collRegionI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialRegionI18ns($v = true)
    {
        $this->collRegionI18nsPartial = $v;
    }

    /**
     * Initializes the collRegionI18ns collection.
     *
     * By default this just sets the collRegionI18ns collection to an empty array (like clearcollRegionI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRegionI18ns($overrideExisting = true)
    {
        if (null !== $this->collRegionI18ns && !$overrideExisting) {
            return;
        }
        $this->collRegionI18ns = new PropelObjectCollection();
        $this->collRegionI18ns->setModel('RegionI18n');
    }

    /**
     * Gets an array of RegionI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Region is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|RegionI18n[] List of RegionI18n objects
     * @throws PropelException
     */
    public function getRegionI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRegionI18nsPartial && !$this->isNew();
        if (null === $this->collRegionI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRegionI18ns) {
                // return empty collection
                $this->initRegionI18ns();
            } else {
                $collRegionI18ns = RegionI18nQuery::create(null, $criteria)
                    ->filterByRegion($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRegionI18nsPartial && count($collRegionI18ns)) {
                      $this->initRegionI18ns(false);

                      foreach($collRegionI18ns as $obj) {
                        if (false == $this->collRegionI18ns->contains($obj)) {
                          $this->collRegionI18ns->append($obj);
                        }
                      }

                      $this->collRegionI18nsPartial = true;
                    }

                    return $collRegionI18ns;
                }

                if($partial && $this->collRegionI18ns) {
                    foreach($this->collRegionI18ns as $obj) {
                        if($obj->isNew()) {
                            $collRegionI18ns[] = $obj;
                        }
                    }
                }

                $this->collRegionI18ns = $collRegionI18ns;
                $this->collRegionI18nsPartial = false;
            }
        }

        return $this->collRegionI18ns;
    }

    /**
     * Sets a collection of RegionI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $regionI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Region The current object (for fluent API support)
     */
    public function setRegionI18ns(PropelCollection $regionI18ns, PropelPDO $con = null)
    {
        $this->regionI18nsScheduledForDeletion = $this->getRegionI18ns(new Criteria(), $con)->diff($regionI18ns);

        foreach ($this->regionI18nsScheduledForDeletion as $regionI18nRemoved) {
            $regionI18nRemoved->setRegion(null);
        }

        $this->collRegionI18ns = null;
        foreach ($regionI18ns as $regionI18n) {
            $this->addRegionI18n($regionI18n);
        }

        $this->collRegionI18ns = $regionI18ns;
        $this->collRegionI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RegionI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related RegionI18n objects.
     * @throws PropelException
     */
    public function countRegionI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRegionI18nsPartial && !$this->isNew();
        if (null === $this->collRegionI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegionI18ns) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRegionI18ns());
            }
            $query = RegionI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRegion($this)
                ->count($con);
        }

        return count($this->collRegionI18ns);
    }

    /**
     * Method called to associate a RegionI18n object to this object
     * through the RegionI18n foreign key attribute.
     *
     * @param    RegionI18n $l RegionI18n
     * @return Region The current object (for fluent API support)
     */
    public function addRegionI18n(RegionI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collRegionI18ns === null) {
            $this->initRegionI18ns();
            $this->collRegionI18nsPartial = true;
        }
        if (!in_array($l, $this->collRegionI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRegionI18n($l);
        }

        return $this;
    }

    /**
     * @param	RegionI18n $regionI18n The regionI18n object to add.
     */
    protected function doAddRegionI18n($regionI18n)
    {
        $this->collRegionI18ns[]= $regionI18n;
        $regionI18n->setRegion($this);
    }

    /**
     * @param	RegionI18n $regionI18n The regionI18n object to remove.
     * @return Region The current object (for fluent API support)
     */
    public function removeRegionI18n($regionI18n)
    {
        if ($this->getRegionI18ns()->contains($regionI18n)) {
            $this->collRegionI18ns->remove($this->collRegionI18ns->search($regionI18n));
            if (null === $this->regionI18nsScheduledForDeletion) {
                $this->regionI18nsScheduledForDeletion = clone $this->collRegionI18ns;
                $this->regionI18nsScheduledForDeletion->clear();
            }
            $this->regionI18nsScheduledForDeletion[]= $regionI18n;
            $regionI18n->setRegion(null);
        }

        return $this;
    }

    /**
     * Clears out the collBonPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Region The current object (for fluent API support)
     * @see        addBonPlans()
     */
    public function clearBonPlans()
    {
        $this->collBonPlans = null; // important to set this to null since that means it is uninitialized
        $this->collBonPlansPartial = null;

        return $this;
    }

    /**
     * Initializes the collBonPlans collection.
     *
     * By default this just sets the collBonPlans collection to an empty collection (like clearBonPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBonPlans()
    {
        $this->collBonPlans = new PropelObjectCollection();
        $this->collBonPlans->setModel('BonPlan');
    }

    /**
     * Gets a collection of BonPlan objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_region cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Region is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|BonPlan[] List of BonPlan objects
     */
    public function getBonPlans($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBonPlans || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonPlans) {
                // return empty collection
                $this->initBonPlans();
            } else {
                $collBonPlans = BonPlanQuery::create(null, $criteria)
                    ->filterByRegion($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBonPlans;
                }
                $this->collBonPlans = $collBonPlans;
            }
        }

        return $this->collBonPlans;
    }

    /**
     * Sets a collection of BonPlan objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_region cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonPlans A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Region The current object (for fluent API support)
     */
    public function setBonPlans(PropelCollection $bonPlans, PropelPDO $con = null)
    {
        $this->clearBonPlans();
        $currentBonPlans = $this->getBonPlans();

        $this->bonPlansScheduledForDeletion = $currentBonPlans->diff($bonPlans);

        foreach ($bonPlans as $bonPlan) {
            if (!$currentBonPlans->contains($bonPlan)) {
                $this->doAddBonPlan($bonPlan);
            }
        }

        $this->collBonPlans = $bonPlans;

        return $this;
    }

    /**
     * Gets the number of BonPlan objects related by a many-to-many relationship
     * to the current object by way of the bon_plan_region cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related BonPlan objects
     */
    public function countBonPlans($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBonPlans || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonPlans) {
                return 0;
            } else {
                $query = BonPlanQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRegion($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonPlans);
        }
    }

    /**
     * Associate a BonPlan object to this object
     * through the bon_plan_region cross reference table.
     *
     * @param  BonPlan $bonPlan The BonPlanRegion object to relate
     * @return Region The current object (for fluent API support)
     */
    public function addBonPlan(BonPlan $bonPlan)
    {
        if ($this->collBonPlans === null) {
            $this->initBonPlans();
        }
        if (!$this->collBonPlans->contains($bonPlan)) { // only add it if the **same** object is not already associated
            $this->doAddBonPlan($bonPlan);

            $this->collBonPlans[]= $bonPlan;
        }

        return $this;
    }

    /**
     * @param	BonPlan $bonPlan The bonPlan object to add.
     */
    protected function doAddBonPlan($bonPlan)
    {
        $bonPlanRegion = new BonPlanRegion();
        $bonPlanRegion->setBonPlan($bonPlan);
        $this->addBonPlanRegion($bonPlanRegion);
    }

    /**
     * Remove a BonPlan object to this object
     * through the bon_plan_region cross reference table.
     *
     * @param BonPlan $bonPlan The BonPlanRegion object to relate
     * @return Region The current object (for fluent API support)
     */
    public function removeBonPlan(BonPlan $bonPlan)
    {
        if ($this->getBonPlans()->contains($bonPlan)) {
            $this->collBonPlans->remove($this->collBonPlans->search($bonPlan));
            if (null === $this->bonPlansScheduledForDeletion) {
                $this->bonPlansScheduledForDeletion = clone $this->collBonPlans;
                $this->bonPlansScheduledForDeletion->clear();
            }
            $this->bonPlansScheduledForDeletion[]= $bonPlan;
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
        $this->image_path = null;
        $this->image_encart_path = null;
        $this->image_encart_petite_path = null;
        $this->pays_id = null;
        $this->destination_id = null;
        $this->mea_home = null;
        $this->image_detail_1 = null;
        $this->image_detail_2 = null;
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
            if ($this->collVilles) {
                foreach ($this->collVilles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlanRegions) {
                foreach ($this->collBonPlanRegions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRegionI18ns) {
                foreach ($this->collRegionI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonPlans) {
                foreach ($this->collBonPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collVilles instanceof PropelCollection) {
            $this->collVilles->clearIterator();
        }
        $this->collVilles = null;
        if ($this->collBonPlanRegions instanceof PropelCollection) {
            $this->collBonPlanRegions->clearIterator();
        }
        $this->collBonPlanRegions = null;
        if ($this->collRegionI18ns instanceof PropelCollection) {
            $this->collRegionI18ns->clearIterator();
        }
        $this->collRegionI18ns = null;
        if ($this->collBonPlans instanceof PropelCollection) {
            $this->collBonPlans->clearIterator();
        }
        $this->collBonPlans = null;
        $this->aPays = null;
        $this->aDestination = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RegionPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Region The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = RegionPeer::UPDATED_AT;

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
    
    public function getBonPlansActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\BonPlanPeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\BonPlanPeer::ID, \Cungfoo\Model\BonPlanI18nPeer::alias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\BonPlanI18nPeer::alias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\BonPlanI18nPeer::alias('i18n_locale', \Cungfoo\Model\BonPlanI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getBonPlans($criteria, $con);
    }
    
    public function getVillesActive($criteria = null, PropelPDO $con = null)
    {
    
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }
    
        $criteria->add(\Cungfoo\Model\VillePeer::ACTIVE, true);
    
    
        $criteria->addAlias('i18n_locale', \Cungfoo\Model\VilleI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\VillePeer::ID, \Cungfoo\Model\VilleI18nPeer::alias('i18n_locale', \Cungfoo\Model\VilleI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\VilleI18nPeer::alias('i18n_locale', \Cungfoo\Model\VilleI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\VilleI18nPeer::alias('i18n_locale', \Cungfoo\Model\VilleI18nPeer::LOCALE), $this->currentLocale);
    
        return $this->getVilles($criteria, $con);
    }
    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Region The current object (for fluent API support)
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
     * @return RegionI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collRegionI18ns) {
                foreach ($this->collRegionI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new RegionI18n();
                $translation->setLocale($locale);
            } else {
                $translation = RegionI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addRegionI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Region The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            RegionI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collRegionI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collRegionI18ns[$key]);
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
     * @return RegionI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
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
         * @return RegionI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

        return $this;
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
         * @return RegionI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

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
         * @return RegionI18n The current object (for fluent API support)
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
         * @return RegionI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

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
         * @return RegionI18n The current object (for fluent API support)
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
            $this->resetModified(RegionPeer::IMAGE_PATH);
        }
    
        $this->uploadImagePath($form);
        
        if (!$form['image_encart_path_deleted']->getData())
        {
            $this->resetModified(RegionPeer::IMAGE_ENCART_PATH);
        }
    
        $this->uploadImageEncartPath($form);
        
        if (!$form['image_encart_petite_path_deleted']->getData())
        {
            $this->resetModified(RegionPeer::IMAGE_ENCART_PETITE_PATH);
        }
    
        $this->uploadImageEncartPetitePath($form);
        
        if (!$form['image_detail_1_deleted']->getData())
        {
            $this->resetModified(RegionPeer::IMAGE_DETAIL_1);
        }
    
        $this->uploadImageDetail1($form);
        
        if (!$form['image_detail_2_deleted']->getData())
        {
            $this->resetModified(RegionPeer::IMAGE_DETAIL_2);
        }
    
        $this->uploadImageDetail2($form);
        
        return $this->save($con);
    }
    
    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/regions';
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
    
    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImageEncartPath(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_encart_path']->getData()))
        {
            if ($form['image_encart_path']->getData()) {
                $image = uniqid().'.'.$form['image_encart_path']->getData()->guessExtension();
                $form['image_encart_path']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImageEncartPath($this->getUploadDir() . '/' . $image);
            }
        }
    }
    
    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImageEncartPetitePath(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_encart_petite_path']->getData()))
        {
            if ($form['image_encart_petite_path']->getData()) {
                $image = uniqid().'.'.$form['image_encart_petite_path']->getData()->guessExtension();
                $form['image_encart_petite_path']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImageEncartPetitePath($this->getUploadDir() . '/' . $image);
            }
        }
    }
    
    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImageDetail1(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_detail_1']->getData()))
        {
            if ($form['image_detail_1']->getData()) {
                $image = uniqid().'.'.$form['image_detail_1']->getData()->guessExtension();
                $form['image_detail_1']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImageDetail1($this->getUploadDir() . '/' . $image);
            }
        }
    }
    
    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadImageDetail2(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['image_detail_2']->getData()))
        {
            if ($form['image_detail_2']->getData()) {
                $image = uniqid().'.'.$form['image_detail_2']->getData()->guessExtension();
                $form['image_detail_2']->getData()->move($this->getUploadRootDir(), $image);
                $this->setImageDetail2($this->getUploadDir() . '/' . $image);
            }
        }
    }

}
