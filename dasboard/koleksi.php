<?php
session_start(); // Memulai session untuk mengambil firstname
// Mengambil firstname dari session
// Membuat koneksi ke database
$conn = new mysqli("localhost", "root", "", "outfit_mate"); // Ganti dengan username dan password database Anda

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


// Menggunakan JOIN untuk mengambil data outfit dan user_id sekaligus
$sql = "
    SELECT outfit_id, age_group, gender, event_type, outfit_name, caption, image_path, weather
FROM outfits;";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $outfit_id); // "s" untuk string
// $stmt->execute();
$result = $conn->query($sql);

// Menampilkan data outfit
if ($result->num_rows > 0) {
    // CSS untuk styling
    echo '<style>
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
    .btn-delete {
        background-color: #e74c3c;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        margin-top: 10px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s ease-in-out;
    }
    .btn-delete:hover {
        background-color: #c0392b;
        transform: scale(1.05);
    }
    .btn-delete:active {
        background-color: #a93226;
        transform: scale(1);
    }
    .edit-btn {
        background-color: #3498db;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        margin-top: 10px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s ease-in-out;
    }
    .edit-btn:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }
    .edit-btn:active {
        background-color: #216a9e;
        transform: scale(1);
    }

    /* Modal overlay */
    .modal {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    /* Modal content box */
    .modal-content {
        background-color: #fff;
        padding: 10px 15px;
        border-radius: 12px;
        max-width: 500px;
        width: 100%;
        position: absolute;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
    }
        #editForm{
        overflow-y:scroll;
        }
    /* Close button */
    .close {
        position: absolute;
        top: 12px;
        right: 18px;
        font-size: 28px;
        color: #888;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .close:hover {
        color: #333;
    }

    /* Form elements */
    .modal-content form label {
        display: block;
        margin: 12px 0 6px;
        font-weight: 500;
    }

    .modal-content form input[type="text"],
    .modal-content form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        resize: vertical;
    }

    /* Upload box */
    .upload{
    display:flex;
    flex-wrap:wrap;
    flex-direction : row;
    justify-content: center;
    gap:10px;
    }
    .upload-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #aaa;
        border-radius: 10px;
        padding: 20px;
        max-width: 30%;
        margin-top: 10px;
        cursor: pointer;
        text-align: center;
        transition: border-color 0.3s;
    }
    .upload-box:hover {
        border-color: #555;
    }
    .upload-box.dragover {
        border-color: #3498db;
        background-color: rgba(52, 152, 219, 0.1);
    }
    .upload-icon {
        font-size: 24px;
        color: #777;
    }
    .text-upload {
        font-size: 14px;
        color: #666;
        margin-top: 8px;
    }
    .upload-box input[type="file"] {
        display: none;
    }
    #preview {
        margin-top: 10px;
        width: 200px;
        height : 150px;
        border-radius: 8px;
    }

    /* Buttons */
    .modal-content button {
        margin: 10px 5px 0 0;
        padding: 10px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    .modal-content button[type="button"].btn-cancel {
        background-color: #ccc;
    }
    .modal-content button:hover {
        background-color: #45a049;
    }
    .modal-content button[type="button"].btn-cancel:hover {
        background-color: #bbb;
    }

    /* Preview section */
    #previewSection {
        margin-top: 20px;
    }

    /* Animasi */
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    </style>';

    echo "<div class='outfit-grid'>";
    while ($row = $result->fetch_assoc()) {
        // Display outfit information
        echo "<div class='outfit-card'>";
        echo "<div class='outfit-image'>";
        echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['outfit_name']) . "'>";
        echo "</div>";
        echo "<div class='outfit-info'>";
        echo "<h3 class='outfit-name'>" . htmlspecialchars($row['outfit_name']) . "</h3>";
        echo "<p class='outfit-detail'>Category: <span>" . htmlspecialchars($row['caption']) . "</span></p>";

        // Form untuk delete outfit
        echo "<form method='POST' action='delete_from.php'>";
        echo "<input type='hidden' name='outfit_id' value='" . $row['outfit_id'] . "'>";
        echo "<button type='submit' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus outfit ini?\")'>Delete</button>";
        echo "</form>";

        // Button untuk edit outfit
        echo "<button type='button' class='edit-btn' onclick='openEditModal(\"" .
             $row['outfit_id'] . "\", \"" .
             htmlspecialchars(addslashes($row['outfit_name'])) . "\", \"" .
             htmlspecialchars(addslashes($row['caption'])) . "\", \"" .
             htmlspecialchars(addslashes($row['image_path'])) .
             "\")'>Edit</button>";

        echo "</div>"; // close outfit-info
        echo "</div>"; // close outfit-card
    }
    echo "</div>"; // close outfit-grid

    // Modal untuk edit outfit
    echo '<div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Outfit</h2>
            <form id="editForm" method="POST" action="update_outfit.php" enctype="multipart/form-data">
                <input type="hidden" name="outfit_id" id="editId">

                <label for="editName">Nama Outfit</label>
                <input type="text" name="outfit_name" id="editName" required><br>

                <label for="editCaption">Deskripsi</label>
                <textarea name="caption" id="editCaption"></textarea><br>

                <label for="currentImage">Gambar Saat Ini:</label>
                <input type="text" name="current_image_path" id="currentImage" readonly><br>

                <div class="upload">
                    <div class="upload-box" id="dropArea">
                        <div class="upload-icon">＋</div>
                        <div class="text-upload">Klik atau drop untuk upload gambar baru</div>
                        <input type="file" name="image" id="imageUpload" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <img id="preview" alt="Image Preview" style="display: none;  margin-top: 10px;">
                </div>

                <div style="margin-top: 20px;">
                    <button type="button" onclick="previewEdit()">Preview</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                </div>

                <div id="previewSection" style="display:none; margin-top:15px;">
                    <h3>Preview:</h3>
                    <div class="outfit-card" style="max-width:300px;">
                        <div class="outfit-image">
                            <img id="previewImg" style="width:100%; height:200px; object-fit:cover;">
                        </div>
                        <div class="outfit-info">
                            <h3 id="previewName"></h3>
                            <p id="previewCaption"></p>
                        </div>
                        <button type="submit">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>';
} else{
  echo "tidak ada data ditemukan";
}
$conn->close();
?>
<script>
// Fungsi untuk membuka modal edit
function openEditModal(id, name, caption, image) {
    document.getElementById("editId").value = id;
    document.getElementById("editName").value = name;
    document.getElementById("editCaption").value = caption;
    document.getElementById("currentImage").value = image;

    // Reset preview image
    document.getElementById("preview").style.display = "none";
    document.getElementById("previewSection").style.display = "none";

    // Tampilkan modal
    document.getElementById("editModal").style.display = "flex";
}

