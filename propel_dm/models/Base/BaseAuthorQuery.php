<?php

namespace Base;

use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\ActiveQuery\Criteria;
use AuthorQuery;
use Map\AuthorEntityMap;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Exception\PropelException;
use BookQuery;

/**
 */
class BaseAuthorQuery extends \Propel\Runtime\ActiveQuery\ModelCriteria {

	/**
	 * Initializes internal state of AuthorQuery object.
	 * 
	 * @param string $dbName The database name
	 * @param string $entityName The full entity class name
	 * @param string $entityAlias The alias for the entity in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'bookstore', $entityName = 'Author', $entityAlias = null) {
		parent::__construct($dbName, $entityName, $entityAlias);
	}

	/**
	 * Filter the query on the email field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
	 * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
	 * </code>
	 * 
	 * @param string $email The value to use as filter.
	 *  Accepts wildcards (* and % trigger a LIKE)
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function filterByEmail($email, $comparison = null) {
		if (null === $comparison) {
		    if (is_array($email)) {
		        $comparison = Criteria::IN;
		    } elseif (preg_match('/[\%\*]/', $email)) {
		        $email = str_replace('*', '%', $email);
		        $comparison = Criteria::LIKE;
		    }
		}

		return $this->addUsingAlias(AuthorEntityMap::COL_EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the firstName field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFirstName('fooValue');   // WHERE firstName = 'fooValue'
	 * $query->filterByFirstName('%fooValue%'); // WHERE firstName LIKE '%fooValue%'
	 * </code>
	 * 
	 * @param string $firstName The value to use as filter.
	 *  Accepts wildcards (* and % trigger a LIKE)
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function filterByFirstName($firstName, $comparison = null) {
		if (null === $comparison) {
		    if (is_array($firstName)) {
		        $comparison = Criteria::IN;
		    } elseif (preg_match('/[\%\*]/', $firstName)) {
		        $firstName = str_replace('*', '%', $firstName);
		        $comparison = Criteria::LIKE;
		    }
		}

		return $this->addUsingAlias(AuthorEntityMap::COL_FIRSTNAME, $firstName, $comparison);
	}

	/**
	 * Filter the query on the id field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 * 
	 * @param mixed $id The value to use as filter.
	 * Use scalar values for equality.
	 * Use array values for in_array() equivalent.
	 * Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function filterById($id, $comparison = null) {
		if (is_array($id)) {
		    $useMinMax = false;
		    if (isset($id['min'])) {
		        $this->addUsingAlias(AuthorEntityMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
		        $useMinMax = true;
		    }
		    if (isset($id['max'])) {
		        $this->addUsingAlias(AuthorEntityMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
		        $useMinMax = true;
		    }
		    if ($useMinMax) {
		        return $this;
		    }
		    if (null === $comparison) {
		        $comparison = Criteria::IN;
		    }
		}

		return $this->addUsingAlias(AuthorEntityMap::COL_ID, $id, $comparison);
	}

	/**
	 * Filter the query on the lastName field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLastName('fooValue');   // WHERE lastName = 'fooValue'
	 * $query->filterByLastName('%fooValue%'); // WHERE lastName LIKE '%fooValue%'
	 * </code>
	 * 
	 * @param string $lastName The value to use as filter.
	 *  Accepts wildcards (* and % trigger a LIKE)
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function filterByLastName($lastName, $comparison = null) {
		if (null === $comparison) {
		    if (is_array($lastName)) {
		        $comparison = Criteria::IN;
		    } elseif (preg_match('/[\%\*]/', $lastName)) {
		        $lastName = str_replace('*', '%', $lastName);
		        $comparison = Criteria::LIKE;
		    }
		}

		return $this->addUsingAlias(AuthorEntityMap::COL_LASTNAME, $lastName, $comparison);
	}

	/**
	 * Filter the query by primary key.
	 * 
	 * @param mixed $key Primary key to use for the query
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key) {
		return $this->addUsingAlias(AuthorEntityMap::COL_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by primary key.
	 * 
	 * @param array $keys Primary keys to use for the query
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys(array $keys) {
		return $this->addUsingAlias(AuthorEntityMap::COL_ID, $keys, Criteria::IN);

		return $this;
	}

	/**
	 * Adds a JOIN clause to the query using the Book relation. Referrer relation
	 * 
	 * @param string $relationAlias optional alias for the relation
	 * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 * @return $this|AuthorQuery The current query, for fluid interface
	 */
	public function joinBook($relationAlias = null, $joinType = Criteria::LEFT_JOIN) {
		$entityMap = $this->getEntityMap();
		$relationMap = $entityMap->getRelation('Book');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getEntityAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
		    $join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if ($relationAlias) {
		    $this->addAlias($relationAlias, $relationMap->getRightEntity()->getName());
		    $this->addJoinObject($join, $relationAlias);
		} else {
		    $this->addJoinObject($join, 'Book');
		}

		return $this;
	}

	/**
	 * Use the Book relation Author object
	 * 
	 * @see useQuery()
	 * 
	 * @param string $relationAlias optional alias for the relation, to be used as main alias in the secondary query
	 * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 * @return BookQuery A secondary query class using the current class as primary query
	 */
	public function useBookQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN) {
		return $this
		    ->joinBook($relationAlias, $joinType)
		    ->useQuery($relationAlias ? $relationAlias : 'Book', 'Book');
	}
}