<?php
$body = $Fname."<br /><br />You have been registered to participate in Assassins. You ". 
"can login <a href='http://ha.ydenw.com/assassinssystem/login/login.php'>here</a>. For your records: <br /><br />".
"Login: ".$StudentID."<br />".
"Password: ". $Password."<br /><br />"
."Cheers,\nHayden";
mailFromAdmin( $Email, "Assassins Registration Information", $body);
?>
