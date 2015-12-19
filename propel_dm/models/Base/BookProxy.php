<?php

namespace Base;

use Base\BaseBookRepository;

/**
 */
class BookProxy extends \Book implements \Propel\Runtime\EntityProxyInterface {

	/**
	 */
	public $__duringInitializing__ = false;

	/**
	 */
	private $_repository = null;

	/**
	 * @param BaseBookRepository $repository
	 */
	public function __construct(BaseBookRepository $repository) {
		$this->_repository = $repository;
		unset($this->title, $this->ISBN, $this->price, $this->authorId);
	}

	/**
	 * @param mixed $name
	 */
	public function __get($name) {
		if (!isset($this->__duringInitializing__) && 'id' === $name && !isset($this->id)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'title' === $name && !isset($this->title)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'ISBN' === $name && !isset($this->ISBN)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'price' === $name && !isset($this->price)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'authorId' === $name && !isset($this->authorId)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		return $this->$name;
	}

	/**
	 * @param mixed $name
	 * @param mixed $value
	 */
	public function __set($name, $value) {
		if (!isset($this->__duringInitializing__) && 'id' === $name && !isset($this->id)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'title' === $name && !isset($this->title)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'ISBN' === $name && !isset($this->ISBN)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'price' === $name && !isset($this->price)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'authorId' === $name && !isset($this->authorId)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		$this->$name = $value;
	}
}