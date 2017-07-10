<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>Posts</title>
</head>
<body>
        <h1>Posts list</h1>
		<ul>
		        <?php foreach ($posts as $post) {echo "<li>
					<h3>".htmlspecialchars($post['title'])."</h3>
					<p>".htmlspecialchars($post['content'])."</p></li>";}?>
		</ul>
</body>
</html>
