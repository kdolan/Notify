<?php
//require_once('../dbConnect.php');
function isAdmin()
{
    connectToDb();
    $username = $_SERVER['WEBAUTH_USER'];
    $query = "SELECT * FROM `admin` WHERE `username`='$username'";
    $adminQueryTable = mysql_query($query);
    if(mysql_num_rows($adminQueryTable)==1)
    {
        return true;
    }
    return false;
}

function secureInput($inputString)
{
      $safeString = mysql_real_escape_string($inputString);
      return $safeString;
}
?>