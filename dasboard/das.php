<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login/login.html");
    exit;
}

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
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OutfitMate - Pilih Outfit Terbaik Setiap Hari</title>
  <link rel="stylesheet" href="dasboard.css">
  <style>
    .dashboard-menu .menu{
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    border-radius: 0.375rem;
    color: var(--dark);
    text-decoration: none;
    transition: all 0.3s;
    background-color: transparent;
    border: none;
    cursor: pointer;
  }
  .dashboard-menu .menu:hover,
  .dashboard-menu .menu.active {
    background-color: var(--primary);
    color: white;
  }
    #koleksi h2 {
        text-align: center;
        color: #333;
    }

    #koleksi form {
      max-width: 100%;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    #koleksi label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #555;
    }

    #koleksi input[type="text"],
    select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 8px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    #koleksi .upload-box {
      border: 2px dashed #bbb;
      border-radius: 12px;
      padding: 30px 20px;
      text-align: center;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 15px;
    }

    #koleksi .upload-box:hover {
      background-color: #f0f0f0;
    }

    #koleksi .upload-icon {
      font-size: 40px;
      color: #888;
    }

    #koleksi .text-upload {
      color: #666;
      margin-top: 8px;
    }

    #koleksi .upload-box input[type="file"] {
      display: none;
    }

    #koleksi #preview {
      display: none;
      margin-top: 15px;
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    #koleksi button {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background-color:var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    #koleksi form .koleksi-name,
    #koleksi form .koleksi-type,
    #koleksi form .koleksi-preview {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }
    #koleksi form .koleksi-type-1,
    #koleksi form .koleksi-type-2,
    #koleksi form .koleksi-name-1,
    #koleksi form .koleksi-name-2,
    #koleksi form .koleksi-preview-1,
    #koleksi form .koleksi-preview-2 {
      flex: 1;
      margin-right: 10px;
    }
    
  </style>
