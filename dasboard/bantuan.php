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
                    <a href="das.php#beranda" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="das.php#outfit" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
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
                    <a href="bantuan.php" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium relative group">
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
    <main class="pt-20 ">
       <!-- Pusat Bantuan Section -->
<section id="pusat-bantuan" class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-16 px-4">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Pusat Bantuan</h1>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">Temukan jawaban untuk pertanyaan Anda atau hubungi tim support kami</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
      <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Panduan Pengguna</h3>
        <p class="text-gray-600 mb-6">Tutorial lengkap dan panduan step-by-step untuk menggunakan platform kami</p>
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300 font-medium">Lihat Panduan</button>
      </div>

      <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Live Chat</h3>
        <p class="text-gray-600 mb-6">Dapatkan bantuan langsung dari tim customer service kami 24/7</p>
        <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors duration-300 font-medium">Mulai Chat</button>
      </div>

      <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
          <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Email Support</h3>
        <p class="text-gray-600 mb-6">Kirim pertanyaan detail Anda dan dapatkan jawaban komprehensif</p>
        <button class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors duration-300 font-medium">Kirim Email</button>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-16 px-4">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h1>
      <p class="text-xl text-gray-600">Pertanyaan yang sering diajukan beserta jawabannya</p>
    </div>

    <div class="space-y-6">
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(1)">
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Bagaimana cara mendaftar akun baru?</h3>
            <svg id="icon-1" class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </div>
        <div id="answer-1" class="hidden px-6 pb-6">
          <p class="text-gray-600 leading-relaxed">Untuk mendaftar akun baru, klik tombol "Daftar" di pojok kanan atas halaman. Isi formulir dengan email, kata sandi, dan informasi pribadi yang diperlukan. Setelah itu, verifikasi email Anda melalui link yang dikirim ke inbox.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(2)">
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Apakah ada biaya berlangganan?</h3>
            <svg id="icon-2" class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </div>
        <div id="answer-2" class="hidden px-6 pb-6">
          <p class="text-gray-600 leading-relaxed">Kami menyediakan paket gratis dengan fitur dasar, serta paket premium dengan fitur lanjutan. Paket premium tersedia mulai dari Rp 99.000/bulan. Anda dapat melihat perbandingan lengkap fitur di halaman pricing kami.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(3)">
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Bagaimana cara menghubungi customer service?</h3>
            <svg id="icon-3" class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </div>
        <div id="answer-3" class="hidden px-6 pb-6">
          <p class="text-gray-600 leading-relaxed">Anda dapat menghubungi customer service melalui live chat di website (tersedia 24/7), email di team.outfitmate@gmail.com, atau telepon di (08)5230070232 pada jam kerja 09:00-17:00 WIB.</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(4)">
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Apakah data saya aman?</h3>
            <svg id="icon-4" class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </div>
        <div id="answer-4" class="hidden px-6 pb-6">
          <p class="text-gray-600 leading-relaxed">Ya, keamanan data adalah prioritas utama kami. Kami menggunakan enkripsi SSL 256-bit, autentikasi dua faktor, dan mematuhi standar keamanan internasional. Data Anda disimpan di server yang aman dan tidak akan dibagikan kepada pihak ketiga tanpa persetujuan Anda.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Kebijakan Privasi Section -->
