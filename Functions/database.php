<?php

//Databasegegevens
$Host = "localhost";
$Pass = "usbw";
$Username = "root";
$DBName = "openavond";


mysql_connect($Host,$Username,$Pass) OR die("Geen verbinding mogelijk");
mysql_select_db($DBName) OR die("database niet gevonden");
?>
