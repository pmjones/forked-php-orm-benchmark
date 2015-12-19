<?php

namespace Map;

use Propel\Runtime\Propel;
use Propel\Runtime\Map\EntityMap;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Session\DependencyGraph;
use Propel\Runtime\Session\Session;
use Propel\Runtime\ActiveQuery\Criteria;
use Map\BookEntityMap;

/**
 */
class BookEntityMap extends \Propel\Runtime\Map\EntityMap {

	const COL_AUTHORID = 'Book.authorId';
	const COL_ID = 'Book.id';
	const COL_ISBN = 'Book.ISBN';
	const COL_PRICE = 'Book.price';
	const COL_TITLE = 'Book.title';
	const DATABASE_NAME = 'bookstore';
	const ENTITY_CLASS = 'Book';
	const FQ_TABLE_NAME = 'book';
	const TABLE_NAME = 'book';

	/**
	 */
	public $fieldKeys = array (
	  'phpName' => 
	  array (
	    'Id' => 0,
	    'Title' => 1,
	    'ISBN' => 2,
	    'Price' => 3,
	    'AuthorId' => 4,
	  ),
	  'colName' => 
	  array (
	    'id' => 0,
	    'title' => 1,
	    'isbn' => 2,
	    'price' => 3,
	    'author_id' => 4,
	  ),
	  'fullColName' => 
	  array (
	    'book.id' => 0,
	    'book.title' => 1,
	    'book.isbn' => 2,
	    'book.price' => 3,
	    'book.author_id' => 4,
	  ),
	  'fieldName' => 
	  array (
	    'id' => 0,
	    'title' => 1,
	    'ISBN' => 2,
	    'price' => 3,
	    'authorId' => 4,
	  ),
	  'num' => 
	  array (
	    0 => 0,
	    1 => 1,
	    2 => 2,
	    3 => 3,
	    4 => 4,
	  ),
	);

	/**
	 */
	public $fieldNames = array (
	  'phpName' => 
	  array (
	    0 => 'Id',
	    1 => 'Title',
	    2 => 'ISBN',
	    3 => 'Price',
	    4 => 'AuthorId',
	  ),
	  'colName' => 
	  array (
	    0 => 'id',
	    1 => 'title',
	    2 => 'isbn',
	    3 => 'price',
	    4 => 'author_id',
	  ),
	  'fullColName' => 
	  array (
	    0 => 'book.id',
	    1 => 'book.title',
	    2 => 'book.isbn',
	    3 => 'book.price',
	    4 => 'book.author_id',
	  ),
	  'fieldName' => 
	  array (
	    0 => 'id',
	    1 => 'title',
	    2 => 'ISBN',
	    3 => 'price',
	    4 => 'authorId',
	  ),
	  'num' => 
	  array (
	    0 => 0,
	    1 => 1,
	    2 => 2,
	    3 => 3,
	    4 => 4,
	  ),
	);

	/**
	 * @param Criteria $criteria
	 * @param string $alias
	 */
	public function addSelectFields(Criteria $criteria, $alias = null) {
		if (null === $alias) {
		    $criteria->addSelectField(BookEntityMap::COL_ID);
		    $criteria->addSelectField(BookEntityMap::COL_TITLE);
		    $criteria->addSelectField(BookEntityMap::COL_ISBN);
		    $criteria->addSelectField(BookEntityMap::COL_PRICE);
		    $criteria->addSelectField(BookEntityMap::COL_AUTHORID);
		} else {
		    $criteria->addSelectField($alias . '.id');
		    $criteria->addSelectField($alias . '.title');
		    $criteria->addSelectField($alias . '.ISBN');
		    $criteria->addSelectField($alias . '.price');
		    $criteria->addSelectField($alias . '.authorId');
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
		    'title',
		    'VARCHAR',
		    true,
		    255,
		    null,
		    false
		);
		$this->getField('title')->setPrimaryString(true);
		$this->getField('title')->setColumnName('title');
		$this->addField(
		    'ISBN',
		    'VARCHAR',
		    true,
		    24,
		    null,
		    false
		);
		$this->getField('ISBN')->setColumnName('isbn');
		$this->addField(
		    'price',
		    'FLOAT',
		    false,
		    null,
		    null,
		    false
		);
		$this->getField('price')->setColumnName('price');
		$this->addForeignKey(
		    'authorId',
		    'INTEGER',
		    'Author',
		    'id',
		    false,
		    null,
		    null
		);
		$this->getField('authorId')->setColumnName('author_id');
	}

