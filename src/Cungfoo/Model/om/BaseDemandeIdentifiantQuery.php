<?php

namespace Cungfoo\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Cungfoo\Model\DemandeIdentifiant;
use Cungfoo\Model\DemandeIdentifiantI18n;
use Cungfoo\Model\DemandeIdentifiantPeer;
use Cungfoo\Model\DemandeIdentifiantQuery;

/**
 * Base class that represents a query for the 'demande_identifiant' table.
 *
 *
 *
 * @method DemandeIdentifiantQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DemandeIdentifiantQuery orderBySocieteNom($order = Criteria::ASC) Order by the societe_nom column
 * @method DemandeIdentifiantQuery orderBySocieteAdresse1($order = Criteria::ASC) Order by the societe_adresse_1 column
 * @method DemandeIdentifiantQuery orderBySocieteAdresse2($order = Criteria::ASC) Order by the societe_adresse_2 column
 * @method DemandeIdentifiantQuery orderBySocieteAdresse3($order = Criteria::ASC) Order by the societe_adresse_3 column
 * @method DemandeIdentifiantQuery orderBySocieteAdresse4($order = Criteria::ASC) Order by the societe_adresse_4 column
 * @method DemandeIdentifiantQuery orderBySocieteTelephone($order = Criteria::ASC) Order by the societe_telephone column
 * @method DemandeIdentifiantQuery orderBySocieteFax($order = Criteria::ASC) Order by the societe_fax column
 * @method DemandeIdentifiantQuery orderByContactPrenom($order = Criteria::ASC) Order by the contact_prenom column
 * @method DemandeIdentifiantQuery orderByContactNom($order = Criteria::ASC) Order by the contact_nom column
 * @method DemandeIdentifiantQuery orderByContactTelephone($order = Criteria::ASC) Order by the contact_telephone column
 * @method DemandeIdentifiantQuery orderByContactMail($order = Criteria::ASC) Order by the contact_mail column
 * @method DemandeIdentifiantQuery orderByPermanence($order = Criteria::ASC) Order by the permanence column
 * @method DemandeIdentifiantQuery orderByPermanenceMatinDe($order = Criteria::ASC) Order by the permanence_matin_de column
 * @method DemandeIdentifiantQuery orderByPermanenceMatinA($order = Criteria::ASC) Order by the permanence_matin_a column
 * @method DemandeIdentifiantQuery orderByPermanenceApresMidiDe($order = Criteria::ASC) Order by the permanence_apres_midi_de column
 * @method DemandeIdentifiantQuery orderByPermanenceApresMidiA($order = Criteria::ASC) Order by the permanence_apres_midi_a column
 * @method DemandeIdentifiantQuery orderByClientVc($order = Criteria::ASC) Order by the client_vc column
 * @method DemandeIdentifiantQuery orderByClientVcCode($order = Criteria::ASC) Order by the client_vc_code column
 * @method DemandeIdentifiantQuery orderByClientVd($order = Criteria::ASC) Order by the client_vd column
 * @method DemandeIdentifiantQuery orderByClientVdCode($order = Criteria::ASC) Order by the client_vd_code column
 * @method DemandeIdentifiantQuery orderByBrochure($order = Criteria::ASC) Order by the brochure column
 * @method DemandeIdentifiantQuery orderByIdentifiant($order = Criteria::ASC) Order by the identifiant column
 * @method DemandeIdentifiantQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method DemandeIdentifiantQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method DemandeIdentifiantQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method DemandeIdentifiantQuery groupById() Group by the id column
 * @method DemandeIdentifiantQuery groupBySocieteNom() Group by the societe_nom column
 * @method DemandeIdentifiantQuery groupBySocieteAdresse1() Group by the societe_adresse_1 column
 * @method DemandeIdentifiantQuery groupBySocieteAdresse2() Group by the societe_adresse_2 column
 * @method DemandeIdentifiantQuery groupBySocieteAdresse3() Group by the societe_adresse_3 column
 * @method DemandeIdentifiantQuery groupBySocieteAdresse4() Group by the societe_adresse_4 column
 * @method DemandeIdentifiantQuery groupBySocieteTelephone() Group by the societe_telephone column
 * @method DemandeIdentifiantQuery groupBySocieteFax() Group by the societe_fax column
 * @method DemandeIdentifiantQuery groupByContactPrenom() Group by the contact_prenom column
 * @method DemandeIdentifiantQuery groupByContactNom() Group by the contact_nom column
 * @method DemandeIdentifiantQuery groupByContactTelephone() Group by the contact_telephone column
 * @method DemandeIdentifiantQuery groupByContactMail() Group by the contact_mail column
 * @method DemandeIdentifiantQuery groupByPermanence() Group by the permanence column
 * @method DemandeIdentifiantQuery groupByPermanenceMatinDe() Group by the permanence_matin_de column
 * @method DemandeIdentifiantQuery groupByPermanenceMatinA() Group by the permanence_matin_a column
 * @method DemandeIdentifiantQuery groupByPermanenceApresMidiDe() Group by the permanence_apres_midi_de column
 * @method DemandeIdentifiantQuery groupByPermanenceApresMidiA() Group by the permanence_apres_midi_a column
 * @method DemandeIdentifiantQuery groupByClientVc() Group by the client_vc column
 * @method DemandeIdentifiantQuery groupByClientVcCode() Group by the client_vc_code column
 * @method DemandeIdentifiantQuery groupByClientVd() Group by the client_vd column
 * @method DemandeIdentifiantQuery groupByClientVdCode() Group by the client_vd_code column
 * @method DemandeIdentifiantQuery groupByBrochure() Group by the brochure column
 * @method DemandeIdentifiantQuery groupByIdentifiant() Group by the identifiant column
 * @method DemandeIdentifiantQuery groupByCreatedAt() Group by the created_at column
 * @method DemandeIdentifiantQuery groupByUpdatedAt() Group by the updated_at column
 * @method DemandeIdentifiantQuery groupByActive() Group by the active column
 *
 * @method DemandeIdentifiantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DemandeIdentifiantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DemandeIdentifiantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DemandeIdentifiantQuery leftJoinDemandeIdentifiantI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the DemandeIdentifiantI18n relation
 * @method DemandeIdentifiantQuery rightJoinDemandeIdentifiantI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DemandeIdentifiantI18n relation
 * @method DemandeIdentifiantQuery innerJoinDemandeIdentifiantI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the DemandeIdentifiantI18n relation
 *
 * @method DemandeIdentifiant findOne(PropelPDO $con = null) Return the first DemandeIdentifiant matching the query
 * @method DemandeIdentifiant findOneOrCreate(PropelPDO $con = null) Return the first DemandeIdentifiant matching the query, or a new DemandeIdentifiant object populated from the query conditions when no match is found
 *
 * @method DemandeIdentifiant findOneBySocieteNom(string $societe_nom) Return the first DemandeIdentifiant filtered by the societe_nom column
 * @method DemandeIdentifiant findOneBySocieteAdresse1(string $societe_adresse_1) Return the first DemandeIdentifiant filtered by the societe_adresse_1 column
 * @method DemandeIdentifiant findOneBySocieteAdresse2(string $societe_adresse_2) Return the first DemandeIdentifiant filtered by the societe_adresse_2 column
 * @method DemandeIdentifiant findOneBySocieteAdresse3(string $societe_adresse_3) Return the first DemandeIdentifiant filtered by the societe_adresse_3 column
 * @method DemandeIdentifiant findOneBySocieteAdresse4(string $societe_adresse_4) Return the first DemandeIdentifiant filtered by the societe_adresse_4 column
 * @method DemandeIdentifiant findOneBySocieteTelephone(string $societe_telephone) Return the first DemandeIdentifiant filtered by the societe_telephone column
 * @method DemandeIdentifiant findOneBySocieteFax(string $societe_fax) Return the first DemandeIdentifiant filtered by the societe_fax column
 * @method DemandeIdentifiant findOneByContactPrenom(string $contact_prenom) Return the first DemandeIdentifiant filtered by the contact_prenom column
 * @method DemandeIdentifiant findOneByContactNom(string $contact_nom) Return the first DemandeIdentifiant filtered by the contact_nom column
 * @method DemandeIdentifiant findOneByContactTelephone(string $contact_telephone) Return the first DemandeIdentifiant filtered by the contact_telephone column
 * @method DemandeIdentifiant findOneByContactMail(string $contact_mail) Return the first DemandeIdentifiant filtered by the contact_mail column
 * @method DemandeIdentifiant findOneByPermanence(string $permanence) Return the first DemandeIdentifiant filtered by the permanence column
 * @method DemandeIdentifiant findOneByPermanenceMatinDe(string $permanence_matin_de) Return the first DemandeIdentifiant filtered by the permanence_matin_de column
 * @method DemandeIdentifiant findOneByPermanenceMatinA(string $permanence_matin_a) Return the first DemandeIdentifiant filtered by the permanence_matin_a column
 * @method DemandeIdentifiant findOneByPermanenceApresMidiDe(string $permanence_apres_midi_de) Return the first DemandeIdentifiant filtered by the permanence_apres_midi_de column
 * @method DemandeIdentifiant findOneByPermanenceApresMidiA(string $permanence_apres_midi_a) Return the first DemandeIdentifiant filtered by the permanence_apres_midi_a column
 * @method DemandeIdentifiant findOneByClientVc(boolean $client_vc) Return the first DemandeIdentifiant filtered by the client_vc column
 * @method DemandeIdentifiant findOneByClientVcCode(string $client_vc_code) Return the first DemandeIdentifiant filtered by the client_vc_code column
 * @method DemandeIdentifiant findOneByClientVd(boolean $client_vd) Return the first DemandeIdentifiant filtered by the client_vd column
 * @method DemandeIdentifiant findOneByClientVdCode(string $client_vd_code) Return the first DemandeIdentifiant filtered by the client_vd_code column
 * @method DemandeIdentifiant findOneByBrochure(boolean $brochure) Return the first DemandeIdentifiant filtered by the brochure column
 * @method DemandeIdentifiant findOneByIdentifiant(boolean $identifiant) Return the first DemandeIdentifiant filtered by the identifiant column
 * @method DemandeIdentifiant findOneByCreatedAt(string $created_at) Return the first DemandeIdentifiant filtered by the created_at column
 * @method DemandeIdentifiant findOneByUpdatedAt(string $updated_at) Return the first DemandeIdentifiant filtered by the updated_at column
 * @method DemandeIdentifiant findOneByActive(boolean $active) Return the first DemandeIdentifiant filtered by the active column
 *
 * @method array findById(int $id) Return DemandeIdentifiant objects filtered by the id column
 * @method array findBySocieteNom(string $societe_nom) Return DemandeIdentifiant objects filtered by the societe_nom column
 * @method array findBySocieteAdresse1(string $societe_adresse_1) Return DemandeIdentifiant objects filtered by the societe_adresse_1 column
 * @method array findBySocieteAdresse2(string $societe_adresse_2) Return DemandeIdentifiant objects filtered by the societe_adresse_2 column
 * @method array findBySocieteAdresse3(string $societe_adresse_3) Return DemandeIdentifiant objects filtered by the societe_adresse_3 column
 * @method array findBySocieteAdresse4(string $societe_adresse_4) Return DemandeIdentifiant objects filtered by the societe_adresse_4 column
 * @method array findBySocieteTelephone(string $societe_telephone) Return DemandeIdentifiant objects filtered by the societe_telephone column
 * @method array findBySocieteFax(string $societe_fax) Return DemandeIdentifiant objects filtered by the societe_fax column
 * @method array findByContactPrenom(string $contact_prenom) Return DemandeIdentifiant objects filtered by the contact_prenom column
 * @method array findByContactNom(string $contact_nom) Return DemandeIdentifiant objects filtered by the contact_nom column
 * @method array findByContactTelephone(string $contact_telephone) Return DemandeIdentifiant objects filtered by the contact_telephone column
 * @method array findByContactMail(string $contact_mail) Return DemandeIdentifiant objects filtered by the contact_mail column
 * @method array findByPermanence(string $permanence) Return DemandeIdentifiant objects filtered by the permanence column
 * @method array findByPermanenceMatinDe(string $permanence_matin_de) Return DemandeIdentifiant objects filtered by the permanence_matin_de column
 * @method array findByPermanenceMatinA(string $permanence_matin_a) Return DemandeIdentifiant objects filtered by the permanence_matin_a column
 * @method array findByPermanenceApresMidiDe(string $permanence_apres_midi_de) Return DemandeIdentifiant objects filtered by the permanence_apres_midi_de column
 * @method array findByPermanenceApresMidiA(string $permanence_apres_midi_a) Return DemandeIdentifiant objects filtered by the permanence_apres_midi_a column
 * @method array findByClientVc(boolean $client_vc) Return DemandeIdentifiant objects filtered by the client_vc column
 * @method array findByClientVcCode(string $client_vc_code) Return DemandeIdentifiant objects filtered by the client_vc_code column
 * @method array findByClientVd(boolean $client_vd) Return DemandeIdentifiant objects filtered by the client_vd column
 * @method array findByClientVdCode(string $client_vd_code) Return DemandeIdentifiant objects filtered by the client_vd_code column
 * @method array findByBrochure(boolean $brochure) Return DemandeIdentifiant objects filtered by the brochure column
 * @method array findByIdentifiant(boolean $identifiant) Return DemandeIdentifiant objects filtered by the identifiant column
 * @method array findByCreatedAt(string $created_at) Return DemandeIdentifiant objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return DemandeIdentifiant objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return DemandeIdentifiant objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDemandeIdentifiantQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDemandeIdentifiantQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\DemandeIdentifiant', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DemandeIdentifiantQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DemandeIdentifiantQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DemandeIdentifiantQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DemandeIdentifiantQuery) {
            return $criteria;
        }
        $query = new DemandeIdentifiantQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   DemandeIdentifiant|DemandeIdentifiant[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DemandeIdentifiantPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   DemandeIdentifiant A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   DemandeIdentifiant A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `societe_nom`, `societe_adresse_1`, `societe_adresse_2`, `societe_adresse_3`, `societe_adresse_4`, `societe_telephone`, `societe_fax`, `contact_prenom`, `contact_nom`, `contact_telephone`, `contact_mail`, `permanence`, `permanence_matin_de`, `permanence_matin_a`, `permanence_apres_midi_de`, `permanence_apres_midi_a`, `client_vc`, `client_vc_code`, `client_vd`, `client_vd_code`, `brochure`, `identifiant`, `created_at`, `updated_at`, `active` FROM `demande_identifiant` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new DemandeIdentifiant();
            $obj->hydrate($row);
            DemandeIdentifiantPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return DemandeIdentifiant|DemandeIdentifiant[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|DemandeIdentifiant[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DemandeIdentifiantPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DemandeIdentifiantPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the societe_nom column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteNom('fooValue');   // WHERE societe_nom = 'fooValue'
     * $query->filterBySocieteNom('%fooValue%'); // WHERE societe_nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeNom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteNom($societeNom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeNom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeNom)) {
                $societeNom = str_replace('*', '%', $societeNom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_NOM, $societeNom, $comparison);
    }

    /**
     * Filter the query on the societe_adresse_1 column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteAdresse1('fooValue');   // WHERE societe_adresse_1 = 'fooValue'
     * $query->filterBySocieteAdresse1('%fooValue%'); // WHERE societe_adresse_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeAdresse1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteAdresse1($societeAdresse1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeAdresse1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeAdresse1)) {
                $societeAdresse1 = str_replace('*', '%', $societeAdresse1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_ADRESSE_1, $societeAdresse1, $comparison);
    }

    /**
     * Filter the query on the societe_adresse_2 column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteAdresse2('fooValue');   // WHERE societe_adresse_2 = 'fooValue'
     * $query->filterBySocieteAdresse2('%fooValue%'); // WHERE societe_adresse_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeAdresse2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteAdresse2($societeAdresse2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeAdresse2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeAdresse2)) {
                $societeAdresse2 = str_replace('*', '%', $societeAdresse2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_ADRESSE_2, $societeAdresse2, $comparison);
    }

    /**
     * Filter the query on the societe_adresse_3 column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteAdresse3('fooValue');   // WHERE societe_adresse_3 = 'fooValue'
     * $query->filterBySocieteAdresse3('%fooValue%'); // WHERE societe_adresse_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeAdresse3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteAdresse3($societeAdresse3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeAdresse3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeAdresse3)) {
                $societeAdresse3 = str_replace('*', '%', $societeAdresse3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_ADRESSE_3, $societeAdresse3, $comparison);
    }

    /**
     * Filter the query on the societe_adresse_4 column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteAdresse4('fooValue');   // WHERE societe_adresse_4 = 'fooValue'
     * $query->filterBySocieteAdresse4('%fooValue%'); // WHERE societe_adresse_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeAdresse4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteAdresse4($societeAdresse4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeAdresse4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeAdresse4)) {
                $societeAdresse4 = str_replace('*', '%', $societeAdresse4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_ADRESSE_4, $societeAdresse4, $comparison);
    }

    /**
     * Filter the query on the societe_telephone column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteTelephone('fooValue');   // WHERE societe_telephone = 'fooValue'
     * $query->filterBySocieteTelephone('%fooValue%'); // WHERE societe_telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeTelephone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteTelephone($societeTelephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeTelephone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeTelephone)) {
                $societeTelephone = str_replace('*', '%', $societeTelephone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_TELEPHONE, $societeTelephone, $comparison);
    }

    /**
     * Filter the query on the societe_fax column
     *
     * Example usage:
     * <code>
     * $query->filterBySocieteFax('fooValue');   // WHERE societe_fax = 'fooValue'
     * $query->filterBySocieteFax('%fooValue%'); // WHERE societe_fax LIKE '%fooValue%'
     * </code>
     *
     * @param     string $societeFax The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterBySocieteFax($societeFax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($societeFax)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $societeFax)) {
                $societeFax = str_replace('*', '%', $societeFax);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::SOCIETE_FAX, $societeFax, $comparison);
    }

    /**
     * Filter the query on the contact_prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByContactPrenom('fooValue');   // WHERE contact_prenom = 'fooValue'
     * $query->filterByContactPrenom('%fooValue%'); // WHERE contact_prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactPrenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByContactPrenom($contactPrenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactPrenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactPrenom)) {
                $contactPrenom = str_replace('*', '%', $contactPrenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CONTACT_PRENOM, $contactPrenom, $comparison);
    }

    /**
     * Filter the query on the contact_nom column
     *
     * Example usage:
     * <code>
     * $query->filterByContactNom('fooValue');   // WHERE contact_nom = 'fooValue'
     * $query->filterByContactNom('%fooValue%'); // WHERE contact_nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactNom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByContactNom($contactNom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactNom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactNom)) {
                $contactNom = str_replace('*', '%', $contactNom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CONTACT_NOM, $contactNom, $comparison);
    }

    /**
     * Filter the query on the contact_telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByContactTelephone('fooValue');   // WHERE contact_telephone = 'fooValue'
     * $query->filterByContactTelephone('%fooValue%'); // WHERE contact_telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactTelephone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByContactTelephone($contactTelephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactTelephone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactTelephone)) {
                $contactTelephone = str_replace('*', '%', $contactTelephone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CONTACT_TELEPHONE, $contactTelephone, $comparison);
    }

    /**
     * Filter the query on the contact_mail column
     *
     * Example usage:
     * <code>
     * $query->filterByContactMail('fooValue');   // WHERE contact_mail = 'fooValue'
     * $query->filterByContactMail('%fooValue%'); // WHERE contact_mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactMail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByContactMail($contactMail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactMail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactMail)) {
                $contactMail = str_replace('*', '%', $contactMail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CONTACT_MAIL, $contactMail, $comparison);
    }

    /**
     * Filter the query on the permanence column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanence('fooValue');   // WHERE permanence = 'fooValue'
     * $query->filterByPermanence('%fooValue%'); // WHERE permanence LIKE '%fooValue%'
     * </code>
     *
     * @param     string $permanence The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPermanence($permanence = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permanence)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $permanence)) {
                $permanence = str_replace('*', '%', $permanence);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::PERMANENCE, $permanence, $comparison);
    }

    /**
     * Filter the query on the permanence_matin_de column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanenceMatinDe('fooValue');   // WHERE permanence_matin_de = 'fooValue'
     * $query->filterByPermanenceMatinDe('%fooValue%'); // WHERE permanence_matin_de LIKE '%fooValue%'
     * </code>
     *
     * @param     string $permanenceMatinDe The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPermanenceMatinDe($permanenceMatinDe = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permanenceMatinDe)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $permanenceMatinDe)) {
                $permanenceMatinDe = str_replace('*', '%', $permanenceMatinDe);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::PERMANENCE_MATIN_DE, $permanenceMatinDe, $comparison);
    }

    /**
     * Filter the query on the permanence_matin_a column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanenceMatinA('fooValue');   // WHERE permanence_matin_a = 'fooValue'
     * $query->filterByPermanenceMatinA('%fooValue%'); // WHERE permanence_matin_a LIKE '%fooValue%'
     * </code>
     *
     * @param     string $permanenceMatinA The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPermanenceMatinA($permanenceMatinA = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permanenceMatinA)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $permanenceMatinA)) {
                $permanenceMatinA = str_replace('*', '%', $permanenceMatinA);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::PERMANENCE_MATIN_A, $permanenceMatinA, $comparison);
    }

    /**
     * Filter the query on the permanence_apres_midi_de column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanenceApresMidiDe('fooValue');   // WHERE permanence_apres_midi_de = 'fooValue'
     * $query->filterByPermanenceApresMidiDe('%fooValue%'); // WHERE permanence_apres_midi_de LIKE '%fooValue%'
     * </code>
     *
     * @param     string $permanenceApresMidiDe The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPermanenceApresMidiDe($permanenceApresMidiDe = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permanenceApresMidiDe)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $permanenceApresMidiDe)) {
                $permanenceApresMidiDe = str_replace('*', '%', $permanenceApresMidiDe);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE, $permanenceApresMidiDe, $comparison);
    }

    /**
     * Filter the query on the permanence_apres_midi_a column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanenceApresMidiA('fooValue');   // WHERE permanence_apres_midi_a = 'fooValue'
     * $query->filterByPermanenceApresMidiA('%fooValue%'); // WHERE permanence_apres_midi_a LIKE '%fooValue%'
     * </code>
     *
     * @param     string $permanenceApresMidiA The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByPermanenceApresMidiA($permanenceApresMidiA = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permanenceApresMidiA)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $permanenceApresMidiA)) {
                $permanenceApresMidiA = str_replace('*', '%', $permanenceApresMidiA);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A, $permanenceApresMidiA, $comparison);
    }

    /**
     * Filter the query on the client_vc column
     *
     * Example usage:
     * <code>
     * $query->filterByClientVc(true); // WHERE client_vc = true
     * $query->filterByClientVc('yes'); // WHERE client_vc = true
     * </code>
     *
     * @param     boolean|string $clientVc The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByClientVc($clientVc = null, $comparison = null)
    {
        if (is_string($clientVc)) {
            $client_vc = in_array(strtolower($clientVc), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CLIENT_VC, $clientVc, $comparison);
    }

    /**
     * Filter the query on the client_vc_code column
     *
     * Example usage:
     * <code>
     * $query->filterByClientVcCode('fooValue');   // WHERE client_vc_code = 'fooValue'
     * $query->filterByClientVcCode('%fooValue%'); // WHERE client_vc_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientVcCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByClientVcCode($clientVcCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientVcCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clientVcCode)) {
                $clientVcCode = str_replace('*', '%', $clientVcCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CLIENT_VC_CODE, $clientVcCode, $comparison);
    }

    /**
     * Filter the query on the client_vd column
     *
     * Example usage:
     * <code>
     * $query->filterByClientVd(true); // WHERE client_vd = true
     * $query->filterByClientVd('yes'); // WHERE client_vd = true
     * </code>
     *
     * @param     boolean|string $clientVd The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByClientVd($clientVd = null, $comparison = null)
    {
        if (is_string($clientVd)) {
            $client_vd = in_array(strtolower($clientVd), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CLIENT_VD, $clientVd, $comparison);
    }

    /**
     * Filter the query on the client_vd_code column
     *
     * Example usage:
     * <code>
     * $query->filterByClientVdCode('fooValue');   // WHERE client_vd_code = 'fooValue'
     * $query->filterByClientVdCode('%fooValue%'); // WHERE client_vd_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientVdCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByClientVdCode($clientVdCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientVdCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clientVdCode)) {
                $clientVdCode = str_replace('*', '%', $clientVdCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CLIENT_VD_CODE, $clientVdCode, $comparison);
    }

    /**
     * Filter the query on the brochure column
     *
     * Example usage:
     * <code>
     * $query->filterByBrochure(true); // WHERE brochure = true
     * $query->filterByBrochure('yes'); // WHERE brochure = true
     * </code>
     *
     * @param     boolean|string $brochure The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByBrochure($brochure = null, $comparison = null)
    {
        if (is_string($brochure)) {
            $brochure = in_array(strtolower($brochure), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::BROCHURE, $brochure, $comparison);
    }

    /**
     * Filter the query on the identifiant column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentifiant(true); // WHERE identifiant = true
     * $query->filterByIdentifiant('yes'); // WHERE identifiant = true
     * </code>
     *
     * @param     boolean|string $identifiant The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByIdentifiant($identifiant = null, $comparison = null)
    {
        if (is_string($identifiant)) {
            $identifiant = in_array(strtolower($identifiant), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::IDENTIFIANT, $identifiant, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DemandeIdentifiantPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DemandeIdentifiantPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DemandeIdentifiantPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DemandeIdentifiantPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DemandeIdentifiantPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related DemandeIdentifiantI18n object
     *
     * @param   DemandeIdentifiantI18n|PropelObjectCollection $demandeIdentifiantI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DemandeIdentifiantQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDemandeIdentifiantI18n($demandeIdentifiantI18n, $comparison = null)
    {
        if ($demandeIdentifiantI18n instanceof DemandeIdentifiantI18n) {
            return $this
                ->addUsingAlias(DemandeIdentifiantPeer::ID, $demandeIdentifiantI18n->getId(), $comparison);
        } elseif ($demandeIdentifiantI18n instanceof PropelObjectCollection) {
            return $this
                ->useDemandeIdentifiantI18nQuery()
                ->filterByPrimaryKeys($demandeIdentifiantI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDemandeIdentifiantI18n() only accepts arguments of type DemandeIdentifiantI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DemandeIdentifiantI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function joinDemandeIdentifiantI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DemandeIdentifiantI18n');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'DemandeIdentifiantI18n');
        }

        return $this;
    }

    /**
     * Use the DemandeIdentifiantI18n relation DemandeIdentifiantI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DemandeIdentifiantI18nQuery A secondary query class using the current class as primary query
     */
    public function useDemandeIdentifiantI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDemandeIdentifiantI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DemandeIdentifiantI18n', '\Cungfoo\Model\DemandeIdentifiantI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   DemandeIdentifiant $demandeIdentifiant Object to remove from the list of results
     *
     * @return DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function prune($demandeIdentifiant = null)
    {
        if ($demandeIdentifiant) {
            $this->addUsingAlias(DemandeIdentifiantPeer::ID, $demandeIdentifiant->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DemandeIdentifiantPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DemandeIdentifiantPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DemandeIdentifiantPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DemandeIdentifiantPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DemandeIdentifiantPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DemandeIdentifiantPeer::CREATED_AT);
    }
    // active behavior


    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $locale = defined('CURRENT_LANGUAGE') ? CURRENT_LANGUAGE : 'fr';

        $this
            ->filterByActive(true)
            ->useI18nQuery($locale, 'i18n_locale')
                ->filterByActiveLocale(true)
                    ->_or()
                ->filterByActiveLocale(null, Criteria::ISNULL)
            ->endUse()
        ;

        return parent::find($con);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'DemandeIdentifiantI18n';

        return $this
            ->joinDemandeIdentifiantI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    DemandeIdentifiantQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('DemandeIdentifiantI18n');
        $this->with['DemandeIdentifiantI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    DemandeIdentifiantI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DemandeIdentifiantI18n', 'Cungfoo\Model\DemandeIdentifiantI18nQuery');
    }

}
