<?php
require_once "dbconnect.php";

$DocRefID = $_POST['DocRefID'];
$AmountNet = $_POST['AmountNet'];

$query = "UPDATE dbtplanhed 
          SET AmountNet = '$AmountNet'
          WHERE DocRefID = '$DocRefID'";

if (mysqli_query($conn, $query)) {
    echo json_encode([
        "status" => "success",
        "message" => "AmountNet berhasil diupdated"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
