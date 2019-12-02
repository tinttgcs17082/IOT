<?php

require("./phpMQTT.php");
$server = "tailor.cloudmqtt.com";     
$port = 15313;                    
$username = "jwlfxwbw";                
$password = "xaoizh2liQ2y";                
$client_id = "phpMQTT-publisher";
$mqtt = new phpMQTT($server, $port, $client_id);
if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish("home/garden/fountain", "".$_REQUEST['text'] );
    $mqtt->close();
    header('Location: index.php?text='.$_REQUEST['text'].'');
} else {
    echo "Time out!\n";
}

?>