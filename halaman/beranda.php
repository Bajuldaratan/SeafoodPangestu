<!-- Neo-Brutalism Responsive Search & Filter Section -->
<div class="mb-4">
    <div class="row align-items-center mb-3 search-mobile search-tablet">
        <div class="col-12 col-md-6 mb-3 mb-md-0">
            <form action="index.php" method="GET" class="d-flex">
                <div class="input-group">
                    <input class="form-control py-3 px-4 fw-bold" type="search" autocomplete="off" name="key-search" placeholder="Cari menu favorit..." 
                           style="background:rgb(84, 94, 104); border: 3px solid #000; border-right: none; font-size: 16px;" value="<?= isset($_GET['key-search']) ? $_GET['key-search'] : ''; ?>">
                    <button class="btn fw-bold px-4" name="search" 
                            style="background: #000; color: #FFF; border: 3px solid #000; font-size: 16px;">
                        <span class="d-none d-sm-inline">CARI</span>
                        <i class="bi bi-search d-inline d-sm-none"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-3 mb-3 mb-md-0 filter-mobile">
            <form action="index.php" method="GET">
                <select name="kategori" class="form-select py-3 px-4 fw-bold" onchange="this.form.submit()" 
                        style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                    <option value="">🍽️ SEMUA KATEGORI</option>
                    <option value="Makanan" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Makanan' ? 'selected' : ''; ?>>🍛 MAKANAN</option>
                    <option value="Fast Food" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Fast Food' ? 'selected' : ''; ?>>🍔 FAST FOOD</option>
                    <option value="Snack" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Snack' ? 'selected' : ''; ?>>🍿 SNACK</option>
                    <option value="Dessert" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Dessert' ? 'selected' : ''; ?>>🍰 DESSERT</option>
                    <option value="Minuman" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Minuman' ? 'selected' : ''; ?>>🥤 MINUMAN</option>
                </select>
            </form>
        </div>
        <?php if (isset($_SESSION["akun-admin"])) { ?>
        <div class="col-12 col-md-3">
            <a class="btn fw-bold px-4 py-3 text-decoration-none w-100" href="tambah.php" 
               style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #000; font-size: 16px;">
                <span class="d-none d-sm-inline">+ TAMBAH MENU</span>
                <span class="d-inline d-sm-none">+ TAMBAH</span>
            </a>
        </div>
        <?php } else { ?>
        <div class="col-12 col-md-3">
            <!-- Spacer untuk user agar layout tetap rapi -->
        </div>
        <?php } ?>
    </div>
    
    <!-- Filter Status Info -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <?php if (isset($_GET['kategori']) && !empty($_GET['kategori'])) { ?>
            <div class="p-2 d-inline-block" style="background: #E3F2FD; border: 2px solid #000;">
                <small class="fw-bold">📂 Filter: <?= $_GET['kategori']; ?></small>
                <a href="index.php" class="ms-2 text-decoration-none fw-bold" style="color: #DC3545;">✖ Hapus Filter</a>
            </div>
            <?php } ?>
        </div>
        <div class="p-2" style="background: #F8F9FA; border: 2px solid #000;">
            <small class="fw-bold">📊 Ditemukan: <?= count($menu); ?> menu</small>
        </div>
    </div>
