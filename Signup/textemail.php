<?php

$provider_email = array(
'Verizon' => 'vtext.com',
'Alltel'=> 'message.alltel.com',
'AT&T' => 'txt.att.net',
'Boost' => 'myboostmobile.com',
'Sprint' => 'messaging.sprintpcs.com',
'T-Mobile' => 'tmomail.net',
'US' => 'email.uscc.net',
'Virgin' => 'vmobl.com'
);

$TextEmail = $Cell."@".$provider_email[$Provider];

?>
