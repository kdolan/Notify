<?php
//require_once('../dbConnect.php');
include_once("ldap_wrapper.php"); 


function queryUsername($username)
{
    $ldap = new LdapWrapper();
    return $ldap->query_username($username);
}

function queryName($name)
{
    $ldap = new LdapWrapper();
    return $ldap->query_name($name);
}

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

function hasService()
{
    connectToDb();
    $username = $_SERVER['WEBAUTH_USER'];
    $query = "SELECT * FROM `apiKeys` WHERE `username`='$username' AND `subscriptionService` = 1";
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