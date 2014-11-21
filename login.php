<?php

session_start();

require('bootstrap.php');



$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");


$login = new Model_User();


if(isset($_POST["name"]) && isset($_POST["password"])) 
{
	$user = $login->login($_POST["name"], $_POST["password"]);

	if($user) 
	{
		$_SESSION["name"] = $user["name"];
		$_SESSION["id"] = $user["id"];
		$_SESSION["statut"] = $user["statut"];
		header('Location: index.php');
	}

	else 
	{
		$error = "<li>Le nom d'utilisateur et/ou mot de passe est incorrect.</li>";
	}
}

else 
{
	$error = "";
}



include "login.phtml";