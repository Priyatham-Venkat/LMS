<?php
if (isset($_POST['submit'])) {
	$var = md5($_POST['submit']);
	echo "MD5 is " .$var ;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>To MD5</title>
</head>
<body>
	<form method="POST">
		<input type="text" name="tomd5">
		<input type="submit" name="submit">
	</form>
</body>
</html>