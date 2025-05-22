<?php
// Konfigurasi Database
$db_host = 'localhost';     // Host database
$db_user = 'root';      // Username database
$db_pass = '';      // Password database
$db_name = 'outfit_mate';    // Nama database

// Membuat koneksi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset ke utf8
$conn->set_charset("utf8");
?>
