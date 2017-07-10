<?php

namespace App\Controllers;

use App\Models\Post;
use Core\View;

class Posts extends \Core\Controller
{
	public function indexAction()
	{
		$posts = Post::getAll();
		View::render('Posts/index.php', [
			'posts' => $posts
		]);
	}
	
	public function indexBonusAction()
	{
		echo "Welcome to Posts index BONUS in Posts controller here nothing more happen but hey... it's important";
	}
}
?>
