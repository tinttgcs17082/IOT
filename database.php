
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php

$servername = "us-cdbr-iron-east-05.cleardb.net";

// REPLACE with your Database name
$dbname = "heroku_4c775eb85947f23";
// REPLACE with Database user
$username = "b660d87a23e80f";
// REPLACE with Database user password
$password = "6a65c1a0";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $Humidity = $Temperature = $Time = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
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
        
        if ($conn->query($sql) === TRUE) {
            echo $_REQUEST['text'];
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
    <a class="btn btn-default" href="index.php">Back</a>
</body>


