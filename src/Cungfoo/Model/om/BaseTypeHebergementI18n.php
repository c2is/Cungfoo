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
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementI18n;
use Cungfoo\Model\TypeHebergementI18nPeer;
use Cungfoo\Model\TypeHebergementI18nQuery;
use Cungfoo\Model\TypeHebergementQuery;
use Propel\BaseObject;

/**
 * Base class that represents a row from the 'type_hebergement_i18n' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergementI18n extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\TypeHebergementI18nPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TypeHebergementI18nPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the indice field.
     * @var        string
     */
    protected $indice;

    /**
     * The value for the surface field.
     * @var        string
     */
    protected $surface;

    /**
     * The value for the type_terrasse field.
     * @var        string
     */
    protected $type_terrasse;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the composition field.
     * @var        string
     */
    protected $composition;

    /**
     * The value for the presentation field.
     * @var        string
     */
    protected $presentation;

    /**
     * The value for the capacite_hebergement field.
     * @var        string
     */
    protected $capacite_hebergement;

    /**
     * The value for the dimensions field.
     * @var        string
     */
    protected $dimensions;

    /**
     * The value for the agencement field.
     * @var        string
     */
    protected $agencement;

    /**
     * The value for the equipements field.
     * @var        string
     */
    protected $equipements;

    /**
     * The value for the annee_utilisation field.
     * @var        string
     */
    protected $annee_utilisation;

    /**
     * The value for the remarque_1 field.
     * @var        string
     */
    protected $remarque_1;

    /**
     * The value for the remarque_2 field.
     * @var        string
     */
    protected $remarque_2;

    /**
     * The value for the remarque_3 field.
     * @var        string
     */
    protected $remarque_3;

    /**
     * The value for the remarque_4 field.
     * @var        string
     */
    protected $remarque_4;

    /**
     * The value for the active_locale field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active_locale;

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
     * Initializes internal state of BaseTypeHebergementI18n object.
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the [indice] column value.
     *
     * @return string
     */
    public function getIndice()
    {
        return $this->indice;
    }

    /**
     * Get the [surface] column value.
     *
     * @return string
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Get the [type_terrasse] column value.
     *
     * @return string
     */
    public function getTypeTerrasse()
    {
        return $this->type_terrasse;
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
     * Get the [composition] column value.
     *
     * @return string
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * Get the [presentation] column value.
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Get the [capacite_hebergement] column value.
     *
     * @return string
     */
    public function getCapaciteHebergement()
    {
        return $this->capacite_hebergement;
    }

    /**
     * Get the [dimensions] column value.
     *
     * @return string
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Get the [agencement] column value.
     *
     * @return string
     */
    public function getAgencement()
    {
        return $this->agencement;
    }

    /**
     * Get the [equipements] column value.
     *
     * @return string
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    /**
     * Get the [annee_utilisation] column value.
     *
     * @return string
     */
    public function getAnneeUtilisation()
    {
        return $this->annee_utilisation;
    }

    /**
     * Get the [remarque_1] column value.
     *
     * @return string
     */
    public function getRemarque1()
    {
        return $this->remarque_1;
    }

    /**
     * Get the [remarque_2] column value.
     *
     * @return string
     */
    public function getRemarque2()
    {
        return $this->remarque_2;
    }

    /**
     * Get the [remarque_3] column value.
     *
     * @return string
     */
    public function getRemarque3()
    {
        return $this->remarque_3;
    }

    /**
     * Get the [remarque_4] column value.
     *
     * @return string
     */
    public function getRemarque4()
    {
        return $this->remarque_4;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::ID;
        }

        if ($this->aTypeHebergement !== null && $this->aTypeHebergement->getId() !== $v) {
            $this->aTypeHebergement = null;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [locale] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setLocale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locale !== $v) {
            $this->locale = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::LOCALE;
        }


        return $this;
    } // setLocale()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [indice] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setIndice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->indice !== $v) {
            $this->indice = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::INDICE;
        }


        return $this;
    } // setIndice()

    /**
     * Set the value of [surface] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setSurface($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->surface !== $v) {
            $this->surface = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::SURFACE;
        }


        return $this;
    } // setSurface()

    /**
     * Set the value of [type_terrasse] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setTypeTerrasse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type_terrasse !== $v) {
            $this->type_terrasse = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::TYPE_TERRASSE;
        }


        return $this;
    } // setTypeTerrasse()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [composition] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setComposition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->composition !== $v) {
            $this->composition = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::COMPOSITION;
        }


        return $this;
    } // setComposition()

    /**
     * Set the value of [presentation] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setPresentation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->presentation !== $v) {
            $this->presentation = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::PRESENTATION;
        }


        return $this;
    } // setPresentation()

    /**
     * Set the value of [capacite_hebergement] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setCapaciteHebergement($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->capacite_hebergement !== $v) {
            $this->capacite_hebergement = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT;
        }


        return $this;
    } // setCapaciteHebergement()

    /**
     * Set the value of [dimensions] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setDimensions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dimensions !== $v) {
            $this->dimensions = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::DIMENSIONS;
        }


        return $this;
    } // setDimensions()

    /**
     * Set the value of [agencement] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setAgencement($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agencement !== $v) {
            $this->agencement = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::AGENCEMENT;
        }


        return $this;
    } // setAgencement()

    /**
     * Set the value of [equipements] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setEquipements($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->equipements !== $v) {
            $this->equipements = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::EQUIPEMENTS;
        }


        return $this;
    } // setEquipements()

    /**
     * Set the value of [annee_utilisation] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setAnneeUtilisation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->annee_utilisation !== $v) {
            $this->annee_utilisation = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::ANNEE_UTILISATION;
        }


        return $this;
    } // setAnneeUtilisation()

    /**
     * Set the value of [remarque_1] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setRemarque1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remarque_1 !== $v) {
            $this->remarque_1 = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::REMARQUE_1;
        }


        return $this;
    } // setRemarque1()

    /**
     * Set the value of [remarque_2] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setRemarque2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remarque_2 !== $v) {
            $this->remarque_2 = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::REMARQUE_2;
        }


        return $this;
    } // setRemarque2()

    /**
     * Set the value of [remarque_3] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setRemarque3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remarque_3 !== $v) {
            $this->remarque_3 = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::REMARQUE_3;
        }


        return $this;
    } // setRemarque3()

    /**
     * Set the value of [remarque_4] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setRemarque4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remarque_4 !== $v) {
            $this->remarque_4 = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::REMARQUE_4;
        }


        return $this;
    } // setRemarque4()

    /**
     * Sets the value of the [active_locale] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TypeHebergementI18n The current object (for fluent API support)
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
            $this->modifiedColumns[] = TypeHebergementI18nPeer::ACTIVE_LOCALE;
        }


        return $this;
    } // setActiveLocale()

    /**
     * Set the value of [seo_title] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setSeoTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_title !== $v) {
            $this->seo_title = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::SEO_TITLE;
        }


        return $this;
    } // setSeoTitle()

    /**
     * Set the value of [seo_description] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setSeoDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_description !== $v) {
            $this->seo_description = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::SEO_DESCRIPTION;
        }


        return $this;
    } // setSeoDescription()

    /**
     * Set the value of [seo_h1] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setSeoH1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_h1 !== $v) {
            $this->seo_h1 = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::SEO_H1;
        }


        return $this;
    } // setSeoH1()

    /**
     * Set the value of [seo_keywords] column.
     *
     * @param string $v new value
     * @return TypeHebergementI18n The current object (for fluent API support)
     */
    public function setSeoKeywords($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seo_keywords !== $v) {
            $this->seo_keywords = $v;
            $this->modifiedColumns[] = TypeHebergementI18nPeer::SEO_KEYWORDS;
        }


        return $this;
    } // setSeoKeywords()

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
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->slug = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->indice = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->surface = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->type_terrasse = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->description = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->composition = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->presentation = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->capacite_hebergement = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->dimensions = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->agencement = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->equipements = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->annee_utilisation = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->remarque_1 = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->remarque_2 = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->remarque_3 = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->remarque_4 = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->active_locale = ($row[$startcol + 19] !== null) ? (boolean) $row[$startcol + 19] : null;
            $this->seo_title = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->seo_description = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->seo_h1 = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->seo_keywords = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 24; // 24 = TypeHebergementI18nPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TypeHebergementI18n object", $e);
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

        if ($this->aTypeHebergement !== null && $this->id !== $this->aTypeHebergement->getId()) {
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
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TypeHebergementI18nPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

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
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TypeHebergementI18nQuery::create()
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
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TypeHebergementI18nPeer::addInstanceToPool($this);
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
        if ($this->isColumnModified(TypeHebergementI18nPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`locale`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::INDICE)) {
            $modifiedColumns[':p' . $index++]  = '`indice`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::SURFACE)) {
            $modifiedColumns[':p' . $index++]  = '`surface`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::TYPE_TERRASSE)) {
            $modifiedColumns[':p' . $index++]  = '`type_terrasse`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::COMPOSITION)) {
            $modifiedColumns[':p' . $index++]  = '`composition`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::PRESENTATION)) {
            $modifiedColumns[':p' . $index++]  = '`presentation`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT)) {
            $modifiedColumns[':p' . $index++]  = '`capacite_hebergement`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::DIMENSIONS)) {
            $modifiedColumns[':p' . $index++]  = '`dimensions`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::AGENCEMENT)) {
            $modifiedColumns[':p' . $index++]  = '`agencement`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::EQUIPEMENTS)) {
            $modifiedColumns[':p' . $index++]  = '`equipements`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::ANNEE_UTILISATION)) {
            $modifiedColumns[':p' . $index++]  = '`annee_utilisation`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_1)) {
            $modifiedColumns[':p' . $index++]  = '`remarque_1`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_2)) {
            $modifiedColumns[':p' . $index++]  = '`remarque_2`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_3)) {
            $modifiedColumns[':p' . $index++]  = '`remarque_3`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_4)) {
            $modifiedColumns[':p' . $index++]  = '`remarque_4`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::ACTIVE_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`active_locale`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`seo_title`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`seo_description`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_H1)) {
            $modifiedColumns[':p' . $index++]  = '`seo_h1`';
        }
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_KEYWORDS)) {
            $modifiedColumns[':p' . $index++]  = '`seo_keywords`';
        }

        $sql = sprintf(
            'INSERT INTO `type_hebergement_i18n` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`indice`':
                        $stmt->bindValue($identifier, $this->indice, PDO::PARAM_STR);
                        break;
                    case '`surface`':
                        $stmt->bindValue($identifier, $this->surface, PDO::PARAM_STR);
                        break;
                    case '`type_terrasse`':
                        $stmt->bindValue($identifier, $this->type_terrasse, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`composition`':
                        $stmt->bindValue($identifier, $this->composition, PDO::PARAM_STR);
                        break;
                    case '`presentation`':
                        $stmt->bindValue($identifier, $this->presentation, PDO::PARAM_STR);
                        break;
                    case '`capacite_hebergement`':
                        $stmt->bindValue($identifier, $this->capacite_hebergement, PDO::PARAM_STR);
                        break;
                    case '`dimensions`':
                        $stmt->bindValue($identifier, $this->dimensions, PDO::PARAM_STR);
                        break;
                    case '`agencement`':
                        $stmt->bindValue($identifier, $this->agencement, PDO::PARAM_STR);
                        break;
                    case '`equipements`':
                        $stmt->bindValue($identifier, $this->equipements, PDO::PARAM_STR);
                        break;
                    case '`annee_utilisation`':
                        $stmt->bindValue($identifier, $this->annee_utilisation, PDO::PARAM_STR);
                        break;
                    case '`remarque_1`':
                        $stmt->bindValue($identifier, $this->remarque_1, PDO::PARAM_STR);
                        break;
                    case '`remarque_2`':
                        $stmt->bindValue($identifier, $this->remarque_2, PDO::PARAM_STR);
                        break;
                    case '`remarque_3`':
                        $stmt->bindValue($identifier, $this->remarque_3, PDO::PARAM_STR);
                        break;
                    case '`remarque_4`':
                        $stmt->bindValue($identifier, $this->remarque_4, PDO::PARAM_STR);
                        break;
                    case '`active_locale`':
                        $stmt->bindValue($identifier, (int) $this->active_locale, PDO::PARAM_INT);
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

            if ($this->aTypeHebergement !== null) {
                if (!$this->aTypeHebergement->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeHebergement->getValidationFailures());
                }
            }


            if (($retval = TypeHebergementI18nPeer::doValidate($this, $columns)) !== true) {
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
        $pos = TypeHebergementI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 3:
                return $this->getSlug();
                break;
            case 4:
                return $this->getIndice();
                break;
            case 5:
                return $this->getSurface();
                break;
            case 6:
                return $this->getTypeTerrasse();
                break;
            case 7:
                return $this->getDescription();
                break;
            case 8:
                return $this->getComposition();
                break;
            case 9:
                return $this->getPresentation();
                break;
            case 10:
                return $this->getCapaciteHebergement();
                break;
            case 11:
                return $this->getDimensions();
                break;
            case 12:
                return $this->getAgencement();
                break;
            case 13:
                return $this->getEquipements();
                break;
            case 14:
                return $this->getAnneeUtilisation();
                break;
            case 15:
                return $this->getRemarque1();
                break;
            case 16:
                return $this->getRemarque2();
                break;
            case 17:
                return $this->getRemarque3();
                break;
            case 18:
                return $this->getRemarque4();
                break;
            case 19:
                return $this->getActiveLocale();
                break;
            case 20:
                return $this->getSeoTitle();
                break;
            case 21:
                return $this->getSeoDescription();
                break;
            case 22:
                return $this->getSeoH1();
                break;
            case 23:
                return $this->getSeoKeywords();
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
        if (isset($alreadyDumpedObjects['TypeHebergementI18n'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TypeHebergementI18n'][serialize($this->getPrimaryKey())] = true;
        $keys = TypeHebergementI18nPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLocale(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getSlug(),
            $keys[4] => $this->getIndice(),
            $keys[5] => $this->getSurface(),
            $keys[6] => $this->getTypeTerrasse(),
            $keys[7] => $this->getDescription(),
            $keys[8] => $this->getComposition(),
            $keys[9] => $this->getPresentation(),
            $keys[10] => $this->getCapaciteHebergement(),
            $keys[11] => $this->getDimensions(),
            $keys[12] => $this->getAgencement(),
            $keys[13] => $this->getEquipements(),
            $keys[14] => $this->getAnneeUtilisation(),
            $keys[15] => $this->getRemarque1(),
            $keys[16] => $this->getRemarque2(),
            $keys[17] => $this->getRemarque3(),
            $keys[18] => $this->getRemarque4(),
            $keys[19] => $this->getActiveLocale(),
            $keys[20] => $this->getSeoTitle(),
            $keys[21] => $this->getSeoDescription(),
            $keys[22] => $this->getSeoH1(),
            $keys[23] => $this->getSeoKeywords(),
        );
        if ($includeForeignObjects) {
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
        $pos = TypeHebergementI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 3:
                $this->setSlug($value);
                break;
            case 4:
                $this->setIndice($value);
                break;
            case 5:
                $this->setSurface($value);
                break;
            case 6:
                $this->setTypeTerrasse($value);
                break;
            case 7:
                $this->setDescription($value);
                break;
            case 8:
                $this->setComposition($value);
                break;
            case 9:
                $this->setPresentation($value);
                break;
            case 10:
                $this->setCapaciteHebergement($value);
                break;
            case 11:
                $this->setDimensions($value);
                break;
            case 12:
                $this->setAgencement($value);
                break;
            case 13:
                $this->setEquipements($value);
                break;
            case 14:
                $this->setAnneeUtilisation($value);
                break;
            case 15:
                $this->setRemarque1($value);
                break;
            case 16:
                $this->setRemarque2($value);
                break;
            case 17:
                $this->setRemarque3($value);
                break;
            case 18:
                $this->setRemarque4($value);
                break;
            case 19:
                $this->setActiveLocale($value);
                break;
            case 20:
                $this->setSeoTitle($value);
                break;
            case 21:
                $this->setSeoDescription($value);
                break;
            case 22:
                $this->setSeoH1($value);
                break;
            case 23:
                $this->setSeoKeywords($value);
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
        $keys = TypeHebergementI18nPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLocale($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSlug($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setIndice($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setSurface($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setTypeTerrasse($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDescription($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setComposition($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setPresentation($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCapaciteHebergement($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDimensions($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setAgencement($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setEquipements($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setAnneeUtilisation($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setRemarque1($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setRemarque2($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setRemarque3($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setRemarque4($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setActiveLocale($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setSeoTitle($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setSeoDescription($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setSeoH1($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setSeoKeywords($arr[$keys[23]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TypeHebergementI18nPeer::DATABASE_NAME);

        if ($this->isColumnModified(TypeHebergementI18nPeer::ID)) $criteria->add(TypeHebergementI18nPeer::ID, $this->id);
        if ($this->isColumnModified(TypeHebergementI18nPeer::LOCALE)) $criteria->add(TypeHebergementI18nPeer::LOCALE, $this->locale);
        if ($this->isColumnModified(TypeHebergementI18nPeer::NAME)) $criteria->add(TypeHebergementI18nPeer::NAME, $this->name);
        if ($this->isColumnModified(TypeHebergementI18nPeer::SLUG)) $criteria->add(TypeHebergementI18nPeer::SLUG, $this->slug);
        if ($this->isColumnModified(TypeHebergementI18nPeer::INDICE)) $criteria->add(TypeHebergementI18nPeer::INDICE, $this->indice);
        if ($this->isColumnModified(TypeHebergementI18nPeer::SURFACE)) $criteria->add(TypeHebergementI18nPeer::SURFACE, $this->surface);
        if ($this->isColumnModified(TypeHebergementI18nPeer::TYPE_TERRASSE)) $criteria->add(TypeHebergementI18nPeer::TYPE_TERRASSE, $this->type_terrasse);
        if ($this->isColumnModified(TypeHebergementI18nPeer::DESCRIPTION)) $criteria->add(TypeHebergementI18nPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(TypeHebergementI18nPeer::COMPOSITION)) $criteria->add(TypeHebergementI18nPeer::COMPOSITION, $this->composition);
        if ($this->isColumnModified(TypeHebergementI18nPeer::PRESENTATION)) $criteria->add(TypeHebergementI18nPeer::PRESENTATION, $this->presentation);
        if ($this->isColumnModified(TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT)) $criteria->add(TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT, $this->capacite_hebergement);
        if ($this->isColumnModified(TypeHebergementI18nPeer::DIMENSIONS)) $criteria->add(TypeHebergementI18nPeer::DIMENSIONS, $this->dimensions);
        if ($this->isColumnModified(TypeHebergementI18nPeer::AGENCEMENT)) $criteria->add(TypeHebergementI18nPeer::AGENCEMENT, $this->agencement);
        if ($this->isColumnModified(TypeHebergementI18nPeer::EQUIPEMENTS)) $criteria->add(TypeHebergementI18nPeer::EQUIPEMENTS, $this->equipements);
        if ($this->isColumnModified(TypeHebergementI18nPeer::ANNEE_UTILISATION)) $criteria->add(TypeHebergementI18nPeer::ANNEE_UTILISATION, $this->annee_utilisation);
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_1)) $criteria->add(TypeHebergementI18nPeer::REMARQUE_1, $this->remarque_1);
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_2)) $criteria->add(TypeHebergementI18nPeer::REMARQUE_2, $this->remarque_2);
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_3)) $criteria->add(TypeHebergementI18nPeer::REMARQUE_3, $this->remarque_3);
        if ($this->isColumnModified(TypeHebergementI18nPeer::REMARQUE_4)) $criteria->add(TypeHebergementI18nPeer::REMARQUE_4, $this->remarque_4);
        if ($this->isColumnModified(TypeHebergementI18nPeer::ACTIVE_LOCALE)) $criteria->add(TypeHebergementI18nPeer::ACTIVE_LOCALE, $this->active_locale);
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_TITLE)) $criteria->add(TypeHebergementI18nPeer::SEO_TITLE, $this->seo_title);
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_DESCRIPTION)) $criteria->add(TypeHebergementI18nPeer::SEO_DESCRIPTION, $this->seo_description);
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_H1)) $criteria->add(TypeHebergementI18nPeer::SEO_H1, $this->seo_h1);
        if ($this->isColumnModified(TypeHebergementI18nPeer::SEO_KEYWORDS)) $criteria->add(TypeHebergementI18nPeer::SEO_KEYWORDS, $this->seo_keywords);

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
        $criteria = new Criteria(TypeHebergementI18nPeer::DATABASE_NAME);
        $criteria->add(TypeHebergementI18nPeer::ID, $this->id);
        $criteria->add(TypeHebergementI18nPeer::LOCALE, $this->locale);

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
     * @param object $copyObj An object of TypeHebergementI18n (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setLocale($this->getLocale());
        $copyObj->setName($this->getName());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setIndice($this->getIndice());
        $copyObj->setSurface($this->getSurface());
        $copyObj->setTypeTerrasse($this->getTypeTerrasse());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setComposition($this->getComposition());
        $copyObj->setPresentation($this->getPresentation());
        $copyObj->setCapaciteHebergement($this->getCapaciteHebergement());
        $copyObj->setDimensions($this->getDimensions());
        $copyObj->setAgencement($this->getAgencement());
        $copyObj->setEquipements($this->getEquipements());
        $copyObj->setAnneeUtilisation($this->getAnneeUtilisation());
        $copyObj->setRemarque1($this->getRemarque1());
        $copyObj->setRemarque2($this->getRemarque2());
        $copyObj->setRemarque3($this->getRemarque3());
        $copyObj->setRemarque4($this->getRemarque4());
        $copyObj->setActiveLocale($this->getActiveLocale());
        $copyObj->setSeoTitle($this->getSeoTitle());
        $copyObj->setSeoDescription($this->getSeoDescription());
        $copyObj->setSeoH1($this->getSeoH1());
        $copyObj->setSeoKeywords($this->getSeoKeywords());

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
     * @return TypeHebergementI18n Clone of current object.
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
     * @return TypeHebergementI18nPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TypeHebergementI18nPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TypeHebergement object.
     *
     * @param             TypeHebergement $v
     * @return TypeHebergementI18n The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTypeHebergement(TypeHebergement $v = null)
    {
        if ($v === null) {
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aTypeHebergement = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TypeHebergement object, it will not be re-added.
        if ($v !== null) {
            $v->addTypeHebergementI18n($this);
        }


        return $this;
    }


    /**
     * Get the associated TypeHebergement object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return TypeHebergement The associated TypeHebergement object.
     * @throws PropelException
     */
    public function getTypeHebergement(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTypeHebergement === null && ($this->id !== null) && $doQuery) {
            $this->aTypeHebergement = TypeHebergementQuery::create()->findPk($this->id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypeHebergement->addTypeHebergementI18ns($this);
             */
        }

        return $this->aTypeHebergement;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->locale = null;
        $this->name = null;
        $this->slug = null;
        $this->indice = null;
        $this->surface = null;
        $this->type_terrasse = null;
        $this->description = null;
        $this->composition = null;
        $this->presentation = null;
        $this->capacite_hebergement = null;
        $this->dimensions = null;
        $this->agencement = null;
        $this->equipements = null;
        $this->annee_utilisation = null;
        $this->remarque_1 = null;
        $this->remarque_2 = null;
        $this->remarque_3 = null;
        $this->remarque_4 = null;
        $this->active_locale = null;
        $this->seo_title = null;
        $this->seo_description = null;
        $this->seo_h1 = null;
        $this->seo_keywords = null;
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

        $this->aTypeHebergement = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TypeHebergementI18nPeer::DEFAULT_STRING_FORMAT);
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
