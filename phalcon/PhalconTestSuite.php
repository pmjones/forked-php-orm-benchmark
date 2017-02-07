<?php

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

class Sqlite extends \Phalcon\Db\Adapter\Pdo\Sqlite
{
    public function connect(array $descriptor = null)
    {
        $this->_pdo = new \Pdo('sqlite::memory:');
        return true;
    }
}

class PhalconTestSuite extends AbstractTestSuite
{
    protected $adapter;
    
    function initialize()
    {
        $this->adapter = new Sqlite(array());
        $this->con = $this->adapter->getInternalHandler();
        $this->initTables();
    }
    
    function clearCache()
    {
    }
    
    function beginTransaction()
    {
        $this->adapter->begin();
    }
    
    function commit()
    {
        $this->adapter->commit();
    }
    
    function runAuthorInsertion($i)
    {
        $query = "
            INSERT INTO author
                (first_name, last_name)
            VALUES
                (:firstName, :lastName)
        ";
        $stmt = $this->adapter->prepare($query);
        $stmt->execute(array(
            'firstName' => 'John' . $i,
            'lastName' => 'Doe' . $i,
        ));
        $this->authors[] = $this->adapter->lastInsertId();
    }

    function runBookInsertion($i)
    {
        $query = "
            INSERT INTO book
                (title, isbn, price, author_id)
            VALUES
                (:title, :isbn, :price, :authorId)
        ";
        $params = array(
            'title' => 'Hello' . $i,
            'isbn' => '1234',
            'price' => $i,
            'authorId' => $this->authors[array_rand($this->authors)],
        );
        $this->adapter->execute($query, $params);
        $this->books[] = $this->adapter->lastInsertId();
    }
    
    function runPKSearch($i)
    {
        $query = "
            SELECT
                author.id, author.first_name, author.last_name, author.email
            FROM author
            WHERE
                author.id = :authorId
            LIMIT 1
        ";
        $params = array(
            'authorId' => $this->authors[array_rand($this->authors)],
        );
        $author = $this->adapter->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, $params);
    }
    
    function runHydrate($i)
    {
        $query = "
            SELECT
                book.id, book.title, book.isbn, book.price, book.author_id
            FROM book
            WHERE
                book.PRICE > :price
            LIMIT 5
        ";
        $params = array(
            'price' => $i,
        );
        $rows = $this->adapter->fetchAll($query, \Phalcon\Db::FETCH_ASSOC, $params);
    }

    function runComplexQuery($i)
    {
        $query = "
            SELECT
                COUNT(*)
            FROM author
            WHERE
                author.id > :authorId
                OR CONCAT(author.first_name, author.last_name) = :name
        ";
        $params = array(
            'authorId' => $this->authors[array_rand($this->authors)],
            'name' => 'John Doe',
        );
        $this->adapter->fetchColumn($query, $params, 0);
    }
    
    function runJoinSearch($i)
    {
        $query = "
            SELECT
                book.id, book.title, book.isbn, book.price, book.author_id,
                author.id, author.first_name, author.last_name, author.email
            FROM book
            JOIN author
                ON book.author_id = author.id
            WHERE
                book.title = :title
            LIMIT 1
        ";
        $params = array(
            'title' => 'Hello' . $i,
        );
        $this->adapter->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, $params);
    }
}