<?php 
session_start();
if (!isset($_SESSION['StudentID']))
{
	header("Location: ../login.php");
}
if ($_SESSION["Admin"] != 1)
{
	header("Location: ../login.php");
}
?>