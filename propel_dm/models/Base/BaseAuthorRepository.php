<?php

namespace Base;

use Propel\Runtime\Propel;
use Propel\Runtime\Exception\PropelException;
use Author;
use Map\AuthorEntityMap;
use AuthorQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 */
class BaseAuthorRepository extends \Propel\Runtime\Repository\Repository {

	/**
	 * @param object $entity
	 * @return array|false Returns false when no changes are detected
	 */
	public function buildChangeSet($entity) {
		$changes = [];
		$changed = false;
		$reader = $this->getEntityMap()->getPropReader();
		$isset = $this->getEntityMap()->getPropIsset();
		$id = spl_object_hash($entity);
		$originValues = $this->getLastKnownValues($id);

		// field id
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'id'), 'id');
		    if (!isset($originValues['id'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['id'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['id'] = $currentValue;
		    $changed = true;
		}

		// field firstName
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'firstName'), 'firstName');
		    if (!isset($originValues['firstName'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['firstName'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['firstName'] = $currentValue;
		    $changed = true;
		}

		// field lastName
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'lastName'), 'lastName');
		    if (!isset($originValues['lastName'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['lastName'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['lastName'] = $currentValue;
		    $changed = true;
		}

		// field email
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'email'), 'email');
		    if (!isset($originValues['email'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['email'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['email'] = $currentValue;
		    $changed = true;
		}

		if ($changed) {
		    return $changes;
		}

		return false;
	}

	/**
	 * @param object $entity
	 * @return Criteria
	 */
	public function buildPkeyCriteria($entity) {
		$reader = $this->getEntityMap()->getPropReader();

		$criteria = $this->createQuery();
		$criteria->add(\Map\AuthorEntityMap::COL_ID, $reader($entity, 'id'));
		return $criteria;
	}

	/**
	 * Create a new instance of $entityClassName.
	 * 
	 * @return Author
	 */
	public function createObject() {
		$object = new Author;

		return $object;
	}

	/**
	 * Create a new proxy instance of Author.
	 * 
	 * @return \Base\AuthorProxy
	 */
	public function createProxy() {
		return new \Base\AuthorProxy($this);
	}

	/**
	 * Create a new query instance of Author.
	 * 
	 * @param string $alias
	 * @param Criteria $criteria
	 * @return AuthorQuery
	 */
	public function createQuery($alias = null, Criteria $criteria = null) {
		$query = new AuthorQuery();
		if (null !== $alias) {
		    $query->setEntityAlias($alias);
		}
		if ($criteria instanceof Criteria) {
		    $query->mergeWith($criteria);
		}

		$query->setEntityMap($this->getEntityMap());
		$query->setConfiguration($this->getConfiguration());

		return $query;
	}

	/**
	 * @param int $key
	 * @return Author
	 */
	public function find($key) {
		if (null === $key) {
		    return null;
		}
		if ((null !== ($obj = $this->getInstanceFromFirstLevelCache('Author', $key)))) {
		    // the object is already in the instance pool
		    return $obj;
		}

		return $this->doFind($key);
	}

	/**
	 * @return AuthorEntityMap
	 */
	public function getEntityMap() {
		return parent::getEntityMap();
	}

	/**
	 * @param object $entity
	 * @return array|integer|string
	 */
	public function getPrimaryKey($entity) {
		$reader = $this->getEntityMap()->getPropReader();
		return $reader($entity, 'id' );
	}

	/**
	 * @param object $entity
	 */
	public function load($entity) {
		$reader = $this->getEntityMap()->getPropReader();
		$key = $reader($entity, 'id');
		$dataFetcher = $this
		    ->createQuery()
		    ->filterByPrimaryKey($key)
		    ->doSelect();

		$row = $dataFetcher->fetch();
		$indexStart = 0;
		$this->getEntityMap()->populateObject($row, $indexStart, $dataFetcher->getIndexType(), $entity);
	}

	/**
	 * Removes a instance of Author.
	 * 
	 * @param Author $entity
	 */
	public function remove(Author $entity) {
		$session = $this->getConfiguration()->getSession();
		$session->remove($entity);
		$session->commit();
	}

	/**
	 * Saves a instance of Author.
	 * 
	 * @param Author $entity
	 */
	public function save(Author $entity) {
		$session = $this->getConfiguration()->getSession();
		$session->persist($entity, true);
		$session->commit();
	}

	/**
	 * doDeleteAll implementation for SQL Platforms
	 */
	protected function doDeleteAll() {
		$connection = $this->getConfiguration()->getConnectionManager('bookstore')->getWriteConnection();
		        $sql = 'DELETE FROM author';
		        try {
		            $stmt = $connection->prepare($sql);
		            $stmt->execute();
		        } catch (Exception $e) {
		            $this->getConfiguration()->log($e->getMessage(), Propel::LOG_ERR);
		            throw new PropelException(sprintf('Unable to execute DELETE statement [%s]', $sql), 0, $e);
		        }
	}

	/**
	 * doFind implementation for SQL Platforms
	 * 
	 * @param mixed $key
	 * @return Author
	 */
	protected function doFind($key) {
		$connection = $this->getConfiguration()->getConnectionManager('bookstore')->getWriteConnection();
		        $sql = 'SELECT id, first_name, last_name, email FROM author WHERE id = :p0';
		        try {
		            $stmt = $connection->prepare($sql);
		            $stmt->bindValue(':p0', $key, \PDO::PARAM_INT);
		            $stmt->execute();
		        } catch (Exception $e) {
		            Propel::log($e->getMessage(), Propel::LOG_ERR);
		            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
		        }

		        $obj = null;
		        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
		            $populateInfo = $this->getEntityMap()->populateObject($row);
		        } else {
		            return null;
		        }

		        //$this->addFirstLevelCache($key, $obj);

		        return $populateInfo[0];
	}
}