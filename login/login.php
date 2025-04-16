<?php
// Konfigurasi koneksi database
$host = "localhost";     // biasanya "localhost"
$user = "root";          // username database
$password = "";          // password database
$database = "outfit-mate"; // nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Cegah SQL Injection
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Cek apakah user ada di database
$sql = "SELECT * FROM users WHERE email='$email' AND password=MD5('$password')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login berhasil
    session_start();
    $_SESSION['email'] = $email;
    echo "Login berhasil. Selamat datang, $email!";
    // Redirect ke halaman dashboard atau lainnya
    // header("Location: dashboard.php");
} else {
    // Login gagal
    echo "Email atau kata sandi salah!";
}

$conn->close();
?>
