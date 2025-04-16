<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan username database
$pass = ""; // Kosongkan jika tidak ada password
$db   = "outfit_mate";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

//ambil data Dari from
$user = $_POST['email'];
$pass = $_POST['password'];

// Query untuk insert data
$sql = "INSERT INTO users (email, password)
        VALUES ('$user', '$pass')";
if ($conn->query($sql) === TRUE) {
    echo "Order berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>