<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Konsumen</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="container">
        <div class="card form-container">
            <h2 style="margin-bottom:6px;">Form Input Data Konsumen</h2>
            <p class="subtitle" style="margin-bottom:24px;">
                Masukkan detail data konsumen baru ke dalam sistem.
            </p>

            <form action="<?= base_url('konsumen/simpan') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nama_konsumen">Nama Konsumen</label>
                    <input type="text" id="nama_konsumen"
                        name="nama_konsumen" maxlength="100"
                        value="<?= old('nama_konsumen') ?>"
                        placeholder="Masukkan nama konsumen" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat"
                        name="alamat" maxlength="200"
                        value="<?= old('alamat') ?>"
                        placeholder="Masukkan alamat konsumen" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp"
                        name="no_hp" maxlength="20"
                        value="<?= old('no_hp') ?>"
                        placeholder="Contoh: 081234567890" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan Konsumen</button>
                    <button type="reset" class="btn btn-outline">Reset</button>
                    <a href="<?= base_url('konsumen') ?>"
                        class="btn btn-outline" style="margin-left:auto;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>