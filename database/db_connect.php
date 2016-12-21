<?php
include_once ("BDinfo.php");

$connection = mysqli_connect($host, $login, $password, $db);
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL:". mysqli_connect_error();
}