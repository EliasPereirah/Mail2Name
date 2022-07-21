<?php
//use example
require("vendor/autoload.php");
$NameSuggests = new \App\NameSuggests();
$email = 'anna_silva23@server.tld';
// if have no match will return empty name, genre and frequency = 0
$mail_info = $NameSuggests->getName($email);
print_r($mail_info);
