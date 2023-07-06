<?php
//initialiseren
define('HOST', 'localhost');
define('DATABASE', 'kassasysteem');
define('USER', 'root');
define('PASSWORD', '');


//connectie maken
try{
    $dbconn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
} 
catch (exception $e){
    $dbconn = $e;
}

//function om db te sluiten
function fnCloseDb($conn) {
    if(!$conn==false){
        mysqli_close($conn) or die('Sluiten DB is niet gelukt');
    }
}

?>