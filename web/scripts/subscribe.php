<?php

require_once('../dbConnect.php');
require("func.php");



connectToDb();
	$serviceId = $_GET['serviceId'];

 $servicesQuery = "SELECT * FROM  `apiKeys` WHERE `id`= $serviceId";
 $servicesResult = mysql_query($servicesQuery);
 
 $service = mysql_fetch_array($servicesResult);
 $serviceName = $service['serviceName'];
 
 $username = $_SERVER['WEBAUTH_USER'];

 $userQuery = "SELECT * FROM  `users` WHERE  `username` LIKE  '$username' ";
 $userResult = mysql_query($userQuery);
 
 if (mysql_num_rows($userResult)==0)
 {
     //User does not exist. Create them.
     $createUserQuery = "INSERT INTO  `kevin_notify`.`users` (
        `id` ,
        `username`
        )
        VALUES (
        NULL ,  '$username'
        );";
    mysql_query($createUserQuery);
    
    //Run userQuery again to select this user and proceede as normal.
    $userResult = mysql_query($userQuery);    
    
 }
 
 $user = mysql_fetch_array($userResult);
 $userId = $user['id'];
 
 $updateSettings = "UPDATE  `kevin_notify`.`users` SET  `$serviceName` =  '0' WHERE  `users`.`id` =$userId;";

//echo $updateSettings;
  mysql_query($updateSettings);

header("location:../index.php?e=2");

?>