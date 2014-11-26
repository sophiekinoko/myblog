<?php

session_start();

require('bootstrap.php');


$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$posts = new Model_Post();

$chemin = "";


if($_SESSION["statut"] != "author") 
{
	header("Location:index.php");
}


if($_POST) {
	$title = $_POST["title"];
	$content = $_POST["content"];
	$author_id = $_SESSION["id"];
	//IMG
	$lastPostId = $posts->sendPost($title, $content, $author_id);
	$extensionFile = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
	$extensionOK = array("jpg", "jpeg", "gif", "png");
	if(in_array($extensionFile, $extensionOK)) {
		if (move_uploaded_file($_FILES["picture"]["tmp_name"], "pictures/".$lastPostId.".".$extensionFile))
		{
			$posts->updatePost(array('image_name'=>($lastPostId.".".$extensionFile)), $lastPostId);
		}
	}
	//TAGS
	$tags = $_POST["tags"];
	$listTags = explode(",", $tags);
	$posts->sendTags($lastPostId, $listTags);
	header("Location:post.php?id=$lastPostId");
}


include "createpost.phtml";

