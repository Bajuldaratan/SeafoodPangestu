<?php
require_once 'config.php';

echo "🚀 Starting Database Import...\n\n";

$sql = "
-- Create Menu Table
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `kode_menu` varchar(12) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `status` enum('tersedia','tidak tersedia') DEFAULT 'tersedia',
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `kode_menu` (`kode_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Pesanan Table
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(12) NOT NULL,
  `kode_menu` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Transaksi Table
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create Admin Table
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create User Table
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Default Admin
INSERT IGNORE INTO `admin` (username, password) VALUES
('admin', '" . md5('admin') . "');

-- Insert Default User
INSERT IGNORE INTO `user` (username, password) VALUES
('user', '" . md5('user') . "');

-- Insert Sample Menu
INSERT IGNORE INTO `menu` (`kode_menu`, `nama`, `harga`, `gambar`, `kategori`, `status`) VALUES
('MN51', 'Nasi Putih Biasa', 4000, 'nasi-putih-biasa.png', 'Makanan', 'tersedia'),
('MN01', 'Bebek Cabe Ijo', 40000, 'bebek-goreng-ijo.png', 'Makanan', 'tersedia'),
('MN02', 'Kerang Asam manis', 50000, 'kerang-asam-manis.png', 'Makanan', 'tersedia'),
('MN10', 'Udang Tepung Gendut', 20000, 'udang-tepung.png', 'Fast Food', 'tersedia'),
('MN16', 'Burger Egg Cheese', 16000, 'egg-cheese-burger.png', 'Fast Food', 'tersedia'),
('MN19', 'Molen Kacang Hijau', 5000, 'molen-kacang-hijau.png', 'Snack', 'tersedia'),
('MN26', 'Puding Lumut', 10000, 'puding-lumut.png', 'Dessert', 'tersedia'),
('MN42', 'Jus Alpukat', 5000, 'jus-alpukat.png', 'Minuman', 'tersedia'),
('MN52', 'Es Teh Manis', 3000, 'es-teh-manis.png', 'Minuman', 'tersedia');
";

$queries = array_filter(array_map('trim', explode(';', $sql)));
$success = 0;
$failed = 0;

foreach ($queries as $query) {
    if (!empty($query)) {
        if (mysqli_query($koneksi, $query)) {
            $success++;
            echo "✅ Query executed successfully\n";
        } else {
            $failed++;
            echo "❌ Error: " . mysqli_error($koneksi) . "\n";
        }
    }
}

echo "\n✨ Database Import Completed!\n";
echo "✅ Success: $success queries\n";
echo "❌ Failed: $failed queries\n\n";
echo "🔐 Default Login:\n";
echo "   Username: admin\n";
echo "   Password: admin\n\n";
echo "🎉 Your app is ready!\n";
?>
