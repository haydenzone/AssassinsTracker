<?php 
session_start();

include("../../../mail/mail.php");
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}

$LifeID = $_GET["LifeID"];

$query="SELECT target.LifeID
FROM member a
NATURAL JOIN player
LEFT OUTER JOIN player AS target ON player.TargetID = target.StudentID WHERE a.StudentID = '".$_SESSION["StudentID"]."'";

$result = mysql_query($query);
$row = mysql_fetch_row($result);
if(strtoupper($LifeID) == strtoupper($row[0]) )
{
	include('../../game/eject_player.php');
	
	//Store Target's UserID
	$query = "SELECT TargetID FROM player WHERE StudentID ='".$_SESSION["StudentID"]."'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$TargetID = $row[0];
	
	//Alert Target of death
	$query = "SELECT email FROM member WHERE StudentID ='".$TargetID."'";
	$result = mysql_query($query);
	$email = mysql_fetch_row($result);
	mailFromAdmin($email[0], "Mission Failure", "You have been marked as deceased by your assassin." 
	." If you believe you received this message in error, login to the assassins system and click \"Report a Problem\" immediately.");

	eject_player($TargetID);
	
	//Set last active time to now
	$query = "UPDATE player SET LastActivity=NOW() WHERE StudentID ='".$_SESSION["StudentID"]."'";
	mysql_query($query);
	
	
	
	
	//Increment Kills
	$query = "UPDATE player SET Kills = Kills+1 
	WHERE StudentID = '".$_SESSION["StudentID"]."'";
	mysql_query($query);
	
	//Check for 10 Inactives to restart
	$query = "SELECT * FROM player WHERE TargetID IS NULL";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	if( $count > 9 )
	{
		include ('../../game/assign_targets.php');
		assign_targets();
	}

	echo 'Congratulations. <a href="mission.php">Click here</a> to see your next target';
}
else 
	echo 'Incorrect LifeID. <a href="mission.php">Go back.</a>';

?>
<a href="../dashboard.php"> Return to Dashboard</a>