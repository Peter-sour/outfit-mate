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
        <div class="outfit-card">
          <div class="outfit-image">
            <img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["outfit_name"]) . '">
          </div>
          <div class="outfit-info">
            <h3>' . htmlspecialchars($row["outfit_name"]) . '</h3>
            <p>' . htmlspecialchars($row["caption"]) . '</p>
          </div>
          <div class="outfit-meta">
            <div>'. htmlspecialchars($row["age_group"]) .'</div>
            <div>' . htmlspecialchars($row["weather"]) . '</div>
            <div>' . htmlspecialchars($row["event_type"]) . '</div>
            <div>' . htmlspecialchars($row["gender"]) . '</div>
          </div>
        </div>';
    }
} else {
    echo "<p>Tidak ada outfit yang cocok dengan pilihan Anda.</p>";
}
?>
