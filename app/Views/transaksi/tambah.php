<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card form-container">
        <h2 style="margin-bottom:6px;">Form Input Transaksi</h2>
        <p class="subtitle" style="margin-bottom:24px;">
            Masukkan detail transaksi penjualan baru ke dalam sistem.
        </p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('transaksi/simpan') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="id_konsumen">Pilih Konsumen</label>
                <select id="id_konsumen" name="id_konsumen" required>
                    <option value="">-- Pilih Konsumen --</option>
                    <?php foreach ($konsumen as $k): ?>
                        <option value="<?= $k['id_konsumen'] ?>">
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
                        <option value="<?= $ks['id_kasir'] ?>">
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
                        <option value="<?= esc($b['kode_brg']) ?>"
                            data-harga="<?= esc($b['harga_beli']) ?>"
                            data-stok="<?= esc($b['total_beli']) ?>">
                            <?= esc($b['nama_barang']) ?> -
                            Rp <?= number_format($b['harga_beli'], 0, ',', '.') ?>
                            (Stok: <?= esc($b['total_beli']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga Satuan (Rp)</label>
                <input type="number" id="harga" name="harga"
                    min="0" placeholder="0" readonly required>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah Beli</label>
                <input type="number" id="jumlah" name="jumlah"
                    min="1" value="1" oninput="hitungTotal()" required>
                <small id="infoStok"></small>
            </div>

            <div class="form-group">
                <label for="total_bayar">Total Bayar (Rp)</label>
                <input type="number" id="total_bayar" name="total_bayar"
                    min="0" placeholder="0" readonly required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <button type="reset" class="btn btn-outline"
                    onclick="setTimeout(resetForm, 10)">Reset</button>
                <a href="<?= base_url('transaksi') ?>" class="btn btn-outline"
                    style="margin-left:auto;">Kembali</a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateHarga() {
        const select = document.getElementById('kode_brg');
        const option = select.options[select.selectedIndex];

        document.getElementById('harga').value = option.dataset.harga || 0;
        document.getElementById('infoStok').textContent =
            option.value ? 'Stok tersedia: ' + option.dataset.stok : '';

        hitungTotal();
    }

    function hitungTotal() {
        const harga = Number(document.getElementById('harga').value) || 0;
        const jumlah = Number(document.getElementById('jumlah').value) || 0;
        document.getElementById('total_bayar').value = harga * jumlah;
    }

    function resetForm() {
        document.getElementById('harga').value = '';
        document.getElementById('total_bayar').value = '';
        document.getElementById('infoStok').textContent = '';
    }
</script>

<?= $this->endSection() ?>