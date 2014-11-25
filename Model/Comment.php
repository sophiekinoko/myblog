<?php

class Model_Comment {
	
private $db;

	public function __construct() 
	{ 
		$this->db = new Helper_Database();
	}

	public function getComments($postId)
	{
		return $this->db->query("SELECT * from COMMENTS WHERE post_id = ?", array($postId));
	}

	public function getNumberOfComments($postId)
	{
		$variable = $this->db->queryOne("SELECT COUNT(*) AS number FROM COMMENTS WHERE post_id = ?", array($postId));
		return $variable["number"];
	}

		public function getAuthorCommentName($postId)
	{
		$variable = $this->db->queryOne("SELECT name FROM USERS INNER JOIN COMMENTS ON USERS.id = COMMENTS.author_id WHERE COMMENTS.id = ?", array($postId));
		return $variable["name"];
	}

	public function sendComment($content, $author_id, $post_id)
	{
		return $this->db->execute("INSERT INTO COMMENTS (content, author_id, post_id) VALUES (?, ?, ?)", array($content, $author_id, $post_id));
	}

	
}