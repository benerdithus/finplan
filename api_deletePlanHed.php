<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$DocRefID = $_POST['DocRefID'];

$query = "DELETE FROM dbtplanhed WHERE DocRefID = '$DocRefID'";
$exe = mysqli_query($conn, $query);

if ($exe) {
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"failed"]);
}