</div>
<!-- Neo-Brutalism Order Section -->
<?php if (!isset($_SESSION["akun-admin"])) { ?>
<div class="mb-4 p-4" style="background: #FFF3CD; border: 3px solid #000; box-shadow: 6px 6px 0px #000;">
    <h4 class="fw-bold mb-3" style="color: #000;">📋 PANDUAN PEMESANAN</h4>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="p-2" style="background: #E3F2FD; border: 2px solid #000;">
                <strong>1.</strong> Isi nama pelanggan
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="p-2" style="background: #E8F5E8; border: 2px solid #000;">
                <strong>2.</strong> Pilih menu & qty
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="p-2" style="background: #FFE6E6; border: 2px solid #000;">
                <strong>3.</strong> Klik pesan sekarang
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Neo-Brutalism Menu Grid -->
<form action="index.php" method="POST">

<?php if (!isset($_SESSION["akun-admin"])) { ?>
<!-- Form Pemesanan -->
<div class="mb-4 p-4" style="background: #F8F9FA; border: 3px solid #000; box-shadow: 6px 6px 0px #000;">
    <div class="row align-items-center">
        <div class="col-md-7">
            <input class="form-control py-3 px-4 fw-bold" type="text" name="pelanggan" placeholder="MASUKKAN NAMA PELANGGAN" required autocomplete="off" 
                   style="background: #FFF; border: 3px solid #000; font-size: 18px;">
        </div>
        <div class="col-md-5 text-center mt-3 mt-md-0">
            <button class="btn fw-bold px-5 py-3 w-100" name="pesan" 
                    style="background: #DC3545; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #000; font-size: 18px;">
                🛒 PESAN SEKARANG
            </button>
        </div>
    </div>
</div>
<?php } ?>

<div class="row g-4">
    <?php 
    // Debug: Cek apakah ada data menu
    if (empty($menu)) {
        echo '<div class="col-12"><div class="alert alert-warning" style="border: 3px solid #000;">Tidak ada menu tersedia. Total menu: ' . count($menu) . '</div></div>';
    }
    
    $i = 1;
    foreach ($menu as $m) { ?>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="h-100 menu-card-mobile menu-card-tablet menu-card-desktop" style="background: #FFF; border: 3px solid #000; box-shadow: 6px 6px 0px #000;">
                
                <!-- Menu Header -->
                <div class="p-3" style="background: #000; color: #FFF; border-bottom: 3px solid #000;">
                    <h5 class="fw-bold m-0 text-uppercase"><?= $m["nama"]; ?></h5>
                </div>
                
                <!-- Menu Image -->
                <div class="text-center p-3" style="background: #F8F9FA;">
                    <img src="src/img/<?= $m["gambar"]; ?>" class="img-fluid" style="max-height: 150px; border: 2px solid #000;">
                </div>
                
                <!-- Menu Details -->
                <div class="p-3">
                    <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= $m["kode_menu"]; ?>">
                    
                    <!-- Price & Category -->
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="p-2" style="background: #E8F5E8; border: 2px solid #000;">
                                <small class="fw-bold">HARGA</small>
                                <div class="fw-bold fs-6">Rp<?= number_format($m["harga"], 0, ',', '.'); ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2" style="background: #E3F2FD; border: 2px solid #000;">
                                <small class="fw-bold">KATEGORI</small>
                                <div class="fw-bold fs-6"><?= $m["kategori"]; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-3">
                        <div class="p-2 text-center" style="background: <?= $m['status'] == 'tersedia' ? '#D4EDDA' : '#FFE6E6'; ?>; border: 2px solid #000;">
                            <span class="fw-bold"><?= $m['status'] == 'tersedia' ? '✅ TERSEDIA' : '❌ TIDAK TERSEDIA'; ?></span>
                        </div>
                    </div>
                    
                    <!-- Quantity Input for Users -->
                    <?php if (!isset($_SESSION["akun-admin"])) { ?>
                    <div class="mb-3">
                        <label class="fw-bold mb-2">JUMLAH PESANAN:</label>
                        <input min="0" type="number" name="qty<?= $i; ?>" class="form-control py-2 px-3 fw-bold text-center" placeholder="0" 
                               style="background: #FFF; border: 3px solid #000; font-size: 16px;">
                    </div>
                    <?php } ?>
                    
                    <!-- Admin Actions -->
                    <?php if (isset($_SESSION["akun-admin"])) { ?>
                    <div class="d-grid gap-2">
                        <a class="btn fw-bold py-2" href="edit.php?id_menu=<?= $m["id_menu"]; ?>" 
                           style="background: #FFC107; color: #000; border: 3px solid #000; box-shadow: 3px 3px 0px #000;">
                            ✏️ EDIT MENU
                        </a>
                        <a class="btn fw-bold py-2" href="hapus.php?id_menu=<?= $m["id_menu"]; ?>" onclick="return confirm('Hapus menu ini?')" 
                           style="background: #DC3545; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #000;">
                            🗑️ HAPUS MENU
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php $i++; } ?>
</div>
</form>