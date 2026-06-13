<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "cake";

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die("Failed to Connect: " . mysqli_connect_error());
}
?>