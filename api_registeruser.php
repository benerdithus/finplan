<?php
header("Content-Type: application/json");
require_once "dbconnect.php";

$userid = $_POST['UserID'] ?? '';
$username = $_POST['UserName'] ?? '';
$password = $_POST['Password'] ?? '';
$email = $_POST['Email'] ?? '';

if (empty($userid) || empty($password)) {
    echo json_encode(["success" => false, "message" => "UserID dan password tidak boleh kosong."]);
    exit;
}
elseif (empty($email)) {
    echo json_encode(["success" => false, "message" => "Email tidak boleh kosong."]);
    exit;
}

// Cek apakah username sudah ada
$check_sql = "SELECT * FROM dbmUser WHERE UserID = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "UserID sudah digunakan."]);
    exit;
}

// Hash password sebelum insert
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Karena UserID bukan auto increment, kita isi sama dengan username
$insert_sql = "INSERT INTO dbmUser (UserID, UserName, Password, Email, IsLogin, IsMenu) VALUES (?, ?, ?, ?, 1, 1)";
$stmt = $conn->prepare($insert_sql);
$stmt->bind_param("ssss", $userid, $username, $hashed_password, $email);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registrasi berhasil!"]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Gagal menyimpan data: " . $stmt->error
    ]);
}
?>
