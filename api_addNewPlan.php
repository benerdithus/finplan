<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$data = json_decode(file_get_contents("php://input"), true);

$DocRefID     = $data['DocRefID']     ?? '';
$DocPlanName  = $data['DocPlanName']  ?? '';
$UserID       = $data['UserID']       ?? '';
$DocRefDate   = $data['DocRefDate']   ?? '';
$IdxNo        = $data['IdxNo']        ?? '';
$CreatedDate  = $data['CreatedDate']  ?? '';
$CreatedBy    = $data['CreatedBy']    ?? '';
$UpdateDate   = $data['UpdateDate']   ?? '';
$UpdateBy     = $data['UpdateBy']     ?? '';
$PlanType     = $data['PlanType']     ?? '';

// Cek nama planning
$check_sql = "SELECT * FROM dbtplanhed WHERE DocPlanName = ? AND UserID = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("ss", $DocPlanName, $UserID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Judul tersebut sudah anda gunakan."]);
    exit;
}

// Insert
$insert_sql = "INSERT INTO dbtplanhed 
    (DocRefID, DocPlanName, UserID, DocRefDate, IdxNo,
     AmountNet, AmountExp, AmountInc, CountItem,
     CreatedDate, CreatedBy, UpdateDate, UpdateBy, PlanType)
    VALUES (?,?,?,?,?, 0,0,0,0, ?,?,?,?,?)";

$stmt = $conn->prepare($insert_sql);
$stmt->bind_param(
    "ssssssssss",
    $DocRefID, $DocPlanName, $UserID, $DocRefDate, $IdxNo,
    $CreatedDate, $CreatedBy, $UpdateDate, $UpdateBy, $PlanType
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Planning baru berhasil ditambahkan!"]);
} else {
    echo json_encode(["success" => false, "message" => $stmt->error]);
}
?>
