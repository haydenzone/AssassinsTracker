<?php
require ('../admin_check.php');
if( isset($_GET["id"]))
{
	$link = mysql_connect('localhost', 'root', 'tofu#[1]')
	OR die(mysql_error());
	if(!mysql_select_db('assassins'))
	{
	echo "Error Selecting DB!";
	}
	$result = mysql_query("SELECT StudentID, FirstName, LastName
	FROM member
	WHERE StudentID='".$_GET["id"]."'");
	$row = mysql_fetch_row($result);
	echo "<p>Are you sure you want to eject ".$row[1]." ".$row[2]."?</p>";

	echo '<a href="eject_player.php?id='.$_GET["id"].'">YES!!!!!!</a><br />';
	echo '<a href="eject_player.php">No</a>';
}
?>