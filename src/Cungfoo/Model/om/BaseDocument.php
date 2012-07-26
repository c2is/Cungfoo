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
use Cungfoo\Model\Author;
use Cungfoo\Model\AuthorQuery;
use Cungfoo\Model\Category;
use Cungfoo\Model\CategoryQuery;
use Cungfoo\Model\Document;
use Cungfoo\Model\DocumentAuthor;
use Cungfoo\Model\DocumentAuthorQuery;
use Cungfoo\Model\DocumentI18n;
use Cungfoo\Model\DocumentI18nQuery;
use Cungfoo\Model\DocumentPeer;
use Cungfoo\Model\DocumentQuery;

/**
 * Base class that represents a row from the 'document' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDocument extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\DocumentPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DocumentPeer
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
     * The value for the category_id field.
     * @var        int
     */
    protected $category_id;

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
     * @var        Category
     */
    protected $aCategory;

    /**
     * @var        PropelObjectCollection|DocumentAuthor[] Collection to store aggregation of DocumentAuthor objects.
     */
    protected $collDocumentAuthors;
    protected $collDocumentAuthorsPartial;

    /**
     * @var        PropelObjectCollection|DocumentI18n[] Collection to store aggregation of DocumentI18n objects.
     */
    protected $collDocumentI18ns;
    protected $collDocumentI18nsPartial;

    /**
     * @var        PropelObjectCollection|Author[] Collection to store aggregation of Author objects.
     */
    protected $collAuthors;

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
    protected $currentLocale = 'en_EN';

    /**
     * Current translation objects
     * @var        array[DocumentI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $documentAuthorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $documentI18nsScheduledForDeletion = null;

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
     * Get the [category_id] column value.
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category_id;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Document The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DocumentPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [category_id] column.
     *
     * @param int $v new value
     * @return Document The current object (for fluent API support)
     */
    public function setCategoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->category_id !== $v) {
            $this->category_id = $v;
            $this->modifiedColumns[] = DocumentPeer::CATEGORY_ID;
        }

        if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
            $this->aCategory = null;
        }


        return $this;
    } // setCategoryId()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Document The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = DocumentPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Document The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = DocumentPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

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
            $this->category_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->created_at = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = DocumentPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Document object", $e);
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

        if ($this->aCategory !== null && $this->category_id !== $this->aCategory->getId()) {
            $this->aCategory = null;
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
            $con = Propel::getConnection(DocumentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DocumentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategory = null;
            $this->collDocumentAuthors = null;

            $this->collDocumentI18ns = null;

            $this->collAuthors = null;
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
            $con = Propel::getConnection(DocumentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DocumentQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                // i18n behavior

                // emulate delete cascade
                DocumentI18nQuery::create()
                    ->filterByDocument($this)
                    ->delete($con);

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
            $con = Propel::getConnection(DocumentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(DocumentPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DocumentPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DocumentPeer::UPDATED_AT)) {
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
                DocumentPeer::addInstanceToPool($this);
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

            if ($this->aCategory !== null) {
                if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
                    $affectedRows += $this->aCategory->save($con);
                }
                $this->setCategory($this->aCategory);
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

            if ($this->authorsScheduledForDeletion !== null) {
                if (!$this->authorsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->authorsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    DocumentAuthorQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->authorsScheduledForDeletion = null;
                }

                foreach ($this->getAuthors() as $author) {
                    if ($author->isModified()) {
                        $author->save($con);
                    }
                }
            }

            if ($this->documentAuthorsScheduledForDeletion !== null) {
                if (!$this->documentAuthorsScheduledForDeletion->isEmpty()) {
                    DocumentAuthorQuery::create()
                        ->filterByPrimaryKeys($this->documentAuthorsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->documentAuthorsScheduledForDeletion = null;
                }
            }

            if ($this->collDocumentAuthors !== null) {
                foreach ($this->collDocumentAuthors as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->documentI18nsScheduledForDeletion !== null) {
                if (!$this->documentI18nsScheduledForDeletion->isEmpty()) {
                    DocumentI18nQuery::create()
                        ->filterByPrimaryKeys($this->documentI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->documentI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collDocumentI18ns !== null) {
                foreach ($this->collDocumentI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = DocumentPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DocumentPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DocumentPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(DocumentPeer::CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`CATEGORY_ID`';
        }
        if ($this->isColumnModified(DocumentPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(DocumentPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `document` (%s) VALUES (%s)',
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
                    case '`CATEGORY_ID`':
                        $stmt->bindValue($identifier, $this->category_id, PDO::PARAM_INT);
                        break;
                    case '`CREATED_AT`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategory !== null) {
                if (!$this->aCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
                }
            }


            if (($retval = DocumentPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collDocumentAuthors !== null) {
                    foreach ($this->collDocumentAuthors as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collDocumentI18ns !== null) {
                    foreach ($this->collDocumentI18ns as $referrerFK) {
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
        $pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCategoryId();
                break;
            case 2:
                return $this->getCreatedAt();
                break;
            case 3:
                return $this->getUpdatedAt();
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
        if (isset($alreadyDumpedObjects['Document'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Document'][$this->getPrimaryKey()] = true;
        $keys = DocumentPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCategoryId(),
            $keys[2] => $this->getCreatedAt(),
            $keys[3] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCategory) {
                $result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDocumentAuthors) {
                $result['DocumentAuthors'] = $this->collDocumentAuthors->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDocumentI18ns) {
                $result['DocumentI18ns'] = $this->collDocumentI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCategoryId($value);
                break;
            case 2:
                $this->setCreatedAt($value);
                break;
            case 3:
                $this->setUpdatedAt($value);
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
        $keys = DocumentPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCategoryId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DocumentPeer::DATABASE_NAME);

        if ($this->isColumnModified(DocumentPeer::ID)) $criteria->add(DocumentPeer::ID, $this->id);
        if ($this->isColumnModified(DocumentPeer::CATEGORY_ID)) $criteria->add(DocumentPeer::CATEGORY_ID, $this->category_id);
        if ($this->isColumnModified(DocumentPeer::CREATED_AT)) $criteria->add(DocumentPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(DocumentPeer::UPDATED_AT)) $criteria->add(DocumentPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(DocumentPeer::DATABASE_NAME);
        $criteria->add(DocumentPeer::ID, $this->id);

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
     * @param object $copyObj An object of Document (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCategoryId($this->getCategoryId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getDocumentAuthors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDocumentAuthor($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDocumentI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDocumentI18n($relObj->copy($deepCopy));
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
     * @return Document Clone of current object.
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
     * @return DocumentPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DocumentPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Category object.
     *
     * @param             Category $v
     * @return Document The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategory(Category $v = null)
    {
        if ($v === null) {
            $this->setCategoryId(NULL);
        } else {
            $this->setCategoryId($v->getId());
        }

        $this->aCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Category object, it will not be re-added.
        if ($v !== null) {
            $v->addDocument($this);
        }


        return $this;
    }


    /**
     * Get the associated Category object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Category The associated Category object.
     * @throws PropelException
     */
    public function getCategory(PropelPDO $con = null)
    {
        if ($this->aCategory === null && ($this->category_id !== null)) {
            $this->aCategory = CategoryQuery::create()->findPk($this->category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategory->addDocuments($this);
             */
        }

        return $this->aCategory;
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
        if ('DocumentAuthor' == $relationName) {
            $this->initDocumentAuthors();
        }
        if ('DocumentI18n' == $relationName) {
            $this->initDocumentI18ns();
        }
    }

    /**
     * Clears out the collDocumentAuthors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDocumentAuthors()
     */
    public function clearDocumentAuthors()
    {
        $this->collDocumentAuthors = null; // important to set this to null since that means it is uninitialized
        $this->collDocumentAuthorsPartial = null;
    }

    /**
     * reset is the collDocumentAuthors collection loaded partially
     *
     * @return void
     */
    public function resetPartialDocumentAuthors($v = true)
    {
        $this->collDocumentAuthorsPartial = $v;
    }

    /**
     * Initializes the collDocumentAuthors collection.
     *
     * By default this just sets the collDocumentAuthors collection to an empty array (like clearcollDocumentAuthors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDocumentAuthors($overrideExisting = true)
    {
        if (null !== $this->collDocumentAuthors && !$overrideExisting) {
            return;
        }
        $this->collDocumentAuthors = new PropelObjectCollection();
        $this->collDocumentAuthors->setModel('DocumentAuthor');
    }

    /**
     * Gets an array of DocumentAuthor objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Document is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DocumentAuthor[] List of DocumentAuthor objects
     * @throws PropelException
     */
    public function getDocumentAuthors($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDocumentAuthorsPartial && !$this->isNew();
        if (null === $this->collDocumentAuthors || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDocumentAuthors) {
                // return empty collection
                $this->initDocumentAuthors();
            } else {
                $collDocumentAuthors = DocumentAuthorQuery::create(null, $criteria)
                    ->filterByDocument($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDocumentAuthorsPartial && count($collDocumentAuthors)) {
                      $this->initDocumentAuthors(false);

                      foreach($collDocumentAuthors as $obj) {
                        if (false == $this->collDocumentAuthors->contains($obj)) {
                          $this->collDocumentAuthors->append($obj);
                        }
                      }

                      $this->collDocumentAuthorsPartial = true;
                    }

                    return $collDocumentAuthors;
                }

                if($partial && $this->collDocumentAuthors) {
                    foreach($this->collDocumentAuthors as $obj) {
                        if($obj->isNew()) {
                            $collDocumentAuthors[] = $obj;
                        }
                    }
                }

                $this->collDocumentAuthors = $collDocumentAuthors;
                $this->collDocumentAuthorsPartial = false;
            }
        }

        return $this->collDocumentAuthors;
    }

    /**
     * Sets a collection of DocumentAuthor objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $documentAuthors A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setDocumentAuthors(PropelCollection $documentAuthors, PropelPDO $con = null)
    {
        $this->documentAuthorsScheduledForDeletion = $this->getDocumentAuthors(new Criteria(), $con)->diff($documentAuthors);

        foreach ($this->documentAuthorsScheduledForDeletion as $documentAuthorRemoved) {
            $documentAuthorRemoved->setDocument(null);
        }

        $this->collDocumentAuthors = null;
        foreach ($documentAuthors as $documentAuthor) {
            $this->addDocumentAuthor($documentAuthor);
        }

        $this->collDocumentAuthors = $documentAuthors;
        $this->collDocumentAuthorsPartial = false;
    }

    /**
     * Returns the number of related DocumentAuthor objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DocumentAuthor objects.
     * @throws PropelException
     */
    public function countDocumentAuthors(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDocumentAuthorsPartial && !$this->isNew();
        if (null === $this->collDocumentAuthors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDocumentAuthors) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getDocumentAuthors());
                }
                $query = DocumentAuthorQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByDocument($this)
                    ->count($con);
            }
        } else {
            return count($this->collDocumentAuthors);
        }
    }

    /**
     * Method called to associate a DocumentAuthor object to this object
     * through the DocumentAuthor foreign key attribute.
     *
     * @param    DocumentAuthor $l DocumentAuthor
     * @return Document The current object (for fluent API support)
     */
    public function addDocumentAuthor(DocumentAuthor $l)
    {
        if ($this->collDocumentAuthors === null) {
            $this->initDocumentAuthors();
            $this->collDocumentAuthorsPartial = true;
        }
        if (!$this->collDocumentAuthors->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddDocumentAuthor($l);
        }

        return $this;
    }

    /**
     * @param	DocumentAuthor $documentAuthor The documentAuthor object to add.
     */
    protected function doAddDocumentAuthor($documentAuthor)
    {
        $this->collDocumentAuthors[]= $documentAuthor;
        $documentAuthor->setDocument($this);
    }

    /**
     * @param	DocumentAuthor $documentAuthor The documentAuthor object to remove.
     */
    public function removeDocumentAuthor($documentAuthor)
    {
        if ($this->getDocumentAuthors()->contains($documentAuthor)) {
            $this->collDocumentAuthors->remove($this->collDocumentAuthors->search($documentAuthor));
            if (null === $this->documentAuthorsScheduledForDeletion) {
                $this->documentAuthorsScheduledForDeletion = clone $this->collDocumentAuthors;
                $this->documentAuthorsScheduledForDeletion->clear();
            }
            $this->documentAuthorsScheduledForDeletion[]= $documentAuthor;
            $documentAuthor->setDocument(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Document is new, it will return
     * an empty collection; or if this Document has previously
     * been saved, it will retrieve related DocumentAuthors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Document.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|DocumentAuthor[] List of DocumentAuthor objects
     */
    public function getDocumentAuthorsJoinAuthor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DocumentAuthorQuery::create(null, $criteria);
        $query->joinWith('Author', $join_behavior);

        return $this->getDocumentAuthors($query, $con);
    }

    /**
     * Clears out the collDocumentI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDocumentI18ns()
     */
    public function clearDocumentI18ns()
    {
        $this->collDocumentI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collDocumentI18nsPartial = null;
    }

    /**
     * reset is the collDocumentI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialDocumentI18ns($v = true)
    {
        $this->collDocumentI18nsPartial = $v;
    }

    /**
     * Initializes the collDocumentI18ns collection.
     *
     * By default this just sets the collDocumentI18ns collection to an empty array (like clearcollDocumentI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDocumentI18ns($overrideExisting = true)
    {
        if (null !== $this->collDocumentI18ns && !$overrideExisting) {
            return;
        }
        $this->collDocumentI18ns = new PropelObjectCollection();
        $this->collDocumentI18ns->setModel('DocumentI18n');
    }

    /**
     * Gets an array of DocumentI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Document is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DocumentI18n[] List of DocumentI18n objects
     * @throws PropelException
     */
    public function getDocumentI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDocumentI18nsPartial && !$this->isNew();
        if (null === $this->collDocumentI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDocumentI18ns) {
                // return empty collection
                $this->initDocumentI18ns();
            } else {
                $collDocumentI18ns = DocumentI18nQuery::create(null, $criteria)
                    ->filterByDocument($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDocumentI18nsPartial && count($collDocumentI18ns)) {
                      $this->initDocumentI18ns(false);

                      foreach($collDocumentI18ns as $obj) {
                        if (false == $this->collDocumentI18ns->contains($obj)) {
                          $this->collDocumentI18ns->append($obj);
                        }
                      }

                      $this->collDocumentI18nsPartial = true;
                    }

                    return $collDocumentI18ns;
                }

                if($partial && $this->collDocumentI18ns) {
                    foreach($this->collDocumentI18ns as $obj) {
                        if($obj->isNew()) {
                            $collDocumentI18ns[] = $obj;
                        }
                    }
                }

                $this->collDocumentI18ns = $collDocumentI18ns;
                $this->collDocumentI18nsPartial = false;
            }
        }

        return $this->collDocumentI18ns;
    }

    /**
     * Sets a collection of DocumentI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $documentI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setDocumentI18ns(PropelCollection $documentI18ns, PropelPDO $con = null)
    {
        $this->documentI18nsScheduledForDeletion = $this->getDocumentI18ns(new Criteria(), $con)->diff($documentI18ns);

        foreach ($this->documentI18nsScheduledForDeletion as $documentI18nRemoved) {
            $documentI18nRemoved->setDocument(null);
        }

        $this->collDocumentI18ns = null;
        foreach ($documentI18ns as $documentI18n) {
            $this->addDocumentI18n($documentI18n);
        }

        $this->collDocumentI18ns = $documentI18ns;
        $this->collDocumentI18nsPartial = false;
    }

    /**
     * Returns the number of related DocumentI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DocumentI18n objects.
     * @throws PropelException
     */
    public function countDocumentI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDocumentI18nsPartial && !$this->isNew();
        if (null === $this->collDocumentI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDocumentI18ns) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getDocumentI18ns());
                }
                $query = DocumentI18nQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByDocument($this)
                    ->count($con);
            }
        } else {
            return count($this->collDocumentI18ns);
        }
    }

    /**
     * Method called to associate a DocumentI18n object to this object
     * through the DocumentI18n foreign key attribute.
     *
     * @param    DocumentI18n $l DocumentI18n
     * @return Document The current object (for fluent API support)
     */
    public function addDocumentI18n(DocumentI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collDocumentI18ns === null) {
            $this->initDocumentI18ns();
            $this->collDocumentI18nsPartial = true;
        }
        if (!$this->collDocumentI18ns->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddDocumentI18n($l);
        }

        return $this;
    }

    /**
     * @param	DocumentI18n $documentI18n The documentI18n object to add.
     */
    protected function doAddDocumentI18n($documentI18n)
    {
        $this->collDocumentI18ns[]= $documentI18n;
        $documentI18n->setDocument($this);
    }

    /**
     * @param	DocumentI18n $documentI18n The documentI18n object to remove.
     */
    public function removeDocumentI18n($documentI18n)
    {
        if ($this->getDocumentI18ns()->contains($documentI18n)) {
            $this->collDocumentI18ns->remove($this->collDocumentI18ns->search($documentI18n));
            if (null === $this->documentI18nsScheduledForDeletion) {
                $this->documentI18nsScheduledForDeletion = clone $this->collDocumentI18ns;
                $this->documentI18nsScheduledForDeletion->clear();
            }
            $this->documentI18nsScheduledForDeletion[]= $documentI18n;
            $documentI18n->setDocument(null);
        }
    }

    /**
     * Clears out the collAuthors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAuthors()
     */
    public function clearAuthors()
    {
        $this->collAuthors = null; // important to set this to null since that means it is uninitialized
        $this->collAuthorsPartial = null;
    }

    /**
     * Initializes the collAuthors collection.
     *
     * By default this just sets the collAuthors collection to an empty collection (like clearAuthors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initAuthors()
    {
        $this->collAuthors = new PropelObjectCollection();
        $this->collAuthors->setModel('Author');
    }

    /**
     * Gets a collection of Author objects related by a many-to-many relationship
     * to the current object by way of the document_author cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Document is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Author[] List of Author objects
     */
    public function getAuthors($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collAuthors || null !== $criteria) {
            if ($this->isNew() && null === $this->collAuthors) {
                // return empty collection
                $this->initAuthors();
            } else {
                $collAuthors = AuthorQuery::create(null, $criteria)
                    ->filterByDocument($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collAuthors;
                }
                $this->collAuthors = $collAuthors;
            }
        }

        return $this->collAuthors;
    }

    /**
     * Sets a collection of Author objects related by a many-to-many relationship
     * to the current object by way of the document_author cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authors A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAuthors(PropelCollection $authors, PropelPDO $con = null)
    {
        $this->clearAuthors();
        $currentAuthors = $this->getAuthors();

        $this->authorsScheduledForDeletion = $currentAuthors->diff($authors);

        foreach ($authors as $author) {
            if (!$currentAuthors->contains($author)) {
                $this->doAddAuthor($author);
            }
        }

        $this->collAuthors = $authors;
    }

    /**
     * Gets the number of Author objects related by a many-to-many relationship
     * to the current object by way of the document_author cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Author objects
     */
    public function countAuthors($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collAuthors || null !== $criteria) {
            if ($this->isNew() && null === $this->collAuthors) {
                return 0;
            } else {
                $query = AuthorQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByDocument($this)
                    ->count($con);
            }
        } else {
            return count($this->collAuthors);
        }
    }

    /**
     * Associate a Author object to this object
     * through the document_author cross reference table.
     *
     * @param  Author $author The DocumentAuthor object to relate
     * @return void
     */
    public function addAuthor(Author $author)
    {
        if ($this->collAuthors === null) {
            $this->initAuthors();
        }
        if (!$this->collAuthors->contains($author)) { // only add it if the **same** object is not already associated
            $this->doAddAuthor($author);

            $this->collAuthors[]= $author;
        }
    }

    /**
     * @param	Author $author The author object to add.
     */
    protected function doAddAuthor($author)
    {
        $documentAuthor = new DocumentAuthor();
        $documentAuthor->setAuthor($author);
        $this->addDocumentAuthor($documentAuthor);
    }

    /**
     * Remove a Author object to this object
     * through the document_author cross reference table.
     *
     * @param Author $author The DocumentAuthor object to relate
     * @return void
     */
    public function removeAuthor(Author $author)
    {
        if ($this->getAuthors()->contains($author)) {
            $this->collAuthors->remove($this->collAuthors->search($author));
            if (null === $this->authorsScheduledForDeletion) {
                $this->authorsScheduledForDeletion = clone $this->collAuthors;
                $this->authorsScheduledForDeletion->clear();
            }
            $this->authorsScheduledForDeletion[]= $author;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->category_id = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collDocumentAuthors) {
                foreach ($this->collDocumentAuthors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDocumentI18ns) {
                foreach ($this->collDocumentI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthors) {
                foreach ($this->collAuthors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_EN';
        $this->currentTranslations = null;

        if ($this->collDocumentAuthors instanceof PropelCollection) {
            $this->collDocumentAuthors->clearIterator();
        }
        $this->collDocumentAuthors = null;
        if ($this->collDocumentI18ns instanceof PropelCollection) {
            $this->collDocumentI18ns->clearIterator();
        }
        $this->collDocumentI18ns = null;
        if ($this->collAuthors instanceof PropelCollection) {
            $this->collAuthors->clearIterator();
        }
        $this->collAuthors = null;
        $this->aCategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DocumentPeer::DEFAULT_STRING_FORMAT);
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

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Document The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_EN')
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
     * Gets the locale for translations.
     * Alias for getLocale(), for BC purpose.
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getCulture()
    {
        return $this->getLocale();
    }

    /**
     * Sets the locale for translations.
     * Alias for setLocale(), for BC purpose.
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Document The current object (for fluent API support)
     */
    public function setCulture($locale = 'en_EN')
    {
        return $this->setLocale($locale);
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return DocumentI18n */
    public function getTranslation($locale = 'en_EN', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collDocumentI18ns) {
                foreach ($this->collDocumentI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new DocumentI18n();
                $translation->setLocale($locale);
            } else {
                $translation = DocumentI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addDocumentI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Document The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_EN', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            DocumentI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collDocumentI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collDocumentI18ns[$key]);
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
     * @return DocumentI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [title] column value.
         *
         * @return string
         */
        public function getTitle()
        {
        return $this->getCurrentTranslation()->getTitle();
    }


        /**
         * Set the value of [title] column.
         *
         * @param string $v new value
         * @return DocumentI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }


        /**
         * Get the [body] column value.
         *
         * @return string
         */
        public function getBody()
        {
        return $this->getCurrentTranslation()->getBody();
    }


        /**
         * Set the value of [body] column.
         *
         * @param string $v new value
         * @return DocumentI18n The current object (for fluent API support)
         */
        public function setBody($v)
        {    $this->getCurrentTranslation()->setBody($v);

        return $this;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Document The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = DocumentPeer::UPDATED_AT;

        return $this;
    }

}
