<?php
namespace App\Models;

use PDO;

class Post
{
	public function getDb()
	{
		$host = "localhost";
		$db_name = "mvc";
		$user = "root";
		$password = "root";
		return (new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $user, $password));
	}
	
	public function getAll()
	{
		try 
		{
			$db = Post::getDb();
			$stmt = $db->query("SELECT id, title, content FROM posts ORDER BY created_at");
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $results;
		}
		catch (PDOexception $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
