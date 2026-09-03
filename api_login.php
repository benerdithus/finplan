<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$userid = $_POST['UserID'] ?? '';
$password = $_POST['Password'] ?? '';
$email = $_POST['Email'] ?? '';

$response = [];

// cek user
$sql = "SELECT * FROM dbmuser WHERE UserID=? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // verifikasi password input dengan hash di database
    if (password_verify($password, $row['Password'])) {
        $response["success"] = true;
        $response["message"] = "Login berhasil";
        $response["UserID"] = $row['UserID'];
        $response["UserName"] = $row['UserName'];
        $response["Email"] = $row['Email'];
    } else {
        $response["success"] = false;
        $response["message"] = "Password salah";
        $response["UserID"] = "-";
    }
} else {
    $response["success"] = false;
    $response["message"] = "User tidak ditemukan";
    $response["UserID"] = "-";
}

echo json_encode($response);
?>