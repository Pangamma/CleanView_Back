<?php
	session_start();
	$_SESSION['loggedin'] = false;				
	$_SESSION['email'] = null;
	$_SESSION['userJson'] = null;
	//so they do not have to keep logging into our site.
	setcookie("email",null);
	setcookie("pass",null);
?>
<html>
	<head>
		<meta http-equiv="refresh" content="1; url=index.php">
	</head>
	<body>
		returning to the main page.
	</body>
</html>
