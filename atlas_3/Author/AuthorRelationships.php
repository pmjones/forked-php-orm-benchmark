<?php
declare(strict_types=1);

namespace Author;

use Atlas\Mapper\MapperRelationships;
use Book\Book;

class AuthorRelationships extends MapperRelationships
{
    protected function define()
    {
        $this->oneToMany('books', Book::CLASS);
    }
}
