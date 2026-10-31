<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Kasir</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="container">
        <div class="card form-container">
            <h2 style="margin-bottom:6px;">Form Input Data Kasir</h2>
            <p class="subtitle" style="margin-bottom:24px;">
                Masukkan detail petugas kasir baru ke dalam sistem.
            </p>

            <form action="<?= base_url('kasir/simpan') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nama_kasir">Nama Kasir</label>
                    <input type="text" id="nama_kasir" name="nama_kasir"
                        maxlength="100" placeholder="Contoh: Budi Santoso"
                        value="<?= old('nama_kasir') ?>" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                        maxlength="50" placeholder="Contoh: budi_kasir"
                        value="<?= old('username') ?>" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp"
                        maxlength="20" placeholder="Contoh: 081234567890"
                        value="<?= old('no_hp') ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Kasir</button>
                    <button type="reset" class="btn btn-outline">Reset</button>
                    <a href="<?= base_url('kasir') ?>"
                        class="btn btn-outline" style="margin-left:auto;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>