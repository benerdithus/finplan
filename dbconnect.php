<?php
$host = "localhost";
$user = "dsf-kiki";
$pass = "dsf-1data";
$db   = "dbcfinancialplan";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
