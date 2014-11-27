<?php

session_start();

require('bootstrap.php');

$config = new Helper_Config("config.ini");
$user = $config->get("user", "database");
$password = $config->get("password", "database");

$posts = new Model_Post();
$comments = new Model_Comment();

//pour aller de page en page avec "Afficher les 5 prochains posts"
if(isset($_GET['page']))
{
     $page=$_GET['page'];
}
else // Sinon
{
     $page=1; 
}

$latestPosts = $posts->getLatestPosts(POSTS_BY_PAGE);
$slicePosts = $posts->getSlicePosts($page);

//récupère les commentaires du post:
$numberOfPosts = $posts->getNumberOfPosts();




//var_dump($numberOfPosts);

//var_dump($_SESSION);

include "index.phtml";