<?php

session_start();

require('bootstrap.php');


$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$posts = new Model_Post();
$comments = new Model_Comment();


if(! isset($_SESSION["statut"]))
{
	header("Location:index.php");
}

if($_POST) {
	$content = $_POST["content"];
	$author_id = $_SESSION["id"];
	$post_id = $_GET["id"];
	$comments->sendComment($content, $author_id, $post_id);
	header("Location:post.php?id=$post_id");
}


include "createcomment.phtml";
