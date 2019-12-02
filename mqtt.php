<?php

require("./phpMQTT.php");
$server = "tailor.cloudmqtt.com";     // change if necessary
$port = 15313;                     // change if necessary
$username = "jwlfxwbw";                   // set your username
$password = "xaoizh2liQ2y";                   // set your password
$client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()
$mqtt = new phpMQTT($server, $port, $client_id);
if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish("home/garden/fountain", "".$_REQUEST['text'] );
    $mqtt->close();
    header('Location: index.php');
} else {
    echo "Time out!\n";
}
