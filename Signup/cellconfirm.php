<?php 
session_start();

$StudentID = $_SESSION["StudentID"];

//Get the confirmation code
$confcode =  $_GET['confcode'];

//Establish database connection
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
	      OR die(mysql_error());
	      mysql_select_db('assassins');
	     
//Grab text conf entry in database
$result = mysql_query("SELECT confcode FROM textconf WHERE StudentID = '".$StudentID."';");
$row = mysql_fetch_row($result);

//Verify the correct code
if($row[0] == $confcode)
{
	mysql_query("DELETE FROM textconf WHERE StudentID = '".$StudentID."'");
	echo "<p>Your number is confirmed</p>";
}
else {
	echo "<p>Incorrect Confirmation Code</p>";
}

?>
<a href="/Assassinssystem/login/dashboard.php"> Return to Dashboard</a>
