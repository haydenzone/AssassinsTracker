<?php 
function eject_player($StudentID)
{
	//Set New Target (Target's Target)
	$query = "SELECT StudentID FROM player WHERE TargetID = '".$StudentID."'";
	
	$result = mysql_query($query);
	
	
	//Stop if there is no one with StudentID as targetID
	//Prevent continuing
	if(!$result)
	{
	   echo "SHIT!";
		return;
	}
	
	
	$row = mysql_fetch_row($result);
	
	$PreviousID = $row[0];
	
	$query = "SELECT TargetID FROM player WHERE StudentID = '".$StudentID."'";
	
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	
	$query = "UPDATE player SET TargetID = '".$row[0]."' WHERE StudentID = '".$PreviousID."'";
	if(!mysql_query($query))
	{
		echo "New Target Not Set";
	}
	
	//Set target's targetID to null

	$query = "UPDATE player SET TargetID = NULL, LifeID = NULL WHERE StudentID = '".$StudentID."'";
	if(!mysql_query($query))
	{
		echo "Target's Target not set to null";
	}
	
	return $PreviousID;
}
?>