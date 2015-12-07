<?php

use app\models\Author;
use app\models\Book;
use yii\db\Connection;

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

class Yii2MTestSuite extends AbstractTestSuite
{
    /**
     * @var Connection
     */
    protected $db = null;

    public function initialize()
    {
        require_once "vendor/autoload.php";

        define('YII_DEBUG', false);
        require_once "vendor/yiisoft/yii2/Yii.php";
        $application = new yii\console\Application([
            'id' => 'yii-benchmark',
            'basePath' => __DIR__,
//            'controllerNamespace' => 'yii\console\controllers',
        ]);

        Author::$db = Book::$db = $this->db = new Connection([
            'dsn' => 'sqlite::memory:'
        ]);
        $this->db->open();
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
        $this->db->getTransaction()->commit();
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

        //$book->author_id = $this->authors[array_rand($this->authors)]->id;
        $book->link('author', $this->authors[array_rand($this->authors)]);
        $book->save(false);

        $this->books[] = $book;
    }

    public function runComplexQuery($i)
    {
        Author::find()->from('Author a')->where(
            'a.id > :id OR (a.firstName || a.lastName) = :name',
            ['id' => $this->authors[array_rand($this->authors)]->id, 'name' => 'John Doe']
        )->count('a.id');

//        $authors = $this->em->createQuery(
//            'SELECT count(a.id) AS num FROM Author a WHERE a.id > ?1 OR CONCAT(a.firstName, a.lastName) = ?2'
//        )->setParameter(1, $this->authors[array_rand($this->authors)]->id)
//         ->setParameter(2, 'John Doe')
//         ->setMaxResults(1)
//         ->getSingleScalarResult();
    }

    public function runHydrate($i)
    {        
        $books = Book::find()->from('Book b')->where('b.price > :p', [':p' => $i])->limit(5)->all();

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
        $book = Book::find()->from('Book b')->with('author')->where('b.title = :t', [':t' => 'Hello' . $i])->one();
//        $book = $this->em->createQuery(
//            'SELECT b, a FROM Book b JOIN b.author a WHERE b.title = ?1'
//        )->setParameter(1, 'Hello' . $i)
//         ->setMaxResults(1)
//         ->getResult();
    }

    public function runPKSearch($i)
    {
        $author = $this->authors[array_rand($this->authors)];
        
        $author = Author::findOne($author->id);
//        $this->em->clear();
    }
}
