<?php

//ici on charge les fichier avec un appel dynamique : on transforme Helper_Config en Helper/Config.php
Spl_autoload_register("my_autoload");

function my_autoload($class) {

	//str_replace — Remplace toutes les occurrences dans une chaîne
	$class = str_replace("_","/",$class);
	$filepath = $class.".php";

	//require est identique à include mise à part le fait que lorsqu'une erreur survient, il produit également une erreur fatale de niveau E_COMPILE_ERROR. En d'autres termes, il stoppera le script alors que include n'émettra qu'une alerte de niveau E_WARNING, ce qui permet au script de continuer.
	require_once($filepath);
}

$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$post = new Model_Post();




$myPost = $post->getPost($_GET["id"]);





include "post.phtml";