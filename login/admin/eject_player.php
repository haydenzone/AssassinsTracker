<?php
require ('../admin_check.php');
include('../../game/eject_player.php');
include_once("/mail/mail.php");

$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}
if( isset($_GET["id"]))
{
   //Database connection
   
   $link = mysql_connect('localhost', 'root', 'tofu#[1]')
	OR die(mysql_error());
	if(!mysql_select_db('assassins'))
	{
	echo "Error Selecting DB!";
	}
	
	
	
	$query = "SELECT Email, TextEmail FROM member NATURAL JOIN player WHERE TargetID='".$_GET["id"]."'";
	
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$PreviousEmail = $row[0];
	eject_player($_GET["id"]);
	
	//Notify player of new target
	
	mailFromAdmin($PreviousEmail, "New Assignment (Weapon: Spoon)","You're target has recently been
	ejected from the game. Log onto the Assassins system to get your new target. We apologize for the inconvenience.
	 <br /><br /> Cheers,<br />Master Assassin" );
	
	
	$query = "DELETE FROM player WHERE StudentID ='".$_GET["id"]."'";
	mysql_query($query);
	echo "<div style='background-color: red'>".$_GET["id"]." is ejected</div>";
}
	
	$result = mysql_query("SELECT StudentID, Firstname, Lastname, TIMEDIFF( NOW( ) , lastactivity ) AS inactivetime
	FROM member NATURAL JOIN player ORDER BY inactivetime DESC
	");
	
	$count = mysql_num_rows ($result);
	
	echo "<h3>Current Players</h3>";
	
	if($count == 0)
	{
		echo "No players";
	}
	echo "<table>";
	echo "<tr><td>Name</td><td>Inactive Time</td><td></td></tr>";
	for( $i=0; $i < $count; $i++)
	{
		echo "<tr>";
		$row = mysql_fetch_row($result);
		echo "<td>";
		echo $row[1]." ".$row[2];
		echo "</td><td>";
		echo $row[3];
		echo"</td><td>";
		echo '<a href="confirm.php?id='.$row[0].'">Eject Player</a>';
		echo "</td></tr>";
	}
	echo "</table>";
?>
<a href="../dashboard.php"> Return to Dashboard</a>
