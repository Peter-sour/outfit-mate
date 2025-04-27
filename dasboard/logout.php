<?php
session_start(); // Mulai sesi

// Cek login via Google (logout Google)
if (isset($_SESSION['login_via']) && $_SESSION['login_via'] === 'google') {
    // Logout dari Google dan hapus session token Google
    unset($_SESSION['access_token']); // Hapus token akses Google
    $_SESSION['login_via'] = ''; // Kosongkan session login_via

    // Redirect ke URL logout Google
    $google_logout_url = 'https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://127.0.0.1/mysql/login/login.html';
    header('Location: ' . $google_logout_url);
    exit();
} else {
    // Logout manual (email/password)
    $_SESSION = []; // Kosongkan semua data sesi
    session_unset(); // Hapus semua variabel sesi
    session_destroy(); // Hancurkan sesi

    // Redirect ke halaman login
    header('Location: ../login/login.html');
    exit();
}
?>
