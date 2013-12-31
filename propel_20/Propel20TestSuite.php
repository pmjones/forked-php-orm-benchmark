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
		$author->save($this->con);
		$this->authors[]= $author->getId();
	}

	function runBookInsertion($i)
	{
		$book = new Book();
		$book->setTitle('Hello' . $i);
		$book->setAuthorId($this->authors[array_rand($this->authors)]);
		$book->setISBN('1234');
		$book->setPrice($i);
		$book->save($this->con);
		$this->books[]= $book->getId();
	}
	
	function runPKSearch($i)
	{
        $author = AuthorQuery::create()
            ->findPk($this->authors[array_rand($this->authors)], $this->con);
	}
	
	function runComplexQuery($i)
	{
		$authors = AuthorQuery::create()
			->where('Author.Id > ?', $this->authors[array_rand($this->authors)])
			->_or()
            ->Where('(Author.FirstName || Author.LastName) = ?', 'John Doe')
			->count($this->con);
	}

	function runHydrate($i)
	{
		$books = BookQuery::create()
			->filterByPrice(array('min' => $i))
			->limit(5)
			->find($this->con);
		foreach ($books as $book) {
		}
	}
	
	function runJoinSearch($i)
	{
		$books = BookQuery::create()
			->filterByTitle('Hello' . $i)
			->leftJoinWith('Book.Author')
			->findOne($this->con);
	}
	
}