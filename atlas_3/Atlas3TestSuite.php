<?php

use Atlas\Orm\Atlas;
use Author\Author;
use Book\Book;

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

class Atlas3TestSuite extends AbstractTestSuite
{
    private $atlas;

    function initialize()
    {
        require_once "vendor/autoload.php";
        $this->con = new PDO('sqlite::memory:');
        $this->atlas = Atlas::new($this->con);
        $this->initTables();
    }

    function clearCache()
    {
    }

    function beginTransaction()
    {
        $this->atlas->beginTransaction();
    }

    function commit()
    {
        $this->atlas->commit();
    }

    function runAuthorInsertion($i)
    {
        $author = $this->atlas->newRecord(Author::CLASS, [
            'first_name' => 'John' . $i,
            'last_name'  => 'Doe' . $i,
        ]);
        $this->authors[] = $this->con->lastInsertId();
    }

    function runBookInsertion($i)
    {
        $book = $this->atlas->newRecord(Book::CLASS, [
            'title'     => 'Hello' . $i,
            'isbn'      => '1234' . $i,
            'price'     => $i,
            'author_id' => $this->authors[array_rand($this->authors)],
        ]);
        $this->atlas->insert($book);
        $this->books[] = $this->con->lastInsertId();

    }

    function runPKSearch($i)
    {
        $author = $this->atlas->fetchRecord(Author::CLASS, $i);
    }

    function runHydrate($i)
    {
        $authors = $this->atlas
            ->select(Book::CLASS)
            ->where('price > ', $i)
            ->limit(5)
            ->fetchRecordSet();
    }

    function runComplexQuery($i)
    {
        $count = $this->atlas
            ->select(Author::CLASS)
            ->where('id > ', $this->authors[array_rand($this->authors)])
            ->orWhere('(first_name || last_name) = ', 'John Doe')
            ->fetchCount();
    }

    function runJoinSearch($i)
    {
        $book = $this->atlas
            ->select(Book::CLASS)
            ->where('title = ', 'Hello' . $i)
            ->with(['author'])
            ->fetchRecord();
    }
}
