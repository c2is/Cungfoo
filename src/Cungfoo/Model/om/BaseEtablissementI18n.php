<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementI18n;
use Cungfoo\Model\EtablissementI18nPeer;
use Cungfoo\Model\EtablissementI18nQuery;
use Cungfoo\Model\EtablissementQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'etablissement_i18n' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementI18n extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\EtablissementI18nPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EtablissementI18nPeer
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
     * The value for the locale field.
     * Note: this column has a database default value of: 'fr'
     * @var        string
     */
    protected $locale;

    /**
     * The value for the country field.
     * @var        string
     */
    protected $country;

    /**
     * The value for the ouverture_reception field.
     * @var        string
     */
    protected $ouverture_reception;

    /**
     * The value for the ouverture_camping field.
     * @var        string
     */
    protected $ouverture_camping;

    /**
     * The value for the arrivees_departs field.
     * @var        string
     */
    protected $arrivees_departs;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the seo_title field.
     * @var        string
     */
    protected $seo_title;

    /**
     * The value for the seo_description field.
     * @var        string
     */
    protected $seo_description;

    /**
     * The value for the seo_h1 field.
     * @var        string
     */
    protected $seo_h1;

    /**
     * The value for the seo_keywords field.
     * @var        string
     */
    protected $seo_keywords;

    /**
     * The value for the active_locale field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active_locale;

    /**
     * @var        Etablissement
     */
    protected $aEtablissement;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->locale = 'fr';
        $this->active_locale = false;
    }

    /**
     * Initializes internal state of BaseEtablissementI18n object.
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
     * Get the [locale] column value.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
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
     * Get the [ouverture_reception] column value.
     *
     * @return string
     */
    public function getOuvertureReception()
    {
        return $this->ouverture_reception;
    }

    /**
     * Get the [ouverture_camping] column value.
     *
     * @return string
     */
    public function getOuvertureCamping()
    {
        return $this->ouverture_camping;
    }

    /**
     * Get the [arrivees_departs] column value.
     *
     * @return string
     */
    public function getArriveesDeparts()
    {
        return $this->arrivees_departs;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [seo_title] column value.
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seo_title;
    }

    /**
     * Get the [seo_description] column value.
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seo_description;
    }

    /**
     * Get the [seo_h1] column value.
     *
     * @return string
     */
    public function getSeoH1()
    {
        return $this->seo_h1;
    }

    /**
     * Get the [seo_keywords] column value.
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seo_keywords;
    }

    /**
     * Get the [active_locale] column value.
     *
     * @return boolean
     */
    public function getActiveLocale()
    {
        return $this->active_locale;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::ID;
        }

        if ($this->aEtablissement !== null && $this->aEtablissement->getId() !== $v) {
            $this->aEtablissement = null;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [locale] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setLocale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locale !== $v) {
            $this->locale = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::LOCALE;
        }


        return $this;
    } // setLocale()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::COUNTRY;
        }


        return $this;
    } // setCountry()

    /**
     * Set the value of [ouverture_reception] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setOuvertureReception($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ouverture_reception !== $v) {
            $this->ouverture_reception = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::OUVERTURE_RECEPTION;
        }


        return $this;
    } // setOuvertureReception()

    /**
     * Set the value of [ouverture_camping] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setOuvertureCamping($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ouverture_camping !== $v) {
            $this->ouverture_camping = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::OUVERTURE_CAMPING;
        }


        return $this;
    } // setOuvertureCamping()

    /**
     * Set the value of [arrivees_departs] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setArriveesDeparts($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->arrivees_departs !== $v) {
            $this->arrivees_departs = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::ARRIVEES_DEPARTS;
        }


        return $this;
    } // setArriveesDeparts()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [seo_title] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setSeoTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_title !== $v) {
            $this->seo_title = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::SEO_TITLE;
        }


        return $this;
    } // setSeoTitle()

    /**
     * Set the value of [seo_description] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setSeoDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_description !== $v) {
            $this->seo_description = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::SEO_DESCRIPTION;
        }


        return $this;
    } // setSeoDescription()

    /**
     * Set the value of [seo_h1] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setSeoH1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_h1 !== $v) {
            $this->seo_h1 = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::SEO_H1;
        }


        return $this;
    } // setSeoH1()

    /**
     * Set the value of [seo_keywords] column.
     *
     * @param string $v new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setSeoKeywords($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_keywords !== $v) {
            $this->seo_keywords = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::SEO_KEYWORDS;
        }


        return $this;
    } // setSeoKeywords()

    /**
     * Sets the value of the [active_locale] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return EtablissementI18n The current object (for fluent API support)
     */
    public function setActiveLocale($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active_locale !== $v) {
            $this->active_locale = $v;
            $this->modifiedColumns[] = EtablissementI18nPeer::ACTIVE_LOCALE;
        }


        return $this;
    } // setActiveLocale()

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
            if ($this->locale !== 'fr') {
                return false;
            }

            if ($this->active_locale !== false) {
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
            $this->locale = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->country = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->ouverture_reception = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->ouverture_camping = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->arrivees_departs = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->description = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->seo_title = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->seo_description = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->seo_h1 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->seo_keywords = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->active_locale = ($row[$startcol + 11] !== null) ? (boolean) $row[$startcol + 11] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 12; // 12 = EtablissementI18nPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating EtablissementI18n object", $e);
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

        if ($this->aEtablissement !== null && $this->id !== $this->aEtablissement->getId()) {
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
            $con = Propel::getConnection(EtablissementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EtablissementI18nPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEtablissement = null;
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
            $con = Propel::getConnection(EtablissementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EtablissementI18nQuery::create()
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
            $con = Propel::getConnection(EtablissementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                EtablissementI18nPeer::addInstanceToPool($this);
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
        if ($this->isColumnModified(EtablissementI18nPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`locale`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`country`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::OUVERTURE_RECEPTION)) {
            $modifiedColumns[':p' . $index++]  = '`ouverture_reception`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::OUVERTURE_CAMPING)) {
            $modifiedColumns[':p' . $index++]  = '`ouverture_camping`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::ARRIVEES_DEPARTS)) {
            $modifiedColumns[':p' . $index++]  = '`arrivees_departs`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`seo_title`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`seo_description`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_H1)) {
            $modifiedColumns[':p' . $index++]  = '`seo_h1`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_KEYWORDS)) {
            $modifiedColumns[':p' . $index++]  = '`seo_keywords`';
        }
        if ($this->isColumnModified(EtablissementI18nPeer::ACTIVE_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`active_locale`';
        }

        $sql = sprintf(
            'INSERT INTO `etablissement_i18n` (%s) VALUES (%s)',
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
                    case '`locale`':
                        $stmt->bindValue($identifier, $this->locale, PDO::PARAM_STR);
                        break;
                    case '`country`':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case '`ouverture_reception`':
                        $stmt->bindValue($identifier, $this->ouverture_reception, PDO::PARAM_STR);
                        break;
                    case '`ouverture_camping`':
                        $stmt->bindValue($identifier, $this->ouverture_camping, PDO::PARAM_STR);
                        break;
                    case '`arrivees_departs`':
                        $stmt->bindValue($identifier, $this->arrivees_departs, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`seo_title`':
                        $stmt->bindValue($identifier, $this->seo_title, PDO::PARAM_STR);
                        break;
                    case '`seo_description`':
                        $stmt->bindValue($identifier, $this->seo_description, PDO::PARAM_STR);
                        break;
                    case '`seo_h1`':
                        $stmt->bindValue($identifier, $this->seo_h1, PDO::PARAM_STR);
                        break;
                    case '`seo_keywords`':
                        $stmt->bindValue($identifier, $this->seo_keywords, PDO::PARAM_STR);
                        break;
                    case '`active_locale`':
                        $stmt->bindValue($identifier, (int) $this->active_locale, PDO::PARAM_INT);
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


            if (($retval = EtablissementI18nPeer::doValidate($this, $columns)) !== true) {
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
        $pos = EtablissementI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getLocale();
                break;
            case 2:
                return $this->getCountry();
                break;
            case 3:
                return $this->getOuvertureReception();
                break;
            case 4:
                return $this->getOuvertureCamping();
                break;
            case 5:
                return $this->getArriveesDeparts();
                break;
            case 6:
                return $this->getDescription();
                break;
            case 7:
                return $this->getSeoTitle();
                break;
            case 8:
                return $this->getSeoDescription();
                break;
            case 9:
                return $this->getSeoH1();
                break;
            case 10:
                return $this->getSeoKeywords();
                break;
            case 11:
                return $this->getActiveLocale();
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
        if (isset($alreadyDumpedObjects['EtablissementI18n'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['EtablissementI18n'][serialize($this->getPrimaryKey())] = true;
        $keys = EtablissementI18nPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLocale(),
            $keys[2] => $this->getCountry(),
            $keys[3] => $this->getOuvertureReception(),
            $keys[4] => $this->getOuvertureCamping(),
            $keys[5] => $this->getArriveesDeparts(),
            $keys[6] => $this->getDescription(),
            $keys[7] => $this->getSeoTitle(),
            $keys[8] => $this->getSeoDescription(),
            $keys[9] => $this->getSeoH1(),
            $keys[10] => $this->getSeoKeywords(),
            $keys[11] => $this->getActiveLocale(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aEtablissement) {
                $result['Etablissement'] = $this->aEtablissement->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = EtablissementI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setLocale($value);
                break;
            case 2:
                $this->setCountry($value);
                break;
            case 3:
                $this->setOuvertureReception($value);
                break;
            case 4:
                $this->setOuvertureCamping($value);
                break;
            case 5:
                $this->setArriveesDeparts($value);
                break;
            case 6:
                $this->setDescription($value);
                break;
            case 7:
                $this->setSeoTitle($value);
                break;
            case 8:
                $this->setSeoDescription($value);
                break;
            case 9:
                $this->setSeoH1($value);
                break;
            case 10:
                $this->setSeoKeywords($value);
                break;
            case 11:
                $this->setActiveLocale($value);
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
        $keys = EtablissementI18nPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLocale($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCountry($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setOuvertureReception($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setOuvertureCamping($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setArriveesDeparts($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setDescription($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSeoTitle($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSeoDescription($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setSeoH1($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setSeoKeywords($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setActiveLocale($arr[$keys[11]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EtablissementI18nPeer::DATABASE_NAME);

        if ($this->isColumnModified(EtablissementI18nPeer::ID)) $criteria->add(EtablissementI18nPeer::ID, $this->id);
        if ($this->isColumnModified(EtablissementI18nPeer::LOCALE)) $criteria->add(EtablissementI18nPeer::LOCALE, $this->locale);
        if ($this->isColumnModified(EtablissementI18nPeer::COUNTRY)) $criteria->add(EtablissementI18nPeer::COUNTRY, $this->country);
        if ($this->isColumnModified(EtablissementI18nPeer::OUVERTURE_RECEPTION)) $criteria->add(EtablissementI18nPeer::OUVERTURE_RECEPTION, $this->ouverture_reception);
        if ($this->isColumnModified(EtablissementI18nPeer::OUVERTURE_CAMPING)) $criteria->add(EtablissementI18nPeer::OUVERTURE_CAMPING, $this->ouverture_camping);
        if ($this->isColumnModified(EtablissementI18nPeer::ARRIVEES_DEPARTS)) $criteria->add(EtablissementI18nPeer::ARRIVEES_DEPARTS, $this->arrivees_departs);
        if ($this->isColumnModified(EtablissementI18nPeer::DESCRIPTION)) $criteria->add(EtablissementI18nPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_TITLE)) $criteria->add(EtablissementI18nPeer::SEO_TITLE, $this->seo_title);
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_DESCRIPTION)) $criteria->add(EtablissementI18nPeer::SEO_DESCRIPTION, $this->seo_description);
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_H1)) $criteria->add(EtablissementI18nPeer::SEO_H1, $this->seo_h1);
        if ($this->isColumnModified(EtablissementI18nPeer::SEO_KEYWORDS)) $criteria->add(EtablissementI18nPeer::SEO_KEYWORDS, $this->seo_keywords);
        if ($this->isColumnModified(EtablissementI18nPeer::ACTIVE_LOCALE)) $criteria->add(EtablissementI18nPeer::ACTIVE_LOCALE, $this->active_locale);

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
        $criteria = new Criteria(EtablissementI18nPeer::DATABASE_NAME);
        $criteria->add(EtablissementI18nPeer::ID, $this->id);
        $criteria->add(EtablissementI18nPeer::LOCALE, $this->locale);

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
        $pks[0] = $this->getId();
        $pks[1] = $this->getLocale();

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
        $this->setId($keys[0]);
        $this->setLocale($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getId()) && (null === $this->getLocale());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of EtablissementI18n (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setLocale($this->getLocale());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setOuvertureReception($this->getOuvertureReception());
        $copyObj->setOuvertureCamping($this->getOuvertureCamping());
        $copyObj->setArriveesDeparts($this->getArriveesDeparts());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setSeoTitle($this->getSeoTitle());
        $copyObj->setSeoDescription($this->getSeoDescription());
        $copyObj->setSeoH1($this->getSeoH1());
        $copyObj->setSeoKeywords($this->getSeoKeywords());
        $copyObj->setActiveLocale($this->getActiveLocale());

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
     * @return EtablissementI18n Clone of current object.
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
     * @return EtablissementI18nPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EtablissementI18nPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Etablissement object.
     *
     * @param             Etablissement $v
     * @return EtablissementI18n The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEtablissement(Etablissement $v = null)
    {
        if ($v === null) {
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aEtablissement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Etablissement object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissementI18n($this);
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
        if ($this->aEtablissement === null && ($this->id !== null) && $doQuery) {
            $this->aEtablissement = EtablissementQuery::create()->findPk($this->id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEtablissement->addEtablissementI18ns($this);
             */
        }

        return $this->aEtablissement;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->locale = null;
        $this->country = null;
        $this->ouverture_reception = null;
        $this->ouverture_camping = null;
        $this->arrivees_departs = null;
        $this->description = null;
        $this->seo_title = null;
        $this->seo_description = null;
        $this->seo_h1 = null;
        $this->seo_keywords = null;
        $this->active_locale = null;
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
        } // if ($deep)

        $this->aEtablissement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EtablissementI18nPeer::DEFAULT_STRING_FORMAT);
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
