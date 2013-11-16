<?php
	session_start();
	$_SESSION['loggedin'] = false;				
	$_SESSION['username'] = null;
	$_SESSION['userJson'] = null;
	//so they do not have to keep logging into our site.
	setcookie("user",null);
	setcookie("pass",null);
?>
<html>
	<head>
		<meta http-equiv="refresh" content="1; url=index.php">
	</head>
	<body>
		For some reason this page does not work.
	</body>
</html>
