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
if(isset($_POST['subscription']))
{
	$subscriptionService=true;
}
else
{
	$subscriptionService=false;
}
$usernameOfCreator = $_POST['username'];


if($subscriptionService)
{
	$query = "INSERT INTO  `kevin_notify`.`apiKeys` (
			`id` ,
			`serviceName` ,
			`username`,
			`subscriptionService`,
			`key`
			)
			VALUES (
			NULL ,  '$serviceName', '$usernameOfCreator',  '1', '$apiKey'
			);";
			
	mysql_query($query);
	
	$createPreferencesQuery = "ALTER TABLE  `users` ADD  `$serviceName` INT NOT NULL DEFAULT  '3' COMMENT  'Subscription preference for $serviceName. 0=email only. 1=text message. 2=Both. 3=No notifications (Not subscribed)'";
	//echo $createPreferencesQuery;
	
	mysql_query($createPreferencesQuery);


}
else
{
	$query = "INSERT INTO  `kevin_notify`.`apiKeys` (
			`id` ,
			`serviceName` ,
			`username`,
			`key`
			)
			VALUES (
			NULL ,  '$serviceName', '$usernameOfCreator',  '$apiKey'
			);";
			
	mysql_query($query);
	
	$createPreferencesQuery = "ALTER TABLE  `users` ADD  `$serviceName` INT NOT NULL DEFAULT  '0' COMMENT  'contact preference for $serviceName. 0=email only. 1=text message. 2=Both. 3=No notifications'";
	
	mysql_query($createPreferencesQuery);
}

if($usernameOfCreator!=''){
    notify($usernameOfCreator, "Your new service is now active on CSH Notifications. Your API key is: ".$apiKey, $apiKey);
}

header("location:../admin.php?e=1");

?>