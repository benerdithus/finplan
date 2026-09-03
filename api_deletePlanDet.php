<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$DocRefID = $_POST['DocRefID'];
$IdxNo = $_POST['IdxNo'];

$query = "DELETE FROM dbtplandet WHERE DocRefID = '$DocRefID' AND IdxNo = '$IdxNo'";
$exe = mysqli_query($conn, $query);

if ($exe) {
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"failed"]);
}
