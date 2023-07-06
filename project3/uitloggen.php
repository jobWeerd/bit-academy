<?php
session_start();
include "database.php";
session_destroy();
session_unset();
header('refresh: 1; url=login.php');
?>