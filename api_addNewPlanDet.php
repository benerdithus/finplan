<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$data = json_decode(file_get_contents("php://input"), true);

$DocRefID     = $data['DocRefID']     ?? '';
$IdxDet       = $data['IdxDet']       ?? 0 ;
$IdxNo        = $data['IdxNo']        ?? '';
$CategoryID   = $data['CategoryID']   ?? '';
$CostName     = $data['CostName']     ?? '';
$Amount       = $data['Amount']       ?? 0 ;
$CreatedDate  = $data['CreatedDate']  ?? '';
$CreatedBy    = $data['CreatedBy']    ?? '';

$cek = $conn->prepare("SELECT DocRefID FROM dbtplanhed WHERE DocRefID = ?");
$cek->bind_param("s", $DocRefID);
$cek->execute();

$result = $cek->get_result();

// query untuk counter IdxDet
$queryMax = "SELECT COALESCE(MAX(IdxDet), 0) + 1 AS NewIdxDet FROM dbtplandet WHERE DocRefID = ?";

$stmtMax = mysqli_prepare($conn, $queryMax);
mysqli_stmt_bind_param($stmtMax, "s", $DocRefID);
mysqli_stmt_execute($stmtMax);

$resultMax = mysqli_stmt_get_result($stmtMax);
$rowMax = mysqli_fetch_assoc($resultMax);

$IdxDet = (int)$rowMax['NewIdxDet'];
//

// Insert
$insert_sql = "INSERT INTO dbtplandet 
    (DocRefID, IdxDet, IdxNo, CategoryID, CostName, Amount, CreatedDate, CreatedBy)
    VALUES (?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($insert_sql);
$stmt->bind_param(
    "sisssiss",
    $DocRefID, $IdxDet, $IdxNo, $CategoryID, $CostName, $Amount, $CreatedDate, $CreatedBy
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Detail baru berhasil ditambahkan!"]);
} else {
    echo json_encode(["success" => false, "message" => $stmt->error]);
}
?>
