<?php
// Koneksi ke database
require_once 'config.php'; // Pastikan file ini berisi koneksi database Anda

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

// Memeriksa apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $outfit_id = isset($_POST['outfit_id']) ? clean_input($_POST['outfit_id']) : '';
    $outfit_name = isset($_POST['outfit_name']) ? clean_input($_POST['outfit_name']) : '';
    $caption = isset($_POST['caption']) ? clean_input($_POST['caption']) : '';
    $current_image_path = isset($_POST['current_image_path']) ? clean_input($_POST['current_image_path']) : '';

    // Validasi data wajib
    if (empty($outfit_id) || empty($outfit_name)) {
        echo "Error: ID outfit dan nama outfit harus diisi!";
        exit;
    }

    // Variabel untuk menyimpan path gambar
    $image_path = $current_image_path;

    // Cek apakah ada file gambar yang diupload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Direktori penyimpanan gambar
        $upload_dir = "uploads/";

        // Pastikan direktori uploads ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Generate nama file unik berdasarkan timestamp
        $timestamp = time();
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $file_name = 'outfit_' . $timestamp . '.' . $file_extension;
        $target_file = $upload_dir . $file_name;

        // Cek tipe file (hanya izinkan gambar)
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array(strtolower($file_extension), $allowed_types)) {
            echo "Error: Hanya file gambar JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            exit;
        }

        // Cek ukuran file (max 5MB)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            echo "Error: Ukuran file tidak boleh melebihi 5MB.";
            exit;
        }

        // Upload file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Jika berhasil upload, update path gambar
            $image_path = $target_file;

            // Hapus gambar lama jika bukan gambar default dan file ada
            if ($current_image_path != "uploads/default.jpg" && file_exists($current_image_path)) {
                unlink($current_image_path);
            }
        } else {
            echo "Error: Gagal mengupload file gambar.";
            exit;
        }
    }

    // Query update data outfit
    $sql = "UPDATE outfits SET
            outfit_name = ?,
            caption = ?,
            image_path = ?,
            updated_at = NOW()
            WHERE outfit_id = ?";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameter ke statement
        $stmt->bind_param("sssi", $outfit_name, $caption, $image_path, $outfit_id);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Outfit berhasil diperbarui!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

} else {
    // Jika bukan request POST, redirect ke halaman utama
    echo "Akses tidak sah!";
}

// Tutup koneksi database
$conn->close();
?>