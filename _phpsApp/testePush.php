<?php

include "Pusher.php";

$apiKey = "key=AIzaSyBTQqvdjdaujv4msXjKZtzyp6V0yJaQt_M";
$regId = "981108594757";

$pusher = new AndroidPusher\Pusher($apiKey);
$pusher->notify($regId, "helloword");

print_r($pusher->getOutputAsArray());
?>
