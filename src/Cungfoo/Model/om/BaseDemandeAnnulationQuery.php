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
use Cungfoo\Model\DemandeAnnulation;
use Cungfoo\Model\DemandeAnnulationPeer;
use Cungfoo\Model\DemandeAnnulationQuery;
use Cungfoo\Model\Etablissement;

/**
 * Base class that represents a query for the 'demande_annulation' table.
 *
 *
 *
 * @method DemandeAnnulationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DemandeAnnulationQuery orderByAssureNom($order = Criteria::ASC) Order by the assure_nom column
 * @method DemandeAnnulationQuery orderByAssurePrenom($order = Criteria::ASC) Order by the assure_prenom column
 * @method DemandeAnnulationQuery orderByAssureAdresse($order = Criteria::ASC) Order by the assure_adresse column
 * @method DemandeAnnulationQuery orderByAssureCodePostal($order = Criteria::ASC) Order by the assure_code_postal column
 * @method DemandeAnnulationQuery orderByAssureVille($order = Criteria::ASC) Order by the assure_ville column
 * @method DemandeAnnulationQuery orderByAssurePays($order = Criteria::ASC) Order by the assure_pays column
 * @method DemandeAnnulationQuery orderByAssureMail($order = Criteria::ASC) Order by the assure_mail column
 * @method DemandeAnnulationQuery orderByAssureTelephone($order = Criteria::ASC) Order by the assure_telephone column
 * @method DemandeAnnulationQuery orderByCampingId($order = Criteria::ASC) Order by the camping_id column
 * @method DemandeAnnulationQuery orderByCampingNumResa($order = Criteria::ASC) Order by the camping_num_resa column
 * @method DemandeAnnulationQuery orderByCampingMontantSejour($order = Criteria::ASC) Order by the camping_montant_sejour column
 * @method DemandeAnnulationQuery orderByCampingMontantVerse($order = Criteria::ASC) Order by the camping_montant_verse column
 * @method DemandeAnnulationQuery orderBySinistreNature($order = Criteria::ASC) Order by the sinistre_nature column
 * @method DemandeAnnulationQuery orderBySinistreSuite($order = Criteria::ASC) Order by the sinistre_suite column
 * @method DemandeAnnulationQuery orderBySinistreDate($order = Criteria::ASC) Order by the sinistre_date column
 * @method DemandeAnnulationQuery orderBySinistreResume($order = Criteria::ASC) Order by the sinistre_resume column
 * @method DemandeAnnulationQuery orderByFile1($order = Criteria::ASC) Order by the file_1 column
 * @method DemandeAnnulationQuery orderByFile2($order = Criteria::ASC) Order by the file_2 column
 * @method DemandeAnnulationQuery orderByFile3($order = Criteria::ASC) Order by the file_3 column
 * @method DemandeAnnulationQuery orderByFile4($order = Criteria::ASC) Order by the file_4 column
 * @method DemandeAnnulationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method DemandeAnnulationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method DemandeAnnulationQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method DemandeAnnulationQuery groupById() Group by the id column
 * @method DemandeAnnulationQuery groupByAssureNom() Group by the assure_nom column
 * @method DemandeAnnulationQuery groupByAssurePrenom() Group by the assure_prenom column
 * @method DemandeAnnulationQuery groupByAssureAdresse() Group by the assure_adresse column
 * @method DemandeAnnulationQuery groupByAssureCodePostal() Group by the assure_code_postal column
 * @method DemandeAnnulationQuery groupByAssureVille() Group by the assure_ville column
 * @method DemandeAnnulationQuery groupByAssurePays() Group by the assure_pays column
 * @method DemandeAnnulationQuery groupByAssureMail() Group by the assure_mail column
 * @method DemandeAnnulationQuery groupByAssureTelephone() Group by the assure_telephone column
 * @method DemandeAnnulationQuery groupByCampingId() Group by the camping_id column
 * @method DemandeAnnulationQuery groupByCampingNumResa() Group by the camping_num_resa column
 * @method DemandeAnnulationQuery groupByCampingMontantSejour() Group by the camping_montant_sejour column
 * @method DemandeAnnulationQuery groupByCampingMontantVerse() Group by the camping_montant_verse column
 * @method DemandeAnnulationQuery groupBySinistreNature() Group by the sinistre_nature column
 * @method DemandeAnnulationQuery groupBySinistreSuite() Group by the sinistre_suite column
 * @method DemandeAnnulationQuery groupBySinistreDate() Group by the sinistre_date column
 * @method DemandeAnnulationQuery groupBySinistreResume() Group by the sinistre_resume column
 * @method DemandeAnnulationQuery groupByFile1() Group by the file_1 column
 * @method DemandeAnnulationQuery groupByFile2() Group by the file_2 column
 * @method DemandeAnnulationQuery groupByFile3() Group by the file_3 column
 * @method DemandeAnnulationQuery groupByFile4() Group by the file_4 column
 * @method DemandeAnnulationQuery groupByCreatedAt() Group by the created_at column
 * @method DemandeAnnulationQuery groupByUpdatedAt() Group by the updated_at column
 * @method DemandeAnnulationQuery groupByActive() Group by the active column
 *
 * @method DemandeAnnulationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DemandeAnnulationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DemandeAnnulationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DemandeAnnulationQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method DemandeAnnulationQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method DemandeAnnulationQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method DemandeAnnulation findOne(PropelPDO $con = null) Return the first DemandeAnnulation matching the query
 * @method DemandeAnnulation findOneOrCreate(PropelPDO $con = null) Return the first DemandeAnnulation matching the query, or a new DemandeAnnulation object populated from the query conditions when no match is found
 *
 * @method DemandeAnnulation findOneByAssureNom(string $assure_nom) Return the first DemandeAnnulation filtered by the assure_nom column
 * @method DemandeAnnulation findOneByAssurePrenom(string $assure_prenom) Return the first DemandeAnnulation filtered by the assure_prenom column
 * @method DemandeAnnulation findOneByAssureAdresse(string $assure_adresse) Return the first DemandeAnnulation filtered by the assure_adresse column
 * @method DemandeAnnulation findOneByAssureCodePostal(string $assure_code_postal) Return the first DemandeAnnulation filtered by the assure_code_postal column
 * @method DemandeAnnulation findOneByAssureVille(string $assure_ville) Return the first DemandeAnnulation filtered by the assure_ville column
 * @method DemandeAnnulation findOneByAssurePays(string $assure_pays) Return the first DemandeAnnulation filtered by the assure_pays column
 * @method DemandeAnnulation findOneByAssureMail(string $assure_mail) Return the first DemandeAnnulation filtered by the assure_mail column
 * @method DemandeAnnulation findOneByAssureTelephone(string $assure_telephone) Return the first DemandeAnnulation filtered by the assure_telephone column
 * @method DemandeAnnulation findOneByCampingId(int $camping_id) Return the first DemandeAnnulation filtered by the camping_id column
 * @method DemandeAnnulation findOneByCampingNumResa(string $camping_num_resa) Return the first DemandeAnnulation filtered by the camping_num_resa column
 * @method DemandeAnnulation findOneByCampingMontantSejour(string $camping_montant_sejour) Return the first DemandeAnnulation filtered by the camping_montant_sejour column
 * @method DemandeAnnulation findOneByCampingMontantVerse(string $camping_montant_verse) Return the first DemandeAnnulation filtered by the camping_montant_verse column
 * @method DemandeAnnulation findOneBySinistreNature(int $sinistre_nature) Return the first DemandeAnnulation filtered by the sinistre_nature column
 * @method DemandeAnnulation findOneBySinistreSuite(int $sinistre_suite) Return the first DemandeAnnulation filtered by the sinistre_suite column
 * @method DemandeAnnulation findOneBySinistreDate(string $sinistre_date) Return the first DemandeAnnulation filtered by the sinistre_date column
 * @method DemandeAnnulation findOneBySinistreResume(string $sinistre_resume) Return the first DemandeAnnulation filtered by the sinistre_resume column
 * @method DemandeAnnulation findOneByFile1(string $file_1) Return the first DemandeAnnulation filtered by the file_1 column
 * @method DemandeAnnulation findOneByFile2(string $file_2) Return the first DemandeAnnulation filtered by the file_2 column
 * @method DemandeAnnulation findOneByFile3(string $file_3) Return the first DemandeAnnulation filtered by the file_3 column
 * @method DemandeAnnulation findOneByFile4(string $file_4) Return the first DemandeAnnulation filtered by the file_4 column
 * @method DemandeAnnulation findOneByCreatedAt(string $created_at) Return the first DemandeAnnulation filtered by the created_at column
 * @method DemandeAnnulation findOneByUpdatedAt(string $updated_at) Return the first DemandeAnnulation filtered by the updated_at column
 * @method DemandeAnnulation findOneByActive(boolean $active) Return the first DemandeAnnulation filtered by the active column
 *
 * @method array findById(int $id) Return DemandeAnnulation objects filtered by the id column
 * @method array findByAssureNom(string $assure_nom) Return DemandeAnnulation objects filtered by the assure_nom column
 * @method array findByAssurePrenom(string $assure_prenom) Return DemandeAnnulation objects filtered by the assure_prenom column
 * @method array findByAssureAdresse(string $assure_adresse) Return DemandeAnnulation objects filtered by the assure_adresse column
 * @method array findByAssureCodePostal(string $assure_code_postal) Return DemandeAnnulation objects filtered by the assure_code_postal column
 * @method array findByAssureVille(string $assure_ville) Return DemandeAnnulation objects filtered by the assure_ville column
 * @method array findByAssurePays(string $assure_pays) Return DemandeAnnulation objects filtered by the assure_pays column
 * @method array findByAssureMail(string $assure_mail) Return DemandeAnnulation objects filtered by the assure_mail column
 * @method array findByAssureTelephone(string $assure_telephone) Return DemandeAnnulation objects filtered by the assure_telephone column
 * @method array findByCampingId(int $camping_id) Return DemandeAnnulation objects filtered by the camping_id column
 * @method array findByCampingNumResa(string $camping_num_resa) Return DemandeAnnulation objects filtered by the camping_num_resa column
 * @method array findByCampingMontantSejour(string $camping_montant_sejour) Return DemandeAnnulation objects filtered by the camping_montant_sejour column
 * @method array findByCampingMontantVerse(string $camping_montant_verse) Return DemandeAnnulation objects filtered by the camping_montant_verse column
 * @method array findBySinistreNature(int $sinistre_nature) Return DemandeAnnulation objects filtered by the sinistre_nature column
 * @method array findBySinistreSuite(int $sinistre_suite) Return DemandeAnnulation objects filtered by the sinistre_suite column
 * @method array findBySinistreDate(string $sinistre_date) Return DemandeAnnulation objects filtered by the sinistre_date column
 * @method array findBySinistreResume(string $sinistre_resume) Return DemandeAnnulation objects filtered by the sinistre_resume column
 * @method array findByFile1(string $file_1) Return DemandeAnnulation objects filtered by the file_1 column
 * @method array findByFile2(string $file_2) Return DemandeAnnulation objects filtered by the file_2 column
 * @method array findByFile3(string $file_3) Return DemandeAnnulation objects filtered by the file_3 column
 * @method array findByFile4(string $file_4) Return DemandeAnnulation objects filtered by the file_4 column
 * @method array findByCreatedAt(string $created_at) Return DemandeAnnulation objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return DemandeAnnulation objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return DemandeAnnulation objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDemandeAnnulationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDemandeAnnulationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\DemandeAnnulation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DemandeAnnulationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DemandeAnnulationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DemandeAnnulationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DemandeAnnulationQuery) {
            return $criteria;
        }
        $query = new DemandeAnnulationQuery();
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
     * @return   DemandeAnnulation|DemandeAnnulation[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DemandeAnnulationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   DemandeAnnulation A model object, or null if the key is not found
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
     * @return   DemandeAnnulation A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `assure_nom`, `assure_prenom`, `assure_adresse`, `assure_code_postal`, `assure_ville`, `assure_pays`, `assure_mail`, `assure_telephone`, `camping_id`, `camping_num_resa`, `camping_montant_sejour`, `camping_montant_verse`, `sinistre_nature`, `sinistre_suite`, `sinistre_date`, `sinistre_resume`, `file_1`, `file_2`, `file_3`, `file_4`, `created_at`, `updated_at`, `active` FROM `demande_annulation` WHERE `id` = :p0';
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
            $obj = new DemandeAnnulation();
            $obj->hydrate($row);
            DemandeAnnulationPeer::addInstanceToPool($obj, (string) $key);
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
     * @return DemandeAnnulation|DemandeAnnulation[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|DemandeAnnulation[]|mixed the list of results, formatted by the current formatter
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
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DemandeAnnulationPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DemandeAnnulationPeer::ID, $keys, Criteria::IN);
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
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the assure_nom column
     *
     * Example usage:
     * <code>
     * $query->filterByAssureNom('fooValue');   // WHERE assure_nom = 'fooValue'
     * $query->filterByAssureNom('%fooValue%'); // WHERE assure_nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assureNom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssureNom($assureNom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assureNom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assureNom)) {
                $assureNom = str_replace('*', '%', $assureNom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_NOM, $assureNom, $comparison);
    }

    /**
     * Filter the query on the assure_prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByAssurePrenom('fooValue');   // WHERE assure_prenom = 'fooValue'
     * $query->filterByAssurePrenom('%fooValue%'); // WHERE assure_prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assurePrenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssurePrenom($assurePrenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assurePrenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assurePrenom)) {
                $assurePrenom = str_replace('*', '%', $assurePrenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_PRENOM, $assurePrenom, $comparison);
    }

    /**
     * Filter the query on the assure_adresse column
     *
     * Example usage:
     * <code>
     * $query->filterByAssureAdresse('fooValue');   // WHERE assure_adresse = 'fooValue'
     * $query->filterByAssureAdresse('%fooValue%'); // WHERE assure_adresse LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assureAdresse The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssureAdresse($assureAdresse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assureAdresse)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assureAdresse)) {
                $assureAdresse = str_replace('*', '%', $assureAdresse);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_ADRESSE, $assureAdresse, $comparison);
    }

    /**
     * Filter the query on the assure_code_postal column
     *
     * Example usage:
     * <code>
     * $query->filterByAssureCodePostal('fooValue');   // WHERE assure_code_postal = 'fooValue'
     * $query->filterByAssureCodePostal('%fooValue%'); // WHERE assure_code_postal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assureCodePostal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssureCodePostal($assureCodePostal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assureCodePostal)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assureCodePostal)) {
                $assureCodePostal = str_replace('*', '%', $assureCodePostal);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_CODE_POSTAL, $assureCodePostal, $comparison);
    }

    /**
     * Filter the query on the assure_ville column
     *
     * Example usage:
     * <code>
     * $query->filterByAssureVille('fooValue');   // WHERE assure_ville = 'fooValue'
     * $query->filterByAssureVille('%fooValue%'); // WHERE assure_ville LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assureVille The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssureVille($assureVille = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assureVille)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assureVille)) {
                $assureVille = str_replace('*', '%', $assureVille);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_VILLE, $assureVille, $comparison);
    }

    /**
     * Filter the query on the assure_pays column
     *
     * Example usage:
     * <code>
     * $query->filterByAssurePays('fooValue');   // WHERE assure_pays = 'fooValue'
     * $query->filterByAssurePays('%fooValue%'); // WHERE assure_pays LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assurePays The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssurePays($assurePays = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assurePays)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assurePays)) {
                $assurePays = str_replace('*', '%', $assurePays);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_PAYS, $assurePays, $comparison);
    }

    /**
     * Filter the query on the assure_mail column
     *
     * Example usage:
     * <code>
     * $query->filterByAssureMail('fooValue');   // WHERE assure_mail = 'fooValue'
     * $query->filterByAssureMail('%fooValue%'); // WHERE assure_mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assureMail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssureMail($assureMail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assureMail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assureMail)) {
                $assureMail = str_replace('*', '%', $assureMail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_MAIL, $assureMail, $comparison);
    }

    /**
     * Filter the query on the assure_telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByAssureTelephone('fooValue');   // WHERE assure_telephone = 'fooValue'
     * $query->filterByAssureTelephone('%fooValue%'); // WHERE assure_telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assureTelephone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByAssureTelephone($assureTelephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assureTelephone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assureTelephone)) {
                $assureTelephone = str_replace('*', '%', $assureTelephone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ASSURE_TELEPHONE, $assureTelephone, $comparison);
    }

    /**
     * Filter the query on the camping_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCampingId(1234); // WHERE camping_id = 1234
     * $query->filterByCampingId(array(12, 34)); // WHERE camping_id IN (12, 34)
     * $query->filterByCampingId(array('min' => 12)); // WHERE camping_id > 12
     * </code>
     *
     * @see       filterByEtablissement()
     *
     * @param     mixed $campingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByCampingId($campingId = null, $comparison = null)
    {
        if (is_array($campingId)) {
            $useMinMax = false;
            if (isset($campingId['min'])) {
                $this->addUsingAlias(DemandeAnnulationPeer::CAMPING_ID, $campingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campingId['max'])) {
                $this->addUsingAlias(DemandeAnnulationPeer::CAMPING_ID, $campingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::CAMPING_ID, $campingId, $comparison);
    }

    /**
     * Filter the query on the camping_num_resa column
     *
     * Example usage:
     * <code>
     * $query->filterByCampingNumResa('fooValue');   // WHERE camping_num_resa = 'fooValue'
     * $query->filterByCampingNumResa('%fooValue%'); // WHERE camping_num_resa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $campingNumResa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByCampingNumResa($campingNumResa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campingNumResa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $campingNumResa)) {
                $campingNumResa = str_replace('*', '%', $campingNumResa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::CAMPING_NUM_RESA, $campingNumResa, $comparison);
    }

    /**
     * Filter the query on the camping_montant_sejour column
     *
     * Example usage:
     * <code>
     * $query->filterByCampingMontantSejour('fooValue');   // WHERE camping_montant_sejour = 'fooValue'
     * $query->filterByCampingMontantSejour('%fooValue%'); // WHERE camping_montant_sejour LIKE '%fooValue%'
     * </code>
     *
     * @param     string $campingMontantSejour The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByCampingMontantSejour($campingMontantSejour = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campingMontantSejour)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $campingMontantSejour)) {
                $campingMontantSejour = str_replace('*', '%', $campingMontantSejour);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR, $campingMontantSejour, $comparison);
    }

    /**
     * Filter the query on the camping_montant_verse column
     *
     * Example usage:
     * <code>
     * $query->filterByCampingMontantVerse('fooValue');   // WHERE camping_montant_verse = 'fooValue'
     * $query->filterByCampingMontantVerse('%fooValue%'); // WHERE camping_montant_verse LIKE '%fooValue%'
     * </code>
     *
     * @param     string $campingMontantVerse The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByCampingMontantVerse($campingMontantVerse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campingMontantVerse)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $campingMontantVerse)) {
                $campingMontantVerse = str_replace('*', '%', $campingMontantVerse);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::CAMPING_MONTANT_VERSE, $campingMontantVerse, $comparison);
    }

    /**
     * Filter the query on the sinistre_nature column
     *
     * @param     mixed $sinistreNature The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterBySinistreNature($sinistreNature = null, $comparison = null)
    {
        $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_NATURE);
        if (is_scalar($sinistreNature)) {
            if (!in_array($sinistreNature, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $sinistreNature));
            }
            $sinistreNature = array_search($sinistreNature, $valueSet);
        } elseif (is_array($sinistreNature)) {
            $convertedValues = array();
            foreach ($sinistreNature as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $sinistreNature = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::SINISTRE_NATURE, $sinistreNature, $comparison);
    }

    /**
     * Filter the query on the sinistre_suite column
     *
     * @param     mixed $sinistreSuite The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterBySinistreSuite($sinistreSuite = null, $comparison = null)
    {
        $valueSet = DemandeAnnulationPeer::getValueSet(DemandeAnnulationPeer::SINISTRE_SUITE);
        if (is_scalar($sinistreSuite)) {
            if (!in_array($sinistreSuite, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $sinistreSuite));
            }
            $sinistreSuite = array_search($sinistreSuite, $valueSet);
        } elseif (is_array($sinistreSuite)) {
            $convertedValues = array();
            foreach ($sinistreSuite as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $sinistreSuite = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::SINISTRE_SUITE, $sinistreSuite, $comparison);
    }

    /**
     * Filter the query on the sinistre_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySinistreDate('fooValue');   // WHERE sinistre_date = 'fooValue'
     * $query->filterBySinistreDate('%fooValue%'); // WHERE sinistre_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sinistreDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterBySinistreDate($sinistreDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sinistreDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sinistreDate)) {
                $sinistreDate = str_replace('*', '%', $sinistreDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::SINISTRE_DATE, $sinistreDate, $comparison);
    }

    /**
     * Filter the query on the sinistre_resume column
     *
     * Example usage:
     * <code>
     * $query->filterBySinistreResume('fooValue');   // WHERE sinistre_resume = 'fooValue'
     * $query->filterBySinistreResume('%fooValue%'); // WHERE sinistre_resume LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sinistreResume The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterBySinistreResume($sinistreResume = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sinistreResume)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sinistreResume)) {
                $sinistreResume = str_replace('*', '%', $sinistreResume);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::SINISTRE_RESUME, $sinistreResume, $comparison);
    }

    /**
     * Filter the query on the file_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByFile1('fooValue');   // WHERE file_1 = 'fooValue'
     * $query->filterByFile1('%fooValue%'); // WHERE file_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $file1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByFile1($file1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($file1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $file1)) {
                $file1 = str_replace('*', '%', $file1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::FILE_1, $file1, $comparison);
    }

    /**
     * Filter the query on the file_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByFile2('fooValue');   // WHERE file_2 = 'fooValue'
     * $query->filterByFile2('%fooValue%'); // WHERE file_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $file2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByFile2($file2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($file2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $file2)) {
                $file2 = str_replace('*', '%', $file2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::FILE_2, $file2, $comparison);
    }

    /**
     * Filter the query on the file_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByFile3('fooValue');   // WHERE file_3 = 'fooValue'
     * $query->filterByFile3('%fooValue%'); // WHERE file_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $file3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByFile3($file3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($file3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $file3)) {
                $file3 = str_replace('*', '%', $file3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::FILE_3, $file3, $comparison);
    }

    /**
     * Filter the query on the file_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByFile4('fooValue');   // WHERE file_4 = 'fooValue'
     * $query->filterByFile4('%fooValue%'); // WHERE file_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $file4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByFile4($file4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($file4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $file4)) {
                $file4 = str_replace('*', '%', $file4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::FILE_4, $file4, $comparison);
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
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DemandeAnnulationPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DemandeAnnulationPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DemandeAnnulationPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DemandeAnnulationPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DemandeAnnulationPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DemandeAnnulationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(DemandeAnnulationPeer::CAMPING_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DemandeAnnulationPeer::CAMPING_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEtablissement() only accepts arguments of type Etablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Etablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function joinEtablissement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Etablissement');

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
            $this->addJoinObject($join, 'Etablissement');
        }

        return $this;
    }

    /**
     * Use the Etablissement relation Etablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etablissement', '\Cungfoo\Model\EtablissementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   DemandeAnnulation $demandeAnnulation Object to remove from the list of results
     *
     * @return DemandeAnnulationQuery The current query, for fluid interface
     */
    public function prune($demandeAnnulation = null)
    {
        if ($demandeAnnulation) {
            $this->addUsingAlias(DemandeAnnulationPeer::ID, $demandeAnnulation->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     DemandeAnnulationQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DemandeAnnulationPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     DemandeAnnulationQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DemandeAnnulationPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     DemandeAnnulationQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DemandeAnnulationPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     DemandeAnnulationQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DemandeAnnulationPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     DemandeAnnulationQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DemandeAnnulationPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     DemandeAnnulationQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DemandeAnnulationPeer::CREATED_AT);
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
        ;

        return parent::find($con);
    }
}
