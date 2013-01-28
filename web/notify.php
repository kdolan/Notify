<?php
    /*
    Author: Kevin J Dolan
    Project: Notify
    File Name: notify.php
    Purpose: Adds a notification to db after using the provided information to determine correct notification settings.
    Date: 12/29/12
    */
    require("User.php");
    //DB CONNECTION INFO
    require("dbConnect.php");
    
    $apiKey = "REPLACE_WITH_API_KEY";
    
    function notify($username, $notification, $passedApiKey=null)
    {
        connectToDb();
        //If api key is specified use that key.
        if($passedApiKey!=null)
        {
            $apiKey = $passedApiKey;
        }
        
        //get Service name
        $query = "SELECT * FROM  `apiKeys` WHERE  `key` LIKE  '$apiKey'";
        $serviceResult = mysql_query($query);
        if(mysql_num_rows($serviceResult)!=1)
        {
            //invalid API key
            echo 'invalid API key';
            die();
        }
        $service = mysql_fetch_array($serviceResult);
        
        $serviceName = $service['serviceName'];
        $subscriptionBasedService = $service['subscriptionService'];
        
        
        //Get user
        $query = "SELECT * FROM  `users` WHERE  `username` LIKE  '$username'";
        $userResult = mysql_query($query);
        if(mysql_num_rows($userResult)==1)
        {
            $userRow = mysql_fetch_array($userResult);
            $contactMethod = $userRow[$serviceName];
            $user = new User($username,$userRow['cellphoneNumber'],$userRow['cellCarrier'],$contactMethod);
        }
        else
        {
            //If user has not setup notifications then it defaults to email only.
            $user = new User($username,0,null,0);
        }
       
        
        //Get email Address for notification
        if($user->getContactMethod()==1 or $user->getContactMethod()==2)
        {
            //
            $carrier = $user->getCarrier();
            $query = "SELECT * FROM  `cellCarrierInfo` WHERE  `carrierName` LIKE  '$carrier'";
            $carrierResult = mysql_query($query);
            $carrierRow = mysql_fetch_array($carrierResult);
        
            $phoneEmail = $user->getPhoneNumber()."@".$carrierRow['domain'];
        }
        if($user->getContactMethod()==0 or $user->getContactMethod()==2)
        {
            $cshEmail = $user->getUsername()."@csh.rit.edu";
        }
        
        //Add notification(s)
        
        //Contruct Queries. If variable was not defined above it will just be ''
        $normalEmailQuery = "INSERT INTO  `kevin_notify`.`notifications` (
            `id` ,
            `notificationService` ,
            `email` ,
            `notificationText` ,
            `active`
            )
            VALUES (
            NULL ,  '$serviceName',  '$cshEmail',  '$notification',  '1'
            );";
            
        $phoneEmailQuery = "INSERT INTO  `kevin_notify`.`notifications` (
            `id` ,
            `notificationService` ,
            `email` ,
            `notificationText` ,
            `active`
            )
            VALUES (
            NULL ,  '$serviceName',  '$phoneEmail',  '$notification',  '1'
            );";
            
        
        if($user->getContactMethod()==2)
        {
            //Send two notifications
            
            mysql_query($normalEmailQuery);
            mysql_query($phoneEmailQuery);
            
            
        }
        elseif($user->getContactMethod()==1)
        {
            //Send text message notification
            mysql_query($phoneEmailQuery);
        }
        elseif($user->getContactMethod()==0)
        {
            //send email notification
            mysql_query($normalEmailQuery);
            
        }
        elseif($user->getContactMethod()==3)
        {
            //no notifications from this service.
            //Do nothing
        }
        else
        {
            echo 'An error has occured';
            die();
        }
           
        //echo 'success';     
        
        
    }
    
?>