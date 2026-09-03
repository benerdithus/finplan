<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$DocRefID = $_POST['DocRefID'];
$DocPlanName = $_POST['DocPlanName'];

$query = "UPDATE dbtplanhed SET DocPlanName = '$DocPlanName' WHERE DocRefID='$DocRefID'";
$exe = mysqli_query($conn, $query);

if ($exe) {
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"failed"]);
}
