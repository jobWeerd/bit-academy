<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>winkelmand</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <style>
            .custom-file-input.selected:lang(en)::after {
                content: "" !important;
            }
        
            .custom-file {
                overflow: hidden;
            }
        
            .custom-file-input {
                white-space: nowrap;
            }
        </style>
</head> 
<body>
<?php
session_start();
include('menu.php');
include('database.php');

if (!isset($_SESSION['inlognaam'])) {
    header("Location: login.php");
}

$query = "SELECT * FROM artikel";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $dateSearch = date('Y-m-d', strtotime($search));

    if (!empty($search)) {
        $query .= " WHERE artikelnaam LIKE '%$search%' OR datum LIKE '%$dateSearch%' OR artikelgroep LIKE '%$search%'";
    }
}
$mini = 0;
if (isset($_POST['minimum'])) {
    $mini = $_POST['minimum'];
    
}

$result = mysqli_query($dbconn, $query);
?>
<div class="container" style="width:1000px;">
    <br />
    <!-- ... -->
<form action="upload.php" method="post" enctype="multipart/form-data">
  <div class="input-group">
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="customFileInput" name="file" accept=".csv,.xlsx">
      <label class="custom-file-label" for="customFileInput">Select File:</label>
    </div>
    <div class="input-group-append">
      <button type="submit" name="submit" class="btn btn-primary">Upload</button>
    </div>
  </div>
</form>
<!-- ... -->

<br>
    <form method="post" action="" align="center">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Zoek product, datum of artikelgroep (YYYY-MM-DD)...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Zoeken</button>
            </div>
        </div>
        <div class="input-group mb-1">
            <input type="number" class="form-control" name="minimum" placeholder="minumun voorraad">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">submit</button>
            </div>
        </div>
    </form>
    <form method="post" action="update.php" align="center">
        <input type="submit" name="update" value="Update" class="btn btn-success" />
        <br /><br />
        <div class="table-responsive" id="employee_table">
            <table class="table table-bordered">
                <tr>
                    <th width="5%">ID</th>
                    <th width="35%">Naam</th>
                    <th width="5%">Kleur</th>
                    <th width="10%">Prijs</th>
                    <th width="10%">BTW</th>
                    <th width="10%">Datum</th>
                    <th width="20%">Voorraad</th>
                    <th width="20%">Afschrijven</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["artikelnaam"]; ?></td>
                        <td><?php echo $row["kleur"]; ?></td>
                        <td><?php echo $row["prijs"]; ?></td>
                        <td><?php echo $row["BTW"]; ?></td>
                        <td>
                            <input type="date" class="form-control" name="datum[]" value="<?php echo $row['datum']; ?>">
                        <td>
                            <input type="number" class="form-control" name="voorraad[]" value="<?php echo $row['voorraad']; ?>">
                            <input type="hidden" name="id[]" value="<?php echo $row['id']; ?>">
                            <span <?php if ($row['voorraad'] > $mini){ ?>style="display: none;"<?php } ?>>
                                onder minumun voorraad
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="afschrijving_aantal[]" value="0" min="0">
                            <input type="date" class="form-control" name="afschrijving_datum[]">
                            <input type="text" class="form-control" name="afschrijving_reden[]">
                            <input type="hidden" name="afschrijving_medewerker[]" value="<?php echo $_SESSION['inlognaam']; ?>">
                        </td>
                    </tr>
                <?php
                } ?>
            </table>
        </div>
    </form>
</div>


</body>
</html>
