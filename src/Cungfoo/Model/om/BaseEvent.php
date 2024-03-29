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
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementEvent;
use Cungfoo\Model\EtablissementEventQuery;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\Event;
use Cungfoo\Model\EventI18n;
use Cungfoo\Model\EventI18nQuery;
use Cungfoo\Model\EventPeer;
use Cungfoo\Model\EventQuery;
use Cungfoo\Model\Region;
use Cungfoo\Model\RegionEvent;
use Cungfoo\Model\RegionEventQuery;
use Cungfoo\Model\RegionQuery;
use Propel\BaseObject;

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
     * The value for the code field.
     * @var        string
     */
    protected $code;

    /**
     * The value for the category field.
     * @var        string
     */
    protected $category;

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
     * The value for the priority field.
     * @var        string
     */
    protected $priority;

    /**
     * The value for the tel field.
     * @var        string
     */
    protected $tel;

    /**
     * The value for the fax field.
     * @var        string
     */
    protected $fax;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the website field.
     * @var        string
     */
    protected $website;

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
     * @var        PropelObjectCollection|EtablissementEvent[] Collection to store aggregation of EtablissementEvent objects.
     */
    protected $collEtablissementEvents;
    protected $collEtablissementEventsPartial;

    /**
     * @var        PropelObjectCollection|RegionEvent[] Collection to store aggregation of RegionEvent objects.
     */
    protected $collRegionEvents;
    protected $collRegionEventsPartial;

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
     * @var        PropelObjectCollection|Region[] Collection to store aggregation of Region objects.
     */
    protected $collRegions;

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
    protected $regionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $regionEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $eventI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseEvent object.
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
     * Get the [category] column value.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
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
     * Get the [priority] column value.
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Get the [tel] column value.
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Get the [fax] column value.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [website] column value.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
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
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = EventPeer::CODE;
        }


        return $this;
    } // setCode()

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
     * Set the value of [geo_coordinate_x] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setGeoCoordinateX($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_x !== $v) {
            $this->geo_coordinate_x = $v;
            $this->modifiedColumns[] = EventPeer::GEO_COORDINATE_X;
        }


        return $this;
    } // setGeoCoordinateX()

    /**
     * Set the value of [geo_coordinate_y] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setGeoCoordinateY($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_y !== $v) {
            $this->geo_coordinate_y = $v;
            $this->modifiedColumns[] = EventPeer::GEO_COORDINATE_Y;
        }


        return $this;
    } // setGeoCoordinateY()

    /**
     * Set the value of [distance_camping] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setDistanceCamping($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->distance_camping !== $v) {
            $this->distance_camping = $v;
            $this->modifiedColumns[] = EventPeer::DISTANCE_CAMPING;
        }


        return $this;
    } // setDistanceCamping()

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
     * Set the value of [tel] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setTel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tel !== $v) {
            $this->tel = $v;
            $this->modifiedColumns[] = EventPeer::TEL;
        }


        return $this;
    } // setTel()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[] = EventPeer::FAX;
        }


        return $this;
    } // setFax()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = EventPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [website] column.
     *
     * @param string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setWebsite($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->website !== $v) {
            $this->website = $v;
            $this->modifiedColumns[] = EventPeer::WEBSITE;
        }


        return $this;
    } // setWebsite()

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
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Event The current object (for fluent API support)
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
            $this->modifiedColumns[] = EventPeer::ACTIVE;
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
            $this->category = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->address = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->address2 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->zipcode = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->city = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->geo_coordinate_x = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->geo_coordinate_y = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->distance_camping = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->image = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->priority = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->tel = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->fax = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->email = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->website = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->created_at = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->updated_at = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->active = ($row[$startcol + 18] !== null) ? (boolean) $row[$startcol + 18] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 19; // 19 = EventPeer::NUM_HYDRATE_COLUMNS.

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

            $this->collRegionEvents = null;

            $this->collEventI18ns = null;

            $this->collEtablissements = null;
            $this->collRegions = null;
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

            if ($this->regionsScheduledForDeletion !== null) {
                if (!$this->regionsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->regionsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    RegionEventQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->regionsScheduledForDeletion = null;
                }

                foreach ($this->getRegions() as $region) {
                    if ($region->isModified()) {
                        $region->save($con);
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
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->regionEventsScheduledForDeletion !== null) {
                if (!$this->regionEventsScheduledForDeletion->isEmpty()) {
                    RegionEventQuery::create()
                        ->filterByPrimaryKeys($this->regionEventsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->regionEventsScheduledForDeletion = null;
                }
            }

            if ($this->collRegionEvents !== null) {
                foreach ($this->collRegionEvents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
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

        $this->modifiedColumns[] = EventPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EventPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EventPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EventPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }
        if ($this->isColumnModified(EventPeer::CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = '`category`';
        }
        if ($this->isColumnModified(EventPeer::ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`address`';
        }
        if ($this->isColumnModified(EventPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`address2`';
        }
        if ($this->isColumnModified(EventPeer::ZIPCODE)) {
            $modifiedColumns[':p' . $index++]  = '`zipcode`';
        }
        if ($this->isColumnModified(EventPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`city`';
        }
        if ($this->isColumnModified(EventPeer::GEO_COORDINATE_X)) {
            $modifiedColumns[':p' . $index++]  = '`geo_coordinate_x`';
        }
        if ($this->isColumnModified(EventPeer::GEO_COORDINATE_Y)) {
            $modifiedColumns[':p' . $index++]  = '`geo_coordinate_y`';
        }
        if ($this->isColumnModified(EventPeer::DISTANCE_CAMPING)) {
            $modifiedColumns[':p' . $index++]  = '`distance_camping`';
        }
        if ($this->isColumnModified(EventPeer::IMAGE)) {
            $modifiedColumns[':p' . $index++]  = '`image`';
        }
        if ($this->isColumnModified(EventPeer::PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = '`priority`';
        }
        if ($this->isColumnModified(EventPeer::TEL)) {
            $modifiedColumns[':p' . $index++]  = '`tel`';
        }
        if ($this->isColumnModified(EventPeer::FAX)) {
            $modifiedColumns[':p' . $index++]  = '`fax`';
        }
        if ($this->isColumnModified(EventPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(EventPeer::WEBSITE)) {
            $modifiedColumns[':p' . $index++]  = '`website`';
        }
        if ($this->isColumnModified(EventPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(EventPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(EventPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
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
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`code`':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                    case '`category`':
                        $stmt->bindValue($identifier, $this->category, PDO::PARAM_STR);
                        break;
                    case '`address`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`address2`':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);
                        break;
                    case '`zipcode`':
                        $stmt->bindValue($identifier, $this->zipcode, PDO::PARAM_STR);
                        break;
                    case '`city`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`geo_coordinate_x`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_x, PDO::PARAM_STR);
                        break;
                    case '`geo_coordinate_y`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_y, PDO::PARAM_STR);
                        break;
                    case '`distance_camping`':
                        $stmt->bindValue($identifier, $this->distance_camping, PDO::PARAM_STR);
                        break;
                    case '`image`':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case '`priority`':
                        $stmt->bindValue($identifier, $this->priority, PDO::PARAM_STR);
                        break;
                    case '`tel`':
                        $stmt->bindValue($identifier, $this->tel, PDO::PARAM_STR);
                        break;
                    case '`fax`':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`website`':
                        $stmt->bindValue($identifier, $this->website, PDO::PARAM_STR);
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

                if ($this->collRegionEvents !== null) {
                    foreach ($this->collRegionEvents as $referrerFK) {
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
                return $this->getCode();
                break;
            case 2:
                return $this->getCategory();
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
                return $this->getGeoCoordinateX();
                break;
            case 8:
                return $this->getGeoCoordinateY();
                break;
            case 9:
                return $this->getDistanceCamping();
                break;
            case 10:
                return $this->getImage();
                break;
            case 11:
                return $this->getPriority();
                break;
            case 12:
                return $this->getTel();
                break;
            case 13:
                return $this->getFax();
                break;
            case 14:
                return $this->getEmail();
                break;
            case 15:
                return $this->getWebsite();
                break;
            case 16:
                return $this->getCreatedAt();
                break;
            case 17:
                return $this->getUpdatedAt();
                break;
            case 18:
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
        if (isset($alreadyDumpedObjects['Event'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Event'][$this->getPrimaryKey()] = true;
        $keys = EventPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getCategory(),
            $keys[3] => $this->getAddress(),
            $keys[4] => $this->getAddress2(),
            $keys[5] => $this->getZipcode(),
            $keys[6] => $this->getCity(),
            $keys[7] => $this->getGeoCoordinateX(),
            $keys[8] => $this->getGeoCoordinateY(),
            $keys[9] => $this->getDistanceCamping(),
            $keys[10] => $this->getImage(),
            $keys[11] => $this->getPriority(),
            $keys[12] => $this->getTel(),
            $keys[13] => $this->getFax(),
            $keys[14] => $this->getEmail(),
            $keys[15] => $this->getWebsite(),
            $keys[16] => $this->getCreatedAt(),
            $keys[17] => $this->getUpdatedAt(),
            $keys[18] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collEtablissementEvents) {
                $result['EtablissementEvents'] = $this->collEtablissementEvents->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRegionEvents) {
                $result['RegionEvents'] = $this->collRegionEvents->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
                $this->setCode($value);
                break;
            case 2:
                $this->setCategory($value);
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
                $this->setGeoCoordinateX($value);
                break;
            case 8:
                $this->setGeoCoordinateY($value);
                break;
            case 9:
                $this->setDistanceCamping($value);
                break;
            case 10:
                $this->setImage($value);
                break;
            case 11:
                $this->setPriority($value);
                break;
            case 12:
                $this->setTel($value);
                break;
            case 13:
                $this->setFax($value);
                break;
            case 14:
                $this->setEmail($value);
                break;
            case 15:
                $this->setWebsite($value);
                break;
            case 16:
                $this->setCreatedAt($value);
                break;
            case 17:
                $this->setUpdatedAt($value);
                break;
            case 18:
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
        $keys = EventPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCategory($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAddress($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAddress2($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setZipcode($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCity($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setGeoCoordinateX($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setGeoCoordinateY($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setDistanceCamping($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setImage($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setPriority($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setTel($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setFax($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setEmail($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setWebsite($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setActive($arr[$keys[18]]);
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
        if ($this->isColumnModified(EventPeer::CODE)) $criteria->add(EventPeer::CODE, $this->code);
        if ($this->isColumnModified(EventPeer::CATEGORY)) $criteria->add(EventPeer::CATEGORY, $this->category);
        if ($this->isColumnModified(EventPeer::ADDRESS)) $criteria->add(EventPeer::ADDRESS, $this->address);
        if ($this->isColumnModified(EventPeer::ADDRESS2)) $criteria->add(EventPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(EventPeer::ZIPCODE)) $criteria->add(EventPeer::ZIPCODE, $this->zipcode);
        if ($this->isColumnModified(EventPeer::CITY)) $criteria->add(EventPeer::CITY, $this->city);
        if ($this->isColumnModified(EventPeer::GEO_COORDINATE_X)) $criteria->add(EventPeer::GEO_COORDINATE_X, $this->geo_coordinate_x);
        if ($this->isColumnModified(EventPeer::GEO_COORDINATE_Y)) $criteria->add(EventPeer::GEO_COORDINATE_Y, $this->geo_coordinate_y);
        if ($this->isColumnModified(EventPeer::DISTANCE_CAMPING)) $criteria->add(EventPeer::DISTANCE_CAMPING, $this->distance_camping);
        if ($this->isColumnModified(EventPeer::IMAGE)) $criteria->add(EventPeer::IMAGE, $this->image);
        if ($this->isColumnModified(EventPeer::PRIORITY)) $criteria->add(EventPeer::PRIORITY, $this->priority);
        if ($this->isColumnModified(EventPeer::TEL)) $criteria->add(EventPeer::TEL, $this->tel);
        if ($this->isColumnModified(EventPeer::FAX)) $criteria->add(EventPeer::FAX, $this->fax);
        if ($this->isColumnModified(EventPeer::EMAIL)) $criteria->add(EventPeer::EMAIL, $this->email);
        if ($this->isColumnModified(EventPeer::WEBSITE)) $criteria->add(EventPeer::WEBSITE, $this->website);
        if ($this->isColumnModified(EventPeer::CREATED_AT)) $criteria->add(EventPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(EventPeer::UPDATED_AT)) $criteria->add(EventPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(EventPeer::ACTIVE)) $criteria->add(EventPeer::ACTIVE, $this->active);

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
        $copyObj->setCode($this->getCode());
        $copyObj->setCategory($this->getCategory());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setZipcode($this->getZipcode());
        $copyObj->setCity($this->getCity());
        $copyObj->setGeoCoordinateX($this->getGeoCoordinateX());
        $copyObj->setGeoCoordinateY($this->getGeoCoordinateY());
        $copyObj->setDistanceCamping($this->getDistanceCamping());
        $copyObj->setImage($this->getImage());
        $copyObj->setPriority($this->getPriority());
        $copyObj->setTel($this->getTel());
        $copyObj->setFax($this->getFax());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setWebsite($this->getWebsite());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setActive($this->getActive());

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

            foreach ($this->getRegionEvents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRegionEvent($relObj->copy($deepCopy));
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
        if ('RegionEvent' == $relationName) {
            $this->initRegionEvents();
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
     * @return Event The current object (for fluent API support)
     * @see        addEtablissementEvents()
     */
    public function clearEtablissementEvents()
    {
        $this->collEtablissementEvents = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementEventsPartial = null;

        return $this;
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
     * @return Event The current object (for fluent API support)
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

        return $this;
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
            }

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

        return count($this->collEtablissementEvents);
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
     * @return Event The current object (for fluent API support)
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

        return $this;
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
     * Clears out the collRegionEvents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addRegionEvents()
     */
    public function clearRegionEvents()
    {
        $this->collRegionEvents = null; // important to set this to null since that means it is uninitialized
        $this->collRegionEventsPartial = null;

        return $this;
    }

    /**
     * reset is the collRegionEvents collection loaded partially
     *
     * @return void
     */
    public function resetPartialRegionEvents($v = true)
    {
        $this->collRegionEventsPartial = $v;
    }

    /**
     * Initializes the collRegionEvents collection.
     *
     * By default this just sets the collRegionEvents collection to an empty array (like clearcollRegionEvents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRegionEvents($overrideExisting = true)
    {
        if (null !== $this->collRegionEvents && !$overrideExisting) {
            return;
        }
        $this->collRegionEvents = new PropelObjectCollection();
        $this->collRegionEvents->setModel('RegionEvent');
    }

    /**
     * Gets an array of RegionEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|RegionEvent[] List of RegionEvent objects
     * @throws PropelException
     */
    public function getRegionEvents($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRegionEventsPartial && !$this->isNew();
        if (null === $this->collRegionEvents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRegionEvents) {
                // return empty collection
                $this->initRegionEvents();
            } else {
                $collRegionEvents = RegionEventQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRegionEventsPartial && count($collRegionEvents)) {
                      $this->initRegionEvents(false);

                      foreach($collRegionEvents as $obj) {
                        if (false == $this->collRegionEvents->contains($obj)) {
                          $this->collRegionEvents->append($obj);
                        }
                      }

                      $this->collRegionEventsPartial = true;
                    }

                    return $collRegionEvents;
                }

                if($partial && $this->collRegionEvents) {
                    foreach($this->collRegionEvents as $obj) {
                        if($obj->isNew()) {
                            $collRegionEvents[] = $obj;
                        }
                    }
                }

                $this->collRegionEvents = $collRegionEvents;
                $this->collRegionEventsPartial = false;
            }
        }

        return $this->collRegionEvents;
    }

    /**
     * Sets a collection of RegionEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $regionEvents A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setRegionEvents(PropelCollection $regionEvents, PropelPDO $con = null)
    {
        $this->regionEventsScheduledForDeletion = $this->getRegionEvents(new Criteria(), $con)->diff($regionEvents);

        foreach ($this->regionEventsScheduledForDeletion as $regionEventRemoved) {
            $regionEventRemoved->setEvent(null);
        }

        $this->collRegionEvents = null;
        foreach ($regionEvents as $regionEvent) {
            $this->addRegionEvent($regionEvent);
        }

        $this->collRegionEvents = $regionEvents;
        $this->collRegionEventsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RegionEvent objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related RegionEvent objects.
     * @throws PropelException
     */
    public function countRegionEvents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRegionEventsPartial && !$this->isNew();
        if (null === $this->collRegionEvents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegionEvents) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRegionEvents());
            }
            $query = RegionEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEvent($this)
                ->count($con);
        }

        return count($this->collRegionEvents);
    }

    /**
     * Method called to associate a RegionEvent object to this object
     * through the RegionEvent foreign key attribute.
     *
     * @param    RegionEvent $l RegionEvent
     * @return Event The current object (for fluent API support)
     */
    public function addRegionEvent(RegionEvent $l)
    {
        if ($this->collRegionEvents === null) {
            $this->initRegionEvents();
            $this->collRegionEventsPartial = true;
        }
        if (!in_array($l, $this->collRegionEvents->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRegionEvent($l);
        }

        return $this;
    }

    /**
     * @param	RegionEvent $regionEvent The regionEvent object to add.
     */
    protected function doAddRegionEvent($regionEvent)
    {
        $this->collRegionEvents[]= $regionEvent;
        $regionEvent->setEvent($this);
    }

    /**
     * @param	RegionEvent $regionEvent The regionEvent object to remove.
     * @return Event The current object (for fluent API support)
     */
    public function removeRegionEvent($regionEvent)
    {
        if ($this->getRegionEvents()->contains($regionEvent)) {
            $this->collRegionEvents->remove($this->collRegionEvents->search($regionEvent));
            if (null === $this->regionEventsScheduledForDeletion) {
                $this->regionEventsScheduledForDeletion = clone $this->collRegionEvents;
                $this->regionEventsScheduledForDeletion->clear();
            }
            $this->regionEventsScheduledForDeletion[]= $regionEvent;
            $regionEvent->setEvent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related RegionEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|RegionEvent[] List of RegionEvent objects
     */
    public function getRegionEventsJoinRegion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RegionEventQuery::create(null, $criteria);
        $query->joinWith('Region', $join_behavior);

        return $this->getRegionEvents($query, $con);
    }

    /**
     * Clears out the collEventI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addEventI18ns()
     */
    public function clearEventI18ns()
    {
        $this->collEventI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collEventI18nsPartial = null;

        return $this;
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
     * @return Event The current object (for fluent API support)
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

        return $this;
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
            }

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

        return count($this->collEventI18ns);
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
     * @return Event The current object (for fluent API support)
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

        return $this;
    }

    /**
     * Clears out the collEtablissements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
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
     * @return Event The current object (for fluent API support)
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
     * @return Event The current object (for fluent API support)
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
        $etablissementEvent = new EtablissementEvent();
        $etablissementEvent->setEtablissement($etablissement);
        $this->addEtablissementEvent($etablissementEvent);
    }

    /**
     * Remove a Etablissement object to this object
     * through the etablissement_event cross reference table.
     *
     * @param Etablissement $etablissement The EtablissementEvent object to relate
     * @return Event The current object (for fluent API support)
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
     * Clears out the collRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addRegions()
     */
    public function clearRegions()
    {
        $this->collRegions = null; // important to set this to null since that means it is uninitialized
        $this->collRegionsPartial = null;

        return $this;
    }

    /**
     * Initializes the collRegions collection.
     *
     * By default this just sets the collRegions collection to an empty collection (like clearRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initRegions()
    {
        $this->collRegions = new PropelObjectCollection();
        $this->collRegions->setModel('Region');
    }

    /**
     * Gets a collection of Region objects related by a many-to-many relationship
     * to the current object by way of the region_event cross-reference table.
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
     * @return PropelObjectCollection|Region[] List of Region objects
     */
    public function getRegions($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collRegions || null !== $criteria) {
            if ($this->isNew() && null === $this->collRegions) {
                // return empty collection
                $this->initRegions();
            } else {
                $collRegions = RegionQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collRegions;
                }
                $this->collRegions = $collRegions;
            }
        }

        return $this->collRegions;
    }

    /**
     * Sets a collection of Region objects related by a many-to-many relationship
     * to the current object by way of the region_event cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $regions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setRegions(PropelCollection $regions, PropelPDO $con = null)
    {
        $this->clearRegions();
        $currentRegions = $this->getRegions();

        $this->regionsScheduledForDeletion = $currentRegions->diff($regions);

        foreach ($regions as $region) {
            if (!$currentRegions->contains($region)) {
                $this->doAddRegion($region);
            }
        }

        $this->collRegions = $regions;

        return $this;
    }

    /**
     * Gets the number of Region objects related by a many-to-many relationship
     * to the current object by way of the region_event cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Region objects
     */
    public function countRegions($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collRegions || null !== $criteria) {
            if ($this->isNew() && null === $this->collRegions) {
                return 0;
            } else {
                $query = RegionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEvent($this)
                    ->count($con);
            }
        } else {
            return count($this->collRegions);
        }
    }

    /**
     * Associate a Region object to this object
     * through the region_event cross reference table.
     *
     * @param  Region $region The RegionEvent object to relate
     * @return Event The current object (for fluent API support)
     */
    public function addRegion(Region $region)
    {
        if ($this->collRegions === null) {
            $this->initRegions();
        }
        if (!$this->collRegions->contains($region)) { // only add it if the **same** object is not already associated
            $this->doAddRegion($region);

            $this->collRegions[]= $region;
        }

        return $this;
    }

    /**
     * @param	Region $region The region object to add.
     */
    protected function doAddRegion($region)
    {
        $regionEvent = new RegionEvent();
        $regionEvent->setRegion($region);
        $this->addRegionEvent($regionEvent);
    }

    /**
     * Remove a Region object to this object
     * through the region_event cross reference table.
     *
     * @param Region $region The RegionEvent object to relate
     * @return Event The current object (for fluent API support)
     */
    public function removeRegion(Region $region)
    {
        if ($this->getRegions()->contains($region)) {
            $this->collRegions->remove($this->collRegions->search($region));
            if (null === $this->regionsScheduledForDeletion) {
                $this->regionsScheduledForDeletion = clone $this->collRegions;
                $this->regionsScheduledForDeletion->clear();
            }
            $this->regionsScheduledForDeletion[]= $region;
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
        $this->category = null;
        $this->address = null;
        $this->address2 = null;
        $this->zipcode = null;
        $this->city = null;
        $this->geo_coordinate_x = null;
        $this->geo_coordinate_y = null;
        $this->distance_camping = null;
        $this->image = null;
        $this->priority = null;
        $this->tel = null;
        $this->fax = null;
        $this->email = null;
        $this->website = null;
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
            if ($this->collEtablissementEvents) {
                foreach ($this->collEtablissementEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRegionEvents) {
                foreach ($this->collRegionEvents as $o) {
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
            if ($this->collRegions) {
                foreach ($this->collRegions as $o) {
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
        if ($this->collRegionEvents instanceof PropelCollection) {
            $this->collRegionEvents->clearIterator();
        }
        $this->collRegionEvents = null;
        if ($this->collEventI18ns instanceof PropelCollection) {
            $this->collEventI18ns->clearIterator();
        }
        $this->collEventI18ns = null;
        if ($this->collEtablissements instanceof PropelCollection) {
            $this->collEtablissements->clearIterator();
        }
        $this->collEtablissements = null;
        if ($this->collRegions instanceof PropelCollection) {
            $this->collRegions->clearIterator();
        }
        $this->collRegions = null;
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

    public function getEtablissementsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\EtablissementPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\EtablissementPeer::ID, \Cungfoo\Model\EtablissementI18nPeer::alias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\EtablissementI18nPeer::alias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\EtablissementI18nPeer::alias('i18n_locale', \Cungfoo\Model\EtablissementI18nPeer::LOCALE), $this->currentLocale);

        return $this->getEtablissements($criteria, $con);
    }

    public function getRegionsActive($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(\Cungfoo\Model\RegionPeer::ACTIVE, true);


        $criteria->addAlias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::TABLE_NAME);
        $criteria->addJoin(\Cungfoo\Model\RegionPeer::ID, \Cungfoo\Model\RegionI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::ID), \Criteria::LEFT_JOIN);
        $criteria->add(\Cungfoo\Model\RegionI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::ACTIVE_LOCALE), true);
        $criteria->add(\Cungfoo\Model\RegionI18nPeer::alias('i18n_locale', \Cungfoo\Model\RegionI18nPeer::LOCALE), $this->currentLocale);

        return $this->getRegions($criteria, $con);
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
         * @return EventI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
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


        /**
         * Get the [subtitle] column value.
         *
         * @return string
         */
        public function getSubtitle()
        {
        return $this->getCurrentTranslation()->getSubtitle();
    }


        /**
         * Set the value of [subtitle] column.
         *
         * @param string $v new value
         * @return EventI18n The current object (for fluent API support)
         */
        public function setSubtitle($v)
        {    $this->getCurrentTranslation()->setSubtitle($v);

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
         * @return EventI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }


        /**
         * Get the [transport] column value.
         *
         * @return string
         */
        public function getTransport()
        {
        return $this->getCurrentTranslation()->getTransport();
    }


        /**
         * Set the value of [transport] column.
         *
         * @param string $v new value
         * @return EventI18n The current object (for fluent API support)
         */
        public function setTransport($v)
        {    $this->getCurrentTranslation()->setTransport($v);

        return $this;
    }
    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->getCurrentTranslation()->getSlug() ?: 'n-a';
    }



        /**
         * Set the value of [slug] column.
         *
         * @param string $v new value
         * @return EventI18n The current object (for fluent API support)
         */
        public function setSlug($v)
        {    $this->getCurrentTranslation()->setSlug($v);

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
         * @return EventI18n The current object (for fluent API support)
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
         * @return EventI18n The current object (for fluent API support)
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
         * @return EventI18n The current object (for fluent API support)
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
         * @return EventI18n The current object (for fluent API support)
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
         * @return EventI18n The current object (for fluent API support)
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
