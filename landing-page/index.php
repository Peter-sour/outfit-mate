<?php
$apiKey = "ed74b9f8b107607666e6e7a849dc41c8"; // Ganti API Key
$lat = $_GET['lat'] ?? null ;  // default Jakarta
$lon = $_GET['lon'] ?? null ;
$cacheFile = 'cuaca-cache.json';
$cacheKey = md5($lat . $lon);
$cacheTime = 600; // 10 menit

$data = null;

if (file_exists($cacheFile)) {
    $allCache = json_decode(file_get_contents($cacheFile), true);
    if (isset($allCache[$cacheKey]) && (time() - $allCache[$cacheKey]['timestamp'] < $cacheTime)) {
        $data = $allCache[$cacheKey]['data'];
    }
}

if (!$data) {
    $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&units=metric&lang=id";
    $response = file_get_contents($url);
    $json = json_decode($response, true);

    $data = [
        "temp" => round($json['main']['temp']),
        "feels_like" => round($json['main']['feels_like']),
        "humidity" => $json['main']['humidity'],
        "wind_speed" => $json['wind']['speed'],
        "description" => ucwords($json['weather'][0]['description']),
        "icon" => $json['weather'][0]['main'],
        "city" => $json['name'],
        "date" => date('l, j F')
    ];

    $allCache[$cacheKey] = [
        "timestamp" => time(),
        "data" => $data
    ];
    file_put_contents($cacheFile, json_encode($allCache));
}

// Data ke variabel
extract($data);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outfit Mate - Your Digital Fashion Assistant</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/features.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/weather.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <h1>Outfit<span>Mate</span></h1>
            </div>
            <!-- <div class="weather-widget" id="weather-widget">
                <div class="weather-loading">
                    <i class="fas fa-spinner fa-spin"></i> Loading weather...
                </div>
            </div> -->
            <div class="login-buttons">
                <!-- <a href="../login/login.html" class="btn btn-outline">Login as User</a> -->
                <a href="../login/login.html" class="btn btn-primary">Sign In</a>
            </div>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="animate-fade-in">Your Digital Fashion Recommendations</h1>
                <p class="animate-fade-in-delay-1">Get daily outfit recommendations based on your style, preferences, and the weather. Never worry about what to wear again.</p>
                <div class="hero-buttons animate-fade-in-delay-2">
                    <a href="../register/register.php" class="btn btn-large btn-primary">Sign Up Now</a>
                    <a href="#features" class="btn btn-large btn-outline">Learn More</a>
                </div>
            </div>
            <div class="hero-image animate-fade-in-delay-1">
                <img src="https://images.pexels.com/photos/4144982/pexels-photo-4144982.jpeg" alt="Fashion Model">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <h2>Our Features</h2>
                <p>Sign up first to enjoy all these features</p>
            </div>
            <div class="feature-grid">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3>Daily Outfit Recommendations</h3>
                    <p>Get personalized outfit suggestions every day based on your style, weather, and occasions.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <h3>Personal Wardrobe</h3>
                    <p>Digitize your closet and manage all your clothing items in one convenient place.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-random"></i>
                    </div>
                    <h3>Mix & Match Tips</h3>
                    <p>Discover new combinations and ways to wear your existing clothes with style advice.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Outfit Usage Statistics</h3>
                    <p>Track how often you wear items and get insights to maximize your wardrobe.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="weather-section">
        <div class="container">
          <div class="section-title">
            <h2>Cuaca Mempengaruhi Gaya</h2>
            <p>OutfitMate memanfaatkan data cuaca terkini untuk membantu Anda berpakaian sesuai kondisi</p>
          </div>
          <div class="weather-container">
            <div class="weather-info">
              <h2>Pakaian yang Tepat untuk Setiap Cuaca</h2><br>
              <p>OutfitMate mengintegrasikan data cuaca real-time untuk memberikan rekomendasi outfit yang benar-benar sesuai dengan kondisi hari ini.</p>
              <p>Dari hari yang panas hingga musim hujan, kami memastikan Anda tetap nyaman dan stylish sepanjang hari.</p>
              <p style="font-weight : 700 ">Ingin tau gaya apa yang sesuai denganmu hari ini</p>
              <a href="../login/login.html"><button class="btn btn-primary">login disini</button></a>
            </div>
            <div class="weather-card">
              <div class="weather-card-header">
                <div>
                  <!-- <h3>Jakarta</h3>
                  <p>Selasa, 17 April</p> -->
                  <h3><?= $city ?></h3>
                  <p><?= $date ?></p>
                </div>
                <div class="weather-icon">
                  ☀️
                </div>
              </div>
              <div class="weather-temperature">
                <?= $temp ?>°C
              </div>
              <p>Cerah Berawan</p>
              <div class="weather-details">
                <div class="weather-detail">
                  💧
                  <span><?= $humidity ?>% Kelembaban</span>
                </div>
                <div class="weather-detail">
                  💨
                  <span><?= $wind_speed ?> km/j Angin</span>
                </div>
                <div class="weather-detail">
                  🌡️
                  <span>Terasa seperti <?= $feels_like ?>°C</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to transform your daily fashion routine?</h2>
                <p>Join thousands of fashion-forward individuals who never worry about what to wear.</p>
                <a href="../register/register.php" class="btn btn-large btn-primary animate-pulse">Sign Up Now</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h2>Outfit<span>Mate</span></h2>
                    <p>Your Digital Fashion Assistant</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="../register/register.php">Sign Up</a></li>
                        <li><a href="../login/login.html">Login</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-envelope"></i> support@outfitmate.com</p>
                    <p><i class="fas fa-phone"></i> +6281357642730</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 OutfitMate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script src="js/weather.js"></script>
    <script>
        // Cek apakah URL sudah punya koordinat
    const urlParams = new URLSearchParams(window.location.search);
    const lat = urlParams.get("lat");
    const lon = urlParams.get("lon");

    // Kalau belum ada lat & lon, baru ambil lokasi dari browser
    if (!lat || !lon) {
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Tambahkan ke URL dan redirect hanya sekali
            const newUrl = window.location.pathname + `?lat=${latitude}&lon=${longitude}`;
            window.location.href = newUrl;
        }, function (error) {
            alert("Gagal mendapatkan lokasi. Silakan izinkan akses lokasi.");
        });a
        } else {
        alert("Geolocation tidak didukung oleh browser ini.");
        }
    }
  </script>
</body>
</html>