<?php

class Model_Post {
	
private $db;

	public function __construct() 
	{ 
		$this->db = new Helper_Database();
	}

	public function getPost($id)
	{
		return $this->db->queryOne("SELECT * from POSTS WHERE id = ?", array($id));
	}

	public function getLastPostId()
	{
		return $this->db->queryOne("SELECT id FROM POSTS ORDER BY id DESC LIMIT 1");
	}

	public function getPrevPostId($id)
	{
		return $this->db->queryOne("SELECT id FROM POSTS WHERE id < ? ORDER BY id DESC LIMIT 1", array($id));
	}

	public function getNextPostId($id)
	{
		return $this->db->queryOne("SELECT id FROM POSTS WHERE id > ? ORDER BY id ASC LIMIT 1", array($id));
	}

	public function deletePost($id)
	{
		return $this->db->execute("DELETE from POSTS WHERE id = ? LIMIT 1", array($id));
	}

	public function sendPost($title, $content, $author_id)
	{
		return $this->db->execute("INSERT INTO POSTS (title, content, author_id) VALUES (?, ?, ?)", array($title, $content, $author_id));
	}

	public function modifyPost($title, $content, $post_id, $author_id)
	{
		return $this->db->execute("UPDATE POSTS SET title=?, content=?, author_id=? WHERE id= ?", array($title, $content, $author_id, $post_id));
	}

	public function updatePost($data, $post_id)
	{
		$text = "UPDATE POSTS SET ";
		foreach ($data as $key => $value) {
			$text .= $key."=:".$key.", ";
		}
		$data['id'] = $post_id;
		return $this->db->execute(substr($text, 0, -2)." WHERE id= :id", $data);
	}

	public function getLatestPosts($number)
	{
		//LIMIT ne marche pas avec un ?
		if(!is_int($number)) {
			$number=POSTS_BY_PAGE;
		}
		return $this->db->query("SELECT * from POSTS ORDER BY date_create DESC LIMIT $number");
	}

	public function getAllPosts()
	{
		return $this->db->query("SELECT * from POSTS ORDER BY date_create DESC");
	}

	public function getSlicePosts($page)
	{
		$limit = POSTS_BY_PAGE;
		$offset = ($page-1)*$limit;
		
		return $this->db->query("SELECT * FROM POSTS ORDER BY date_create DESC LIMIT $offset, $limit");
	}

	public function getNumberOfPosts()
	{
		$variable = $this->db->queryOne("SELECT COUNT(*) AS number FROM POSTS");
		return $variable["number"];
	}

	public function getAuthorName($postId)
	{
		$variable = $this->db->queryOne("SELECT name FROM USERS INNER JOIN POSTS ON USERS.id = POSTS.author_id WHERE POSTS.id = ?", array($postId));
		return $variable["name"];
	}

	public function getTags($postId) {
		$variable = $this->db->queryOne("SELECT GROUP_CONCAT(tag_name) AS tags_list FROM TAGS WHERE post_id = ?", array($postId));
		return $variable['tags_list'];
	}

	public function sendTags($post_id, $tag_array)
	{
		foreach ($tag_array as $key => $value) {
			$tag = trim($value);
			if ($tag != "") {
			$this->db->execute("INSERT INTO TAGS (post_id, tag_name) VALUES (?, ?)", array($post_id, $tag));
			}
		}
	}

	public function removeTags($post_id)
	{
		$this->db->execute("DELETE FROM TAGS WHERE post_id = ?", array($post_id));
	}

}