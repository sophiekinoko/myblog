<?php

require('bootstrap.php');



$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");


$login = new Model_User();


if(isset($_POST)) {
	$user = $login->login($_POST["name"], $_POST["password"]);
	var_dump($_POST);

	if($user) {
		header('Location: admin.php');
	}
}



include "login.phtml";