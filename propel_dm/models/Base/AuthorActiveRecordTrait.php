<?php

namespace Base;

use Propel\Runtime\Map\EntityMap;
use Author;
use Base\BaseAuthorRepository;

/**
 */
trait AuthorActiveRecordTrait {

	/**
	 * Deletes the entity immediately
	 */
	public function delete() {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		$repository->remove($this);
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
	 * @param array $arr
	 * @param string $keyType The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 */
	public function fromArray(array $arr, $keyType = EntityMap::TYPE_FIELDNAME) {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository->getEntityMap()->fromArray($this, $arr, $keyType);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string
	 * 
	 * @param string $name name of the field
	 * @param string $type The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 * @return $this|Author
	 */
	public function getByName($name, $type = EntityMap::TYPE_FIELDNAME) {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository->getEntityMap()->getByName($this, $name, $type);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema. Zero-based
	 * 
	 * @param integer $pos position in xml schema
	 * @return $this|Author
	 */
	public function getByPosition($pos) {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository->getEntityMap()->getByPosition($this, $pos);
	}

	/**
	 * Returns the current primary key
	 * 
	 * @return array|integer|string
	 */
	public function getPrimaryKey() {
		return $this->getRepository()->getPrimaryKey($this);
	}

	/**
	 * @return \Propel\Runtime\Configuration
	 */
	public function getPropelConfiguration() {
		return \Propel\Runtime\Configuration::getCurrentConfiguration();
	}

	/**
	 * Returns the repository for this entity
	 * 
	 * @return BaseAuthorRepository
	 */
	public function getRepository() {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository;
	}

	/**
	 * Returns true if this is a new (not yet saved/committed) instance
	 * 
	 * @return boolean
	 */
	public function isNew() {
		return $this->getPropelConfiguration()->getSession()->isNew($this);
	}

	/**
	 * Saves the entity and all it relations immediately
	 */
	public function save() {
		$this->getRepository()->save($this);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema. Zero-based
	 * 
	 * @param string $name name of the field
	 * @param mixed $value field value
	 * @param string $type The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 * @return $this|Author
	 */
	public function setByName($name, $value, $type = EntityMap::TYPE_FIELDNAME) {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository->getEntityMap()->setByName($this, $name, $value, $type);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema. Zero-based
	 * 
	 * @param integer $pos position in xml schema
	 * @param mixed $value field value
	 * @return $this|Author
	 */
	public function setByPosition($pos, $value) {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository->getEntityMap()->setByPosition($this, $pos, $value);
	}

	/**
	 * Exports the object as an array.
	 * 
	 * You can specify the key type of the array by passing one of the class
	 * type constants. The default key type is the column's EntityMap::TYPE_FIELDNAME.
	 * 
	 * @param string $keyType The type of fieldname the $name is of:
	 * one of the class type constants EntityMap::TYPE_PHPNAME, EntityMap::TYPE_CAMELNAME
	 * EntityMap::TYPE_COLNAME, EntityMap::TYPE_FIELDNAME, EntityMap::TYPE_NUM.
	 * Defaults to EntityMap::TYPE_FIELDNAME.
	 * @param boolean $includeLazyLoadColumns Whether to include lazy loaded columns
	 * @param boolean $includeForeignObjects Whether to include hydrated related objects
	 * @param object $alreadyDumpedObjectsWatcher
	 */
	public function toArray($keyType = EntityMap::TYPE_FIELDNAME, $includeLazyLoadColumns = true, $includeForeignObjects = false, $alreadyDumpedObjectsWatcher = null) {
		/** @var $repository BaseAuthorRepository */
		$repository = $this->getPropelConfiguration()->getRepository('Author');
		return $repository->getEntityMap()->toArray($this, $keyType, $includeLazyLoadColumns, $includeForeignObjects, $alreadyDumpedObjectsWatcher);
	}
}