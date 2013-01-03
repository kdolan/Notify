<?php
require("func.php");
require("../notify.php");

if(isAdmin()!=true)
{
    echo 'Not admin';
     die();
}

connectToDb();

$serviceName = $_POST['serviceName'];
$apiKey = $_POST['apiKey'];
$usernameOfCreator = $_POST['username'];

$query = "INSERT INTO  `notifications`.`apiKeys` (
        `id` ,
        `serviceName` ,
        `key`
        )
        VALUES (
        NULL ,  '$serviceName',  '$apiKey'
        );";
        
mysql_query($query);

$createPreferencesQuery = "ALTER TABLE  `users` ADD  `$serviceName` INT NOT NULL DEFAULT  '0' COMMENT  'contact preference for $serviceName. 0=email only. 1=text message. 2=Both. 3=No notifications'";

mysql_query($createPreferencesQuery);

if($usernameOfCreator!=''){
    notify($usernameOfCreator, "Your new service is now active on CSH Notifications. Your API key is: ".$apiKey, $apiKey);
}

header("location:../admin.php?e=1");

?>