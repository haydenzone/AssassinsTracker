<?php 
session_start();
if(isset($_SESSION["StudentID"]))
{
	echo $_SESSION["StudentID"];
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

<?php 
//Establish database connection
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
	      OR die(mysql_error());
	      mysql_select_db('assassins');
	     
//Grab text conf entry in database
$result = mysql_query("SELECT confcode FROM textconf WHERE StudentID = '".$_SESSION["StudentID"]."';");
if(mysql_num_rows($result) != 0)
{
	
?>
<div style="background-color: yellow"> 
<form action="../signup/cellconfirm.php" method="get">
Your cell has not been confirmed yet. Confirmation Code:
<input type="text" size="4" maxlength="4" name="confcode">
<button type="submit" value="submit">Confirm</button>
</form>
</div>
<?php 
}

//Check if there is no picture present
$result = mysql_query("SELECT imageloc FROM member WHERE StudentID = '".$_SESSION["StudentID"]."';");

$row = mysql_fetch_row($result);
if( $row[0] == "" )
{
	
?>
<div style="background-color: yellow"> 
<form enctype="multipart/form-data" method="post" action="../Signup/picupload.php">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
Choose a picture of yourself (ONLY JPEGS): <input name="uploadedfile" type="file" />
<button type="submit" value="submit">Upload</button>
</form>
</div>
<?php 
}





if ($_SESSION["Admin"] == 1)
{
	echo "<h3>Administration</h3>";
	include ('admin/index.php');
}?>

<!-- Player Dashboard -->
<?php 
if($_SESSION["Player"] == 1)
{
	echo "<h3>Player</h3>";
	include('player/index.php');
}

?>

<h3>User tools</h3>
<?php include('user/index.php')?>
<p>
<a href="logout.php">Logout</a>
</p>
</body>
</html>