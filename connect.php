<?php
$servername = "localhost"; 
$username = "klyushkin"; 
$password = "5iofa727el0H_"; 
$dbname = "klyushkinDB";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>