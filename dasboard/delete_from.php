<?php
session_start(); // Memulai session untuk mengambil firstname

$conn = new mysqli ("localhost","root", "", "outfit_mate"); // Ganti dengan username dan password database Anda

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

    // if(isset($_POST['user'])){
    //     $firstname = $_SESSION['user'];

    //     //hapus outfit dari database
    //     $sql = "DELETE outfit_id FROM outfits o JOIN users u ON u.id = o.user_id WHERE u.firstname = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("s", $firstname);

    //     if ($stmt->execute()) {
    //         echo "<script>alert('Outfit berhasil dihapus!');</script>";
    //     } else {
    //         echo "<script>alert('Gagal menghapus outfit!');</script>";
    //     }    
    //     $stmt->close();
    // }else {
    //     echo "<script>alert('Tidak ada outfit yang dipilih!');</script>";
    // }
    if (isset($_POST['outfit_id']) && isset($_SESSION['user'])) {
        $outfit_id = $_POST['outfit_id'];
        $firstname = $_SESSION['user']; // Dapatkan user login saat ini
    
        // Pastikan outfit yang dihapus memang milik user yang sedang login
        $sql = "DELETE o.* 
                FROM outfits o
                JOIN users u ON u.id = o.user_id
                WHERE o.outfit_id = ? AND u.firstname = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $outfit_id, $firstname);
    
        if ($stmt->execute()) {
            echo "<script>alert('Outfit berhasil dihapus!'); window.location.href='halaman_outfit.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus outfit!'); window.history.back();</script>";
        }
    
        $stmt->close();
    } else {
        echo "<script>alert('Tidak ada outfit yang dipilih!'); window.history.back();</script>";
    }
    $conn->close();
    header("Location: ../dasboard/koleksi.php");
    exit();
?>