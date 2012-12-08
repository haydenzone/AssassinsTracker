<?php 
require ('../admin_check.php');
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}

//Check to make sure the game hasn't started
$query = "SELECT * FROM player WHERE TargetID IS NOT NULL";
$result = mysql_query($query);
if (mysql_num_rows($result) != 0)
{
	echo "<div style='background-color: yellow'>Game has already begun</div>";
	if( isset($_GET["id"]))
	{
		//Check to make sure player exists
		$query = "SELECT FirstName, LastName FROM member WHERE StudentID = '".$_GET["id"]."';";
		$result = mysql_query($query);
		if(mysql_num_rows($result) != 0)
		{
			$row = mysql_fetch_row($result);
			$name = $row[0]." ".$row[1];
			$query = "INSERT INTO player (StudentID, AdminConf, Lives, Kills) VALUES ('";
			$query = $query.$_GET["id"]."','".$_SESSION["StudentID"]."', 0, 0);";
			if(mysql_query($query))
			{
				$insert_success = true;
			}
			else
				$insert_success = false;
		}
		else
			$insert_success = false;
		
		//Check to see if a new ring needs to be created
		$query = "SELECT * FROM player WHERE TargetID IS NULL";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);
		if( $count > 10 )
		{
			include ('../../game/assign_targets.php');
			assign_targets();
		}
	}
}
else if( isset($_GET["id"]))
{
	//Check to make sure player exists
	$query = "SELECT FirstName, LastName FROM member WHERE StudentID = '".$_GET["id"]."';";
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0)
	{
		$row = mysql_fetch_row($result);
		$name = $row[0]." ".$row[1];
		$query = "INSERT INTO player (StudentID, AdminConf) VALUES ('";
		$query = $query.$_GET["id"]."','".$_SESSION["StudentID"]."');";
		if(mysql_query($query))
		{
			$insert_success = true;
		}
		else
			$insert_success = false;
	}
	else
		$insert_success = false;
}
?>
<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<?php

if($insert_success)
{
	echo '<div style="background-color: yellow;">'.$name.' confirmed </div>';
}
$result = mysql_query("SELECT StudentID, FirstName, LastName, imageloc
FROM member
WHERE StudentID NOT 
IN (
SELECT StudentID
FROM player
) AND Admin = 0");

$count = mysql_num_rows ($result);

echo "<h3>Unconfirmed Players</h3>";

if($count == 0)
{
	echo "No unconfirmed members";
}
echo "<table>";
for( $i=0; $i < $count; $i++)
{
	echo "<tr>";
	$row = mysql_fetch_row($result);
	echo "<td> <img src='".$row[3]."' style='height: 40px;'></td>";
	echo "<td>";
	echo $row[1]." ".$row[2];
	echo "</td><td>";
	echo '<a href="?id='.$row[0].'">Activate Player</a>';
	echo "</td></tr>";
}
echo "</table>";
mysql_free_result($result);


//Print Admins

$admin_result = mysql_query("SELECT StudentID, FirstName, LastName
FROM member
WHERE StudentID NOT 
IN (
SELECT StudentID
FROM player
) AND Admin = 1");

$admin_count = mysql_num_rows ($admin_result);


echo "<h3>Admins</h3>";

if($admin_count == 0)
{
	echo "No unconfirmed admins";
}
echo "<table>";

for( $i=0; $i < $admin_count; $i++)
{
	echo "<tr>";
	$row = mysql_fetch_row($admin_result);
	echo "<td>";
	echo $row[1]." ".$row[2];
	echo "</td><td>";
	echo '<a href="?id='.$row[0].'">Activate Player</a>';
	echo "</td></tr>";
}
echo "</table>";
?>
<a href="../dashboard.php"> Return to Dashboard</a>
</body>
</html>