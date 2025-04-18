<?php
session_start();

// Koneksi
$host = "localhost";
$user = "root";
$password = "";
$database = "outfit_mate";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$agreed_terms = isset($_POST['terms']);
$errors = [];

// Validasi input
if (empty($first_name)) $errors[] = "Nama depan harus diisi";
if (empty($last_name)) $errors[] = "Nama belakang harus diisi";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid";
if (empty($password) || empty($confirm_password)) $errors[] = "Password dan konfirmasi harus diisi";
if (!$agreed_terms) $errors[] = "Anda harus menyetujui syarat dan ketentuan";

// Validasi password
if ($password !== $confirm_password) $errors[] = "Kata sandi dan konfirmasi tidak cocok";
if (strlen($password) < 8) $errors[] = "Password harus minimal 8 karakter";
if (!preg_match("/[A-Z]/", $password)) $errors[] = "Password harus mengandung minimal 1 huruf besar";
if (!preg_match("/[a-z]/", $password)) $errors[] = "Password harus mengandung minimal 1 huruf kecil";
if (!preg_match("/[0-9]/", $password)) $errors[] = "Password harus mengandung minimal 1 angka";
if (!preg_match("/[\W_]/", $password)) $errors[] = "Password harus mengandung minimal 1 karakter khusus";

// Tampilkan error jika ada
if (!empty($errors)) {
    $_SESSION['error_message'] = implode("<br>", $errors);
    header("Location: register.php");
    exit();
}

// Escape input
$first_name = $conn->real_escape_string($first_name);
$last_name = $conn->real_escape_string($last_name);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password); // tidak di-hash

// Cek email duplikat
$cek = "SELECT id FROM users WHERE email = '$email'";
$result = $conn->query($cek);

if ($result->num_rows > 0) {
    $_SESSION['error_message'] = "Email sudah terdaftar. Silakan gunakan email lain.";
    header("Location: register.php");
    exit();
}

// Simpan user
$sql = "INSERT INTO users (firstname, lastname, email, password) 
        VALUES ('$first_name', '$last_name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login kembali.'); window.location.href = '../login/login.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