// Fungsi untuk menutup modal
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
    document.getElementById("editForm").reset();
}

// Fungsi untuk preview image yang diupload
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("preview");

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}

// Fungsi untuk preview edit sebelum submit
function previewEdit() {
    const name = document.getElementById("editName").value;
    const caption = document.getElementById("editCaption").value;
    const fileInput = document.getElementById("imageUpload");

    // Set preview name dan caption
    document.getElementById("previewName").innerText = name;
    document.getElementById("previewCaption").innerText = caption;

    // Set preview image
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("previewImg").src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        // Gunakan gambar yang sudah ada jika tidak ada upload baru
        document.getElementById("previewImg").src = document.getElementById("currentImage").value;
    }

    // Tampilkan section preview
    document.getElementById("previewSection").style.display = "block";
}

// Handle drag & drop untuk upload gambar
function handleDragOver(event) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("dropArea").classList.add("dragover");
}

function handleDragLeave(event) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("dropArea").classList.remove("dragover");
}

function handleDrop(event) {
    event.preventDefault();
    event.stopPropagation();

    document.getElementById("dropArea").classList.remove("dragover");

    const dt = event.dataTransfer;
    const files = dt.files;

    if (files.length > 0) {
        const fileInput = document.getElementById("imageUpload");
        fileInput.files = files;
        previewImage({ target: { files: files } });
    }
}

// Submit form dengan AJAX
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById("editForm");

    if (editForm) {
        editForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("update_outfit.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(res => {
                alert(res);
                closeEditModal();
                location.reload(); // Refresh halaman untuk menampilkan data terbaru
            })
            .catch(error => {
                alert("Error: " + error);
            });
        });

        // Setup drag & drop listeners
        const dropArea = document.getElementById("dropArea");
        if (dropArea) {
            dropArea.addEventListener("dragover", handleDragOver);
            dropArea.addEventListener("dragleave", handleDragLeave);
            dropArea.addEventListener("drop", handleDrop);
        }
    }
});
</script>
