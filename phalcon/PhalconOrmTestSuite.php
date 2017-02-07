<?php

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';
require_once dirname(__FILE__) . '/models/Author.php';
require_once dirname(__FILE__) . '/models/Book.php';

class Sqlite extends \Phalcon\Db\Adapter\Pdo\Sqlite
{
    public function connect(array $descriptor = null)
    {
        $this->_pdo = new \Pdo('sqlite::memory:');
        return true;
    }
}

class PhalconOrmTestSuite extends AbstractTestSuite
{
    protected $di;
    protected $adapter;
    
    function initialize()
    {
        $this->di = new \Phalcon\Di\FactoryDefault();
        $this->di->setShared('modelsMetadata', function() {
            return new \Phalcon\Mvc\Model\MetaData\Memory();
        });
        $this->adapter = new Sqlite(array());
        $this->di->setShared('db', $this->adapter);
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
        $author = new Author();
        $author->first_name = 'John' . $i;
        $author->last_name = 'Doe' . $i;
        $author->save();
        $this->authors[] = $author->id;
    }

    function runBookInsertion($i)
    {
        $book = new Book();
        $book->title = 'Hello' . $i;
        $book->isbn = '1234';
        $book->price = $i;
        $book->authorId = $this->authors[array_rand($this->authors)];
        $book->save();
        $this->books[] = $book->id;
    }
    
    function runPKSearch($i)
    {
        $authorId = $this->authors[array_rand($this->authors)];
        $author = Author::find($authorId);
    }
    
    function runHydrate($i)
    {
        $books = Book::query()
            ->where('price > :price:')
            ->bind(array('price' => $i))
            ->limit(5)
            ->execute();

        foreach ($books as $book) {
        }
    }

    function runComplexQuery($i)
    {
        Author::count(array(
            'id > ?0 OR first_name = ?1',
            //'id > ?0 OR CONCAT(first_name, last_name) = ?1', # Why am I not allowed to do CONCAT?
            'bind' => array(
                $this->authors[array_rand($this->authors)],
                'John Doe',
            ),
        ));
    }
    
    function runJoinSearch($i)
    {
        $a = Book::class;
        $b = Author::class;
        $query = "
            SELECT
                $a.*,
                $b.*
            FROM $a
            LEFT JOIN $b
                ON $a.AUTHOR_ID = $b.ID
            WHERE
                $a.TITLE = :title:
                OR 1
            LIMIT 1
        ";
        $params = array(
            'title' => 'Hello' . $i,
        );
        $manager = $this->di->get('modelsManager');
        $result = $manager->executeQuery($query, $params);
    }
}