<?php
session_start(); // Mulai sesi untuk menyimpan data pengguna

$firstname= $_SESSION['user']; // Ambil nama depan dari sesi yang sudah disimpan sebelumnya

// Informasi koneksi database
$host = 'localhost'; // Host database, biasanya localhost
$username = 'root';  // Username untuk login ke database
$password = '';      // Password untuk login ke database (kosong jika tidak ada)
$dbname = 'outfit_mate'; // Nama database yang ingin diakses

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil user_id berdasarkan firstname (atau username) yang sedang login
$sql = "SELECT id FROM users WHERE firstname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $firstname);  // "s" untuk string
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah user ditemukan
if ($result->num_rows > 0) {
    // Ambil user_id
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
} else {
    // Jika user tidak ditemukan, hentikan eksekusi
    echo "User tidak ditemukan!";
    exit;
}

?>
