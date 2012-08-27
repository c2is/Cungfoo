<?php

namespace Cungfoo\Model\om;

use \BaseObject;
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
use Cungfoo\Model\Camping;
use Cungfoo\Model\CampingActivite;
use Cungfoo\Model\CampingActiviteQuery;
use Cungfoo\Model\CampingDestination;
use Cungfoo\Model\CampingDestinationQuery;
use Cungfoo\Model\CampingEquipement;
use Cungfoo\Model\CampingEquipementQuery;
use Cungfoo\Model\CampingPeer;
use Cungfoo\Model\CampingQuery;
use Cungfoo\Model\CampingServiceComplementaire;
use Cungfoo\Model\CampingServiceComplementaireQuery;
use Cungfoo\Model\Destination;
use Cungfoo\Model\DestinationQuery;
use Cungfoo\Model\Equipement;
use Cungfoo\Model\EquipementQuery;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\ServiceComplementaireQuery;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementQuery;

/**
 * Base class that represents a row from the 'camping' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCamping extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\CampingPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        CampingPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the address1 field.
     * @var        string
     */
    protected $address1;

    /**
     * The value for the address2 field.
     * @var        string
     */
    protected $address2;

    /**
     * The value for the zip field.
     * @var        string
     */
    protected $zip;

    /**
     * The value for the city field.
     * @var        string
     */
    protected $city;

    /**
     * The value for the mail field.
     * @var        string
     */
    protected $mail;

    /**
     * The value for the country field.
     * @var        string
     */
    protected $country;

    /**
     * The value for the country_code field.
     * @var        string
     */
    protected $country_code;

    /**
     * The value for the phone1 field.
     * @var        string
     */
    protected $phone1;

    /**
     * The value for the phone2 field.
     * @var        string
     */
    protected $phone2;

    /**
     * The value for the fax field.
     * @var        string
     */
    protected $fax;

    /**
     * The value for the type_hebergement_id field.
     * @var        string
     */
    protected $type_hebergement_id;

    /**
     * The value for the ville_id field.
     * @var        string
     */
    protected $ville_id;

    /**
     * @var        TypeHebergement
     */
    protected $aTypeHebergement;

    /**
     * @var        PropelObjectCollection|CampingDestination[] Collection to store aggregation of CampingDestination objects.
     */
    protected $collCampingDestinations;
    protected $collCampingDestinationsPartial;

    /**
     * @var        PropelObjectCollection|CampingActivite[] Collection to store aggregation of CampingActivite objects.
     */
    protected $collCampingActivites;
    protected $collCampingActivitesPartial;

    /**
     * @var        PropelObjectCollection|CampingEquipement[] Collection to store aggregation of CampingEquipement objects.
     */
    protected $collCampingEquipements;
    protected $collCampingEquipementsPartial;

    /**
     * @var        PropelObjectCollection|CampingServiceComplementaire[] Collection to store aggregation of CampingServiceComplementaire objects.
     */
    protected $collCampingServiceComplementaires;
    protected $collCampingServiceComplementairesPartial;

    /**
     * @var        PropelObjectCollection|Destination[] Collection to store aggregation of Destination objects.
     */
    protected $collDestinations;

    /**
     * @var        PropelObjectCollection|Activite[] Collection to store aggregation of Activite objects.
     */
    protected $collActivites;

    /**
     * @var        PropelObjectCollection|Equipement[] Collection to store aggregation of Equipement objects.
     */
    protected $collEquipements;

    /**
     * @var        PropelObjectCollection|ServiceComplementaire[] Collection to store aggregation of ServiceComplementaire objects.
     */
    protected $collServiceComplementaires;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $destinationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $activitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $equipementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $serviceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $campingDestinationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $campingActivitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $campingEquipementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $campingServiceComplementairesScheduledForDeletion = null;

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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [address1] column value.
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
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
     * Get the [zip] column value.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
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
     * Get the [mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [country_code] column value.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Get the [phone1] column value.
     *
     * @return string
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Get the [phone2] column value.
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
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
     * Get the [type_hebergement_id] column value.
     *
     * @return string
     */
    public function getTypeHebergementId()
    {
        return $this->type_hebergement_id;
    }

    /**
     * Get the [ville_id] column value.
     *
     * @return string
     */
    public function getVilleId()
    {
        return $this->ville_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = CampingPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = CampingPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [address1] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address1 !== $v) {
            $this->address1 = $v;
            $this->modifiedColumns[] = CampingPeer::ADDRESS1;
        }


        return $this;
    } // setAddress1()

    /**
     * Set the value of [address2] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[] = CampingPeer::ADDRESS2;
        }


        return $this;
    } // setAddress2()

    /**
     * Set the value of [zip] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setZip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip !== $v) {
            $this->zip = $v;
            $this->modifiedColumns[] = CampingPeer::ZIP;
        }


        return $this;
    } // setZip()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = CampingPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[] = CampingPeer::MAIL;
        }


        return $this;
    } // setMail()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[] = CampingPeer::COUNTRY;
        }


        return $this;
    } // setCountry()

    /**
     * Set the value of [country_code] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setCountryCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country_code !== $v) {
            $this->country_code = $v;
            $this->modifiedColumns[] = CampingPeer::COUNTRY_CODE;
        }


        return $this;
    } // setCountryCode()

    /**
     * Set the value of [phone1] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setPhone1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone1 !== $v) {
            $this->phone1 = $v;
            $this->modifiedColumns[] = CampingPeer::PHONE1;
        }


        return $this;
    } // setPhone1()

    /**
     * Set the value of [phone2] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setPhone2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone2 !== $v) {
            $this->phone2 = $v;
            $this->modifiedColumns[] = CampingPeer::PHONE2;
        }


        return $this;
    } // setPhone2()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[] = CampingPeer::FAX;
        }


        return $this;
    } // setFax()

    /**
     * Set the value of [type_hebergement_id] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setTypeHebergementId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type_hebergement_id !== $v) {
            $this->type_hebergement_id = $v;
            $this->modifiedColumns[] = CampingPeer::TYPE_HEBERGEMENT_ID;
        }

        if ($this->aTypeHebergement !== null && $this->aTypeHebergement->getId() !== $v) {
            $this->aTypeHebergement = null;
        }


        return $this;
    } // setTypeHebergementId()

    /**
     * Set the value of [ville_id] column.
     *
     * @param string $v new value
     * @return Camping The current object (for fluent API support)
     */
    public function setVilleId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ville_id !== $v) {
            $this->ville_id = $v;
            $this->modifiedColumns[] = CampingPeer::VILLE_ID;
        }


        return $this;
    } // setVilleId()

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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->address1 = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->address2 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->zip = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->city = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->mail = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->country = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->country_code = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->phone1 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->phone2 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->fax = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->type_hebergement_id = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->ville_id = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = CampingPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Camping object", $e);
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

        if ($this->aTypeHebergement !== null && $this->type_hebergement_id !== $this->aTypeHebergement->getId()) {
            $this->aTypeHebergement = null;
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
            $con = Propel::getConnection(CampingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = CampingPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTypeHebergement = null;
            $this->collCampingDestinations = null;

            $this->collCampingActivites = null;

            $this->collCampingEquipements = null;

            $this->collCampingServiceComplementaires = null;

            $this->collDestinations = null;
            $this->collActivites = null;
            $this->collEquipements = null;
            $this->collServiceComplementaires = null;
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
            $con = Propel::getConnection(CampingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = CampingQuery::create()
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
            $con = Propel::getConnection(CampingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                CampingPeer::addInstanceToPool($this);
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

            if ($this->aTypeHebergement !== null) {
                if ($this->aTypeHebergement->isModified() || $this->aTypeHebergement->isNew()) {
                    $affectedRows += $this->aTypeHebergement->save($con);
                }
                $this->setTypeHebergement($this->aTypeHebergement);
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

            if ($this->destinationsScheduledForDeletion !== null) {
                if (!$this->destinationsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->destinationsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    CampingDestinationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->destinationsScheduledForDeletion = null;
                }

                foreach ($this->getDestinations() as $destination) {
                    if ($destination->isModified()) {
                        $destination->save($con);
                    }
                }
            }

            if ($this->activitesScheduledForDeletion !== null) {
                if (!$this->activitesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->activitesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    CampingActiviteQuery::create()
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

            if ($this->equipementsScheduledForDeletion !== null) {
                if (!$this->equipementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->equipementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    CampingEquipementQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->equipementsScheduledForDeletion = null;
                }

                foreach ($this->getEquipements() as $equipement) {
                    if ($equipement->isModified()) {
                        $equipement->save($con);
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
                    CampingServiceComplementaireQuery::create()
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

            if ($this->campingDestinationsScheduledForDeletion !== null) {
                if (!$this->campingDestinationsScheduledForDeletion->isEmpty()) {
                    CampingDestinationQuery::create()
                        ->filterByPrimaryKeys($this->campingDestinationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->campingDestinationsScheduledForDeletion = null;
                }
            }

            if ($this->collCampingDestinations !== null) {
                foreach ($this->collCampingDestinations as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->campingActivitesScheduledForDeletion !== null) {
                if (!$this->campingActivitesScheduledForDeletion->isEmpty()) {
                    CampingActiviteQuery::create()
                        ->filterByPrimaryKeys($this->campingActivitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->campingActivitesScheduledForDeletion = null;
                }
            }

            if ($this->collCampingActivites !== null) {
                foreach ($this->collCampingActivites as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->campingEquipementsScheduledForDeletion !== null) {
                if (!$this->campingEquipementsScheduledForDeletion->isEmpty()) {
                    CampingEquipementQuery::create()
                        ->filterByPrimaryKeys($this->campingEquipementsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->campingEquipementsScheduledForDeletion = null;
                }
            }

            if ($this->collCampingEquipements !== null) {
                foreach ($this->collCampingEquipements as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->campingServiceComplementairesScheduledForDeletion !== null) {
                if (!$this->campingServiceComplementairesScheduledForDeletion->isEmpty()) {
                    CampingServiceComplementaireQuery::create()
                        ->filterByPrimaryKeys($this->campingServiceComplementairesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->campingServiceComplementairesScheduledForDeletion = null;
                }
            }

            if ($this->collCampingServiceComplementaires !== null) {
                foreach ($this->collCampingServiceComplementaires as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CampingPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(CampingPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(CampingPeer::ADDRESS1)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS1`';
        }
        if ($this->isColumnModified(CampingPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS2`';
        }
        if ($this->isColumnModified(CampingPeer::ZIP)) {
            $modifiedColumns[':p' . $index++]  = '`ZIP`';
        }
        if ($this->isColumnModified(CampingPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`CITY`';
        }
        if ($this->isColumnModified(CampingPeer::MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`MAIL`';
        }
        if ($this->isColumnModified(CampingPeer::COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY`';
        }
        if ($this->isColumnModified(CampingPeer::COUNTRY_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY_CODE`';
        }
        if ($this->isColumnModified(CampingPeer::PHONE1)) {
            $modifiedColumns[':p' . $index++]  = '`PHONE1`';
        }
        if ($this->isColumnModified(CampingPeer::PHONE2)) {
            $modifiedColumns[':p' . $index++]  = '`PHONE2`';
        }
        if ($this->isColumnModified(CampingPeer::FAX)) {
            $modifiedColumns[':p' . $index++]  = '`FAX`';
        }
        if ($this->isColumnModified(CampingPeer::TYPE_HEBERGEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`TYPE_HEBERGEMENT_ID`';
        }
        if ($this->isColumnModified(CampingPeer::VILLE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`VILLE_ID`';
        }

        $sql = sprintf(
            'INSERT INTO `camping` (%s) VALUES (%s)',
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
                    case '`NAME`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`ADDRESS1`':
                        $stmt->bindValue($identifier, $this->address1, PDO::PARAM_STR);
                        break;
                    case '`ADDRESS2`':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);
                        break;
                    case '`ZIP`':
                        $stmt->bindValue($identifier, $this->zip, PDO::PARAM_STR);
                        break;
                    case '`CITY`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`MAIL`':
                        $stmt->bindValue($identifier, $this->mail, PDO::PARAM_STR);
                        break;
                    case '`COUNTRY`':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case '`COUNTRY_CODE`':
                        $stmt->bindValue($identifier, $this->country_code, PDO::PARAM_STR);
                        break;
                    case '`PHONE1`':
                        $stmt->bindValue($identifier, $this->phone1, PDO::PARAM_STR);
                        break;
                    case '`PHONE2`':
                        $stmt->bindValue($identifier, $this->phone2, PDO::PARAM_STR);
                        break;
                    case '`FAX`':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);
                        break;
                    case '`TYPE_HEBERGEMENT_ID`':
                        $stmt->bindValue($identifier, $this->type_hebergement_id, PDO::PARAM_STR);
                        break;
                    case '`VILLE_ID`':
                        $stmt->bindValue($identifier, $this->ville_id, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTypeHebergement !== null) {
                if (!$this->aTypeHebergement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeHebergement->getValidationFailures());
                }
            }


            if (($retval = CampingPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collCampingDestinations !== null) {
                    foreach ($this->collCampingDestinations as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCampingActivites !== null) {
                    foreach ($this->collCampingActivites as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCampingEquipements !== null) {
                    foreach ($this->collCampingEquipements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCampingServiceComplementaires !== null) {
                    foreach ($this->collCampingServiceComplementaires as $referrerFK) {
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
        $pos = CampingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getAddress1();
                break;
            case 3:
                return $this->getAddress2();
                break;
            case 4:
                return $this->getZip();
                break;
            case 5:
                return $this->getCity();
                break;
            case 6:
                return $this->getMail();
                break;
            case 7:
                return $this->getCountry();
                break;
            case 8:
                return $this->getCountryCode();
                break;
            case 9:
                return $this->getPhone1();
                break;
            case 10:
                return $this->getPhone2();
                break;
            case 11:
                return $this->getFax();
                break;
            case 12:
                return $this->getTypeHebergementId();
                break;
            case 13:
                return $this->getVilleId();
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
        if (isset($alreadyDumpedObjects['Camping'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Camping'][$this->getPrimaryKey()] = true;
        $keys = CampingPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getAddress1(),
            $keys[3] => $this->getAddress2(),
            $keys[4] => $this->getZip(),
            $keys[5] => $this->getCity(),
            $keys[6] => $this->getMail(),
            $keys[7] => $this->getCountry(),
            $keys[8] => $this->getCountryCode(),
            $keys[9] => $this->getPhone1(),
            $keys[10] => $this->getPhone2(),
            $keys[11] => $this->getFax(),
            $keys[12] => $this->getTypeHebergementId(),
            $keys[13] => $this->getVilleId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTypeHebergement) {
                $result['TypeHebergement'] = $this->aTypeHebergement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCampingDestinations) {
                $result['CampingDestinations'] = $this->collCampingDestinations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCampingActivites) {
                $result['CampingActivites'] = $this->collCampingActivites->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCampingEquipements) {
                $result['CampingEquipements'] = $this->collCampingEquipements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCampingServiceComplementaires) {
                $result['CampingServiceComplementaires'] = $this->collCampingServiceComplementaires->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = CampingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
                $this->setAddress1($value);
                break;
            case 3:
                $this->setAddress2($value);
                break;
            case 4:
                $this->setZip($value);
                break;
            case 5:
                $this->setCity($value);
                break;
            case 6:
                $this->setMail($value);
                break;
            case 7:
                $this->setCountry($value);
                break;
            case 8:
                $this->setCountryCode($value);
                break;
            case 9:
                $this->setPhone1($value);
                break;
            case 10:
                $this->setPhone2($value);
                break;
            case 11:
                $this->setFax($value);
                break;
            case 12:
                $this->setTypeHebergementId($value);
                break;
            case 13:
                $this->setVilleId($value);
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
        $keys = CampingPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAddress1($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAddress2($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setZip($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCity($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setMail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCountry($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCountryCode($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setPhone1($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setPhone2($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setFax($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setTypeHebergementId($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setVilleId($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CampingPeer::DATABASE_NAME);

        if ($this->isColumnModified(CampingPeer::ID)) $criteria->add(CampingPeer::ID, $this->id);
        if ($this->isColumnModified(CampingPeer::NAME)) $criteria->add(CampingPeer::NAME, $this->name);
        if ($this->isColumnModified(CampingPeer::ADDRESS1)) $criteria->add(CampingPeer::ADDRESS1, $this->address1);
        if ($this->isColumnModified(CampingPeer::ADDRESS2)) $criteria->add(CampingPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(CampingPeer::ZIP)) $criteria->add(CampingPeer::ZIP, $this->zip);
        if ($this->isColumnModified(CampingPeer::CITY)) $criteria->add(CampingPeer::CITY, $this->city);
        if ($this->isColumnModified(CampingPeer::MAIL)) $criteria->add(CampingPeer::MAIL, $this->mail);
        if ($this->isColumnModified(CampingPeer::COUNTRY)) $criteria->add(CampingPeer::COUNTRY, $this->country);
        if ($this->isColumnModified(CampingPeer::COUNTRY_CODE)) $criteria->add(CampingPeer::COUNTRY_CODE, $this->country_code);
        if ($this->isColumnModified(CampingPeer::PHONE1)) $criteria->add(CampingPeer::PHONE1, $this->phone1);
        if ($this->isColumnModified(CampingPeer::PHONE2)) $criteria->add(CampingPeer::PHONE2, $this->phone2);
        if ($this->isColumnModified(CampingPeer::FAX)) $criteria->add(CampingPeer::FAX, $this->fax);
        if ($this->isColumnModified(CampingPeer::TYPE_HEBERGEMENT_ID)) $criteria->add(CampingPeer::TYPE_HEBERGEMENT_ID, $this->type_hebergement_id);
        if ($this->isColumnModified(CampingPeer::VILLE_ID)) $criteria->add(CampingPeer::VILLE_ID, $this->ville_id);

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
        $criteria = new Criteria(CampingPeer::DATABASE_NAME);
        $criteria->add(CampingPeer::ID, $this->id);

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
     * @param object $copyObj An object of Camping (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setZip($this->getZip());
        $copyObj->setCity($this->getCity());
        $copyObj->setMail($this->getMail());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setCountryCode($this->getCountryCode());
        $copyObj->setPhone1($this->getPhone1());
        $copyObj->setPhone2($this->getPhone2());
        $copyObj->setFax($this->getFax());
        $copyObj->setTypeHebergementId($this->getTypeHebergementId());
        $copyObj->setVilleId($this->getVilleId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getCampingDestinations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCampingDestination($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCampingActivites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCampingActivite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCampingEquipements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCampingEquipement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCampingServiceComplementaires() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCampingServiceComplementaire($relObj->copy($deepCopy));
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
     * @return Camping Clone of current object.
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
     * @return CampingPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new CampingPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TypeHebergement object.
     *
     * @param             TypeHebergement $v
     * @return Camping The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTypeHebergement(TypeHebergement $v = null)
    {
        if ($v === null) {
            $this->setTypeHebergementId(NULL);
        } else {
            $this->setTypeHebergementId($v->getId());
        }

        $this->aTypeHebergement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TypeHebergement object, it will not be re-added.
        if ($v !== null) {
            $v->addCamping($this);
        }


        return $this;
    }


    /**
     * Get the associated TypeHebergement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TypeHebergement The associated TypeHebergement object.
     * @throws PropelException
     */
    public function getTypeHebergement(PropelPDO $con = null)
    {
        if ($this->aTypeHebergement === null && (($this->type_hebergement_id !== "" && $this->type_hebergement_id !== null))) {
            $this->aTypeHebergement = TypeHebergementQuery::create()->findPk($this->type_hebergement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypeHebergement->addCampings($this);
             */
        }

        return $this->aTypeHebergement;
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
        if ('CampingDestination' == $relationName) {
            $this->initCampingDestinations();
        }
        if ('CampingActivite' == $relationName) {
            $this->initCampingActivites();
        }
        if ('CampingEquipement' == $relationName) {
            $this->initCampingEquipements();
        }
        if ('CampingServiceComplementaire' == $relationName) {
            $this->initCampingServiceComplementaires();
        }
    }

    /**
     * Clears out the collCampingDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCampingDestinations()
     */
    public function clearCampingDestinations()
    {
        $this->collCampingDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collCampingDestinationsPartial = null;
    }

    /**
     * reset is the collCampingDestinations collection loaded partially
     *
     * @return void
     */
    public function resetPartialCampingDestinations($v = true)
    {
        $this->collCampingDestinationsPartial = $v;
    }

    /**
     * Initializes the collCampingDestinations collection.
     *
     * By default this just sets the collCampingDestinations collection to an empty array (like clearcollCampingDestinations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCampingDestinations($overrideExisting = true)
    {
        if (null !== $this->collCampingDestinations && !$overrideExisting) {
            return;
        }
        $this->collCampingDestinations = new PropelObjectCollection();
        $this->collCampingDestinations->setModel('CampingDestination');
    }

    /**
     * Gets an array of CampingDestination objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CampingDestination[] List of CampingDestination objects
     * @throws PropelException
     */
    public function getCampingDestinations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCampingDestinationsPartial && !$this->isNew();
        if (null === $this->collCampingDestinations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCampingDestinations) {
                // return empty collection
                $this->initCampingDestinations();
            } else {
                $collCampingDestinations = CampingDestinationQuery::create(null, $criteria)
                    ->filterByCamping($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCampingDestinationsPartial && count($collCampingDestinations)) {
                      $this->initCampingDestinations(false);

                      foreach($collCampingDestinations as $obj) {
                        if (false == $this->collCampingDestinations->contains($obj)) {
                          $this->collCampingDestinations->append($obj);
                        }
                      }

                      $this->collCampingDestinationsPartial = true;
                    }

                    return $collCampingDestinations;
                }

                if($partial && $this->collCampingDestinations) {
                    foreach($this->collCampingDestinations as $obj) {
                        if($obj->isNew()) {
                            $collCampingDestinations[] = $obj;
                        }
                    }
                }

                $this->collCampingDestinations = $collCampingDestinations;
                $this->collCampingDestinationsPartial = false;
            }
        }

        return $this->collCampingDestinations;
    }

    /**
     * Sets a collection of CampingDestination objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $campingDestinations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCampingDestinations(PropelCollection $campingDestinations, PropelPDO $con = null)
    {
        $this->campingDestinationsScheduledForDeletion = $this->getCampingDestinations(new Criteria(), $con)->diff($campingDestinations);

        foreach ($this->campingDestinationsScheduledForDeletion as $campingDestinationRemoved) {
            $campingDestinationRemoved->setCamping(null);
        }

        $this->collCampingDestinations = null;
        foreach ($campingDestinations as $campingDestination) {
            $this->addCampingDestination($campingDestination);
        }

        $this->collCampingDestinations = $campingDestinations;
        $this->collCampingDestinationsPartial = false;
    }

    /**
     * Returns the number of related CampingDestination objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CampingDestination objects.
     * @throws PropelException
     */
    public function countCampingDestinations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCampingDestinationsPartial && !$this->isNew();
        if (null === $this->collCampingDestinations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCampingDestinations) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCampingDestinations());
                }
                $query = CampingDestinationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collCampingDestinations);
        }
    }

    /**
     * Method called to associate a CampingDestination object to this object
     * through the CampingDestination foreign key attribute.
     *
     * @param    CampingDestination $l CampingDestination
     * @return Camping The current object (for fluent API support)
     */
    public function addCampingDestination(CampingDestination $l)
    {
        if ($this->collCampingDestinations === null) {
            $this->initCampingDestinations();
            $this->collCampingDestinationsPartial = true;
        }
        if (!in_array($l, $this->collCampingDestinations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCampingDestination($l);
        }

        return $this;
    }

    /**
     * @param	CampingDestination $campingDestination The campingDestination object to add.
     */
    protected function doAddCampingDestination($campingDestination)
    {
        $this->collCampingDestinations[]= $campingDestination;
        $campingDestination->setCamping($this);
    }

    /**
     * @param	CampingDestination $campingDestination The campingDestination object to remove.
     */
    public function removeCampingDestination($campingDestination)
    {
        if ($this->getCampingDestinations()->contains($campingDestination)) {
            $this->collCampingDestinations->remove($this->collCampingDestinations->search($campingDestination));
            if (null === $this->campingDestinationsScheduledForDeletion) {
                $this->campingDestinationsScheduledForDeletion = clone $this->collCampingDestinations;
                $this->campingDestinationsScheduledForDeletion->clear();
            }
            $this->campingDestinationsScheduledForDeletion[]= $campingDestination;
            $campingDestination->setCamping(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Camping is new, it will return
     * an empty collection; or if this Camping has previously
     * been saved, it will retrieve related CampingDestinations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Camping.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CampingDestination[] List of CampingDestination objects
     */
    public function getCampingDestinationsJoinDestination($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CampingDestinationQuery::create(null, $criteria);
        $query->joinWith('Destination', $join_behavior);

        return $this->getCampingDestinations($query, $con);
    }

    /**
     * Clears out the collCampingActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCampingActivites()
     */
    public function clearCampingActivites()
    {
        $this->collCampingActivites = null; // important to set this to null since that means it is uninitialized
        $this->collCampingActivitesPartial = null;
    }

    /**
     * reset is the collCampingActivites collection loaded partially
     *
     * @return void
     */
    public function resetPartialCampingActivites($v = true)
    {
        $this->collCampingActivitesPartial = $v;
    }

    /**
     * Initializes the collCampingActivites collection.
     *
     * By default this just sets the collCampingActivites collection to an empty array (like clearcollCampingActivites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCampingActivites($overrideExisting = true)
    {
        if (null !== $this->collCampingActivites && !$overrideExisting) {
            return;
        }
        $this->collCampingActivites = new PropelObjectCollection();
        $this->collCampingActivites->setModel('CampingActivite');
    }

    /**
     * Gets an array of CampingActivite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CampingActivite[] List of CampingActivite objects
     * @throws PropelException
     */
    public function getCampingActivites($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCampingActivitesPartial && !$this->isNew();
        if (null === $this->collCampingActivites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCampingActivites) {
                // return empty collection
                $this->initCampingActivites();
            } else {
                $collCampingActivites = CampingActiviteQuery::create(null, $criteria)
                    ->filterByCamping($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCampingActivitesPartial && count($collCampingActivites)) {
                      $this->initCampingActivites(false);

                      foreach($collCampingActivites as $obj) {
                        if (false == $this->collCampingActivites->contains($obj)) {
                          $this->collCampingActivites->append($obj);
                        }
                      }

                      $this->collCampingActivitesPartial = true;
                    }

                    return $collCampingActivites;
                }

                if($partial && $this->collCampingActivites) {
                    foreach($this->collCampingActivites as $obj) {
                        if($obj->isNew()) {
                            $collCampingActivites[] = $obj;
                        }
                    }
                }

                $this->collCampingActivites = $collCampingActivites;
                $this->collCampingActivitesPartial = false;
            }
        }

        return $this->collCampingActivites;
    }

    /**
     * Sets a collection of CampingActivite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $campingActivites A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCampingActivites(PropelCollection $campingActivites, PropelPDO $con = null)
    {
        $this->campingActivitesScheduledForDeletion = $this->getCampingActivites(new Criteria(), $con)->diff($campingActivites);

        foreach ($this->campingActivitesScheduledForDeletion as $campingActiviteRemoved) {
            $campingActiviteRemoved->setCamping(null);
        }

        $this->collCampingActivites = null;
        foreach ($campingActivites as $campingActivite) {
            $this->addCampingActivite($campingActivite);
        }

        $this->collCampingActivites = $campingActivites;
        $this->collCampingActivitesPartial = false;
    }

    /**
     * Returns the number of related CampingActivite objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CampingActivite objects.
     * @throws PropelException
     */
    public function countCampingActivites(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCampingActivitesPartial && !$this->isNew();
        if (null === $this->collCampingActivites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCampingActivites) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCampingActivites());
                }
                $query = CampingActiviteQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collCampingActivites);
        }
    }

    /**
     * Method called to associate a CampingActivite object to this object
     * through the CampingActivite foreign key attribute.
     *
     * @param    CampingActivite $l CampingActivite
     * @return Camping The current object (for fluent API support)
     */
    public function addCampingActivite(CampingActivite $l)
    {
        if ($this->collCampingActivites === null) {
            $this->initCampingActivites();
            $this->collCampingActivitesPartial = true;
        }
        if (!in_array($l, $this->collCampingActivites->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCampingActivite($l);
        }

        return $this;
    }

    /**
     * @param	CampingActivite $campingActivite The campingActivite object to add.
     */
    protected function doAddCampingActivite($campingActivite)
    {
        $this->collCampingActivites[]= $campingActivite;
        $campingActivite->setCamping($this);
    }

    /**
     * @param	CampingActivite $campingActivite The campingActivite object to remove.
     */
    public function removeCampingActivite($campingActivite)
    {
        if ($this->getCampingActivites()->contains($campingActivite)) {
            $this->collCampingActivites->remove($this->collCampingActivites->search($campingActivite));
            if (null === $this->campingActivitesScheduledForDeletion) {
                $this->campingActivitesScheduledForDeletion = clone $this->collCampingActivites;
                $this->campingActivitesScheduledForDeletion->clear();
            }
            $this->campingActivitesScheduledForDeletion[]= $campingActivite;
            $campingActivite->setCamping(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Camping is new, it will return
     * an empty collection; or if this Camping has previously
     * been saved, it will retrieve related CampingActivites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Camping.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CampingActivite[] List of CampingActivite objects
     */
    public function getCampingActivitesJoinActivite($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CampingActiviteQuery::create(null, $criteria);
        $query->joinWith('Activite', $join_behavior);

        return $this->getCampingActivites($query, $con);
    }

    /**
     * Clears out the collCampingEquipements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCampingEquipements()
     */
    public function clearCampingEquipements()
    {
        $this->collCampingEquipements = null; // important to set this to null since that means it is uninitialized
        $this->collCampingEquipementsPartial = null;
    }

    /**
     * reset is the collCampingEquipements collection loaded partially
     *
     * @return void
     */
    public function resetPartialCampingEquipements($v = true)
    {
        $this->collCampingEquipementsPartial = $v;
    }

    /**
     * Initializes the collCampingEquipements collection.
     *
     * By default this just sets the collCampingEquipements collection to an empty array (like clearcollCampingEquipements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCampingEquipements($overrideExisting = true)
    {
        if (null !== $this->collCampingEquipements && !$overrideExisting) {
            return;
        }
        $this->collCampingEquipements = new PropelObjectCollection();
        $this->collCampingEquipements->setModel('CampingEquipement');
    }

    /**
     * Gets an array of CampingEquipement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CampingEquipement[] List of CampingEquipement objects
     * @throws PropelException
     */
    public function getCampingEquipements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCampingEquipementsPartial && !$this->isNew();
        if (null === $this->collCampingEquipements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCampingEquipements) {
                // return empty collection
                $this->initCampingEquipements();
            } else {
                $collCampingEquipements = CampingEquipementQuery::create(null, $criteria)
                    ->filterByCamping($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCampingEquipementsPartial && count($collCampingEquipements)) {
                      $this->initCampingEquipements(false);

                      foreach($collCampingEquipements as $obj) {
                        if (false == $this->collCampingEquipements->contains($obj)) {
                          $this->collCampingEquipements->append($obj);
                        }
                      }

                      $this->collCampingEquipementsPartial = true;
                    }

                    return $collCampingEquipements;
                }

                if($partial && $this->collCampingEquipements) {
                    foreach($this->collCampingEquipements as $obj) {
                        if($obj->isNew()) {
                            $collCampingEquipements[] = $obj;
                        }
                    }
                }

                $this->collCampingEquipements = $collCampingEquipements;
                $this->collCampingEquipementsPartial = false;
            }
        }

        return $this->collCampingEquipements;
    }

    /**
     * Sets a collection of CampingEquipement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $campingEquipements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCampingEquipements(PropelCollection $campingEquipements, PropelPDO $con = null)
    {
        $this->campingEquipementsScheduledForDeletion = $this->getCampingEquipements(new Criteria(), $con)->diff($campingEquipements);

        foreach ($this->campingEquipementsScheduledForDeletion as $campingEquipementRemoved) {
            $campingEquipementRemoved->setCamping(null);
        }

        $this->collCampingEquipements = null;
        foreach ($campingEquipements as $campingEquipement) {
            $this->addCampingEquipement($campingEquipement);
        }

        $this->collCampingEquipements = $campingEquipements;
        $this->collCampingEquipementsPartial = false;
    }

    /**
     * Returns the number of related CampingEquipement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CampingEquipement objects.
     * @throws PropelException
     */
    public function countCampingEquipements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCampingEquipementsPartial && !$this->isNew();
        if (null === $this->collCampingEquipements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCampingEquipements) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCampingEquipements());
                }
                $query = CampingEquipementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collCampingEquipements);
        }
    }

    /**
     * Method called to associate a CampingEquipement object to this object
     * through the CampingEquipement foreign key attribute.
     *
     * @param    CampingEquipement $l CampingEquipement
     * @return Camping The current object (for fluent API support)
     */
    public function addCampingEquipement(CampingEquipement $l)
    {
        if ($this->collCampingEquipements === null) {
            $this->initCampingEquipements();
            $this->collCampingEquipementsPartial = true;
        }
        if (!in_array($l, $this->collCampingEquipements->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCampingEquipement($l);
        }

        return $this;
    }

    /**
     * @param	CampingEquipement $campingEquipement The campingEquipement object to add.
     */
    protected function doAddCampingEquipement($campingEquipement)
    {
        $this->collCampingEquipements[]= $campingEquipement;
        $campingEquipement->setCamping($this);
    }

    /**
     * @param	CampingEquipement $campingEquipement The campingEquipement object to remove.
     */
    public function removeCampingEquipement($campingEquipement)
    {
        if ($this->getCampingEquipements()->contains($campingEquipement)) {
            $this->collCampingEquipements->remove($this->collCampingEquipements->search($campingEquipement));
            if (null === $this->campingEquipementsScheduledForDeletion) {
                $this->campingEquipementsScheduledForDeletion = clone $this->collCampingEquipements;
                $this->campingEquipementsScheduledForDeletion->clear();
            }
            $this->campingEquipementsScheduledForDeletion[]= $campingEquipement;
            $campingEquipement->setCamping(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Camping is new, it will return
     * an empty collection; or if this Camping has previously
     * been saved, it will retrieve related CampingEquipements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Camping.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CampingEquipement[] List of CampingEquipement objects
     */
    public function getCampingEquipementsJoinEquipement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CampingEquipementQuery::create(null, $criteria);
        $query->joinWith('Equipement', $join_behavior);

        return $this->getCampingEquipements($query, $con);
    }

    /**
     * Clears out the collCampingServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCampingServiceComplementaires()
     */
    public function clearCampingServiceComplementaires()
    {
        $this->collCampingServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collCampingServiceComplementairesPartial = null;
    }

    /**
     * reset is the collCampingServiceComplementaires collection loaded partially
     *
     * @return void
     */
    public function resetPartialCampingServiceComplementaires($v = true)
    {
        $this->collCampingServiceComplementairesPartial = $v;
    }

    /**
     * Initializes the collCampingServiceComplementaires collection.
     *
     * By default this just sets the collCampingServiceComplementaires collection to an empty array (like clearcollCampingServiceComplementaires());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCampingServiceComplementaires($overrideExisting = true)
    {
        if (null !== $this->collCampingServiceComplementaires && !$overrideExisting) {
            return;
        }
        $this->collCampingServiceComplementaires = new PropelObjectCollection();
        $this->collCampingServiceComplementaires->setModel('CampingServiceComplementaire');
    }

    /**
     * Gets an array of CampingServiceComplementaire objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CampingServiceComplementaire[] List of CampingServiceComplementaire objects
     * @throws PropelException
     */
    public function getCampingServiceComplementaires($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCampingServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collCampingServiceComplementaires || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCampingServiceComplementaires) {
                // return empty collection
                $this->initCampingServiceComplementaires();
            } else {
                $collCampingServiceComplementaires = CampingServiceComplementaireQuery::create(null, $criteria)
                    ->filterByCamping($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCampingServiceComplementairesPartial && count($collCampingServiceComplementaires)) {
                      $this->initCampingServiceComplementaires(false);

                      foreach($collCampingServiceComplementaires as $obj) {
                        if (false == $this->collCampingServiceComplementaires->contains($obj)) {
                          $this->collCampingServiceComplementaires->append($obj);
                        }
                      }

                      $this->collCampingServiceComplementairesPartial = true;
                    }

                    return $collCampingServiceComplementaires;
                }

                if($partial && $this->collCampingServiceComplementaires) {
                    foreach($this->collCampingServiceComplementaires as $obj) {
                        if($obj->isNew()) {
                            $collCampingServiceComplementaires[] = $obj;
                        }
                    }
                }

                $this->collCampingServiceComplementaires = $collCampingServiceComplementaires;
                $this->collCampingServiceComplementairesPartial = false;
            }
        }

        return $this->collCampingServiceComplementaires;
    }

    /**
     * Sets a collection of CampingServiceComplementaire objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $campingServiceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCampingServiceComplementaires(PropelCollection $campingServiceComplementaires, PropelPDO $con = null)
    {
        $this->campingServiceComplementairesScheduledForDeletion = $this->getCampingServiceComplementaires(new Criteria(), $con)->diff($campingServiceComplementaires);

        foreach ($this->campingServiceComplementairesScheduledForDeletion as $campingServiceComplementaireRemoved) {
            $campingServiceComplementaireRemoved->setCamping(null);
        }

        $this->collCampingServiceComplementaires = null;
        foreach ($campingServiceComplementaires as $campingServiceComplementaire) {
            $this->addCampingServiceComplementaire($campingServiceComplementaire);
        }

        $this->collCampingServiceComplementaires = $campingServiceComplementaires;
        $this->collCampingServiceComplementairesPartial = false;
    }

    /**
     * Returns the number of related CampingServiceComplementaire objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CampingServiceComplementaire objects.
     * @throws PropelException
     */
    public function countCampingServiceComplementaires(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCampingServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collCampingServiceComplementaires || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCampingServiceComplementaires) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCampingServiceComplementaires());
                }
                $query = CampingServiceComplementaireQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collCampingServiceComplementaires);
        }
    }

    /**
     * Method called to associate a CampingServiceComplementaire object to this object
     * through the CampingServiceComplementaire foreign key attribute.
     *
     * @param    CampingServiceComplementaire $l CampingServiceComplementaire
     * @return Camping The current object (for fluent API support)
     */
    public function addCampingServiceComplementaire(CampingServiceComplementaire $l)
    {
        if ($this->collCampingServiceComplementaires === null) {
            $this->initCampingServiceComplementaires();
            $this->collCampingServiceComplementairesPartial = true;
        }
        if (!in_array($l, $this->collCampingServiceComplementaires->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCampingServiceComplementaire($l);
        }

        return $this;
    }

    /**
     * @param	CampingServiceComplementaire $campingServiceComplementaire The campingServiceComplementaire object to add.
     */
    protected function doAddCampingServiceComplementaire($campingServiceComplementaire)
    {
        $this->collCampingServiceComplementaires[]= $campingServiceComplementaire;
        $campingServiceComplementaire->setCamping($this);
    }

    /**
     * @param	CampingServiceComplementaire $campingServiceComplementaire The campingServiceComplementaire object to remove.
     */
    public function removeCampingServiceComplementaire($campingServiceComplementaire)
    {
        if ($this->getCampingServiceComplementaires()->contains($campingServiceComplementaire)) {
            $this->collCampingServiceComplementaires->remove($this->collCampingServiceComplementaires->search($campingServiceComplementaire));
            if (null === $this->campingServiceComplementairesScheduledForDeletion) {
                $this->campingServiceComplementairesScheduledForDeletion = clone $this->collCampingServiceComplementaires;
                $this->campingServiceComplementairesScheduledForDeletion->clear();
            }
            $this->campingServiceComplementairesScheduledForDeletion[]= $campingServiceComplementaire;
            $campingServiceComplementaire->setCamping(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Camping is new, it will return
     * an empty collection; or if this Camping has previously
     * been saved, it will retrieve related CampingServiceComplementaires from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Camping.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CampingServiceComplementaire[] List of CampingServiceComplementaire objects
     */
    public function getCampingServiceComplementairesJoinServiceComplementaire($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CampingServiceComplementaireQuery::create(null, $criteria);
        $query->joinWith('ServiceComplementaire', $join_behavior);

        return $this->getCampingServiceComplementaires($query, $con);
    }

    /**
     * Clears out the collDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDestinations()
     */
    public function clearDestinations()
    {
        $this->collDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collDestinationsPartial = null;
    }

    /**
     * Initializes the collDestinations collection.
     *
     * By default this just sets the collDestinations collection to an empty collection (like clearDestinations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initDestinations()
    {
        $this->collDestinations = new PropelObjectCollection();
        $this->collDestinations->setModel('Destination');
    }

    /**
     * Gets a collection of Destination objects related by a many-to-many relationship
     * to the current object by way of the camping_destination cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Destination[] List of Destination objects
     */
    public function getDestinations($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collDestinations || null !== $criteria) {
            if ($this->isNew() && null === $this->collDestinations) {
                // return empty collection
                $this->initDestinations();
            } else {
                $collDestinations = DestinationQuery::create(null, $criteria)
                    ->filterByCamping($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collDestinations;
                }
                $this->collDestinations = $collDestinations;
            }
        }

        return $this->collDestinations;
    }

    /**
     * Sets a collection of Destination objects related by a many-to-many relationship
     * to the current object by way of the camping_destination cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $destinations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setDestinations(PropelCollection $destinations, PropelPDO $con = null)
    {
        $this->clearDestinations();
        $currentDestinations = $this->getDestinations();

        $this->destinationsScheduledForDeletion = $currentDestinations->diff($destinations);

        foreach ($destinations as $destination) {
            if (!$currentDestinations->contains($destination)) {
                $this->doAddDestination($destination);
            }
        }

        $this->collDestinations = $destinations;
    }

    /**
     * Gets the number of Destination objects related by a many-to-many relationship
     * to the current object by way of the camping_destination cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Destination objects
     */
    public function countDestinations($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collDestinations || null !== $criteria) {
            if ($this->isNew() && null === $this->collDestinations) {
                return 0;
            } else {
                $query = DestinationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collDestinations);
        }
    }

    /**
     * Associate a Destination object to this object
     * through the camping_destination cross reference table.
     *
     * @param  Destination $destination The CampingDestination object to relate
     * @return void
     */
    public function addDestination(Destination $destination)
    {
        if ($this->collDestinations === null) {
            $this->initDestinations();
        }
        if (!$this->collDestinations->contains($destination)) { // only add it if the **same** object is not already associated
            $this->doAddDestination($destination);

            $this->collDestinations[]= $destination;
        }
    }

    /**
     * @param	Destination $destination The destination object to add.
     */
    protected function doAddDestination($destination)
    {
        $campingDestination = new CampingDestination();
        $campingDestination->setDestination($destination);
        $this->addCampingDestination($campingDestination);
    }

    /**
     * Remove a Destination object to this object
     * through the camping_destination cross reference table.
     *
     * @param Destination $destination The CampingDestination object to relate
     * @return void
     */
    public function removeDestination(Destination $destination)
    {
        if ($this->getDestinations()->contains($destination)) {
            $this->collDestinations->remove($this->collDestinations->search($destination));
            if (null === $this->destinationsScheduledForDeletion) {
                $this->destinationsScheduledForDeletion = clone $this->collDestinations;
                $this->destinationsScheduledForDeletion->clear();
            }
            $this->destinationsScheduledForDeletion[]= $destination;
        }
    }

    /**
     * Clears out the collActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addActivites()
     */
    public function clearActivites()
    {
        $this->collActivites = null; // important to set this to null since that means it is uninitialized
        $this->collActivitesPartial = null;
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
     * to the current object by way of the camping_activite cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
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
                    ->filterByCamping($this)
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
     * to the current object by way of the camping_activite cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $activites A Propel collection.
     * @param PropelPDO $con Optional connection object
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
    }

    /**
     * Gets the number of Activite objects related by a many-to-many relationship
     * to the current object by way of the camping_activite cross-reference table.
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
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collActivites);
        }
    }

    /**
     * Associate a Activite object to this object
     * through the camping_activite cross reference table.
     *
     * @param  Activite $activite The CampingActivite object to relate
     * @return void
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
    }

    /**
     * @param	Activite $activite The activite object to add.
     */
    protected function doAddActivite($activite)
    {
        $campingActivite = new CampingActivite();
        $campingActivite->setActivite($activite);
        $this->addCampingActivite($campingActivite);
    }

    /**
     * Remove a Activite object to this object
     * through the camping_activite cross reference table.
     *
     * @param Activite $activite The CampingActivite object to relate
     * @return void
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
    }

    /**
     * Clears out the collEquipements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEquipements()
     */
    public function clearEquipements()
    {
        $this->collEquipements = null; // important to set this to null since that means it is uninitialized
        $this->collEquipementsPartial = null;
    }

    /**
     * Initializes the collEquipements collection.
     *
     * By default this just sets the collEquipements collection to an empty collection (like clearEquipements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initEquipements()
    {
        $this->collEquipements = new PropelObjectCollection();
        $this->collEquipements->setModel('Equipement');
    }

    /**
     * Gets a collection of Equipement objects related by a many-to-many relationship
     * to the current object by way of the camping_equipement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Equipement[] List of Equipement objects
     */
    public function getEquipements($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collEquipements || null !== $criteria) {
            if ($this->isNew() && null === $this->collEquipements) {
                // return empty collection
                $this->initEquipements();
            } else {
                $collEquipements = EquipementQuery::create(null, $criteria)
                    ->filterByCamping($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collEquipements;
                }
                $this->collEquipements = $collEquipements;
            }
        }

        return $this->collEquipements;
    }

    /**
     * Sets a collection of Equipement objects related by a many-to-many relationship
     * to the current object by way of the camping_equipement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $equipements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEquipements(PropelCollection $equipements, PropelPDO $con = null)
    {
        $this->clearEquipements();
        $currentEquipements = $this->getEquipements();

        $this->equipementsScheduledForDeletion = $currentEquipements->diff($equipements);

        foreach ($equipements as $equipement) {
            if (!$currentEquipements->contains($equipement)) {
                $this->doAddEquipement($equipement);
            }
        }

        $this->collEquipements = $equipements;
    }

    /**
     * Gets the number of Equipement objects related by a many-to-many relationship
     * to the current object by way of the camping_equipement cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Equipement objects
     */
    public function countEquipements($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collEquipements || null !== $criteria) {
            if ($this->isNew() && null === $this->collEquipements) {
                return 0;
            } else {
                $query = EquipementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collEquipements);
        }
    }

    /**
     * Associate a Equipement object to this object
     * through the camping_equipement cross reference table.
     *
     * @param  Equipement $equipement The CampingEquipement object to relate
     * @return void
     */
    public function addEquipement(Equipement $equipement)
    {
        if ($this->collEquipements === null) {
            $this->initEquipements();
        }
        if (!$this->collEquipements->contains($equipement)) { // only add it if the **same** object is not already associated
            $this->doAddEquipement($equipement);

            $this->collEquipements[]= $equipement;
        }
    }

    /**
     * @param	Equipement $equipement The equipement object to add.
     */
    protected function doAddEquipement($equipement)
    {
        $campingEquipement = new CampingEquipement();
        $campingEquipement->setEquipement($equipement);
        $this->addCampingEquipement($campingEquipement);
    }

    /**
     * Remove a Equipement object to this object
     * through the camping_equipement cross reference table.
     *
     * @param Equipement $equipement The CampingEquipement object to relate
     * @return void
     */
    public function removeEquipement(Equipement $equipement)
    {
        if ($this->getEquipements()->contains($equipement)) {
            $this->collEquipements->remove($this->collEquipements->search($equipement));
            if (null === $this->equipementsScheduledForDeletion) {
                $this->equipementsScheduledForDeletion = clone $this->collEquipements;
                $this->equipementsScheduledForDeletion->clear();
            }
            $this->equipementsScheduledForDeletion[]= $equipement;
        }
    }

    /**
     * Clears out the collServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addServiceComplementaires()
     */
    public function clearServiceComplementaires()
    {
        $this->collServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collServiceComplementairesPartial = null;
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
     * to the current object by way of the camping_service_complementaire cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Camping is new, it will return
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
                    ->filterByCamping($this)
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
     * to the current object by way of the camping_service_complementaire cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $serviceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
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
    }

    /**
     * Gets the number of ServiceComplementaire objects related by a many-to-many relationship
     * to the current object by way of the camping_service_complementaire cross-reference table.
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
                    ->filterByCamping($this)
                    ->count($con);
            }
        } else {
            return count($this->collServiceComplementaires);
        }
    }

    /**
     * Associate a ServiceComplementaire object to this object
     * through the camping_service_complementaire cross reference table.
     *
     * @param  ServiceComplementaire $serviceComplementaire The CampingServiceComplementaire object to relate
     * @return void
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
    }

    /**
     * @param	ServiceComplementaire $serviceComplementaire The serviceComplementaire object to add.
     */
    protected function doAddServiceComplementaire($serviceComplementaire)
    {
        $campingServiceComplementaire = new CampingServiceComplementaire();
        $campingServiceComplementaire->setServiceComplementaire($serviceComplementaire);
        $this->addCampingServiceComplementaire($campingServiceComplementaire);
    }

    /**
     * Remove a ServiceComplementaire object to this object
     * through the camping_service_complementaire cross reference table.
     *
     * @param ServiceComplementaire $serviceComplementaire The CampingServiceComplementaire object to relate
     * @return void
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
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->address1 = null;
        $this->address2 = null;
        $this->zip = null;
        $this->city = null;
        $this->mail = null;
        $this->country = null;
        $this->country_code = null;
        $this->phone1 = null;
        $this->phone2 = null;
        $this->fax = null;
        $this->type_hebergement_id = null;
        $this->ville_id = null;
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
            if ($this->collCampingDestinations) {
                foreach ($this->collCampingDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCampingActivites) {
                foreach ($this->collCampingActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCampingEquipements) {
                foreach ($this->collCampingEquipements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCampingServiceComplementaires) {
                foreach ($this->collCampingServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDestinations) {
                foreach ($this->collDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collActivites) {
                foreach ($this->collActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEquipements) {
                foreach ($this->collEquipements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collServiceComplementaires) {
                foreach ($this->collServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collCampingDestinations instanceof PropelCollection) {
            $this->collCampingDestinations->clearIterator();
        }
        $this->collCampingDestinations = null;
        if ($this->collCampingActivites instanceof PropelCollection) {
            $this->collCampingActivites->clearIterator();
        }
        $this->collCampingActivites = null;
        if ($this->collCampingEquipements instanceof PropelCollection) {
            $this->collCampingEquipements->clearIterator();
        }
        $this->collCampingEquipements = null;
        if ($this->collCampingServiceComplementaires instanceof PropelCollection) {
            $this->collCampingServiceComplementaires->clearIterator();
        }
        $this->collCampingServiceComplementaires = null;
        if ($this->collDestinations instanceof PropelCollection) {
            $this->collDestinations->clearIterator();
        }
        $this->collDestinations = null;
        if ($this->collActivites instanceof PropelCollection) {
            $this->collActivites->clearIterator();
        }
        $this->collActivites = null;
        if ($this->collEquipements instanceof PropelCollection) {
            $this->collEquipements->clearIterator();
        }
        $this->collEquipements = null;
        if ($this->collServiceComplementaires instanceof PropelCollection) {
            $this->collServiceComplementaires->clearIterator();
        }
        $this->collServiceComplementaires = null;
        $this->aTypeHebergement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CampingPeer::DEFAULT_STRING_FORMAT);
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
