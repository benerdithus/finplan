<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

// Cek apakah parameter DocRefID ada
if (!isset($_GET['DocRefID'])) {
    echo json_encode([
        "error" => true,
        "message" => "Parameter 'DocRefID' tidak ditemukan"
    ]);
    exit;
}

$DocRefID = $_GET['DocRefID'];

// Query transaksi milik user tersebut
$query = "SELECT * FROM dbtplandet WHERE DocRefID = '$DocRefID' ORDER BY DocRefID, IdxDet ";
$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>

