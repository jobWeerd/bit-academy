<?php
include('database.php');

if (isset($_POST["update"])) {
    $voorraad = $_POST["voorraad"];
    $afschrijving_aantal = $_POST["afschrijving_aantal"];
    $ids = $_POST["id"];
    $dates = $_POST["datum"];
    $reden = $_POST['afschrijving_reden'];
    $afschrijving_datum = $_POST['afschrijving_datum'];

    for ($i = 0; $i < count($voorraad); $i++) {
        $id = $ids[$i];
        $newVoorraad = mysqli_real_escape_string($dbconn, $voorraad[$i]);
        $afschrijvingAantal = mysqli_real_escape_string($dbconn, $afschrijving_aantal[$i]);
        $newDate = mysqli_real_escape_string($dbconn, $dates[$i]);
        $afschrijvingReden = mysqli_real_escape_string($dbconn, $reden[$i]);
        $afschrijvingDatum = mysqli_real_escape_string($dbconn, $afschrijving_datum[$i]);

        $updatedVoorraad = $newVoorraad - $afschrijvingAantal;
        $updateQuery = "UPDATE artikel SET voorraad = '$updatedVoorraad', datum = '$newDate', afschrijfreden = '$afschrijvingReden', afschrijfdatum = '$afschrijvingDatum' WHERE id = '$id'";
        mysqli_query($dbconn, $updateQuery);
    }

    header('Location: voorraad.php');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=test.csv');
    $output = fopen("test.csv", "w");
    fputcsv($output, array('ID', 'Artikelnaam', 'Prijs', 'Voorraad'));
    $query = "SELECT id, artikelnaam, prijs, voorraad from artikel";

    $result = mysqli_query($dbconn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>
