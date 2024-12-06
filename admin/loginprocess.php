<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Cek username di database
$sql = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    // Verifikasi password
    if ($password == $user['password']) {  // Gunakan password_hash jika ingin lebih aman
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<div class='container mt-5'><div class='alert alert-danger' role='alert'>Password salah!</div></div>";
        echo "<div class='text-center'><a href='login.php' class='btn btn-primary mt-3'>Kembali ke Login</a></div>";
    }
} else {
    echo "<div class='container mt-5'><div class='alert alert-danger' role='alert'>Username tidak ditemukan!</div></div>";
    echo "<div class='text-center'><a href='login.php' class='btn btn-primary mt-3'>Kembali ke Login</a></div>";
}

$stmt->close();
$conn->close();
?>
