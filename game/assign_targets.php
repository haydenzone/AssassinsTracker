<?php 

function assign_targets()
{
include_once("/mail/mail.php");
include ('lifeid_generator.php');
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}

//Assign Targets for players with null targets
//At same time assign life ids
//Initialize Last Activity to now

//Get Players with null
$query = "SELECT StudentID FROM player WHERE TargetID IS NULL";
$result = mysql_query($query);
$count = mysql_num_rows($result);
$assassin = Array();
for( $i = 0; $i < $count; $i++)
{
	$row = mysql_fetch_row($result);
	$assassin[$i] = $row[0];
}

shuffle($assassin);

//Reassign Assassins
for( $i = 0; $i < count($assassin)-1; $i++)
{
	 $query = "UPDATE player SET TargetID = '".$assassin[$i+1]."' WHERE StudentID = '".$assassin[$i]."'";
	 mysql_query($query);
}
$query = "UPDATE player SET TargetID = '".$assassin[0]."' WHERE StudentID = '".$assassin[$i]."'";
mysql_query($query);

//Give them all new lifeids and increment lives
//Initialize Last Activity to now
for( $i = 0; $i < count($assassin); $i++)
{
	$lifeID = lifeid_generator();
	 $query = "UPDATE player SET LifeID = '".$lifeID."' WHERE StudentID = '".$assassin[$i]."'";
	 mysql_query($query);
	 $query = "UPDATE player SET Lives = Lives+1 WHERE StudentID = '".$assassin[$i]."'";
	 mysql_query($query);
	 $query = "UPDATE player SET LastActivity = NOW() WHERE StudentID = '".$assassin[$i]."'";
	 mysql_query($query);
	 
	 
	 //Notify Players of Reactivation 
	 //Get email
	 $query = "SELECT email FROM member WHERE StudentID ='".$assassin[$i]."'";
	$result = mysql_query($query);
	$email = mysql_fetch_row($result);
	
	//Get Target Name
	$query = "SELECT CONCAT(target.firstname,' ', target.lastname)
	FROM player AS a
	JOIN player AS t ON a.TargetID = t.StudentID
	JOIN member AS target ON t.StudentID = target.StudentID	 WHERE a.StudentID ='".$assassin[$i]."'";
	$result = mysql_query($query);
	$target_name = mysql_fetch_row($result);
	
	//Get Users Name
	$query = "SELECT firstname
	FROM member  WHERE StudentID ='".$assassin[$i]."'";
	$result = mysql_query($query);
	$users_name = mysql_fetch_row($result);
	
	//Send email to regular email
	
	mailFromAdmin($email[0], "New Assignment (Weapon: Spoon)", $users_name[0]."<br /><br />You have been activated. Your new assignment is ".$target_name[0]
	.". For a picture, login to the <a href='http://ha.ydenw.com/assassinssystem/login/login.php'>assassins website.</a><br /><br /> You LifeID is \""
	.$lifeID."\". Keep this with you at all times. To \"kill\" your target, tap them on the back with a spoon, then retrieve their LifeID. ".
	"If you are \"killed\", give your assassin your LifeID. <br /><br /> Good Luck,<br />Master Assassin" );
	
	//Get text email
	$query = "SELECT textemail FROM member WHERE StudentID ='".$assassin[$i]."' AND StudentID NOT IN (SELECT StudentID FROM textconf)";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 1)
	{
		$textemail = mysql_fetch_row($result);
		if($textemail[0] != "")
		{
			mailFromAdmin($textemail[0], "", "$users_name[0], New target: ".
			$target_name[0]." \n New LifeID: ".$lifeID." \n---Check website for pictures");
		}
	}
	
}



return;
}
?>