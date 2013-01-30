<?php 
    /*
    Author: Kevin J Dolan
    Project: Notify
    File Name: getNotifications.php
    Purpose: Prints json string of all notifications that need to be sent.
    Date: 12/29/12
    
    ***SHOULD BE ACCESSED OVER HTTPS***
    */
    require("../dbConnect.php");
    $theServerKey = "key";
    $passedServerKey = $_GET['serverKey'];
    if($theServerKey == $passedServerKey)
    {
		connectToDb();
		$query = mysql_query("SELECT * FROM  `notifications` WHERE  `active` =1");
		$rows = array();
		while($row = mysql_fetch_assoc($query)) {
			$rows[] = $row;
		}
		print json_encode($rows);
    }
    else
    {
    	echo "INVALID SERVER KEY";
    }	

?>