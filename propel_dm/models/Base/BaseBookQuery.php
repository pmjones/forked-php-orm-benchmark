<?php

namespace Base;

use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\ActiveQuery\Criteria;
use BookQuery;
use Map\BookEntityMap;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Exception\PropelException;
use Author;
use AuthorQuery;

/**
 */
class BaseBookQuery extends \Propel\Runtime\ActiveQuery\ModelCriteria {

	/**
	 * Initializes internal state of BookQuery object.
	 * 
	 * @param string $dbName The database name
	 * @param string $entityName The full entity class name
	 * @param string $entityAlias The alias for the entity in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'bookstore', $entityName = 'Book', $entityAlias = null) {
		parent::__construct($dbName, $entityName, $entityAlias);
	}

	/**
	 * Filter the query by a related \Author object.
	 * 
	 * @param \Author|ObjectCollection $author The related object(s) to use as filter
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByAuthor($author, $comparison = null) {
		if ($author instanceof \Author) {
		    return $this
		        ->addUsingAlias(BookEntityMap::COL_AUTHORID, $author->getid(), $comparison);
		} elseif ($author instanceof ObjectCollection) {
		    if (null === $comparison) {
		        $comparison = Criteria::IN;
		    }

		    return $this
		        ->addUsingAlias(BookEntityMap::COL_AUTHORID, $author->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
		    throw new PropelException('filterByAuthor() only accepts arguments of type \Author or Collection');
		}
	}

	/**
	 * Filter the query on the authorId field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAuthorId(1234); // WHERE authorId = 1234
	 * $query->filterByAuthorId(array(12, 34)); // WHERE authorId IN (12, 34)
	 * $query->filterByAuthorId(array('min' => 12)); // WHERE authorId > 12
	 * </code>
	 *      *
	 *     @see filterByAuthor()
	 * 
	 * @param mixed $authorId The value to use as filter.
	 * Use scalar values for equality.
	 * Use array values for in_array() equivalent.
	 * Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByAuthorId($authorId, $comparison = null) {
		if (is_array($authorId)) {
		    $useMinMax = false;
		    if (isset($authorId['min'])) {
		        $this->addUsingAlias(BookEntityMap::COL_AUTHORID, $authorId['min'], Criteria::GREATER_EQUAL);
		        $useMinMax = true;
		    }
		    if (isset($authorId['max'])) {
		        $this->addUsingAlias(BookEntityMap::COL_AUTHORID, $authorId['max'], Criteria::LESS_EQUAL);
		        $useMinMax = true;
		    }
		    if ($useMinMax) {
		        return $this;
		    }
		    if (null === $comparison) {
		        $comparison = Criteria::IN;
		    }
		}

		return $this->addUsingAlias(BookEntityMap::COL_AUTHORID, $authorId, $comparison);
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
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterById($id, $comparison = null) {
		if (is_array($id)) {
		    $useMinMax = false;
		    if (isset($id['min'])) {
		        $this->addUsingAlias(BookEntityMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
		        $useMinMax = true;
		    }
		    if (isset($id['max'])) {
		        $this->addUsingAlias(BookEntityMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
		        $useMinMax = true;
		    }
		    if ($useMinMax) {
		        return $this;
		    }
		    if (null === $comparison) {
		        $comparison = Criteria::IN;
		    }
		}

		return $this->addUsingAlias(BookEntityMap::COL_ID, $id, $comparison);
	}

	/**
	 * Filter the query on the ISBN field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByISBN('fooValue');   // WHERE ISBN = 'fooValue'
	 * $query->filterByISBN('%fooValue%'); // WHERE ISBN LIKE '%fooValue%'
	 * </code>
	 * 
	 * @param string $iSBN The value to use as filter.
	 *  Accepts wildcards (* and % trigger a LIKE)
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByISBN($iSBN, $comparison = null) {
		if (null === $comparison) {
		    if (is_array($iSBN)) {
		        $comparison = Criteria::IN;
		    } elseif (preg_match('/[\%\*]/', $iSBN)) {
		        $iSBN = str_replace('*', '%', $iSBN);
		        $comparison = Criteria::LIKE;
		    }
		}

		return $this->addUsingAlias(BookEntityMap::COL_ISBN, $iSBN, $comparison);
	}

	/**
	 * Filter the query on the price field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPrice(1234); // WHERE price = 1234
	 * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 * 
	 * @param mixed $price The value to use as filter.
	 * Use scalar values for equality.
	 * Use array values for in_array() equivalent.
	 * Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByPrice($price, $comparison = null) {
		if (is_array($price)) {
		    $useMinMax = false;
		    if (isset($price['min'])) {
		        $this->addUsingAlias(BookEntityMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
		        $useMinMax = true;
		    }
		    if (isset($price['max'])) {
		        $this->addUsingAlias(BookEntityMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
		        $useMinMax = true;
		    }
		    if ($useMinMax) {
		        return $this;
		    }
		    if (null === $comparison) {
		        $comparison = Criteria::IN;
		    }
		}

		return $this->addUsingAlias(BookEntityMap::COL_PRICE, $price, $comparison);
	}

	/**
	 * Filter the query by primary key.
	 * 
	 * @param mixed $key Primary key to use for the query
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key) {
		return $this->addUsingAlias(BookEntityMap::COL_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by primary key.
	 * 
	 * @param array $keys Primary keys to use for the query
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys(array $keys) {
		return $this->addUsingAlias(BookEntityMap::COL_ID, $keys, Criteria::IN);

		return $this;
	}

	/**
	 * Filter the query on the title field.
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 * 
	 * @param string $title The value to use as filter.
	 *  Accepts wildcards (* and % trigger a LIKE)
	 * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function filterByTitle($title, $comparison = null) {
		if (null === $comparison) {
		    if (is_array($title)) {
		        $comparison = Criteria::IN;
		    } elseif (preg_match('/[\%\*]/', $title)) {
		        $title = str_replace('*', '%', $title);
		        $comparison = Criteria::LIKE;
		    }
		}

		return $this->addUsingAlias(BookEntityMap::COL_TITLE, $title, $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Author relation.
	 * 
	 * @param string $relationAlias optional alias for the relation
	 * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 * @return $this|BookQuery The current query, for fluid interface
	 */
	public function joinAuthor($relationAlias = null, $joinType = Criteria::LEFT_JOIN) {
		$entityMap = $this->getEntityMap();
		$relationMap = $entityMap->getRelation('Author');

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
		    $this->addJoinObject($join, 'Author');
		}

		return $this;
	}

	/**
	 * Use the Author relation Author object
	 * 
	 * @see useQuery()
	 * 
	 * @param string $relationAlias optional alias for the relation, to be used as main alias in the secondary query
	 * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 * @return AuthorQuery A secondary query class using the current class as primary query
	 */
	public function useAuthorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN) {
		return $this
		    ->joinAuthor($relationAlias, $joinType)
		    ->useQuery($relationAlias ? $relationAlias : 'Author', 'Book');
	}
}