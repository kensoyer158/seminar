<?php
$host = 'db.bbsszkzjduycohpskein.supabase.co';
$port = '5432';
$username = 'postgres';
$password = '0954465727zsa'; 
$dbname = 'postgres'; // Supabase ใช้ชื่อฐานข้อมูลว่า postgres

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("<div style='color:red; text-align:center; padding:50px; font-family:sans-serif;'>
            <h3>เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล</h3>
            <p>" . htmlspecialchars($e->getMessage()) . "</p>
         </div>");
}
?>
