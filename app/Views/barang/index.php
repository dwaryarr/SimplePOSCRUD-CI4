<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 18px 20px;
        box-shadow: var(--shadow-sm);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--text-secondary);
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Grid Grafik Berdampingan */
    .charts-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 16px;
        margin-bottom: 28px;
    }

    @media (max-width: 768px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }

    .chart-card {
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 20px;
        box-shadow: var(--shadow-sm);
    }

    .chart-header {
        margin-bottom: 14px;
    }

    .chart-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .chart-subtitle {
        font-size: 0.78rem;
        color: var(--text-secondary);
    }

    .chart-box {
        position: relative;
        height: 230px;
        width: 100%;
    }

    .table-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        gap: 12px;
    }

    .search-input {
        max-width: 280px;
        padding: 8px 14px;
        font-size: 0.875rem;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        outline: none;
        background: #fff;
        transition: border-color 0.15s ease;
    }

    .search-input:focus {
        border-color: var(--text-primary);
    }
</style>

<div class="container" style="max-width: 1100px;">
    <div class="page-header">
        <div>
            <h2>Dashboard & Inventaris Barang</h2>
            <p class="subtitle">Ringkasan analitik penjualan dan pengelolaan stok barang</p>
        </div>
        <a href="<?= base_url('barang/tambah') ?>" class="btn btn-primary">
            + Tambah Barang
        </a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Jenis Barang</div>
            <div class="stat-value">
                <?= number_format($jml_barang, 0, ',', '.') ?> Item
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Konsumen</div>
            <div class="stat-value">
                <?= number_format($jml_konsumen, 0, ',', '.') ?> Orang
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Petugas Kasir</div>
            <div class="stat-value">
                <?= number_format($jml_kasir, 0, ',', '.') ?> Aktif
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Omzet Penjualan</div>
            <div class="stat-value" style="color:#059669">
                Rp <?= number_format($total_omzet, 0, ',', '.') ?>
            </div>
        </div>
    </div>

    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-title">Volume Penjualan Barang (Top 5)</div>
            <div class="chart-subtitle">
                Jumlah unit terjual berdasarkan transaksi
            </div>
            <div class="chart-box">
                <canvas id="barChartBarang"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-title">Kinerja Transaksi Kasir</div>
            <div class="chart-subtitle">
                Proporsi jumlah nota yang dilayani
            </div>
            <div class="chart-box">
                <canvas id="doughnutChartKasir"></canvas>
            </div>
        </div>
    </div>

    <div class="table-toolbar">
        <input type="text" id="searchInput"
            class="search-input"
            placeholder="Cari nama atau kode barang..."
            onkeyup="filterTabel()">

        <div style="font-size:.8125rem;color:var(--text-secondary)">
            Pencarian instan otomatis
        </div>
    </div>

    <div class="card table-responsive">
        <table id="tabelBarang">
            <thead>
                <tr>
                    <th style="width:50px">No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Harga Satuan</th>
                    <th style="text-align:center">Stok</th>
                    <th style="text-align:right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($barang as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><code><?= esc($row['kode_brg']) ?></code></td>
                        <td><strong><?= esc($row['nama_barang']) ?></strong></td>
                        <td><span class="badge"><?= esc($row['jenis']) ?></span></td>
                        <td>Rp <?= number_format($row['harga_beli'], 0, ',', '.') ?></td>
                        <td style="text-align:center"><?= esc($row['total_beli']) ?></td>
                        <td style="text-align:right;white-space:nowrap">
                            <a href="<?= base_url('barang/edit/' . $row['kode_brg']) ?>"
                                class="btn btn-outline btn-sm">Edit</a>

                            <button type="button"
                                class="btn btn-outline btn-sm"
                                style="color:var(--danger-text);border-color:#fecaca"
                                onclick='konfirmasiHapus(
                                <?= json_encode(base_url('barang/hapus/' . rawurlencode($row['kode_brg']))) ?>,
                                <?= json_encode($row['nama_barang']) ?>
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
            Apakah Anda yakin ingin menghapus data
            <strong id="namaDataModal"></strong>
            dari sistem? Tindakan ini tidak dapat dibatalkan.
        </div>

        <div class="modal-actions">
            <button type="button" class="btn btn-outline"
                onclick="tutupModal()">Batal</button>

            <a id="btnHapusModal" href="#" class="btn btn-primary"
                style="background-color:var(--danger-text);border-color:var(--danger-text)">
                Ya, Hapus Data
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    Chart.defaults.font.family =
        "'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif";
    Chart.defaults.color = '#52525b';

    new Chart(document.getElementById('barChartBarang'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($chart_barang, 'nama_barang')) ?>,
            datasets: [{
                label: 'Unit Terjual',
                data: <?= json_encode(array_map('intval', array_column($chart_barang, 'total_terjual'))) ?>,
                backgroundColor: '#18181b',
                hoverBackgroundColor: '#059669',
                borderRadius: 5,
                maxBarThickness: 42
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    },
                    grid: {
                        color: '#f4f4f5'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('doughnutChartKasir'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($chart_kasir, 'nama_kasir')) ?>,
            datasets: [{
                data: <?= json_encode(array_map('intval', array_column($chart_kasir, 'total_trx'))) ?>,
                backgroundColor: ['#18181b', '#059669', '#52525b', '#a1a1aa', '#d4d4d8'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 14,
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });

    function filterTabel() {
        const filter = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#tabelBarang tbody tr');

        rows.forEach(row => {
            const kode = row.cells[1].textContent.toLowerCase();
            const nama = row.cells[2].textContent.toLowerCase();
            row.style.display =
                kode.includes(filter) || nama.includes(filter) ? '' : 'none';
        });
    }

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