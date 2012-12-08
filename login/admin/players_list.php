<?php 
require ('../admin_check.php');

$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}

//Query database for all players and members
$query = "SELECT imageloc, a.studentID, CONCAT( Firstname,  ' ', Lastname ) AS name, phonenum,  kills, lives, FORMAT(kills/lives,2) AS KD
FROM member a
LEFT OUTER JOIN player b ON a.StudentID = b.StudentID ORDER BY KD DESC";
$result = mysql_query($query);

//DisplayTable
echo "<table>";
echo "<tr><td></td>";
echo "<td>StudentID</td>";
echo "<td>Name</td>";
echo "<td>Phone Number</td>";
echo "<td>Kills</td>";
echo "<td>Lives</td>";
echo "<td>K/L</td></tr>";
for( $i = 0; $i < mysql_num_rows($result); $i++)
{
	$row = mysql_fetch_row($result);
	echo "<tr>";
	echo "<td><img src=\"$row[0]\" width=\"40\"></td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5]</td>";
	echo "<td>$row[6]</td>";
	echo "</tr>";
}
echo "</table>"
?>
<a href="../dashboard.php"> Return to Dashboard</a>