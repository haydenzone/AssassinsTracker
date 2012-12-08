<?php 
require ('../admin_check.php');

$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}

//Query database for all players and members
$query = "SELECT a.imageloc, CONCAT(a.Firstname,  ' ', a.Lastname ) AS name, 
target.imageloc, CONCAT(target.Firstname, ' ', target.Lastname ) AS Targetname
FROM member a
JOIN player b ON a.StudentID = b.StudentID 
JOIN member target ON b.TargetID = target.StudentID";
$result = mysql_query($query);

//DisplayTable
echo "<table>";
for( $i = 0; $i < mysql_num_rows($result); $i++)
{
	$row = mysql_fetch_row($result);
	echo "<tr>";
	echo "<td><img src=\"$row[0]\" width=\"40\"></td>";
	echo "<td>$row[1]</td>";
	echo "<td>-----------------></td>";
	echo "<td><img src=\"$row[2]\" width=\"40\"></td>";
	echo "<td>$row[3]</td>";
	echo "</tr>";
}
echo "</table>"
?>
<a href="../dashboard.php"> Return to Dashboard</a>