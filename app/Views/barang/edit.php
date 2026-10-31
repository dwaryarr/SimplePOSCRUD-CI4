<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="container">
        <div class="card form-container">
            <h2 style="margin-bottom:6px;">Edit Data Barang</h2>
            <p class="subtitle" style="margin-bottom:24px;">
                Perbarui detail informasi barang berikut.
            </p>

            <form action="<?= base_url('barang/update/' . rawurlencode($barang['kode_brg'])) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="kode_brg">Kode Barang</label>
                    <input type="text" id="kode_brg" name="kode_brg"
                        value="<?= esc($barang['kode_brg']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang"
                        value="<?= esc($barang['nama_barang']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <select id="jenis" name="jenis" required>
                        <option value="">-- Pilih Jenis --</option>
                        <?php foreach (['Elektronik', 'Aksesoris', 'ATK', 'Lainnya'] as $jenis): ?>
                            <option value="<?= $jenis ?>"
                                <?= $barang['jenis'] == $jenis ? 'selected' : '' ?>>
                                <?= $jenis ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli (Rp)</label>
                    <input type="number" id="harga_beli" name="harga_beli"
                        value="<?= esc($barang['harga_beli']) ?>" min="0" required>
                </div>

                <div class="form-group">
                    <label for="total_beli">Total Beli</label>
                    <input type="number" id="total_beli" name="total_beli"
                        value="<?= esc($barang['total_beli']) ?>" min="1" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <button type="reset" class="btn btn-outline">Reset</button>
                    <a href="<?= base_url('barang') ?>"
                        class="btn btn-outline" style="margin-left:auto;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>