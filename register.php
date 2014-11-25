<?php
//la variable $_SESSION existe toujours, mais elle est vide par défaut. pour dire de remplir le tableau SESSION, on met :
session_start();

require('bootstrap.php');



$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");


$login = new Model_User();


if(isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["password2"])) 
{
	if(($_POST["password"]) == ($_POST["password2"])) 
	{
		$statut = "visitor";
		$login->sendUser($_POST["name"], $statut, $_POST["password"]);
		header('Location: login.php');
	}
	else
	{
	$message = "<li>Les mots de passe ne sont pas cohérents. Veuillez réessayer.</li>";
	}
}

else
{
	$message = "<li><span class='rouge'>* </span> Merci de remplir tous les champs.</li>";
}


include "register.phtml";