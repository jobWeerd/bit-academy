<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>winkelmand</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <?php
  session_start();
  include ('menu.php');
  ?>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

</style>
<body>

  <div id="myUL">
  <div class="container">

  <?php
  			include 'database.php';
  			$stmt = $dbconn->prepare('SELECT * FROM artikel');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):

                echo ($row['afschrijfdatum']);
                echo ($row['afschrijfreden']);
                endwhile
  	?>
    
  </div>
  </div>
</body>
</html>