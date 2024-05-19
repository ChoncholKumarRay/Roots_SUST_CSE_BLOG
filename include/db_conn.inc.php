<?php


$host = 'localhost';
$dbname = 'roots_db';
$dbusername = 'root';
$dbpassword = '2020331072';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


// Database Connection for Online Hosting

// $host = 'fdb1034.awardspace.net';
// $dbname = '4480579_blog';
// $dbusername = '4480579_blog';
// $dbpassword = 'Chonchol2020331072#';

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }
