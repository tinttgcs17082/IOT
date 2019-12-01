<?php
const HOST     = 'us-cdbr-iron-east-05.cleardb.net';
const USERNAME = 'b660d87a23e80f';
const PASSWORD = '6a65c1a0';
const DATABASE = 'heroku_4c775eb85947f23';

function query($query) {

	$conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf-8');

    mysqli_query($conn, $query);
    
	$conn->close();
}

if (!empty($_REQUEST)) {
  $text = $_REQUEST['text'];
  // insert, update, delete & select
  if ($text != "") {
    $query = 'insert into `text`(`Text`) values("' . $text . '")';
    query($query);
    header("Location: index.php");
  }
}

function select($query) {

	$conn = new mysqli('us-cdbr-iron-east-05.cleardb.net', 'b660d87a23e80f', '6a65c1a0', 'heroku_4c775eb85947f23');
	$cusor  = mysqli_query($conn, $query);
	$result = [];
	while ($row = mysqli_fetch_array($cusor, 1)) {
		$result[] = $row;
    }
    
	$conn->close();
	return $result;
}

if (!empty($_REQUEST)) {
  $Temperature = $_REQUEST['Temperature'];
  $Humidity = $_REQUEST['Humidity'];
  $Humidity = $_REQUEST['Time'];
  // insert, update, delete & select
  if ($text != "") {
    $query = "insert into `data`(`Temperature`,`Humidity`,`Time`) values('" . $Temperature . "','" . $Humidity . "','" . $Humidity . "' )";
    query($query);
    header("Location: index.php");
  }
}

?>

<!DOCTYPE html>
<html lang="vn">

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
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Temperature</th>
              <th>Humidity</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query  = 'select * from `data`';
            $result = select($query);

            for ($i = 0; $i < count($result); $i++) {
              echo '<tr>
				<td>' . $result[$i]['Temperature'] . '</td>
				<td>' . $result[$i]['Humidity'] . '</td>
				<td>' . $result[$i]['Time'] . '</td>
			</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

</body>

</html>