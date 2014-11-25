<?php

session_start();

require('bootstrap.php');


if($_SESSION["statut"] != "author") 
{
	header("Location:index.php");
}


$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$posts = new Model_Post();
$comments = new Model_Comment();



if(isset($_GET['connexion']) && $_GET['connexion'] == true) 
{
	
	$_SESSION = array();
	session_destroy(); 
	header("Location:index.php");
}


$allPosts = $posts->getAllPosts();


$numberOfPosts = $posts->getNumberOfPosts();

include "admin.phtml";