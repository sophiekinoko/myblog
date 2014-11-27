<?php

class Helper_Database {
	
	private $db;

	public function __construct() 
	{ 
		$config = new Helper_Config("config.ini");
		$user = $config->get("user", "database");
		$password = $config->get("password", "database");
		$name = $config->get("name", "database");
		$this->db = new PDO("mysql:host=localhost;dbname=$name",$user,$password);
		$this->db->exec("SET NAMES UTF8");
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function query($queryString, $data=array()) {
		$query = $this->db->prepare($queryString);
		$query->execute($data);
		$pattern = $query->fetchAll(PDO::FETCH_ASSOC);
		return $pattern;
	}

	public function queryOne($queryString, $data=array()) {
		$query = $this->db->prepare($queryString);
		$query->execute($data);
		$pattern = $query->fetch(PDO::FETCH_ASSOC);
		return $pattern;
	}

	public function execute($queryString, $data=array()) {
		$query = $this->db->prepare($queryString);
		$query->execute($data);
		$lastId = $this->db->lastInsertId(); 
		return $lastId;
	}
}