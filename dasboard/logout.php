<?php
// Mulai sesi
session_start();

// Kosongkan semua data sesi
$_SESSION = [];

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Hapus cookie sesi jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect ke halaman login
header("Location: ../login/login.html");
exit();
?>
