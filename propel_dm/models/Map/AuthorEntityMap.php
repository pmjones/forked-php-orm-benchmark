<?php

namespace Map;

use Propel\Runtime\Propel;
use Propel\Runtime\Map\EntityMap;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Session\DependencyGraph;
use Propel\Runtime\Session\Session;
use Propel\Runtime\ActiveQuery\Criteria;
use Map\AuthorEntityMap;

/**
 */
class AuthorEntityMap extends \Propel\Runtime\Map\EntityMap {

	const COL_EMAIL = 'Author.email';
	const COL_FIRSTNAME = 'Author.firstName';
	const COL_ID = 'Author.id';
	const COL_LASTNAME = 'Author.lastName';
	const DATABASE_NAME = 'bookstore';
	const ENTITY_CLASS = 'Author';
	const FQ_TABLE_NAME = 'author';
	const TABLE_NAME = 'author';

	/**
	 */
	public $fieldKeys = array (
	  'phpName' => 
	  array (
	    'Id' => 0,
	    'FirstName' => 1,
	    'LastName' => 2,
	    'Email' => 3,
	  ),
	  'colName' => 
	  array (
	    'id' => 0,
	    'first_name' => 1,
	    'last_name' => 2,
	    'email' => 3,
	  ),
	  'fullColName' => 
	  array (
	    'author.id' => 0,
	    'author.first_name' => 1,
	    'author.last_name' => 2,
	    'author.email' => 3,
	  ),
	  'fieldName' => 
	  array (
	    'id' => 0,
	    'firstName' => 1,
	    'lastName' => 2,
	    'email' => 3,
	  ),
	  'num' => 
	  array (
	    0 => 0,
	    1 => 1,
	    2 => 2,
	    3 => 3,
	  ),
	);

	/**
	 */
	public $fieldNames = array (
	  'phpName' => 
	  array (
	    0 => 'Id',
	    1 => 'FirstName',
	    2 => 'LastName',
	    3 => 'Email',
	  ),
	  'colName' => 
	  array (
	    0 => 'id',
	    1 => 'first_name',
	    2 => 'last_name',
	    3 => 'email',
	  ),
	  'fullColName' => 
	  array (
	    0 => 'author.id',
	    1 => 'author.first_name',
	    2 => 'author.last_name',
	    3 => 'author.email',
	  ),
	  'fieldName' => 
	  array (
	    0 => 'id',
	    1 => 'firstName',
	    2 => 'lastName',
	    3 => 'email',
	  ),
	  'num' => 
	  array (
	    0 => 0,
	    1 => 1,
	    2 => 2,
	    3 => 3,
	  ),
	);

	/**
	 * @param Criteria $criteria
	 * @param string $alias
	 */
	public function addSelectFields(Criteria $criteria, $alias = null) {
		if (null === $alias) {
		    $criteria->addSelectField(AuthorEntityMap::COL_ID);
		    $criteria->addSelectField(AuthorEntityMap::COL_FIRSTNAME);
		    $criteria->addSelectField(AuthorEntityMap::COL_LASTNAME);
		    $criteria->addSelectField(AuthorEntityMap::COL_EMAIL);
		} else {
		    $criteria->addSelectField($alias . '.id');
		    $criteria->addSelectField($alias . '.firstName');
		    $criteria->addSelectField($alias . '.lastName');
		    $criteria->addSelectField($alias . '.email');
		}
	}

	/**
	 */
	public function buildFields() {
		$this->addPrimaryKey(
		    'id',
		    'INTEGER',
		    true,
		    null,
		    null,
		    false
		);
		$this->getField('id')->setAutoIncrement(true);
		$this->getField('id')->setColumnName('id');
		$this->addField(
		    'firstName',
		    'VARCHAR',
		    true,
		    128,
		    null,
		    false
		);
		$this->getField('firstName')->setColumnName('first_name');
		$this->addField(
		    'lastName',
		    'VARCHAR',
		    true,
		    128,
		    null,
		    false
		);
		$this->getField('lastName')->setColumnName('last_name');
		$this->addField(
		    'email',
		    'VARCHAR',
		    false,
		    128,
		    null,
		    false
		);
		$this->getField('email')->setColumnName('email');
	}

	/**
	 */
	public function buildRelations() {
		$this->addRelation('book', 'Book', RelationMap::ONE_TO_MANY, array('id' => 'authorId', ), 'SET NULL', 'CASCADE', 'books');
	}

