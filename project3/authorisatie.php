<?php
//$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email)
//VALUES (:firstname, :lastname, :email)");
//$stmt->bindParam(':firstname', $firstname);
//$stmt->bindParam(':lastname', $lastname);
//$stmt->bindParam(':email', $email);




session_start();
include "database.php";

if ($_POST['submit']) {
    $inlognaam = isset($_POST['inlognaam']) ? $_POST['inlognaam'] : '';
    $wachtwoord = isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '';
} else {
    header('refresh: 1, login.php');
}

$query = "SELECT gebruiker.id, gebruiker.inlognaam, gebruiker.wachtwoord, rol.naam
            FROM gebruiker
            INNER JOIN rol ON gebruiker.rol_id = rol.id
            WHERE inlognaam = '".$inlognaam."' AND wachtwoord = '".$wachtwoord."';";

$result = mysqli_query($dbconn, $query);
$aantal = mysqli_num_rows($result);
if ($aantal == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $rol = $row['naam'];
    }
    $_SESSION['inlognaam'] = $inlognaam;
    $_SESSION['wachtwoord'] = $wachtwoord;
    $_SESSION['rol'] = $rol;
    $_SESSION['ingelogd'] = true;
    header('refresh: 1, url=kassa.php');
    exit;
} else {
    echo 'Helaas, uw gebruikersnaam en/of wachtwoord zijn niet juist! U wordt doorgestuurd.<br>';
    session_destroy();
    session_unset();
    mysqli_close($dbconn);
    header('refresh: 1, login.php');
    
}
?>