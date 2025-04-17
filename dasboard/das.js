// Konfigurasi dasar
const config = {
    weatherApiKey: 'YOUR_WEATHER_API_KEY', // Ganti dengan API key yang sebenarnya
    defaultLocation: 'Jakarta',
    outfitCategories: ['casual', 'formal', 'party', 'sport', 'beach'],
    weatherConditions: ['sunny', 'rainy', 'cloudy', 'windy', 'snowy'],
  };
  
  // Data dummy untuk demonstrasi
  const dummyData = {
    userOutfits: [
      { id: 1, name: 'Kemeja Biru', type: 'top', category: 'formal', color: 'blue', imageUrl: '/api/placeholder/150/150' },
      { id: 2, name: 'Celana Chino Hitam', type: 'bottom', category: 'formal', color: 'black', imageUrl: '/api/placeholder/150/150' },
      { id: 3, name: 'Kaos Putih', type: 'top', category: 'casual', color: 'white', imageUrl: '/api/placeholder/150/150' },
      { id: 4, name: 'Jeans Biru', type: 'bottom', category: 'casual', color: 'blue', imageUrl: '/api/placeholder/150/150' },
      { id: 5, name: 'Jaket Denim', type: 'outer', category: 'casual', color: 'blue', imageUrl: '/api/placeholder/150/150' },
      { id: 6, name: 'Dress Merah', type: 'dress', category: 'party', color: 'red', imageUrl: '/api/placeholder/150/150' },
      { id: 7, name: 'Sepatu Running', type: 'shoes', category: 'sport', color: 'black', imageUrl: '/api/placeholder/150/150' },
      { id: 8, name: 'Tas Tote Coklat', type: 'accessory', category: 'casual', color: 'brown', imageUrl: '/api/placeholder/150/150' },
    ],
    savedOutfits: [
      { 
        id: 1, 
        name: 'Business Meeting', 
        items: [1, 2], 
        occasion: 'formal', 
        weather: 'sunny',
        lastWorn: '2025-04-10' 
      },
      { 
        id: 2, 
        name: 'Weekend Casual', 
        items: [3, 4, 5], 
        occasion: 'casual', 
        weather: 'cloudy',
        lastWorn: '2025-04-15' 
      },
    ],
    weatherData: {
      current: {
        temp: 29,
        condition: 'Cerah Berawan',
        humidity: 70,
        windSpeed: 10,
        feelsLike: 32,
        icon: '☀️'
      },
      forecast: [
        { day: 'Rabu', temp: 30, condition: 'Sunny', icon: '☀️' },
        { day: 'Kamis', temp: 28, condition: 'Cloudy', icon: '☁️' },
        { day: 'Jumat', temp: 29, condition: 'Partly Cloudy', icon: '⛅' },
        { day: 'Sabtu', temp: 27, condition: 'Rain', icon: '🌧️' },
        { day: 'Minggu', temp: 28, condition: 'Cloudy', icon: '☁️' },
      ]
    }
  };
  
  // DOM Content Loaded Handler
  document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi aplikasi
    initApp();
    
    // Event listeners untuk navigasi dan tombol
    setupEventListeners();
    
    // Tampilkan data cuaca
    displayWeather();
    
    // Tampilkan rekomendasi outfit
    displayOutfitRecommendations();
  });
  
  // Inisialisasi Aplikasi
  function initApp() {
    console.log('OutfitMate Application Initialized');
    
    // Cek status login pengguna
    checkUserLoginStatus();
    
    // Load data pengguna jika sudah login
    if (isUserLoggedIn()) {
      loadUserData();
    }
  }
  
  // Setup Event Listeners
  function setupEventListeners() {
    // Tombol login dan signup
    const loginBtn = document.querySelector('.btn-outline');
    const signupBtn = document.querySelector('.btn-primary');
    
    if (loginBtn) {
      loginBtn.addEventListener('click', () => {
        showLoginModal();
      });
    }
    
    if (signupBtn) {
      signupBtn.addEventListener('click', () => {
        showSignupModal();
      });
    }
    
    // Tombol "Mulai Sekarang"
    const startNowBtn = document.querySelector('.hero-buttons .btn-primary');
    if (startNowBtn) {
      startNowBtn.addEventListener('click', () => {
        if (isUserLoggedIn()) {
          window.location.href = '/dashboard';
        } else {
          showSignupModal();
        }
      });
    }
    
    // Tombol "Lihat Rekomendasi Hari Ini"
    const seeRecommendationBtn = document.querySelector('.weather-info .btn-primary');
    if (seeRecommendationBtn) {
      seeRecommendationBtn.addEventListener('click', () => {
        if (isUserLoggedIn()) {
          window.location.href = '/recommendations';
        } else {
          showLoginModal();
          showNotification('Anda perlu login untuk melihat rekomendasi');
        }
      });
    }
    
    // Setup menu dashboard jika ada
    setupDashboardMenu();
    
    // Tambahkan event listener untuk resize window (responsive design)
    window.addEventListener('resize', handleWindowResize);
  }
  
  // Fungsi untuk menampilkan data cuaca
  function displayWeather() {
    // Jika ada elemen cuaca di halaman
    const weatherCard = document.querySelector('.weather-card');
    if (!weatherCard) return;
    
    // Di implementasi nyata, kita akan mengambil data cuaca dari API
    // Tapi untuk demo, kita gunakan data dummy
    const { current } = dummyData.weatherData;
    
    // Update elemen HTML dengan data cuaca
    const temperatureElement = weatherCard.querySelector('.weather-temperature');
    const conditionElement = weatherCard.querySelector('p');
    const weatherIcon = weatherCard.querySelector('.weather-icon');
    const humidityElement = weatherCard.querySelector('.weather-detail:nth-child(1) span');
    const windElement = weatherCard.querySelector('.weather-detail:nth-child(2) span');
    const feelsLikeElement = weatherCard.querySelector('.weather-detail:nth-child(3) span');
    
    if (temperatureElement) temperatureElement.textContent = `${current.temp}°C`;
    if (conditionElement) conditionElement.textContent = current.condition;
    if (weatherIcon) weatherIcon.textContent = current.icon;
    if (humidityElement) humidityElement.textContent = `${current.humidity}% Kelembaban`;
    if (windElement) windElement.textContent = `${current.windSpeed} km/j Angin`;
    if (feelsLikeElement) feelsLikeElement.textContent = `Terasa seperti ${current.feelsLike}°C`;
  }
  
  // Fungsi untuk menampilkan rekomendasi outfit
  function displayOutfitRecommendations() {
    // Tampilkan rekomendasi outfit di dashboard jika ada
    const outfitGrid = document.querySelector('.outfit-grid');
    if (!outfitGrid) return;
    
    // Di implementasi nyata, kita akan mengambil rekomendasi berdasarkan algoritma
    // Tapi untuk demo, kita gunakan data dummy
    
    // Mendapatkan outfit yang direkomendasikan berdasarkan cuaca dan acara
    const recommendedOutfit = getRecommendedOutfit('casual', dummyData.weatherData.current.condition);
    
    // Kosongkan grid terlebih dahulu
    outfitGrid.innerHTML = '';
    
    // Jika tidak ada rekomendasi
    if (!recommendedOutfit) {
      outfitGrid.innerHTML = '<p>Tidak ada rekomendasi outfit saat ini.</p>';
      return;
    }
    
    // Dapatkan item dari outfit yang direkomendasikan
    const outfitItems = recommendedOutfit.items.map(itemId => 
      dummyData.userOutfits.find(item => item.id === itemId)
    );
    
    // Render setiap item outfit
    outfitItems.forEach(item => {
      if (!item) return;
      
      const itemElement = document.createElement('div');
      itemElement.className = 'outfit-item';
      itemElement.innerHTML = `
        <img src="${item.imageUrl}" alt="${item.name}">
      `;
      
      // Tambahkan event untuk melihat detail item
      itemElement.addEventListener('click', () => {
        showOutfitItemDetail(item);
      });
      
      outfitGrid.appendChild(itemElement);
    });
  }
  
  // Fungsi untuk mendapatkan rekomendasi outfit berdasarkan cuaca dan acara
  function getRecommendedOutfit(occasion, weatherCondition) {
    // Logika untuk menentukan outfit yang cocok berdasarkan cuaca dan acara
    // Ini akan menjadi algoritma inti dari aplikasi
    
    // Untuk demo, kita gunakan data dummy
    let matchedOutfit = dummyData.savedOutfits.find(outfit => {
      // Prioritaskan kecocokan acara dan cuaca
      return outfit.occasion === occasion && 
             weatherMatchesCondition(outfit.weather, weatherCondition);
    });
    
    // Jika tidak ada yang cocok sempurna, coba cari yang cocok dengan acara saja
    if (!matchedOutfit) {
      matchedOutfit = dummyData.savedOutfits.find(outfit => outfit.occasion === occasion);
    }
    
    return matchedOutfit;
  }
  
  // Fungsi untuk memeriksa kecocokan cuaca
  function weatherMatchesCondition(outfitWeather, currentWeather) {
    // Logika sederhana: jika mengandung kata kunci yang sama
    const outfitWeatherLower = outfitWeather.toLowerCase();
    const currentWeatherLower = currentWeather.toLowerCase();
    
    if (outfitWeatherLower === 'any') return true;
    
    // Mapping kondisi cuaca Bahasa Indonesia ke kategori
    const weatherMapping = {
      'cerah': 'sunny',
      'berawan': 'cloudy',
      'hujan': 'rainy',
      'angin': 'windy'
    };
    
    // Cek untuk setiap kata kunci dalam kondisi cuaca saat ini
    for (const [indo, eng] of Object.entries(weatherMapping)) {
      if (currentWeatherLower.includes(indo) && outfitWeatherLower === eng) {
        return true;
      }
    }
    
    return false;
  }
  
  // Fungsi untuk menampilkan detail item outfit
  function showOutfitItemDetail(item) {
    // Kode untuk menampilkan modal dengan detail item
    console.log('Showing detail for:', item.name);
    
    // Contoh implementasi modal sederhana
    const modal = document.createElement('div');
    modal.className = 'outfit-modal';
    modal.innerHTML = `
      <div class="outfit-modal-content">
        <span class="close-btn">&times;</span>
        <img src="${item.imageUrl}" alt="${item.name}">
        <h3>${item.name}</h3>
        <p>Kategori: ${item.category}</p>
        <p>Tipe: ${item.type}</p>
        <p>Warna: ${item.color}</p>
      </div>
    `;
    
    document.body.appendChild(modal);
    
    // Event listener untuk tombol tutup
    const closeBtn = modal.querySelector('.close-btn');
    closeBtn.addEventListener('click', () => {
      document.body.removeChild(modal);
    });
    
    // Tambahkan style untuk modal
    const style = document.createElement('style');
    style.textContent = `
      .outfit-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
      }
      
      .outfit-modal-content {
        background-color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        max-width: 80%;
        max-height: 80%;
        overflow: auto;
        position: relative;
      }
      
      .close-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
      }
    `;
    
    document.head.appendChild(style);
  }
  
  // Fungsi untuk setup menu dashboard
  function setupDashboardMenu() {
    const dashboardMenu = document.querySelector('.dashboard-menu');
    if (!dashboardMenu) return;
    
    // Tambahkan event listener ke item menu
    const menuItems = dashboardMenu.querySelectorAll('a');
    
    menuItems.forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Hapus kelas active dari semua item
        menuItems.forEach(i => i.classList.remove('active'));
        
        // Tambahkan kelas active ke item yang diklik
        item.classList.add('active');
        
        // Simulasi navigasi dashboard (di implementasi nyata, ini akan menavigasi ke halaman yang sesuai)
        const targetSection = item.textContent.trim();
        console.log(`Navigating to: ${targetSection}`);
        
        // Update konten dashboard (ini hanya simulasi)
        updateDashboardContent(targetSection);
      });
    });
  }
  
  // Fungsi untuk update konten dashboard
  function updateDashboardContent(section) {
    const dashboardMain = document.querySelector('.dashboard-main');
    if (!dashboardMain) return;
    
    // Konten berbeda untuk setiap bagian
    let content = '';
    
    switch(section) {
      case 'Beranda':
        content = `
          <h3>Selamat Pagi, Jessica!</h3>
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
            <!-- Items will be populated by displayOutfitRecommendations() -->
          </div>
        `;
        break;
      case 'Koleksi Pakaian':
        content = `
          <h3>Koleksi Pakaian Anda</h3>
          <div class="filter-controls">
            <select id="category-filter">
              <option value="">Semua Kategori</option>
              <option value="casual">Casual</option>
              <option value="formal">Formal</option>
              <option value="party">Party</option>
              <option value="sport">Sport</option>
            </select>
            <select id="type-filter">
              <option value="">Semua Tipe</option>
              <option value="top">Atasan</option>
              <option value="bottom">Bawahan</option>
              <option value="outer">Luaran</option>
              <option value="dress">Dress</option>
              <option value="shoes">Sepatu</option>
              <option value="accessory">Aksesoris</option>
            </select>
            <button class="btn btn-primary" id="add-item-btn">+ Tambah Item</button>
          </div>
          <div class="wardrobe-grid">
            ${dummyData.userOutfits.map(item => `
              <div class="wardrobe-item">
                <img src="${item.imageUrl}" alt="${item.name}">
                <h4>${item.name}</h4>
                <p>${item.category} • ${item.type}</p>
              </div>
            `).join('')}
          </div>
        `;
        break;
      case 'Outfit Tersimpan':
        content = `
          <h3>Outfit Tersimpan</h3>
          <p>Koleksi outfit yang telah Anda susun dan simpan.</p>
          <div class="saved-outfits">
            ${dummyData.savedOutfits.map(outfit => `
              <div class="saved-outfit-card">
                <h4>${outfit.name}</h4>
                <div class="outfit-preview">
                  ${outfit.items.slice(0, 3).map(itemId => {
                    const item = dummyData.userOutfits.find(i => i.id === itemId);
                    return item ? `<img src="${item.imageUrl}" alt="${item.name}">` : '';
                  }).join('')}
                  ${outfit.items.length > 3 ? `<span>+${outfit.items.length - 3}</span>` : ''}
                </div>
                <p>Acara: ${outfit.occasion}</p>
                <p>Cuaca: ${outfit.weather}</p>
                <p>Terakhir dipakai: ${formatDate(outfit.lastWorn)}</p>
                <div class="outfit-actions">
                  <button class="btn btn-outline btn-sm">Edit</button>
                  <button class="btn btn-primary btn-sm">Pakai Hari Ini</button>
                </div>
              </div>
            `).join('')}
          </div>
          <button class="btn btn-primary" id="create-outfit-btn">+ Buat Outfit Baru</button>
        `;
        break;
      case 'Rekomendasi':
        content = `
          <h3>Rekomendasi Outfit</h3>
          <div class="recommendation-options">
            <div class="recommendation-card">
              <h4>Berdasarkan Cuaca</h4>
              <p>Lihat rekomendasi outfit berdasarkan kondisi cuaca saat ini di lokasi Anda.</p>
              <div class="current-weather">
                <div class="weather-icon">${dummyData.weatherData.current.icon}</div>
                <div class="weather-info">
                  <span>${dummyData.weatherData.current.temp}°C</span>
                  <span>${dummyData.weatherData.current.condition}</span>
                </div>
              </div>
              <button class="btn btn-primary">Lihat Rekomendasi</button>
            </div>
            <div class="recommendation-card">
              <h4>Berdasarkan Acara</h4>
              <p>Pilih jenis acara dan dapatkan outfit yang cocok untuk kesempatan tersebut.</p>
              <select id="occasion-select">
                <option value="casual">Santai / Casual</option>
                <option value="formal">Formal / Bisnis</option>
                <option value="party">Pesta / Malam</option>
                <option value="sport">Olahraga</option>
                <option value="beach">Pantai</option>
              </select>
              <button class="btn btn-primary">Lihat Rekomendasi</button>
            </div>
          </div>
          <h4>Riwayat Outfit</h4>
          <div class="outfit-history">
            <div class="outfit-calendar">
              <div class="calendar-header">
                <button class="btn-icon">&lt;</button>
                <h5>April 2025</h5>
                <button class="btn-icon">&gt;</button>
              </div>
              <div class="calendar-grid">
                <!-- Calendar days will be generated here -->
              </div>
            </div>
          </div>
        `;
        break;
      default:
        content = `<h3>${section}</h3><p>Konten untuk ${section} sedang dipersiapkan.</p>`;
    }
    
    dashboardMain.innerHTML = content;
    
    // Setup tambahan setelah render konten
    if (section === 'Beranda') {
      displayOutfitRecommendations();
    } else if (section === 'Rekomendasi') {
      // Setup calendar
      const calendarGrid = document.querySelector('.calendar-grid');
      if (calendarGrid) {
        generateCalendarDays(calendarGrid);
      }
    }
  }
  
  // Fungsi untuk menghasilkan hari-hari pada kalender
  function generateCalendarDays(calendarGrid) {
    // Buat header hari
    const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    days.forEach(day => {
      const dayElement = document.createElement('div');
      dayElement.className = 'calendar-day-header';
      dayElement.textContent = day;
      calendarGrid.appendChild(dayElement);
    });
    
    // Dummy: April 2025 dimulai dari hari Selasa (indeks 1)
    // Tambahkan cell kosong untuk hari-hari sebelum 1 April
    const startDay = 1; // 0 = Minggu, 1 = Senin, dst.
    for (let i = 0; i < startDay; i++) {
      const emptyDay = document.createElement('div');
      emptyDay.className = 'calendar-day empty';
      calendarGrid.appendChild(emptyDay);
    }
    
    // Tambahkan 30 hari untuk April
    for (let i = 1; i <= 30; i++) {
      const dayElement = document.createElement('div');
      dayElement.className = 'calendar-day';
      
      // Tambahkan indikator jika hari ini
      if (i === 17) { // Tanggal hari ini
        dayElement.classList.add('today');
      }
      
      // Tambahkan indikator jika ada outfit yang dipakai
      if ([5, 10, 15].includes(i)) {
        dayElement.classList.add('has-outfit');
      }
      
      dayElement.textContent = i;
      calendarGrid.appendChild(dayElement);
      
      // Event listener untuk melihat outfit
      dayElement.addEventListener('click', () => {
        console.log(`Viewing outfit for April ${i}, 2025`);
        // Implementasi untuk menampilkan outfit yang dipakai pada tanggal tersebut
      });
    }
  }
  
  // Fungsi untuk memformat tanggal
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', { 
      day: 'numeric',
      month: 'long',
      year: 'numeric'
    });
  }
  