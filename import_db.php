<?php
require_once 'config.php';

echo "🚀 Starting Database Import...\n\n";

$sql = "
-- Create Menu Table
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `kode_menu` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `kode_menu` (`kode_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create Pesanan Table
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `kode_menu` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create Transaksi Table
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
INSERT IGNORE INTO `admin` (`username`, `password`) VALUES
('admin', '" . md5('admin') . "');

-- Insert Default User
INSERT IGNORE INTO `user` (`username`, `password`) VALUES
('user', '" . md5('user') . "');

-- Insert Sample Menu
INSERT IGNORE INTO `menu` (`kode_menu`, `nama`, `harga`, `kategori`, `gambar`) VALUES
('MN51', 'Nasi Goreng Seafood', 35000, 'Makanan', 'nasi-goreng.jpg'),
('MN52', 'Udang Saus Mentega', 75000, 'Makanan', 'udang-mentega.jpg'),
('MN53', 'Kepiting Soka Goreng', 95000, 'Makanan', 'kepiting-soka.jpg'),
('MN54', 'Cumi Goreng Tepung', 55000, 'Makanan', 'cumi-goreng.jpg'),
('MN55', 'Es Teh Manis', 8000, 'Minuman', 'es-teh.jpg'),
('MN56', 'Jus Alpukat', 15000, 'Minuman', 'jus-alpukat.jpg');
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
