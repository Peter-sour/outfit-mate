<?php
// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$password = "";
$database = "outfit_mate";

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi password sama
if ($password !== $confirm_password) {
    die("Kata sandi dan konfirmasi tidak cocok!");
}

// Escape string
$first_name = $conn->real_escape_string($first_name);
$last_name = $conn->real_escape_string($last_name);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password); // Tidak di-hash

// Cek apakah email sudah terdaftar
$cek = "SELECT id FROM users WHERE email = '$email'";
$result = $conn->query($cek);

if ($result->num_rows > 0) {
    die("Email sudah terdaftar. Silakan gunakan email lain.");
} else {
    // Simpan ke database
    $sql = "INSERT INTO users (firstname, lastname, email, password) 
            VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login kembali. '); window.location.href = '../login/login.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>