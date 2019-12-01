<!DOCTYPE html>
<html><body>
<?php

$servername = "us-cdbr-iron-east-05.cleardb.net";

// REPLACE with your Database name
$dbname = "heroku_4c775eb85947f23";
// REPLACE with Database user
$username = "b660d87a23e80f";
// REPLACE with Database user password
$password = "6a65c1a0";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT `Humidity`, `Temperature`, `Time` FROM `data` ORDER BY id DESC";

echo '<table cellspacing="3" cellpadding="3">
      <tr> 
        <td>Humidity</td> 
        <td>Temperature</td> 
        <td>Time</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_Humidity = $row["Humidity"];
        $row_Temperature = $row["Temperature"];
        $row_Time = $row["Time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_Humidity . '</td> 
                <td>' . $row_Temperature . '</td> 
                <td>' . $row_Time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>