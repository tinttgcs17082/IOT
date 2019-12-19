<?php

require("./phpMQTT.php");
$server = "tailor.cloudmqtt.com";
$port = 15313;
$username = "jwlfxwbw";
$password = "xaoizh2liQ2y";
$client_id = "phpMQTT-publisher";
$mqtt = new phpMQTT($server, $port, $client_id);
if ($mqtt->connect(true, NULL, $username, $password)) {
    $mqtt->publish("home/garden/fountain", "" . $_REQUEST['text']);
    $mqtt->close();
    $servername = "us-cdbr-iron-east-05.cleardb.net";
    // REPLACE with your Database name
    $dbname = "heroku_ca51e06b9c53da8";
    // REPLACE with Database user
    $username = "bc9d80a1ea1272";
    // REPLACE with Database user password
    $password = "a5619782";

    $text = "";
    $text = test_input($_REQUEST["text"]);

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `text` (`Text`) VALUES ('" . $text . "')";

    if ($conn->query($sql) === TRUE) { } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header('Location: index.php?text=' . $_REQUEST['text'] . '');
} else {
    echo "Time out!\n";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