	/**
	 */
	public function buildRelations() {
		$this->addRelation('author', 'Author', RelationMap::MANY_TO_ONE, array('authorId' => 'id', ), 'SET NULL', 'CASCADE');
	}

	/**
	 * @param mixed $entity
	 * @param array $outgoingParams
	 */
	public function buildSqlBulkInsertPart($entity, array &$outgoingParams) {
		$params = [];
		$entityReader = $this->getPropReader();
		        
		//field:title
		$value = $entityReader($entity, 'title');
		$params['title'] = $value;
		$outgoingParams[] = $value;
		//end field:title

		//field:ISBN
		$value = $entityReader($entity, 'ISBN');
		$params['ISBN'] = $value;
		$outgoingParams[] = $value;
		//end field:ISBN

		//field:price
		$value = $entityReader($entity, 'price');
		$value += 0; //cast to numeric
		$params['price'] = $value;
		$outgoingParams[] = $value;
		//end field:price

		//relation:author
		$foreignEntityReader = $this->getClassPropReader('Author');
		if ($foreignEntity = $entityReader($entity, 'author')) {

		    $value = $foreignEntityReader($foreignEntity, 'id');
		    
		$value += 0; //cast to numeric
		} else {
		    $value = null;
		}
		if (!isset($params['authorId'])) {
		    $params['authorId'] = $value; //authorId
		    $outgoingParams[] = $value;
		}

		//end relation:author
		return '(?, ?, ?, ?)';
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

		if (!isset($excludeFields['title'])) {
		    $targetWriter($target, 'title', $entityReader($entity, 'title'));
		}

		if (!isset($excludeFields['ISBN'])) {
		    $targetWriter($target, 'ISBN', $entityReader($entity, 'ISBN'));
		}

		if (!isset($excludeFields['price'])) {
		    $targetWriter($target, 'price', $entityReader($entity, 'price'));
		}

		if (!isset($excludeFields['author'])) {
		    $targetWriter($target, 'author', $entityReader($entity, 'author'));
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
		        
		//title
		if (isset($arr[$keys[1]])) {
		    $value = $arr[$keys[1]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setTitle') && is_callable([$entity, 'setTitle'])) {
		    $entity->setTitle($value);
		} else {
		    $writer($entity, 'title', $value);
		}
		        
		//ISBN
		if (isset($arr[$keys[2]])) {
		    $value = $arr[$keys[2]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setISBN') && is_callable([$entity, 'setISBN'])) {
		    $entity->setISBN($value);
		} else {
		    $writer($entity, 'ISBN', $value);
		}
		        
		//price
		if (isset($arr[$keys[3]])) {
		    $value = $arr[$keys[3]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setPrice') && is_callable([$entity, 'setPrice'])) {
		    $entity->setPrice($value);
		} else {
		    $writer($entity, 'price', $value);
		}
		        
		//authorId
		if (isset($arr[$keys[4]])) {
		    $value = $arr[$keys[4]];
		} else {
		    $value = null;
		}
		if (method_exists($entity, 'setAuthorId') && is_callable([$entity, 'setAuthorId'])) {
		    $entity->setAuthorId($value);
		} else {
		    $writer($entity, 'authorId', $value);
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
	 * @return $this|BookEntityMap
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
		        if (method_exists($entity, 'getTitle') && is_callable([$entity, 'getTitle'])) {
		            return $entity->getTitle();
		        } else {
		            return $reader($entity, 'title');
		        }
		        break;
		    case 2:
		        if (method_exists($entity, 'getISBN') && is_callable([$entity, 'getISBN'])) {
		            return $entity->getISBN();
		        } else {
		            return $reader($entity, 'ISBN');
		        }
		        break;
		    case 3:
		        if (method_exists($entity, 'getPrice') && is_callable([$entity, 'getPrice'])) {
		            return $entity->getPrice();
		        } else {
		            return $reader($entity, 'price');
		        }
		        break;
		    case 4:
		        if (method_exists($entity, 'getAuthorId') && is_callable([$entity, 'getAuthorId'])) {
		            return $entity->getAuthorId();
		        } else {
		            return $reader($entity, 'authorId');
		        }
		        break;
		} // switch()

		return $this;
	}

	/**
	 */
	public function getPropIsset() {
		if (!$this->propIsset) {
		    $this->propIsset = $this->getClassPropIsset('Book');
		}
		return $this->propIsset;
	}

	/**
	 */
	public function getPropReader() {
		if (!$this->propReader) {
		    $this->propReader = $this->getClassPropReader('Book');
		}
		return $this->propReader;
	}

	/**
	 */
	public function getPropWriter() {
		if (!$this->propWriter) {
		$this->propWriter = $this->getClassPropWriter('Book');
		}
		return $this->propWriter;
	}

	/**
	 * @return string full call name of the repository
	 */
	public function getRepositoryClass() {
		return 'Base\BaseBookRepository';
	}

	/**
	 * @param object $entity
	 * @return array
	 */
	public function getSnapshot($entity) {
		$reader = $this->getPropReader();
		$snapshot = [];
		$snapshot['id'] = $this->prepareReadingValue($reader($entity, 'id'), 'id');
		$snapshot['title'] = $this->prepareReadingValue($reader($entity, 'title'), 'title');
		$snapshot['ISBN'] = $this->prepareReadingValue($reader($entity, 'ISBN'), 'ISBN');
		$snapshot['price'] = $this->prepareReadingValue($reader($entity, 'price'), 'price');

		if ($foreignEntity = $reader($entity, 'author')) {
		    $foreignEntityReader = $this->getConfiguration()->getEntityMap('Author')->getPropReader();

		    $value = $foreignEntityReader($foreignEntity, 'id');
		    $snapshot['authorId'] = $value;
		} else {
		    
		    $snapshot['authorId'] = null;
		}

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

		        $this->setName('Book');
		        $this->setDatabaseName('bookstore');
		        $this->setFullClassName('Book');
		        $this->setTableName('book');
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

		    if (null === $row['Book.id']) return false;
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
		// many-to-one Author

		if ($relationEntity = $reader($entity, 'author')) {
		    $session->persist($relationEntity, $deep);
		}
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

		if ($dep = $reader($entity, 'author')) {
		    $dependencies[] = $dep;
		}
		            
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
		if ($object = $this->getConfiguration()->getSession()->getInstanceFromFirstLevelCache('Book', $hashcode)) {
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
		    $originalValues['title'] = $this->prepareWritingValue($row[$offset + 1], 'title');
		    $writer($obj, 'title', $originalValues['title']);
		    $originalValues['ISBN'] = $this->prepareWritingValue($row[$offset + 2], 'ISBN');
		    $writer($obj, 'ISBN', $originalValues['ISBN']);
		    $originalValues['price'] = $this->prepareWritingValue($row[$offset + 3], 'price');
		    $writer($obj, 'price', $originalValues['price']);
		    $originalValues['authorId'] = $this->prepareWritingValue($row[$offset + 4], 'authorId');
		} else if (EntityMap::TYPE_COLNAME === $indexType) {
		    //columnName

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['title'] = $this->prepareWritingValue($row[$offset + 1], 'title');
		    $writer($obj, 'title', $originalValues['title']);
		    $originalValues['ISBN'] = $this->prepareWritingValue($row[$offset + 2], 'ISBN');
		    $writer($obj, 'ISBN', $originalValues['ISBN']);
		    $originalValues['price'] = $this->prepareWritingValue($row[$offset + 3], 'price');
		    $writer($obj, 'price', $originalValues['price']);
		    $originalValues['authorId'] = $this->prepareWritingValue($row[$offset + 4], 'authorId');
		} else if (EntityMap::TYPE_FIELDNAME === $indexType) {
		    //column_name

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['title'] = $this->prepareWritingValue($row[$offset + 1], 'title');
		    $writer($obj, 'title', $originalValues['title']);
		    $originalValues['ISBN'] = $this->prepareWritingValue($row[$offset + 2], 'ISBN');
		    $writer($obj, 'ISBN', $originalValues['ISBN']);
		    $originalValues['price'] = $this->prepareWritingValue($row[$offset + 3], 'price');
		    $writer($obj, 'price', $originalValues['price']);
		    $originalValues['authorId'] = $this->prepareWritingValue($row[$offset + 4], 'authorId');
		} else if (EntityMap::TYPE_FULLCOLNAME === $indexType) {
		    //book.column_name

		    $originalValues['id'] = $this->prepareWritingValue($row[$offset + 0], 'id');
		    $writer($obj, 'id', $originalValues['id']);
		    $originalValues['title'] = $this->prepareWritingValue($row[$offset + 1], 'title');
		    $writer($obj, 'title', $originalValues['title']);
		    $originalValues['ISBN'] = $this->prepareWritingValue($row[$offset + 2], 'ISBN');
		    $writer($obj, 'ISBN', $originalValues['ISBN']);
		    $originalValues['price'] = $this->prepareWritingValue($row[$offset + 3], 'price');
		    $writer($obj, 'price', $originalValues['price']);
		    $originalValues['authorId'] = $this->prepareWritingValue($row[$offset + 4], 'authorId');
		}

		//relation author
		$exist = true;
		$exist = $exist && null !== $originalValues['authorId'];
		if ($exist) {
		    $relationProxy = $this->getConfiguration()->getRepository('Author')->createProxy();
		    $relationProxyWriter = $this->getConfiguration()->getEntityMap('Author')->getPropWriter();

		    $relationProxyWriter($relationProxy, 'id', $originalValues['authorId']);
		    $writer($obj, 'author', $relationProxy);
		}

		$this->getConfiguration()->getSession()->setLastKnownValues($obj, $originalValues);
		$offset = $offset + 5;
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

		if ($field === 'price') {
		    $value = $value + 0;
		}

		if ($field === 'authorId') {
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
	 * @return $this|BookEntityMap
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
		        if (method_exists($entity, 'setTitle') && is_callable([$entity, 'setTitle'])) {
		            return $entity->setTitle($value);
		        } else {
		            $writer($entity, 'title', $value);
		        }
		        break;
		    case 2:
		        if (method_exists($entity, 'setISBN') && is_callable([$entity, 'setISBN'])) {
		            return $entity->setISBN($value);
		        } else {
		            $writer($entity, 'ISBN', $value);
		        }
		        break;
		    case 3:
		        if (method_exists($entity, 'setPrice') && is_callable([$entity, 'setPrice'])) {
		            return $entity->setPrice($value);
		        } else {
		            $writer($entity, 'price', $value);
		        }
		        break;
		    case 4:
		        if (method_exists($entity, 'setAuthorId') && is_callable([$entity, 'setAuthorId'])) {
		            return $entity->setAuthorId($value);
		        } else {
		            $writer($entity, 'authorId', $value);
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
		        
		//title
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getTitle') && is_callable([$entity, 'getTitle'])) {
		        $value = $entity->getTitle();
		    } else {
		        $value = $reader($entity, 'title');
		    }
		    $array[$keys[1]] = $value;
		}
		        
		//ISBN
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getISBN') && is_callable([$entity, 'getISBN'])) {
		        $value = $entity->getISBN();
		    } else {
		        $value = $reader($entity, 'ISBN');
		    }
		    $array[$keys[2]] = $value;
		}
		        
		//price
		if ($includeLazyLoadColumns || $includeLazyLoadColumns === false) {
		    if (method_exists($entity, 'getPrice') && is_callable([$entity, 'getPrice'])) {
		        $value = $entity->getPrice();
		    } else {
		        $value = $reader($entity, 'price');
		    }
		    $array[$keys[3]] = $value;
		}
		        
		//relation to Author
		$relationName = 'author';
		$foreignEntity = $reader($entity, 'author');
		$foreignEntityMap = $this->getConfiguration()->getEntityMap('Author');
		$value = null;
		if ($foreignEntity) {
		    $value = $foreignEntityMap->toArray($foreignEntity, $keyType, $includeLazyLoadColumns, $includeForeignObjects, $alreadyDumpedObjectsWatcher);
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