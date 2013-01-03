<?php
require_once('../dbConnect.php');
require("func.php");

connectToDb();

$cellPhone = secureInput($_POST['cellPhone']);
$carrier = secureInput($_POST['carrier']);

$cellPhone = str_replace('-','',$cellPhone);

 $servicesQuery = "SELECT * FROM  `apiKeys` ";
 $servicesResult = mysql_query($servicesQuery);
 
 $username = $_SERVER['WEBAUTH_USER'];

 $userQuery = "SELECT * FROM  `users` WHERE  `username` LIKE  '$username' ";
 $userResult = mysql_query($userQuery);
 
 $user = mysql_fetch_array($userResult);
 $userId = $user['id'];
 
 $updateSettings = "UPDATE  `notifications`.`users` SET  `cellphoneNumber` =  '$cellPhone',
`cellCarrier` =  '$carrier' WHERE  `users`.`id` =$userId;";

  mysql_query($updateSettings);
  
  while($row = mysql_fetch_array($servicesResult))
  {
      
      $serviceName = $row['serviceName'];
  
      $preference = $_POST[$serviceName];
      
      $updateQuery = "UPDATE  `notifications`.`users` SET  `$serviceName` =  '$preference' WHERE  `users`.`id` =$userId;";
      mysql_query($updateQuery);
  }

header("location:../index.php?e=1");

?>