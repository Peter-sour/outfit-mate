

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Outfit Planner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f7f9fc, #dee9f7);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            font-weight: 600;
        }

        .btn-custom {
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="dashboard-card text-center">
    <h2>Selamat datang, <?= htmlspecialchars($user['nama']); ?>! 🧥👗</h2>
    <p class="text-muted mb-4">Siap tampil kece hari ini? Yuk atur outfit-mu!</p>

    <div class="d-grid gap-3">
        <a href="outfits/add_outfit.php" class="btn btn-primary btn-custom">➕ Tambah Outfit</a>
        <a href="outfits/list_outfit.php" class="btn btn-success btn-custom">👕 Daftar Outfit</a>
        <a href="logout.php" class="btn btn-outline-danger btn-custom">🚪 Logout</a>
    </div>
</div>

</body>
</html>