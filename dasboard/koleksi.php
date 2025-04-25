<?php
session_start(); // Memulai session untuk mengambil firstname

// Membuat koneksi ke database
$conn = new mysqli("localhost", "root", "", "outfit_mate"); // Ganti dengan username dan password database Anda

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil firstname dari session
$firstname = $_SESSION['user']; 

// Menggunakan JOIN untuk mengambil data outfit dan user_id sekaligus
$sql = "
    SELECT o.name, o.category, o.color, o.image_path
    FROM outfits o
    JOIN users u ON u.id = o.user_id
    WHERE u.firstname = ?  ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $firstname);
$stmt->execute();
$result = $stmt->get_result();

// Menampilkan data outfit
if ($result->num_rows > 0) {
    // echo "<div class='outfit-list'>";
    // while ($row = $result->fetch_assoc()) {
    //     echo "<div class='outfit-card'>";
    //     echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
    //     echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
    //     echo "<p>Color: " . htmlspecialchars($row['color']) . "</p>";
    //     echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width: 150px; height: 150px;'>";
    //     echo "</div>";
    // }
    // echo "</div>";
    echo "<div class='outfit-grid'>";
    while ($row = $result->fetch_assoc()) {
        // CSS for styling
        echo "<style>
        .outfit-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }
        .outfit-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .outfit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .outfit-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .outfit-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .outfit-card:hover .outfit-image img {
            transform: scale(1.05);
        }
        .outfit-info {
            padding: 18px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .outfit-name {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .outfit-detail {
            font-size: 14px;
            color: #666;
            margin: 3px 0;
            display: flex;
            align-items: center;
        }
        .outfit-detail span {
            font-weight: 500;
            color: #444;
            margin-left: 5px;
        }
        .color-dot {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-right: 8px;
        }
        </style>";
        
        // Display outfit information
        echo "<div class='outfit-card'>";
        echo "<div class='outfit-image'>";
        echo "<img src='" . $row['image_path'] . "' alt='" . $row['name'] . "'>";
        echo "</div>";
        echo "<div class='outfit-info'>";
        echo "<h3 class='outfit-name'>" . $row['name'] . "</h3>";
        echo "<p class='outfit-detail'>Category: <span>" . $row['category'] . "</span></p>";
        
        // Create color display with dot
        $colorValue = $row['color'];
        $colorMap = [
            'hitam'     => '#000000',
            'putih'     => '#ffffff',
            'merah'     => '#e74c3c',
            'biru'      => '#3498db',
            'hijau'     => '#2ecc71',
            'kuning'    => '#f1c40f',
            'abu-abu'   => '#7f8c8d',
            'oranye'    => '#e67e22',
            'ungu'      => '#9b59b6',
            'coklat'    => '#8e5c42',
            'pink'      => '#ff69b4',
            'emas'      => '#ffd700',
            'silver'    => '#c0c0c0',
            'navy'      => '#34495e',
            'toska'     => '#1abc9c',
            'lime'      => '#a4de02',
            'maroon'    => '#800000',
            'cyan'      => '#00ffff',
            'magenta'   => '#ff00ff',
            'lavender'  => '#e6e6fa',
            'salmon'    => '#fa8072',
            'peach'     => '#ffe5b4',
            'tan'       => '#d2b48c',
            'olive'     => '#808000',
            'teal'      => '#008080',
            // Add more color mappings as needed
        ];
        
        $hexColor = isset($colorMap[$colorValue]) ? $colorMap[$colorValue] : '#777777';
        
        echo "<p class='outfit-detail'><span class='color-dot' style='background-color: $hexColor;'></span>Color: <span>" . $colorValue . "</span></p>";
        echo "</div>"; // close outfit-info
        echo "</div>"; // close outfit-card
    }
    echo "</div>"; // close outfit-grid
} else {
    echo "Tidak ada data.";
}

$stmt->close();
$conn->close();
?>
