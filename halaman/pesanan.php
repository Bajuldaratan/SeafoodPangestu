<!-- Neo-Brutalism Responsive Pesanan Table -->
<div class="mb-4">
    <h3 class="fw-bold mb-3" style="color: #000; text-transform: uppercase;">
        DATA PESANAN
    </h3>
</div>

<div class="table-responsive" style="border: 3px solid #000; box-shadow: 4px 4px 0px #666;">
    <table class="table table-bordered mb-0">
        <thead>
            <tr style="background: #28A745; color: white;">
                <th style="border: 2px solid #000; font-weight: bold;">No</th>
                <th style="border: 2px solid #000; font-weight: bold;">Kode Pesanan</th>
                <th style="border: 2px solid #000; font-weight: bold;">Nama Pelanggan</th>
                <th style="border: 2px solid #000; font-weight: bold;">Kode Menu</th>
                <th style="border: 2px solid #000; font-weight: bold;">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($menu)) {
                echo '<tr><td colspan="5" class="text-center p-4" style="background: #FFF3CD; border: 2px solid #000;"><strong>Belum ada pesanan</strong></td></tr>';
            } else {
                $i = 1; 
                foreach ($menu as $m) { ?>
                <tr style="background-color: white;">
                    <td style="border: 1px solid #666; font-weight: bold;"><?= $i; ?></td>
                    <td style="border: 1px solid #666; font-family: monospace;"><?= $m["kode_pesanan"]; ?></td>
                    <td style="border: 1px solid #666; font-weight: bold;"><?= $m["nama_pelanggan"]; ?></td>
                    <td style="border: 1px solid #666; font-family: monospace;"><?= $m["kode_menu"]; ?></td>
                    <td style="border: 1px solid #666; text-align: center; font-weight: bold;"><?= $m["qty"]; ?></td>
                </tr>
            <?php $i++; } 
            } ?>
        </tbody>
    </table>
</div>

<?php if (!empty($menu)) { ?>
<div class="mt-3 p-3" style="background: #E8F5E8; border: 3px solid #28A745;">
    <small class="fw-bold">Total Pesanan: <?= count($menu); ?> item</small>
</div>
<?php } ?>