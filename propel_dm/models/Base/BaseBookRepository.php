<?php

namespace Base;

use Propel\Runtime\Propel;
use Propel\Runtime\Exception\PropelException;
use Book;
use Map\BookEntityMap;
use BookQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 */
class BaseBookRepository extends \Propel\Runtime\Repository\Repository {

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

		// field title
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'title'), 'title');
		    if (!isset($originValues['title'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['title'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['title'] = $currentValue;
		    $changed = true;
		}

		// field ISBN
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'ISBN'), 'ISBN');
		    if (!isset($originValues['ISBN'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['ISBN'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['ISBN'] = $currentValue;
		    $changed = true;
		}

		// field price
		$different = null;

		if (null === $different) {
		    $currentValue = $this->getEntityMap()->prepareReadingValue($reader($entity, 'price'), 'price');
		    if (!isset($originValues['price'])) {
		        $lastValue = null;
		    } else {
		        $lastValue = $originValues['price'];
		    }
		    $different = $lastValue !== $currentValue;
		}
		if ($different) {
		    $changes['price'] = $currentValue;
		    $changed = true;
		}

		// relation author
		if ($foreignEntity = $reader($entity, 'author')) {
		    $foreignEntityReader = $this->getConfiguration()->getEntityMap('Author')->getPropReader();

		    if ($originValues['authorId'] !== ($v = $foreignEntityReader($foreignEntity, 'id'))) {
		        $changed = true;
		        $changes['authorId'] = $v;
		    }

		} else {
		    
		    if (null !== $originValues['authorId']) {
		        $changed = true;
		        $changes['authorId'] = null;
		    }

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
		$criteria->add(\Map\BookEntityMap::COL_ID, $reader($entity, 'id'));
		return $criteria;
	}

	/**
	 * Create a new instance of $entityClassName.
	 * 
	 * @return Book
	 */
	public function createObject() {
		$object = new Book;

		return $object;
	}

	/**
	 * Create a new proxy instance of Book.
	 * 
	 * @return \Base\BookProxy
	 */
	public function createProxy() {
		return new \Base\BookProxy($this);
	}

	/**
	 * Create a new query instance of Book.
	 * 
	 * @param string $alias
	 * @param Criteria $criteria
	 * @return BookQuery
	 */
	public function createQuery($alias = null, Criteria $criteria = null) {
		$query = new BookQuery();
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
	 * @return Book
	 */
	public function find($key) {
		if (null === $key) {
		    return null;
		}
		if ((null !== ($obj = $this->getInstanceFromFirstLevelCache('Book', $key)))) {
		    // the object is already in the instance pool
		    return $obj;
		}

		return $this->doFind($key);
	}

	/**
	 * @return BookEntityMap
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
	 * Removes a instance of Book.
	 * 
	 * @param Book $entity
	 */
	public function remove(Book $entity) {
		$session = $this->getConfiguration()->getSession();
		$session->remove($entity);
		$session->commit();
	}

	/**
	 * Saves a instance of Book.
	 * 
	 * @param Book $entity
	 */
	public function save(Book $entity) {
		$session = $this->getConfiguration()->getSession();
		$session->persist($entity, true);
		$session->commit();
	}

	/**
	 * doDeleteAll implementation for SQL Platforms
	 */
	protected function doDeleteAll() {
		$connection = $this->getConfiguration()->getConnectionManager('bookstore')->getWriteConnection();
		        $sql = 'DELETE FROM book';
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
	 * @return Book
	 */
	protected function doFind($key) {
		$connection = $this->getConfiguration()->getConnectionManager('bookstore')->getWriteConnection();
		        $sql = 'SELECT id, title, isbn, price, author_id FROM book WHERE id = :p0';
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