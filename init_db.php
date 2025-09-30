<?php
// Database Initialization Script untuk Production
require_once 'config.php';

echo "🚀 Initializing database...\n";

// Read SQL file
$sql_file = 'pwl_kasir_restoran.sql';
if (!file_exists($sql_file)) {
    die("❌ SQL file not found: $sql_file\n");
}

$sql_content = file_get_contents($sql_file);

// Split SQL statements
$statements = array_filter(
    array_map('trim', explode(';', $sql_content)),
    function($stmt) {
        return !empty($stmt) && !preg_match('/^--/', $stmt) && !preg_match('/^\/\*/', $stmt);
    }
);

$success_count = 0;
$error_count = 0;

foreach ($statements as $statement) {
    if (empty(trim($statement))) continue;
    
    $result = mysqli_query($koneksi, $statement);
    if ($result) {
        $success_count++;
        echo "✅ Executed: " . substr($statement, 0, 50) . "...\n";
    } else {
        $error_count++;
        echo "❌ Error: " . mysqli_error($koneksi) . "\n";
        echo "   Statement: " . substr($statement, 0, 100) . "...\n";
    }
}

echo "\n📊 Database initialization complete!\n";
echo "✅ Success: $success_count statements\n";
echo "❌ Errors: $error_count statements\n";

// Test connection
$test_query = "SELECT COUNT(*) as total FROM menu";
$result = mysqli_query($koneksi, $test_query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "🍽️ Total menu items: " . $row['total'] . "\n";
} else {
    echo "⚠️ Could not count menu items\n";
}

mysqli_close($koneksi);
echo "🎉 Database ready for production!\n";
?>
