<?php
session_start();
if( isset($_POST['submit']) )//The form was submitted
{
	//Initialize Link to Database
	$link = mysql_connect('localhost', 'root', 'tofu#[1]')
      OR die(mysql_error());
    if(!mysql_select_db('assassins'))
    {
    	echo "Error Selecting DB!";
    }
    
    //Move captured fields to 'nice variables
	$StudentID = mysql_real_escape_string($_POST["StudentID"]);
	$Password = mysql_real_escape_string($_POST["Password"]);
	
	//Retrieve stored password for StudentID given
	$result = mysql_query("SELECT AES_DECRYPT(Password,'my_secret'),Admin,Firstname, lastname FROM member WHERE StudentID = '".$StudentID."';");
	$row = mysql_fetch_row($result);
	$result = mysql_query("SELECT * FROM player WHERE StudentID = '".$StudentID."';");
	$count = mysql_num_rows ($result);

	//Compare Password to that given 
	if($row[0] == $Password)
	{
		//Set Login session
		$_SESSION["StudentID"]=$StudentID;
		$_SESSION["Admin"]=0;
		$_SESSION["Firstname"] = $row[2];
		$_SESSION["Lastname"] = $row[3];
		$_SESSION["Player"] = $count;
		if($row[1] == 1)
		{
			$_SESSION["Admin"]=1;
		}
		header("Location: dashboard.php"); //Redirect to dashboard
	}
	else {
		echo "Incorrect Password";
	}
}
?>
<html>
<style type="text/css">
.error {
background-color: red;
}
</style>
<body>
<form method="post" action="<?php echo $PHP_SELF;?>">

<ul style="list-style: none; padding: 0px; margin: 0px;">


	<!-- Student ID for Login -->
	<li class="">
	StudentID:<input type="text" size="12" maxlength="36" name="StudentID" value="<?php echo $_POST['StudentID']?>">
	</li>


	<!-- Password -->
	<li class="">
	Password:<input type="password" size="15" name="Password">
	</li>

	<li class="">
	<input type="submit" value="submit" name="submit">
	</li>

</ul>
</form>
<a href="../signup/member_pic.php">Signup!</a>