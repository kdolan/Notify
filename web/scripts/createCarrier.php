<?php
require("func.php");
require("../notify.php");

if(isAdmin()!=true)
{
     echo 'Not admin';
     die();
}

connectToDb();

$carrierName = $_POST['carrierName'];
$domain = $_POST['domain'];

$query = "INSERT INTO  `kevin_notify`.`cellCarrierInfo` (
        `id` ,
        `carrierName` ,
        `domain`
        )
        VALUES (
        NULL ,  '$carrierName',  '$domain'
        );";
        
mysql_query($query);

header("location:../admin.php?e=2");

?>