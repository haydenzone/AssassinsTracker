<?php 
session_start();
if(isset($_POST["issues"]))
{
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
		mailFromAdmin( $email[0], "Submitted Issue", "Issue from ".$_SESSION["Firstname"].
		" ".$_SESSION["Lastname"].":\n\n".$_POST["issues"]);
	}	
	echo "Problem Submitted. We will contact you shortly.";
}
else {
?>
<form action="<?php echo $PHP_SELF;?>" method="post">
<textarea rows="10" cols="40" name="issues" text=""></textarea>
<button type="submit" value="Submit" name="Submit">Submit</button>
</form>

<?php }?>
<a href="../dashboard.php"> Return to Dashboard</a>