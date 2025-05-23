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
    /*css rekomendation*/
    #rekomendasi {
    width: 100%;
    margin: 50px auto;
    padding: 20px 25px;
    font-family: "Segoe UI", sans-serif;
  }

  #rekomendasi label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
  }

  #rekomendasi select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #fff;
      transition: border-color 0.3s ease;
  }

  #rekomendasi select:focus {
      border-color: #007BFF;
      outline: none;
  }

  #rekomendasi button {
      width: 100%;
      padding: 12px;
      background-color: var(--primary);
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
  }
  iframe{
    width: 100%;
    height: 100%;
    border: none;
    margin: 0 ;

  }
  #hasil{
    width: 100%;
  }
  .koleksi-type-preview {
    display: flex;
    flex-direction: row;
    gap: 15px;
  }
  .outfit-suggestions .container .section-title .koleksi-type-preview .koleksi-preview {
    width: 200px;
    flex: 1;
    margin-top: 15px
  }
  .outfit-suggestions .container .section-title .koleksi-type-preview .koleksi-preview select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    margin-bottom: 15px;
    text-align-last:center;
    border-radius: 25px;
    border: 1px solid #ccc;
    background-color: #fff;
    transition: border-color 0.3s ease;
    cursor: pointer;
  }
  .outfit-suggestions .section-title{
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  #outfit-cards{
    max-height: 400px;
    width: 100%;
    overflow-y: auto;
  }
  #outfit-cards {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.outfit-card {
  background-color: #ffffff;
  border-radius: 16px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  min-width: 300px;
  max-width: 300px;
  flex-shrink: 0;
  scroll-snap-align: start;
  transition: transform 0.3s ease;
}

.outfit-card:hover {
  transform: scale(1.03);
}

.outfit-image img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-top-left-radius: 16px;
  border-top-right-radius: 16px;
}

.outfit-info {
  padding: 12px 16px;
}

.outfit-info h3 {
  font-size: 18px;
  margin: 0 0 8px;
  color: #333;
}

.outfit-info p {
  font-size: 14px;
  color: #666;
}
.outfit-meta{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 5px;
}
.outfit-meta div{
  background-color:gray;
  margin-bottom: 15px;
  padding: 8px 6px;
  border-radius: 10px;
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
          <a href="#info">Info</a>
          <a href="#rec">Rekomendasi</a>
          <a href="#tentang">Tentang</a>
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

  <mai>
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

    <section id="info" class="features">
      <div class="container">
        <div class="section-title"> 
          <h2>Info</h2>
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

    <section id="rec" class="outfit-suggestions">
      <div class="container">
        <div class="section-title">
          <h2>Outfit Pilihan</h2>
          <p>Contoh rekomendasi outfit yang akan Anda dapatkan berdasarkan preferensi Anda</p>
          <div class="koleksi-type-preview">
            <div class="koleksi-preview">
              <select name="umur" id="umur">
                <option value="" disabled selected hidden>Pilih umur</option>
                <option value="0-5">0–5 tahun</option>
                <option value="6-12">6–12 tahun (Anak-anak)</option>
                <option value="13-17">13–17 tahun (Remaja)</option>
                <option value="18-24">18–24 tahun (Dewasa)</option>
                <option value="25+">25 tahun ke atas</option>
              </select>
            </div>
            <div class="koleksi-preview">
                <select name="kelamin" id="kelamin">
                  <option value="" disabled selected hidden>Pilih jenis kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="koleksi-preview">
                <select name="event" id="event">
                  <option value="" disabled selected hidden>Pilih ketik acara</option>
                  <option value="Pesta">Pesta</option>
                  <option value="Olahraga">Olahraga</option>
                  <option value="Santai">Santai</option>
                  <option value="Kerja">Kerja</option>
                  <option value="Sekolah">Sekolah</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
          </div>
          <div id="outfit-cards"></div>
        </div>
      </div>
    </section>

    <section id="tentang" class="cta-section">
      <div class="container">
        <h2>Mulai Tentukan Gaya Anda Hari Ini</h2>
        <p>Bergabunglah dengan ribuan orang yang telah mengatasi kebingungan memilih pakaian setiap hari. Daftar gratis sekarang!</p>
        <button class="btn btn-primary">Daftar Sekarang</button>
      </div>
    </section>
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
   <script>
        // Ambil form dan handle submit-nya
        document.getElementById('rekomendasi-outfit').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah reload halaman

            const formData = new FormData(this); // Ambil data form

            // Kirim data form ke proses.php menggunakan Fetch API
            fetch('recomendation.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Ambil hasil dari server (HTML)
            .then(data => {
                document.getElementById('hasil').innerHTML = data; // Tampilkan di div #hasil
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
    <script>
      const selects = document.querySelectorAll('select');
      selects.forEach(select => {
        select.addEventListener('change', () => {
          const umur = document.getElementById('umur').value;
          const kelamin = document.getElementById('kelamin').value;
          const event = document.getElementById('event').value;

          // Kirim AJAX request ke PHP
          fetch(`outfit-fetch.php?umur=${umur}&kelamin=${kelamin}&event=${event}`)
            .then(response => response.text())
            .then(html => {
              document.getElementById('outfit-cards').innerHTML = html;
            });
        });
      });
    </script>
</body>
</html>