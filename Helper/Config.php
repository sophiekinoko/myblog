<?php

class Helper_Config {
	
	private $config;

	//on importe le fichier config.ini
	public function __construct($filename) 
	{
		$this->loadFile($filename);
	}

	// on permet de sortir des valeurs du tableau crée avec le ficheir config.ini
	public function get($value, $category=false) 
	{
		if($category == false && isset($this->config[$value])) {
			$value=$this->config[$value];
			return $value;
		}

		// var_dump($this->config);
		//si les valeurs demandées existent dans le config.ini, on les renvoie, sinon : non
		if (isset($this->config[$category]) && isset($this->config[$category][$value])) {
			$value=$this->config[$category][$value];
			return $value;
		}

		else {
			return null;
		}
		
	}

	public function loadFile($filename) {
		$this->config=parse_ini_file($filename, true);
	}

}
