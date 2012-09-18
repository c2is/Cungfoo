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
use Cungfoo\Model\Activite;
use Cungfoo\Model\ActiviteQuery;
use Cungfoo\Model\Baignade;
use Cungfoo\Model\BaignadeQuery;
use Cungfoo\Model\Categorie;
use Cungfoo\Model\CategorieQuery;
use Cungfoo\Model\Destination;
use Cungfoo\Model\DestinationQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementActivite;
use Cungfoo\Model\EtablissementActiviteQuery;
use Cungfoo\Model\EtablissementBaignade;
use Cungfoo\Model\EtablissementBaignadeQuery;
use Cungfoo\Model\EtablissementDestination;
use Cungfoo\Model\EtablissementDestinationQuery;
use Cungfoo\Model\EtablissementI18n;
use Cungfoo\Model\EtablissementI18nQuery;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementServiceComplementaire;
use Cungfoo\Model\EtablissementServiceComplementaireQuery;
use Cungfoo\Model\EtablissementSituationGeographique;
use Cungfoo\Model\EtablissementSituationGeographiqueQuery;
use Cungfoo\Model\EtablissementThematique;
use Cungfoo\Model\EtablissementThematiqueQuery;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\EtablissementTypeHebergementQuery;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\ServiceComplementaireQuery;
use Cungfoo\Model\SituationGeographique;
use Cungfoo\Model\SituationGeographiqueQuery;
use Cungfoo\Model\Thematique;
use Cungfoo\Model\ThematiqueQuery;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementQuery;
use Cungfoo\Model\Ville;
use Cungfoo\Model\VilleQuery;

