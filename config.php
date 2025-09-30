<?php
// Database Configuration untuk Production dan Development

// Deteksi environment
$is_production = isset($_ENV['RAILWAY_ENVIRONMENT']) || isset($_ENV['DATABASE_URL']);

if ($is_production) {
    // Production Database (Railway/Heroku)
    if (isset($_ENV['DATABASE_URL'])) {
        // Parse DATABASE_URL (format: mysql://user:pass@host:port/dbname)
        $db_url = parse_url($_ENV['DATABASE_URL']);
        $db_host = $db_url['host'];
        $db_user = $db_url['user'];
        $db_pass = $db_url['pass'];
        $db_name = ltrim($db_url['path'], '/');
        $db_port = isset($db_url['port']) ? $db_url['port'] : 3306;
    } else {
        // Environment variables terpisah
        $db_host = $_ENV['DB_HOST'] ?? 'localhost';
        $db_user = $_ENV['DB_USER'] ?? 'root';
        $db_pass = $_ENV['DB_PASS'] ?? '';
        $db_name = $_ENV['DB_NAME'] ?? 'pwl_kasir_restoran';
        $db_port = $_ENV['DB_PORT'] ?? 3306;
    }
} else {
    // Development Database (Local)
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'pwl_kasir_restoran';
    $db_port = 3306;
}

// Koneksi Database
try {
    $koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
    
    if (!$koneksi) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
    
    // Set charset
    mysqli_set_charset($koneksi, "utf8");
    
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

// Global variables untuk backward compatibility
$GLOBALS['koneksi'] = $koneksi;
?>
