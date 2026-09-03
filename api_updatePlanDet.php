<?php
require_once "dbconnect.php";

$DocRefID = $_POST['DocRefID'];
$IdxNo = $_POST['IdxNo'];
$CostName = $_POST['CostName'];
$CategoryID = $_POST['CategoryID'];
$Amount = $_POST['Amount'];


$query = "UPDATE dbtplandet 
          SET CostName = '$CostName', CategoryID = '$CategoryID', Amount = '$Amount'
          WHERE DocRefID = '$DocRefID' AND IdxNo = '$IdxNo'";

if (mysqli_query($conn, $query)) {
    echo json_encode([
        "status" => "success",
        "message" => "Detail Plan berhasil diupdated"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
