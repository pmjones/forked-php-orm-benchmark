<?php

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

class YiiMTestSuite extends AbstractTestSuite
{
    /**
     * @var CDbConnection
     */
    protected $db = null;

    public function initialize()
    {
//        require_once "vendor/autoload.php";

        define('YII_DEBUG', false);
        require_once "vendor/yiisoft/yii/framework/yii.php";
        $app = Yii::createConsoleApplication(array(
            'basePath'=>dirname(__FILE__),
            'import' => array(
                'application.models.*'
            ),
        ));

        Author::$db = Book::$db = $this->db = new CDbConnection('sqlite::memory:');
        $this->db->active = true;
        Author::createTable();
        Book::createTable();
    }

    public function beginTransaction() {
        $this->db->beginTransaction();
    }

    private $clears = 0;

    public function clearCache() {
        if ($this->clears > 1) {
//            $this->db->clear(); // clear the first level cache (identity map), as in other examples
                                // so that objects are not re-used
        }
        $this->clears++;
    }
    public function commit() {
//        $this->db->flush();
        $this->db->getCurrentTransaction()->commit();
    }

    function runAuthorInsertion($i) {
        $author = new Author();
        $author->firstName = 'John' . $i;
        $author->lastName = 'Doe' . $i;

        $author->save(false);
        
        $this->authors[] = $author;
    }

    function runBookInsertion($i) {
        $book = new Book();
        $book->title = 'Hello' . $i;
        $book->isbn = '1234';
        $book->price = $i;
        $book->author = $this->authors[array_rand($this->authors)];

        $book->save(false);

        $this->books[] = $book;
    }

    public function runComplexQuery($i)
    {
        Author::model()->count(array(
            'select' => 'a.id',
            'alias' => 'a',
            'condition' => 'a.id > :id OR (a.firstName || a.lastName) = :name',
            'params' => ['id' => $this->authors[array_rand($this->authors)]->id, 'name' => 'John Doe']
        ));

//        $authors = $this->em->createQuery(
//            'SELECT count(a.id) AS num FROM Author a WHERE a.id > ?1 OR CONCAT(a.firstName, a.lastName) = ?2'
//        )->setParameter(1, $this->authors[array_rand($this->authors)]->id)
//         ->setParameter(2, 'John Doe')
//         ->setMaxResults(1)
//         ->getSingleScalarResult();
    }

    public function runHydrate($i)
    {        
        $books = Book::model()->findAll(array(
            'alias' => 'b',
            'condition' => 'b.price > :p',
            'params' => [':p' => $i],
            'limit' => 5
        ));

//        $books = $this->em->createQuery(
//            'SELECT b FROM Book b WHERE b.price > ?1'
//        )->setParameter(1, $i)
//         ->setMaxResults(5)
//         ->getResult();

        foreach ($books as $book) {
            
        }
//        $this->em->clear();
    }

    public function runJoinSearch($i)
    {
        $book = Book::model()->find(array(
            'alias' => 'b',
            'condition' => 'b.title = :t',
            'params' => [':t' => 'Hello' . $i],
            'with' => ['author']
        ));
//        $book = $this->em->createQuery(
//            'SELECT b, a FROM Book b JOIN b.author a WHERE b.title = ?1'
//        )->setParameter(1, 'Hello' . $i)
//         ->setMaxResults(1)
//         ->getResult();
    }

    public function runPKSearch($i)
    {
        $author = $this->authors[array_rand($this->authors)];
        
        $author = Author::model()->findByPk($author->id);
//        $this->em->clear();
    }
}