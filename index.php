<!DOCTYPE html>
<html lang="vi">

<head>
    <title>INTERNET OF THINGS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src='Chart.min.js'></script>
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
                <p>Phùng Văn Hảo</p>
            </div>
            <div class="col-sm-4">
                <form action="mqtt.php" method="POST">
                    <div class="form-group">
                        <label for="text">Input text</label>
                        <input type="text" class="form-control" id="text" name='text'>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <?php if (!empty($_REQUEST['text'])) { ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> You have just sent <b><?= $_REQUEST['text'] ?> </b> to the LCD
                    </div>
                <?php } ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
      
                <?php $servername = "us-cdbr-iron-east-05.cleardb.net";
                    // REPLACE with your Database name
                    $dbname = "heroku_ca51e06b9c53da8";
                    // REPLACE with Database user
                    $username = "bc9d80a1ea1272";
                    // REPLACE with Database user password
                    $password = "a5619782";

                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT `Humidity`, `Temperature`, `Time` FROM `data` ORDER BY id DESC LIMIT 10"; 
                    ?>
                    
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Humidity</td>
                            <td>Temperature</td>
                            <td>Time</td>
                        </tr>
                    </thead>
                    <?php if ($result = $conn->query($sql)) {
                            while ($row = $result->fetch_assoc()) {
                                $row_Humidity = $row["Humidity"];
                                $row_Temperature = $row["Temperature"];
                                $row_Time = $row["Time"]; ?>

                            <tbody>
                                <tr>
                                    <td><?= $row_Humidity . "%" ?></td>
                                    <td><?= $row_Temperature . "&deg;C" ?></td>
                                    <td><?= $rowtime = date("H:i:s d-m-Y", strtotime("$row_Time + 7 HOUR")) ?></td>
                                </tr>
                            </tbody>
                    <?php
                            }
                            $result->free();
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div style="text-align: center">
    <label  for="Humidity">Humidity</label><br>
    <canvas name='Humidity' id="Humidity" width="1800" height="500"></canvas><br>
    </div>
    <div style="text-align: center">
    <label for="Temperature">Temperature</label><br>
    <canvas id="Temperature" width="1800" height="500"></canvas>
    </div>
    
    

    <?php
        $array_Humi = array();
        $array_Time = array();
        $array_Temp = array();
        for ($i=1; $i < 13; $i++) { 
            for ($j=1; $j < 32; $j++) { 
                $sqli = "SELECT ROUND(AVG(`Humidity`)), ROUND(AVG(`Temperature`)), `Time` FROM `data` where `Time` LIKE '%2019-$i-$j %';"; 
                $result = mysqli_query($conn,$sqli);
                foreach ($result as $key => $result) {
                    if($result["Time"]==null or $result["ROUND(AVG(`Humidity`))"]==null or $result["ROUND(AVG(`Temperature`))"]==null){
                        continue;
                    }
                    else{
                        array_push($array_Humi, $result["ROUND(AVG(`Humidity`))"]);
                        $row = $result['Time'];
                        $rowtime = date("d-m-Y", strtotime("$row"));
                        array_push($array_Time, $rowtime );
                        array_push($array_Temp,$result["ROUND(AVG(`Temperature`))"]);
                    }
                    
                }       
            }
        }
        // $new_array_time = array_slice(array_reverse($array_Time, True), 0, 10);
        // $new_array_humi = array_slice(array_reverse($array_Humi, True), 0, 10); 
        // $new_array_Temp = array_slice(array_reverse($array_Temp, True), 0, 10); 

    ?>
    <script>
// line chart data
    var Humidity = {

        labels :<?= json_encode($array_Time); ?>,
        datasets : [
            {
                fillColor : "rgba(172,194,132,0.4)",
                strokeColor : "#ACC26D",
                pointColor : "#fff",
                pointStrokeColor : "#9DB86D",
                data : <?= json_encode($array_Humi); ?>
            }
        ]
    }

    var Temperature = {
        labels :<?= json_encode($array_Time); ?>,
        datasets : [
            {
                fillColor : "rgba(172,194,132,0.4)",
                strokeColor : "#ACC26D",
                pointColor : "#fff",
                pointStrokeColor : "#9DB86D",
                data : <?= json_encode($array_Temp); ?>
            }
        ]
    }
    var humidity = document.getElementById('Humidity').getContext('2d');
    new Chart(humidity).Line(Humidity);
    var temperature = document.getElementById('Temperature').getContext('2d');
    new Chart(temperature).Line(Temperature);
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</body>

</html>