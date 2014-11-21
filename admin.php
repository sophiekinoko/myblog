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



if(isset($_GET['connexion']) && $_GET['connexion'] == true) 
{
	session_destroy(); 
	header("Location:index.php");
}



$allPosts = $posts->getAllPosts();


//récupère les commentaires du post:
$numberOfComments = $posts->getNumberOfComments(1);
$authorName = $posts->getAuthorName(1);
$numberOfPosts = $posts->getNumberOfPosts();


include "admin.phtml";