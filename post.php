<?php

require('bootstrap.php');

$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$post = new Model_Post();




$myPost = $post->getPost($_GET["id"]);

//récupère les commentaire avec l'id du post:
$allComments = $post->getComments($_GET["id"]);








include "post.phtml";