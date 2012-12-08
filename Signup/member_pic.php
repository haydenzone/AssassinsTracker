<?php

session_start();

if( isset($_POST['submit']) )//The form was submitted
{
	//Include Mailing system
	include('../../mail/mail.php');
	$already_registered = false; // good faith right now
	
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
	if(($_POST["Email"]) == "" || !check_email_address($_POST["Email"]))
	{
		$Email_error = true;
		$error = true;
	}
	if(strlen($_POST["phone1"]) != 3 || strlen($_POST["phone2"]) !=3 ||
	strlen($_POST["phone3"]) != 4)
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
	
	//Check for uploaded image file
	if($_FILES['uploadedfile']['name'] == "" || 
	!(strtoupper(end(explode('.', $_FILES['uploadedfile']['name']))) == "JPG" ||
	strtoupper(end(explode('.', $_FILES['uploadedfile']['name']))) == "JPEG"))
	{
		$picture_error = true;
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
		$Fname = mysql_real_escape_string($_POST["Fname"]);
		$Lname = mysql_real_escape_string($_POST["Lname"]);
		$StudentID = mysql_real_escape_string($_POST["StudentID"]);
		$Email = mysql_real_escape_string($_POST["Email"]);
		$Password = mysql_real_escape_string($_POST["Password"]);
		$Cell = mysql_real_escape_string($_POST["phone1"].$_POST["phone2"].$_POST["phone3"]);
		$Provider = mysql_real_escape_string($_POST["provider"]);
		
		
		
		
		
		
		//Check if already registered
		$result = mysql_query("SELECT StudentID FROM member WHERE StudentID = '".$StudentID."';");
		$num_rows = mysql_num_rows($result);
		if($num_rows == 0)
		{
			//Set Text Email
			if ($_POST["text"] == "subscribe")
			{
				include('TextEmail.php');
				
				//Generate a confirmation code
				$confcode = rand(1000,9999);
			 	mysql_query("INSERT INTO textconf (StudentID, ConfCode) VALUES('"
			 	.$StudentID."','".$confcode."')");
			 	//Send out confirmation code
				mailFromAdmin( $TextEmail, "", "Assassins Texting Confirmation Code:".$confcode);
			}
			
			
			
			mysql_query("INSERT INTO member (StudentID, LastName, FirstName, Email, PhoneNum, TextEmail, Password, Admin)
				VALUES('". $StudentID."','".$Lname."','".$Fname.
				"','".$Email."','".$Cell."','".$TextEmail."',AES_ENCRYPT('".
				$Password."',  'my_secret' ),0)");
			$submitted = true;
				
			//Send out a confirmation email with login information
			
			include('regemail.php');
		}
		else 
		{
			$already_registered = true;
		}
		
		
		
		//Upload the image
		$target_path = "/AssassinsSystem/Signup/temp/";
		$ext = end(explode('.', $_FILES['uploadedfile']['name']));
		$target_path = $target_path . $StudentID.".".$ext; 
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], dirname($_SERVER['DOCUMENT_ROOT'])."/htdocs" .$target_path)) {
		    //echo "<p>The file ".  basename( $_FILES['uploadedfile']['name']). 
		    //" has been uploaded</p>";
		    
			// The file
			$filename = $_SERVER['DOCUMENT_ROOT'] .$target_path;
			
			// Set a maximum height and width
			$width = 600;
			$height = 600;
			
			// Get new dimensions
			list($width_orig, $height_orig) = getimagesize($filename);
			
			$ratio_orig = $width_orig/$height_orig;
			
			if ($width/$height > $ratio_orig) {
			   $width = $height*$ratio_orig;
			} else {
			   $height = $width/$ratio_orig;
			}
			
			// Resample
			$image_p = imagecreatetruecolor($width, $height);
			$image = imagecreatefromjpeg($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
			
			// Output
			imagejpeg($image_p, $filename, 100);
		    
		    $_SESSION['image'] = $target_path;
		    $_SESSION['StudentID'] = $StudentID;
		    //list($width, $height, $type, $attr) = getimagesize($target_path);
		    
		    header("Location: ../../jcrop/demos/assassins_crop.php");
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



<?php 
//Display Flag
if($already_registered)
{
?>
<div style="background-color: red;">
<?php echo $StudentID;?> is already registered.
</div>
<?php 
}?>




<form enctype="multipart/form-data" method="post" action="<?php echo $PHP_SELF;?>">

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
<div style="background-color: yellow">Texting is highly suggested for most up to the minute updates!</div>
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


<!-- Upload Picture -->

<li class="
<?php 
if($picture_error)
echo 'error';
?>
"
>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
Choose a picture of <b>yourself</b> (ONLY JPEGS): <input name="uploadedfile" type="file" />
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
