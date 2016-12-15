<?php
//Databasegegevens
$Host = "localhost";
$Pass = "usbw";
$Username = "root";
$DBName = "qrcode";

$connectie = mysqli_connect("$Host", "$Username", "$Pass", "$DBName");

if (!$connectie) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}
?>