	/**
	 * @param mixed $entity
	 * @param array $outgoingParams
	 */
	public function buildSqlBulkInsertPart($entity, array &$outgoingParams) {
		$params = [];
		$entityReader = $this->getPropReader();
		        
		//field:firstName
		$value = $entityReader($entity, 'firstName');
		$params['firstName'] = $value;
		$outgoingParams[] = $value;
		//end field:firstName

		//field:lastName
		$value = $entityReader($entity, 'lastName');
		$params['lastName'] = $value;
		$outgoingParams[] = $value;
		//end field:lastName

		//field:email
		$value = $entityReader($entity, 'email');
		$params['email'] = $value;
		$outgoingParams[] = $value;
		//end field:email

		return '(?, ?, ?)';
	}

	/**
	 * @param mixed $entity
	 * @param array $params
	 */
	public function buildSqlPrimaryCondition($entity, array &$params) {
		$entityReader = $this->getPropReader();
		        
		//id
		$value = null;
		$value = $entityReader($entity, 'id');

		$value += 0; //cast to numeric
		$params[] = $value;

		return 'id = ?';
	}

	/**
	 * @param mixed $entity
	 * @param mixed $target
	 * @param array $excludeFields
	 */
	public function copyInto($entity, $target, array $excludeFields = array()) {
		$excludeFields = array_flip($excludeFields);
		$entityReader = $this->getPropReader();
		$targetWriter = $this->getConfiguration()->getEntityMapForEntity($target)->getPropWriter();

		if (!isset($excludeFields['id'])) {
		    $targetWriter($target, 'id', $entityReader($entity, 'id'));
		}

		if (!isset($excludeFields['firstName'])) {
		    $targetWriter($target, 'firstName', $entityReader($entity, 'firstName'));
		}

		if (!isset($excludeFields['lastName'])) {
		    $targetWriter($target, 'lastName', $entityReader($entity, 'lastName'));
		}

		if (!isset($excludeFields['email'])) {
		    $targetWriter($target, 'email', $entityReader($entity, 'email'));
		}
	}

