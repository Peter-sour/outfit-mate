-- 1. Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    birthdate DATE NOT NULL
);

-- 2. Tabel weather
CREATE TABLE weather (
    id INT AUTO_INCREMENT PRIMARY KEY,
    condition VARCHAR(100) NOT NULL,
    temperature_min INT NOT NULL,
    temperature_max INT NOT NULL
);

-- 3. Tabel events (occasions)
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- 4. Tabel outfits
CREATE TABLE outfits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    color VARCHAR(50),
    weather VARCHAR(100), -- optional, bisa nyimpan value dari weather.condition
    occasion VARCHAR(100), -- optional (kalau kamu belum pakai tabel relasi many-to-many)
    image_path VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 5. Tabel recommendations
CREATE TABLE recommendations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    outfit_id INT NOT NULL,
    date DATE NOT NULL,
    reason TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (outfit_id) REFERENCES outfits(id) ON DELETE CASCADE
);
