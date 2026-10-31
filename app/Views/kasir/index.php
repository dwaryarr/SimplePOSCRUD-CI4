<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container" style="max-width:1100px;">
    <div class="page-header">
        <div>
            <h2>Data Kasir</h2>
            <p class="subtitle">Kelola daftar petugas kasir yang melayani transaksi</p>
        </div>
        <div>
            <a href="<?= base_url('kasir/tambah') ?>" class="btn btn-primary">
                + Tambah Kasir
            </a>
        </div>
    </div>

    <div class="card table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>ID</th>
                    <th>Nama Kasir</th>
                    <th>Username</th>
                    <th>No HP / WhatsApp</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($kasir as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><code><?= esc($row['id_kasir']) ?></code></td>
                        <td><strong><?= esc($row['nama_kasir']) ?></strong></td>
                        <td>
                            <span class="badge">@<?= esc($row['username']) ?></span>
                        </td>
                        <td><?= esc($row['no_hp']) ?></td>
                        <td style="text-align:right;white-space:nowrap;">
                            <a href="<?= base_url('kasir/edit/' . $row['id_kasir']) ?>"
                                class="btn btn-outline btn-sm">Edit</a>

                            <button type="button"
                                class="btn btn-outline btn-sm"
                                style="color:var(--danger-text);border-color:#fecaca;"
                                onclick='konfirmasiHapus(
                                <?= json_encode(base_url('kasir/hapus/' . $row['id_kasir'])) ?>,
                                <?= json_encode($row['nama_kasir']) ?>
                            )'>
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="confirmModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-icon">!</div>
            <div class="modal-title">Konfirmasi Penghapusan</div>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin menghapus data kasir
            <strong id="namaDataModal"></strong> dari sistem?
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-outline"
                onclick="tutupModal()">Batal</button>
            <a id="btnHapusModal" href="#" class="btn btn-primary"
                style="background-color:var(--danger-text);border-color:var(--danger-text);">
                Ya, Hapus Data
            </a>
        </div>
    </div>
</div>

<script>
    function konfirmasiHapus(url, namaData) {
        document.getElementById('namaDataModal').textContent = namaData;
        document.getElementById('btnHapusModal').href = url;
        document.getElementById('confirmModal').classList.add('active');
    }

    function tutupModal() {
        document.getElementById('confirmModal').classList.remove('active');
    }
</script>

<?= $this->endSection() ?>