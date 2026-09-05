<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

// Cek apakah parameter UserID ada
if (!isset($_GET['UserID'])) {
    echo json_encode([
        "error" => true,
        "message" => "Parameter 'UserID' tidak ditemukan"
    ]);
    exit;
}

$userid = $_GET['UserID'];
$docrefid = $_GET['DocRefID'];

// Query transaksi milik user tersebut
$query = "SELECT * FROM dbtplanhed WHERE UserID = '$userid' AND DocRefID = '$docrefid'";
$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>