/**
 * Base class that represents a row from the 'etablissement' table.
 *
 *
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Cungfoo\\Model\\EtablissementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EtablissementPeer
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
     * @var        int
     */
    protected $code;

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
     * The value for the opening_date field.
     * @var        string
     */
    protected $opening_date;

    /**
     * The value for the closing_date field.
     * @var        string
     */
    protected $closing_date;

    /**
     * The value for the ville_id field.
     * @var        int
     */
    protected $ville_id;

    /**
     * The value for the categorie_id field.
     * @var        int
     */
    protected $categorie_id;

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
     * The value for the minimum_price field.
     * @var        string
     */
    protected $minimum_price;

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
     * @var        Ville
     */
    protected $aVille;

    /**
     * @var        Categorie
     */
    protected $aCategorie;

    /**
     * @var        PropelObjectCollection|EtablissementTypeHebergement[] Collection to store aggregation of EtablissementTypeHebergement objects.
     */
    protected $collEtablissementTypeHebergements;
    protected $collEtablissementTypeHebergementsPartial;

    /**
     * @var        PropelObjectCollection|EtablissementDestination[] Collection to store aggregation of EtablissementDestination objects.
     */
    protected $collEtablissementDestinations;
    protected $collEtablissementDestinationsPartial;

    /**
     * @var        PropelObjectCollection|EtablissementActivite[] Collection to store aggregation of EtablissementActivite objects.
     */
    protected $collEtablissementActivites;
    protected $collEtablissementActivitesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementServiceComplementaire[] Collection to store aggregation of EtablissementServiceComplementaire objects.
     */
    protected $collEtablissementServiceComplementaires;
    protected $collEtablissementServiceComplementairesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementSituationGeographique[] Collection to store aggregation of EtablissementSituationGeographique objects.
     */
    protected $collEtablissementSituationGeographiques;
    protected $collEtablissementSituationGeographiquesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementBaignade[] Collection to store aggregation of EtablissementBaignade objects.
     */
    protected $collEtablissementBaignades;
    protected $collEtablissementBaignadesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementThematique[] Collection to store aggregation of EtablissementThematique objects.
     */
    protected $collEtablissementThematiques;
    protected $collEtablissementThematiquesPartial;

    /**
     * @var        PropelObjectCollection|EtablissementI18n[] Collection to store aggregation of EtablissementI18n objects.
     */
    protected $collEtablissementI18ns;
    protected $collEtablissementI18nsPartial;

    /**
     * @var        PropelObjectCollection|TypeHebergement[] Collection to store aggregation of TypeHebergement objects.
     */
    protected $collTypeHebergements;

    /**
     * @var        PropelObjectCollection|Destination[] Collection to store aggregation of Destination objects.
     */
    protected $collDestinations;

    /**
     * @var        PropelObjectCollection|Activite[] Collection to store aggregation of Activite objects.
     */
    protected $collActivites;

    /**
     * @var        PropelObjectCollection|ServiceComplementaire[] Collection to store aggregation of ServiceComplementaire objects.
     */
    protected $collServiceComplementaires;

    /**
     * @var        PropelObjectCollection|SituationGeographique[] Collection to store aggregation of SituationGeographique objects.
     */
    protected $collSituationGeographiques;

    /**
     * @var        PropelObjectCollection|Baignade[] Collection to store aggregation of Baignade objects.
     */
    protected $collBaignades;

    /**
     * @var        PropelObjectCollection|Thematique[] Collection to store aggregation of Thematique objects.
     */
    protected $collThematiques;

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
     * @var        array[EtablissementI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeHebergementsScheduledForDeletion = null;

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
    protected $serviceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $situationGeographiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $baignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $thematiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementTypeHebergementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementDestinationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementActivitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementServiceComplementairesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementSituationGeographiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementBaignadesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementThematiquesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $etablissementI18nsScheduledForDeletion = null;

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
     * @return int
     */
    public function getCode()
    {
        return $this->code;
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
     * Get the [optionally formatted] temporal [opening_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getOpeningDate($format = null)
    {
        if ($this->opening_date === null) {
            return null;
        }

        if ($this->opening_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->opening_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->opening_date, true), $x);
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
     * Get the [optionally formatted] temporal [closing_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getClosingDate($format = null)
    {
        if ($this->closing_date === null) {
            return null;
        }

        if ($this->closing_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->closing_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->closing_date, true), $x);
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
     * Get the [ville_id] column value.
     *
     * @return int
     */
    public function getVilleId()
    {
        return $this->ville_id;
    }

    /**
     * Get the [categorie_id] column value.
     *
     * @return int
     */
    public function getCategorieId()
    {
        return $this->categorie_id;
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
     * Get the [minimum_price] column value.
     *
     * @return string
     */
    public function getMinimumPrice()
    {
        return $this->minimum_price;
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
     * @return Etablissement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EtablissementPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [code] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = EtablissementPeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = EtablissementPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [address1] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address1 !== $v) {
            $this->address1 = $v;
            $this->modifiedColumns[] = EtablissementPeer::ADDRESS1;
        }


        return $this;
    } // setAddress1()

    /**
     * Set the value of [address2] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[] = EtablissementPeer::ADDRESS2;
        }


        return $this;
    } // setAddress2()

    /**
     * Set the value of [zip] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setZip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip !== $v) {
            $this->zip = $v;
            $this->modifiedColumns[] = EtablissementPeer::ZIP;
        }


        return $this;
    } // setZip()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = EtablissementPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[] = EtablissementPeer::MAIL;
        }


        return $this;
    } // setMail()

    /**
     * Set the value of [country_code] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCountryCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country_code !== $v) {
            $this->country_code = $v;
            $this->modifiedColumns[] = EtablissementPeer::COUNTRY_CODE;
        }


        return $this;
    } // setCountryCode()

    /**
     * Set the value of [phone1] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setPhone1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone1 !== $v) {
            $this->phone1 = $v;
            $this->modifiedColumns[] = EtablissementPeer::PHONE1;
        }


        return $this;
    } // setPhone1()

    /**
     * Set the value of [phone2] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setPhone2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone2 !== $v) {
            $this->phone2 = $v;
            $this->modifiedColumns[] = EtablissementPeer::PHONE2;
        }


        return $this;
    } // setPhone2()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[] = EtablissementPeer::FAX;
        }


        return $this;
    } // setFax()

    /**
     * Sets the value of [opening_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setOpeningDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->opening_date !== null || $dt !== null) {
            $currentDateAsString = ($this->opening_date !== null && $tmpDt = new DateTime($this->opening_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->opening_date = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::OPENING_DATE;
            }
        } // if either are not null


        return $this;
    } // setOpeningDate()

    /**
     * Sets the value of [closing_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setClosingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->closing_date !== null || $dt !== null) {
            $currentDateAsString = ($this->closing_date !== null && $tmpDt = new DateTime($this->closing_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->closing_date = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::CLOSING_DATE;
            }
        } // if either are not null


        return $this;
    } // setClosingDate()

    /**
     * Set the value of [ville_id] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setVilleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ville_id !== $v) {
            $this->ville_id = $v;
            $this->modifiedColumns[] = EtablissementPeer::VILLE_ID;
        }

        if ($this->aVille !== null && $this->aVille->getId() !== $v) {
            $this->aVille = null;
        }


        return $this;
    } // setVilleId()

    /**
     * Set the value of [categorie_id] column.
     *
     * @param int $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCategorieId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->categorie_id !== $v) {
            $this->categorie_id = $v;
            $this->modifiedColumns[] = EtablissementPeer::CATEGORIE_ID;
        }

        if ($this->aCategorie !== null && $this->aCategorie->getId() !== $v) {
            $this->aCategorie = null;
        }


        return $this;
    } // setCategorieId()

    /**
     * Set the value of [geo_coordinate_x] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setGeoCoordinateX($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_x !== $v) {
            $this->geo_coordinate_x = $v;
            $this->modifiedColumns[] = EtablissementPeer::GEO_COORDINATE_X;
        }


        return $this;
    } // setGeoCoordinateX()

    /**
     * Set the value of [geo_coordinate_y] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setGeoCoordinateY($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_coordinate_y !== $v) {
            $this->geo_coordinate_y = $v;
            $this->modifiedColumns[] = EtablissementPeer::GEO_COORDINATE_Y;
        }


        return $this;
    } // setGeoCoordinateY()

    /**
     * Set the value of [minimum_price] column.
     *
     * @param string $v new value
     * @return Etablissement The current object (for fluent API support)
     */
    public function setMinimumPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->minimum_price !== $v) {
            $this->minimum_price = $v;
            $this->modifiedColumns[] = EtablissementPeer::MINIMUM_PRICE;
        }


        return $this;
    } // setMinimumPrice()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Etablissement The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = EtablissementPeer::UPDATED_AT;
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
            $this->code = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->address1 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->address2 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->zip = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->city = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->mail = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->country_code = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->phone1 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->phone2 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->fax = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->opening_date = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->closing_date = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->ville_id = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
            $this->categorie_id = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
            $this->geo_coordinate_x = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->geo_coordinate_y = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->minimum_price = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->created_at = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->updated_at = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 21; // 21 = EtablissementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Etablissement object", $e);
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

        if ($this->aVille !== null && $this->ville_id !== $this->aVille->getId()) {
            $this->aVille = null;
        }
        if ($this->aCategorie !== null && $this->categorie_id !== $this->aCategorie->getId()) {
            $this->aCategorie = null;
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
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EtablissementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aVille = null;
            $this->aCategorie = null;
            $this->collEtablissementTypeHebergements = null;

            $this->collEtablissementDestinations = null;

            $this->collEtablissementActivites = null;

            $this->collEtablissementServiceComplementaires = null;

            $this->collEtablissementSituationGeographiques = null;

            $this->collEtablissementBaignades = null;

            $this->collEtablissementThematiques = null;

            $this->collEtablissementI18ns = null;

            $this->collTypeHebergements = null;
            $this->collDestinations = null;
            $this->collActivites = null;
            $this->collServiceComplementaires = null;
            $this->collSituationGeographiques = null;
            $this->collBaignades = null;
            $this->collThematiques = null;
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
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EtablissementQuery::create()
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
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(EtablissementPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(EtablissementPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(EtablissementPeer::UPDATED_AT)) {
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
                EtablissementPeer::addInstanceToPool($this);
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

            if ($this->aVille !== null) {
                if ($this->aVille->isModified() || $this->aVille->isNew()) {
                    $affectedRows += $this->aVille->save($con);
                }
                $this->setVille($this->aVille);
            }

            if ($this->aCategorie !== null) {
                if ($this->aCategorie->isModified() || $this->aCategorie->isNew()) {
                    $affectedRows += $this->aCategorie->save($con);
                }
                $this->setCategorie($this->aCategorie);
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

            if ($this->typeHebergementsScheduledForDeletion !== null) {
                if (!$this->typeHebergementsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->typeHebergementsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementTypeHebergementQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->typeHebergementsScheduledForDeletion = null;
                }

                foreach ($this->getTypeHebergements() as $typeHebergement) {
                    if ($typeHebergement->isModified()) {
                        $typeHebergement->save($con);
                    }
                }
            }

            if ($this->destinationsScheduledForDeletion !== null) {
                if (!$this->destinationsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->destinationsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementDestinationQuery::create()
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
                    EtablissementActiviteQuery::create()
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

            if ($this->serviceComplementairesScheduledForDeletion !== null) {
                if (!$this->serviceComplementairesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->serviceComplementairesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementServiceComplementaireQuery::create()
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

            if ($this->situationGeographiquesScheduledForDeletion !== null) {
                if (!$this->situationGeographiquesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->situationGeographiquesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementSituationGeographiqueQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->situationGeographiquesScheduledForDeletion = null;
                }

                foreach ($this->getSituationGeographiques() as $situationGeographique) {
                    if ($situationGeographique->isModified()) {
                        $situationGeographique->save($con);
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
                    EtablissementBaignadeQuery::create()
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

            if ($this->thematiquesScheduledForDeletion !== null) {
                if (!$this->thematiquesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->thematiquesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    EtablissementThematiqueQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->thematiquesScheduledForDeletion = null;
                }

                foreach ($this->getThematiques() as $thematique) {
                    if ($thematique->isModified()) {
                        $thematique->save($con);
                    }
                }
            }

            if ($this->etablissementTypeHebergementsScheduledForDeletion !== null) {
                if (!$this->etablissementTypeHebergementsScheduledForDeletion->isEmpty()) {
                    EtablissementTypeHebergementQuery::create()
                        ->filterByPrimaryKeys($this->etablissementTypeHebergementsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementTypeHebergementsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementTypeHebergements !== null) {
                foreach ($this->collEtablissementTypeHebergements as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementDestinationsScheduledForDeletion !== null) {
                if (!$this->etablissementDestinationsScheduledForDeletion->isEmpty()) {
                    EtablissementDestinationQuery::create()
                        ->filterByPrimaryKeys($this->etablissementDestinationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementDestinationsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementDestinations !== null) {
                foreach ($this->collEtablissementDestinations as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementActivitesScheduledForDeletion !== null) {
                if (!$this->etablissementActivitesScheduledForDeletion->isEmpty()) {
                    EtablissementActiviteQuery::create()
                        ->filterByPrimaryKeys($this->etablissementActivitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementActivitesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementActivites !== null) {
                foreach ($this->collEtablissementActivites as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementServiceComplementairesScheduledForDeletion !== null) {
                if (!$this->etablissementServiceComplementairesScheduledForDeletion->isEmpty()) {
                    EtablissementServiceComplementaireQuery::create()
                        ->filterByPrimaryKeys($this->etablissementServiceComplementairesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementServiceComplementairesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementServiceComplementaires !== null) {
                foreach ($this->collEtablissementServiceComplementaires as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementSituationGeographiquesScheduledForDeletion !== null) {
                if (!$this->etablissementSituationGeographiquesScheduledForDeletion->isEmpty()) {
                    EtablissementSituationGeographiqueQuery::create()
                        ->filterByPrimaryKeys($this->etablissementSituationGeographiquesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementSituationGeographiquesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementSituationGeographiques !== null) {
                foreach ($this->collEtablissementSituationGeographiques as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementBaignadesScheduledForDeletion !== null) {
                if (!$this->etablissementBaignadesScheduledForDeletion->isEmpty()) {
                    EtablissementBaignadeQuery::create()
                        ->filterByPrimaryKeys($this->etablissementBaignadesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementBaignadesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementBaignades !== null) {
                foreach ($this->collEtablissementBaignades as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementThematiquesScheduledForDeletion !== null) {
                if (!$this->etablissementThematiquesScheduledForDeletion->isEmpty()) {
                    EtablissementThematiqueQuery::create()
                        ->filterByPrimaryKeys($this->etablissementThematiquesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementThematiquesScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementThematiques !== null) {
                foreach ($this->collEtablissementThematiques as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->etablissementI18nsScheduledForDeletion !== null) {
                if (!$this->etablissementI18nsScheduledForDeletion->isEmpty()) {
                    EtablissementI18nQuery::create()
                        ->filterByPrimaryKeys($this->etablissementI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etablissementI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collEtablissementI18ns !== null) {
                foreach ($this->collEtablissementI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = EtablissementPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EtablissementPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EtablissementPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(EtablissementPeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`CODE`';
        }
        if ($this->isColumnModified(EtablissementPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(EtablissementPeer::ADDRESS1)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS1`';
        }
        if ($this->isColumnModified(EtablissementPeer::ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS2`';
        }
        if ($this->isColumnModified(EtablissementPeer::ZIP)) {
            $modifiedColumns[':p' . $index++]  = '`ZIP`';
        }
        if ($this->isColumnModified(EtablissementPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`CITY`';
        }
        if ($this->isColumnModified(EtablissementPeer::MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`MAIL`';
        }
        if ($this->isColumnModified(EtablissementPeer::COUNTRY_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`COUNTRY_CODE`';
        }
        if ($this->isColumnModified(EtablissementPeer::PHONE1)) {
            $modifiedColumns[':p' . $index++]  = '`PHONE1`';
        }
        if ($this->isColumnModified(EtablissementPeer::PHONE2)) {
            $modifiedColumns[':p' . $index++]  = '`PHONE2`';
        }
        if ($this->isColumnModified(EtablissementPeer::FAX)) {
            $modifiedColumns[':p' . $index++]  = '`FAX`';
        }
        if ($this->isColumnModified(EtablissementPeer::OPENING_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`OPENING_DATE`';
        }
        if ($this->isColumnModified(EtablissementPeer::CLOSING_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`CLOSING_DATE`';
        }
        if ($this->isColumnModified(EtablissementPeer::VILLE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`VILLE_ID`';
        }
        if ($this->isColumnModified(EtablissementPeer::CATEGORIE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`CATEGORIE_ID`';
        }
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_X)) {
            $modifiedColumns[':p' . $index++]  = '`GEO_COORDINATE_X`';
        }
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_Y)) {
            $modifiedColumns[':p' . $index++]  = '`GEO_COORDINATE_Y`';
        }
        if ($this->isColumnModified(EtablissementPeer::MINIMUM_PRICE)) {
            $modifiedColumns[':p' . $index++]  = '`MINIMUM_PRICE`';
        }
        if ($this->isColumnModified(EtablissementPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(EtablissementPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `etablissement` (%s) VALUES (%s)',
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
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_INT);
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
                    case '`OPENING_DATE`':
                        $stmt->bindValue($identifier, $this->opening_date, PDO::PARAM_STR);
                        break;
                    case '`CLOSING_DATE`':
                        $stmt->bindValue($identifier, $this->closing_date, PDO::PARAM_STR);
                        break;
                    case '`VILLE_ID`':
                        $stmt->bindValue($identifier, $this->ville_id, PDO::PARAM_INT);
                        break;
                    case '`CATEGORIE_ID`':
                        $stmt->bindValue($identifier, $this->categorie_id, PDO::PARAM_INT);
                        break;
                    case '`GEO_COORDINATE_X`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_x, PDO::PARAM_STR);
                        break;
                    case '`GEO_COORDINATE_Y`':
                        $stmt->bindValue($identifier, $this->geo_coordinate_y, PDO::PARAM_STR);
                        break;
                    case '`MINIMUM_PRICE`':
                        $stmt->bindValue($identifier, $this->minimum_price, PDO::PARAM_STR);
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

            if ($this->aVille !== null) {
                if (!$this->aVille->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aVille->getValidationFailures());
                }
            }

            if ($this->aCategorie !== null) {
                if (!$this->aCategorie->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategorie->getValidationFailures());
                }
            }


            if (($retval = EtablissementPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collEtablissementTypeHebergements !== null) {
                    foreach ($this->collEtablissementTypeHebergements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementDestinations !== null) {
                    foreach ($this->collEtablissementDestinations as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementActivites !== null) {
                    foreach ($this->collEtablissementActivites as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementServiceComplementaires !== null) {
                    foreach ($this->collEtablissementServiceComplementaires as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementSituationGeographiques !== null) {
                    foreach ($this->collEtablissementSituationGeographiques as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementBaignades !== null) {
                    foreach ($this->collEtablissementBaignades as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementThematiques !== null) {
                    foreach ($this->collEtablissementThematiques as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEtablissementI18ns !== null) {
                    foreach ($this->collEtablissementI18ns as $referrerFK) {
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
        $pos = EtablissementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 3:
                return $this->getAddress1();
                break;
            case 4:
                return $this->getAddress2();
                break;
            case 5:
                return $this->getZip();
                break;
            case 6:
                return $this->getCity();
                break;
            case 7:
                return $this->getMail();
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
                return $this->getOpeningDate();
                break;
            case 13:
                return $this->getClosingDate();
                break;
            case 14:
                return $this->getVilleId();
                break;
            case 15:
                return $this->getCategorieId();
                break;
            case 16:
                return $this->getGeoCoordinateX();
                break;
            case 17:
                return $this->getGeoCoordinateY();
                break;
            case 18:
                return $this->getMinimumPrice();
                break;
            case 19:
                return $this->getCreatedAt();
                break;
            case 20:
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
        if (isset($alreadyDumpedObjects['Etablissement'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Etablissement'][$this->getPrimaryKey()] = true;
        $keys = EtablissementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCode(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getAddress1(),
            $keys[4] => $this->getAddress2(),
            $keys[5] => $this->getZip(),
            $keys[6] => $this->getCity(),
            $keys[7] => $this->getMail(),
            $keys[8] => $this->getCountryCode(),
            $keys[9] => $this->getPhone1(),
            $keys[10] => $this->getPhone2(),
            $keys[11] => $this->getFax(),
            $keys[12] => $this->getOpeningDate(),
            $keys[13] => $this->getClosingDate(),
            $keys[14] => $this->getVilleId(),
            $keys[15] => $this->getCategorieId(),
            $keys[16] => $this->getGeoCoordinateX(),
            $keys[17] => $this->getGeoCoordinateY(),
            $keys[18] => $this->getMinimumPrice(),
            $keys[19] => $this->getCreatedAt(),
            $keys[20] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aVille) {
                $result['Ville'] = $this->aVille->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategorie) {
                $result['Categorie'] = $this->aCategorie->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEtablissementTypeHebergements) {
                $result['EtablissementTypeHebergements'] = $this->collEtablissementTypeHebergements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementDestinations) {
                $result['EtablissementDestinations'] = $this->collEtablissementDestinations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementActivites) {
                $result['EtablissementActivites'] = $this->collEtablissementActivites->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementServiceComplementaires) {
                $result['EtablissementServiceComplementaires'] = $this->collEtablissementServiceComplementaires->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementSituationGeographiques) {
                $result['EtablissementSituationGeographiques'] = $this->collEtablissementSituationGeographiques->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementBaignades) {
                $result['EtablissementBaignades'] = $this->collEtablissementBaignades->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementThematiques) {
                $result['EtablissementThematiques'] = $this->collEtablissementThematiques->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEtablissementI18ns) {
                $result['EtablissementI18ns'] = $this->collEtablissementI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = EtablissementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 3:
                $this->setAddress1($value);
                break;
            case 4:
                $this->setAddress2($value);
                break;
            case 5:
                $this->setZip($value);
                break;
            case 6:
                $this->setCity($value);
                break;
            case 7:
                $this->setMail($value);
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
                $this->setOpeningDate($value);
                break;
            case 13:
                $this->setClosingDate($value);
                break;
            case 14:
                $this->setVilleId($value);
                break;
            case 15:
                $this->setCategorieId($value);
                break;
            case 16:
                $this->setGeoCoordinateX($value);
                break;
            case 17:
                $this->setGeoCoordinateY($value);
                break;
            case 18:
                $this->setMinimumPrice($value);
                break;
            case 19:
                $this->setCreatedAt($value);
                break;
            case 20:
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
        $keys = EtablissementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAddress1($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAddress2($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setZip($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCity($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setMail($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCountryCode($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setPhone1($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setPhone2($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setFax($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setOpeningDate($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setClosingDate($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setVilleId($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setCategorieId($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setGeoCoordinateX($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setGeoCoordinateY($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setMinimumPrice($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setCreatedAt($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setUpdatedAt($arr[$keys[20]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);

        if ($this->isColumnModified(EtablissementPeer::ID)) $criteria->add(EtablissementPeer::ID, $this->id);
        if ($this->isColumnModified(EtablissementPeer::CODE)) $criteria->add(EtablissementPeer::CODE, $this->code);
        if ($this->isColumnModified(EtablissementPeer::NAME)) $criteria->add(EtablissementPeer::NAME, $this->name);
        if ($this->isColumnModified(EtablissementPeer::ADDRESS1)) $criteria->add(EtablissementPeer::ADDRESS1, $this->address1);
        if ($this->isColumnModified(EtablissementPeer::ADDRESS2)) $criteria->add(EtablissementPeer::ADDRESS2, $this->address2);
        if ($this->isColumnModified(EtablissementPeer::ZIP)) $criteria->add(EtablissementPeer::ZIP, $this->zip);
        if ($this->isColumnModified(EtablissementPeer::CITY)) $criteria->add(EtablissementPeer::CITY, $this->city);
        if ($this->isColumnModified(EtablissementPeer::MAIL)) $criteria->add(EtablissementPeer::MAIL, $this->mail);
        if ($this->isColumnModified(EtablissementPeer::COUNTRY_CODE)) $criteria->add(EtablissementPeer::COUNTRY_CODE, $this->country_code);
        if ($this->isColumnModified(EtablissementPeer::PHONE1)) $criteria->add(EtablissementPeer::PHONE1, $this->phone1);
        if ($this->isColumnModified(EtablissementPeer::PHONE2)) $criteria->add(EtablissementPeer::PHONE2, $this->phone2);
        if ($this->isColumnModified(EtablissementPeer::FAX)) $criteria->add(EtablissementPeer::FAX, $this->fax);
        if ($this->isColumnModified(EtablissementPeer::OPENING_DATE)) $criteria->add(EtablissementPeer::OPENING_DATE, $this->opening_date);
        if ($this->isColumnModified(EtablissementPeer::CLOSING_DATE)) $criteria->add(EtablissementPeer::CLOSING_DATE, $this->closing_date);
        if ($this->isColumnModified(EtablissementPeer::VILLE_ID)) $criteria->add(EtablissementPeer::VILLE_ID, $this->ville_id);
        if ($this->isColumnModified(EtablissementPeer::CATEGORIE_ID)) $criteria->add(EtablissementPeer::CATEGORIE_ID, $this->categorie_id);
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_X)) $criteria->add(EtablissementPeer::GEO_COORDINATE_X, $this->geo_coordinate_x);
        if ($this->isColumnModified(EtablissementPeer::GEO_COORDINATE_Y)) $criteria->add(EtablissementPeer::GEO_COORDINATE_Y, $this->geo_coordinate_y);
        if ($this->isColumnModified(EtablissementPeer::MINIMUM_PRICE)) $criteria->add(EtablissementPeer::MINIMUM_PRICE, $this->minimum_price);
        if ($this->isColumnModified(EtablissementPeer::CREATED_AT)) $criteria->add(EtablissementPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(EtablissementPeer::UPDATED_AT)) $criteria->add(EtablissementPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);
        $criteria->add(EtablissementPeer::ID, $this->id);

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
     * @param object $copyObj An object of Etablissement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setName($this->getName());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setZip($this->getZip());
        $copyObj->setCity($this->getCity());
        $copyObj->setMail($this->getMail());
        $copyObj->setCountryCode($this->getCountryCode());
        $copyObj->setPhone1($this->getPhone1());
        $copyObj->setPhone2($this->getPhone2());
        $copyObj->setFax($this->getFax());
        $copyObj->setOpeningDate($this->getOpeningDate());
        $copyObj->setClosingDate($this->getClosingDate());
        $copyObj->setVilleId($this->getVilleId());
        $copyObj->setCategorieId($this->getCategorieId());
        $copyObj->setGeoCoordinateX($this->getGeoCoordinateX());
        $copyObj->setGeoCoordinateY($this->getGeoCoordinateY());
        $copyObj->setMinimumPrice($this->getMinimumPrice());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getEtablissementTypeHebergements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementTypeHebergement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementDestinations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementDestination($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementActivites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementActivite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementServiceComplementaires() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementServiceComplementaire($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementSituationGeographiques() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementSituationGeographique($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementBaignades() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementBaignade($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementThematiques() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementThematique($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEtablissementI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtablissementI18n($relObj->copy($deepCopy));
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
     * @return Etablissement Clone of current object.
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
     * @return EtablissementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EtablissementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Ville object.
     *
     * @param             Ville $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVille(Ville $v = null)
    {
        if ($v === null) {
            $this->setVilleId(NULL);
        } else {
            $this->setVilleId($v->getId());
        }

        $this->aVille = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Ville object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissement($this);
        }


        return $this;
    }


    /**
     * Get the associated Ville object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Ville The associated Ville object.
     * @throws PropelException
     */
    public function getVille(PropelPDO $con = null)
    {
        if ($this->aVille === null && ($this->ville_id !== null)) {
            $this->aVille = VilleQuery::create()->findPk($this->ville_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVille->addEtablissements($this);
             */
        }

        return $this->aVille;
    }

    /**
     * Declares an association between this object and a Categorie object.
     *
     * @param             Categorie $v
     * @return Etablissement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategorie(Categorie $v = null)
    {
        if ($v === null) {
            $this->setCategorieId(NULL);
        } else {
            $this->setCategorieId($v->getId());
        }

        $this->aCategorie = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Categorie object, it will not be re-added.
        if ($v !== null) {
            $v->addEtablissement($this);
        }


        return $this;
    }


    /**
     * Get the associated Categorie object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Categorie The associated Categorie object.
     * @throws PropelException
     */
    public function getCategorie(PropelPDO $con = null)
    {
        if ($this->aCategorie === null && ($this->categorie_id !== null)) {
            $this->aCategorie = CategorieQuery::create()->findPk($this->categorie_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategorie->addEtablissements($this);
             */
        }

        return $this->aCategorie;
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
        if ('EtablissementTypeHebergement' == $relationName) {
            $this->initEtablissementTypeHebergements();
        }
        if ('EtablissementDestination' == $relationName) {
            $this->initEtablissementDestinations();
        }
        if ('EtablissementActivite' == $relationName) {
            $this->initEtablissementActivites();
        }
        if ('EtablissementServiceComplementaire' == $relationName) {
            $this->initEtablissementServiceComplementaires();
        }
        if ('EtablissementSituationGeographique' == $relationName) {
            $this->initEtablissementSituationGeographiques();
        }
        if ('EtablissementBaignade' == $relationName) {
            $this->initEtablissementBaignades();
        }
        if ('EtablissementThematique' == $relationName) {
            $this->initEtablissementThematiques();
        }
        if ('EtablissementI18n' == $relationName) {
            $this->initEtablissementI18ns();
        }
    }

    /**
     * Clears out the collEtablissementTypeHebergements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementTypeHebergements()
     */
    public function clearEtablissementTypeHebergements()
    {
        $this->collEtablissementTypeHebergements = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementTypeHebergementsPartial = null;
    }

    /**
     * reset is the collEtablissementTypeHebergements collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementTypeHebergements($v = true)
    {
        $this->collEtablissementTypeHebergementsPartial = $v;
    }

    /**
     * Initializes the collEtablissementTypeHebergements collection.
     *
     * By default this just sets the collEtablissementTypeHebergements collection to an empty array (like clearcollEtablissementTypeHebergements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementTypeHebergements($overrideExisting = true)
    {
        if (null !== $this->collEtablissementTypeHebergements && !$overrideExisting) {
            return;
        }
        $this->collEtablissementTypeHebergements = new PropelObjectCollection();
        $this->collEtablissementTypeHebergements->setModel('EtablissementTypeHebergement');
    }

    /**
     * Gets an array of EtablissementTypeHebergement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementTypeHebergement[] List of EtablissementTypeHebergement objects
     * @throws PropelException
     */
    public function getEtablissementTypeHebergements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementTypeHebergementsPartial && !$this->isNew();
        if (null === $this->collEtablissementTypeHebergements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementTypeHebergements) {
                // return empty collection
                $this->initEtablissementTypeHebergements();
            } else {
                $collEtablissementTypeHebergements = EtablissementTypeHebergementQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementTypeHebergementsPartial && count($collEtablissementTypeHebergements)) {
                      $this->initEtablissementTypeHebergements(false);

                      foreach($collEtablissementTypeHebergements as $obj) {
                        if (false == $this->collEtablissementTypeHebergements->contains($obj)) {
                          $this->collEtablissementTypeHebergements->append($obj);
                        }
                      }

                      $this->collEtablissementTypeHebergementsPartial = true;
                    }

                    return $collEtablissementTypeHebergements;
                }

                if($partial && $this->collEtablissementTypeHebergements) {
                    foreach($this->collEtablissementTypeHebergements as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementTypeHebergements[] = $obj;
                        }
                    }
                }

                $this->collEtablissementTypeHebergements = $collEtablissementTypeHebergements;
                $this->collEtablissementTypeHebergementsPartial = false;
            }
        }

        return $this->collEtablissementTypeHebergements;
    }

    /**
     * Sets a collection of EtablissementTypeHebergement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementTypeHebergements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementTypeHebergements(PropelCollection $etablissementTypeHebergements, PropelPDO $con = null)
    {
        $this->etablissementTypeHebergementsScheduledForDeletion = $this->getEtablissementTypeHebergements(new Criteria(), $con)->diff($etablissementTypeHebergements);

        foreach ($this->etablissementTypeHebergementsScheduledForDeletion as $etablissementTypeHebergementRemoved) {
            $etablissementTypeHebergementRemoved->setEtablissement(null);
        }

        $this->collEtablissementTypeHebergements = null;
        foreach ($etablissementTypeHebergements as $etablissementTypeHebergement) {
            $this->addEtablissementTypeHebergement($etablissementTypeHebergement);
        }

        $this->collEtablissementTypeHebergements = $etablissementTypeHebergements;
        $this->collEtablissementTypeHebergementsPartial = false;
    }

    /**
     * Returns the number of related EtablissementTypeHebergement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementTypeHebergement objects.
     * @throws PropelException
     */
    public function countEtablissementTypeHebergements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementTypeHebergementsPartial && !$this->isNew();
        if (null === $this->collEtablissementTypeHebergements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementTypeHebergements) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementTypeHebergements());
                }
                $query = EtablissementTypeHebergementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementTypeHebergements);
        }
    }

    /**
     * Method called to associate a EtablissementTypeHebergement object to this object
     * through the EtablissementTypeHebergement foreign key attribute.
     *
     * @param    EtablissementTypeHebergement $l EtablissementTypeHebergement
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementTypeHebergement(EtablissementTypeHebergement $l)
    {
        if ($this->collEtablissementTypeHebergements === null) {
            $this->initEtablissementTypeHebergements();
            $this->collEtablissementTypeHebergementsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementTypeHebergements->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementTypeHebergement($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementTypeHebergement $etablissementTypeHebergement The etablissementTypeHebergement object to add.
     */
    protected function doAddEtablissementTypeHebergement($etablissementTypeHebergement)
    {
        $this->collEtablissementTypeHebergements[]= $etablissementTypeHebergement;
        $etablissementTypeHebergement->setEtablissement($this);
    }

    /**
     * @param	EtablissementTypeHebergement $etablissementTypeHebergement The etablissementTypeHebergement object to remove.
     */
    public function removeEtablissementTypeHebergement($etablissementTypeHebergement)
    {
        if ($this->getEtablissementTypeHebergements()->contains($etablissementTypeHebergement)) {
            $this->collEtablissementTypeHebergements->remove($this->collEtablissementTypeHebergements->search($etablissementTypeHebergement));
            if (null === $this->etablissementTypeHebergementsScheduledForDeletion) {
                $this->etablissementTypeHebergementsScheduledForDeletion = clone $this->collEtablissementTypeHebergements;
                $this->etablissementTypeHebergementsScheduledForDeletion->clear();
            }
            $this->etablissementTypeHebergementsScheduledForDeletion[]= $etablissementTypeHebergement;
            $etablissementTypeHebergement->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementTypeHebergements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementTypeHebergement[] List of EtablissementTypeHebergement objects
     */
    public function getEtablissementTypeHebergementsJoinTypeHebergement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementTypeHebergementQuery::create(null, $criteria);
        $query->joinWith('TypeHebergement', $join_behavior);

        return $this->getEtablissementTypeHebergements($query, $con);
    }

    /**
     * Clears out the collEtablissementDestinations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementDestinations()
     */
    public function clearEtablissementDestinations()
    {
        $this->collEtablissementDestinations = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementDestinationsPartial = null;
    }

    /**
     * reset is the collEtablissementDestinations collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementDestinations($v = true)
    {
        $this->collEtablissementDestinationsPartial = $v;
    }

    /**
     * Initializes the collEtablissementDestinations collection.
     *
     * By default this just sets the collEtablissementDestinations collection to an empty array (like clearcollEtablissementDestinations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementDestinations($overrideExisting = true)
    {
        if (null !== $this->collEtablissementDestinations && !$overrideExisting) {
            return;
        }
        $this->collEtablissementDestinations = new PropelObjectCollection();
        $this->collEtablissementDestinations->setModel('EtablissementDestination');
    }

    /**
     * Gets an array of EtablissementDestination objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementDestination[] List of EtablissementDestination objects
     * @throws PropelException
     */
    public function getEtablissementDestinations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementDestinationsPartial && !$this->isNew();
        if (null === $this->collEtablissementDestinations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementDestinations) {
                // return empty collection
                $this->initEtablissementDestinations();
            } else {
                $collEtablissementDestinations = EtablissementDestinationQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementDestinationsPartial && count($collEtablissementDestinations)) {
                      $this->initEtablissementDestinations(false);

                      foreach($collEtablissementDestinations as $obj) {
                        if (false == $this->collEtablissementDestinations->contains($obj)) {
                          $this->collEtablissementDestinations->append($obj);
                        }
                      }

                      $this->collEtablissementDestinationsPartial = true;
                    }

                    return $collEtablissementDestinations;
                }

                if($partial && $this->collEtablissementDestinations) {
                    foreach($this->collEtablissementDestinations as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementDestinations[] = $obj;
                        }
                    }
                }

                $this->collEtablissementDestinations = $collEtablissementDestinations;
                $this->collEtablissementDestinationsPartial = false;
            }
        }

        return $this->collEtablissementDestinations;
    }

    /**
     * Sets a collection of EtablissementDestination objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementDestinations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementDestinations(PropelCollection $etablissementDestinations, PropelPDO $con = null)
    {
        $this->etablissementDestinationsScheduledForDeletion = $this->getEtablissementDestinations(new Criteria(), $con)->diff($etablissementDestinations);

        foreach ($this->etablissementDestinationsScheduledForDeletion as $etablissementDestinationRemoved) {
            $etablissementDestinationRemoved->setEtablissement(null);
        }

        $this->collEtablissementDestinations = null;
        foreach ($etablissementDestinations as $etablissementDestination) {
            $this->addEtablissementDestination($etablissementDestination);
        }

        $this->collEtablissementDestinations = $etablissementDestinations;
        $this->collEtablissementDestinationsPartial = false;
    }

    /**
     * Returns the number of related EtablissementDestination objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementDestination objects.
     * @throws PropelException
     */
    public function countEtablissementDestinations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementDestinationsPartial && !$this->isNew();
        if (null === $this->collEtablissementDestinations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementDestinations) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementDestinations());
                }
                $query = EtablissementDestinationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementDestinations);
        }
    }

    /**
     * Method called to associate a EtablissementDestination object to this object
     * through the EtablissementDestination foreign key attribute.
     *
     * @param    EtablissementDestination $l EtablissementDestination
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementDestination(EtablissementDestination $l)
    {
        if ($this->collEtablissementDestinations === null) {
            $this->initEtablissementDestinations();
            $this->collEtablissementDestinationsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementDestinations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementDestination($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementDestination $etablissementDestination The etablissementDestination object to add.
     */
    protected function doAddEtablissementDestination($etablissementDestination)
    {
        $this->collEtablissementDestinations[]= $etablissementDestination;
        $etablissementDestination->setEtablissement($this);
    }

    /**
     * @param	EtablissementDestination $etablissementDestination The etablissementDestination object to remove.
     */
    public function removeEtablissementDestination($etablissementDestination)
    {
        if ($this->getEtablissementDestinations()->contains($etablissementDestination)) {
            $this->collEtablissementDestinations->remove($this->collEtablissementDestinations->search($etablissementDestination));
            if (null === $this->etablissementDestinationsScheduledForDeletion) {
                $this->etablissementDestinationsScheduledForDeletion = clone $this->collEtablissementDestinations;
                $this->etablissementDestinationsScheduledForDeletion->clear();
            }
            $this->etablissementDestinationsScheduledForDeletion[]= $etablissementDestination;
            $etablissementDestination->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementDestinations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementDestination[] List of EtablissementDestination objects
     */
    public function getEtablissementDestinationsJoinDestination($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementDestinationQuery::create(null, $criteria);
        $query->joinWith('Destination', $join_behavior);

        return $this->getEtablissementDestinations($query, $con);
    }

    /**
     * Clears out the collEtablissementActivites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementActivites()
     */
    public function clearEtablissementActivites()
    {
        $this->collEtablissementActivites = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementActivitesPartial = null;
    }

    /**
     * reset is the collEtablissementActivites collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementActivites($v = true)
    {
        $this->collEtablissementActivitesPartial = $v;
    }

    /**
     * Initializes the collEtablissementActivites collection.
     *
     * By default this just sets the collEtablissementActivites collection to an empty array (like clearcollEtablissementActivites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementActivites($overrideExisting = true)
    {
        if (null !== $this->collEtablissementActivites && !$overrideExisting) {
            return;
        }
        $this->collEtablissementActivites = new PropelObjectCollection();
        $this->collEtablissementActivites->setModel('EtablissementActivite');
    }

    /**
     * Gets an array of EtablissementActivite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementActivite[] List of EtablissementActivite objects
     * @throws PropelException
     */
    public function getEtablissementActivites($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementActivitesPartial && !$this->isNew();
        if (null === $this->collEtablissementActivites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementActivites) {
                // return empty collection
                $this->initEtablissementActivites();
            } else {
                $collEtablissementActivites = EtablissementActiviteQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementActivitesPartial && count($collEtablissementActivites)) {
                      $this->initEtablissementActivites(false);

                      foreach($collEtablissementActivites as $obj) {
                        if (false == $this->collEtablissementActivites->contains($obj)) {
                          $this->collEtablissementActivites->append($obj);
                        }
                      }

                      $this->collEtablissementActivitesPartial = true;
                    }

                    return $collEtablissementActivites;
                }

                if($partial && $this->collEtablissementActivites) {
                    foreach($this->collEtablissementActivites as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementActivites[] = $obj;
                        }
                    }
                }

                $this->collEtablissementActivites = $collEtablissementActivites;
                $this->collEtablissementActivitesPartial = false;
            }
        }

        return $this->collEtablissementActivites;
    }

    /**
     * Sets a collection of EtablissementActivite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementActivites A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementActivites(PropelCollection $etablissementActivites, PropelPDO $con = null)
    {
        $this->etablissementActivitesScheduledForDeletion = $this->getEtablissementActivites(new Criteria(), $con)->diff($etablissementActivites);

        foreach ($this->etablissementActivitesScheduledForDeletion as $etablissementActiviteRemoved) {
            $etablissementActiviteRemoved->setEtablissement(null);
        }

        $this->collEtablissementActivites = null;
        foreach ($etablissementActivites as $etablissementActivite) {
            $this->addEtablissementActivite($etablissementActivite);
        }

        $this->collEtablissementActivites = $etablissementActivites;
        $this->collEtablissementActivitesPartial = false;
    }

    /**
     * Returns the number of related EtablissementActivite objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementActivite objects.
     * @throws PropelException
     */
    public function countEtablissementActivites(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementActivitesPartial && !$this->isNew();
        if (null === $this->collEtablissementActivites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementActivites) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementActivites());
                }
                $query = EtablissementActiviteQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementActivites);
        }
    }

    /**
     * Method called to associate a EtablissementActivite object to this object
     * through the EtablissementActivite foreign key attribute.
     *
     * @param    EtablissementActivite $l EtablissementActivite
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementActivite(EtablissementActivite $l)
    {
        if ($this->collEtablissementActivites === null) {
            $this->initEtablissementActivites();
            $this->collEtablissementActivitesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementActivites->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementActivite($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementActivite $etablissementActivite The etablissementActivite object to add.
     */
    protected function doAddEtablissementActivite($etablissementActivite)
    {
        $this->collEtablissementActivites[]= $etablissementActivite;
        $etablissementActivite->setEtablissement($this);
    }

    /**
     * @param	EtablissementActivite $etablissementActivite The etablissementActivite object to remove.
     */
    public function removeEtablissementActivite($etablissementActivite)
    {
        if ($this->getEtablissementActivites()->contains($etablissementActivite)) {
            $this->collEtablissementActivites->remove($this->collEtablissementActivites->search($etablissementActivite));
            if (null === $this->etablissementActivitesScheduledForDeletion) {
                $this->etablissementActivitesScheduledForDeletion = clone $this->collEtablissementActivites;
                $this->etablissementActivitesScheduledForDeletion->clear();
            }
            $this->etablissementActivitesScheduledForDeletion[]= $etablissementActivite;
            $etablissementActivite->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementActivites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementActivite[] List of EtablissementActivite objects
     */
    public function getEtablissementActivitesJoinActivite($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementActiviteQuery::create(null, $criteria);
        $query->joinWith('Activite', $join_behavior);

        return $this->getEtablissementActivites($query, $con);
    }

    /**
     * Clears out the collEtablissementServiceComplementaires collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementServiceComplementaires()
     */
    public function clearEtablissementServiceComplementaires()
    {
        $this->collEtablissementServiceComplementaires = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementServiceComplementairesPartial = null;
    }

    /**
     * reset is the collEtablissementServiceComplementaires collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementServiceComplementaires($v = true)
    {
        $this->collEtablissementServiceComplementairesPartial = $v;
    }

    /**
     * Initializes the collEtablissementServiceComplementaires collection.
     *
     * By default this just sets the collEtablissementServiceComplementaires collection to an empty array (like clearcollEtablissementServiceComplementaires());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementServiceComplementaires($overrideExisting = true)
    {
        if (null !== $this->collEtablissementServiceComplementaires && !$overrideExisting) {
            return;
        }
        $this->collEtablissementServiceComplementaires = new PropelObjectCollection();
        $this->collEtablissementServiceComplementaires->setModel('EtablissementServiceComplementaire');
    }

    /**
     * Gets an array of EtablissementServiceComplementaire objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementServiceComplementaire[] List of EtablissementServiceComplementaire objects
     * @throws PropelException
     */
    public function getEtablissementServiceComplementaires($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collEtablissementServiceComplementaires || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementServiceComplementaires) {
                // return empty collection
                $this->initEtablissementServiceComplementaires();
            } else {
                $collEtablissementServiceComplementaires = EtablissementServiceComplementaireQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementServiceComplementairesPartial && count($collEtablissementServiceComplementaires)) {
                      $this->initEtablissementServiceComplementaires(false);

                      foreach($collEtablissementServiceComplementaires as $obj) {
                        if (false == $this->collEtablissementServiceComplementaires->contains($obj)) {
                          $this->collEtablissementServiceComplementaires->append($obj);
                        }
                      }

                      $this->collEtablissementServiceComplementairesPartial = true;
                    }

                    return $collEtablissementServiceComplementaires;
                }

                if($partial && $this->collEtablissementServiceComplementaires) {
                    foreach($this->collEtablissementServiceComplementaires as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementServiceComplementaires[] = $obj;
                        }
                    }
                }

                $this->collEtablissementServiceComplementaires = $collEtablissementServiceComplementaires;
                $this->collEtablissementServiceComplementairesPartial = false;
            }
        }

        return $this->collEtablissementServiceComplementaires;
    }

    /**
     * Sets a collection of EtablissementServiceComplementaire objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementServiceComplementaires A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementServiceComplementaires(PropelCollection $etablissementServiceComplementaires, PropelPDO $con = null)
    {
        $this->etablissementServiceComplementairesScheduledForDeletion = $this->getEtablissementServiceComplementaires(new Criteria(), $con)->diff($etablissementServiceComplementaires);

        foreach ($this->etablissementServiceComplementairesScheduledForDeletion as $etablissementServiceComplementaireRemoved) {
            $etablissementServiceComplementaireRemoved->setEtablissement(null);
        }

        $this->collEtablissementServiceComplementaires = null;
        foreach ($etablissementServiceComplementaires as $etablissementServiceComplementaire) {
            $this->addEtablissementServiceComplementaire($etablissementServiceComplementaire);
        }

        $this->collEtablissementServiceComplementaires = $etablissementServiceComplementaires;
        $this->collEtablissementServiceComplementairesPartial = false;
    }

    /**
     * Returns the number of related EtablissementServiceComplementaire objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementServiceComplementaire objects.
     * @throws PropelException
     */
    public function countEtablissementServiceComplementaires(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementServiceComplementairesPartial && !$this->isNew();
        if (null === $this->collEtablissementServiceComplementaires || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementServiceComplementaires) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementServiceComplementaires());
                }
                $query = EtablissementServiceComplementaireQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementServiceComplementaires);
        }
    }

    /**
     * Method called to associate a EtablissementServiceComplementaire object to this object
     * through the EtablissementServiceComplementaire foreign key attribute.
     *
     * @param    EtablissementServiceComplementaire $l EtablissementServiceComplementaire
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementServiceComplementaire(EtablissementServiceComplementaire $l)
    {
        if ($this->collEtablissementServiceComplementaires === null) {
            $this->initEtablissementServiceComplementaires();
            $this->collEtablissementServiceComplementairesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementServiceComplementaires->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementServiceComplementaire($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementServiceComplementaire $etablissementServiceComplementaire The etablissementServiceComplementaire object to add.
     */
    protected function doAddEtablissementServiceComplementaire($etablissementServiceComplementaire)
    {
        $this->collEtablissementServiceComplementaires[]= $etablissementServiceComplementaire;
        $etablissementServiceComplementaire->setEtablissement($this);
    }

    /**
     * @param	EtablissementServiceComplementaire $etablissementServiceComplementaire The etablissementServiceComplementaire object to remove.
     */
    public function removeEtablissementServiceComplementaire($etablissementServiceComplementaire)
    {
        if ($this->getEtablissementServiceComplementaires()->contains($etablissementServiceComplementaire)) {
            $this->collEtablissementServiceComplementaires->remove($this->collEtablissementServiceComplementaires->search($etablissementServiceComplementaire));
            if (null === $this->etablissementServiceComplementairesScheduledForDeletion) {
                $this->etablissementServiceComplementairesScheduledForDeletion = clone $this->collEtablissementServiceComplementaires;
                $this->etablissementServiceComplementairesScheduledForDeletion->clear();
            }
            $this->etablissementServiceComplementairesScheduledForDeletion[]= $etablissementServiceComplementaire;
            $etablissementServiceComplementaire->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementServiceComplementaires from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementServiceComplementaire[] List of EtablissementServiceComplementaire objects
     */
    public function getEtablissementServiceComplementairesJoinServiceComplementaire($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementServiceComplementaireQuery::create(null, $criteria);
        $query->joinWith('ServiceComplementaire', $join_behavior);

        return $this->getEtablissementServiceComplementaires($query, $con);
    }

    /**
     * Clears out the collEtablissementSituationGeographiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementSituationGeographiques()
     */
    public function clearEtablissementSituationGeographiques()
    {
        $this->collEtablissementSituationGeographiques = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementSituationGeographiquesPartial = null;
    }

    /**
     * reset is the collEtablissementSituationGeographiques collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementSituationGeographiques($v = true)
    {
        $this->collEtablissementSituationGeographiquesPartial = $v;
    }

    /**
     * Initializes the collEtablissementSituationGeographiques collection.
     *
     * By default this just sets the collEtablissementSituationGeographiques collection to an empty array (like clearcollEtablissementSituationGeographiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementSituationGeographiques($overrideExisting = true)
    {
        if (null !== $this->collEtablissementSituationGeographiques && !$overrideExisting) {
            return;
        }
        $this->collEtablissementSituationGeographiques = new PropelObjectCollection();
        $this->collEtablissementSituationGeographiques->setModel('EtablissementSituationGeographique');
    }

    /**
     * Gets an array of EtablissementSituationGeographique objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementSituationGeographique[] List of EtablissementSituationGeographique objects
     * @throws PropelException
     */
    public function getEtablissementSituationGeographiques($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementSituationGeographiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementSituationGeographiques || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementSituationGeographiques) {
                // return empty collection
                $this->initEtablissementSituationGeographiques();
            } else {
                $collEtablissementSituationGeographiques = EtablissementSituationGeographiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementSituationGeographiquesPartial && count($collEtablissementSituationGeographiques)) {
                      $this->initEtablissementSituationGeographiques(false);

                      foreach($collEtablissementSituationGeographiques as $obj) {
                        if (false == $this->collEtablissementSituationGeographiques->contains($obj)) {
                          $this->collEtablissementSituationGeographiques->append($obj);
                        }
                      }

                      $this->collEtablissementSituationGeographiquesPartial = true;
                    }

                    return $collEtablissementSituationGeographiques;
                }

                if($partial && $this->collEtablissementSituationGeographiques) {
                    foreach($this->collEtablissementSituationGeographiques as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementSituationGeographiques[] = $obj;
                        }
                    }
                }

                $this->collEtablissementSituationGeographiques = $collEtablissementSituationGeographiques;
                $this->collEtablissementSituationGeographiquesPartial = false;
            }
        }

        return $this->collEtablissementSituationGeographiques;
    }

    /**
     * Sets a collection of EtablissementSituationGeographique objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementSituationGeographiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementSituationGeographiques(PropelCollection $etablissementSituationGeographiques, PropelPDO $con = null)
    {
        $this->etablissementSituationGeographiquesScheduledForDeletion = $this->getEtablissementSituationGeographiques(new Criteria(), $con)->diff($etablissementSituationGeographiques);

        foreach ($this->etablissementSituationGeographiquesScheduledForDeletion as $etablissementSituationGeographiqueRemoved) {
            $etablissementSituationGeographiqueRemoved->setEtablissement(null);
        }

        $this->collEtablissementSituationGeographiques = null;
        foreach ($etablissementSituationGeographiques as $etablissementSituationGeographique) {
            $this->addEtablissementSituationGeographique($etablissementSituationGeographique);
        }

        $this->collEtablissementSituationGeographiques = $etablissementSituationGeographiques;
        $this->collEtablissementSituationGeographiquesPartial = false;
    }

    /**
     * Returns the number of related EtablissementSituationGeographique objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementSituationGeographique objects.
     * @throws PropelException
     */
    public function countEtablissementSituationGeographiques(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementSituationGeographiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementSituationGeographiques || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementSituationGeographiques) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementSituationGeographiques());
                }
                $query = EtablissementSituationGeographiqueQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementSituationGeographiques);
        }
    }

    /**
     * Method called to associate a EtablissementSituationGeographique object to this object
     * through the EtablissementSituationGeographique foreign key attribute.
     *
     * @param    EtablissementSituationGeographique $l EtablissementSituationGeographique
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementSituationGeographique(EtablissementSituationGeographique $l)
    {
        if ($this->collEtablissementSituationGeographiques === null) {
            $this->initEtablissementSituationGeographiques();
            $this->collEtablissementSituationGeographiquesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementSituationGeographiques->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementSituationGeographique($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementSituationGeographique $etablissementSituationGeographique The etablissementSituationGeographique object to add.
     */
    protected function doAddEtablissementSituationGeographique($etablissementSituationGeographique)
    {
        $this->collEtablissementSituationGeographiques[]= $etablissementSituationGeographique;
        $etablissementSituationGeographique->setEtablissement($this);
    }

    /**
     * @param	EtablissementSituationGeographique $etablissementSituationGeographique The etablissementSituationGeographique object to remove.
     */
    public function removeEtablissementSituationGeographique($etablissementSituationGeographique)
    {
        if ($this->getEtablissementSituationGeographiques()->contains($etablissementSituationGeographique)) {
            $this->collEtablissementSituationGeographiques->remove($this->collEtablissementSituationGeographiques->search($etablissementSituationGeographique));
            if (null === $this->etablissementSituationGeographiquesScheduledForDeletion) {
                $this->etablissementSituationGeographiquesScheduledForDeletion = clone $this->collEtablissementSituationGeographiques;
                $this->etablissementSituationGeographiquesScheduledForDeletion->clear();
            }
            $this->etablissementSituationGeographiquesScheduledForDeletion[]= $etablissementSituationGeographique;
            $etablissementSituationGeographique->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementSituationGeographiques from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementSituationGeographique[] List of EtablissementSituationGeographique objects
     */
    public function getEtablissementSituationGeographiquesJoinSituationGeographique($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementSituationGeographiqueQuery::create(null, $criteria);
        $query->joinWith('SituationGeographique', $join_behavior);

        return $this->getEtablissementSituationGeographiques($query, $con);
    }

    /**
     * Clears out the collEtablissementBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementBaignades()
     */
    public function clearEtablissementBaignades()
    {
        $this->collEtablissementBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementBaignadesPartial = null;
    }

    /**
     * reset is the collEtablissementBaignades collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementBaignades($v = true)
    {
        $this->collEtablissementBaignadesPartial = $v;
    }

    /**
     * Initializes the collEtablissementBaignades collection.
     *
     * By default this just sets the collEtablissementBaignades collection to an empty array (like clearcollEtablissementBaignades());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementBaignades($overrideExisting = true)
    {
        if (null !== $this->collEtablissementBaignades && !$overrideExisting) {
            return;
        }
        $this->collEtablissementBaignades = new PropelObjectCollection();
        $this->collEtablissementBaignades->setModel('EtablissementBaignade');
    }

    /**
     * Gets an array of EtablissementBaignade objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementBaignade[] List of EtablissementBaignade objects
     * @throws PropelException
     */
    public function getEtablissementBaignades($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementBaignadesPartial && !$this->isNew();
        if (null === $this->collEtablissementBaignades || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementBaignades) {
                // return empty collection
                $this->initEtablissementBaignades();
            } else {
                $collEtablissementBaignades = EtablissementBaignadeQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementBaignadesPartial && count($collEtablissementBaignades)) {
                      $this->initEtablissementBaignades(false);

                      foreach($collEtablissementBaignades as $obj) {
                        if (false == $this->collEtablissementBaignades->contains($obj)) {
                          $this->collEtablissementBaignades->append($obj);
                        }
                      }

                      $this->collEtablissementBaignadesPartial = true;
                    }

                    return $collEtablissementBaignades;
                }

                if($partial && $this->collEtablissementBaignades) {
                    foreach($this->collEtablissementBaignades as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementBaignades[] = $obj;
                        }
                    }
                }

                $this->collEtablissementBaignades = $collEtablissementBaignades;
                $this->collEtablissementBaignadesPartial = false;
            }
        }

        return $this->collEtablissementBaignades;
    }

    /**
     * Sets a collection of EtablissementBaignade objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementBaignades A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementBaignades(PropelCollection $etablissementBaignades, PropelPDO $con = null)
    {
        $this->etablissementBaignadesScheduledForDeletion = $this->getEtablissementBaignades(new Criteria(), $con)->diff($etablissementBaignades);

        foreach ($this->etablissementBaignadesScheduledForDeletion as $etablissementBaignadeRemoved) {
            $etablissementBaignadeRemoved->setEtablissement(null);
        }

        $this->collEtablissementBaignades = null;
        foreach ($etablissementBaignades as $etablissementBaignade) {
            $this->addEtablissementBaignade($etablissementBaignade);
        }

        $this->collEtablissementBaignades = $etablissementBaignades;
        $this->collEtablissementBaignadesPartial = false;
    }

    /**
     * Returns the number of related EtablissementBaignade objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementBaignade objects.
     * @throws PropelException
     */
    public function countEtablissementBaignades(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementBaignadesPartial && !$this->isNew();
        if (null === $this->collEtablissementBaignades || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementBaignades) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementBaignades());
                }
                $query = EtablissementBaignadeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementBaignades);
        }
    }

    /**
     * Method called to associate a EtablissementBaignade object to this object
     * through the EtablissementBaignade foreign key attribute.
     *
     * @param    EtablissementBaignade $l EtablissementBaignade
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementBaignade(EtablissementBaignade $l)
    {
        if ($this->collEtablissementBaignades === null) {
            $this->initEtablissementBaignades();
            $this->collEtablissementBaignadesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementBaignades->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementBaignade($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementBaignade $etablissementBaignade The etablissementBaignade object to add.
     */
    protected function doAddEtablissementBaignade($etablissementBaignade)
    {
        $this->collEtablissementBaignades[]= $etablissementBaignade;
        $etablissementBaignade->setEtablissement($this);
    }

    /**
     * @param	EtablissementBaignade $etablissementBaignade The etablissementBaignade object to remove.
     */
    public function removeEtablissementBaignade($etablissementBaignade)
    {
        if ($this->getEtablissementBaignades()->contains($etablissementBaignade)) {
            $this->collEtablissementBaignades->remove($this->collEtablissementBaignades->search($etablissementBaignade));
            if (null === $this->etablissementBaignadesScheduledForDeletion) {
                $this->etablissementBaignadesScheduledForDeletion = clone $this->collEtablissementBaignades;
                $this->etablissementBaignadesScheduledForDeletion->clear();
            }
            $this->etablissementBaignadesScheduledForDeletion[]= $etablissementBaignade;
            $etablissementBaignade->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementBaignades from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementBaignade[] List of EtablissementBaignade objects
     */
    public function getEtablissementBaignadesJoinBaignade($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementBaignadeQuery::create(null, $criteria);
        $query->joinWith('Baignade', $join_behavior);

        return $this->getEtablissementBaignades($query, $con);
    }

    /**
     * Clears out the collEtablissementThematiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementThematiques()
     */
    public function clearEtablissementThematiques()
    {
        $this->collEtablissementThematiques = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementThematiquesPartial = null;
    }

    /**
     * reset is the collEtablissementThematiques collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementThematiques($v = true)
    {
        $this->collEtablissementThematiquesPartial = $v;
    }

    /**
     * Initializes the collEtablissementThematiques collection.
     *
     * By default this just sets the collEtablissementThematiques collection to an empty array (like clearcollEtablissementThematiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementThematiques($overrideExisting = true)
    {
        if (null !== $this->collEtablissementThematiques && !$overrideExisting) {
            return;
        }
        $this->collEtablissementThematiques = new PropelObjectCollection();
        $this->collEtablissementThematiques->setModel('EtablissementThematique');
    }

    /**
     * Gets an array of EtablissementThematique objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementThematique[] List of EtablissementThematique objects
     * @throws PropelException
     */
    public function getEtablissementThematiques($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementThematiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementThematiques || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementThematiques) {
                // return empty collection
                $this->initEtablissementThematiques();
            } else {
                $collEtablissementThematiques = EtablissementThematiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementThematiquesPartial && count($collEtablissementThematiques)) {
                      $this->initEtablissementThematiques(false);

                      foreach($collEtablissementThematiques as $obj) {
                        if (false == $this->collEtablissementThematiques->contains($obj)) {
                          $this->collEtablissementThematiques->append($obj);
                        }
                      }

                      $this->collEtablissementThematiquesPartial = true;
                    }

                    return $collEtablissementThematiques;
                }

                if($partial && $this->collEtablissementThematiques) {
                    foreach($this->collEtablissementThematiques as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementThematiques[] = $obj;
                        }
                    }
                }

                $this->collEtablissementThematiques = $collEtablissementThematiques;
                $this->collEtablissementThematiquesPartial = false;
            }
        }

        return $this->collEtablissementThematiques;
    }

    /**
     * Sets a collection of EtablissementThematique objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementThematiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementThematiques(PropelCollection $etablissementThematiques, PropelPDO $con = null)
    {
        $this->etablissementThematiquesScheduledForDeletion = $this->getEtablissementThematiques(new Criteria(), $con)->diff($etablissementThematiques);

        foreach ($this->etablissementThematiquesScheduledForDeletion as $etablissementThematiqueRemoved) {
            $etablissementThematiqueRemoved->setEtablissement(null);
        }

        $this->collEtablissementThematiques = null;
        foreach ($etablissementThematiques as $etablissementThematique) {
            $this->addEtablissementThematique($etablissementThematique);
        }

        $this->collEtablissementThematiques = $etablissementThematiques;
        $this->collEtablissementThematiquesPartial = false;
    }

    /**
     * Returns the number of related EtablissementThematique objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementThematique objects.
     * @throws PropelException
     */
    public function countEtablissementThematiques(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementThematiquesPartial && !$this->isNew();
        if (null === $this->collEtablissementThematiques || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementThematiques) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementThematiques());
                }
                $query = EtablissementThematiqueQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementThematiques);
        }
    }

    /**
     * Method called to associate a EtablissementThematique object to this object
     * through the EtablissementThematique foreign key attribute.
     *
     * @param    EtablissementThematique $l EtablissementThematique
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementThematique(EtablissementThematique $l)
    {
        if ($this->collEtablissementThematiques === null) {
            $this->initEtablissementThematiques();
            $this->collEtablissementThematiquesPartial = true;
        }
        if (!in_array($l, $this->collEtablissementThematiques->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementThematique($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementThematique $etablissementThematique The etablissementThematique object to add.
     */
    protected function doAddEtablissementThematique($etablissementThematique)
    {
        $this->collEtablissementThematiques[]= $etablissementThematique;
        $etablissementThematique->setEtablissement($this);
    }

    /**
     * @param	EtablissementThematique $etablissementThematique The etablissementThematique object to remove.
     */
    public function removeEtablissementThematique($etablissementThematique)
    {
        if ($this->getEtablissementThematiques()->contains($etablissementThematique)) {
            $this->collEtablissementThematiques->remove($this->collEtablissementThematiques->search($etablissementThematique));
            if (null === $this->etablissementThematiquesScheduledForDeletion) {
                $this->etablissementThematiquesScheduledForDeletion = clone $this->collEtablissementThematiques;
                $this->etablissementThematiquesScheduledForDeletion->clear();
            }
            $this->etablissementThematiquesScheduledForDeletion[]= $etablissementThematique;
            $etablissementThematique->setEtablissement(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Etablissement is new, it will return
     * an empty collection; or if this Etablissement has previously
     * been saved, it will retrieve related EtablissementThematiques from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Etablissement.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|EtablissementThematique[] List of EtablissementThematique objects
     */
    public function getEtablissementThematiquesJoinThematique($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EtablissementThematiqueQuery::create(null, $criteria);
        $query->joinWith('Thematique', $join_behavior);

        return $this->getEtablissementThematiques($query, $con);
    }

    /**
     * Clears out the collEtablissementI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtablissementI18ns()
     */
    public function clearEtablissementI18ns()
    {
        $this->collEtablissementI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collEtablissementI18nsPartial = null;
    }

    /**
     * reset is the collEtablissementI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialEtablissementI18ns($v = true)
    {
        $this->collEtablissementI18nsPartial = $v;
    }

    /**
     * Initializes the collEtablissementI18ns collection.
     *
     * By default this just sets the collEtablissementI18ns collection to an empty array (like clearcollEtablissementI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtablissementI18ns($overrideExisting = true)
    {
        if (null !== $this->collEtablissementI18ns && !$overrideExisting) {
            return;
        }
        $this->collEtablissementI18ns = new PropelObjectCollection();
        $this->collEtablissementI18ns->setModel('EtablissementI18n');
    }

    /**
     * Gets an array of EtablissementI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|EtablissementI18n[] List of EtablissementI18n objects
     * @throws PropelException
     */
    public function getEtablissementI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementI18nsPartial && !$this->isNew();
        if (null === $this->collEtablissementI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtablissementI18ns) {
                // return empty collection
                $this->initEtablissementI18ns();
            } else {
                $collEtablissementI18ns = EtablissementI18nQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEtablissementI18nsPartial && count($collEtablissementI18ns)) {
                      $this->initEtablissementI18ns(false);

                      foreach($collEtablissementI18ns as $obj) {
                        if (false == $this->collEtablissementI18ns->contains($obj)) {
                          $this->collEtablissementI18ns->append($obj);
                        }
                      }

                      $this->collEtablissementI18nsPartial = true;
                    }

                    return $collEtablissementI18ns;
                }

                if($partial && $this->collEtablissementI18ns) {
                    foreach($this->collEtablissementI18ns as $obj) {
                        if($obj->isNew()) {
                            $collEtablissementI18ns[] = $obj;
                        }
                    }
                }

                $this->collEtablissementI18ns = $collEtablissementI18ns;
                $this->collEtablissementI18nsPartial = false;
            }
        }

        return $this->collEtablissementI18ns;
    }

    /**
     * Sets a collection of EtablissementI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $etablissementI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setEtablissementI18ns(PropelCollection $etablissementI18ns, PropelPDO $con = null)
    {
        $this->etablissementI18nsScheduledForDeletion = $this->getEtablissementI18ns(new Criteria(), $con)->diff($etablissementI18ns);

        foreach ($this->etablissementI18nsScheduledForDeletion as $etablissementI18nRemoved) {
            $etablissementI18nRemoved->setEtablissement(null);
        }

        $this->collEtablissementI18ns = null;
        foreach ($etablissementI18ns as $etablissementI18n) {
            $this->addEtablissementI18n($etablissementI18n);
        }

        $this->collEtablissementI18ns = $etablissementI18ns;
        $this->collEtablissementI18nsPartial = false;
    }

    /**
     * Returns the number of related EtablissementI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related EtablissementI18n objects.
     * @throws PropelException
     */
    public function countEtablissementI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEtablissementI18nsPartial && !$this->isNew();
        if (null === $this->collEtablissementI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtablissementI18ns) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getEtablissementI18ns());
                }
                $query = EtablissementI18nQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collEtablissementI18ns);
        }
    }

    /**
     * Method called to associate a EtablissementI18n object to this object
     * through the EtablissementI18n foreign key attribute.
     *
     * @param    EtablissementI18n $l EtablissementI18n
     * @return Etablissement The current object (for fluent API support)
     */
    public function addEtablissementI18n(EtablissementI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collEtablissementI18ns === null) {
            $this->initEtablissementI18ns();
            $this->collEtablissementI18nsPartial = true;
        }
        if (!in_array($l, $this->collEtablissementI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEtablissementI18n($l);
        }

        return $this;
    }

    /**
     * @param	EtablissementI18n $etablissementI18n The etablissementI18n object to add.
     */
    protected function doAddEtablissementI18n($etablissementI18n)
    {
        $this->collEtablissementI18ns[]= $etablissementI18n;
        $etablissementI18n->setEtablissement($this);
    }

    /**
     * @param	EtablissementI18n $etablissementI18n The etablissementI18n object to remove.
     */
    public function removeEtablissementI18n($etablissementI18n)
    {
        if ($this->getEtablissementI18ns()->contains($etablissementI18n)) {
            $this->collEtablissementI18ns->remove($this->collEtablissementI18ns->search($etablissementI18n));
            if (null === $this->etablissementI18nsScheduledForDeletion) {
                $this->etablissementI18nsScheduledForDeletion = clone $this->collEtablissementI18ns;
                $this->etablissementI18nsScheduledForDeletion->clear();
            }
            $this->etablissementI18nsScheduledForDeletion[]= $etablissementI18n;
            $etablissementI18n->setEtablissement(null);
        }
    }

    /**
     * Clears out the collTypeHebergements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTypeHebergements()
     */
    public function clearTypeHebergements()
    {
        $this->collTypeHebergements = null; // important to set this to null since that means it is uninitialized
        $this->collTypeHebergementsPartial = null;
    }

    /**
     * Initializes the collTypeHebergements collection.
     *
     * By default this just sets the collTypeHebergements collection to an empty collection (like clearTypeHebergements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initTypeHebergements()
    {
        $this->collTypeHebergements = new PropelObjectCollection();
        $this->collTypeHebergements->setModel('TypeHebergement');
    }

    /**
     * Gets a collection of TypeHebergement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|TypeHebergement[] List of TypeHebergement objects
     */
    public function getTypeHebergements($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collTypeHebergements || null !== $criteria) {
            if ($this->isNew() && null === $this->collTypeHebergements) {
                // return empty collection
                $this->initTypeHebergements();
            } else {
                $collTypeHebergements = TypeHebergementQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collTypeHebergements;
                }
                $this->collTypeHebergements = $collTypeHebergements;
            }
        }

        return $this->collTypeHebergements;
    }

    /**
     * Sets a collection of TypeHebergement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeHebergements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTypeHebergements(PropelCollection $typeHebergements, PropelPDO $con = null)
    {
        $this->clearTypeHebergements();
        $currentTypeHebergements = $this->getTypeHebergements();

        $this->typeHebergementsScheduledForDeletion = $currentTypeHebergements->diff($typeHebergements);

        foreach ($typeHebergements as $typeHebergement) {
            if (!$currentTypeHebergements->contains($typeHebergement)) {
                $this->doAddTypeHebergement($typeHebergement);
            }
        }

        $this->collTypeHebergements = $typeHebergements;
    }

    /**
     * Gets the number of TypeHebergement objects related by a many-to-many relationship
     * to the current object by way of the etablissement_type_hebergement cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related TypeHebergement objects
     */
    public function countTypeHebergements($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collTypeHebergements || null !== $criteria) {
            if ($this->isNew() && null === $this->collTypeHebergements) {
                return 0;
            } else {
                $query = TypeHebergementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collTypeHebergements);
        }
    }

    /**
     * Associate a TypeHebergement object to this object
     * through the etablissement_type_hebergement cross reference table.
     *
     * @param  TypeHebergement $typeHebergement The EtablissementTypeHebergement object to relate
     * @return void
     */
    public function addTypeHebergement(TypeHebergement $typeHebergement)
    {
        if ($this->collTypeHebergements === null) {
            $this->initTypeHebergements();
        }
        if (!$this->collTypeHebergements->contains($typeHebergement)) { // only add it if the **same** object is not already associated
            $this->doAddTypeHebergement($typeHebergement);

            $this->collTypeHebergements[]= $typeHebergement;
        }
    }

    /**
     * @param	TypeHebergement $typeHebergement The typeHebergement object to add.
     */
    protected function doAddTypeHebergement($typeHebergement)
    {
        $etablissementTypeHebergement = new EtablissementTypeHebergement();
        $etablissementTypeHebergement->setTypeHebergement($typeHebergement);
        $this->addEtablissementTypeHebergement($etablissementTypeHebergement);
    }

    /**
     * Remove a TypeHebergement object to this object
     * through the etablissement_type_hebergement cross reference table.
     *
     * @param TypeHebergement $typeHebergement The EtablissementTypeHebergement object to relate
     * @return void
     */
    public function removeTypeHebergement(TypeHebergement $typeHebergement)
    {
        if ($this->getTypeHebergements()->contains($typeHebergement)) {
            $this->collTypeHebergements->remove($this->collTypeHebergements->search($typeHebergement));
            if (null === $this->typeHebergementsScheduledForDeletion) {
                $this->typeHebergementsScheduledForDeletion = clone $this->collTypeHebergements;
                $this->typeHebergementsScheduledForDeletion->clear();
            }
            $this->typeHebergementsScheduledForDeletion[]= $typeHebergement;
        }
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
     * to the current object by way of the etablissement_destination cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
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
                    ->filterByEtablissement($this)
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
     * to the current object by way of the etablissement_destination cross-reference table.
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
     * to the current object by way of the etablissement_destination cross-reference table.
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
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collDestinations);
        }
    }

    /**
     * Associate a Destination object to this object
     * through the etablissement_destination cross reference table.
     *
     * @param  Destination $destination The EtablissementDestination object to relate
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
        $etablissementDestination = new EtablissementDestination();
        $etablissementDestination->setDestination($destination);
        $this->addEtablissementDestination($etablissementDestination);
    }

    /**
     * Remove a Destination object to this object
     * through the etablissement_destination cross reference table.
     *
     * @param Destination $destination The EtablissementDestination object to relate
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
     * to the current object by way of the etablissement_activite cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
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
                    ->filterByEtablissement($this)
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
     * to the current object by way of the etablissement_activite cross-reference table.
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
     * to the current object by way of the etablissement_activite cross-reference table.
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
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collActivites);
        }
    }

    /**
     * Associate a Activite object to this object
     * through the etablissement_activite cross reference table.
     *
     * @param  Activite $activite The EtablissementActivite object to relate
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
        $etablissementActivite = new EtablissementActivite();
        $etablissementActivite->setActivite($activite);
        $this->addEtablissementActivite($etablissementActivite);
    }

    /**
     * Remove a Activite object to this object
     * through the etablissement_activite cross reference table.
     *
     * @param Activite $activite The EtablissementActivite object to relate
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
     * to the current object by way of the etablissement_service_complementaire cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
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
                    ->filterByEtablissement($this)
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
     * to the current object by way of the etablissement_service_complementaire cross-reference table.
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
     * to the current object by way of the etablissement_service_complementaire cross-reference table.
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
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collServiceComplementaires);
        }
    }

    /**
     * Associate a ServiceComplementaire object to this object
     * through the etablissement_service_complementaire cross reference table.
     *
     * @param  ServiceComplementaire $serviceComplementaire The EtablissementServiceComplementaire object to relate
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
        $etablissementServiceComplementaire = new EtablissementServiceComplementaire();
        $etablissementServiceComplementaire->setServiceComplementaire($serviceComplementaire);
        $this->addEtablissementServiceComplementaire($etablissementServiceComplementaire);
    }

    /**
     * Remove a ServiceComplementaire object to this object
     * through the etablissement_service_complementaire cross reference table.
     *
     * @param ServiceComplementaire $serviceComplementaire The EtablissementServiceComplementaire object to relate
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
     * Clears out the collSituationGeographiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSituationGeographiques()
     */
    public function clearSituationGeographiques()
    {
        $this->collSituationGeographiques = null; // important to set this to null since that means it is uninitialized
        $this->collSituationGeographiquesPartial = null;
    }

    /**
     * Initializes the collSituationGeographiques collection.
     *
     * By default this just sets the collSituationGeographiques collection to an empty collection (like clearSituationGeographiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSituationGeographiques()
    {
        $this->collSituationGeographiques = new PropelObjectCollection();
        $this->collSituationGeographiques->setModel('SituationGeographique');
    }

    /**
     * Gets a collection of SituationGeographique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_situation_geographique cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|SituationGeographique[] List of SituationGeographique objects
     */
    public function getSituationGeographiques($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSituationGeographiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collSituationGeographiques) {
                // return empty collection
                $this->initSituationGeographiques();
            } else {
                $collSituationGeographiques = SituationGeographiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSituationGeographiques;
                }
                $this->collSituationGeographiques = $collSituationGeographiques;
            }
        }

        return $this->collSituationGeographiques;
    }

    /**
     * Sets a collection of SituationGeographique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_situation_geographique cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $situationGeographiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setSituationGeographiques(PropelCollection $situationGeographiques, PropelPDO $con = null)
    {
        $this->clearSituationGeographiques();
        $currentSituationGeographiques = $this->getSituationGeographiques();

        $this->situationGeographiquesScheduledForDeletion = $currentSituationGeographiques->diff($situationGeographiques);

        foreach ($situationGeographiques as $situationGeographique) {
            if (!$currentSituationGeographiques->contains($situationGeographique)) {
                $this->doAddSituationGeographique($situationGeographique);
            }
        }

        $this->collSituationGeographiques = $situationGeographiques;
    }

    /**
     * Gets the number of SituationGeographique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_situation_geographique cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related SituationGeographique objects
     */
    public function countSituationGeographiques($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSituationGeographiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collSituationGeographiques) {
                return 0;
            } else {
                $query = SituationGeographiqueQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collSituationGeographiques);
        }
    }

    /**
     * Associate a SituationGeographique object to this object
     * through the etablissement_situation_geographique cross reference table.
     *
     * @param  SituationGeographique $situationGeographique The EtablissementSituationGeographique object to relate
     * @return void
     */
    public function addSituationGeographique(SituationGeographique $situationGeographique)
    {
        if ($this->collSituationGeographiques === null) {
            $this->initSituationGeographiques();
        }
        if (!$this->collSituationGeographiques->contains($situationGeographique)) { // only add it if the **same** object is not already associated
            $this->doAddSituationGeographique($situationGeographique);

            $this->collSituationGeographiques[]= $situationGeographique;
        }
    }

    /**
     * @param	SituationGeographique $situationGeographique The situationGeographique object to add.
     */
    protected function doAddSituationGeographique($situationGeographique)
    {
        $etablissementSituationGeographique = new EtablissementSituationGeographique();
        $etablissementSituationGeographique->setSituationGeographique($situationGeographique);
        $this->addEtablissementSituationGeographique($etablissementSituationGeographique);
    }

    /**
     * Remove a SituationGeographique object to this object
     * through the etablissement_situation_geographique cross reference table.
     *
     * @param SituationGeographique $situationGeographique The EtablissementSituationGeographique object to relate
     * @return void
     */
    public function removeSituationGeographique(SituationGeographique $situationGeographique)
    {
        if ($this->getSituationGeographiques()->contains($situationGeographique)) {
            $this->collSituationGeographiques->remove($this->collSituationGeographiques->search($situationGeographique));
            if (null === $this->situationGeographiquesScheduledForDeletion) {
                $this->situationGeographiquesScheduledForDeletion = clone $this->collSituationGeographiques;
                $this->situationGeographiquesScheduledForDeletion->clear();
            }
            $this->situationGeographiquesScheduledForDeletion[]= $situationGeographique;
        }
    }

    /**
     * Clears out the collBaignades collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBaignades()
     */
    public function clearBaignades()
    {
        $this->collBaignades = null; // important to set this to null since that means it is uninitialized
        $this->collBaignadesPartial = null;
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
     * to the current object by way of the etablissement_baignade cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
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
                    ->filterByEtablissement($this)
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
     * to the current object by way of the etablissement_baignade cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $baignades A Propel collection.
     * @param PropelPDO $con Optional connection object
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
    }

    /**
     * Gets the number of Baignade objects related by a many-to-many relationship
     * to the current object by way of the etablissement_baignade cross-reference table.
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
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collBaignades);
        }
    }

    /**
     * Associate a Baignade object to this object
     * through the etablissement_baignade cross reference table.
     *
     * @param  Baignade $baignade The EtablissementBaignade object to relate
     * @return void
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
    }

    /**
     * @param	Baignade $baignade The baignade object to add.
     */
    protected function doAddBaignade($baignade)
    {
        $etablissementBaignade = new EtablissementBaignade();
        $etablissementBaignade->setBaignade($baignade);
        $this->addEtablissementBaignade($etablissementBaignade);
    }

    /**
     * Remove a Baignade object to this object
     * through the etablissement_baignade cross reference table.
     *
     * @param Baignade $baignade The EtablissementBaignade object to relate
     * @return void
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
    }

    /**
     * Clears out the collThematiques collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addThematiques()
     */
    public function clearThematiques()
    {
        $this->collThematiques = null; // important to set this to null since that means it is uninitialized
        $this->collThematiquesPartial = null;
    }

    /**
     * Initializes the collThematiques collection.
     *
     * By default this just sets the collThematiques collection to an empty collection (like clearThematiques());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initThematiques()
    {
        $this->collThematiques = new PropelObjectCollection();
        $this->collThematiques->setModel('Thematique');
    }

    /**
     * Gets a collection of Thematique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_thematique cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Etablissement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Thematique[] List of Thematique objects
     */
    public function getThematiques($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collThematiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collThematiques) {
                // return empty collection
                $this->initThematiques();
            } else {
                $collThematiques = ThematiqueQuery::create(null, $criteria)
                    ->filterByEtablissement($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collThematiques;
                }
                $this->collThematiques = $collThematiques;
            }
        }

        return $this->collThematiques;
    }

    /**
     * Sets a collection of Thematique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_thematique cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $thematiques A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setThematiques(PropelCollection $thematiques, PropelPDO $con = null)
    {
        $this->clearThematiques();
        $currentThematiques = $this->getThematiques();

        $this->thematiquesScheduledForDeletion = $currentThematiques->diff($thematiques);

        foreach ($thematiques as $thematique) {
            if (!$currentThematiques->contains($thematique)) {
                $this->doAddThematique($thematique);
            }
        }

        $this->collThematiques = $thematiques;
    }

    /**
     * Gets the number of Thematique objects related by a many-to-many relationship
     * to the current object by way of the etablissement_thematique cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Thematique objects
     */
    public function countThematiques($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collThematiques || null !== $criteria) {
            if ($this->isNew() && null === $this->collThematiques) {
                return 0;
            } else {
                $query = ThematiqueQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEtablissement($this)
                    ->count($con);
            }
        } else {
            return count($this->collThematiques);
        }
    }

    /**
     * Associate a Thematique object to this object
     * through the etablissement_thematique cross reference table.
     *
     * @param  Thematique $thematique The EtablissementThematique object to relate
     * @return void
     */
    public function addThematique(Thematique $thematique)
    {
        if ($this->collThematiques === null) {
            $this->initThematiques();
        }
        if (!$this->collThematiques->contains($thematique)) { // only add it if the **same** object is not already associated
            $this->doAddThematique($thematique);

            $this->collThematiques[]= $thematique;
        }
    }

    /**
     * @param	Thematique $thematique The thematique object to add.
     */
    protected function doAddThematique($thematique)
    {
        $etablissementThematique = new EtablissementThematique();
        $etablissementThematique->setThematique($thematique);
        $this->addEtablissementThematique($etablissementThematique);
    }

    /**
     * Remove a Thematique object to this object
     * through the etablissement_thematique cross reference table.
     *
     * @param Thematique $thematique The EtablissementThematique object to relate
     * @return void
     */
    public function removeThematique(Thematique $thematique)
    {
        if ($this->getThematiques()->contains($thematique)) {
            $this->collThematiques->remove($this->collThematiques->search($thematique));
            if (null === $this->thematiquesScheduledForDeletion) {
                $this->thematiquesScheduledForDeletion = clone $this->collThematiques;
                $this->thematiquesScheduledForDeletion->clear();
            }
            $this->thematiquesScheduledForDeletion[]= $thematique;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->code = null;
        $this->name = null;
        $this->address1 = null;
        $this->address2 = null;
        $this->zip = null;
        $this->city = null;
        $this->mail = null;
        $this->country_code = null;
        $this->phone1 = null;
        $this->phone2 = null;
        $this->fax = null;
        $this->opening_date = null;
        $this->closing_date = null;
        $this->ville_id = null;
        $this->categorie_id = null;
        $this->geo_coordinate_x = null;
        $this->geo_coordinate_y = null;
        $this->minimum_price = null;
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
            if ($this->collEtablissementTypeHebergements) {
                foreach ($this->collEtablissementTypeHebergements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementDestinations) {
                foreach ($this->collEtablissementDestinations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementActivites) {
                foreach ($this->collEtablissementActivites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementServiceComplementaires) {
                foreach ($this->collEtablissementServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementSituationGeographiques) {
                foreach ($this->collEtablissementSituationGeographiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementBaignades) {
                foreach ($this->collEtablissementBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementThematiques) {
                foreach ($this->collEtablissementThematiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEtablissementI18ns) {
                foreach ($this->collEtablissementI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeHebergements) {
                foreach ($this->collTypeHebergements as $o) {
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
            if ($this->collServiceComplementaires) {
                foreach ($this->collServiceComplementaires as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSituationGeographiques) {
                foreach ($this->collSituationGeographiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBaignades) {
                foreach ($this->collBaignades as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThematiques) {
                foreach ($this->collThematiques as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'fr';
        $this->currentTranslations = null;

        if ($this->collEtablissementTypeHebergements instanceof PropelCollection) {
            $this->collEtablissementTypeHebergements->clearIterator();
        }
        $this->collEtablissementTypeHebergements = null;
        if ($this->collEtablissementDestinations instanceof PropelCollection) {
            $this->collEtablissementDestinations->clearIterator();
        }
        $this->collEtablissementDestinations = null;
        if ($this->collEtablissementActivites instanceof PropelCollection) {
            $this->collEtablissementActivites->clearIterator();
        }
        $this->collEtablissementActivites = null;
        if ($this->collEtablissementServiceComplementaires instanceof PropelCollection) {
            $this->collEtablissementServiceComplementaires->clearIterator();
        }
        $this->collEtablissementServiceComplementaires = null;
        if ($this->collEtablissementSituationGeographiques instanceof PropelCollection) {
            $this->collEtablissementSituationGeographiques->clearIterator();
        }
        $this->collEtablissementSituationGeographiques = null;
        if ($this->collEtablissementBaignades instanceof PropelCollection) {
            $this->collEtablissementBaignades->clearIterator();
        }
        $this->collEtablissementBaignades = null;
        if ($this->collEtablissementThematiques instanceof PropelCollection) {
            $this->collEtablissementThematiques->clearIterator();
        }
        $this->collEtablissementThematiques = null;
        if ($this->collEtablissementI18ns instanceof PropelCollection) {
            $this->collEtablissementI18ns->clearIterator();
        }
        $this->collEtablissementI18ns = null;
        if ($this->collTypeHebergements instanceof PropelCollection) {
            $this->collTypeHebergements->clearIterator();
        }
        $this->collTypeHebergements = null;
        if ($this->collDestinations instanceof PropelCollection) {
            $this->collDestinations->clearIterator();
        }
        $this->collDestinations = null;
        if ($this->collActivites instanceof PropelCollection) {
            $this->collActivites->clearIterator();
        }
        $this->collActivites = null;
        if ($this->collServiceComplementaires instanceof PropelCollection) {
            $this->collServiceComplementaires->clearIterator();
        }
        $this->collServiceComplementaires = null;
        if ($this->collSituationGeographiques instanceof PropelCollection) {
            $this->collSituationGeographiques->clearIterator();
        }
        $this->collSituationGeographiques = null;
        if ($this->collBaignades instanceof PropelCollection) {
            $this->collBaignades->clearIterator();
        }
        $this->collBaignades = null;
        if ($this->collThematiques instanceof PropelCollection) {
            $this->collThematiques->clearIterator();
        }
        $this->collThematiques = null;
        $this->aVille = null;
        $this->aCategorie = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EtablissementPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Etablissement The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = EtablissementPeer::UPDATED_AT;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Etablissement The current object (for fluent API support)
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
     * @return EtablissementI18n */
    public function getTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collEtablissementI18ns) {
                foreach ($this->collEtablissementI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new EtablissementI18n();
                $translation->setLocale($locale);
            } else {
                $translation = EtablissementI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addEtablissementI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Etablissement The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'fr', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            EtablissementI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collEtablissementI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collEtablissementI18ns[$key]);
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
     * @return EtablissementI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [country] column value.
         *
         * @return string
         */
        public function getCountry()
        {
        return $this->getCurrentTranslation()->getCountry();
    }


        /**
         * Set the value of [country] column.
         *
         * @param string $v new value
         * @return EtablissementI18n The current object (for fluent API support)
         */
        public function setCountry($v)
        {    $this->getCurrentTranslation()->setCountry($v);

        return $this;
    }

}
