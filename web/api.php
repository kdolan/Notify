<?php   

function notify($username, $notification)
{

    ////////////////////
    //-----CONFIG-----//
    $apiKey = 'key';
    ////////////////////
    $notification = str_replace(' ','+',$notification);
    $url = "http://csh.rit.edu/~kdolan/notify/apiBridge.php?username=".$username."&notification=".$notification."&apiKey=".$apiKey;
   // echo $url;
    $ch = curl_init($url);
    echo    $url;
    curl_exec($ch);
    curl_close($ch);
}

?>