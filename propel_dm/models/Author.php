<?php

use Base\AuthorActiveRecordTrait;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;

/**
 */
class Author {

	/**
	 * @var Collection|Book[] Collection to store aggregation of Book objects
	 */
	protected $books = null;

	/**
	 * The value for the $clo field.
	 * 
	 * @var string
	 */
	protected $email = null;

	/**
	 * The value for the $clo field.
	 * 
	 * @var string
	 */
	protected $firstName = null;

	/**
	 * The value for the $clo field.
	 * 
	 * @var int
	 */
	protected $id = null;

	/**
	 * The value for the $clo field.
	 * 
	 * @var string
	 */
	protected $lastName = null;

	/**
	 */
	public function __construct() {
		$this->books = new ObjectCollection();
	}

	/**
	 * Associate a Book to this object
	 * 
	 * @param Book $book
	 * @return Author|$this
	 */
	public function addBook(Book $book) {
		if (!$this->books->contains($book)) {
		    $this->books[] = $book;
		    $book->setAuthor($this);
		}

		return $this;
	}

	/**
	 * Returns the value of email.
	 * 
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Returns the value of firstName.
	 * 
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Returns the value of id.
	 * 
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the value of lastName.
	 * 
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the value of email.
	 * 
	 * @param string $email
	 * @return Author|$this
	 */
	public function setEmail($email = null) {
		$this->email = $email;
		return $this;
	}

	/**
	 * Sets the value of firstName.
	 * 
	 * @param string $firstName
	 * @return Author|$this
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * Sets the value of id.
	 * 
	 * @param int $id
	 * @return Author|$this
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * Sets the value of lastName.
	 * 
	 * @param string $lastName
	 * @return Author|$this
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}
}