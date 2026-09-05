<?php
require_once "dbconnect.php";

$DocRefID = $_POST['DocRefID'];
$AmountExp = $_POST['AmountExp'];

$query = "UPDATE dbtplanhed 
          SET AmountExp = '$AmountExp'
          WHERE DocRefID = '$DocRefID'";

if (mysqli_query($conn, $query)) {
    echo json_encode([
        "status" => "success",
        "message" => "AmountExp berhasil diupdated"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
