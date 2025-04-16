<?php
// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$password = "";
$database = "outfit-mate";

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi password sama
if ($password !== $confirm_password) {
    die("Kata sandi dan konfirmasi tidak cocok!");
}

// Cegah SQL Injection
$first_name = $conn->real_escape_string($first_name);
$last_name = $conn->real_escape_string($last_name);
$email = $conn->real_escape_string($email);
$password = md5($conn->real_escape_string($password)); // Hash MD5 (disarankan upgrade ke bcrypt)

// Simpan ke database
$sql = "INSERT INTO users (first_name, last_name, email, password) 
        VALUES ('$first_name', '$last_name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registrasi berhasil!";
    // Redirect ke login (opsional)
    // header("Location: login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
