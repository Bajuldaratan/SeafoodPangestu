<!-- Neo-Brutalism Responsive Transaksi Table -->
<div class="mb-4">
    <h3 class="fw-bold mb-3" style="color: #000; text-transform: uppercase;">
        DATA TRANSAKSI
    </h3>
</div>

<div class="table-responsive" style="border: 3px solid #000; box-shadow: 4px 4px 0px #666;">
    <table class="table table-bordered mb-0">
        <thead>
            <tr style="background: #17A2B8; color: white;">
                <th style="border: 2px solid #000; font-weight: bold;">No</th>
                <th style="border: 2px solid #000; font-weight: bold;">Kode Pesanan</th>
                <th style="border: 2px solid #000; font-weight: bold;">Nama Pelanggan</th>
                <th style="border: 2px solid #000; font-weight: bold;">Waktu</th>
                <th style="border: 2px solid #000; font-weight: bold;">Total Harga</th>
                <th style="border: 2px solid #000; font-weight: bold;">Pembayaran</th>
                <th style="border: 2px solid #000; font-weight: bold;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($menu)) {
                echo '<tr><td colspan="7" class="text-center p-4" style="background: #FFF3CD; border: 2px solid #000;"><strong>Belum ada transaksi</strong></td></tr>';
            } else {
                $i = 1;
                foreach ($menu as $m) {
                    $kode_pesanan = $m["kode_pesanan"];
                    $total_pembayaran = ambil_data("SELECT DISTINCT * FROM pesanan
                JOIN transaksi ON (pesanan.kode_pesanan = transaksi.kode_pesanan)
                JOIN menu ON (menu.kode_menu = pesanan.kode_menu)
                WHERE transaksi.kode_pesanan = '$kode_pesanan'");
            ?>
            <tr style="background-color: white;">
                <form action="cetak/cetak.php" target="_blank" method="GET">
                    <input type="hidden" name="kode_pesanan" value="<?= $m["kode_pesanan"]; ?>">
                    
                    <td style="border: 1px solid #666; font-weight: bold;"><?= $i; ?></td>
                    <td style="border: 1px solid #666; font-family: monospace;"><?= $m["kode_pesanan"]; ?></td>
                    <td style="border: 1px solid #666; font-weight: bold;"><?= $m["nama_pelanggan"]; ?></td>
                    <td style="border: 1px solid #666; font-size: 12px;"><?= $m["waktu"]; ?></td>
                    <td style="border: 1px solid #666; font-weight: bold; color: #28A745;">
                        <?php
                        $total = 0;
                        foreach ($total_pembayaran as $tp) {
                            $total += $tp["qty"] * $tp["harga"];
                        }
                        echo "Rp." . number_format($total, 0, ',', '.');
                        ?>
                    </td>
                    <td style="border: 1px solid #666;">
                        <input name="pembayaran" min="0" type="number" class="form-control form-control-sm" 
                               style="border: 2px solid #000; font-size: 12px;" placeholder="0">
                    </td>
                    <td style="border: 1px solid #666;">
                        <div class="d-flex gap-1 flex-column flex-md-row">
                            <button class="btn btn-sm fw-bold" 
                                    style="background: #28A745; color: #FFF; border: 2px solid #000; font-size: 10px;">
                                CETAK
                            </button>
                            <a class="btn btn-sm fw-bold" href="hapus.php?kode_pesanan=<?= $m["kode_pesanan"]; ?>" 
                               onclick="return confirm('Hapus Data Transaksi?')"
                               style="background: #DC3545; color: #FFF; border: 2px solid #000; font-size: 10px;">
                                HAPUS
                            </a>
                        </div>
                    </td>
                </form>
            </tr>
            <?php $i++; } 
            } ?>
        </tbody>
    </table>
</div>

<?php if (!empty($menu)) { ?>
<div class="mt-3 p-3" style="background: #E3F2FD; border: 3px solid #17A2B8;">
    <small class="fw-bold">Total Transaksi: <?= count($menu); ?> pesanan</small>
</div>
<?php } ?>