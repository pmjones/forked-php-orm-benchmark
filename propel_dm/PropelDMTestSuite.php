<?php

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

class PropelDMTestSuite extends AbstractTestSuite
{
    /*
     * @var $session Propel\Runtime\Session\Session
     */
    protected $session = null;

    /*
     * @var $configuration \Propel\Runtime\Configuration
     */
    protected $configuration = null;

    protected $i = 0;
	function initialize()
	{
        $loader = require_once "vendor/autoload.php";
        /* @var $configuration \Propel\Runtime\Configuration */
        $this->configuration = include realpath(dirname(__FILE__) . '/generated-conf/config.php');

        $loader->add('', __DIR__ . '/models');

        $this->session = $this->configuration->createSession();

        $this->con = $this->configuration->getConnectionManager('bookstore')->getReadConnection();
        $this->initTables();
	}
	
	function clearCache()
	{
        $this->session->reset();
	}
	
	function beginTransaction()
	{
        $this->con->beginTransaction();
        $this->i = 0;
	}
	
	function commit()
	{
        $this->session->commit();
        $this->con->commit();
        $this->i = 0;
	}
	
	function runAuthorInsertion($i)
	{
        $author = new Author();
		$author->setFirstName('John' . $i);
		$author->setLastName('Doe' . $i);

        $this->session->persist($author);

		$this->authors[]= $author;

        $this->i++;
        if($this->i >= 500)
        {
            $this->commit();
            $this->beginTransaction();
        }
	}

	function runBookInsertion($i)
	{
        $rand = array_rand($this->authors);
		$book = new Book();
		$book->setTitle('Hello' . $i);
        $book->setAuthor($this->authors[$rand]);
		$book->setISBN('1234');
		$book->setPrice($i);

        $this->session->persist($book);
        $this->session->persist($this->authors[$rand]);

		$this->books[]= $book;

        $this->i++;
        if($this->i >= 500)
        {
            $this->commit();
            $this->beginTransaction();
        }
	}
	
	function runPKSearch($i)
	{
        $author = AuthorQuery::create()->findPk($this->authors[array_rand($this->authors)]->getId());
	}
	
	function runComplexQuery($i)
	{
        $authors = AuthorQuery::create()
            ->filterById($this->authors[array_rand($this->authors)]->getId())
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
			->filterByTitle('Hello' . $i)
			->leftJoinWith('author')
			->findOne();
	}
	
}