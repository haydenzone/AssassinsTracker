<?php
session_start();
if( isset($_POST['submit']) )//The form was submitted
{

	if(($_POST["Password"]) == "" || ($_POST["PasswordConf"]) == "")
	{
		$Password_error = true;
		$error = true;
	}
	else if($_POST["PasswordConf"] != $_POST["Password"])
	{
		$PasswordConf_error = true;
		$error = true;
	}
	//Submit the form
	if ($error == false)
	{ 
		$link = mysql_connect('localhost', 'root', 'tofu#[1]')
	      OR die(mysql_error());
	    if(!mysql_select_db('assassins'))
	    {
	    	echo "Error Selecting DB!";
	    }
	    
	    //Check Old Password
	    $query = 'SELECT AES_DECRYPT(Password, \'my_secret\') FROM member WHERE StudentID = \''.$_SESSION["StudentID"].'\'';
	    $result = mysql_query($query);
	    $password = mysql_fetch_row($result);
		$NewPassword = mysql_real_escape_string($_POST["Password"]);
		$submitted = false;
		
		//Change password if correct
		if($password[0] == $_POST["oldpassword"])
		{
			mysql_query("UPDATE member SET password = AES_ENCRYPT('".$NewPassword."','my_secret') WHERE StudentID ='".
			$_SESSION["StudentID"]."'");
			$submitted = true;
		}	
		else 
			echo "Incorrect Password";
	}
}
if(!$submitted)
{
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


<li>
<!-- Password -->
Old Password:<input type="password" size="15" name="oldpassword">
</li>

<li
 class="
<?php 
if($Password_error || $PasswordConf_error)
echo 'error';
?>
"
>
<!-- Password -->
New Password:<input type="password" size="15" name="Password"><br />
New Confirm Password:<input type="password" size="15" name="PasswordConf">
</li>


<!-- Submit -->
<li>
<input type="submit" value="submit" name="submit">
</li>
</ul>
</form>
<?php }
else 
{
	echo "Password Changed";
}
?>
<a href="../dashboard.php"> Return to Dashboard</a>