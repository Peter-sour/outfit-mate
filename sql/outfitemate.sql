-- Membuat database
CREATE DATABASE IF NOT EXISTS outfitmate;
USE outfitmate;

-- Tabel users (pengguna)
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) DEFAULT NULL,
    lastname VARCHAR(100) DEFAULT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255),
    agreed_terms TINYINT(1) DEFAULT 0, -- 1 = setuju, 0 = belum
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel clothing_items (item pakaian)
CREATE TABLE IF NOT EXISTS clothing_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    type VARCHAR(50) NOT NULL,
    color VARCHAR(50) NOT NULL,
    season VARCHAR(50),
    image_url VARCHAR(255),
    is_favorite BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Tabel outfits (koleksi outfit)
CREATE TABLE IF NOT EXISTS outfits (
    outfit_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    occasion VARCHAR(50),
    weather_condition VARCHAR(50),
    season VARCHAR(50),
    is_favorite BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Tabel outfit_items (item dalam outfit)
CREATE TABLE IF NOT EXISTS outfit_items (
    outfit_item_id INT AUTO_INCREMENT PRIMARY KEY,
    outfit_id INT NOT NULL,
    item_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (outfit_id) REFERENCES outfits(outfit_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES clothing_items(item_id) ON DELETE CASCADE
);

-- Tabel outfit_history (riwayat penggunaan outfit)
CREATE TABLE IF NOT EXISTS outfit_history (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    outfit_id INT NOT NULL,
    date_worn DATE NOT NULL,
    occasion VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (outfit_id) REFERENCES outfits(outfit_id) ON DELETE CASCADE
);

-- Tabel weather_preferences (preferensi cuaca untuk item)
CREATE TABLE IF NOT EXISTS weather_preferences (
    pref_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    weather_condition VARCHAR(50) NOT NULL,
    suitability INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES clothing_items(item_id) ON DELETE CASCADE
);

-- Tabel user_preferences (preferensi pengguna)
CREATE TABLE IF NOT EXISTS user_preferences (
    pref_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pref_key VARCHAR(100) NOT NULL,
    pref_value TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);