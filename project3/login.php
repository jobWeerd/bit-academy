<?php
include "database.php";
session_start();
?>

<main class="main-content">
    <div id = "login">
        <form action="authorisatie.php" method="POST" class="formlogin">
            <label for="fInlog" size="25">Gebruikersnaam:</label>
            <input type="text" name="inlognaam" id="fInlog" size="25" placeholder="gebruikersnaam..."><br><br>
            <label for="fWachtwoord" size="25">Wachtwoord:</label><br>
            <input type="password" name="wachtwoord" id="fWachtwoord" size="25"><br><br>
            <input type="submit" name="submit" value="Login"><br>
        </form>
    </div>
</main>