<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "mawar1";

$conn = mysqli_connect($server, $username, $password, $database) or
die("Gagal koneksi ke server MySQL!".mysqli_error());

?> 
