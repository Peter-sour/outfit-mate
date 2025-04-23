<?php
session_start();

// 2. Koneksi ke Database OutfitMate
$host = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = "";     // Ganti dengan password database Anda
$database = "outfit_mate"; // Nama database Anda

$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// 3. Fungsi untuk mendapatkan ID user
function dapatkanUserId($username, $koneksi) {
    $stmt = $koneksi->prepare("SELECT id FROM users WHERE firstname = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    }
    return null;
}

// 4. Proses Form Tambah Outfit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan ID user yang login
    $user_id = dapatkanUserId($_SESSION['user'], $koneksi);
    
    if (!$user_id) {
        die("User tidak ditemukan");
    }

    // 5. Ambil Data dari Form
    $nama_outfit = $koneksi->real_escape_string($_POST['name']);
    $kategori = $koneksi->real_escape_string($_POST['category']);
    $warna = $koneksi->real_escape_string($_POST['color']);
    $cuaca = $koneksi->real_escape_string($_POST['weather']);
    $acara = $koneksi->real_escape_string($_POST['occasion']);

    // 6. Handle Upload Gambar
    $lokasi_gambar = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Buat folder upload jika belum ada
        $direktori_upload = 'uploads/outfits/';
        if (!file_exists($direktori_upload)) {
            mkdir($direktori_upload, 0777, true);
        }

        // Validasi tipe file
        $tipe_diizinkan = ['image/jpeg', 'image/png', 'image/gif'];
        $tipe_file = $_FILES['image']['type'];
        
        if (in_array($tipe_file, $tipe_diizinkan)) {
            $ekstensi = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $nama_file = uniqid('outfit_') . '.' . $ekstensi;
            $path_file = $direktori_upload . $nama_file;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $path_file)) {
                $lokasi_gambar = $path_file;
            }
        }
    }

    // 7. Simpan ke Database
    $stmt = $koneksi->prepare("INSERT INTO outfits (user_id, name, category, color, weather, occasion, image_path) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $nama_outfit, $kategori, $warna, $cuaca, $acara, $lokasi_gambar);

    if ($stmt->execute()) {
        header("Location: ../dasboard/das.php?page=koleksi&sukses=1");
        exit;
    } else {
        header("Location: ../dasboard/das.php?page=koleksi&error=1");
        exit;
    }
} else {
    header("Location: dasboard.php");
    exit;
}

// 🔧 Ini bagian yang diperbaiki:
$conn->close();
?>
