<?php
require  '../vendor/autoload.php';

file_put_contents('debug_log.txt', "File dijalankan\n", FILE_APPEND);

header('Content-Type: application/json');

// Tangkap data
$nama = $_POST['user_name'] ?? '';
$email = $_POST['user_email'] ?? '';
$pesan = $_POST['message'] ?? '';

// Log data
file_put_contents('debug_log.txt', "Nama: $nama | Email: $email | Pesan: $pesan\n", FILE_APPEND);

// Validasi
if (empty($nama) || empty($email) || empty($pesan)) {
    echo json_encode(['status' => 'error', 'message' => 'Field kosong']);
    exit;
}

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    file_put_contents('debug_log.txt', "Koneksi MongoDB berhasil\n", FILE_APPEND);

    $collection = $client->kontak->pesan;

    $collection->insertOne([
        'nama' => $nama,
        'email' => $email,
        'pesan' => $pesan,
        'waktu' => date('Y-m-d H:i:s')
    ]);

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    file_put_contents('debug_log.txt', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
// Tutup koneksi