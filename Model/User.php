<?php

class Model_User {
	
private $db;

	public function __construct() 
	{ 
		$this->db = new Helper_Database();
	}

	public function login($name, $password)
	{
		return $this->db->queryOne("SELECT * from USERS WHERE name = ? AND password= ?", array($name, $password));
	}



	// public function getLatestPosts($number)
	// {
	// 	//LIMIT ne marche pas avec un ?
	// 	if(!is_int($number)) {
	// 		$number=POSTS_BY_PAGE;
	// 	}
	// 	return $this->db->query("SELECT * from POSTS ORDER BY date_create DESC LIMIT $number");
	// }

	// public function getComments($postId)
	// {
	// 	return $this->db->query("SELECT * from COMMENTS WHERE post_id = ?", array($postId));
	// }

	// public function getNumberOfComments($postId)
	// {
	// 	$variable = $this->db->queryOne("SELECT COUNT(*) AS number FROM COMMENTS WHERE post_id = ?", array($postId));
	// 	return $variable["number"];
	// }

	// public function getSlicePosts($page)
	// {
	// 	$limit = POSTS_BY_PAGE;
	// 	$offset = ($page-1)*$limit;
		
	// 	return $this->db->query("SELECT * FROM POSTS ORDER BY date_create DESC LIMIT $offset, $limit");
	// }

	// public function getNumberOfPosts()
	// {
	// 	$variable = $this->db->queryOne("SELECT COUNT(*) AS number FROM POSTS");
	// 	return $variable["number"];
	// }

	// public function getAuthorName($postId)
	// {
	// 	$variable = $this->db->queryOne("SELECT name FROM USERS INNER JOIN POSTS ON USERS.id = POSTS.author_id WHERE POSTS.id = ?", array($postId));
	// 	return $variable["name"];
	// }

	// public function getAuthorCommentName($postId)
	// {
	// 	$variable = $this->db->queryOne("SELECT name FROM USERS INNER JOIN COMMENTS ON USERS.id = COMMENTS.author_id WHERE COMMENTS.id = ?", array($postId));
	// 	return $variable["name"];
	// }
}