<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Tabs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen">

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 bg-clip-text text-transparent">
            Pusat Dukungan
        </h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">
            Temukan bantuan yang Anda butuhkan dengan mudah dan cepat
        </p>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap justify-center mb-8 bg-gray-800/50 backdrop-blur-sm rounded-2xl p-2 border border-gray-700/50">
        <button onclick="showTab('pusat-bantuan')" id="tab-pusat-bantuan" class="tab-button active px-6 py-3 rounded-xl font-medium transition-all duration-300 mx-1 mb-2">
            Pusat Bantuan
        </button>
        <button onclick="showTab('faq')" id="tab-faq" class="tab-button px-6 py-3 rounded-xl font-medium transition-all duration-300 mx-1 mb-2">
            FAQ
        </button>
        <button onclick="showTab('kebijakan-privasi')" id="tab-kebijakan-privasi" class="tab-button px-6 py-3 rounded-xl font-medium transition-all duration-300 mx-1 mb-2">
            Kebijakan Privasi
        </button>
        <button onclick="showTab('syarat-ketentuan')" id="tab-syarat-ketentuan" class="tab-button px-6 py-3 rounded-xl font-medium transition-all duration-300 mx-1 mb-2">
            Syarat & Ketentuan
        </button>
    </div>

    <!-- Tab Contents -->
    <div class="max-w-6xl mx-auto">

        <!-- Pusat Bantuan -->
        <div id="pusat-bantuan" class="tab-content animate-fade-in">
            <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 11-9.75 9.75 9.75 9.75 0 019.75-9.75z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white">Pusat Bantuan</h2>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/30 hover:border-blue-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10">
                        <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Live Chat</h3>
                        <p class="text-gray-400 mb-4">Hubungi tim support kami secara langsung untuk bantuan cepat</p>
                        <button class="text-blue-400 hover:text-blue-300 font-medium transition-colors duration-300">Mulai Chat →</button>
                    </div>

                    <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/30 hover:border-purple-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/10">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Email Support</h3>
                        <p class="text-gray-400 mb-4">Kirim pertanyaan detail melalui email dan dapatkan respon dalam 24 jam</p>
                        <button class="text-purple-400 hover:text-purple-300 font-medium transition-colors duration-300">Kirim Email →</button>
                    </div>

                    <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/30 hover:border-pink-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-pink-500/10">
                        <div class="w-10 h-10 bg-pink-500/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Panduan</h3>
                        <p class="text-gray-400 mb-4">Akses koleksi panduan lengkap dan tutorial step-by-step</p>
                        <button class="text-pink-400 hover:text-pink-300 font-medium transition-colors duration-300">Lihat Panduan →</button>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-gradient-to-r from-blue-600/10 to-purple-600/10 rounded-xl border border-blue-500/20">
                    <h3 class="text-xl font-semibold text-white mb-2">Jam Operasional</h3>
                    <p class="text-gray-300 mb-2">Live Chat: 24/7</p>
                    <p class="text-gray-300">Email Support: Senin - Jumat, 09:00 - 18:00 WIB</p>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div id="faq" class="tab-content hidden">
            <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white">Frequently Asked Questions</h2>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-700/30 rounded-xl border border-gray-600/30 overflow-hidden">
                        <button onclick="toggleFaq(1)" class="w-full text-left p-6 hover:bg-gray-600/30 transition-colors duration-300 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white">Bagaimana cara mengubah password akun saya?</h3>
                            <svg id="faq-arrow-1" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="faq-content-1" class="hidden px-6 pb-6">
                            <p class="text-gray-300 leading-relaxed">Untuk mengubah password, masuk ke Pengaturan Akun → Keamanan → Ubah Password. Masukkan password lama dan password baru yang Anda inginkan. Pastikan password baru mengandung minimal 8 karakter dengan kombinasi huruf, angka, dan simbol.</p>
                        </div>
                    </div>

                    <div class="bg-gray-700/30 rounded-xl border border-gray-600/30 overflow-hidden">
                        <button onclick="toggleFaq(2)" class="w-full text-left p-6 hover:bg-gray-600/30 transition-colors duration-300 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white">Bagaimana cara menghubungi customer service?</h3>
                            <svg id="faq-arrow-2" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="faq-content-2" class="hidden px-6 pb-6">
                            <p class="text-gray-300 leading-relaxed">Anda dapat menghubungi customer service melalui live chat 24/7, email di support@example.com, atau telepon di (021) 1234-5678. Tim kami siap membantu Anda dengan respon yang cepat dan profesional.</p>
                        </div>
                    </div>

                    <div class="bg-gray-700/30 rounded-xl border border-gray-600/30 overflow-hidden">
                        <button onclick="toggleFaq(3)" class="w-full text-left p-6 hover:bg-gray-600/30 transition-colors duration-300 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white">Apakah data saya aman?</h3>
                            <svg id="faq-arrow-3" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="faq-content-3" class="hidden px-6 pb-6">
                            <p class="text-gray-300 leading-relaxed">Ya, keamanan data Anda adalah prioritas utama kami. Kami menggunakan enkripsi SSL 256-bit, server yang aman, dan mematuhi standar keamanan internasional. Data Anda tidak akan dibagikan kepada pihak ketiga tanpa persetujuan Anda.</p>
                        </div>
                    </div>

                    <div class="bg-gray-700/30 rounded-xl border border-gray-600/30 overflow-hidden">
                        <button onclick="toggleFaq(4)" class="w-full text-left p-6 hover:bg-gray-600/30 transition-colors duration-300 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white">Bagaimana cara membatalkan pesanan?</h3>
                            <svg id="faq-arrow-4" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="faq-content-4" class="hidden px-6 pb-6">
                            <p class="text-gray-300 leading-relaxed">Pesanan dapat dibatalkan dalam waktu 1 jam setelah pemesanan melalui halaman Riwayat Pesanan. Jika sudah lebih dari 1 jam, silakan hubungi customer service kami untuk bantuan lebih lanjut.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-gray-400 mb-4">Tidak menemukan jawaban yang Anda cari?</p>
                    <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                        Hubungi Support
                    </button>
                </div>
            </div>
        </div>

        <!-- Kebijakan Privasi -->
        <div id="kebijakan-privasi" class="tab-content hidden">
            <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white">Kebijakan Privasi</h2>
                </div>

                <div class="prose prose-invert max-w-none">
                    <div class="bg-gradient-to-r from-purple-600/10 to-pink-600/10 rounded-xl p-6 border border-purple-500/20 mb-6">
                        <p class="text-gray-300 text-sm mb-2">Terakhir diperbarui: 24 Mei 2025</p>
                        <p class="text-gray-300">Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.</p>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-purple-500">
                            <h3 class="text-xl font-semibold text-white mb-3">1. Informasi yang Kami Kumpulkan</h3>
                            <p class="text-gray-300 leading-relaxed">Kami mengumpulkan informasi yang Anda berikan secara langsung, seperti nama, email, nomor telepon, dan alamat. Kami juga mengumpulkan informasi secara otomatis melalui penggunaan layanan kami, termasuk data penggunaan, alamat IP, dan informasi perangkat.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-blue-500">
                            <h3 class="text-xl font-semibold text-white mb-3">2. Penggunaan Informasi</h3>
                            <p class="text-gray-300 leading-relaxed">Informasi yang kami kumpulkan digunakan untuk menyediakan dan meningkatkan layanan kami, memproses transaksi, mengirim komunikasi penting, dan memberikan dukungan pelanggan. Kami juga menggunakan informasi untuk analisis dan pengembangan produk.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-green-500">
                            <h3 class="text-xl font-semibold text-white mb-3">3. Keamanan Data</h3>
                            <p class="text-gray-300 leading-relaxed">Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Data Anda dienkripsi menggunakan teknologi SSL/TLS terbaru.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-yellow-500">
                            <h3 class="text-xl font-semibold text-white mb-3">4. Hak Anda</h3>
                            <p class="text-gray-300 leading-relaxed">Anda memiliki hak untuk mengakses, memperbarui, atau menghapus informasi pribadi Anda. Anda juga dapat meminta pembatasan pemrosesan data atau meminta portabilitas data. Untuk menggunakan hak-hak ini, silakan hubungi kami melalui kontak yang tersedia.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-red-500">
                            <h3 class="text-xl font-semibold text-white mb-3">5. Cookie dan Teknologi Pelacakan</h3>
                            <p class="text-gray-300 leading-relaxed">Kami menggunakan cookie dan teknologi pelacakan serupa untuk meningkatkan pengalaman pengguna, menganalisis penggunaan situs, dan menyesuaikan konten. Anda dapat mengatur preferensi cookie melalui pengaturan browser Anda.</p>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-gradient-to-r from-purple-600/10 to-pink-600/10 rounded-xl border border-purple-500/20">
                        <h3 class="text-lg font-semibold text-white mb-2">Pertanyaan tentang Privasi?</h3>
                        <p class="text-gray-300">Jika Anda memiliki pertanyaan atau kekhawatiran tentang kebijakan privasi kami, jangan ragu untuk menghubungi tim privasi kami di privacy@example.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Syarat & Ketentuan -->
        <div id="syarat-ketentuan" class="tab-content hidden">
            <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white">Syarat & Ketentuan</h2>
                </div>

                <div class="prose prose-invert max-w-none">
                    <div class="bg-gradient-to-r from-orange-600/10 to-red-600/10 rounded-xl p-6 border border-orange-500/20 mb-6">
                        <p class="text-gray-300 text-sm mb-2">Berlaku sejak: 24 Mei 2025</p>
                        <p class="text-gray-300">Dengan menggunakan layanan kami, Anda setuju untuk terikat oleh syarat dan ketentuan berikut.</p>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-orange-500">
                            <h3 class="text-xl font-semibold text-white mb-3">1. Penerimaan Syarat</h3>
                            <p class="text-gray-300 leading-relaxed">Dengan mengakses dan menggunakan layanan kami, Anda menyatakan bahwa Anda telah membaca, memahami, dan setuju untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan syarat-syarat ini, harap berhenti menggunakan layanan kami.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-blue-500">
                            <h3 class="text-xl font-semibold text-white mb-3">2. Penggunaan Layanan</h3>
                            <p class="text-gray-300 leading-relaxed mb-3">Anda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah dan sesuai dengan syarat-syarat ini. Anda dilarang:</p>
                            <ul class="text-gray-300 space-y-1 ml-4">
                                <li>• Menggunakan layanan untuk aktivitas ilegal atau tidak sah</li>
                                <li>• Mengganggu atau merusak infrastruktur layanan</li>
                                <li>• Menyalahgunakan atau mencoba mengakses akun pengguna lain</li>
                                <li>• Mengirim spam atau konten berbahaya lainnya</li>
                            </ul>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-green-500">
                            <h3 class="text-xl font-semibold text-white mb-3">3. Akun Pengguna</h3>
                            <p class="text-gray-300 leading-relaxed">Anda bertanggung jawab untuk menjaga kerahasiaan informasi akun Anda dan semua aktivitas yang terjadi dalam akun Anda. Anda harus segera memberi tahu kami jika terjadi penggunaan akun yang tidak sah atau pelanggaran keamanan lainnya.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-purple-500">
                            <h3 class="text-xl font-semibold text-white mb-3">4. Pembayaran dan Penagihan</h3>
                            <p class="text-gray-300 leading-relaxed">Semua biaya layanan harus dibayar sesuai dengan paket dan periode yang dipilih. Pembayaran yang sudah dilakukan tidak dapat dikembalikan kecuali dalam kondisi tertentu yang diatur dalam kebijakan pengembalian dana kami.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-red-500">
                            <h3 class="text-xl font-semibold text-white mb-3">5. Batasan Tanggung Jawab</h3>
                            <p class="text-gray-300 leading-relaxed">Kami tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, khusus, atau konsekuensial yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan layanan kami, kecuali sebagaimana diatur dalam hukum yang berlaku.</p>
                        </div>

                        <div class="bg-gray-700/20 rounded-lg p-6 border-l-4 border-yellow-500">
                            <h3 class="text-xl font-semibold text-white mb-3">6. Perubahan Syarat</h3>
                            <p class="text-gray-300 leading-relaxed">Kami berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan diberitahukan melalui email atau notifikasi di platform kami. Penggunaan layanan setelah perubahan dianggap sebagai penerimaan terhadap syarat yang baru.</p>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-gradient-to-r from-orange-600/10 to-red-600/10 rounded-xl border border-orange-500/20">
                        <h3 class="text-lg font-semibold text-white mb-2">Hubungi Tim Legal</h3>
                        <p class="text-gray-300">Untuk pertanyaan hukum atau terkait syarat dan ketentuan, silakan hubungi legal@example.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabId) {