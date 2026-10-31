<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container" style="max-width:1100px;">
    <div class="page-header">
        <div>
            <h2>Data Konsumen</h2>
            <p class="subtitle">Kelola daftar pelanggan dan informasi kontak konsumen</p>
        </div>
        <a href="<?= base_url('konsumen/tambah') ?>" class="btn btn-primary">
            + Tambah Konsumen
        </a>
    </div>

    <div class="card table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>ID</th>
                    <th>Nama Konsumen</th>
                    <th>Alamat</th>
                    <th>No HP / WhatsApp</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($konsumen as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><code><?= esc($row['id_konsumen']) ?></code></td>
                        <td><strong><?= esc($row['nama_konsumen']) ?></strong></td>
                        <td><?= esc($row['alamat']) ?></td>
                        <td><span class="badge"><?= esc($row['no_hp']) ?></span></td>
                        <td style="text-align:right;white-space:nowrap;">
                            <a href="<?= base_url('konsumen/edit/' . $row['id_konsumen']) ?>"
                                class="btn btn-outline btn-sm">Edit</a>

                            <button type="button"
                                class="btn btn-outline btn-sm"
                                style="color:var(--danger-text);border-color:#fecaca;"
                                onclick='konfirmasiHapus(
                                <?= json_encode(base_url('konsumen/hapus/' . $row['id_konsumen'])) ?>,
                                <?= json_encode($row['nama_konsumen']) ?>
                            )'>
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($konsumen)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Belum ada data konsumen.</td>
                    </tr>
                <?php endif; ?>
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
            Apakah Anda yakin ingin menghapus data konsumen
            <strong id="namaDataModal"></strong>
            dari sistem? Tindakan ini dapat mempengaruhi histori transaksi terkait.
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-outline" onclick="tutupModal()">Batal</button>
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