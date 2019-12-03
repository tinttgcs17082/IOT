<?php

$servername = "us-cdbr-iron-east-05.cleardb.net";

$dbname = "heroku_4c775eb85947f23";
$username = "b660d87a23e80f";
$password = "6a65c1a0";
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
