<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .page-transaksi-wrapper {
        width: 96%;
        max-width: 1200px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    .table-fit {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
    }

    .table-fit th {
        padding: 10px 8px;
        font-size: .72rem;
        letter-spacing: .03em;
    }

    .table-fit td {
        padding: 10px 8px;
        font-size: .8125rem;
    }

    .btn-action-group {
        display: inline-flex;
        gap: 4px;
        justify-content: flex-end;
        align-items: center;
    }

    .btn-action-group .btn {
        padding: 4px 8px;
        font-size: .75rem;
        border-radius: 4px;
        line-height: 1.2;
    }
</style>

<div class="page-transaksi-wrapper">
    <div class="page-header" style="margin-bottom:20px;">
        <div>
            <h2>Data Transaksi Penjualan</h2>
            <p class="subtitle">Kelola dan pantau riwayat transaksi pembelian konsumen</p>
        </div>
        <a href="<?= base_url('transaksi/tambah') ?>" class="btn btn-primary">
            + Tambah Transaksi
        </a>
    </div>

    <div class="card" style="width:100%;overflow:hidden;">
        <div class="table-responsive">
            <table class="table-fit">
                <thead>
                    <tr>
                        <th style="width:36px;text-align:center;">No</th>
                        <th style="width:85px;">ID Trx</th>
                        <th>Konsumen</th>
                        <th>Kasir</th>
                        <th>Barang</th>
                        <th style="text-align:center;width:60px;">Jumlah</th>
                        <th style="text-align:right;width:115px;">Harga Satuan</th>
                        <th style="text-align:right;width:135px;">Total Bayar</th>
                        <th style="text-align:right;width:150px;padding-right:14px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $row): ?>
                        <?php $trxCode = 'TRX-' . sprintf('%03d', $row['id_transaksi']); ?>
                        <tr>
                            <td style="text-align:center;color:var(--text-secondary);">
                                <?= $no++ ?>
                            </td>
                            <td><code><?= $trxCode ?></code></td>
                            <td><strong><?= esc($row['nama_konsumen']) ?></strong></td>
                            <td>
                                <span class="badge"><?= esc($row['nama_kasir'] ?? 'Kasir Utama') ?></span>
                            </td>
                            <td><?= esc($row['nama_barang']) ?></td>
                            <td style="text-align:center;">
                                <span class="badge"><?= esc($row['jumlah']) ?></span>
                            </td>
                            <td style="text-align:right;white-space:nowrap;">
                                Rp <?= number_format($row['harga'], 0, ',', '.') ?>
                            </td>
                            <td style="text-align:right;white-space:nowrap;">
                                <strong>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></strong>
                            </td>
                            <td style="text-align:right;white-space:nowrap;padding-right:14px;">
                                <div class="btn-action-group">
                                    <a href="<?= base_url('transaksi/struk/' . $row['id_transaksi']) ?>"
                                        class="btn btn-primary">Struk</a>

                                    <a href="<?= base_url('transaksi/edit/' . $row['id_transaksi']) ?>"
                                        class="btn btn-outline">Edit</a>

                                    <button type="button" class="btn btn-outline"
                                        style="color:var(--danger-text);border-color:#fecaca;"
                                        onclick='konfirmasiHapus(
                                    <?= json_encode(base_url('transaksi/hapus/' . $row['id_transaksi'])) ?>,
                                    <?= json_encode($trxCode) ?>
                                )'>Hapus</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($transaksi)): ?>
                        <tr>
                            <td colspan="9" style="text-align:center;">Belum ada transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-icon">!</div>
            <div class="modal-title">Konfirmasi Penghapusan</div>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin menghapus rekaman transaksi
            <strong id="namaDataModal"></strong>?
            Tindakan ini tidak dapat dibatalkan.
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-outline" onclick="tutupModal()">Batal</button>
            <a id="btnHapusModal" href="#" class="btn btn-primary"
                style="background-color:var(--danger-text);border-color:var(--danger-text);">
                Ya, Hapus Transaksi
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