<section id="kebijakan-privasi" class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-100 py-16 px-4">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Kebijakan Privasi</h1>
      <p class="text-xl text-gray-600">Komitmen kami dalam melindungi privasi dan data pribadi Anda</p>
      <p class="text-sm text-gray-500 mt-2">Terakhir diperbarui: 24 Mei 2025</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
      <div class="prose prose-lg max-w-none">
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
              </svg>
            </div>
            Informasi yang Kami Kumpulkan
          </h2>
          <p class="text-gray-600 leading-relaxed mb-4">Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, seperti saat Anda membuat akun, menggunakan layanan kami, atau menghubungi kami.</p>
          <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
            <li>Informasi identitas: nama, email, nomor telepon</li>
            <li>Informasi akun: username, password, preferensi</li>
            <li>Data penggunaan: aktivitas, riwayat transaksi</li>
            <li>Informasi teknis: IP address, browser, device</li>
          </ul>
        </div>

        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
              </svg>
            </div>
            Bagaimana Kami Menggunakan Informasi
          </h2>
          <p class="text-gray-600 leading-relaxed mb-4">Informasi yang kami kumpulkan digunakan untuk:</p>
          <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
            <li>Menyediakan, mengoperasikan, dan meningkatkan layanan</li>
            <li>Memproses transaksi dan mengirim konfirmasi</li>
            <li>Berkomunikasi dengan Anda tentang layanan kami</li>
            <li>Mencegah penipuan dan menjaga keamanan</li>
            <li>Mematuhi kewajiban hukum</li>
          </ul>
        </div>

        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            Hak-Hak Anda
          </h2>
          <p class="text-gray-600 leading-relaxed mb-4">Anda memiliki hak untuk:</p>
          <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
            <li>Mengakses dan memperbarui informasi pribadi Anda</li>
            <li>Meminta penghapusan data pribadi</li>
            <li>Membatasi atau menolak pemrosesan data</li>
            <li>Memindahkan data ke penyedia layanan lain</li>
            <li>Mengajukan keluhan kepada otoritas perlindungan data</li>
          </ul>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
          <p class="text-blue-800"><strong>Hubungi Kami:</strong> Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami di team.outfitmate@gmail.com</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="kontak" class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Hubungi Kami</h2>
            <p class="text-gray-600">Kirim pesan dan kami akan merespons segera</p>
        </div>

        <form id="contact-form" class="space-y-6" action="simpan._mongo.php" method="POST">
            <div class="relative">
                <input
                    type="text"
                    name="user_name"
                    placeholder="Nama"
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors duration-300 bg-gray-50 focus:bg-white"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>

            <div class="relative">
                <input
                    type="email"
                    name="user_email"
                    placeholder="Email"
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors duration-300 bg-gray-50 focus:bg-white"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>

            <div class="relative">
                <textarea
                    name="message"
                    placeholder="Pesan..."
                    required
                    rows="4"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors duration-300 bg-gray-50 focus:bg-white resize-none"
                ></textarea>
                <div class="absolute top-3 right-3">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                <span class="flex items-center justify-center">
                    Kirim Pesan
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </span>
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Atau hubungi kami langsung di
                <a href="mailto:info@example.com" class="text-blue-500 hover:text-blue-600 font-medium">info@example.com</a>
            </p>
        </div>
    </div>
