<?php 
session_start();

$target_path = "/AssassinsSystem/Signup/temp/";
$ext = end(explode('.', $_FILES['uploadedfile']['name']));
$target_path = $target_path . $_SESSION["StudentID"].".".$ext; 
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
    //list($width, $height, $type, $attr) = getimagesize($target_path);
    
    header("Location: ../../jcrop/demos/assassins_crop.php");
} 
?>