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
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OutfitMate - Pilih Outfit Sempurna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .slide-up {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="fixed top-0 w-full z-50 glass-effect bg-white/80 border-b border-gray-200/50 transition-all duration-300">
        <div class="container mx-auto px-6 py-4">
            <nav class="flex items-center justify-between">
                <div class="logo flex items-center space-x-3 group cursor-pointer">
                    <span class="text-3xl group-hover:scale-110 transition-transform duration-300">👔</span>
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">OutfitMate</span>
                </div>

                <div class="nav-links hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#outfit" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
                        Fitur
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
                        Blog
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="bantuan.php" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
                        pusat bantuan
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="bantuan.php#kontak" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
                        Kontak
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <div class="auth-buttons">
                    <form action="logout.php" method="POST">
                        <button class="btn btn-primary bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 transform" name="logout">
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </header>

    <main class="pt-20" id="beranda">
        <section class="hero hero-gradient min-h-screen flex items-center relative overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="hero grid lg:grid-cols-2 gap-12 items-center">
                    <div class="hero-content fade-in">
                        <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                            Pilih Outfit Sempurna untuk Setiap Momenmu,
                            <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent"><?= $_SESSION['user'] ?></span>!
                        </h1>
                        <p class="text-xl text-white/90 mb-8 leading-relaxed">
                            OutfitMate membantu Anda memilih pakaian yang tepat berdasarkan cuaca, acara, dan koleksi pribadi Anda. Tidak perlu lagi bingung memilih baju setiap pagi!
                        </p>
                        <div class="hero-buttons flex flex-col sm:flex-row gap-4">
                            <button class="btn btn-primary bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 hover:shadow-xl hover:scale-105 transition-all duration-300 transform" onclick="window.location.href='#outfit'">
                                Mulai Sekarang
                            </button>
                            <a href="bantuan.php#faq">
                                <button class="btn btn-outline border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all duration-300">
                                Pelajari Lebih Lanjut
                                </button>
                            </a>

                        </div>
                    </div>
                    <div class="hero-image floating-animation">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-blue-500 rounded-3xl blur-2xl opacity-30"></div>
                            <img src="../picture/outfit-removebg-preview.png" alt="Pemilihan outfit dengan OutfitMate" class="relative z-10 w-full max-w-lg mx-auto drop-shadow-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="section-title text-center mb-16 slide-up">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Utama</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">OutfitMate hadir dengan berbagai fitur untuk memudahkan pemilihan outfit harian Anda</p>
                </div>

                <div class="features-grid grid md:grid-cols-3 gap-8">
                    <div class="feature-card group bg-gradient-to-br from-orange-50 to-yellow-50 p-8 rounded-2xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-orange-100">
                        <div class="feature-icon text-6xl mb-6 group-hover:scale-110 transition-transform duration-300">☀️</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Rekomendasi Berbasis Cuaca</h3>
                        <p class="text-gray-600 leading-relaxed">Dapatkan saran outfit yang sesuai dengan cuaca hari ini di lokasi Anda. Tidak perlu khawatir kepanasan atau kedinginan.</p>
                    </div>

                    <div class="feature-card group bg-gradient-to-br from-blue-50 to-purple-50 p-8 rounded-2xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-blue-100">
                        <div class="feature-icon text-6xl mb-6 group-hover:scale-110 transition-transform duration-300">👔</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Kelola Koleksi Wardrobe</h3>
                        <p class="text-gray-600 leading-relaxed">Simpan dan kelola semua pakaian yang Anda miliki. Kategorikan berdasarkan jenis, warna, dan gaya.</p>
                    </div>

                    <div class="feature-card group bg-gradient-to-br from-pink-50 to-red-50 p-8 rounded-2xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-pink-100">
                        <div class="feature-icon text-6xl mb-6 group-hover:scale-110 transition-transform duration-300">🎯</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Sesuaikan dengan Acara</h3>
                        <p class="text-gray-600 leading-relaxed">Tentukan outfit yang cocok untuk berbagai acara - mulai dari kerja, santai, hingga pesta formal.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="outfit-suggestions py-20 bg-gradient-to-br from-gray-50 to-blue-50" id="outfit">
            <div class="container mx-auto px-6">
                <div class="section-title text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Outfit Pilihan</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-12">Contoh rekomendasi outfit yang akan Anda dapatkan berdasarkan preferensi Anda</p>

                    <div class="koleksi-type-preview grid md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-12">
                        <div class="koleksi-preview">
                            <select name="umur" id="umur" class="w-full px-6 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors duration-300 text-gray-700 font-medium">
                                <option value="" disabled selected hidden>Pilih umur</option>
                                <option value="0-5">0–5 tahun</option>
                                <option value="6-12">6–12 tahun (Anak-anak)</option>
                                <option value="13-17">13–17 tahun (Remaja)</option>
                                <option value="18-24">18–24 tahun (Dewasa muda)</option>
                                <option value="25-34">25–34 tahun</option>
                                <option value="35-44">35–44 tahun</option>
                                <option value="45-59">45–59 tahun</option>
                                <option value="60+">60 tahun ke atas</option>
                            </select>
                        </div>

                        <div class="koleksi-preview">
                            <select name="kelamin" id="kelamin" class="w-full px-6 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors duration-300 text-gray-700 font-medium">
                                <option value="" disabled selected hidden>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Non-biner">Non-biner</option>
                                <option value="Lainnya">Lainnya</option>
                                <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                            </select>
                        </div>

                        <div class="koleksi-preview">
                            <select name="event" id="event" class="w-full px-6 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors duration-300 text-gray-700 font-medium">
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

                    <div id="outfit-cards" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        <!-- Outfit cards will be dynamically generated -->
                    </div>
                </div>
            </div>
        </section>
        <section class="cta-section py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold mb-6">Mulai Tentukan Gaya Anda Hari Ini</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">Bergabunglah dengan ribuan orang yang telah mengatasi kebingungan memilih pakaian setiap hari. Daftar gratis sekarang!</p>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-16" id="footer">
        <div class="container mx-auto px-6">
            <div class="footer-content grid md:grid-cols-4 gap-8 mb-12">
                <div class="footer-column">
                    <h3 class="text-2xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">OutfitMate</h3>
                    <p class="text-gray-400 mb-6">Membantu Anda memilih pakaian yang tepat, setiap hari.</p>
                    <div class="social-icons flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors duration-300 group">
  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
  </svg>
</a>

<a href="#" class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition-all duration-300 group">
  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.404-5.967 1.404-5.967s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.739.099.12.112.225.083.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
  </svg>
</a>

<a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-300 group">
  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
  </svg>
</a>

<a href="#" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors duration-300 group">
  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
    <path d="M20.52 3.48A11.77 11.77 0 0012 0C5.37 0 0 5.37 0 12c0 2.12.55 4.11 1.52 5.84L0 24l6.32-1.65C8.05 23.29 9.98 24 12 24c6.63 0 12-5.37 12-12 0-3.21-1.25-6.22-3.48-8.52zM12 22c-1.78 0-3.51-.48-5.01-1.37l-.36-.21-3.73.98.99-3.64-.23-.37A9.9 9.9 0 012 12C2 6.48 6.48 2 12 2s10 4.48 10 10-4.48 10-10 10zm5.5-7.5c-.3 0-1.02-.15-1.35-.27-.33-.12-.57-.18-.66.18-.09.36-.36.57-.62.65-.26.08-.54.01-.81-.14-1.39-.79-2.29-1.85-2.4-1.93-.11-.08-.42-.32-.42-.61s.26-.67.35-.76c.09-.09.2-.14.27-.14.07 0 .13.01.19.01.06 0 .15-.02.23.17.08.19.27.66.29.71.02.05.04.12-.01.19-.05.07-.11.11-.16.17-.05.06-.11.13-.05.25.06.12.27.44.58.71.4.35.74.46.84.51.1.05.16.04.22-.02.06-.06.25-.29.32-.39.07-.1.14-.08.23-.05.09.03.57.27.67.32.1.05.17.08.19.12.02.04.02.23-.06.45z"/>
  </svg>
</a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3 class="text-lg font-semibold mb-6">Navigasi</h3>
                    <ul class="footer-links space-y-3">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition-colors duration-300">Beranda</a></li>
                        <li><a href="#outfit" class="text-gray-400 hover:text-white transition-colors duration-300">Fitur</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a></li>
                        <li><a href="#footer" class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3 class="text-lg font-semibold mb-6">Fitur</h3>
                    <ul class="footer-links space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Rekomendasi Outfit</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3 class="text-lg font-semibold mb-6">Dukungan</h3>
                    <ul class="footer-links space-y-3">
                        <li><a href="bantuan.php" class="text-gray-400 hover:text-white transition-colors duration-300">Pusat Bantuan</a></li>
                        <li><a href="bantuan.php#faq" class="text-gray-400 hover:text-white transition-colors duration-300">FAQ</a></li>
                        <li><a href="bantuan.php#kebijakan-privasi" class="text-gray-400 hover:text-white transition-colors duration-300">Kebijakan Privasi</a></li>
                        <li><a href="bantuan.php#syarat-ketentuan" class="text-gray-400 hover:text-white transition-colors duration-300">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom border-t border-gray-800 pt-8">
                <p class="text-center text-gray-400">&copy; 2025 OutfitMate. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
    <script>
function toggleFAQ(id) {
  const answer = document.getElementById('answer-' + id);
  const icon = document.getElementById('icon-' + id);

  if (answer.classList.contains('hidden')) {
    answer.classList.remove('hidden');
    icon.style.transform = 'rotate(180deg)';
  } else {
    answer.classList.add('hidden');
    icon.style.transform = 'rotate(0deg)';
  }
}
</script>
    <script>
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = '0.2s';
                    entry.target.classList.add('slide-up');
                }
            });
        }, observerOptions);

        // Observe feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Dynamic outfit generation based on selection
        function generateOutfitCards() {
            const umur = document.getElementById('umur').value;
            const kelamin = document.getElementById('kelamin').value;
            const event = document.getElementById('event').value;

            if (umur && kelamin && event) {
                const outfitContainer = document.getElementById('outfit-cards');
                outfitContainer.innerHTML = `
                   <div class="group relative bg-white border-2 border-blue-200 hover:border-blue-400 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full -translate-y-8 translate-x-8 group-hover:scale-125 transition-transform duration-500"></div>

                        <div class="relative z-10 p-6">
                            <div class="w-full h-48 bg-gradient-to-br from-blue-100 via-blue-200 to-purple-200 rounded-2xl mb-4 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent"></div>
                                <span class="text-5xl drop-shadow-md group-hover:scale-110 transition-transform duration-300">👕</span>
                            </div>

                            <div class="text-center space-y-2">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-blue-600 transition-colors duration-300 leading-tight">Outfit Kasual Premium</h3>
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 text-sm">
                                    <p class="text-gray-700 mb-1">
                                        <span class="font-medium text-blue-600">Acara:</span> ${event}
                                    </p>
                                    <p class="text-gray-700">
                                        <span class="font-medium text-blue-600">Style:</span> Trendy & Nyaman
                                    </p>
                                </div>
                                <div class="flex items-center justify-center gap-3 pt-2">
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full border">Rekomendasi</span>
                                    <div class="flex text-yellow-400 text-sm">
                                        <span>★★★★★</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group relative bg-white border-2 border-pink-200 hover:border-pink-400 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-pink-400/10 to-red-400/10 rounded-full -translate-y-8 translate-x-8 group-hover:scale-125 transition-transform duration-500"></div>

                        <div class="relative z-10 p-6">
                            <div class="w-full h-48 bg-gradient-to-br from-pink-100 via-pink-200 to-red-200 rounded-2xl mb-4 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent"></div>
                                <span class="text-5xl drop-shadow-md group-hover:scale-110 transition-transform duration-300">👔</span>
                            </div>

                            <div class="text-center space-y-2">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-pink-600 transition-colors duration-300 leading-tight">Outfit Formal Elegan</h3>
                                <div class="bg-pink-50 border border-pink-200 rounded-xl p-3 text-sm">
                                    <p class="text-gray-700 mb-1">
                                        <span class="font-medium text-pink-600">Umur:</span> ${umur}
                                    </p>
                                    <p class="text-gray-700">
                                        <span class="font-medium text-pink-600">Style:</span> Profesional & Berkelas
                                    </p>
                                </div>
                                <div class="flex items-center justify-center gap-3 pt-2">
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full border">Trending</span>
                                    <div class="flex text-yellow-400 text-sm">
                                        <span>★★★★★</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group relative bg-white border-2 border-green-200 hover:border-green-400 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-green-400/10 to-yellow-400/10 rounded-full -translate-y-8 translate-x-8 group-hover:scale-125 transition-transform duration-500"></div>

                        <div class="relative z-10 p-6">
                            <div class="w-full h-48 bg-gradient-to-br from-green-100 via-green-200 to-yellow-200 rounded-2xl mb-4 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent"></div>
                                <span class="text-5xl drop-shadow-md group-hover:scale-110 transition-transform duration-300">🏃‍♂️</span>
                            </div>

                            <div class="text-center space-y-2">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-green-600 transition-colors duration-300 leading-tight">Outfit Sporty Active</h3>
                                <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-sm">
                                    <p class="text-gray-700 mb-1">
                                        <span class="font-medium text-green-600">Gender:</span> ${kelamin}
                                    </p>
                                    <p class="text-gray-700">
                                        <span class="font-medium text-green-600">Style:</span> Breathable & Fleksibel
                                    </p>
                                </div>
                                <div class="flex items-center justify-center gap-3 pt-2">
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full border">Populer</span>
                                    <div class="flex text-yellow-400 text-sm">
                                        <span>★★★★★</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        // Add event listeners to selects
        document.getElementById('umur').addEventListener('change', generateOutfitCards);
        document.getElementById('kelamin').addEventListener('change', generateOutfitCards);
        document.getElementById('event').addEventListener('change', generateOutfitCards);
  </script>
  <script src="das.js"></script>
  <script src="page.js"></script>
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