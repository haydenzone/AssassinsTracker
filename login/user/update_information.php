<?php

if( isset($_POST['submit']) )//The form was submitted
{
	$error = false;
	if($_POST["Fname"] == "")
	{
		$Fname_error = true;
		$error = true;
	}
	if(($_POST["Lname"]) == "")
	{
		$Lname_error = true;
		$error = true;
	}
	if(($_POST["StudentID"]) == "")
	{
		$StudentID_error = true;
		$error = true;
	}
	if(($_POST["Email"]) == "")
	{
		$Email_error = true;
		$error = true;
	}
	if(($_POST["phone1"]) == "" || ($_POST["phone2"]) == "" ||
	($_POST["phone3"]) == "")
	{
		$Phone_error = true;
		$error = true;
	}
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
	if ($_POST["text"] == "subscribe")
	{
		//Check to see if provider isset
		if($_POST["provider"] == "noselection")
		{
			$Provider_error = true;
			$error = true;
		}
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
		$Fname = mysql_real_escape_string($_POST["Fname"]);
		$Lname = mysql_real_escape_string($_POST["Lname"]);
		$StudentID = mysql_real_escape_string($_POST["StudentID"]);
		$Email = mysql_real_escape_string($_POST["Email"]);
		$Password = mysql_real_escape_string($_POST["Password"]);
		$Cell = mysql_real_escape_string($_POST["phone1"].$_POST["phone2"].$_POST["phone3"]);
		$Provider = mysql_real_escape_string($_POST["provider"]);
		$submitted = true;
		//Set Text Email
		$TextEmail = "6056451264@vtext.com";
		
		
		mysql_query("INSERT INTO member (StudentID, LastName, FirstName, Email, PhoneNum, TextEmail, Password, Admin)
			VALUES('". $StudentID."','".$Lname."','".$Fname.
			"','".$Email."','".$Cell."','".$TextEmail."',AES_ENCRYPT('".
			$Password."',  'my_secret' ),0)");
			
		//Send out a confirmation email with login information
		include('../../mail/mail.php');
		$body = $Fname.",\n\nYou have been registered to participate in Assassins. You ". 
		"can log in at the GFS website GFS.sdsmt.edu. For your records: \n\n".
		"Login: ".$StudentID."\n".
		"Password: ". $Password."\n\n"
		."Cheers,\nHayden";
		mailFromAdmin( $Email, "Assassins Registration Information", $body);
		
		//Send out confirmation code for texting
		if ($TextEmail != "")
		{
			$confcode = rand(100,10000);
		 	mysql_query("INSERT INTO textconf (StudentID, ConfCode) VALUES('".$StudentID."','".$confcode."')");
			mailFromAdmin( $TextEmail, "", "Assassins Texting Confirmation Code:".$confcode);
		}
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
<!-- First Name -->
<li class="
<?php 
if($Fname_error)
echo 'error';
?>
"
>
First Name:<input type="text" size="12" maxlength="12" name="Fname" value="<?php echo $_POST['Fname']?>">
</li>

<li class="
<?php 
if($Lname_error)
echo 'error';
?>
"
>
<!-- Last Name -->
Last Name:<input type="text" size="12" maxlength="36" name="Lname" value="<?php echo $_POST['Lname']?>">
</li>

<li class="
<?php 
if($StudentID_error)
echo 'error';
?>
"
>
<!-- Last Name -->
StudentID:<input type="text" size="12" maxlength="36" name="StudentID" value="<?php echo $_POST['StudentID']?>">
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
Password:<input type="password" size="15" name="Password"><br />
Confirm Password:<input type="password" size="15" name="PasswordConf">
</li>

<li class="
<?php 
if($Email_error)
echo 'error';
?>
"
>
<!-- Email -->
Email:<input type="text" size="15" maxlength="36" name="Email" value="<?php echo $_POST['Email']?>">
</li>

<li
 class="
<?php 
if($Phone_error)
echo 'error';
?>
"
>
<!-- Phone Number -->
Cell:(<input type="text" size="3" maxlength="3" name="phone1" value="<?php echo $_POST['phone1']?>">) 
<input type="text" size="3" maxlength="3" name="phone2" value="<?php echo $_POST['phone2']?>"> - 
<input type="text" size="4" maxlength="4" name="phone3" value="<?php echo $_POST['phone3']?>">

</li>

<!-- Text Messaging -->
<li class="
<?php 
if($Provider_error)
echo 'error';
?>
"
>
<input type="checkbox" value="subscribe" name="text">Subscribe to text messaging updates?
Select your provider:
<select name="provider">
<option value="noselection"></option>
<option value="Verizon">Verizon</option>
<option value="Alltel">Alltel</option>
<option value="AT&T">AT&T</option>
<option value="Boost">Boost Mobile</option>
<option value="Sprint">Sprint</option>
<option value="T-Mobile">T-Mobile</option>
<option value="US">US Cellular</option>
<option value="Virgin">Virgin Mobile USA</option>
</select>
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
	echo "Form Submitted successfully";
	if($TextEmail != "")
	{
	?>
You will receive a text message with a confirmation code shortly. 
<form action="cellconfirm.php" method="post">
Confirmation Code:<input type="text" size="12" maxlength="36" name="confcode">
<input type="text" name="StudentID" value="<?php echo $StudentID;?>" style="visibility:hidden;">
<input type="submit" value="submit">

</form>
	<?php 
	}
}
?>
