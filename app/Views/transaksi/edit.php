<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$trxCode = 'TRX-' . sprintf('%03d', $item['id_transaksi']);
?>

<div class="container">
    <div class="card form-container">
        <h2 style="margin-bottom: 6px;">Edit Data Transaksi</h2>
        <p class="subtitle" style="margin-bottom: 24px;">
            Perbarui data untuk nomor transaksi
            <strong><?= esc($trxCode) ?></strong>.
        </p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('transaksi/update/' . $item['id_transaksi']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="id_konsumen">Konsumen</label>
                <select id="id_konsumen" name="id_konsumen" required>
                    <option value="">-- Pilih Konsumen --</option>
                    <?php foreach ($konsumen as $k): ?>
                        <option value="<?= $k['id_konsumen'] ?>"
                            <?= $k['id_konsumen'] == $item['id_konsumen'] ? 'selected' : '' ?>>
                            <?= esc($k['nama_konsumen']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_kasir">Kasir yang Melayani</label>
                <select id="id_kasir" name="id_kasir" required>
                    <option value="">-- Pilih Kasir --</option>
                    <?php foreach ($kasir as $ks): ?>
                        <option value="<?= $ks['id_kasir'] ?>"
                            <?= $ks['id_kasir'] == $item['id_kasir'] ? 'selected' : '' ?>>
                            <?= esc($ks['nama_kasir']) ?> (@<?= esc($ks['username']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="kode_brg">Pilih Barang</label>
                <select id="kode_brg" name="kode_brg" onchange="updateHarga()" required>
                    <option value="" data-harga="0">-- Pilih Barang --</option>

                    <?php foreach ($barang as $b): ?>
                        <?php
                        $selected = $b['kode_brg'] == $item['kode_brg'];
                        $stok = (int) $b['total_beli']
                            + ($selected ? (int) $item['jumlah'] : 0);
                        ?>
                        <option
                            value="<?= esc($b['kode_brg']) ?>"
                            data-harga="<?= $b['harga_beli'] ?>"
                            data-stok="<?= $stok ?>"
                            <?= $selected ? 'selected' : '' ?>>
                            <?= esc($b['nama_barang']) ?>
                            - Rp <?= number_format($b['harga_beli'], 0, ',', '.') ?>
                            (Stok Siap: <?= $stok ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga Satuan (Rp)</label>
                <input type="number" id="harga"
                    value="<?= $item['harga'] ?>" readonly>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah Beli</label>
                <input type="number" id="jumlah" name="jumlah"
                    min="1" value="<?= $item['jumlah'] ?>"
                    oninput="hitungTotal()" required>
                <small id="stok-info"></small>
            </div>

            <div class="form-group">
                <label for="total_bayar">Total Bayar (Rp)</label>
                <input type="number" id="total_bayar"
                    value="<?= $item['total_bayar'] ?>" readonly>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Perbarui Transaksi
                </button>
                <a href="<?= base_url('transaksi') ?>"
                    class="btn btn-outline" style="margin-left:auto;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateHarga() {
        const select = document.getElementById('kode_brg');
        const option = select.options[select.selectedIndex];

        document.getElementById('harga').value =
            option.dataset.harga || 0;

        hitungTotal();
    }

    function hitungTotal() {
        const select = document.getElementById('kode_brg');
        const option = select.options[select.selectedIndex];

        const harga = parseFloat(
            document.getElementById('harga').value
        ) || 0;

        const jumlah = parseInt(
            document.getElementById('jumlah').value
        ) || 0;

        const stok = parseInt(option.dataset.stok) || 0;

        document.getElementById('total_bayar').value = harga * jumlah;

        document.getElementById('stok-info').textContent =
            'Stok tersedia: ' + stok;

        document.getElementById('stok-info').style.color =
            jumlah > stok ? 'red' : '';
    }

    document.addEventListener('DOMContentLoaded', hitungTotal);
</script>

<?= $this->endSection() ?>