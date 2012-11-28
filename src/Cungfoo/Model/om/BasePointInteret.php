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
use Cungfoo\Model\EtablissementPointInteret;
use Cungfoo\Model\EtablissementPointInteretQuery;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\PointInteret;
use Cungfoo\Model\PointInteretI18n;
use Cungfoo\Model\PointInteretI18nQuery;
use Cungfoo\Model\PointInteretPeer;
use Cungfoo\Model\PointInteretQuery;

/**
 * Base class that represents a row from the 'point_interet' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePointInteret extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\PointInteretPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PointInteretPeer
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
     * The value for the geo_coordinate_x field.
     * @var        string
     */
    protected $geo_coordinate_x;

    /**
     * The value for the geo_coordinate_y field.
     * @var        string
     */
    protected $geo_coordinate_y;

    /**
     * The value for the distance_camping field.
     * @var        string
     */
    protected $distance_camping;

    /**
     * The value for the image field.
     * @var        string
     */
    protected $image;

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
     * The value for the enabled field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $enabled;

    /**
     * @var        PropelObjectCollection|EtablissementPointInteret[] Collection to store aggregation of EtablissementPointInteret objects.
     */
    protected $collEtablissementPointInterets;
    protected $collEtablissementPointInteretsPartial;

    /**
     * @var        PropelObjectCollection|PointInteretI18n[] Collection to store aggregation of PointInteretI18n objects.
     */
    protected $collPointInteretI18ns;
    protected $collPointInteretI18nsPartial;

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
     * @var        array[PointInteretI18n]
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
    protected $etablissementPointInteretsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pointInteretI18nsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->enabled = false;
    }

    /**
     * Initializes internal state of BasePointInteret object.
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
     * Get the [geo_coordinate_x] column value.
     *
     * @return string
     */
    public function getGeoCoordinateX()
    {
        return $this->geo_coordinate_x;
    }

    /**
     * Get the [geo_coordinate_y] column value.
     *
     * @return string
     */
    public function getGeoCoordinateY()
    {
        return $this->geo_coordinate_y;
    }

    /**
     * Get the [distance_camping] column value.
     *
     * @return string
     */
    public function getDistanceCamping()
    {
        return $this->distance_camping;
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
     * Get the [enabled] column value.
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PointInteretPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = PointInteretPeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[] = PointInteretPeer::ADDRESS;
        }


        return $this;
    } // setAddress()

    /**
     * Set the value of [address2] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[] = PointInteretPeer::ADDRESS2;
        }


        return $this;
    } // setAddress2()

    /**
     * Set the value of [zipcode] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setZipcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zipcode !== $v) {
            $this->zipcode = $v;
            $this->modifiedColumns[] = PointInteretPeer::ZIPCODE;
        }


        return $this;
    } // setZipcode()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = PointInteretPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [geo_coordinate_x] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setGeoCoordinateX($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_x !== $v) {
            $this->geo_coordinate_x = $v;
            $this->modifiedColumns[] = PointInteretPeer::GEO_COORDINATE_X;
        }


        return $this;
    } // setGeoCoordinateX()

    /**
     * Set the value of [geo_coordinate_y] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setGeoCoordinateY($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_y !== $v) {
            $this->geo_coordinate_y = $v;
            $this->modifiedColumns[] = PointInteretPeer::GEO_COORDINATE_Y;
        }


        return $this;
    } // setGeoCoordinateY()

    /**
     * Set the value of [distance_camping] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setDistanceCamping($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->distance_camping !== $v) {
            $this->distance_camping = $v;
            $this->modifiedColumns[] = PointInteretPeer::DISTANCE_CAMPING;
        }


        return $this;
    } // setDistanceCamping()

    /**
     * Set the value of [image] column.
     *
     * @param string $v new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[] = PointInteretPeer::IMAGE;
        }


        return $this;
    } // setImage()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return PointInteret The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PointInteretPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return PointInteret The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PointInteretPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Sets the value of the [enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return PointInteret The current object (for fluent API support)
     */
    public function setEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->enabled !== $v) {
            $this->enabled = $v;
            $this->modifiedColumns[] = PointInteretPeer::ENABLED;
        }


        return $this;
    } // setEnabled()

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
            if ($this->enabled !== false) {
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
            $this->address = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->address2 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->zipcode = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->city = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->geo_coordinate_x = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->geo_coordinate_y = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->distance_camping = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->image = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->enabled = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 13; // 13 = PointInteretPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating PointInteret object", $e);
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
            $con = Propel::getConnection(PointInteretPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PointInteretPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEtablissementPointInterets = null;

            $this->collPointInteretI18ns = null;

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
            $con = Propel::getConnection(PointInteretPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PointInteretQuery::create()
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
            $con = Propel::getConnection(PointInteretPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PointInteretPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PointInteretPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PointInteretPeer::UPDATED_AT)) {
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
                PointInteretPeer::addInstanceToPool($this);
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
                    EtablissementPointInteretQuery::create()
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

            if ($this->etablissementPointInteretsScheduledForDeletion !== null) {
                if (!$this->etablissementPointInteretsScheduledForDeletion->isEmpty()) {
                    EtablissementPointInteretQuery::create()
                        ->filterByPrimaryKeys($this->etablissementPointInteretsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementPointInteretsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementPointInterets !== null) {
                foreach ($this->collEtablissementPointInterets as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pointInteretI18nsScheduledForDeletion !== null) {
                if (!$this->pointInteretI18nsScheduledForDeletion->isEmpty()) {
                    PointInteretI18nQuery::create()
                        ->filterByPrimaryKeys($this->pointInteretI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pointInteretI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPointInteretI18ns !== null) {
                foreach ($this->collPointInteretI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = PointInteretPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PointInteretPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PointInteretPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(PointInteretPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`CODE`';
        }
        if ($this->isColumnModified(PointInteretPeer::ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS`';
        }
        if ($this->isColumnModified(PointInteretPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS2`';
        }
        if ($this->isColumnModified(PointInteretPeer::ZIPCODE)) {
            $modifiedColumns[':p' . $index++]  = '`ZIPCODE`';
        }
        if ($this->isColumnModified(PointInteretPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`CITY`';
        }
        if ($this->isColumnModified(PointInteretPeer::GEO_COORDINATE_X)) {
            $modifiedColumns[':p' . $index++]  = '`GEO_COORDINATE_X`';
        }
        if ($this->isColumnModified(PointInteretPeer::GEO_COORDINATE_Y)) {
            $modifiedColumns[':p' . $index++]  = '`GEO_COORDINATE_Y`';
        }
        if ($this->isColumnModified(PointInteretPeer::DISTANCE_CAMPING)) {
            $modifiedColumns[':p' . $index++]  = '`DISTANCE_CAMPING`';
        }
        if ($this->isColumnModified(PointInteretPeer::IMAGE)) {
            $modifiedColumns[':p' . $index++]  = '`IMAGE`';
        }
        if ($this->isColumnModified(PointInteretPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(PointInteretPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }
        if ($this->isColumnModified(PointInteretPeer::ENABLED)) {
            $modifiedColumns[':p' . $index++]  = '`ENABLED`';
        }

        $sql = sprintf(
            'INSERT INTO `point_interet` (%s) VALUES (%s)',
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
                    case '`CODE`':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
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
                    case '`GEO_COORDINATE_X`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_x, PDO::PARAM_STR);
                        break;
                    case '`GEO_COORDINATE_Y`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_y, PDO::PARAM_STR);
                        break;
                    case '`DISTANCE_CAMPING`':
                        $stmt->bindValue($identifier, $this->distance_camping, PDO::PARAM_STR);
                        break;
                    case '`IMAGE`':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case '`CREATED_AT`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                    case '`ENABLED`':
                        $stmt->bindValue($identifier, (int) $this->enabled, PDO::PARAM_INT);
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


            if (($retval = PointInteretPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collEtablissementPointInterets !== null) {
                    foreach ($this->collEtablissementPointInterets as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPointInteretI18ns !== null) {
                    foreach ($this->collPointInteretI18ns as $referrerFK) {
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
        $pos = PointInteretPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAddress();
                break;
            case 3:
                return $this->getAddress2();
                break;
            case 4:
                return $this->getZipcode();
                break;
            case 5:
                return $this->getCity();
                break;
            case 6:
                return $this->getGeoCoordinateX();
                break;
            case 7:
                return $this->getGeoCoordinateY();
                break;
            case 8:
                return $this->getDistanceCamping();
                break;
            case 9:
                return $this->getImage();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
                return $this->getUpdatedAt();
                break;
            case 12:
                return $this->getEnabled();
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
        if (isset($alreadyDumpedObjects['PointInteret'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PointInteret'][$this->getPrimaryKey()] = true;
        $keys = PointInteretPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getAddress(),
            $keys[3] => $this->getAddress2(),
            $keys[4] => $this->getZipcode(),
            $keys[5] => $this->getCity(),
            $keys[6] => $this->getGeoCoordinateX(),
            $keys[7] => $this->getGeoCoordinateY(),
            $keys[8] => $this->getDistanceCamping(),
            $keys[9] => $this->getImage(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getEnabled(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collEtablissementPointInterets) {
                $result['EtablissementPointInterets'] = $this->collEtablissementPointInterets->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPointInteretI18ns) {
                $result['PointInteretI18ns'] = $this->collPointInteretI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PointInteretPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAddress($value);
                break;
            case 3:
                $this->setAddress2($value);
                break;
            case 4:
                $this->setZipcode($value);
                break;
            case 5:
                $this->setCity($value);
                break;
            case 6:
                $this->setGeoCoordinateX($value);
                break;
            case 7:
                $this->setGeoCoordinateY($value);
                break;
            case 8:
                $this->setDistanceCamping($value);
                break;
            case 9:
                $this->setImage($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
                break;
            case 12:
                $this->setEnabled($value);
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
        $keys = PointInteretPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAddress($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAddress2($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setZipcode($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCity($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setGeoCoordinateX($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setGeoCoordinateY($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setDistanceCamping($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setImage($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setEnabled($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PointInteretPeer::DATABASE_NAME);

        if ($this->isColumnModified(PointInteretPeer::ID)) $criteria->add(PointInteretPeer::ID, $this->id);
        if ($this->isColumnModified(PointInteretPeer::CODE)) $criteria->add(PointInteretPeer::CODE, $this->code);
        if ($this->isColumnModified(PointInteretPeer::ADDRESS)) $criteria->add(PointInteretPeer::ADDRESS, $this->address);
        if ($this->isColumnModified(PointInteretPeer::ADDRESS2)) $criteria->add(PointInteretPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(PointInteretPeer::ZIPCODE)) $criteria->add(PointInteretPeer::ZIPCODE, $this->zipcode);
        if ($this->isColumnModified(PointInteretPeer::CITY)) $criteria->add(PointInteretPeer::CITY, $this->city);
        if ($this->isColumnModified(PointInteretPeer::GEO_COORDINATE_X)) $criteria->add(PointInteretPeer::GEO_COORDINATE_X, $this->geo_coordinate_x);
        if ($this->isColumnModified(PointInteretPeer::GEO_COORDINATE_Y)) $criteria->add(PointInteretPeer::GEO_COORDINATE_Y, $this->geo_coordinate_y);
        if ($this->isColumnModified(PointInteretPeer::DISTANCE_CAMPING)) $criteria->add(PointInteretPeer::DISTANCE_CAMPING, $this->distance_camping);
        if ($this->isColumnModified(PointInteretPeer::IMAGE)) $criteria->add(PointInteretPeer::IMAGE, $this->image);
        if ($this->isColumnModified(PointInteretPeer::CREATED_AT)) $criteria->add(PointInteretPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PointInteretPeer::UPDATED_AT)) $criteria->add(PointInteretPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(PointInteretPeer::ENABLED)) $criteria->add(PointInteretPeer::ENABLED, $this->enabled);

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
        $criteria = new Criteria(PointInteretPeer::DATABASE_NAME);
        $criteria->add(PointInteretPeer::ID, $this->id);

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
     * @param object $copyObj An object of PointInteret (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setZipcode($this->getZipcode());
        $copyObj->setCity($this->getCity());
        $copyObj->setGeoCoordinateX($this->getGeoCoordinateX());
        $copyObj->setGeoCoordinateY($this->getGeoCoordinateY());
        $copyObj->setDistanceCamping($this->getDistanceCamping());
        $copyObj->setImage($this->getImage());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setEnabled($this->getEnabled());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getEtablissementPointInterets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementPointInteret($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPointInteretI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPointInteretI18n($relObj->copy($deepCopy));
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
     * @return PointInteret Clone of current object.
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
     * @return PointInteretPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PointInteretPeer();
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
        if ('EtablissementPointInteret' == $relationName) {
            $this->initEtablissementPointInterets();
        }
        if ('PointInteretI18n' == $relationName) {
            $this->initPointInteretI18ns();
        }
    }

    /**
     * Clears out the collEtablissementPointInterets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementPointInterets()
     */
    public function clearEtablissementPointInterets()
    {
        $this->collEtablissementPointInterets = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementPointInteretsPartial = null;
    }

    /**
     * reset is the collEtablissementPointInterets collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementPointInterets($v = true)
    {
        $this->collEtablissementPointInteretsPartial = $v;
    }

    /**
     * Initializes the collEtablissementPointInterets collection.
     *
     * By default this just sets the collEtablissementPointInterets collection to an empty array (like clearcollEtablissementPointInterets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementPointInterets($overrideExisting = true)
    {
        if (null !== $this->collEtablissementPointInterets && !$overrideExisting) {
            return;
        }
        $this->collEtablissementPointInterets = new PropelObjectCollection();
        $this->collEtablissementPointInterets->setModel('EtablissementPointInteret');
    }

    /**
     * Gets an array of EtablissementPointInteret objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PointInteret is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementPointInteret[] List of EtablissementPointInteret objects
     * @throws PropelException
     */
    public function getEtablissementPointInterets($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementPointInteretsPartial && !$this->isNew();
        if (null === $this->collEtablissementPointInterets || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementPointInterets) {
                // return empty collection
                $this->initEtablissementPointInterets();
            } else {
                $collEtablissementPointInterets = EtablissementPointInteretQuery::create(null, $criteria)
                    ->filterByPointInteret($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementPointInteretsPartial && count($collEtablissementPointInterets)) {
                      $this->initEtablissementPointInterets(false);

                      foreach($collEtablissementPointInterets as $obj) {
                        if (false == $this->collEtablissementPointInterets->contains($obj)) {
                          $this->collEtablissementPointInterets->append($obj);
                        }
                      }

                      $this->collEtablissementPointInteretsPartial = true;
                    }

                    return $collEtablissementPointInterets;
                }

                if($partial && $this->collEtablissementPointInterets) {
                    foreach($this->collEtablissementPointInterets as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementPointInterets[] = $obj;
                        }
                    }
                }

                $this->collEtablissementPointInterets = $collEtablissementPointInterets;
                $this->collEtablissementPointInteretsPartial = false;
            }
        }

        return $this->collEtablissementPointInterets;
    }

    /**
     * Sets a collection of EtablissementPointInteret objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementPointInterets A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementPointInterets(PropelCollection $etablissementPointInterets, PropelPDO $con = null)
    {
        $this->etablissementPointInteretsScheduledForDeletion = $this->getEtablissementPointInterets(new Criteria(), $con)->diff($etablissementPointInterets);

        foreach ($this->etablissementPointInteretsScheduledForDeletion as $etablissementPointInteretRemoved) {
            $etablissementPointInteretRemoved->setPointInteret(null);
        }

        $this->collEtablissementPointInterets = null;
        foreach ($etablissementPointInterets as $etablissementPointInteret) {
            $this->addEtablissementPointInteret($etablissementPointInteret);
        }

        $this->collEtablissementPointInterets = $etablissementPointInterets;
        $this->collEtablissementPointInteretsPartial = false;
    }

    /**
     * Returns the number of related EtablissementPointInteret objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementPointInteret objects.
     * @throws PropelException
     */
    public function countEtablissementPointInterets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementPointInteretsPartial && !$this->isNew();
        if (null === $this->collEtablissementPointInterets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementPointInterets) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementPointInterets());
                }
                $query = EtablissementPointInteretQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPointInteret($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementPointInterets);
        }
    }

    /**
     * Method called to associate a EtablissementPointInteret object to this object
     * through the EtablissementPointInteret foreign key attribute.
     *
     * @param    EtablissementPointInteret $l EtablissementPointInteret
     * @return PointInteret The current object (for fluent API support)
     */
    public function addEtablissementPointInteret(EtablissementPointInteret $l)
    {
        if ($this->collEtablissementPointInterets === null) {
            $this->initEtablissementPointInterets();
            $this->collEtablissementPointInteretsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementPointInterets->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementPointInteret($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementPointInteret $etablissementPointInteret The etablissementPointInteret object to add.
     */
    protected function doAddEtablissementPointInteret($etablissementPointInteret)
    {
        $this->collEtablissementPointInterets[]= $etablissementPointInteret;
        $etablissementPointInteret->setPointInteret($this);
    }

    /**
     * @param	EtablissementPointInteret $etablissementPointInteret The etablissementPointInteret object to remove.
     */
    public function removeEtablissementPointInteret($etablissementPointInteret)
    {
        if ($this->getEtablissementPointInterets()->contains($etablissementPointInteret)) {
            $this->collEtablissementPointInterets->remove($this->collEtablissementPointInterets->search($etablissementPointInteret));
            if (null === $this->etablissementPointInteretsScheduledForDeletion) {
                $this->etablissementPointInteretsScheduledForDeletion = clone $this->collEtablissementPointInterets;
                $this->etablissementPointInteretsScheduledForDeletion->clear();
            }
            $this->etablissementPointInteretsScheduledForDeletion[]= $etablissementPointInteret;
            $etablissementPointInteret->setPointInteret(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PointInteret is new, it will return
     * an empty collection; or if this PointInteret has previously
     * been saved, it will retrieve related EtablissementPointInterets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PointInteret.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementPointInteret[] List of EtablissementPointInteret objects
     */
    public function getEtablissementPointInteretsJoinEtablissement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementPointInteretQuery::create(null, $criteria);
        $query->joinWith('Etablissement', $join_behavior);

        return $this->getEtablissementPointInterets($query, $con);
    }

    /**
     * Clears out the collPointInteretI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPointInteretI18ns()
     */
    public function clearPointInteretI18ns()
    {
        $this->collPointInteretI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collPointInteretI18nsPartial = null;
    }

    /**
     * reset is the collPointInteretI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialPointInteretI18ns($v = true)
    {
        $this->collPointInteretI18nsPartial = $v;
    }

    /**
     * Initializes the collPointInteretI18ns collection.
     *
     * By default this just sets the collPointInteretI18ns collection to an empty array (like clearcollPointInteretI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPointInteretI18ns($overrideExisting = true)
    {
        if (null !== $this->collPointInteretI18ns && !$overrideExisting) {
            return;
        }
        $this->collPointInteretI18ns = new PropelObjectCollection();
        $this->collPointInteretI18ns->setModel('PointInteretI18n');
    }

    /**
     * Gets an array of PointInteretI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PointInteret is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PointInteretI18n[] List of PointInteretI18n objects
     * @throws PropelException
     */
    public function getPointInteretI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPointInteretI18nsPartial && !$this->isNew();
        if (null === $this->collPointInteretI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPointInteretI18ns) {
                // return empty collection
                $this->initPointInteretI18ns();
            } else {
                $collPointInteretI18ns = PointInteretI18nQuery::create(null, $criteria)
                    ->filterByPointInteret($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPointInteretI18nsPartial && count($collPointInteretI18ns)) {
                      $this->initPointInteretI18ns(false);

                      foreach($collPointInteretI18ns as $obj) {
                        if (false == $this->collPointInteretI18ns->contains($obj)) {
                          $this->collPointInteretI18ns->append($obj);
                        }
                      }

                      $this->collPointInteretI18nsPartial = true;
                    }

                    return $collPointInteretI18ns;
                }

                if($partial && $this->collPointInteretI18ns) {
                    foreach($this->collPointInteretI18ns as $obj) {
                        if($obj->isNew()) {
                            $collPointInteretI18ns[] = $obj;
                        }
                    }
                }

                $this->collPointInteretI18ns = $collPointInteretI18ns;
                $this->collPointInteretI18nsPartial = false;
            }
        }

        return $this->collPointInteretI18ns;
    }

    /**
     * Sets a collection of PointInteretI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pointInteretI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPointInteretI18ns(PropelCollection $pointInteretI18ns, PropelPDO $con = null)
    {
        $this->pointInteretI18nsScheduledForDeletion = $this->getPointInteretI18ns(new Criteria(), $con)->diff($pointInteretI18ns);

        foreach ($this->pointInteretI18nsScheduledForDeletion as $pointInteretI18nRemoved) {
            $pointInteretI18nRemoved->setPointInteret(null);
        }

        $this->collPointInteretI18ns = null;
        foreach ($pointInteretI18ns as $pointInteretI18n) {
            $this->addPointInteretI18n($pointInteretI18n);
        }

        $this->collPointInteretI18ns = $pointInteretI18ns;
        $this->collPointInteretI18nsPartial = false;
    }

    /**
     * Returns the number of related PointInteretI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PointInteretI18n objects.
     * @throws PropelException
     */
    public function countPointInteretI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPointInteretI18nsPartial && !$this->isNew();
        if (null === $this->collPointInteretI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPointInteretI18ns) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPointInteretI18ns());
                }
                $query = PointInteretI18nQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPointInteret($this)
                    ->count($con);
            }
        } else {
            return count($this->collPointInteretI18ns);
        }
    }

    /**
     * Method called to associate a PointInteretI18n object to this object
     * through the PointInteretI18n foreign key attribute.
     *
     * @param    PointInteretI18n $l PointInteretI18n
     * @return PointInteret The current object (for fluent API support)
     */
    public function addPointInteretI18n(PointInteretI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPointInteretI18ns === null) {
            $this->initPointInteretI18ns();
            $this->collPointInteretI18nsPartial = true;
        }
        if (!in_array($l, $this->collPointInteretI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPointInteretI18n($l);
        }

        return $this;
    }

    /**
     * @param	PointInteretI18n $pointInteretI18n The pointInteretI18n object to add.
     */
    protected function doAddPointInteretI18n($pointInteretI18n)
    {
        $this->collPointInteretI18ns[]= $pointInteretI18n;
        $pointInteretI18n->setPointInteret($this);
    }

    /**
     * @param	PointInteretI18n $pointInteretI18n The pointInteretI18n object to remove.
     */
    public function removePointInteretI18n($pointInteretI18n)
    {
        if ($this->getPointInteretI18ns()->contains($pointInteretI18n)) {
            $this->collPointInteretI18ns->remove($this->collPointInteretI18ns->search($pointInteretI18n));
            if (null === $this->pointInteretI18nsScheduledForDeletion) {
                $this->pointInteretI18nsScheduledForDeletion = clone $this->collPointInteretI18ns;
                $this->pointInteretI18nsScheduledForDeletion->clear();
            }
            $this->pointInteretI18nsScheduledForDeletion[]= $pointInteretI18n;
            $pointInteretI18n->setPointInteret(null);
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
     * to the current object by way of the etablissement_point_interet cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this PointInteret is new, it will return
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
                    ->filterByPointInteret($this)
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
     * to the current object by way of the etablissement_point_interet cross-reference table.
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
     * to the current object by way of the etablissement_point_interet cross-reference table.
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
                    ->filterByPointInteret($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissements);
        }
    }

    /**
     * Associate a Etablissement object to this object
     * through the etablissement_point_interet cross reference table.
     *
     * @param  Etablissement $etablissement The EtablissementPointInteret object to relate
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
        $etablissementPointInteret = new EtablissementPointInteret();
        $etablissementPointInteret->setEtablissement($etablissement);
        $this->addEtablissementPointInteret($etablissementPointInteret);
    }

    /**
     * Remove a Etablissement object to this object
     * through the etablissement_point_interet cross reference table.
     *
     * @param Etablissement $etablissement The EtablissementPointInteret object to relate
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
        $this->code = null;
        $this->address = null;
        $this->address2 = null;
        $this->zipcode = null;
        $this->city = null;
        $this->geo_coordinate_x = null;
        $this->geo_coordinate_y = null;
        $this->distance_camping = null;
        $this->image = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->enabled = null;
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
            if ($this->collEtablissementPointInterets) {
                foreach ($this->collEtablissementPointInterets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPointInteretI18ns) {
                foreach ($this->collPointInteretI18ns as $o) {
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

        if ($this->collEtablissementPointInterets instanceof PropelCollection) {
            $this->collEtablissementPointInterets->clearIterator();
        }
        $this->collEtablissementPointInterets = null;
        if ($this->collPointInteretI18ns instanceof PropelCollection) {
            $this->collPointInteretI18ns->clearIterator();
        }
        $this->collPointInteretI18ns = null;
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
        return (string) $this->exportTo(PointInteretPeer::DEFAULT_STRING_FORMAT);
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
     * @return     PointInteret The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PointInteretPeer::UPDATED_AT;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    PointInteret The current object (for fluent API support)
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
     * @return PointInteretI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPointInteretI18ns) {
                foreach ($this->collPointInteretI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new PointInteretI18n();
                $translation->setLocale($locale);
            } else {
                $translation = PointInteretI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPointInteretI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PointInteret The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            PointInteretI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPointInteretI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPointInteretI18ns[$key]);
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
     * @return PointInteretI18n */
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
         * @return PointInteretI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [presentation] column value.
         *
         * @return string
         */
        public function getPresentation()
        {
        return $this->getCurrentTranslation()->getPresentation();
    }


        /**
         * Set the value of [presentation] column.
         *
         * @param string $v new value
         * @return PointInteretI18n The current object (for fluent API support)
         */
        public function setPresentation($v)
        {    $this->getCurrentTranslation()->setPresentation($v);

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
