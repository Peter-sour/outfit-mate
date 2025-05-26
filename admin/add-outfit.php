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

function dapatkanOutfitIdTerbaru($koneksi) {
    $sql = "SELECT MAX(outfit_id) AS max_id FROM outfits";
    $result = $koneksi->query($sql);
    if (!$result) {
        die('Error pada query: ' . $koneksi->error); // Menangani error pada query
    }
    $row = $result->fetch_assoc();
    return $row['max_id'] ? $row['max_id'] + 1 : 1; // jika tidak ada data, mulai dari 1
}

// 3. Fungsi untuk mendapatkan ID user
// function dapatkanUserId($username, $koneksi) {
//     $stmt = $koneksi->prepare("SELECT id FROM users WHERE firstname = ?");
//     $stmt->bind_param("s", $username);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         return $row['id'];
//     }
//     return null;
// }

// 4. Proses Form Tambah Outfit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan ID user yang login
<<<<<<< HEAD
    // $user_id = dapatkanUserId($_SESSION['user'], $koneksi);
    // $outfit_id = dapatkanOutfitIdTerbaru($koneksi);


    // if (!$user_id) {
    //     die("User tidak ditemukan");
    // }
=======
    // $user_id = dapatkanUserId();
    $outfit_id = dapatkanOutfitIdTerbaru($koneksi);




>>>>>>> abce42363b9f879a2cdcaccd47a80127e4ee1b3c

    // 5. Ambil Data dari Form
    $nama_outfit = $koneksi->real_escape_string($_POST['name']);
    $umur = $koneksi->real_escape_string($_POST['umur']);
    $kelamin = $koneksi->real_escape_string($_POST['kelamin']);
    $cuaca = $koneksi->real_escape_string($_POST['weather']);
    $acara = $koneksi->real_escape_string($_POST['event']);

    // 6. Handle Upload Gambar
    $lokasi_gambar = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Buat folder upload jika belum ada
        $direktori_upload = '../dasboard/uploads/outfits/';
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
<<<<<<< HEAD
    $stmt = $koneksi->prepare("INSERT INTO outfits (gender, event_type, outfit_name,age_group, caption, image_path,weather)
                              VALUES (?, ?, ?,?, ?, ?,?)");
    $stmt->bind_param("sssssss", $kelamin, $acara,$nama_outfit,$umur, $acara, $lokasi_gambar,$cuaca);
=======
    $stmt = $koneksi->prepare("INSERT INTO outfits (outfit_id, gender, event_type, outfit_name, caption, image_path,weather, age_group)
                              VALUES (?, ?, ?, ?, ?, ?,?,?)");
    $stmt->bind_param("isssssss", $user_id,$kelamin, $acara, $nama_outfit, $acara, $lokasi_gambar,$cuaca,$umur);
>>>>>>> abce42363b9f879a2cdcaccd47a80127e4ee1b3c

    if($stmt->execute()) {
        header("Location: ../admin/admin.php?page=koleksi&sukses=1");
        exit;
    } else {
        header("Location: ../admin/admin.php?page=koleksi&error=1");
        exit;
    }
} else {
    header("Location: dasboard.php");
    exit;
}

// 🔧 Ini bagian yang diperbaiki:
$conn->close();
?>