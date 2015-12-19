<?php

require_once dirname(__FILE__) . '/Yii2MTestSuite.php';

class Yii2MArrayHydrateTestSuite extends Yii2MTestSuite
{
    public function runHydrate($i)
    {
        $books = \app\models\Book::find()->from('Book b')->where('b.price > :p', ['p' => $i])->limit(5)->asArray()->all();

//        $books = $this->em->createQuery(
//            'SELECT b FROM Book b WHERE b.price > ?1'
//        )->setParameter(1, $i)
//         ->setMaxResults(5)
//         ->getArrayResult();

        foreach ($books as $book) {

        }
//        $this->em->clear();
    }


    public function runJoinSearch($i)
    {
        $book = \app\models\Book::find()->from('Book b')->joinWith('author')->where('b.title = :t', [':t' => 'Hello' . $i])->limit(1)->asArray()->one();
//        $book = $this->em->createQuery(
//            'SELECT b, a FROM Book b JOIN b.author a WHERE b.title = ?1'
//        )->setParameter(1, 'Hello' . $i)
//         ->setMaxResults(1)
//         ->getArrayResult();
    }
	
}
