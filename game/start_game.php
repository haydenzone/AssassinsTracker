<?php
require ('../login/admin_check.php'); 
include ('assign_targets.php');

$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}

//Initialize Lives to 0

$query = "UPDATE player SET Lives = 0 WHERE Lives IS NULL";
mysql_query($query);
	 
//Init Kills to 0

$query = "UPDATE player SET Kills = 0 WHERE Kills IS NULL";
mysql_query($query);

//Set up targets for players
//Set lifeids
//Initialize Last Activity to now
if(mysql_affected_rows() == mysql_num_rows(mysql_query("SELECT * FROM player")))
{
	assign_targets();
	echo "Game is now activated.";
}
else
	echo "Game already in progress.";
?>
<a href="../login/dashboard.php"> Return to Dashboard</a>