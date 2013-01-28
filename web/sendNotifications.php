<?php 
require_once("scripts/func.php");
require_once("dbConnect.php");
 connectToDb();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSH - Notify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {<link rel="stylesheet" type="text/css" href="">
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">Notify</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <?php if(isAdmin()){ echo '<li><a href="admin.php">Admin</a></li>'; } ?>
              <?php if(hasService()){ echo '<li class="active"><a href="sendNotifications.php">Send Notifications</a></li>'; } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
      <?php 
      //1 = Event Created Suc
          $eData = $_GET['e'];
          $eeData = $_GET['ee']; //Error Messages
        
       $output = array("Notifications sent to all subscribers");
       $outputEE = array("An error has occured");  
                   
        if($eData<=0)
        {
                
        }
        else 
        {
            echo '<table class="table table-condensed" align="center">
          <tr class="success">
        <td>'.$output[$eData-1].'</td>
          </tr>
          </table>';
        
        }
        if($eeData<=0)
        {
                
        }
        else 
        {
            echo '<table class="table table-condensed" align="center">
          <tr class="error">
        <td>'.$outputEE[$eeData-1].'</td>
          </tr>
          </table>';
        
        }
      
      ?>
      
      <h2>Send Notifications</h2>
      
      <?php
            $username = $_SERVER['WEBAUTH_USER'];

            connectToDb();
            $apiQuery = "SELECT * FROM  `apiKeys` WHERE  `username` LIKE  '$username' AND `subscriptionService` = 1";
            $apiResult = mysql_query($apiQuery);
            
            
            while ($apiRow = mysql_fetch_array($apiResult))
            {
                $apiKey = $apiRow['apiKey'];
                $serviceName = $apiRow['serviceName'];
            echo '<form ACTION=scripts/sendNotifications.php METHOD="post">    
            <label> Send notification to all subscribers for: <B>'.$serviceName.'</b></label> 
            <input type="hidden" name="serviceId" value="'.$apiRow['id'].'"> 
          <textarea name="notification" cols="25" rows="5"> Notfication text...</textarea>';     
             
             $usersQuery = "SELECT * FROM  `users` WHERE `$serviceName`!=3"; 
             $usersResult = mysql_query($usersQuery);
             
             $count = 0;
             echo " Current Subscribers: "; 
             while($row=mysql_fetch_array($usersResult))
             {
                    $username = $row['username'];
                    $memberName = queryUsername($username);
                    if ($count == 0)
                    {
                        echo $memberName;
                    }
                    else
                    {
                        echo ', '.$memberName;
                    }
                    $count++;
                    
             }       
echo 
          '<br><button type="submit" id="submit" onclick="document.forms[0].submit();" class="btn btn-primary" btn-large> Submit&raquo;</button>. 
          </form>'; 
            }
      ?>
      

 
 



          
          
      </div>

      <!-- Example row of columns -->
      <hr>

      <footer>
        <p>Created by Kevin J Dolan</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

        <script type="text/javascript">


      </script>
</body>
</html>
