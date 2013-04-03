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
use Cungfoo\Model\CoordonneesContact;
use Cungfoo\Model\CoordonneesContactI18n;
use Cungfoo\Model\CoordonneesContactPeer;
use Cungfoo\Model\CoordonneesContactQuery;

/**
 * Base class that represents a query for the 'coordonnees_contact' table.
 *
 *
 *
 * @method CoordonneesContactQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CoordonneesContactQuery orderByCivilite($order = Criteria::ASC) Order by the civilite column
 * @method CoordonneesContactQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method CoordonneesContactQuery orderByPrenom($order = Criteria::ASC) Order by the prenom column
 * @method CoordonneesContactQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method CoordonneesContactQuery orderByAdresse($order = Criteria::ASC) Order by the adresse column
 * @method CoordonneesContactQuery orderByVille($order = Criteria::ASC) Order by the ville column
 * @method CoordonneesContactQuery orderByCodePostal($order = Criteria::ASC) Order by the code_postal column
 * @method CoordonneesContactQuery orderByPays($order = Criteria::ASC) Order by the pays column
 * @method CoordonneesContactQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method CoordonneesContactQuery orderByTelephone($order = Criteria::ASC) Order by the telephone column
 * @method CoordonneesContactQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method CoordonneesContactQuery orderBySujet($order = Criteria::ASC) Order by the sujet column
 * @method CoordonneesContactQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method CoordonneesContactQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method CoordonneesContactQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method CoordonneesContactQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method CoordonneesContactQuery groupById() Group by the id column
 * @method CoordonneesContactQuery groupByCivilite() Group by the civilite column
 * @method CoordonneesContactQuery groupByNom() Group by the nom column
 * @method CoordonneesContactQuery groupByPrenom() Group by the prenom column
 * @method CoordonneesContactQuery groupByType() Group by the type column
 * @method CoordonneesContactQuery groupByAdresse() Group by the adresse column
 * @method CoordonneesContactQuery groupByVille() Group by the ville column
 * @method CoordonneesContactQuery groupByCodePostal() Group by the code_postal column
 * @method CoordonneesContactQuery groupByPays() Group by the pays column
 * @method CoordonneesContactQuery groupByEmail() Group by the email column
 * @method CoordonneesContactQuery groupByTelephone() Group by the telephone column
 * @method CoordonneesContactQuery groupByFax() Group by the fax column
 * @method CoordonneesContactQuery groupBySujet() Group by the sujet column
 * @method CoordonneesContactQuery groupByMessage() Group by the message column
 * @method CoordonneesContactQuery groupByCreatedAt() Group by the created_at column
 * @method CoordonneesContactQuery groupByUpdatedAt() Group by the updated_at column
 * @method CoordonneesContactQuery groupByActive() Group by the active column
 *
 * @method CoordonneesContactQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CoordonneesContactQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CoordonneesContactQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CoordonneesContactQuery leftJoinCoordonneesContactI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the CoordonneesContactI18n relation
 * @method CoordonneesContactQuery rightJoinCoordonneesContactI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CoordonneesContactI18n relation
 * @method CoordonneesContactQuery innerJoinCoordonneesContactI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the CoordonneesContactI18n relation
 *
 * @method CoordonneesContact findOne(PropelPDO $con = null) Return the first CoordonneesContact matching the query
 * @method CoordonneesContact findOneOrCreate(PropelPDO $con = null) Return the first CoordonneesContact matching the query, or a new CoordonneesContact object populated from the query conditions when no match is found
 *
 * @method CoordonneesContact findOneByCivilite(int $civilite) Return the first CoordonneesContact filtered by the civilite column
 * @method CoordonneesContact findOneByNom(string $nom) Return the first CoordonneesContact filtered by the nom column
 * @method CoordonneesContact findOneByPrenom(string $prenom) Return the first CoordonneesContact filtered by the prenom column
 * @method CoordonneesContact findOneByType(int $type) Return the first CoordonneesContact filtered by the type column
 * @method CoordonneesContact findOneByAdresse(string $adresse) Return the first CoordonneesContact filtered by the adresse column
 * @method CoordonneesContact findOneByVille(string $ville) Return the first CoordonneesContact filtered by the ville column
 * @method CoordonneesContact findOneByCodePostal(string $code_postal) Return the first CoordonneesContact filtered by the code_postal column
 * @method CoordonneesContact findOneByPays(string $pays) Return the first CoordonneesContact filtered by the pays column
 * @method CoordonneesContact findOneByEmail(string $email) Return the first CoordonneesContact filtered by the email column
 * @method CoordonneesContact findOneByTelephone(string $telephone) Return the first CoordonneesContact filtered by the telephone column
 * @method CoordonneesContact findOneByFax(string $fax) Return the first CoordonneesContact filtered by the fax column
 * @method CoordonneesContact findOneBySujet(string $sujet) Return the first CoordonneesContact filtered by the sujet column
 * @method CoordonneesContact findOneByMessage(string $message) Return the first CoordonneesContact filtered by the message column
 * @method CoordonneesContact findOneByCreatedAt(string $created_at) Return the first CoordonneesContact filtered by the created_at column
 * @method CoordonneesContact findOneByUpdatedAt(string $updated_at) Return the first CoordonneesContact filtered by the updated_at column
 * @method CoordonneesContact findOneByActive(boolean $active) Return the first CoordonneesContact filtered by the active column
 *
 * @method array findById(int $id) Return CoordonneesContact objects filtered by the id column
 * @method array findByCivilite(int $civilite) Return CoordonneesContact objects filtered by the civilite column
 * @method array findByNom(string $nom) Return CoordonneesContact objects filtered by the nom column
 * @method array findByPrenom(string $prenom) Return CoordonneesContact objects filtered by the prenom column
 * @method array findByType(int $type) Return CoordonneesContact objects filtered by the type column
 * @method array findByAdresse(string $adresse) Return CoordonneesContact objects filtered by the adresse column
 * @method array findByVille(string $ville) Return CoordonneesContact objects filtered by the ville column
 * @method array findByCodePostal(string $code_postal) Return CoordonneesContact objects filtered by the code_postal column
 * @method array findByPays(string $pays) Return CoordonneesContact objects filtered by the pays column
 * @method array findByEmail(string $email) Return CoordonneesContact objects filtered by the email column
 * @method array findByTelephone(string $telephone) Return CoordonneesContact objects filtered by the telephone column
 * @method array findByFax(string $fax) Return CoordonneesContact objects filtered by the fax column
 * @method array findBySujet(string $sujet) Return CoordonneesContact objects filtered by the sujet column
 * @method array findByMessage(string $message) Return CoordonneesContact objects filtered by the message column
 * @method array findByCreatedAt(string $created_at) Return CoordonneesContact objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return CoordonneesContact objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return CoordonneesContact objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCoordonneesContactQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCoordonneesContactQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\CoordonneesContact', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CoordonneesContactQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CoordonneesContactQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CoordonneesContactQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CoordonneesContactQuery) {
            return $criteria;
        }
        $query = new CoordonneesContactQuery();
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
     * @return   CoordonneesContact|CoordonneesContact[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CoordonneesContactPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CoordonneesContact A model object, or null if the key is not found
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
     * @return   CoordonneesContact A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `civilite`, `nom`, `prenom`, `type`, `adresse`, `ville`, `code_postal`, `pays`, `email`, `telephone`, `fax`, `sujet`, `message`, `created_at`, `updated_at`, `active` FROM `coordonnees_contact` WHERE `id` = :p0';
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
            $obj = new CoordonneesContact();
            $obj->hydrate($row);
            CoordonneesContactPeer::addInstanceToPool($obj, (string) $key);
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
     * @return CoordonneesContact|CoordonneesContact[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CoordonneesContact[]|mixed the list of results, formatted by the current formatter
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
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CoordonneesContactPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CoordonneesContactPeer::ID, $keys, Criteria::IN);
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
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CoordonneesContactPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the civilite column
     *
     * @param     mixed $civilite The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByCivilite($civilite = null, $comparison = null)
    {
        $valueSet = CoordonneesContactPeer::getValueSet(CoordonneesContactPeer::CIVILITE);
        if (is_scalar($civilite)) {
            if (!in_array($civilite, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $civilite));
            }
            $civilite = array_search($civilite, $valueSet);
        } elseif (is_array($civilite)) {
            $convertedValues = array();
            foreach ($civilite as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $civilite = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::CIVILITE, $civilite, $comparison);
    }

    /**
     * Filter the query on the nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE nom = 'fooValue'
     * $query->filterByNom('%fooValue%'); // WHERE nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nom)) {
                $nom = str_replace('*', '%', $nom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByPrenom('fooValue');   // WHERE prenom = 'fooValue'
     * $query->filterByPrenom('%fooValue%'); // WHERE prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByPrenom($prenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $prenom)) {
                $prenom = str_replace('*', '%', $prenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::PRENOM, $prenom, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * @param     mixed $type The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByType($type = null, $comparison = null)
    {
        $valueSet = CoordonneesContactPeer::getValueSet(CoordonneesContactPeer::TYPE);
        if (is_scalar($type)) {
            if (!in_array($type, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $type));
            }
            $type = array_search($type, $valueSet);
        } elseif (is_array($type)) {
            $convertedValues = array();
            foreach ($type as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the adresse column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresse('fooValue');   // WHERE adresse = 'fooValue'
     * $query->filterByAdresse('%fooValue%'); // WHERE adresse LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adresse The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByAdresse($adresse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresse)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adresse)) {
                $adresse = str_replace('*', '%', $adresse);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::ADRESSE, $adresse, $comparison);
    }

    /**
     * Filter the query on the ville column
     *
     * Example usage:
     * <code>
     * $query->filterByVille('fooValue');   // WHERE ville = 'fooValue'
     * $query->filterByVille('%fooValue%'); // WHERE ville LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ville The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByVille($ville = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ville)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ville)) {
                $ville = str_replace('*', '%', $ville);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::VILLE, $ville, $comparison);
    }

    /**
     * Filter the query on the code_postal column
     *
     * Example usage:
     * <code>
     * $query->filterByCodePostal('fooValue');   // WHERE code_postal = 'fooValue'
     * $query->filterByCodePostal('%fooValue%'); // WHERE code_postal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codePostal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByCodePostal($codePostal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codePostal)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $codePostal)) {
                $codePostal = str_replace('*', '%', $codePostal);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::CODE_POSTAL, $codePostal, $comparison);
    }

    /**
     * Filter the query on the pays column
     *
     * Example usage:
     * <code>
     * $query->filterByPays('fooValue');   // WHERE pays = 'fooValue'
     * $query->filterByPays('%fooValue%'); // WHERE pays LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pays The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByPays($pays = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pays)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pays)) {
                $pays = str_replace('*', '%', $pays);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::PAYS, $pays, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone('fooValue');   // WHERE telephone = 'fooValue'
     * $query->filterByTelephone('%fooValue%'); // WHERE telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByTelephone($telephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telephone)) {
                $telephone = str_replace('*', '%', $telephone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::TELEPHONE, $telephone, $comparison);
    }

    /**
     * Filter the query on the fax column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE fax = 'fooValue'
     * $query->filterByFax('%fooValue%'); // WHERE fax LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fax The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fax)) {
                $fax = str_replace('*', '%', $fax);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::FAX, $fax, $comparison);
    }

    /**
     * Filter the query on the sujet column
     *
     * Example usage:
     * <code>
     * $query->filterBySujet('fooValue');   // WHERE sujet = 'fooValue'
     * $query->filterBySujet('%fooValue%'); // WHERE sujet LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sujet The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterBySujet($sujet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sujet)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sujet)) {
                $sujet = str_replace('*', '%', $sujet);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::SUJET, $sujet, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::MESSAGE, $message, $comparison);
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
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CoordonneesContactPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CoordonneesContactPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CoordonneesContactPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CoordonneesContactPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesContactPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CoordonneesContactPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related CoordonneesContactI18n object
     *
     * @param   CoordonneesContactI18n|PropelObjectCollection $coordonneesContactI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CoordonneesContactQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCoordonneesContactI18n($coordonneesContactI18n, $comparison = null)
    {
        if ($coordonneesContactI18n instanceof CoordonneesContactI18n) {
            return $this
                ->addUsingAlias(CoordonneesContactPeer::ID, $coordonneesContactI18n->getId(), $comparison);
        } elseif ($coordonneesContactI18n instanceof PropelObjectCollection) {
            return $this
                ->useCoordonneesContactI18nQuery()
                ->filterByPrimaryKeys($coordonneesContactI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCoordonneesContactI18n() only accepts arguments of type CoordonneesContactI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CoordonneesContactI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function joinCoordonneesContactI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CoordonneesContactI18n');

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
            $this->addJoinObject($join, 'CoordonneesContactI18n');
        }

        return $this;
    }

    /**
     * Use the CoordonneesContactI18n relation CoordonneesContactI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CoordonneesContactI18nQuery A secondary query class using the current class as primary query
     */
    public function useCoordonneesContactI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCoordonneesContactI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CoordonneesContactI18n', '\Cungfoo\Model\CoordonneesContactI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   CoordonneesContact $coordonneesContact Object to remove from the list of results
     *
     * @return CoordonneesContactQuery The current query, for fluid interface
     */
    public function prune($coordonneesContact = null)
    {
        if ($coordonneesContact) {
            $this->addUsingAlias(CoordonneesContactPeer::ID, $coordonneesContact->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     CoordonneesContactQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CoordonneesContactPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     CoordonneesContactQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CoordonneesContactPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     CoordonneesContactQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CoordonneesContactPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     CoordonneesContactQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CoordonneesContactPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     CoordonneesContactQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CoordonneesContactPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     CoordonneesContactQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CoordonneesContactPeer::CREATED_AT);
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
     * @return    CoordonneesContactQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'CoordonneesContactI18n';

        return $this
            ->joinCoordonneesContactI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    CoordonneesContactQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('CoordonneesContactI18n');
        $this->with['CoordonneesContactI18n']->setIsWithOneToMany(false);

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
     * @return    CoordonneesContactI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CoordonneesContactI18n', 'Cungfoo\Model\CoordonneesContactI18nQuery');
    }

}
