<?php 
session_start();
if(isset($_SESSION["StudentID"]))
{
	session_destroy();
}
else 
{
	header("Location: login.php");
}
?>
<html>
<head>
</head>
<body>
<p><?php echo "Logging out ".$_SESSION["StudentID"]; ?></p>
<a href="login.php">Login</a>
</body>
</html>