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
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\EtablissementTypeHebergementPeer;
use Cungfoo\Model\EtablissementTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementQuery;

/**
 * Base class that represents a row from the 'etablissement_type_hebergement' table.
 *
 * 
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementTypeHebergement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\EtablissementTypeHebergementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EtablissementTypeHebergementPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the etablissement_id field.
     * @var        int
     */
    protected $etablissement_id;

    /**
     * The value for the type_hebergement_id field.
     * @var        int
     */
    protected $type_hebergement_id;

    /**
     * The value for the minimum_price field.
     * @var        string
     */
    protected $minimum_price;

    /**
     * The value for the minimum_price_discount_label field.
     * @var        string
     */
    protected $minimum_price_discount_label;

    /**
     * The value for the minimum_price_start_date field.
     * @var        string
     */
    protected $minimum_price_start_date;

    /**
     * The value for the minimum_price_end_date field.
     * @var        string
     */
    protected $minimum_price_end_date;

    /**
     * @var        Etablissement
     */
    protected $aEtablissement;

    /**
     * @var        TypeHebergement
     */
    protected $aTypeHebergement;

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
     * Get the [etablissement_id] column value.
     * 
     * @return int
     */
    public function getEtablissementId()
    {
        return $this->etablissement_id;
    }

    /**
     * Get the [type_hebergement_id] column value.
     * 
     * @return int
     */
    public function getTypeHebergementId()
    {
        return $this->type_hebergement_id;
    }

    /**
     * Get the [minimum_price] column value.
     * 
     * @return string
     */
    public function getMinimumPrice()
    {
        return $this->minimum_price;
    }

    /**
     * Get the [minimum_price_discount_label] column value.
     * 
     * @return string
     */
    public function getMinimumPriceDiscountLabel()
    {
        return $this->minimum_price_discount_label;
    }

    /**
     * Get the [optionally formatted] temporal [minimum_price_start_date] column value.
     * 
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMinimumPriceStartDate($format = null)
    {
        if ($this->minimum_price_start_date === null) {
            return null;
        }

        if ($this->minimum_price_start_date === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->minimum_price_start_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->minimum_price_start_date, true), $x);
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
     * Get the [optionally formatted] temporal [minimum_price_end_date] column value.
     * 
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMinimumPriceEndDate($format = null)
    {
        if ($this->minimum_price_end_date === null) {
            return null;
        }

        if ($this->minimum_price_end_date === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->minimum_price_end_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->minimum_price_end_date, true), $x);
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
     * Set the value of [etablissement_id] column.
     * 
     * @param int $v new value
     * @return EtablissementTypeHebergement The current object (for fluent API support)
     */
    public function setEtablissementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->etablissement_id !== $v) {
            $this->etablissement_id = $v;
            $this->modifiedColumns[] = EtablissementTypeHebergementPeer::ETABLISSEMENT_ID;
        }

        if ($this->aEtablissement !== null && $this->aEtablissement->getId() !== $v) {
            $this->aEtablissement = null;
        }


        return $this;
    } // setEtablissementId()

    /**
     * Set the value of [type_hebergement_id] column.
     * 
     * @param int $v new value
     * @return EtablissementTypeHebergement The current object (for fluent API support)
     */
    public function setTypeHebergementId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_hebergement_id !== $v) {
            $this->type_hebergement_id = $v;
            $this->modifiedColumns[] = EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID;
        }

        if ($this->aTypeHebergement !== null && $this->aTypeHebergement->getId() !== $v) {
            $this->aTypeHebergement = null;
        }


        return $this;
    } // setTypeHebergementId()

    /**
     * Set the value of [minimum_price] column.
     * 
     * @param string $v new value
     * @return EtablissementTypeHebergement The current object (for fluent API support)
     */
    public function setMinimumPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->minimum_price !== $v) {
            $this->minimum_price = $v;
            $this->modifiedColumns[] = EtablissementTypeHebergementPeer::MINIMUM_PRICE;
        }


        return $this;
    } // setMinimumPrice()

    /**
     * Set the value of [minimum_price_discount_label] column.
     * 
     * @param string $v new value
     * @return EtablissementTypeHebergement The current object (for fluent API support)
     */
    public function setMinimumPriceDiscountLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->minimum_price_discount_label !== $v) {
            $this->minimum_price_discount_label = $v;
            $this->modifiedColumns[] = EtablissementTypeHebergementPeer::MINIMUM_PRICE_DISCOUNT_LABEL;
        }


        return $this;
    } // setMinimumPriceDiscountLabel()

    /**
     * Sets the value of [minimum_price_start_date] column to a normalized version of the date/time value specified.
     * 
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return EtablissementTypeHebergement The current object (for fluent API support)
     */
    public function setMinimumPriceStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->minimum_price_start_date !== null || $dt !== null) {
            $currentDateAsString = ($this->minimum_price_start_date !== null && $tmpDt = new DateTime($this->minimum_price_start_date)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->minimum_price_start_date = $newDateAsString;
                $this->modifiedColumns[] = EtablissementTypeHebergementPeer::MINIMUM_PRICE_START_DATE;
            }
        } // if either are not null


        return $this;
    } // setMinimumPriceStartDate()

    /**
     * Sets the value of [minimum_price_end_date] column to a normalized version of the date/time value specified.
     * 
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return EtablissementTypeHebergement The current object (for fluent API support)
     */
    public function setMinimumPriceEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->minimum_price_end_date !== null || $dt !== null) {
            $currentDateAsString = ($this->minimum_price_end_date !== null && $tmpDt = new DateTime($this->minimum_price_end_date)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->minimum_price_end_date = $newDateAsString;
                $this->modifiedColumns[] = EtablissementTypeHebergementPeer::MINIMUM_PRICE_END_DATE;
            }
        } // if either are not null


        return $this;
    } // setMinimumPriceEndDate()

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

            $this->etablissement_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->type_hebergement_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->minimum_price = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->minimum_price_discount_label = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->minimum_price_start_date = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->minimum_price_end_date = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = EtablissementTypeHebergementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating EtablissementTypeHebergement object", $e);
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
            $con = Propel::getConnection(EtablissementTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EtablissementTypeHebergementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEtablissement = null;
            $this->aTypeHebergement = null;
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
            $con = Propel::getConnection(EtablissementTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EtablissementTypeHebergementQuery::create()
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
            $con = Propel::getConnection(EtablissementTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                EtablissementTypeHebergementPeer::addInstanceToPool($this);
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
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`ETABLISSEMENT_ID`';
        }
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`TYPE_HEBERGEMENT_ID`';
        }
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE)) {
            $modifiedColumns[':p' . $index++]  = '`MINIMUM_PRICE`';
        }
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE_DISCOUNT_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`MINIMUM_PRICE_DISCOUNT_LABEL`';
        }
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`MINIMUM_PRICE_START_DATE`';
        }
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`MINIMUM_PRICE_END_DATE`';
        }

        $sql = sprintf(
            'INSERT INTO `etablissement_type_hebergement` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ETABLISSEMENT_ID`':						
                        $stmt->bindValue($identifier, $this->etablissement_id, PDO::PARAM_INT);
                        break;
                    case '`TYPE_HEBERGEMENT_ID`':						
                        $stmt->bindValue($identifier, $this->type_hebergement_id, PDO::PARAM_INT);
                        break;
                    case '`MINIMUM_PRICE`':						
                        $stmt->bindValue($identifier, $this->minimum_price, PDO::PARAM_STR);
                        break;
                    case '`MINIMUM_PRICE_DISCOUNT_LABEL`':						
                        $stmt->bindValue($identifier, $this->minimum_price_discount_label, PDO::PARAM_STR);
                        break;
                    case '`MINIMUM_PRICE_START_DATE`':						
                        $stmt->bindValue($identifier, $this->minimum_price_start_date, PDO::PARAM_STR);
                        break;
                    case '`MINIMUM_PRICE_END_DATE`':						
                        $stmt->bindValue($identifier, $this->minimum_price_end_date, PDO::PARAM_STR);
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

            if ($this->aEtablissement !== null) {
                if (!$this->aEtablissement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEtablissement->getValidationFailures());
                }
            }

            if ($this->aTypeHebergement !== null) {
                if (!$this->aTypeHebergement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeHebergement->getValidationFailures());
                }
            }


            if (($retval = EtablissementTypeHebergementPeer::doValidate($this, $columns)) !== true) {
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
        $pos = EtablissementTypeHebergementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getEtablissementId();
                break;
            case 1:
                return $this->getTypeHebergementId();
                break;
            case 2:
                return $this->getMinimumPrice();
                break;
            case 3:
                return $this->getMinimumPriceDiscountLabel();
                break;
            case 4:
                return $this->getMinimumPriceStartDate();
                break;
            case 5:
                return $this->getMinimumPriceEndDate();
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
        if (isset($alreadyDumpedObjects['EtablissementTypeHebergement'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['EtablissementTypeHebergement'][serialize($this->getPrimaryKey())] = true;
        $keys = EtablissementTypeHebergementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEtablissementId(),
            $keys[1] => $this->getTypeHebergementId(),
            $keys[2] => $this->getMinimumPrice(),
            $keys[3] => $this->getMinimumPriceDiscountLabel(),
            $keys[4] => $this->getMinimumPriceStartDate(),
            $keys[5] => $this->getMinimumPriceEndDate(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aEtablissement) {
                $result['Etablissement'] = $this->aEtablissement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTypeHebergement) {
                $result['TypeHebergement'] = $this->aTypeHebergement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = EtablissementTypeHebergementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setEtablissementId($value);
                break;
            case 1:
                $this->setTypeHebergementId($value);
                break;
            case 2:
                $this->setMinimumPrice($value);
                break;
            case 3:
                $this->setMinimumPriceDiscountLabel($value);
                break;
            case 4:
                $this->setMinimumPriceStartDate($value);
                break;
            case 5:
                $this->setMinimumPriceEndDate($value);
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
        $keys = EtablissementTypeHebergementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setEtablissementId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTypeHebergementId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setMinimumPrice($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setMinimumPriceDiscountLabel($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setMinimumPriceStartDate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setMinimumPriceEndDate($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EtablissementTypeHebergementPeer::DATABASE_NAME);

        if ($this->isColumnModified(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID)) $criteria->add(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $this->etablissement_id);
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID)) $criteria->add(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $this->type_hebergement_id);
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE)) $criteria->add(EtablissementTypeHebergementPeer::MINIMUM_PRICE, $this->minimum_price);
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE_DISCOUNT_LABEL)) $criteria->add(EtablissementTypeHebergementPeer::MINIMUM_PRICE_DISCOUNT_LABEL, $this->minimum_price_discount_label);
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE_START_DATE)) $criteria->add(EtablissementTypeHebergementPeer::MINIMUM_PRICE_START_DATE, $this->minimum_price_start_date);
        if ($this->isColumnModified(EtablissementTypeHebergementPeer::MINIMUM_PRICE_END_DATE)) $criteria->add(EtablissementTypeHebergementPeer::MINIMUM_PRICE_END_DATE, $this->minimum_price_end_date);

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
        $criteria = new Criteria(EtablissementTypeHebergementPeer::DATABASE_NAME);
        $criteria->add(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $this->etablissement_id);
        $criteria->add(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $this->type_hebergement_id);

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
        $pks[0] = $this->getEtablissementId();
        $pks[1] = $this->getTypeHebergementId();

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
        $this->setEtablissementId($keys[0]);
        $this->setTypeHebergementId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getEtablissementId()) && (null === $this->getTypeHebergementId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of EtablissementTypeHebergement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEtablissementId($this->getEtablissementId());
        $copyObj->setTypeHebergementId($this->getTypeHebergementId());
        $copyObj->setMinimumPrice($this->getMinimumPrice());
        $copyObj->setMinimumPriceDiscountLabel($this->getMinimumPriceDiscountLabel());
        $copyObj->setMinimumPriceStartDate($this->getMinimumPriceStartDate());
        $copyObj->setMinimumPriceEndDate($this->getMinimumPriceEndDate());

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
     * @return EtablissementTypeHebergement Clone of current object.
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
     * @return EtablissementTypeHebergementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EtablissementTypeHebergementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return EtablissementTypeHebergement The current object (for fluent API support)
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
            $v->addEtablissementTypeHebergement($this);
        }


        return $this;
    }


    /**
     * Get the associated Etablissement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Etablissement The associated Etablissement object.
     * @throws PropelException
     */
    public function getEtablissement(PropelPDO $con = null)
    {
        if ($this->aEtablissement === null && ($this->etablissement_id !== null)) {
            $this->aEtablissement = EtablissementQuery::create()->findPk($this->etablissement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEtablissement->addEtablissementTypeHebergements($this);
             */
        }

        return $this->aEtablissement;
    }

    /**
     * Declares an association between this object and a TypeHebergement object.
     *
     * @param             TypeHebergement $v
     * @return EtablissementTypeHebergement The current object (for fluent API support)
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
            $v->addEtablissementTypeHebergement($this);
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
        if ($this->aTypeHebergement === null && ($this->type_hebergement_id !== null)) {
            $this->aTypeHebergement = TypeHebergementQuery::create()->findPk($this->type_hebergement_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypeHebergement->addEtablissementTypeHebergements($this);
             */
        }

        return $this->aTypeHebergement;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->etablissement_id = null;
        $this->type_hebergement_id = null;
        $this->minimum_price = null;
        $this->minimum_price_discount_label = null;
        $this->minimum_price_start_date = null;
        $this->minimum_price_end_date = null;
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
        } // if ($deep)

        $this->aEtablissement = null;
        $this->aTypeHebergement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EtablissementTypeHebergementPeer::DEFAULT_STRING_FORMAT);
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
