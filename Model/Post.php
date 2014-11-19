<?php

class Model_Post {
	
private $db;

	public function __construct() 
	{ 
		$this->db = new Helper_Database();
	}

	public function getPost($id)
	{
		return $this->db->queryOne("SELECT * from POSTS WHERE id = ?", array($id));
	}

	public function getLatestPosts($number)
	{
		//LIMIT ne marche pas avec un ?
		if(!is_int($number)) {
			$number=5;
		}
		return $this->db->query("SELECT * from POSTS ORDER BY date_create DESC LIMIT $number");
	}

}

 