</section>
<!-- Syarat & Ketentuan Section -->
<section id="syarat-ketentuan" class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 py-16 px-4">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Syarat & Ketentuan</h1>
      <p class="text-xl text-gray-300">Ketentuan penggunaan layanan dan platform kami</p>
      <p class="text-sm text-gray-400 mt-2">Berlaku efektif: 24 Mei 2025</p>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
      <div class="prose prose-lg max-w-none">
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
            </div>
            Penerimaan Syarat
          </h2>
          <p class="text-gray-600 leading-relaxed">Dengan mengakses dan menggunakan layanan kami, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan bagian mana pun dari syarat-syarat ini, maka Anda tidak boleh menggunakan layanan kami.</p>
        </div>

        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5v3a.75.75 0 001.5 0v-3A.75.75 0 009 9z" clip-rule="evenodd"/>
              </svg>
            </div>
            Penggunaan Layanan
          </h2>
          <p class="text-gray-600 leading-relaxed mb-4">Anda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah dan sesuai dengan syarat-syarat ini. Anda tidak diperbolehkan:</p>
          <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
            <li>Menggunakan layanan untuk kegiatan ilegal atau tidak sah</li>
            <li>Mengganggu atau merusak keamanan layanan</li>
            <li>Mengirim spam, malware, atau konten berbahaya lainnya</li>
            <li>Melanggar hak kekayaan intelektual pihak lain</li>
            <li>Menyamar sebagai orang lain atau entitas lain</li>
          </ul>
        </div>

        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
              </svg>
            </div>
            Pembayaran dan Penagihan
          </h2>
          <p class="text-gray-600 leading-relaxed mb-4">Untuk layanan berbayar:</p>
          <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
            <li>Pembayaran harus dilakukan sesuai dengan paket yang dipilih</li>
            <li>Penagihan dilakukan secara otomatis sesuai siklus berlangganan</li>
            <li>Anda dapat membatalkan langganan kapan saja</li>
            <li>Tidak ada pengembalian dana untuk periode yang sudah digunakan</li>
            <li>Harga dapat berubah dengan pemberitahuan 30 hari sebelumnya</li>
          </ul>
        </div>

        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </div>
            Pembatasan Tanggung Jawab
          </h2>
          <p class="text-gray-600 leading-relaxed">Layanan disediakan "sebagaimana adanya" tanpa jaminan apa pun. Kami tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial yang timbul dari penggunaan layanan kami.</p>
        </div>

        <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded-r-lg">
          <p class="text-gray-700"><strong>Kontak Hukum:</strong> Untuk pertanyaan hukum atau syarat & ketentuan, hubungi team.outfitmate@gmail.com</p>
        </div>
      </div>
    </div>
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
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Manajemen Lemari</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Integrasi Cuaca</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Statistik Pakaian</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3 class="text-lg font-semibold mb-6">Dukungan</h3>
                    <ul class="footer-links space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Pusat Bantuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Syarat & Ketentuan</a></li>
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

    // Toggle visibility
    if (answer.classList.contains('hidden')) {
      answer.classList.remove('hidden');
      icon.classList.add('rotate-180');
    } else {
      answer.classList.add('hidden');
      icon.classList.remove('rotate-180');
    }
  }
</script>

    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
<script>
  (function(){
    emailjs.init("13fxZZnXxmlwFBk0z"); // ganti dengan public key kamu
  })();

  document.getElementById('contact-form').addEventListener('submit', function(e) {
  e.preventDefault();

  const form = this;
  const button = form.querySelector('button[type="submit"]');
  const originalText = button.innerHTML;

  // Loading
  button.innerHTML = `
    <span class="flex items-center justify-center">
      <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      Mengirim...
    </span>
  `;
  button.disabled = true;

  emailjs.sendForm("service_75m60ht", "template_tx5h7y8", form)
    .then(() => {
      fetch('simpan_mongo.php', {
        method: 'POST',
        body: new FormData(form)
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          button.innerHTML = `
            <span class="flex items-center justify-center">
              <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              Terkirim!
            </span>
          `;
          button.className = button.className.replace('from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700', 'from-green-500 to-green-600');

          setTimeout(() => {
            form.reset();
            button.innerHTML = originalText;
            button.className = button.className.replace('from-green-500 to-green-600', 'from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700');
            button.disabled = false;
          }, 2000);
        } else {
          alert('Gagal simpan ke database: ' + data.message);
          button.innerHTML = originalText;
          button.disabled = false;
        }
      })
      .catch(() => {
        alert('Kesalahan saat simpan ke database.');
        button.innerHTML = originalText;
        button.disabled = false;
      });
    })
    .catch((error) => {
      alert("Gagal kirim email: " + error.text);
      button.innerHTML = originalText;
      button.disabled = false;
    });
});

// Fokus input animasi
const inputs = document.querySelectorAll('input, textarea');
inputs.forEach(input => {
  input.addEventListener('focus', function() {
    this.parentElement.classList.add('transform', 'scale-105');
  });
  input.addEventListener('blur', function() {
    this.parentElement.classList.remove('transform', 'scale-105');
  });
});

</script>

</body>
</html>