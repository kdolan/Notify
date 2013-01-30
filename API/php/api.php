<?php   

function notify($username, $notification)
{
    
    //READ ME//
    // Configuration instructions. Insert your api key and ensure
    //   that the path to the apiBridge.php is correct.
    //   *ALWAYS USE HTTPS
    
    //Do not share your API key. It can be used to send counterfit notifications.
    //If you do not know your api key or need your api key to be reset 
    //contact an me or an RTP

    ////////////////////
    //-----CONFIG-----//
    $apiKey = 'YOUR_API_KEY';
    ////////////////////
    $notification = str_replace(' ','+',$notification);
    $url = "https://csh.rit.edu/~kdolan/notify/apiBridge.php?username=".$username."&notification=".$notification."&apiKey=".$apiKey;
   // echo $url;
    $ch = curl_init($url);
    echo    $url;
    curl_exec($ch);
    curl_close($ch);
}

?>