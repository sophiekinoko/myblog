<?php

session_start();

require('bootstrap.php');

$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$post = new Model_Post();
$comments = new Model_Comment();



$myPost = $post->getPost($_GET["id"]);

//récupère les commentaire avec l'id du post:
$allComments = $comments->getComments($_GET["id"]);

//pour n'afficher que la date et non l'heure de création du post
// $date = substr($myPost["date_create"],0,10);
$date = date("d/m/Y",strtotime($myPost["date_create"]));



$nextpostid = $post->getNextPostId($_GET["id"]);

$prevpostid = $post->getPrevPostId($_GET["id"]);

if(!$myPost) {
	header("Location:404.html");
}


include "post.phtml";