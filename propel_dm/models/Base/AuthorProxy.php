<?php

namespace Base;

use Base\BaseAuthorRepository;

/**
 */
class AuthorProxy extends \Author implements \Propel\Runtime\EntityProxyInterface {

	/**
	 */
	public $__duringInitializing__ = false;

	/**
	 */
	private $_repository = null;

	/**
	 * @param BaseAuthorRepository $repository
	 */
	public function __construct(BaseAuthorRepository $repository) {
		$this->_repository = $repository;
		unset($this->firstName, $this->lastName, $this->email);
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

		if (!isset($this->__duringInitializing__) && 'firstName' === $name && !isset($this->firstName)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'lastName' === $name && !isset($this->lastName)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'email' === $name && !isset($this->email)) {

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

		if (!isset($this->__duringInitializing__) && 'firstName' === $name && !isset($this->firstName)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'lastName' === $name && !isset($this->lastName)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		if (!isset($this->__duringInitializing__) && 'email' === $name && !isset($this->email)) {

		    $this->__duringInitializing__ = true;

		    echo "@@start lazy loading due to $name " . __METHOD__ . PHP_EOL;
		    $this->_repository->load($this);
		    

		    unset($this->__duringInitializing__);
		}

		$this->$name = $value;
	}
}