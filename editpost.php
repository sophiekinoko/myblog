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


if(isset ($_POST["title"])) {
	$title = $_POST["title"];
	$content = $_POST["content"];
	$author_id = $_SESSION["id"];
	$post_id = $_POST["post_id"];
	$posts->updatePost(array("title"=>$title, "content"=>$content, "author_id"=>$author_id), $post_id);
	$extensionFile = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
	$extensionOK = array("jpg", "jpeg", "gif", "png");

	if(in_array($extensionFile, $extensionOK)) {
	// move_uploaded_file — Déplace un fichier téléchargé
		if (move_uploaded_file($_FILES["picture"]["tmp_name"], "pictures/".$post_id.".".$extensionFile))
		{
			$posts->updatePost(array('image_name'=>($post_id.".".$extensionFile)), $post_id);
		}
	}

	//TAGS
	if(isset ($_POST["tags"])) {
	$tags = $_POST["tags"];
	$listTags = explode(",", $tags);
	$posts->removeTags($post_id);
	$posts->sendTags($post_id, $listTags);
	}


	header("Location:post.php?id=$post_id");
	exit();
}


if(!isset($_GET["id"])) {
	header("Location:404.html");
}

//pour appeler le titre et le content du post original
$originalPost = $posts->getPost($_GET["id"]);

$tags = $posts->getTags($_GET["id"]);


//var_dump($originalPost);
$originalTitle = $originalPost["title"];
$originalContent = $originalPost["content"];

include "editpost.phtml";