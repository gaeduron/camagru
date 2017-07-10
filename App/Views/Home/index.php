<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>HOME</title>
</head>
<body>
	<h1>Home page</h1>
	<p>Welcome <?php echo htmlspecialchars($name) ?> to the index page of home controller</p>
	<ul>
	        <?php foreach ($colors as $color) {echo "<li>".htmlspecialchars($color)."</li>";}?>
	</ul>
</body>
</html>
