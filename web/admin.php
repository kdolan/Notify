<?php 
require_once("scripts/func.php");
require_once("dbConnect.php");
 connectToDb();
 
 if(isAdmin()==false)
 {
     echo 'Not admin';
     die();
 }
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
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
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
              <?php if(isAdmin()){ echo '<li class="active"><a href="admin.php" >Admin</a></li>'; } ?>
              <?php if(hasService()){ echo '<li><a href="sendNotifications.php">Send Notifications</a></li>'; } ?>   
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
        
       $output = array("Service created successfully.","Carrier information added.");
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
      <form ACTION=scripts/createService.php METHOD="post">
      <h2>Admin Actions</h2>
      <legend>Add Service</legend>
          <label>New Service Name</label>
          <input type="text" id="serviceName"  name="serviceName" value="" onchange="validInput()" onkeypress="validInput()" onkeydown="validInput()" onkeyup="validInput()">
    	<label class="checkbox" name"subscription" >
      		<input type="checkbox" name="subscription" value="subscription"> Subscription based service
    	</label>
          
          <label>API Key</label>
          <div class="input-append">
          <input class="span3" id="apiKey" name="apiKey" type="text" readonly>
          <button class="btn btn-warning" type="button" onclick="generateApiKey()">Generate API Key</button>
          </div>
          
          <label>Username <font face="" color="#666666">(For notification containing API key)</label>
          <input type="text" id="username" name="username" >
         
          <br>
           <button type="button" disabled id="submit1Button" onclick="document.forms[0].submit();" class="btn btn-primary" btn-large> Submit&raquo;</button>
      </form>
     <form ACTION=scripts/createCarrier.php METHOD="post">
        <legend>Add Carrier</legend>
            <label>New Carrier Name</label>
          <input type="text" id="carrierName"  name="carrierName" value="" onkeyup="validInput2()">


          <label>Carrier Domain</label>
          <input type="text" id="domain" name="domain" onkeyup="validInput2()" >
         

          <br><p></p>
          <button type="button" disabled id="submit2Button" onclick="document.forms[1].submit();" class="btn btn-primary" btn-large> Submit&raquo;</button>

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
            
            function generateApiKey() {

                var apiKey = document.getElementById("apiKey"); 
                
                var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
                var string_length = 16;
                var randomstring = '';
                for (var i=0; i<string_length; i++) {
                    var rnum = Math.floor(Math.random() * chars.length);
                    randomstring += chars.substring(rnum,rnum+1);
                }
                
                apiKey.value = randomstring;
                }
               window.onload =  generateApiKey();
            function validInput()
            {
                var serviceName = document.getElementById("serviceName"); 
                var submitButton = document.getElementById("submit1Button"); 
                
                if(serviceName.value!='')
                {
                    submitButton.disabled=false;
                }
                else
                {
                    submitButton.disabled=true;
                }
                
            }
            
            function validInput2()
            {
                var carrierName = document.getElementById("carrierName"); 
                var domain = document.getElementById("domain"); 
                var submitButton = document.getElementById("submit2Button"); 
                
                if(carrierName.value!='' && domain.value!='')
                {
                    submitButton.disabled=false;
                }
                else
                {
                    submitButton.disabled=true;
                }
                
            }
      </script>
</body>
</html>
