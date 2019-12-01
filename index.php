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

    <div class="jumbotron text-center">
        <h1>Internet of Things</h1>
        <p></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h2>Team member</h2>
                <p>Hồ Ngọc Tân</p>
                <p>Trương Trung Tín</p>
                <p>Trần Xuân Thới</p>
                <p>...</p>
            </div>
            <div class="col-sm-4">
                <form method="POST">
                    <div class="form-group">
                        <label for="text">Input text</label>
                        <input type="text" class="form-control" id="text" name='text'>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
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

                $sql = "SELECT `Humidity`, `Temperature`, `Time` FROM `data` ORDER BY id DESC LIMIT 10";

                echo '<table class="table table-striped">
    <thead>
      <tr> 
        <td>Humidity</td> 
        <td>Temperature</td> 
        <td>Time</td> 
      </tr>
    </thead>';
                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $row_Humidity = $row["Humidity"];
                        $row_Temperature = $row["Temperature"];
                        $row_Time = $row["Time"];
                        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
                        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));

                        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
                        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));

                        echo '<tbody>
                <tr> 
                <td>' . $row_Humidity . '</td> 
                <td>' . $row_Temperature . "&deg;" .'</td> 
                <td>' . $row_Time . '</td> 
              </tr>
              </tbody>';
                    }
                    $result->free();
                }

                $conn->close();
                ?>
                </table>
            </div>
        </div>

</body>

</html>