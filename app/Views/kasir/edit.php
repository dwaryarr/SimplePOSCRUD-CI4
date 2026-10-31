<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kasir</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="container">
        <div class="card form-container">
            <h2 style="margin-bottom:6px;">Edit Data Kasir</h2>
            <p class="subtitle" style="margin-bottom:24px;">
                Perbarui detail informasi kasir berikut.
            </p>

            <form action="<?= base_url('kasir/update/' . $kasir['id_kasir']) ?>"
                method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nama_kasir">Nama Kasir</label>
                    <input type="text" id="nama_kasir" name="nama_kasir"
                        value="<?= esc($kasir['nama_kasir']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                        value="<?= esc($kasir['username']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp"
                        value="<?= esc($kasir['no_hp']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <button type="reset" class="btn btn-outline">Reset</button>
                    <a href="<?= base_url('kasir') ?>"
                        class="btn btn-outline" style="margin-left:auto;">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>