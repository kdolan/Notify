<?php
require("func.php");
require("../notify.php");

connectToDb();

$serviceId = $_POST['serviceId'];
$notification = $_POST['notification'];

 $servicesQuery = "SELECT * FROM  `apiKeys` WHERE `id`= $serviceId";
 $servicesResult = mysql_query($servicesQuery);
 
 $service = mysql_fetch_array($servicesResult);
 $apiKey = $service['key'];
 $servieName = $service['serviceName'];
 
 $usersQuery = "SELECT * FROM  `users` WHERE `$servieName`!=3"; 
 $usersResult = mysql_query($usersQuery);
 
 while($row=mysql_fetch_array($usersResult))
 {
 		$username = $row['username'];
 		notify($username, $notification, $apiKey); 
 }
 
header("location:../sendNotifications.php?e=1");
?>