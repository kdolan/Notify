<?php
    /*
    Author: Kevin J Dolan
    Project: Notify
    File Name: apiBridge.php
    Purpose: Bridge between APIs in other languages and the php API. apiBridge.php is loaded via http from the other api's and then the apiBridge passes the information to the phpAPI for db processing.
    Notes: This page should be loaded using https.
    Date: 12/29/12
    
    ****THIS FILE MUST BE PLACED ON THE WEBSERVER IN THE SAME DIRECTORY AS NOTIFY.PHP****
    Load this file via http to add a notification.

    */
    
    require("notify.php");
    
    $username = $_GET['username'];
    $notification = $_GET['notification'];
    $apiKey = $_GET['apiKey'];
    
    notify($username,$notification,$apiKey);
    
    
?>