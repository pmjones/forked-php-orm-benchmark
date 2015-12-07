<?php

require_once dirname(__FILE__) . '/../AbstractTestSuite.php';

/**
 * This test suite just demonstrates the baseline performance without any kind of ORM
 * or even any other kind of slightest abstraction.
 */
class LessQLTestSuite extends AbstractTestSuite
{
	private $db;

	function initialize()
	{
		require_once 'vendor/autoload.php';

		$this->con = new PDO('sqlite::memory:');
		$this->db = new LessQL\Database($this->con);
		$this->initTables();
	}
	
	function clearCache()
	{
	}
	
	function beginTransaction()
	{
		$this->db->begin();
	}
	
	function commit()
	{
		$this->db->commit();
	}
	
	function runAuthorInsertion($i)
	{
		$this->db->table('author')->insert([
			'first_name' => 'John' . $i,
			'last_name'  => 'Doe' . $i,
		]);
		$this->authors[]= $this->con->lastInsertId();
	}

	function runBookInsertion($i)
	{
		$this->db->table('book')->insert([
				'title' => 'Hello' . $i,
				'isbn'  => '1234' . $i,
				'price' => $i,
				'author_id' => $this->authors[array_rand($this->authors)],
		]);
		$this->books[]= $this->con->lastInsertId();

	}
	
	function runPKSearch($i)
	{
		$stmt = $this->db
				->table('author')
				->select('id', 'first_name', 'email')
				->where('id', $this->authors[array_rand($this->authors)])
				->limit(1);
		$author = $stmt->fetch();
	}
	
	function runHydrate($i)
	{
		$stmt = $this->db
				->table('book')
				->select('id', 'title', 'isbn', 'price', 'author_id')
				->where('price > ?', $i)
				->limit(5);

		while ($row = $stmt->fetch()) {
		}
	}

	function runComplexQuery($i)
	{
		$stmt = $this->db
				->table('author')
				->where('id > ? OR first_name || last_name = ? ', $this->authors[array_rand($this->authors)], 'John Doe')
				->count();

	}
	
	function runJoinSearch($i)
	{
		$book = $this->db
				->table('book')
				->select('id', 'title', 'isbn', 'price', 'author_id')
				->where('title', 'Hello' . $i)
				->limit(1)
				->fetch();

		$author = $book->author()->select('id', 'first_name', 'last_name', 'email')->fetch();
	}
}