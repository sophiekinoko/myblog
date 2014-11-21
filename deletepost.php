<?php

session_start();

require('bootstrap.php');



$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$posts = new Model_Post();


if($_SESSION["statut"] != "author") 
{
	header("Location:index.php");
}


$post = $posts->getPost($_GET['id']);
$postTitle = $post["title"];

if(isset($_GET['confirm']) && $_GET['confirm'] == true) 
{
	$posts->deletePost($_GET['id']);
	header("Location:admin.php");
}


include "deletepost.phtml";