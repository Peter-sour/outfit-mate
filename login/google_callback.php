<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'vendor/autoload.php';

// Konfigurasi Google Client
$client = new Google_Client();
$client->setClientId('785164950080-ers80v9saa5lbeuqjd9edd586mv9i4ch.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/mysql/login/google_callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Ambil data dari Google
        $email = $google_account_info->email;
        $firstname = $google_account_info->givenName;
        $lastname = $google_account_info->familyName;
        $google_id = $google_account_info->id;

        // Masukkan ke database
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "outfit_mate";

        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Cek apakah user sudah ada berdasarkan email
        $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
        if ($check->num_rows == 0) {
            // Kalau belum ada, insert
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $firstname, $lastname, $email);
            $stmt->execute();
            $stmt->close();
        }

        $_SESSION['user'] = $firstname; // Simpan session
        $_SESSION['login_via'] = 'google'; // Tandai login via Google

        $conn->close();

        // Redirect ke dashboard
        header("Location: ../dasboard/das.php");
        exit;
    } else {
        echo "Terjadi kesalahan saat login Google.";
    }
} else {
    echo "Kode tidak ditemukan di URL.";
}
?>
