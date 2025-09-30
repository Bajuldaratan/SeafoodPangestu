<?php
require_once 'config.php';

echo "<h2>🔄 Reset Database</h2>";
echo "<p>Dropping old tables...</p>";

// Drop tables jika ada
$tables = ['pesanan', 'transaksi', 'menu', 'admin', 'user'];
foreach ($tables as $table) {
    $query = "DROP TABLE IF EXISTS `$table`";
    if (mysqli_query($koneksi, $query)) {
        echo "✅ Dropped table: $table<br>";
    } else {
        echo "❌ Error dropping $table: " . mysqli_error($koneksi) . "<br>";
    }
}

echo "<hr>";
echo "<p><strong>Tables dropped successfully!</strong></p>";
echo "<p>Now run: <a href='import_db.php'>import_db.php</a></p>";
?>
