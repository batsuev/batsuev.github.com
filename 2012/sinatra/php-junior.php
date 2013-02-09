<?php  if (empty($_GET['id']) || empty($_GET['act'])) { ?>
<!doctype html>
<html lang="ru">
<head>
	<title>URL Shortener</title>
	<meta charset="UTF-8">
</head>
<body>
	<form action="/" method="post">
		<input type="hidden" name="act" value="create" />
		<input type="text" name="url" />
		<input type="submit" />
	</form>
</body>
<?php 
}else if (!empty($_GET['act']) && $_GET['act'] == 'create') { 
	$c = mysqli_connect('localhost', 'root', '');
	mysqli_query($c, 'USE shortener');
	$id = mysqli_query('INSERT INTO urls (url) VALUES ('+$_GET['url']+')');
	mysql_close($c);

	$url = $_SERVER['SERVER_NAME'].base_convert($id, 10, 36);
?>
<!doctype html>
<html lang="ru">
<head>
	<title>URL Shortener</title>
	<meta charset="UTF-8">
</head>
<body>
	Short url: <?= $url ?>
</body>
<?php
}else if (!empty($_GET['id'])) {
	$c = mysqli_connect('localhost', 'root', '');
	mysqli_query($c, 'USE shortener');
	$url = mysqli_query('SELECT url FROM urls WHERE id = '.base_convert($_GET['id'], 36, 10));
	mysql_close($c);
}else {
?>
Error!
<?php
}
?>