</head>
<body>
  <header>
    <div class="container">
      <nav>
        <div class="logo">
          <span>👔</span>
          <span>OutfitMate</span>
        </div>
        <div class="nav-links">
          <a href="#">Beranda</a>
          <a href="#">Fitur</a>
          <a href="#">Blog</a>
          <a href="#">Tentang</a>
          <a href="#">Kontak</a>
        </div>
        <div class="auth-buttons">
          <form action="logout.php" method="POST">
            <!-- <button class="btn btn-outline">logout</button> -->
            <button class="btn btn-primary" name="logout">Logout</button>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="container">
        <div class="hero">
          <div class="hero-content">
            <h1>Pilih Outfit Sempurna untuk Setiap Momenmu,<?= $_SESSION['user'] ?>!</h1>
            <p>OutfitMate membantu Anda memilih pakaian yang tepat berdasarkan cuaca, acara, dan koleksi pribadi Anda. Tidak perlu lagi bingung memilih baju setiap pagi!</p>
            <div class="hero-buttons">
              <button class="btn btn-primary">Mulai Sekarang</button>
              <button class="btn btn-outline">Pelajari Lebih Lanjut</button>
            </div>
          </div>
          <div class="hero-image">
            <img src="..\picture\outfit-removebg-preview.png" alt="Pemilihan outfit dengan OutfitMate">
          </div>
        </div>
      </div>
    </section>

    <section class="features">
      <div class="container">
        <div class="section-title">
          <h2>Fitur Utama</h2>
          <p>OutfitMate hadir dengan berbagai fitur untuk memudahkan pemilihan outfit harian Anda</p>
        </div>
        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon">☀️</div>
            <h3>Rekomendasi Berbasis Cuaca</h3>
            <p>Dapatkan saran outfit yang sesuai dengan cuaca hari ini di lokasi Anda. Tidak perlu khawatir kepanasan atau kedinginan.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">👔</div>
            <h3>Kelola Koleksi Wardrobe</h3>
            <p>Simpan dan kelola semua pakaian yang Anda miliki. Kategorikan berdasarkan jenis, warna, dan gaya.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">🎯</div>
            <h3>Sesuaikan dengan Acara</h3>
            <p>Tentukan outfit yang cocok untuk berbagai acara - mulai dari kerja, santai, hingga pesta formal.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="outfit-suggestions">
      <div class="container">
        <div class="section-title">
          <h2>Outfit Pilihan</h2>
          <p>Contoh rekomendasi outfit yang akan Anda dapatkan berdasarkan preferensi Anda</p>
        </div>
        <div class="outfit-cards">
          <div class="outfit-card">
            <div class="outfit-image">
              <img src="/api/placeholder/300/200" alt="Outfit Casual">
            </div>
            <div class="outfit-info">
              <h3>Casual Workday</h3>
              <p>Sempurna untuk hari kerja santai atau pertemuan informal.</p>
              <div class="outfit-tags">
                <span class="tag">Casual</span>
                <span class="tag">Office</span>
                <span class="tag">Comfortable</span>
              </div>
            </div>
          </div>
          <div class="outfit-card">
            <div class="outfit-image">
              <img src="#" alt="Outfit Formal">
            </div>
            <div class="outfit-info">
              <h3>Business Meeting</h3>
              <p>Tampil profesional dan percaya diri dalam pertemuan penting.</p>
              <div class="outfit-tags">
                <span class="tag">Formal</span>
                <span class="tag">Professional</span>
                <span class="tag">Meeting</span>
              </div>
            </div>
          </div>
          <div class="outfit-card">
            <div class="outfit-image">
              <img src="/api/placeholder/300/200" alt="Outfit Weekend">
            </div>
            <div class="outfit-info">
              <h3>Weekend Relax</h3>
              <p>Pakaian nyaman namun tetap stylish untuk akhir pekan Anda.</p>
              <div class="outfit-tags">
                <span class="tag">Weekend</span>
                <span class="tag">Relaxed</span>
                <span class="tag">Comfortable</span>
              </div>
            </div>
          </div>
          <div class="outfit-card">
            <div class="outfit-image">
              <img src="/api/placeholder/300/200" alt="Outfit Party">
            </div>
            <div class="outfit-info">
              <h3>Night Out</h3>
              <p>Bersiap untuk malam yang menyenangkan dengan teman-teman.</p>
              <div class="outfit-tags">
                <span class="tag">Party</span>
                <span class="tag">Night</span>
                <span class="tag">Stylish</span>
              </div>
            </div>
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
            <h3>Pakaian yang Tepat untuk Setiap Cuaca</h3>
            <p>OutfitMate mengintegrasikan data cuaca real-time untuk memberikan rekomendasi outfit yang benar-benar sesuai dengan kondisi hari ini.</p>
            <p>Dari hari yang panas hingga musim hujan, kami memastikan Anda tetap nyaman dan stylish sepanjang hari.</p>
            <button class="btn btn-primary">Lihat Rekomendasi Hari Ini</button>
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

    <section class="dashboard-preview">
      <div class="container">
        <div class="section-title">
          <h2>Dashboard Pribadi Anda</h2>
          <p>Kelola koleksi pakaian dan lihat rekomendasi outfit harian</p>
        </div>
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>OutfitMate Dashboard</h3>
            <div>
              Halo, <?= $_SESSION['user'] ?>!
            </div>
          </div>
          <div class="dashboard-content">
            <div class="dashboard-sidebar">
              <ul class="dashboard-menu">
                <!-- <li><a onclick="showPage(beranda)" href="" class="active">Beranda</a></li>
                <li><a onclick="showPage(koleksi)" href="">Koleksi Pakaian</a></li>
                <li><a onclick="showPage(tersimpan)" href="">Outfit Tersimpan</a></li>
                <li><a onclick="showPage(rekomendasi)" href="">Rekomendasi</a></li>
                <li><a onclick="showPage(kalendar)" href="">Kalendar Outfit</a></li> -->
                <div class="menu" onclick="showPage('beranda')">Beranda</div>
                <div class="menu" onclick="showPage('koleksi')">Koleksi Pakaian</div>
                <div class="menu" onclick="showPage('tersimpan')">Outfit Tersimpan</div>
                <div class="menu" onclick="showPage('rekomendasi')">Rekomendasi</div>
                <li><a href="#">Pengaturan</a></li>
              </ul>
            </div>
            <div id="beranda" class="dashboard-main page">
              <h3>Selamat Pagi, <?= $_SESSION['user'] ?>!</h3>
              <p>Berikut rekomendasi outfit untuk hari ini:</p>
              <div class="dashboard-cards">
                <div class="dashboard-card">
                  <h4>Total Pakaian</h4>
                  <p>78</p>
                </div>
                <div class="dashboard-card">
                  <h4>Outfit Tersimpan</h4>
                  <p>12</p>
                </div>
                <div class="dashboard-card">
                  <h4>Terakhir Ditambahkan</h4>
                  <p>5 hari lalu</p>
                </div>
              </div>
              <h4>Rekomendasi Hari Ini</h4>
              <div class="outfit-grid">
                <div class="outfit-item">
                  <img src="/api/placeholder/150/150" alt="Pakaian 1">
                </div>
                <div class="outfit-item">
                  <img src="/api/placeholder/150/150" alt="Pakaian 2">
                </div>
                <div class="outfit-item">
                  <img src="/api/placeholder/150/150" alt="Pakaian 3">
                </div>
                <div class="outfit-item">
                  <img src="/api/placeholder/150/150" alt="Pakaian 4">
                </div>
              </div>
            </div>
            <div id="koleksi" class="page" style="display: none;">
                <form action="add_outfit.php" method="POST" enctype="multipart/form-data">
                  <h2>Tambah Outfit Baru</h2>
                  <div class="koleksi-name">
                    <div class="koleksi-name-1">
                      <label>Nama Outfit:</label><br>
                      <input type="text" name="name" required><br><br>
                    </div>
                    <div class="koleksi-name-2">
                    <label>Kategori:</label><br>
                      <select name="category" required>
                        <option value="atasan">Atasan</option>
                        <option value="bawahan">Bawahan</option>
                        <option value="jaket">Jaket</option>
                        <option value="sepatu">Sepatu</option>
                        <!-- Tambah sesuai kebutuhan -->
                      </select>
                    </div>
                  </div>

                  <div class="koleksi-type">
                    <div class="koleksi-type-1">
                      <label>Warna:</label><br>
                      <input type="text" name="color" required><br><br>
                    </div>
                    <div class="koleksi-type-2">
                      <label>Cuaca yang Cocok:</label><br>
                      <select name="weather">
                        <option value="cerah">Cerah</option>
                        <option value="hujan">Hujan</option>
                        <option value="dingin">Dingin</option>
                      </select>
                    </div>
                  </div>

                  <div class="koleksi-preview">
                    <div class="koleksi-preview-1">
                      <label>Acara:</label><br>
                      <input type="text" name="occasion"><br><br>
                    </div>
                    <div class="koleksi-preview-2">
                      <label class="upload-box">
                        <div class="upload-icon">＋</div>
                        <div class="text-upload">Click or drag to upload image</div>
                        <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
                        <img id="preview" alt="Image Preview">
                      </label>
                    </div>
                  </div>

                  <button type="submit">Simpan Outfit</button>
              </form>
            </div>
            <div id="tersimpan" class="page" style="display: none;">ini halaman outfit tersimpan</div>
            <div id="rekomendasi" class="page" style="display: none;">ini halaman rekomendasi</div>
            <div id="kalendar" class="page" style="display: none;">ini halaman kalendar outfit</div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta-section">
      <div class="container">
        <h2>Mulai Tentukan Gaya Anda Hari Ini</h2>
        <p>Bergabunglah dengan ribuan orang yang telah mengatasi kebingungan memilih pakaian setiap hari. Daftar gratis sekarang!</p>
        <button class="btn btn-primary">Daftar Sekarang</button>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <h3>OutfitMate</h3>
          <p>Membantu Anda memilih pakaian yang tepat, setiap hari.</p>
          <div class="social-icons">
            <a href="#">FB</a>
            <a href="#">IG</a>
            <a href="#">TW</a>
            <a href="#">YT</a>
          </div>
        </div>
        <div class="footer-column">
          <h3>Navigasi</h3>
          <ul class="footer-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Fitur</a></li>
            <li><a href="#">Harga</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Kontak</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Fitur</h3>
          <ul class="footer-links">
            <li><a href="#">Rekomendasi Outfit</a></li>
            <li><a href="#">Manajemen Lemari</a></li>
            <li><a href="#">Integrasi Cuaca</a></li>
            <li><a href="#">Kalendar Outfit</a></li>
            <li><a href="#">Statistik Pakaian</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Dukungan</h3>
          <ul class="footer-links">
            <li><a href="#">Pusat Bantuan</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Kebijakan Privasi</a></li>
            <li><a href="#">Syarat & Ketentuan</a></li>
            <li><a href="#">Kebijakan Pengembalian</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 OutfitMate. Hak Cipta Dilindungi.</p>
      </div>
    </div>
  </footer>
  <script src="das.js"></script>
  <script src="page.js"></script>
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
      });
    } else {
      alert("Geolocation tidak didukung oleh browser ini.");
    }
  }
  </script>
  <script>
    function previewImage(event) {
      const image = document.getElementById('preview');
      const file = event.target.files[0];
      if (file) {
        image.src = URL.createObjectURL(file);
        image.style.display = 'block';
      }
    }
  </script>
</body>
</html>