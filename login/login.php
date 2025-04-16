<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "outfit_mate";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Escape input
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Cek data di database
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login berhasil! Selamat datang 💖";
    // Bisa redirect ke halaman lain juga, misalnya:
    // header("Location: dashboard.php");
} else {
    echo "Email atau password salah! 😢";
}

$conn->close();
?>
