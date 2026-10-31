<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Barang</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="container">
        <div class="card form-container">
            <h2 style="margin-bottom:6px;">Form Input Data Barang</h2>
            <p class="subtitle" style="margin-bottom:24px;">
                Masukkan detail data barang baru ke dalam sistem.
            </p>

            <form action="<?= base_url('barang/simpan') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="kode_brg">Kode Barang</label>
                    <input type="text" id="kode_brg" name="kode_brg"
                        placeholder="Contoh: BRG001" required>
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang"
                        placeholder="Masukkan nama barang" required>
                </div>

                <div class="form-group">
                    <label for="jenis">Kategori</label>
                    <select id="jenis" name="jenis" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Aksesoris">Aksesoris</option>
                        <option value="ATK">ATK</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Satuan (Rp)</label>
                    <input type="number" id="harga_beli" name="harga_beli"
                        min="0" placeholder="0" required>
                </div>

                <div class="form-group">
                    <label for="total_beli">Stok / Total Beli</label>
                    <input type="number" id="total_beli" name="total_beli"
                        min="1" placeholder="1" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan Barang</button>
                    <button type="reset" class="btn btn-outline">Reset</button>
                    <a href="<?= base_url('barang') ?>"
                        class="btn btn-outline" style="margin-left:auto;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>