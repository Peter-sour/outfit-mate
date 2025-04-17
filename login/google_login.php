<?php
require_once 'vendor/autoload.php';  // Menambahkan autoloader dari Composer

// Inisialisasi Google Client
$client = new Google_Client();
$client->setClientId('785164950080-ers80v9saa5lbeuqjd9edd586mv9i4ch.apps.googleusercontent.com');  // Ganti dengan Client ID Google
$client->setClientSecret('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');  // Ganti dengan Client Secret Google
$client->setRedirectUri('http://localhost/mysql/login/google_callback.php');  // Ganti dengan URL redirect yang telah kamu set di Google Developer Console
$client->addScope('email');
$client->addScope('profile');

// Membuat URL login Google
$login_url = $client->createAuthUrl();

header('Location: ' . filter_var($login_url, FILTER_SANITIZE_URL));
?>