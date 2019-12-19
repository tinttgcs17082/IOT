<?php

$servername = "us-cdbr-iron-east-05.cleardb.net";
// REPLACE with your Database name
$dbname = "heroku_ca51e06b9c53da8";
// REPLACE with Database user
$username = "bc9d80a1ea1272";
// REPLACE with Database user password
$password = "a5619782";
$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $Humidity = $Temperature = $Time = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $api_key_value) {
        $Humidity = test_input($_POST["Humidity"]);
        $Temperature = test_input($_POST["Temperature"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO `data` (`Humidity`, `Temperature`)
        VALUES ('" . $Humidity . "', '" . $Temperature . "')";

        if ($conn->query($sql) === TRUE) { } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }
} else {
    echo "No data";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
