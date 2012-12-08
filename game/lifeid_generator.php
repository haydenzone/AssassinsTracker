<?php 
function lifeid_generator()
{
$link = mysql_connect('localhost', 'root', 'tofu#[1]')
OR die(mysql_error());
if(!mysql_select_db('assassins'))
{
echo "Error Selecting DB!";
}
//Acquire the random color
$query = "SELECT * FROM randomcolor";
$result = mysql_query($query);
$count = mysql_num_rows($result);
$rand = rand(1, $count);
$query = "SELECT color FROM randomcolor WHERE id = '".$rand."';";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$rand_color = $row[0];

//Acquire the random noun
$query = "SELECT * FROM randomword";
$result = mysql_query($query);
$count = mysql_num_rows($result);
$rand = rand(1, $count);
$query = "SELECT word FROM randomword WHERE id = '".$rand."';";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$rand_word= $row[0];

return $rand_color."_".$rand_word;
}
?>