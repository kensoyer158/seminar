<?php
$host = 'localhost';
$username = 'root';
$password = ''; 
$dbname = 'seminar_db';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname`");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        image_url VARCHAR(255) NOT NULL,
        section ENUM('seminar', 'activity', 'reward', 'team') NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    )");
    
    $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($userCount == 0) {
        $pdo->exec("INSERT INTO users (username, password) VALUES ('admin007', '123456zsa')");
    }

    $pdo->exec("CREATE TABLE IF NOT EXISTS participants (
        id INT AUTO_INCREMENT PRIMARY KEY,
        p_type ENUM('student', 'teacher', 'outsider') NOT NULL,
        student_id VARCHAR(50) NULL,
        title VARCHAR(50) NULL,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        year VARCHAR(20) NULL,
        faculty VARCHAR(100) NULL,
        major VARCHAR(100) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS budgets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        item_name VARCHAR(255) NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        b_type ENUM('income', 'expense') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS team_members (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        role VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Add image_url to team_members if it doesn't exist (for backward compatibility)
    try {
        $pdo->exec("ALTER TABLE team_members ADD COLUMN image_url VARCHAR(255) NULL AFTER role");
    } catch(PDOException $e) { }

    // Create speakers table
    $pdo->exec("CREATE TABLE IF NOT EXISTS speakers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        team_name VARCHAR(150) NULL,
        image_url VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

} catch(PDOException $e) {
    die("<div style='color:red; text-align:center; padding:50px; font-family:sans-serif;'>
            <h3>เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล</h3>
            <p>" . $e->getMessage() . "</p>
            <p>กรุณาตรวจสอบว่าเปิด MySQL ในโปรแกรม XAMPP แล้วหรือไม่</p>
         </div>");
}
?>
