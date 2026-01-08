<?php
date_default_timezone_set('America/Los_Angeles');
$sname= "localhost";
$unmae= "u993466733_medspacrm";
$password = "medspaCRM123";
$db_name = "u993466733_medspacrm";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}
