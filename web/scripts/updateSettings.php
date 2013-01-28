<?php
require_once('../dbConnect.php');
require("func.php");


//echo '******'.$gameJam; 

connectToDb();

$cellPhone = secureInput($_POST['cellPhone']);
$carrier = secureInput($_POST['carrier']);

$cellPhone = str_replace('-','',$cellPhone);

 $servicesQuery = "SELECT * FROM  `apiKeys` ";
 $servicesResult = mysql_query($servicesQuery);
 
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
 
 $updateSettings = "UPDATE  `kevin_notify`.`users` SET  `cellphoneNumber` =  '$cellPhone',
`cellCarrier` =  '$carrier' WHERE  `users`.`id` =$userId;";

  mysql_query($updateSettings);
  
  while($row = mysql_fetch_array($servicesResult))
  {
      
      $serviceName = $row['serviceName'];
	  $serviceNameStrip = str_replace(' ','',$serviceName);
	  //echo $serviceName;
  
      $preference = $_POST[$serviceNameStrip];
      //echo $preference;
      if($preference=='')
      {
      	$preference=3;
      }
      $updateQuery = "UPDATE  `kevin_notify`.`users` SET  `$serviceName` =  '$preference' WHERE  `users`.`id` =$userId;";
 	  
      mysql_query($updateQuery);
  }

header("location:../index.php?e=1");

?>