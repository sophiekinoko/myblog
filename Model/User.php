<?php

class Model_User {
	
private $db;

	public function __construct() 
	{ 
		$this->db = new Helper_Database();
	}

	public function login($name, $password)
	{
		return $this->db->queryOne("SELECT * from USERS WHERE name = ? AND password= ?", array($name, $password));
	}

	public function sendUser($name, $statut, $password)
	{
		return $this->db->execute("INSERT INTO USERS (name, statut, password) VALUES (?, ?, ?)", array($name, $statut, $password));
	}

}