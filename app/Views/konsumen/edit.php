<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Konsumen</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="container">
        <div class="card form-container">
            <h2 style="margin-bottom:6px;">Edit Data Konsumen</h2>
            <p class="subtitle" style="margin-bottom:24px;">
                Perbarui detail informasi konsumen berikut.
            </p>

            <form action="<?= base_url('konsumen/update/' . $konsumen['id_konsumen']) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nama_konsumen">Nama Konsumen</label>
                    <input type="text" id="nama_konsumen"
                        name="nama_konsumen"
                        value="<?= esc($konsumen['nama_konsumen']) ?>"
                        maxlength="100" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat"
                        name="alamat"
                        value="<?= esc($konsumen['alamat']) ?>"
                        maxlength="200" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp"
                        name="no_hp"
                        value="<?= esc($konsumen['no_hp']) ?>"
                        maxlength="20" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <button type="reset" class="btn btn-outline">Reset</button>
                    <a href="<?= base_url('konsumen') ?>"
                        class="btn btn-outline" style="margin-left:auto;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>