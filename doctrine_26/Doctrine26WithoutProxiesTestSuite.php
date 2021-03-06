<?php

require_once dirname(__FILE__) . '/Doctrine26WithCacheTestSuite.php';

class Doctrine26WithoutProxiesTestSuite extends Doctrine26WithCacheTestSuite
{
    public function runHydrate($i)
    {
        $books = $this->em->createQuery(
            'SELECT b FROM Book b WHERE b.price > ?1'
        )->setParameter(1, $i)
         ->setMaxResults(5)
         ->setHint(\Doctrine\ORM\Query::HINT_FORCE_PARTIAL_LOAD, true)
         ->getResult();

        foreach ($books as $book) {

        }
        $this->em->clear();
    }

    public function runJoinSearch($i)
    {
        $book = $this->em->createQuery(
            'SELECT b, a FROM Book b JOIN b.author a WHERE b.title = ?1'
        )->setParameter(1, 'Hello' . $i)
         ->setMaxResults(5)
         ->setHint(\Doctrine\ORM\Query::HINT_FORCE_PARTIAL_LOAD, true)
         ->getResult();
    }

}