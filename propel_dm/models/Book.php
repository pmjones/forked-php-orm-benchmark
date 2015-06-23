<?php

use Base\BookActiveRecordTrait;

/**
 */
class Book {

	/**
	 * @var Author many-to-one related Author object
	 */
	protected $author = null;

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
	protected $ISBN = null;

	/**
	 * The value for the $clo field.
	 * 
	 * @var double
	 */
	protected $price = null;

	/**
	 * The value for the $clo field.
	 * 
	 * @var string
	 */
	protected $title = null;

	/**
	 */
	public function __construct() {
	}

	/**
	 * Returns the associated Author object or null if none is associated.
	 * Mapped by fields authorId
	 * 
	 * @return null|Author The associated Author object
	 */
	public function getAuthor() {
		return $this->author;
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
	 * Returns the value of ISBN.
	 * 
	 * @return string
	 */
	public function getISBN() {
		return $this->ISBN;
	}

	/**
	 * Returns the value of price.
	 * 
	 * @return double
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Returns the value of title.
	 * 
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Declares an association between this object and a Author object.
	 * Mapped by fields authorId
	 * 
	 * @param Author $author
	 * @return $this|\Book The current object (for fluent API support)
	 */
	public function setAuthor(Author $author = null) {
		$this->author = $author;

		// Setup bidirectional relationship.
		if (null !== $author) {
		    $author->addBook($this);
		}
	}

	/**
	 * Sets the value of id.
	 * 
	 * @param int $id
	 * @return Book|$this
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * Sets the value of ISBN.
	 * 
	 * @param string $ISBN
	 * @return Book|$this
	 */
	public function setISBN($ISBN) {
		$this->ISBN = $ISBN;
		return $this;
	}

	/**
	 * Sets the value of price.
	 * 
	 * @param double $price
	 * @return Book|$this
	 */
	public function setPrice($price = null) {
		$price = (double)$price;

		$this->price = $price;
		return $this;
	}

	/**
	 * Sets the value of title.
	 * 
	 * @param string $title
	 * @return Book|$this
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
}