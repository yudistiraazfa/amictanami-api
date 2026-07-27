<?php
include_once 'db_config.php';

$database = new Database();
$db = $database->getConnection();

try {
    // Create users table
    $query_users = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $db->exec($query_users);
    echo "Table 'users' checked/created successfully.<br>";

    // Create password_resets table
    $query_resets = "CREATE TABLE IF NOT EXISTS password_resets (
        email VARCHAR(100) NOT NULL,
        token VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        expires_at TIMESTAMP NULL,
        INDEX(email)
    )";
    $db->exec($query_resets);
    echo "Table 'password_resets' checked/created successfully.<br>";

    // Create tanamcare_history table
    $query_history = "CREATE TABLE IF NOT EXISTS tanamcare_history (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        date VARCHAR(50) NOT NULL,
        explanation TEXT NOT NULL,
        solution TEXT NOT NULL,
        image_path VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $db->exec($query_history);
    echo "Table 'tanamcare_history' checked/created successfully.<br>";

    // Create activity_logs table
    $query_logs = "CREATE TABLE IF NOT EXISTS activity_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        judul VARCHAR(255) NOT NULL,
        jam VARCHAR(50) NOT NULL,
        tanggal VARCHAR(50) NOT NULL,
        tipe VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $db->exec($query_logs);
    echo "Table 'activity_logs' checked/created successfully.<br>";
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
