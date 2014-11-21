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


if($_POST) {
	$title = $_POST["title"];
	$content = $_POST["content"];
	$author_id = $_SESSION["id"];
	$posts->sendPost($title, $content, $author_id);
	$lastPostId = $posts->getLastPostId();
	header("Location:post.php?id=$lastPostId[id]");
}


include "createpost.phtml";
