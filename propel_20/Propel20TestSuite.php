<?php

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

class Propel20TestSuite extends AbstractTestSuite
{
	function initialize()
	{
		$loader = require_once "vendor/autoload.php";

		include realpath(dirname(__FILE__) . '/build/conf/config.php');

		$loader->add('', __DIR__ . '/build/classes');

		\Propel\Runtime\Propel::disableInstancePooling();
		
		$this->con = \Propel\Runtime\Propel::getConnection('bookstore');
		$this->initTables();
	}
	
	function clearCache()
	{
	}
	
	function beginTransaction()
	{
		$this->con->beginTransaction();
	}
	
	function commit()
	{
		$this->con->commit();
	}
	
	function runAuthorInsertion($i)
	{
		$author = new Author();
		$author->setFirstName('John' . $i);
		$author->setLastName('Doe' . $i);
		$author->save();
		$this->authors[]= $author;
	}

	function runBookInsertion($i)
	{
		$book = new Book();
		$book->setTitle('Hello' . $i);
		$book->setAuthor($this->authors[array_rand($this->authors)]);
		$book->setISBN('1234');
		$book->setPrice($i);
		$book->save();
		$this->books[]= $book;
	}
	
	function runPKSearch($i)
	{
		$author = AuthorQuery::create()
			->findPk($this->authors[array_rand($this->authors)]->getId());
	}
	
	function runComplexQuery($i)
	{
		$authors = AuthorQuery::create()
			->filterById($this->authors[array_rand($this->authors)]->getId(), AuthorQuery::GREATER_THAN)
			->_or()
			->Where('(Author.FirstName || Author.LastName) = ?', 'John Doe')
			->count();
	}

	function runHydrate($i)
	{
		$books = BookQuery::create()
			->filterByPrice(array('min' => $i))
			->limit(5)
			->find();
		foreach ($books as $book) {
		}
	}
	
	function runJoinSearch($i)
	{
		$books = BookQuery::create()
			->joinWithAuthor()
			->findOneByTitle('Hello' . $i);
	}
	
}