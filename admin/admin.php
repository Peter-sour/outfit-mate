
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN</title>
  <link rel="stylesheet" href="admin.css">
  <!-- Include jQuery and Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
  .footer-content {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-color: #5b21b6;
    color: white;
    width: 100%;
    padding: 15px ;
    margin-top: 0;
    margin-bottom: 0;
    font-size: 14px;
    color: #fff;
  }
  </style>
</head>
<body>
    <section class="dashboard-preview">
          <div class="container">
            <!-- <div class="section-title">
              <h2>Dashboard Pribadi Anda</h2>
              <p>Kelola koleksi pakaian dan lihat rekomendasi outfit harian</p>
            </div> -->
            <div class="dashboard-container">
              <div class="dashboard-header">
                <h3>OutfitMate Dashboard</h3>
                <!-- <div>
                  Halo,!
                </div> -->
                <div class="logout">
                  <a href="$">Logout</a>
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
                  <h3>Selamat Pagi,!</h3>
                  <p>Cek update outfit terbaru kamu di bawah ini:</p>
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
                </div>
                <div id="koleksi" class="page" style="display: none;">
                    <form action="add-outfit.php" method="POST" enctype="multipart/form-data">
                      <h2>Tambah Outfit Baru</h2>
                      <div class="koleksi-name">
                        <div class="koleksi-name-1">
                          <label>Nama Outfit:</label><br>
                          <input type="text" name="name" required><br><br>
                        </div>
                        <div class="koleksi-name-2">
                          <label>Umur:</label><br>
                          <select name="umur">
                            <option value="">Pilih umur</option>
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
                      </div>

                      <div class="koleksi-type">
                        <div class="koleksi-type-1">
                          <!-- <label>Warna:</label><br>
                          <input type="text" name="color" required><br><br> -->
                          <label>Jenis Kelamin:</label><br>
                          <select name="kelamin">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Non-biner">Non-biner</option>
                            <option value="Lainnya">Lainnya</option>
                            <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                          </select>
                        </div>
                        <div class="koleksi-type-2">
                          <label>Cuaca yang Cocok:</label><br>
                          <select name="weather">
                            <option value="Sunny">Sunny</option>
                            <option value="Rain">Rain</option>
                            <option value="Cold">Cold</option>
                            <option value="Cloudy">Cloudy</option>
                            <option value="Snow">Snow</option>
                            <option value="Windy">Windy</option>
                          </select>
                        </div>
                      </div>

                      <div class="koleksi-preview">
                        <div class="koleksi-preview-1">
                          <label for="acara">Acara:</label><br>
                          <select id="acara" name="event" required style="width: 100%;" height="80px">
                            <option value="">-- Pilih atau ketik acara --</option>
                            <option value="Pesta">Pesta</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Santai">Santai</option>
                            <option value="Kerja">Kerja</option>
                            <option value="Sekolah">Sekolah</option>
                            <option value="Lainnya">Lainnya</option>
                          </select>
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
                <div id="tersimpan" class="page" style="display: none;">
                  <iframe src="../dasboard/koleksi.php" frameborder="0"></iframe>
                </div>
                <i id="rekomendasi" class="page" style="display: none;">
                  <!-- Form untuk memilih cuaca -->
                  <form method="POST" action="recomendation.php" id="rekomendasi-outfit">
                      <label for="cuaca">Pilih Cuaca:</label>
                      <select name="cuaca" id="cuaca" required >
                          <option value="">-- Pilih Cuaca --</option>
                          <option value="Sunny">Sunny</option>
                          <option value="Rain">Rain</option>
                          <option value="Cold">Cold</option>
                          <option value="Cloudy">Cloudy</option>
                          <option value="Snow">Snow</option>
                          <option value="Windy">Windy</option>
                      </select>
                      <button type="submit">Tampilkan Rekomendasi</button>
                  </form>
                  <div id="hasil"></div>
                </i>
                <div id="kalendar" class="page" style="display: none;">ini halaman kalendar outfit</div>
              </div>
            </div>
          </div>
        </section>
        <section class="footer-content">
            <h5>&copy; 2023 OutfitMate. All rights reserved.</h5>
          </section>
        <script src="../dasboard/page.js"></script>
        <script>
          $(document).ready(function() {
            $('#acara').select2({
              placeholder: 'Pilih atau ketik acara...'
            });
          });
        </script>
        <script>
  function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block'; // Show image
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = '';
      preview.style.display = 'none'; // Hide image if not valid
      alert('Please select a valid image file.');
    }
  }
</script>   
</body>
</html>