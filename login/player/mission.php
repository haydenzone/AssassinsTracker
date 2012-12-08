<?php 
session_start();

//Initialize Database
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}
$query="SELECT a.StudentID, a.FirstName, a.LastName, a.imageloc, LifeID, TargetID, target.FirstName, target.LastName, target.ImageLoc
FROM member a
NATURAL JOIN player
LEFT OUTER JOIN member AS target ON TargetID = target.StudentID WHERE a.StudentID = '".$_SESSION["StudentID"]."'";

//Run Query
$result = mysql_query($query);
$row = mysql_fetch_row($result);

//Move Results into 'nice' variables
$StudentID = $row[0];
$FirstName = $row[1];
$LastName = $row[2];
$image = $row[3];
$LifeID = $row[4];
$TargetID = $row[5];
$TargetFirst = $row[6];
$TargetLast = $row[7];
$TargetImage = $row[8];

echo "<img src=",$image," height=\"40px\">";

if ($TargetID == "")
{
?>


<h3>
<?php echo $FirstName." ".$LastName;?></h3>
<p>You are awaiting a new target</p>
<?php 
}
else if($TargetID != $StudentID)
{
?>
<h3><?php echo $FirstName." ".$LastName;?> ( LifeID: <?php echo $LifeID ?> )</h3>
<h4>Your target is <?php echo $TargetFirst." ".$TargetLast ?></h4>
<img src="<?php echo $TargetImage?>" height="300px">

<p>Rules: We're keeping it simple this game. Tap your target on the back with a spoon to "kill" them.
If you're called out during your assassination, you will have to wait until another time to attack you target.</p>


<p><strong>Mission Accomplished?</strong> If so, fill out your target's LifeID. This will confirm you have completed your mission, and give your next target.</p>
<form method="get" action="assassination_log.php">
Target's LifeID: <input type="text" name="LifeID" />
<input type="submit" value="Submit" />
</form>
<a href="../dashboard.php"> Return to Dashboard</a>
<?php 
}
else {
?>
<h3><?php echo $FirstName." ".$LastName;?></h3>
<p>Congratulations!!!! You are the last surviving assassin. However, the game does not stop here. 
If you would like to continue in another ring, <a href="assassination_log.php?LifeID=<?php echo $LifeID?>">click here.</a></p>
<?php }?>