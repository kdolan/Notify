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
              <?php if(isAdmin() or true){ echo '<li><a href="admin.php">Admin</a></li>'; } ?>
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
        
       $output = array("Settings updated successfully");
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
      <form ACTION=scripts/updateSettings.php METHOD="post">
      <h2>Notify Settings</h2>
      <legend>Cellphone Settings</legend>
      <?php
            //$username = $_SERVER['WEBAUTH_USER'];
            $username = 'kdolan';
            connectToDb();
            $userQuery = "SELECT * FROM  `users` WHERE  `username` LIKE  '$username'";
            //echo  $userQuery;
            $userResult = mysql_query($userQuery);
            
            $userHasPrefs = false;
            
            if(mysql_num_rows($userResult)==1) //User has preferences. Fill with their preferences.
            {
                $userInfo = mysql_fetch_array($userResult);
                $userHasPrefs = true;
                
                $formatedPhone = substr($userInfo['cellphoneNumber'],0,3).'-'.substr($userInfo['cellphoneNumber'],3,3).'-'.substr($userInfo['cellphoneNumber'],6,4);
            }
            
      ?>
          <label>Cell Phone Number <font face="" color="#666666">(Format 585-999-8888)</font></label>
          
          <div id= "cellPhoneDiv" class="">
              <input type="text" id="cellPhone" onblur="validatePhone();"  name="cellPhone" value="<?php if($userHasPrefs){echo $formatedPhone;}?>">
              <span class="help-inline" id="cellPhoneError"></span>
          </div>
          
          <label>Cell Phone Carrier:</label>
          <select id="carrier" name="carrier">
          <?php
             $query = "SELECT * FROM  `cellCarrierInfo` ORDER BY  `cellCarrierInfo`.`carrierName` ASC ";
             $carrierTable = mysql_query($query);
             
             echo $query;
             
             while($row = mysql_fetch_array($carrierTable))
             {
                 if($userHasPrefs)
                 {
                     if($userInfo['cellCarrier']==$row['carrierName'])
                     {
                         echo '<option value="'.$row['carrierName'].'" selected>'.$row['carrierName'].'</option>';
                     }
                     else
                     {
                         echo '<option value="'.$row['carrierName'].'">'.$row['carrierName'].'</option>';
                     }
                 }
                 else
                 {
                     echo '<option value="'.$row['carrierName'].'">'.$row['carrierName'].'</option>';
                 }
                 
             }
          ?>
          </select>

          <br>
        <legend>Notification Perferences</legend>
          <?php
            //Print notification preferences
            $servicesQuery = "SELECT * FROM  `apiKeys` ";
            $servicesResult = mysql_query($servicesQuery);
            
            if($userHasPrefs)
            {
                while($row = mysql_fetch_array($servicesResult))
                {
                    $preferenceForThisService = $userInfo[$row['serviceName']];
                    if($preferenceForThisService==0)
                    {
                        echo '<h5>'.$row['serviceName'].':</h5> <select id="'.$row['serviceName'].'" name="'.$row['serviceName'].'">
                            <option value="0" selected>Email Notification</option>
                            <option value="1" >Text Message Notification</option>
                            <option value="2">Email and Text Message Notification</option>
                             <option value="3">No Notifications </option>
                             </select>';
                    }
                    elseif($preferenceForThisService==1)
                    {
                    echo '<h5>'.$row['serviceName'].':</h5> <select id="'.$row['serviceName'].'" name="'.$row['serviceName'].'">
                            <option value="0" selected>Email Notification</option>
                            <option value="1" selected>Text Message Notification</option>
                            <option value="2">Email and Text Message Notification</option>
                             <option value="3">No Notifications </option>
                             </select>';
                    }
                    elseif($preferenceForThisService==2)
                    {
                    echo '<h5>'.$row['serviceName'].':</h5> <select id="'.$row['serviceName'].'" name="'.$row['serviceName'].'">
                            <option value="0" >Email Notification</option>
                            <option value="1" >Text Message Notification</option>
                            <option value="2" selected>Email and Text Notification</option>
                             <option value="3">No Notifications </option>
                             </select>';
                    }
                    elseif($preferenceForThisService==3)
                    {
                    echo '<h5>'.$row['serviceName'].':</h5> <select id="'.$row['serviceName'].'" name="'.$row['serviceName'].'">
                            <option value="0">Email Notification</option>
                            <option value="1">Text Message Notification</option>
                            <option value="2">Email and Text Message Notification</option>
                             <option value="3" selected>No Notifications </option>
                             </select>';
                    }
                    else
                    {
                    echo $row['serviceName'].': <select id="'.$row['serviceName'].'" name="'.$row['serviceName'].'">
                            <option value="0" selected>Email Notification</option>
                            <option value="1" >Text Message Notification</option>
                            <option value="2">Email and Text Message Notification</option>
                             <option value="3">No Notifications </option>
                             </select>';
                    }
                }
            }
            else
            {
                while($row = mysql_fetch_array($servicesResult))
                {
                    echo '<h5>'.$row['serviceName'].':</h5> <select id="'.$row['serviceName'].'" name="'.$row['serviceName'].'">
                        <option value="0">Email Notification</option>
                        <option value="1">Text Message Notification</option>
                        <option value="2">Email and Text Message Notification</option>
                         <option value="3">No Notifications </option>
                         </select>';
                }
            }
          
          ?>
          <br><p></p>
          <button type="button" onclick="document.forms[0].submit();" class="btn btn-primary" btn-large> Submit&raquo;</button>

</form>
          
          
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
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrappjs/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../bootstrap/js/bootstrap-typeahead.js"></script>
        <script type="text/javascript">
            
            function validatePhone() {
                var error = "";
                
                
                var phoneInput = document.getElementById("cellPhone"); 
                var phoneDiv = document.getElementById("cellPhoneDiv");             
                var errorSpan = document.getElementById('cellPhoneError');
                
                var stripped = phoneInput.value.replace(/[\(\)\.\-\ ]/g, '');

                while( errorSpan.firstChild ) {
                    errorSpan.removeChild( errorSpan.firstChild );
                }

               if (phoneInput.value == "") {
                    error = "You didn't enter a phone number.\n";
                    phoneDiv.className="control-group error";
                } else if (isNaN(parseInt(stripped))) {
                    error = "The phone number contains illegal characters.\n";
                    phoneDiv.className="control-group error";
                } else if (!(stripped.length == 10)) {
                    error = "The phone number is the wrong length. Make sure you included an area code.\n";
                    phoneDiv.className="control-group error";
                } 
                else
                {
                    phoneDiv.className="";
                }
                errorSpan.appendChild( document.createTextNode(error) );
                return 0;
            
        }
      </script>
</body>
</html>
