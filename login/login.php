<?php
// Mulai sesi baru
session_start();
session_regenerate_id(true); // Cegah session fixation

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
session_start(); // Tambahkan di atas kalau belum ada

$sql = "SELECT firstname, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($password === $row['password']) { // Kalau belum pakai hashing
        $_SESSION['user'] = $row['firstname']; // Simpan nama depan ke session
        $_SESSION['login_via'] = 'manual'; //tandai login manual
        // Redirect ke dashboard PHP (bukan HTML)
        header("Location: ../dasboard/das.php");
        exit;
    } else {
        echo "Password salah! 😢";
    }
} else {
    echo "Email tidak ditemukan! 😢";
}


$conn->close();
?>
