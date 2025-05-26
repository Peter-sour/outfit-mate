<?php
$conn = new mysqli("localhost", "root", "", "outfit_mate");

$age_group = $_GET['umur'] ?? '';
$gender = $_GET['kelamin'] ?? '';
$event_type = $_GET['event'] ?? '';

$query = "SELECT * FROM outfits WHERE 1";
$params = [];
$types = "";

if ($age_group !== "") {
    $query .= " AND age_group = ?";
    $params[] = $age_group;
    $types .= "s";
}
if ($gender !== "") {
    $query .= " AND gender = ?";
    $params[] = $gender;
    $types .= "s";
}
if ($event_type !== "") {
    $query .= " AND event_type = ?";
    $params[] = $event_type;
    $types .= "s";
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
  <!-- Image Section -->
  <div class="relative overflow-hidden">
    <img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["outfit_name"]) . '" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
  </div>

  <!-- Header Section -->
  <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-4">
    <h3 class="text-xl font-bold text-white mb-2">' . htmlspecialchars($row["outfit_name"]) . '</h3>
    <p class="text-purple-100 text-sm leading-relaxed">' . htmlspecialchars($row["caption"]) . '</p>
  </div>

  <!-- Details Section -->
  <div class="p-6">
    <div class="grid grid-cols-2 gap-4">
      <!-- Age Group -->
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Age Group</p>
          <p class="text-sm font-semibold text-gray-800">' . htmlspecialchars($row["age_group"]) . '</p>
        </div>
      </div>

      <!-- Weather -->
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Weather</p>
          <p class="text-sm font-semibold text-gray-800">' . htmlspecialchars($row["weather"]) . '</p>
        </div>
      </div>

      <!-- Event Type -->
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Event Type</p>
          <p class="text-sm font-semibold text-gray-800">' . htmlspecialchars($row["event_type"]) . '</p>
        </div>
      </div>

      <!-- Gender -->
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Gender</p>
          <p class="text-sm font-semibold text-gray-800">' . htmlspecialchars($row["gender"]) . '</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer dengan subtle hover effect -->
  <div class="px-6 pb-4">
    <div class="h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
  </div>
</div>
';
    }
} else {
    echo "<p>Tidak ada outfit yang cocok dengan pilihan Anda.</p>";
}
?>
