<?php
    require("../dbConnect.php");
    
    $theServerKey = "key";
    $passedServerKey = $_GET['serverKey'];
    if($theServerKey == $passedServerKey)
    {
		connectToDb();
		$sentArray = explode(',',$_GET['sentList']); 
		
		$counterGood = 0;
		$counter = 0;
		foreach($sentArray as $id )
		{
			$query= "UPDATE  `kevin_notify`.`notifications` SET  `active` =  '0' WHERE  `notifications`.`id` =$id;";
			if(mysql_query($query))
			{
				$counterGood++;
			}
			$counter++;
			
		}
		echo $counterGood.' of '.$counter.' updated successfully';
    }
    else
    {
    	echo "INVALID SERVER KEY";
    }	
?>