	/**
	 * Populates the object using an array.
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the field
	 * names and sets all values through its setter or directly into the property.
	 * 
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME,
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * The default key type is the column's EntityMap::TYPE_FIELDNAME.
	 * 
	 * @param object $entity
	 * @param array $arr
	 * @param string $keyType The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 */
	public function fromArray($entity, array $arr, $keyType = EntityMap::TYPE_FIELDNAME) {
		$writer = $this->getPropWriter();
		$keys = $this->getFieldNames($keyType);
		//id
		if (isset($arr[$keys[0]])) {
		    $value = $arr[$keys[0]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setId') && is_callable([$entity, 'setId'])) {
		    $entity->setId($value);
		} else {
		    $writer($entity, 'id', $value);
		}
		        
		//firstName
		if (isset($arr[$keys[1]])) {
		    $value = $arr[$keys[1]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setFirstName') && is_callable([$entity, 'setFirstName'])) {
		    $entity->setFirstName($value);
		} else {
		    $writer($entity, 'firstName', $value);
		}
		        
		//lastName
		if (isset($arr[$keys[2]])) {
		    $value = $arr[$keys[2]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setLastName') && is_callable([$entity, 'setLastName'])) {
		    $entity->setLastName($value);
		} else {
		    $writer($entity, 'lastName', $value);
		}
		        
		//email
		if (isset($arr[$keys[3]])) {
		    $value = $arr[$keys[3]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setEmail') && is_callable([$entity, 'setEmail'])) {
		    $entity->setEmail($value);
		} else {
		    $writer($entity, 'email', $value);
		}
	}

	/**
	 * @return string[]
	 */
	public function getAutoIncrementFieldNames() {
		return array (
		  0 => 'id',
		);
	}

	/**
	 * @return array
	 */
	public function getBehaviors() {
		return array(
		);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string
	 * 
	 * @param object $entity
	 * @param string $name name of the field
	 * @param string $type The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 */
	public function getByName($entity, $name, $type = EntityMap::TYPE_FIELDNAME) {
		$pos = $this->translateFieldName($name, $type, EntityMap::TYPE_NUM);

		return $this->getByPosition($entity, $pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema. Zero-based
	 * 
	 * @param object $entity
	 * @param integer $pos position in xml schema
	 * @return $this|AuthorEntityMap
	 */
	public function getByPosition($entity, $pos) {
		$reader = $this->getPropReader();
		switch ($pos) {
		    case 0:
		        if (method_exists($entity, 'getId') && is_callable([$entity, 'getId'])) {
		            return $entity->getId();
		        } else {
		            return $reader($entity, 'id');
		        }
		        break;
		    case 1:
		        if (method_exists($entity, 'getFirstName') && is_callable([$entity, 'getFirstName'])) {
		            return $entity->getFirstName();
		        } else {
		            return $reader($entity, 'firstName');
		        }
		        break;
		    case 2:
		        if (method_exists($entity, 'getLastName') && is_callable([$entity, 'getLastName'])) {
		            return $entity->getLastName();
		        } else {
		            return $reader($entity, 'lastName');
		        }
		        break;
		    case 3:
		        if (method_exists($entity, 'getEmail') && is_callable([$entity, 'getEmail'])) {
		            return $entity->getEmail();
		        } else {
		            return $reader($entity, 'email');
		        }
		        break;
		} // switch()

		return $this;
	}

	/**
	 */
	public function getPropIsset() {
		if (!$this->propIsset) {
		    $this->propIsset = $this->getClassPropIsset('Author');
		}
		return $this->propIsset;
	}

	/**
	 */
	public function getPropReader() {
		if (!$this->propReader) {
		    $this->propReader = $this->getClassPropReader('Author');
		}
		return $this->propReader;
	}

	/**
	 */
	public function getPropWriter() {
		if (!$this->propWriter) {
		$this->propWriter = $this->getClassPropWriter('Author');
		}
		return $this->propWriter;
	}

	/**
	 * @return string full call name of the repository
	 */
	public function getRepositoryClass() {
		return 'Base\BaseAuthorRepository';
	}

	/**
	 * @param object $entity
	 * @return array
	 */
	public function getSnapshot($entity) {
		$reader = $this->getPropReader();
		$snapshot = [];
		$snapshot['id'] = $this->prepareReadingValue($reader($entity, 'id'), 'id');
		$snapshot['firstName'] = $this->prepareReadingValue($reader($entity, 'firstName'), 'firstName');
		$snapshot['lastName'] = $this->prepareReadingValue($reader($entity, 'lastName'), 'lastName');
		$snapshot['email'] = $this->prepareReadingValue($reader($entity, 'email'), 'email');

		return $snapshot;
	}

	/**
	 * @return boolean Whether this entity contains at least one field with auto-increment value.
	 */
	public function hasAutoIncrement() {
		return true;
	}

	/**
	 */
	public function initialize() {
		parent::initialize();

		        $this->setName('Author');
		        $this->setDatabaseName('bookstore');
		        $this->setFullClassName('Author');
		        $this->setTableName('author');
		        $this->setAllowPkInsert(false);
		        $this->setIdentifierQuoting(false);
		        
		        $this->setUseIdGenerator(true);
		        $this->buildFields();
	}

	/**
	 * Checks whether all primary key fields are valid (not null) in $row.
	 * 
	 * @param array $row
	 * @param integer $offset
	 * @param string $indexType
	 */
	public function isValidRow(array $row, $offset = 0, $indexType = EntityMap::TYPE_NUM) {
		if (EntityMap::TYPE_NUM === $indexType) {

		    if (null === $row[$offset + 0]) return false;
		} else if (EntityMap::TYPE_PHPNAME === $indexType) {
		    //ColumnName

		    if (null === $row['id']) return false;
		} else if (EntityMap::TYPE_COLNAME === $indexType) {
		    //columnName

		    if (null === $row['id']) return false;
		} else if (EntityMap::TYPE_FIELDNAME === $indexType) {
		    //column_name

		    if (null === $row['id']) return false;
		} else if (EntityMap::TYPE_FULLCOLNAME === $indexType) {
		    //book.column_name

		    if (null === $row['Author.id']) return false;
		}

		return true;
	}

	/**
	 * @param Session $session
	 * @param object $entity
	 * @param boolean $deep
	 */
	public function persistDependencies(Session $session, $entity, $deep = false) {
		$reader = $this->getPropReader();
	}

	/**
	 * @param object $entity
	 * @param object $autoIncrementValues
	 */
	public function populateAutoIncrementFields($entity, $autoIncrementValues) {
		$reader = $this->getPropReader();
		$writer = $this->getPropWriter();
		        
		                if ($value = $reader($entity, 'id')) {
		                    $autoIncrementValues->id = $value;
		                } else {
		                    $writer($entity, 'id', $autoIncrementValues->id);
		                    $autoIncrementValues->id++;
		                }
	}

	/**
	 * @param object $entity
	 * @param DependencyGraph $dependencyGraph
	 */
	public function populateDependencyGraph($entity, DependencyGraph $dependencyGraph) {
		$reader = $this->getPropReader();
		$dependencies = [];

		$dependencyGraph->add($entity, $dependencies);
	}

	/**
	 * @param array $row
	 * @param integer $offset
	 * @param string $indexType
	 * @param object $entity
	 */
	public function populateObject(array $row, &$offset = 0, $indexType = EntityMap::TYPE_NUM, $entity = null) {
		if (EntityMap::TYPE_NUM === $indexType) {
		    //0

		    $pk[] = $this->prepareWritingValue($row[$offset + 0], 'id');
		} else if (EntityMap::TYPE_COLNAME === $indexType) {
		    //columnName

		    $pk[] = $this->prepareWritingValue($row[$offset + 0], 'id');
		} else if (EntityMap::TYPE_FIELDNAME === $indexType) {
		    //column_name

		    $pk[] = $this->prepareWritingValue($row[$offset + 0], 'id');
		} else if (EntityMap::TYPE_FULLCOLNAME === $indexType) {
		    //book.column_name

		    $pk[] = $this->prepareWritingValue($row[$offset + 0], 'id');
		}
		        $pk = $pk[0];

		$hashcode = json_encode($pk);
		if ($object = $this->getConfiguration()->getSession()->getInstanceFromFirstLevelCache('Author', $hashcode)) {
		    return $object;
		}

		$writer = $this->getPropWriter();
		if ($entity) {
		    $obj = $entity;
		} else {
		    $obj = $this->getRepository()->createProxy();
		}
		$obj->__duringInitializing__ = true;
		$originalValues = [];

		if (EntityMap::TYPE_NUM === $indexType) {
		    //0

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['firstName'] = $this->prepareWritingValue($row[$offset + 1], 'firstName');
		    $writer($obj, 'firstName', $originalValues['firstName']);
		    $originalValues['lastName'] = $this->prepareWritingValue($row[$offset + 2], 'lastName');
		    $writer($obj, 'lastName', $originalValues['lastName']);
		    $originalValues['email'] = $this->prepareWritingValue($row[$offset + 3], 'email');
		    $writer($obj, 'email', $originalValues['email']);
		} else if (EntityMap::TYPE_COLNAME === $indexType) {
		    //columnName

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['firstName'] = $this->prepareWritingValue($row[$offset + 1], 'firstName');
		    $writer($obj, 'firstName', $originalValues['firstName']);
		    $originalValues['lastName'] = $this->prepareWritingValue($row[$offset + 2], 'lastName');
		    $writer($obj, 'lastName', $originalValues['lastName']);
		    $originalValues['email'] = $this->prepareWritingValue($row[$offset + 3], 'email');
		    $writer($obj, 'email', $originalValues['email']);
		} else if (EntityMap::TYPE_FIELDNAME === $indexType) {
		    //column_name

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['firstName'] = $this->prepareWritingValue($row[$offset + 1], 'firstName');
		    $writer($obj, 'firstName', $originalValues['firstName']);
		    $originalValues['lastName'] = $this->prepareWritingValue($row[$offset + 2], 'lastName');
		    $writer($obj, 'lastName', $originalValues['lastName']);
		    $originalValues['email'] = $this->prepareWritingValue($row[$offset + 3], 'email');
		    $writer($obj, 'email', $originalValues['email']);
		} else if (EntityMap::TYPE_FULLCOLNAME === $indexType) {
		    //book.column_name

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['firstName'] = $this->prepareWritingValue($row[$offset + 1], 'firstName');
		    $writer($obj, 'firstName', $originalValues['firstName']);
		    $originalValues['lastName'] = $this->prepareWritingValue($row[$offset + 2], 'lastName');
		    $writer($obj, 'lastName', $originalValues['lastName']);
		    $originalValues['email'] = $this->prepareWritingValue($row[$offset + 3], 'email');
		    $writer($obj, 'email', $originalValues['email']);
		}

		$this->getConfiguration()->getSession()->setLastKnownValues($obj, $originalValues);
		$offset = $offset + 4;
		unset($obj->__duringInitializing__);
		return $obj;
	}

	/**
	 * @param mixed $value
	 * @param string $field
	 * @return mixed
	 */
	public function prepareReadingValue($value, $field) {
		return $value;
	}

	/**
	 * @param mixed $value
	 * @param string $field
	 * @return mixed
	 */
	public function prepareWritingValue($value, $field) {
		if ($field === 'id') {
		    $value = $value + 0;
		}

		return $value;
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema. Zero-based
	 * 
	 * @param object $entity
	 * @param string $name name of the field
	 * @param mixed $value field value
	 * @param string $type The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 */
	public function setByName($entity, $name, $value, $type = EntityMap::TYPE_FIELDNAME) {
		$pos = $this->translateFieldName($name, $type, EntityMap::TYPE_NUM);

		return $this->setByPosition($entity, $pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema. Zero-based
	 * 
	 * @param object $entity
	 * @param integer $pos position in xml schema
	 * @param mixed $value field value
	 * @return $this|AuthorEntityMap
	 */
	public function setByPosition($entity, $pos, $value) {
		$writer = $this->getPropWriter();
		switch ($pos) {
		    case 0:
		        if (method_exists($entity, 'setId') && is_callable([$entity, 'setId'])) {
		            return $entity->setId($value);
		        } else {
		            $writer($entity, 'id', $value);
		        }
		        break;
		    case 1:
		        if (method_exists($entity, 'setFirstName') && is_callable([$entity, 'setFirstName'])) {
		            return $entity->setFirstName($value);
		        } else {
		            $writer($entity, 'firstName', $value);
		        }
		        break;
		    case 2:
		        if (method_exists($entity, 'setLastName') && is_callable([$entity, 'setLastName'])) {
		            return $entity->setLastName($value);
		        } else {
		            $writer($entity, 'lastName', $value);
		        }
		        break;
		    case 3:
		        if (method_exists($entity, 'setEmail') && is_callable([$entity, 'setEmail'])) {
		            return $entity->setEmail($value);
		        } else {
		            $writer($entity, 'email', $value);
		        }
		        break;
		} // switch()

		return $this;
	}

	/**
	 * Exports the object as an array.
	 * 
	 * You can specify the key type of the array by passing one of the class
	 * type constants. The default key type is the column's EntityMap::TYPE_FIELDNAME.
	 * 
	 * @param object $entity
	 * @param string $keyType The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 * @param boolean $includeLazyLoadColumns Whether to include lazy loaded columns
	 * @param boolean $includeForeignObjects Whether to include hydrated related objects
	 * @param object $alreadyDumpedObjectsWatcher
	 * @return array
	 */
	public function toArray($entity, $keyType = EntityMap::TYPE_FIELDNAME, $includeLazyLoadColumns = true, $includeForeignObjects = false, $alreadyDumpedObjectsWatcher = null) {
		if (!($alreadyDumpedObjectsWatcher instanceof \stdClass)) {
		    $alreadyDumpedObjectsWatcher = new \stdClass;
		    $alreadyDumpedObjectsWatcher->objects = [];
		}

		if (isset($alreadyDumpedObjectsWatcher->objects[spl_object_hash($entity)])) {
		    return '*RECURSION*';
		}

		$alreadyDumpedObjectsWatcher->objects[spl_object_hash($entity)] = true;
		$reader = $this->getPropReader();
		$keys = $this->getFieldNames($keyType);
		$array = [];
		//id
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getId') && is_callable([$entity, 'getId'])) {
		        $value = $entity->getId();
		    } else {
		        $value = $reader($entity, 'id');
		    }
		    $array[$keys[0]] = $value;
		}
		        
		//firstName
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getFirstName') && is_callable([$entity, 'getFirstName'])) {
		        $value = $entity->getFirstName();
		    } else {
		        $value = $reader($entity, 'firstName');
		    }
		    $array[$keys[1]] = $value;
		}
		        
		//lastName
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getLastName') && is_callable([$entity, 'getLastName'])) {
		        $value = $entity->getLastName();
		    } else {
		        $value = $reader($entity, 'lastName');
		    }
		    $array[$keys[2]] = $value;
		}
		        
		//email
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getEmail') && is_callable([$entity, 'getEmail'])) {
		        $value = $entity->getEmail();
		    } else {
		        $value = $reader($entity, 'email');
		    }
		    $array[$keys[3]] = $value;
		}
		        
		//ref relation to Author
		$relationName = 'books';
		/** @var array|\Propel\Runtime\Collection\ObjectCollection $foreignEntity */
		$foreignEntity = $reader($entity, 'books');
		$foreignEntityMap = $this->getConfiguration()->getEntityMap('Author');
		$value = [];
		if ($foreignEntity) {
		    $value = $foreignEntity->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjectsWatcher);
		}
		if ($value) {
		    
		    if (EntityMap::TYPE_PHPNAME === $keyType) {
		        $relationName = ucfirst($relationName);
		    }
		        
		    $array[$relationName] = $value;
		}

		return $array;
	}
}