<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";  // Sesuaikan dengan username database Anda
$password = "";  // Sesuaikan dengan password database Anda
$dbname = "your_database";  // Sesuaikan dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil cuaca yang dipilih
    $cuaca = $_POST['cuaca'];

    // Query untuk mendapatkan outfit yang sesuai dengan cuaca yang dipilih
    $sql = "SELECT o.name, o.category, o.color, o.image_path 
            FROM outfits o 
            JOIN weather w ON o.weather = w.condition_weather 
            WHERE w.condition_weather = ?";
    
    // Siapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cuaca);  // "s" untuk string (cuaca yang dipilih)
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika ada hasil
    if ($result->num_rows > 0) {
        echo "<h3>Rekomendasi Outfit untuk Cuaca: $cuaca</h3>";
        echo "<div class='outfit-list'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='outfit-card'>";
            echo "<h4>" . $row['name'] . "</h4>";
            echo "<p>Category: " . $row['category'] . "</p>";
            echo "<p>Color: " . $row['color'] . "</p>";
            echo "<img src='" . $row['image_path'] . "' alt='" . $row['name'] . "' style='width: 150px; height: 150px;'>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Maaf, tidak ada outfit yang tersedia untuk cuaca ini.</p>";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>