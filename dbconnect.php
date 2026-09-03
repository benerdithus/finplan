<?php
$host = "localhost";
$user = "u765019721_kiki";
$pass = "Dsf-1data";
$db   = "u765019721_finplan";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
