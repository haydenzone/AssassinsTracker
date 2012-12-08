<?php
session_start();
include('../../game/eject_player.php');

$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}
if( isset($_GET["confirm"]) && $_GET["confirm"] == "true")
{
	/*eject_player($_SESSION["StudentID"]);
	
	$link = mysql_connect('localhost', 'root', 'tofu#[1]')
	OR die(mysql_error());
	if(!mysql_select_db('assassins'))
	{
	echo "Error Selecting DB!";
	}
	
	$query = "DELETE FROM player WHERE StudentID ='".$_SESSION["StudentID"]."'";
	mysql_query($query);
	echo "<div style='background-color: red'> You have left the game</div>";
	$_SESSION["Player"] = 0;*/
	
	//Notify the player of the change of target TODO
	
   include("../../../mail/mail.php");
	$link = mysql_connect('localhost', 'root', 'tofu#[1]')
	OR die(mysql_error());
	if(!mysql_select_db('assassins'))
	{
	echo "Error Selecting DB!";
	}
	$query = " SELECT email FROM member WHERE Admin = 1";
	$result = mysql_query($query);
	for($i = 0; $i < mysql_num_rows($result); $i++)
	{
		$email = mysql_fetch_row($result);
		mailFromAdmin( $email[0], "Request to leave game", "Request from ".$_SESSION["Firstname"]." ".$_SESSION["Lastname"].
		"<br /><br /> Log into Assassins net at your earliest convenience to eject the player");
	}	
	echo "Problem Submitted. We will contact you shortly.";
	
}
else
{	
?>
<p>All data from the current game will be terminated</p>
<p>Are you sure?</p>
<p><a href="leave_game.php?confirm=true">Yes</a></p>
<?php }?>
<a href="../dashboard.php"> Return to Dashboard</a>
