<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$trxCode = 'TRX-' . sprintf('%03d', $item['id_transaksi']);
$tanggal = date('d/m/Y H:i');
?>

<style>
    .receipt-wrapper {
        max-width: 380px;
        margin: 40px auto;
        padding: 0 16px;
    }

    .receipt-card {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 28px 24px;
        box-shadow: var(--shadow-md);
        font-family: monospace;
        color: #09090b;
    }

    .receipt-header {
        text-align: center;
        margin-bottom: 16px;
    }

    .receipt-title {
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: .05em;
    }

    .receipt-subtitle {
        font-size: .75rem;
        color: #64748b;
        margin-top: 4px;
    }

    .receipt-divider {
        border-top: 1px dashed #cbd5e1;
        margin: 14px 0;
    }

    .meta-row,
    .item-calc,
    .total-row {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 6px;
        font-size: .78rem;
    }

    .meta-label,
    .item-calc {
        color: #64748b;
    }

    .item-name {
        font-size: .85rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .total-row {
        font-size: 1rem;
        font-weight: 800;
    }

    .receipt-footer {
        text-align: center;
        font-size: .75rem;
        color: #64748b;
        margin-top: 18px;
        line-height: 1.5;
    }

    .receipt-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        justify-content: center;
    }

    @media print {
        body {
            background: #fff !important;
            padding: 0 !important;
        }

        .sidebar,
        .navbar,
        .receipt-actions {
            display: none !important;
        }

        body,
        .main-content {
            padding: 0 !important;
            margin: 0 !important;
        }

        .receipt-wrapper {
            margin: 0 auto;
            max-width: 100%;
            width: 80mm;
            padding: 0;
        }

        .receipt-card {
            border: none;
            box-shadow: none;
            padding: 10px 0;
        }
    }
</style>

<div class="receipt-wrapper">
    <div class="receipt-card">

        <div class="receipt-header">
            <div class="receipt-title">POS SYSTEM</div>
            <div class="receipt-subtitle">Bukti Pembayaran Transaksi</div>
        </div>

        <div class="receipt-divider"></div>

        <div class="meta-row">
            <span class="meta-label">No. Nota</span>
            <strong><?= esc($trxCode) ?></strong>
        </div>

        <div class="meta-row">
            <span class="meta-label">Tanggal</span>
            <span><?= $tanggal ?></span>
        </div>

        <div class="meta-row">
            <span class="meta-label">Kasir</span>
            <span><?= esc($item['nama_kasir'] ?? 'Kasir Utama') ?></span>
        </div>

        <div class="meta-row">
            <span class="meta-label">Pelanggan</span>
            <strong><?= esc($item['nama_konsumen']) ?></strong>
        </div>

        <div class="meta-row">
            <span class="meta-label">No. HP</span>
            <span><?= esc($item['no_hp'] ?? '-') ?></span>
        </div>

        <div class="receipt-divider"></div>

        <div class="item-name">
            <?= esc($item['nama_barang']) ?>
            (<?= esc($item['kode_brg']) ?>)
        </div>

        <div class="item-calc">
            <span>
                <?= $item['jumlah'] ?> x Rp
                <?= number_format($item['harga'], 0, ',', '.') ?>
            </span>
            <strong style="color:#09090b;">
                Rp <?= number_format($item['total_bayar'], 0, ',', '.') ?>
            </strong>
        </div>

        <div class="receipt-divider"></div>

        <div class="total-row">
            <span>TOTAL BAYAR</span>
            <span>
                Rp <?= number_format($item['total_bayar'], 0, ',', '.') ?>
            </span>
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-footer">
            Terima kasih atas kunjungan Anda.<br>
            Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.
        </div>
    </div>

    <div class="receipt-actions">
        <button type="button" class="btn btn-primary"
            onclick="window.print()">
            Cetak Struk
        </button>

        <a href="<?= base_url('transaksi') ?>" class="btn btn-outline">
            Kembali
        </a>
    </div>
</div>

<?= $this->endSection() ?>